<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Operator extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login();
			$this->info = info();
			$this->perPage = 10; 
			$this->iduser = $this->session->idu;
		}
		public function list_pekerjaan()
		{
			
			
			$conditions['where'] = array(
			'invoice.status!=' => 'batal',
			'invoice.status!=' => 'baru'
			);
			
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->get_operator($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListPekerjaan'; 
			$config['base_url']    = base_url('laporan/ajaxOperator'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			// $config['link_func']   = 'search_Operator'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'limit' => $this->perPage 
			); 
			
			$conditions['where'] = array(
			'invoice.status!=' => 'batal',
			'invoice.status!=' => 'baru'
			);
			$data['posts'] = $this->model_data->get_operator($conditions); 
			$this->load->view('laporan/list_pekerjaan', $data);
		}
		public function baru()
		{
			$conditions['where'] = array(
			'status' => 0,
			'id_operator' => 0
			);
			$data = $this->model_app->counter('invoice_detail', $conditions);
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function proses()
		{
			$conditions['where'] = array(
			'status' => 1,
			'id_operator' => $this->iduser
			);
			$data = $this->model_app->counter('invoice_detail', $conditions);
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function selesai()
		{
			$conditions['where'] = array(
			'status' => 2,
			'id_operator' => $this->iduser
			);
			$data = $this->model_app->counter('invoice_detail', $conditions);
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function print_invoice($noid=null){
			$noid = decrypt_url($noid);
			$id = array('id_invoice' => $noid);
			$pub = array('pub' =>1);//printer aktif
			$cek_printer = $this->model_app->view_where('printer', $pub);
		    $rowc = $cek_printer->row_array();
			
			$search = $this->model_app->view_where('invoice', $id);
			
			//icon
			$data['waicon'] 	= ['color'=>FCPATH.'assets/img/wa_icon.png','bw'=>FCPATH.'assets/img/wa_icon_bw.png'];
			$data['mail'] 		= ['color'=>FCPATH.'assets/img/gmail_icon.png','bw'=>FCPATH.'assets/img/gmail_icon_bw.png'];
			$data['fbicon'] 	= ['color'=>FCPATH.'assets/img/fb_icon.png','bw'=>FCPATH.'assets/img/fb_icon_bw.png'];
			$data['igicon'] 	= ['color'=>FCPATH.'assets/img/ig_icon.png','bw'=>FCPATH.'assets/img/ig_icon_bw.png'];
			
			$data['logo_lunas'] = FCPATH.'uploads/'.info()['logo'];
			$data['logo_blunas'] = FCPATH.'uploads/'.info()['logo_bw'];
			$data['lunas'] = FCPATH.'uploads/'.info()['stamp_l'];
			$data['blunas'] = FCPATH.'uploads/'.info()['stamp_b'];
			$data['favicon'] = FCPATH.'uploads/'.info()['favicon'];
			$data['html'] = 'N';
			if($search->num_rows()>0){
				$this->session->unset_userdata('cart');
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
				
				$this->load->library('pdf');
				$this->pdf->setPaper($rowc['ukuran_kertas'], $rowc['posisi']);
				$this->pdf->filename = "invoice_".$noid."_".$row->tgl_trx;
				$this->pdf->load_view('laporan/print_spk', $data);
				// $this->load->view('produk/print_invoice',$data);
				}else{
				$data['cetak']       = 'error';
				$this->load->view('errors/404',$data);
			}
			
			
		}
		
		public function print_invoice_html($noid=null){
			$noid = decrypt_url($noid);
			$id = array('id_invoice' => $noid);
			$pub = array('pub' =>1);//printer aktif
			$search = $this->model_app->view_where('invoice', $id);
			
			$cek_printer = $this->model_app->view_where('printer', $pub);
			if($cek_printer->num_rows()>0){
				$rowc = $cek_printer->row_array();
				//print thermal
				if($rowc['slug']=='th' AND $rowc['pub']==1){
					
					if($search->num_rows()>0){
						
						$this->session->unset_userdata('cart');
						$row = $search->row_array();
						$jml =$row['cetak']+1;
						$this->model_app->update('tb_users', array("last_invoice"=>0),array('id_user'=>$this->session->idu));
						if($row['status']!='batal'){
							$this->model_app->update('invoice',array('cetak'=>$jml,'status'=>'simpan','pos'=>'Y','oto'=>6),array('id_invoice'=>$noid));
						}
						
						//marketing 
						$marketing = $this->model_app->view_where('tb_users', array('id_user' => $row['id_marketing']))->row_array();
						//bayar detail
						$detail = $this->model_app->produk_cart(array('invoice_detail.id_invoice' => $noid));
						//total bayar
						$total=$this->model_app->total_bayar(array('bayar_invoice_detail.id_invoice'=>$noid))->row();
						$bdetail =  $this->model_app->view_where('bayar_invoice_detail', $id)->result_array();
						
						//load library
						$this->load->library('escpos');
						// membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
						$connector = new Escpos\PrintConnectors\WindowsPrintConnector($rowc['shared_name']);
						
						// membuat objek $printer agar dapat di lakukan fungsinya
						$printer = new Escpos\Printer($connector);
						// Get status
						$printer->initialize();
						$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
						$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
						$printer->text($this->info['title']."\n");
						
						$printer->initialize();
						$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
						$printer->text(strip_word_html(base64_decode($this->info['deskripsi']))."\n");
						$printer->text("\n");
						
						// Data transaksi
						$printer->initialize();
						$printer->text("Invoice : #".$row['id_invoice']."\n");
						$printer->text("Kasir : ".$marketing['nama_lengkap']."\n");
						$printer->text("Waktu : ".tgl_indo($row['tgl_trx'])."\n");
						
						// Membuat tabel
						$printer->initialize(); // Reset bentuk/jenis teks
						
						$printer->text("-----------------------------------------------\n");
						$printer->text(buatBaris4Kolom("Deskripsi", "QTY", "Harga", "Subtotal"));
						$printer->text("-----------------------------------------------\n");
						$no=1; 
						$totalb=0; 
						$subtotal=0; 
						$sisa=0; 
						$diskon=0; 
						foreach($detail  AS $val){
							$diskon = $val['jumlah'] * $val['harga'] * $val['diskon']/100;
							$totalb = $val['jumlah'] * $val['harga'] - $diskon;
							$subtotal += $totalb;
							
							$printer->text(buatBaris4Kolom($val['title'].' '.$val['ukuran'], $val['jumlah'].$val['satuan'], rp($val['harga']), rp($totalb)));
							$printer->text("Ket: ".$val['nbahan'] .' '.$val['keterangan'] ."\n");
							//
							$pajak = ($subtotal * $row['pajak']) /100;
							$sisa = $pajak + $subtotal - $total->total;
							$cek_bayar = $pajak + $subtotal;
						}
						
						$printer->text("-----------------------------------------------\n");
						$printer->text(buatBaris4Kolom('', '', "TOTAL", rp($subtotal)));
						
						if($sisa==0){
							$printer->text(buatBaris4Kolom('', '', "BAYAR", rp($total->total)));
							}else{
							$printer->text("\n");
							$printer->text(buatBaris4Kolom('', '', "BAYAR", rp($total->total)));
							$printer->text(buatBaris4Kolom('', '', "SISA", rp($sisa)));
						}
						
						$printer->text("\n");
						// Pesan penutup
						$printer->initialize();
						$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
						$printer->text("Terima kasih\n");
						$printer->text("HP: ".$this->info['phone']."\n");
						$printer->text(" EMAIL : ".$this->info['email']."\n");
						$printer->feed(3); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
						// echo "ok";
						
						$printer->close();
						}else{
						echo "gagal";
					}
					//print thermal 58
					}elseif($rowc['slug']=='th58' AND $rowc['pub']==1){
					
					if($search->num_rows()>0){
						
						$this->session->unset_userdata('cart');
						$row = $search->row_array();
						$jml =$row['cetak']+1;
						$this->model_app->update('tb_users', array("last_invoice"=>0),array('id_user'=>$this->session->idu));
						if($row['status']!='batal'){
							$this->model_app->update('invoice',array('cetak'=>$jml,'status'=>'simpan','pos'=>'Y','oto'=>6),array('id_invoice'=>$noid));
						}
						
						//marketing 
						$marketing = $this->model_app->view_where('tb_users', array('id_user' => $row['id_marketing']))->row_array();
						//bayar detail
						$detail = $this->model_app->produk_cart(array('invoice_detail.id_invoice' => $noid));
						//total bayar
						$total=$this->model_app->total_bayar(array('bayar_invoice_detail.id_invoice'=>$noid))->row();
						$bdetail =  $this->model_app->view_where('bayar_invoice_detail', $id)->result_array();
						
						//load library
						$this->load->library('escpos');
						// membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
						$connector = new Escpos\PrintConnectors\WindowsPrintConnector($rowc['shared_name']);
						
						// membuat objek $printer agar dapat di lakukan fungsinya
						$printer = new Escpos\Printer($connector);
						// Get status
						$printer->initialize();
						$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
						$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
						$printer->text($this->info['title']."\n");
						
						$printer->initialize();
						$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
						$printer->text(strip_word_html(base64_decode($this->info['deskripsi']))."\n");
						$printer->text("\n");
						
						// Data transaksi
						$printer->initialize();
						$printer->text("Invoice : #".$row['id_invoice']."\n");
						$printer->text("Kasir : ".$marketing['nama_lengkap']."\n");
						$printer->text("Waktu : ".tgl_indo($row['tgl_trx'])."\n");
						
						// Membuat tabel
						$printer->initialize(); // Reset bentuk/jenis teks
						
						$printer->text("-----------------------------------------------\n");
						$printer->text(buatBaris4Kolom58("Deskripsi", "QTY", "Harga", "Subtotal"));
						$printer->text("-----------------------------------------------\n");
						$no=1; 
						$totalb=0; 
						$subtotal=0; 
						$sisa=0; 
						$diskon=0; 
						foreach($detail  AS $val){
							$diskon = $val['jumlah'] * $val['harga'] * $val['diskon']/100;
							$totalb = $val['jumlah'] * $val['harga'] - $diskon;
							$subtotal += $totalb;
							
							$printer->text(buatBaris4Kolom58($val['title'].' '.$val['ukuran'], $val['jumlah'].$val['satuan'], rp($val['harga']), rp($totalb)));
							$printer->text("Ket: ".$val['nbahan'] .' '.$val['keterangan'] ."\n");
							//
							$pajak = ($subtotal * $row['pajak']) /100;
							$sisa = $pajak + $subtotal - $total->total;
							$cek_bayar = $pajak + $subtotal;
						}
						
						$printer->text("--------------------------------\n");
						$printer->text(buatBaris4Kolom58('', '', "TOTAL", rp($subtotal)));
						
						if($sisa==0){
							$printer->text(buatBaris4Kolom58('', '', "BAYAR", rp($total->total)));
							}else{
							$printer->text("\n");
							$printer->text(buatBaris4Kolom58('', '', "BAYAR", rp($total->total)));
							$printer->text(buatBaris4Kolom58('', '', "SISA", rp($sisa)));
						}
						
						$printer->text("\n");
						// Pesan penutup
						$printer->initialize();
						$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
						$printer->text("Terima kasih\n");
						$printer->text("HP: ".$this->info['phone']."\n");
						$printer->text(" EMAIL : ".$this->info['email']."\n");
						$printer->feed(3);  
						
						$printer->close();
						}else{
						echo "gagal";
					}
					}elseif(($rowc['slug']=='direct58' or $rowc['slug']=='direct85') AND $rowc['pub']==1){
					
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
					
					$data['ukuran'] =$rowc['ukuran_kertas'];
					$data['font_size'] =$rowc['ukuran_font'];
					
					if($search->num_rows()>0){
						$this->session->unset_userdata('cart');
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
						
						$this->load->view('laporan/print_invoice_direct58',$data);
						}else{
						$data['cetak'] = 'error';
						$this->load->view('errors/404',$data);
					}
					//print html
					}else{
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
					if($search->num_rows()>0){
						$this->session->unset_userdata('cart');
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
						
						$this->load->view('operator/print_invoice',$data);
						}else{
						$data['cetak'] = 'error';
						$this->load->view('errors/404',$data);
					}
				}
			}
		}
	}	