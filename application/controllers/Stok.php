<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Stok extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			// cek_session_login();
			$this->info = info();
			$this->back = $this->agent->referrer();
			$this->perPage = 10; 
			$this->iduser = $this->session->idu;
		}
		
		
		
		public function data()
		{
			cek_menu_akses();
			cek_crud_akses(8);
			$data['title'] = 'Data Stok | '.info()['title'];
			$data['judul'] ='Data Stok';
			
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokBahan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataStok'; 
			$config['base_url']    = base_url('stok/cariStok'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Stok'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			$data['bahan'] = $this->model_app->view_where('bahan',['kunci'=>0,'pub'=>1,'status_stok'=>'Y'])->result(); 
			$data['result'] = $this->model_data->getStokBahan($conditions); 
			// $data['mutasi'] = $this->model_stok->get_current_mutasi($data['result']);
			$this->template->load('main/themes','stok/stok',$data);
		}
		public function cariStok(){
			cek_nput_post('GET');
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			$limits = $this->input->post('limits'); 
			if(!empty($limits)){
				$limit = $limits; 
				}else{ 
				$limit = $this->perPage; 
			} 
			$sortBy = $this->input->post('sortBy'); 
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			
			$keywords = $this->input->post('keywords'); 
			if(!empty($keywords)){ 
				$conditions['search']['keywords'] = $keywords; 
			} 
			
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokBahan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataStok'; 
			$config['base_url']    = base_url('stok/cariStok'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'search_Produk'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->getStokBahan($conditions); 
			
			$conditions['offset'] = $offset; 
			// Load the data list view 
			$this->load->view('stok/cari-stok', $data, false); 
		}
		public function masuk()
		{
			cek_menu_akses();
			cek_crud_akses(8);
			$data['title'] = 'Data Stok Masuk | '.info()['title'];
			$data['judul'] ='Data Stok Masuk';
			
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokBahan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataStokMasuk'; 
			$config['base_url']    = base_url('stok/cariStokMasuk'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			// $config['link_func']   = 'search_StokMasuk'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			$data['bahan'] = $this->model_app->view_where('bahan',['kunci'=>0,'pub'=>1,'status_stok'=>'Y'])->result(); 
			$data['result'] = $this->model_data->getStokBahan($conditions); 
			// $data['mutasi'] = $this->model_stok->get_current_mutasi($data['result']);
			$this->template->load('main/themes','stok/stok-masuk',$data);
		}
		public function cariStokMasuk(){
			cek_nput_post('GET');
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			$limits = $this->input->post('limits'); 
			if(!empty($limits)){
				$limit = $limits; 
				}else{ 
				$limit = $this->perPage; 
			} 
			$sortBy = $this->input->post('sortBy'); 
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			
			$keywords = $this->input->post('keywords'); 
			if(!empty($keywords)){ 
				$conditions['search']['keywords'] = $keywords; 
			} 
			
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokBahan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataStokMasuk'; 
			$config['base_url']    = base_url('stok/cariStokMasuk'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'search_Stok_Masuk'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->getStokBahan($conditions); 
			
			$conditions['offset'] = $offset; 
			// Load the data list view 
			$this->load->view('stok/cari-stok-keluar', $data, false); 
		}
		public function detail_stok_masuk(){
			$id = $this->input->post('id');
			$conditions['where'] = array( 
            'id_bahan' => $id
			); 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokMasuk($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#DetailStok'; 
			$config['base_url']    = base_url('stok/cariDetailStokMasuk'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_detail_masuk'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$conditions['where'] = array( 
            'id_bahan' => $id
			); 
			
			$data['result'] = $this->model_data->getStokMasuk($conditions); 
			$this->load->view('stok/detail-stok-masuk', $data, false); 
		}
		public function keluar()
		{
			cek_menu_akses();
			cek_crud_akses(8);
			$data['title'] = 'Data Stok Keluar | '.info()['title'];
			$data['judul'] ='Data Stok Keluar';
			
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokBahan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataStok'; 
			$config['base_url']    = base_url('stok/cariStokKeluar'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			// $config['link_func']   = 'search_Stok'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			$data['bahan'] = $this->model_app->view_where('bahan',['kunci'=>0,'pub'=>1,'status_stok'=>'Y'])->result(); 
			$data['result'] = $this->model_data->getStokBahan($conditions); 
			$this->template->load('main/themes','stok/stok-keluar',$data);
		}
		
		public function cariStokKeluar(){
			cek_nput_post('GET');
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			$limits = $this->input->post('limits'); 
			if(!empty($limits)){
				$limit = $limits; 
				}else{ 
				$limit = $this->perPage; 
			} 
			$sortBy = $this->input->post('sortBy'); 
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			
			$keywords = $this->input->post('keywords'); 
			if(!empty($keywords)){ 
				$conditions['search']['keywords'] = $keywords; 
			} 
			
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokBahan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataStokKeluar'; 
			$config['base_url']    = base_url('stok/cariStokKeluar'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'search_Stok_Keluar'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			$conditions['where'] = array( 
            'bahan.status_stok' => 'Y',
            'bahan.pub' => 1,
            'bahan.kunci' => 0
			); 
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->getStokBahan($conditions); 
			
			$conditions['offset'] = $offset; 
			// Load the data list view 
			$this->load->view('stok/cari-stok-keluar', $data, false); 
		}
		
		public function detail_stok_keluar(){
			$id = $this->input->post('id');
			$conditions['where'] = array( 
            'id_bahan' => $id
			); 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokKeluar($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#DetailStok'; 
			$config['base_url']    = base_url('stok/cariDetailStokKeluar'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_detail_stok'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$conditions['where'] = array( 
            'id_bahan' => $id
			); 
			
			$data['id'] = $id;
			$data['result'] = $this->model_data->getStokKeluar($conditions); 
			$this->load->view('stok/detail-stok-keluar', $data, false); 
		}
		public function cetak_stok_keluar($id=null){
			cek_crud_akses(8);
			$data['title'] = 'Data Stok Keluar | '.info()['title'];
			$type = $this->input->get('type');
			$data['info'] = info();
			$data['user'] = $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
			$data['owner'] = $this->model_app->view_where('tb_users', array('level' => 'owner'))->row()->app_secret;
			if($type=='pdf'){
				$data['logo'] = FCPATH.'uploads/'.info()['logo'];
				}else{
				$data['logo'] = base_url().'uploads/'.info()['logo'];
			}
			
			$data['id'] = $id;
			$conditions['where'] = array( 
            'id_bahan' => $id
			); 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getStokKeluar($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#DetailStok'; 
			$config['base_url']    = base_url('stok/cariDetailStokKeluar'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_detail_stok'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$conditions['where'] = array( 
            'id_bahan' => $id
			); 
			
			$data['detail'] = $this->model_data->getStokKeluar($conditions); 
			if($type=='pdf'){
				$this->load->library("pdf");
				$this->pdf->setPaper("A4", "portrait");
				$this->pdf->filename = "laporan_keuangan_stok_keluar";
				$this->pdf->load_view("stok/cetak_laporan_stok_keluar", $data);
				}else{
				$this->load->view("stok/cetak_laporan_stok_keluar", $data);
			}
		}
		public function history($detail=''){
			if(empty($detail)){
				cek_menu_akses();
				cek_crud_akses(8);
				$data['title'] = 'Laporan History Stok | '.info()['title'];
				$data['judul'] ='History Stok';
				$data["tgl"] = date('d/m/Y');
				$conditions['returnType'] = 'count'; 
				$totalRec = $this->model_data->getRowsLaporan($conditions); 
				
				// Pagination configuration 
				$config['target']      = '#dataStok'; 
				$config['base_url']    = base_url('stok/cariLaporan'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				$config['link_func']   = 'search_Stok'; 
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config); 
				
				// Get records 
				$conditions = array( 
				'limit' => $this->perPage 
				); 
				
				$data['result'] = $this->model_data->getRowsLaporan($conditions); 
				$this->template->load('main/themes','stok/laporan',$data);
				}else{
				$id = decrypt_url($this->uri->segment(3));
				$data['title'] = 'History Stok | '.info()['title'];
				$data['judul'] ='History Stok';
				$data['id'] =$id;
				$data['list_cc'] = $this->model_stok->list_cc();
				$data['query'] = $this->model_stok->report_master($id);
				
				$this->template->load('main/themes','stok/history',$data);
			}
		}
		
		public function cetak_history($detail=''){
			$id = decrypt_url($this->uri->segment(3));
			$type = $this->input->get('type'); 
			$data['title'] = 'History Stok | '.info()['title'];
			$data['judul'] ='History Stok';
			$data['info'] = info();
			$data['user'] = $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
			$data['owner'] = $this->model_app->view_where('tb_users', array('level' => 'owner'))->row()->app_secret;
			
			$data['periode_stok'] = periode_stok($id);
			$data['id'] =$id;
			$data['list_cc'] = $this->model_stok->list_cc();
			$data['query'] = $this->model_stok->report_master($id);
			// print_r($data['query']);exit;
			if($type=='pdf'){
				$data['logo'] = FCPATH.'uploads/'.info()['logo'];
				$this->load->library("pdf");
				$this->pdf->setPaper("A4", "portrait");
				$this->pdf->filename = slugify("laporan history stok ".periode_stok($id));
				$this->pdf->load_view("stok/laporan_history_stok", $data);
				}else{
				$data['logo'] = base_url().'uploads/'.info()['logo'];
				$this->load->view("stok/laporan_history_stok", $data);
			}
			
			
		}
		
		public function cariLaporan(){
			cek_nput_post('GET');
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			$limits = $this->input->post('limits'); 
			if(!empty($limits)){
				$limit = $limits; 
				}else{ 
				$limit = $this->perPage; 
			} 
			$sortBy = $this->input->post('sortBy'); 
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			
			$keywords = $this->input->post('keywords'); 
			if(!empty($keywords)){ 
				$conditions['search']['keywords'] = $keywords; 
			} 
			
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getRowsLaporan($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataStok'; 
			$config['base_url']    = base_url('stok/cariLaporan'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'search_Produk'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->getRowsLaporan($conditions); 
			
			$conditions['offset'] = $offset; 
			// Load the data list view 
			$this->load->view('stok/laporan-stok', $data, false); 
		}
		public function edit_bahan(){
			cek_nput_post('GET');
			cek_crud_akses(8);
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$select = ['`bahan`.`title`',
				'`bahan`.`id`',
				'`bahan`.`harga`',
				'`bahan`.`harga`',
				'`bahan`.`harga_modal`',
				'`bahan`.`harga_jual`',
				'`bahan`.`id_satuan`',
				'`satuan`.`satuan`',
				'`bahan`.`pub`'];
				$where = array('bahan.id' => $id);
				
				$row = $this->model_app->join_where($select,'satuan','bahan','id','id_satuan',$where)->row_array();
				$data = array('id'=>$id,
				'judul'=>$row['title'],
				'modal'=>$row['harga_modal'],
				'terendah'=>$row['harga_jual'],
				'tertinggi'=>$row['harga'],
				'id_satuan'=>$row['id_satuan'],
				'satuan'=>$row['satuan'],
				'aktif'=>$row['pub']);
				}else{
				$data = array('id'=>0,'judul'=>"",'harga'=>'',"aktif"=>"",'msg'=>'error');
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function save_stok()
		{
			cek_nput_post('GET');
			simpan_demo('Simpan');
			cek_crud_akses(9);
			
			$type= $this->db->escape_str($this->input->post('type'));
			$bahan= ($this->db->escape_str($this->input->post('id')));
			$harga_beli= $this->db->escape_str($this->input->post('harga_beli'));
			$harga_jual= $this->db->escape_str($this->input->post('harga_jual'));
			$jumlah= $this->db->escape_str($this->input->post('jumlah'));
			
			$cek_harga_beli = $this->cek_harga_beli($bahan);
			
			$harga_beli_sekarang = $harga_beli * $jumlah;
			$harga_beli_stok = $cek_harga_beli->harga_beli + $harga_beli_sekarang;
			$jumlah_stok = $cek_harga_beli->jumlah + $jumlah;
			$harga_baru = $harga_beli_stok / $jumlah_stok;
			
			$_data = array('id_bahan'=>$bahan,'harga_beli'=>$harga_beli,'harga_jual'=>$harga_jual,'jumlah'=>$jumlah,'create_date'=>date('Y-m-d H:i:s'));
			$_data_up = array('harga_modal'=>ceil($harga_baru),'harga_jual'=>$harga_jual);
			
			if($type=='edit'){
				///data baru
				$res= $this->model_app->input('stok_masuk',$_data);
				if($res['status']=='ok'){
					$this->model_app->update('bahan',$_data_up,array('id'=>$bahan));
					$data = array('status'=>200,'msg'=>'Data berhasil disimpan');
					}else{
					$data = array('status'=>400);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		private function cek_harga_beli($id)
		{
			$query_stok_masuk = "SELECT
			SUM(`stok_masuk`.`jumlah`) AS `total_masuk`,
			`bahan`.`harga_modal`
			FROM
			`bahan`
			INNER JOIN `stok_masuk` ON (`bahan`.`id` = `stok_masuk`.`id_bahan`)
			WHERE
			`stok_masuk`.`id_bahan` = $id
			GROUP BY
			`bahan`.`id`";
			
			$sql_masuk = $this->db->query($query_stok_masuk);
			$row_masuk = $sql_masuk->row();
			$harga_modal = $row_masuk->harga_modal * $row_masuk->total_masuk;
			$data = ['harga_beli'=>$harga_modal,'jumlah'=>$row_masuk->total_masuk];
			
			return (object)$data;
		}
		public function save_stok_keluar()
		{
			cek_nput_post('GET');
			simpan_demo('Simpan');
			cek_crud_akses(9);
			
			$type= $this->db->escape_str($this->input->post('type'));
			$bahan= ($this->db->escape_str($this->input->post('bahan')));
			$harga_beli= $this->db->escape_str($this->input->post('harga_beli'));
			$harga_jual= $this->db->escape_str($this->input->post('harga_jual'));
			$jumlah= $this->db->escape_str($this->input->post('jumlah'));
			$keterangan= $this->db->escape_str($this->input->post('keterangan'));
			
			$_data = array('id_bahan'=>$bahan,'harga_jual'=>$harga_jual,'jumlah'=>$jumlah,'create_date'=>date('Y-m-d H:i:s'),'ket'=>$keterangan);
			// print_r($_data);exit;
			if($type=='add'){
				///data baru
				$res= $this->model_app->input('stok_keluar',$_data);
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil disimpan');
					}else{
					$data = array('status'=>400);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function bahan()
		{
			
			$name= $this->db->escape_str($this->input->get('name'));
			$arr = ['title'=>$name];
			$sql = $this->model_app->view_like('bahan',$arr)->result();
			$response = [];
			foreach($sql AS $row){
				$response[] = array("id"=>$row->id, "name"=>$row->title);
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
		}
		public function save_laporan(){
			$title= $this->db->escape_str($this->input->post('title'));
			$tanggal= $this->db->escape_str($this->input->post('tanggal'));
			$tanggal = date_slash($tanggal);
			// print_r($_POST);exit;
			$skrg = date("Y-m-d H:i:s");
			//sebelum ke transaksi perpindahan data, lakukan perhitungan jumlah data awal untuk periode baru.
			$list = $this->model_data->load_cc();
			
			$plus = array();
			$arr_kirim = array();
			$arr_terima = array();
			
			$x = $this->model_stok->get_current_mutasi($list);
			foreach($x as $idm=>$stk){
				$arr_kirim[] = array(
				"id" => null,
				"id_bahan" => $idm,
				"jumlah" => $stk, 
				"create_date" => $tanggal,
				"ket" => "Data sisa periode",
				"stat" => 1
				);
			}
			// print_r($arr_kirim);exit;
			$plus = array();
			foreach($arr_kirim as $tes){
				if(!isset($plus[$tes['id_bahan']])){
					$plus[$tes['id_bahan']] = $tes['jumlah'];
				}
				else{
					$plus[$tes['id_bahan']] += $tes['jumlah'];
				}
			}
			
			
			$a = $this->model_stok->get_stok_keluar($list);
			foreach($a as $idmaster=>$stok){
				$pls = 0;
				if(isset($plus[$idmaster])){
					$pls = $plus[$idmaster];
				}
				
				$stok_akhir =  $pls - $stok;
				
				$arr_terima[] = array(
				"id" => null,
				"id_bahan" => $idmaster,
				"jumlah" => $stok_akhir,
				"create_date" => $skrg, 
				"ket" => "Data awal periode",
				"stat" => 1
				);
			}
			// print_r($arr_terima);exit;
			
			$id_project = $this->model_stok->get_last_id($title,$tanggal);
			$sql = query("INSERT INTO history_stok 
			SELECT NULL, 
			$id_project,
			'stok_masuk', 
			id_bahan, 
			create_date,
			jumlah, 
			ket, 
			stat 
			FROM 
			stok_masuk");
			
			$sql = query("INSERT INTO history_stok 
			SELECT NULL, 
			$id_project,
			'stok_keluar', 
			id_bahan, 
			create_date,
			jumlah, 
			ket, 
			stat 
			FROM 
			stok_keluar");
			
			
			$this->db->truncate("stok_masuk");
			$this->db->truncate("stok_keluar");
			
			
			$this->db->insert_batch("stok_masuk",$arr_terima);
			$data = ['status'=>200,'msg'=>'Berhasil pindah ke periode baru'];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			// create_alert("Success","Berhasil pindah ke periode baru","history");
		}
		
		
		public function print_cek(){
			$id = $this->db->escape_str($this->input->post('id'));
			$data = array('status'=>200,'id'=>$id,'encrypt_url'=>encrypt_url($id));
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}

		
	} //end CI_Controller																													