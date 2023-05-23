<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Einvoice extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->title = info()['title']; 
			
		}
		
		public function kirim(){
			$seo = $this->uri->segment(2);
			$noid = decrypt_url($seo);
			$id = array('id_invoice' => $noid);
			$pub = array('pub' =>1);//printer aktif
			$where = ["id_invoice" => $noid];
			$id_konsumen = $this->model_app->pilih_where("id_konsumen","invoice", $where)->row()->id_konsumen;
			$this->cek_boleh_utang($id_konsumen,$noid);
			$search = $this->model_app->view_where('invoice', $id);
			
			if($search->num_rows()>0){
				//icon
				$data['waicon'] 	= ['color'=>base_url().'assets/img/wa_icon.png','bw'=>base_url().'assets/img/wa_icon_bw.png'];
				$data['mail'] 		= ['color'=>base_url().'assets/img/gmail_icon.png','bw'=>base_url().'assets/img/gmail_icon_bw.png'];
				$data['fbicon'] 	= ['color'=>base_url().'assets/img/fb_icon.png','bw'=>base_url().'assets/img/fb_icon_bw.png'];
				$data['igicon'] 	= ['color'=>base_url().'assets/img/ig_icon.png','bw'=>base_url().'assets/img/ig_icon_bw.png'];
				
				$data['logo_lunas'] = base_url().'uploads/'.info()['logo'];
				$data['logo_blunas'] = base_url().'uploads/'.info()['logo_bw'];
				$data['lunas'] = base_url().'uploads/'.info()['stamp_l'];
				$data['blunas'] = base_url().'uploads/'.info()['stamp_b'];
				$data['favicon'] = base_url().'uploads/'.info()['favicon'];
				$data['html'] = 'Y';
				
				$pub = array('pub' =>1);//printer aktif
				$cek_printer = $this->model_app->view_where('printer', $pub);
				$rowc = $cek_printer->row_array();
				
				$data['ukuran'] =$rowc['ukuran_kertas'];
				$data['font_size'] =$rowc['ukuran_font'];
				 
				$row = $search->row();
				$jml =$row->cetak+1;
				$this->model_app->update('tb_users', array("last_invoice"=>0),array('id_user'=>$this->session->idu));
				if($row->status!='batal'){
					$this->model_app->update('invoice',array('cetak'=>$jml,'status'=>'simpan','pos'=>'Y','oto'=>6),array('id_invoice'=>$noid));
				}
				//cek sisa
				$_total = 'ROUND(SUM((`invoice_detail`.`jumlah` * harga) - (`invoice_detail`.`jumlah` * harga) * (`invoice_detail`.`diskon`/100))) AS sisa';
				$cari_total= $this->model_app->cek_total('invoice_detail',$_total,array('id_invoice'=>$noid));
				$data['sisanya'] = $cari_total->sisa;
				//
				$data['cetak'] = $row;
				$data['info'] = info();
				$konsumen = $this->model_app->view_where('konsumen', array('id' => $row->id_konsumen))->row_array();
				
				if($konsumen['max_utang'] >0 AND $jml <=1){
					$max_utang = $konsumen['max_utang'] - 1;
					$this->model_app->update('konsumen',array('max_utang'=>$max_utang),array('id'=>$row->id_konsumen));
				}
				
				$data['konsumen']    = $konsumen;
				$data['marketing']   = $this->model_app->view_where('tb_users', array('id_user' => $row->id_marketing))->row_array();
				$data['detail']      = $this->model_app->produk_cart(array('invoice_detail.id_invoice' => $noid));
				$data['total']       =$this->model_app->total_bayar(array('bayar_invoice_detail.id_invoice'=>$noid))->row();
				$select              = 'pajak, total_bayar AS total';
				$where               = array('id_invoice'=>$noid);
				$tdetail             = $this->model_app->cek_total('invoice',$select,$where);
				$data['tdetail']     = $tdetail->total;
				$data['pajak']       = $tdetail->pajak;
				$_diskon             = 'SUM(diskon) AS `disc`';
				$cdiskon             = $this->model_app->cek_total('invoice_detail',$_diskon,$where);
				$data['cdiskon']     = $cdiskon->disc;
				$_select             = 'COUNT(id) AS `jml`';
				$cdetail             = $this->model_app->cek_total('bayar_invoice_detail',$_select,$where);
				$data['cdetail']     = $cdetail->jml;
				//bayar detail
				$data['bdetail']     = $this->model_app->view_where('bayar_invoice_detail', $id)->result_array();
				///
				$data['cara']        = $this->model_app->cara_bayar(array('`jenis_bayar`.`publish`'=>'Y','`bayar_invoice_detail`.`id_invoice`' => $noid));
				$data['bank']        = $this->model_app->view_where('rekening_bank',['footer_invoice'=>1,'publish'=>'Y'])->result();
				
				$this->load->view('produk/kirim_invoice',$data);
				}else{
				$data['cetak'] = 'error';
				$this->load->view('errors/404',$data);
			}
			
		}
		
		private function cek_boleh_utang($id_konsumen,$id_invoice)
		{
			$max_utang = $this->model_app
			->pilih_where("max_utang,status","konsumen", ["id" => $id_konsumen])
			->row();
			
			$cek_bayar = $this->model_app->cek_total("bayar_invoice_detail","SUM(jml_bayar) AS `total`",['id_invoice'=>$id_invoice]);
			
			if ($max_utang->max_utang == 0 AND $max_utang->status==0 AND $cek_bayar->total ==0) {
				$data = ["status" => 'harus_dp', "id" => $id_invoice, "msg" => 'Belum ada pembayaran'];
				$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
		}
		
	}				
