<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Laporan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login();
			$this->info = info();
			$this->back = $this->agent->referrer();
			$this->iduser = $this->session->idu;
			$this->perPage = 10; 
			$this->title = info()['title']; 
		}
		
		public function omset_penjualan()
		{
			cek_menu_akses();
			$data['title'] ='Laporan Omset Penjualan | '.info()['title'];
			
			$data['dari'] = tgl_dari_slash();	
			$this->template->load('main/themes','laporan/omset_penjualan',$data);
		}
		
		public function penjualan()
		{
			cek_menu_akses();
			$data['title'] ='Laporan Penjualan | '.info()['title'];
			
			$data['dari'] = tgl_dari_slash();	
			$this->template->load('main/themes','laporan/penjualan',$data);
		}
		//bahan
		public function produk(){
			cek_nput_post('GET');
			$dari = $this->input->post('dari'); 
			$sampai = $this->input->post('sampai'); 
			$page = $this->input->post('page');
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			if(!empty($dari)){ 
				$dari = date_slash($this->input->post('dari')); 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$sampai = date_slash($this->input->post('sampai')); 
				$conditions['search']['sampai'] = $sampai; 
			} 
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getLaporanPenjualan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataProduk'; 
			$config['base_url']    = base_url('laporan/produk'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_LaporanProduk'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $this->perPage;
			$conditions['where'] = array(
			"invoice.status" => 'simpan'
			); 
			if(!empty($dari)){ 
				$dari = date_slash($this->input->post('dari')); 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$sampai = date_slash($this->input->post('sampai')); 
				$conditions['search']['sampai'] = $sampai; 
			} 
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->getLaporanPenjualan($conditions); 
			
			$conditions['offset'] = $offset; 
			// Load the data list view 
			$this->load->view('laporan/laporan-produk', $data, false); 
		}
		
		public function perkategori(){	
			cek_nput_post('GET');
			$dari = $this->input->post('dari'); 
			$sampai = $this->input->post('sampai'); 
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			
			if(!empty($dari)){ 
				$dari = date_dmy($this->input->post('dari')); 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$sampai = date_dmy($this->input->post('sampai')); 
				$conditions['search']['sampai'] = $sampai; 
			} 
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getLaporanPerkategori($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataKategori'; 
			$config['base_url']    = base_url('laporan/perkategori'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_LaporanKategori'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $this->perPage;
			$conditions['where'] = array(
			"invoice.status" => 'simpan'
			); 
			if(!empty($dari)){ 
				$dari = date_dmy($this->input->post('dari')); 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$sampai = date_dmy($this->input->post('sampai')); 
				$conditions['search']['sampai'] = $sampai; 
			}  
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->getLaporanPerkategori($conditions); 
			
			// Load the data list view 
			$this->load->view('laporan/laporan-perkategori', $data, false); 
		}
		
		public function cariPendapatan()
		{
			cek_nput_post('GET');
			$dari = $this->input->post('dari'); 
			$sampai = $this->input->post('sampai'); 
			
			if(!empty($dari)){ 
				$dari = date_dmy($this->input->post('dari')); 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$sampai = date_dmy($this->input->post('sampai')); 
				$conditions['search']['sampai'] = $sampai; 
			}
			
			$data['penjualan'] 		= $this->model_data->getLabaRugi($conditions);
			$data['pengeluaran'] 	= $this->model_data->getLabaRugiBiaya($conditions);
			$this->load->view('laporan/laporan-labarugi', $data, false);
		}
		
		
		public function cetak_laporan_penjualan(){
			
			$jenis = $this->input->post('jenis'); 
			if(isset($jenis)){
				$dari = $this->input->post('startdate'); 
				$sampai = $this->input->post('enddate'); 
				if(!empty($dari)){ 
					$dari = date_slash($this->input->post('startdate')); 
					$data['search']['dari'] = $dari; 
				} 
				if(!empty($sampai)){ 
					$sampai = date_slash($this->input->post('enddate')); 
					$data['search']['sampai'] = $sampai; 
				} 
				
				
				$data['logo'] = FCPATH.'uploads/'.info()['logo_bw'];			
				$data['info'] = info();
				$data['user'] = $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
				
				$this->load->library('pdf');				
				$this->pdf->setPaper('A5', 'landscape');				
				$this->pdf->filename = "laporan_penjualan";	
				
				$data['detail'] = $this->model_data->getLaporanPenjualan($data);
				$this->pdf->load_view('laporan/cetak_laporan_penjualan', $data);				
				// $this->load->view('laporan/cetak_laporan_penjualan', $data);				
				
				}else{
				$data['cetak']       = 'error';
				$this->load->view('errors/404',$data);
			}
		}
		
		public function cetak_laporan_pendapatan(){
			$dari = $this->input->post('startdate'); 
			$sampai = $this->input->post('enddate'); 
			// echo $dari;
			if(isset($dari)){
				
				if(!empty($dari)){ 
					$dari = date_dmy($this->input->post('startdate')); 
					$data['search']['dari'] = $dari; 
				} 
				if(!empty($sampai)){ 
					$sampai = date_dmy($this->input->post('enddate')); 
					$data['search']['sampai'] = $sampai; 
				} 
				
				$data['logo']           = FCPATH.'uploads/'.info()['logo_bw'];			
				$data['info']           = info();
				$data['user']           = $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
				$data['penjualan'] 		= $this->model_data->getLabaRugi($data);
				$data['pengeluaran'] 	= $this->model_data->getLabaRugiBiaya($data);
				
				$this->load->library('pdf');				
				$this->pdf->setPaper('A5', 'landscape');				
				$this->pdf->filename = "laporan_penjualan";				
				$this->pdf->load_view('laporan/cetak_laporan_pendapatan', $data);	
				
				}else{
				$data['cetak']       = 'error';
				$this->load->view('errors/404',$data);
			}
		}
		
		public function cetak_data_bahan(){
			$data['waicon'] 	= ['color'=>FCPATH.'assets/img/wa_icon.png','bw'=>FCPATH.'assets/img/wa_icon_bw.png'];
			$data['mail'] 		= ['color'=>FCPATH.'assets/img/gmail_icon.png','bw'=>FCPATH.'assets/img/gmail_icon_bw.png'];
			$data['fbicon'] 	= ['color'=>FCPATH.'assets/img/fb_icon.png','bw'=>FCPATH.'assets/img/fb_icon_bw.png'];
			$data['igicon'] 	= ['color'=>FCPATH.'assets/img/ig_icon.png','bw'=>FCPATH.'assets/img/ig_icon_bw.png'];
			
			$data['logo_blunas']	= FCPATH.'uploads/'.info()['logo_bw'];
			$data['info']			= info();
			$data['tanggal']		= today();
			$data['user']			= $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
			$data['laporan']		= $this->model_app->view_where('bahan',['kunci'=>0])->result(); 
			
			$this->load->library('pdf');				
			$this->pdf->setPaper('A4', 'potrait');					
			$this->pdf->filename = "laporan_data_bahan_".date('d_F_Y');				
			$this->pdf->load_view('laporan/cetak_data_bahan', $data);	
		}
		
		public function cetak_stok_bahan(){
			$data['waicon'] 	= ['color'=>FCPATH.'assets/img/wa_icon.png','bw'=>FCPATH.'assets/img/wa_icon_bw.png'];
			$data['mail'] 		= ['color'=>FCPATH.'assets/img/gmail_icon.png','bw'=>FCPATH.'assets/img/gmail_icon_bw.png'];
			$data['fbicon'] 	= ['color'=>FCPATH.'assets/img/fb_icon.png','bw'=>FCPATH.'assets/img/fb_icon_bw.png'];
			$data['igicon'] 	= ['color'=>FCPATH.'assets/img/ig_icon.png','bw'=>FCPATH.'assets/img/ig_icon_bw.png'];
			
			$data['logo_blunas']	= FCPATH.'uploads/'.info()['logo_bw'];
			$data['info']			= info();
			$data['tanggal']		= today();
			$data['user']			= $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
			$data['laporan']		= $this->model_app->view_where('bahan',['kunci'=>0,'status_stok'=>'Y'])->result(); 
			$mod = modul_cetak('cetak_stok');
			
			$this->load->library('pdf');				
			$this->pdf->setPaper($mod['ukuran'], $mod['posisi']);					
			$this->pdf->filename = "laporan_stok_bahan_".date('d_F_Y');				
			$this->pdf->load_view('laporan/cetak_stok_bahan', $data);	
			// $this->load->view('laporan/cetak_stok_bahan', $data);	
		}
		
		public function cetak_order_harian(){
			$sortby = ($this->input->post('sortby_cetak')); 
			$status = ($this->input->post('trx_cetak')); 
			$tanggal = date_slash($this->input->post('tanggal_cetak')); 
			
			if(isset($tanggal)){
				
				if(!empty($sortby)){ 
					$conditions['search']['sortBy'] = $sortby; 
				} 
				if(!empty($status)){ 
					$conditions['search']['trx'] = $status; 
				} 
				if(!empty($tanggal)){
					$conditions['search']['tgl'] = $tanggal; 
				} 
				$conditions['where']= array(
				'invoice.status !='=>'baru'
				); 
				//icon
				$data['waicon'] 	= ['color'=>FCPATH.'assets/img/wa_icon.png','bw'=>FCPATH.'assets/img/wa_icon_bw.png'];
				$data['mail'] 		= ['color'=>FCPATH.'assets/img/gmail_icon.png','bw'=>FCPATH.'assets/img/gmail_icon_bw.png'];
				$data['fbicon'] 	= ['color'=>FCPATH.'assets/img/fb_icon.png','bw'=>FCPATH.'assets/img/fb_icon_bw.png'];
				$data['igicon'] 	= ['color'=>FCPATH.'assets/img/ig_icon.png','bw'=>FCPATH.'assets/img/ig_icon_bw.png'];
				
				$data['logo_blunas']	= FCPATH.'uploads/'.info()['logo_bw'];
				$data['info']			= info();
				$data['tanggal']		= $tanggal;
				$data['user']			= $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
				$data['laporan']		= $this->model_data->getRows($conditions); 
				$data['penjualan']		= $this->model_data->getLabaRugi($data);
				$data['pengeluaran']	= $this->model_data->getLabaRugiBiaya($data);
				$mod = modul_cetak('cetak_order');
				$this->load->library('pdf');				
				$this->pdf->setPaper($mod['ukuran'], $mod['posisi']);					
				$this->pdf->filename = "laporan_penjualan";				
				$this->pdf->load_view('laporan/cetak_order_harian', $data);	
				}else{
				$data['cetak']       = 'error';
				$this->load->view('errors/404',$data);
			}
		}
		public function cetak_piutang()
		{
			
			$iduser= $this->db->escape_str($this->input->post('user'));		
			$periode= $this->db->escape_str($this->input->post('periode'));		
			$date_piutang = date_piutang($periode);
			$keywords= $this->db->escape_str($this->input->post('keywords'));		
			$bulan = getBlnPiutang($date_piutang['bulan']);
			$tahun = $date_piutang['tahun'];
			
			if($iduser !='' AND !empty($bulan) AND !empty($tahun)){
				$waktu = "month(invoice.tgl_trx) ='$bulan' AND YEAR(invoice.tgl_trx) ='$tahun'";				
				
				if ( substr($keywords,0,1 )== '0' )			
				{
					$whereSQL = "AND konsumen.no_hp LIKE '%$keywords%'";				
					}elseif($keywords!=''){
					$whereSQL = "AND konsumen.nama LIKE '%$keywords%'";				
					}elseif(is_numeric($keywords)){				
					$whereSQL = "AND invoice.id_invoice =".$keywords;				
					}else{				
					$whereSQL = "";				
				}			
				
				if ($iduser=='0' AND $keywords==''){
					$data['user'] = '-';			
					$where = "WHERE $waktu AND `invoice`.`status` = 'simpan'";				
					}elseif ($iduser=='0' AND $keywords!=''){				
					$data['user'] = '-';			
					$where = "WHERE $waktu  $whereSQL  AND `invoice`.`status` = 'simpan'";				
					}else{				
					$_user = $this->model_app->view_where('tb_users', array('id_user' => $iduser))->row();
					$data['user'] = $_user->nama_lengkap;			
					$where = "WHERE $waktu AND `invoice`.`id_user` = '$iduser' $whereSQL  AND `invoice`.`status` = 'simpan'" ;				
				}						
				
				$tgl    = date("Y-m-d H:i:s");
				$data['logo'] = FCPATH.'uploads/'.info()['logo'];
				$data['logop'] = base_url().'uploads/'.info()['logo'];
				$data['info'] = info();
				$data['tgl'] = date('d/m/Y'); 
				
				$data['bulan'] = $bulan;			
				$data['tahun'] = $tahun;
				
				$data['detail'] = $this->model_data->piutang($where);	
				$this->load->library('pdf');
				$this->pdf->setPaper('A5', 'landscape');
				$this->pdf->filename = "rekap_".$tgl;
				$this->pdf->load_view('pembukuan/cetak_piutang', $data);
				// $this->load->view('pembukuan/cetak_piutang',$data);
				}else{
				$data['cetak']       = 'error';
				
				$this->load->view('errors/404',$data);
			}
		}
		
		public function desain(){
			cek_menu_akses();
			$data['title'] = 'Data Desain | '.info()['title'];
			$data['tgl'] = date('d/m/Y');	
			$params =  ['id'=>'id_user','title'=>'nama_lengkap']; 
			if($this->session->level=='admin'){
				$desain[] = $this->model_app->view_where('tb_users',['aktif'=>'Y'])->result();	
				$data['select'] = select_box($desain,0,0,'',$params);
				}else{
				$desain[] = $this->model_app->view_where('tb_users',['aktif'=>'Y'])->result();
				$data['select'] = select_box($desain,0,0,$this->iduser,$params);	
			}
			
			$conditions['where'] = array(
			'invoice.status' => 'pending'
			);
			
			
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getDesain($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataDesain'; 
			$config['base_url']    = base_url('laporan/ajaxdesain'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Desain'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'limit' => $this->perPage 
			); 
			$conditions['where'] = array(
			'invoice.status' => 'pending'
			);
			// $conditions['where'] = array(
			// 'invoice.id_desain' => $this->iduser,
			// 'invoice.status' => 'simpan',
			// 'invoice_detail.jenis_cetakan' => 9,
			// 'invoice.tgl_trx' => date("Y-m-d")
			// );
			$data['posts'] = $this->model_data->getDesain($conditions); 
			$this->template->load('main/themes','laporan/desain',$data);
		}
		public function ajaxDesain(){	
			cek_nput_post('GET');
			$dari = date_slash($this->input->post('dari')); 
			$sampai = date_slash($this->input->post('sampai')); 
			$jenis = $this->input->post('jenis'); 
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			
			if(!empty($dari)){ 
				$conditions['search']['dari'] = $dari; 
			} 
			
			if(!empty($sampai)){ 
				$conditions['search']['sampai'] = $sampai; 
			} 
			
			$user = $this->input->post('user'); 
			if(!empty($user) and $jenis==1){ 
				$conditions['search']['user'] = $user; 
			} 
			
			if(!empty($jenis) AND $jenis==2){ 
				$conditions['search']['jenis'] = 'pending'; 
			} 
			if($jenis==1){
				$conditions['where'] = array(
				'invoice.status' => 'simpan',
				'invoice.id_desain' => $user
				);
				}else{
				$conditions['where'] = array(
				'invoice.status' => $jenis
				);
			}
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getDesain($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataDesain'; 
			$config['base_url']    = base_url('laporan/ajaxdesain'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Desain'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			if(!empty($dari)){ 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$conditions['search']['sampai'] = $sampai; 
			} 
			if(!empty($user) and $jenis==1){ 
				$conditions['search']['user'] = $user; 
			} 
			$jenis = $this->input->post('jenis'); 
			if(!empty($jenis) AND $jenis==2){ 
				$conditions['search']['jenis'] = 'pending'; 
			} 
			if($jenis==1){
				$conditions['where'] = array(
				'invoice.status' => 'simpan',
				'invoice.id_desain' => $user
				);
				}else{
				$conditions['where'] = array(
				'invoice.status' => $jenis
				);
			}
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->getDesain($conditions); 
			
			// Load the data list view 
			$this->load->view('laporan/laporan-desain', $data, false); 
		}
		public function operator(){
			$data['title'] ='Laporan operator | '.$this->title;
			
			$data['pilihan'] = $this->model_app->pilih('id_user, nama_lengkap','tb_users')->result_array();		
			
			$conditions['where'] = array(
			'invoice.status' => 'simpan'
			);
			
			$dari 	= date('Y-m-').'01';				
			$conditions['search']['dari'] = $dari; 
			$conditions['search']['sampai'] = date("Y-m-d"); 
			
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->get_operator($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListOmset'; 
			$config['base_url']    = base_url('laporan/ajaxOperator'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Operator'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'limit' => $this->perPage 
			); 
			
			$conditions['where'] = array(
			'invoice.status' => 'simpan'
			);
			$dari 	= date('Y-m-').'01';				
			$conditions['search']['dari'] = $dari; 
			$conditions['search']['sampai'] = date("Y-m-d"); 
			$data['dari'] = tgl_dari_slash();
			$data['sampai'] = tgl_sampai_slash();
			$data['posts'] = $this->model_data->get_operator($conditions); 
			// print_r($data['posts']);
			$this->template->load('main/themes','laporan/operator',$data);
		}
		public function ajaxOperator()
		{	
			
			$page = $this->input->post('page');
			if (!$page) {
				$offset = 0;
				} else {
				$offset = $page;
			}
			$sortBy = $this->input->post('sortBy');
			if (!empty($sortBy)) {
				$conditions['search']['sortBy'] = $sortBy;
			}
			$limits = $this->input->post('limits');
			if (!empty($limits)) {
				$limit = $limits;
				} else {
				$limit = $this->perPage;
			}
			// Set conditions for search and filter
			$user = $this->input->post('user');
			$dari = date_slash($this->input->post('dari'));
			$sampai = date_slash($this->input->post('sampai'));
			
			$conditions['where'] = array(
			'invoice.status' => 'simpan'
			);
			
			if (!empty($dari)) {
				$conditions['search']['dari'] = $dari;
			}
			if (!empty($sampai)) {
				$conditions['search']['sampai'] = $sampai;
			}
			
			// Get record count
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->get_operator($conditions);
			
			// Pagination configuration
			$config['target'] = '#dataListOmset';
			$config['base_url'] = base_url('laporan/ajaxOperator');
			$config['total_rows'] = $totalRec;
			$config['per_page'] = $limit;
			$config['link_func'] = 'search_Operator';
			
			// Initialize pagination library
			$this->ajax_pagination->initialize($config);
			
			// Get records
			$conditions['start'] = $offset;
			$conditions['limit'] = $limit;
			
			$conditions['where'] = array(
			'invoice.status' => 'simpan'
			);
			unset($conditions['returnType']);
			
			$data['posts'] = $this->model_data->get_operator($conditions);
			$data['user'] = $user;
			
			// Load the data list view 
			$this->load->view('laporan/ajax-operator', $data, false); 
		}
		
		public function simpan_laporan()
		{
			
			$id = $this->input->post('id');
			$arr = ['Error request'];
			if (!empty($id)) {
				$type = $this->input->post('type');
				$status = $this->input->post('status');
				
				$data = ['status' => $status, 'id_operator' => $this->iduser];
				if ($type == 'proses') {
					$update = $this->model_app->update('invoice_detail', $data, [
					'id_rincianinvoice' => $id
					]);
					if ($update) {
						$arr = [
						'status' => 200,
						'title' => 'Simpan Status',
						'msg' => 'Berhasil disimpan'
						];
						} else {
						$arr = [
						'status' => 400,
						'title' => 'Simpan Status',
						'msg' => 'Gagal disimpan'
						];
					}
					} elseif ($type == 'update') {
					$update = $this->model_app->update('invoice_detail', $data, [
					'id_invoice' => $id
					]);
					if ($update) {
						if ($status == 2) {
							input_stok_keluar($id);
						}
						$this->model_app->update('invoice_detail', $data, [
						'id_invoice' => $id
						]);
						$arr = [
						'status' => 200,
						'title' => 'Simpan Status',
						'msg' => 'Berhasil disimpan'
						];
						} else {
						$arr = [
						'status' => 400,
						'title' => 'Simpan Status',
						'msg' => 'Gagal disimpan'
						];
					}
					} elseif ($type == 'selesai') {
					$update = $this->model_app->update('invoice_detail', $data, [
					'id_rincianinvoice' => $id
					]);
					$noorder = $this->input->post('noorder');
					input_stok_keluar_produk($id, $noorder);
					if ($update) {
						$arr = [
						'status' => 200,
						'title' => 'Simpan Status',
						'msg' => 'Berhasil disimpan'
						];
						} else {
						$arr = [
						'status' => 400,
						'title' => 'Simpan Status',
						'msg' => 'Gagal disimpan'
						];
					}
				}
				} else {
				$arr = ['Error request'];
			}
			echo json_encode($arr);
			
		}
		
		public function get_laporan(){
			
			$id = $this->input->post('id');
			$row = $this->model_app
			->view_where('invoice_detail', ['id_rincianinvoice' => $id])
			->row();
			$data = [
			'id' => $row->id_rincianinvoice,
			'idorder' => $row->id_invoice,
			'status' => $row->status
			];
			echo json_encode($data);
			
		}
	}																																																																																																																																		