<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Pencarian extends CI_Controller
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
		
		public function data()
		{
			cek_menu_akses();
			$data['title'] ='Data Produk | '.info()['title'];
			$data['judul'] ='Data Produk';
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getProduk($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataProduk'; 
			$config['base_url']    = base_url('produk/cariProduk'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Produk'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'limit' => $this->perPage 
			); 
			
			$data['jenis'] = $this->model_app->view_where('jenis_cetakan',['pub'=>'Y','kunci'=>0])->result(); 
			$data['result'] = $this->model_data->getProduk($conditions); 
			$this->template->load('main/themes','produk/produk',$data);
		}
		
		public function cari_invoice(){
			cek_nput_post('GET');
			$idorder = $this->db->escape_str($this->input->post('keywords'));
			$search = $this->model_app->view_where('invoice', array('id_transaksi'=>$idorder));
			if($search->num_rows()>0){
				$row = $search->row();
				if($row->status=='batal'){
					echo "ada";exit();
				}
				$data['posts'] = $idorder;
				$data['pilihan'] = $this->model_app->view('tb_users');
				$data['kategori'] = $this->model_app->view_where('type_akses',['status'=>1,'pub'=>0])->result();
				$this->load->view('produk/cari_invoice', $data, false); 
				}else{
				echo "error";
			}
		}
		public function cari_invoice_order(){
			cek_nput_post('GET');
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			$limit = $this->perPage; 
			$keywords = $this->input->post('keywords'); 
			if(!empty($keywords)){ 
				if ( substr($keywords,0,1 )== '0' ){
					$conditions['where'] = array('konsumen.no_hp' => $keywords); 
					}elseif(substr($keywords,0,2 )== '62' ){
					$conditions['where'] = array('konsumen.no_hp' => clearnohp($keywords)); 
					}elseif(substr($keywords,0,3 )== '+62' ){
					$conditions['where'] = array('konsumen.no_hp' => clearnohp($keywords)); 
					}elseif(substr($keywords,0,4 )== 'TRX-' ){
					$conditions['where'] = array('invoice.id_transaksi' => $keywords); 
					}elseif(substr($keywords,0,1 )== 'P' ){
					$conditions['where'] = array('konsumen.id_member' => $keywords); 
					}else{
					$conditions['search']['keywords'] = $keywords; 
				}
			}
			
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getCariInv($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#hasil_cari_order'; 
			$config['base_url']    = base_url('pencarian/cari_invoice_order'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'cariFilterOrder'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			unset($conditions['returnType']); 
			$data['posts'] = $this->model_data->getCariInv($conditions); 
			
			// print_r($posts);
			$data['pilihan'] = $this->model_app->view('tb_users');
			// Load the data list view 
			$this->load->view('pencarian/ajax-cari-order', $data, false); 
		}
		
		public function cari_operator(){
			cek_nput_post('GET');
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			
			$limit = $this->perPage; 
			$keywords = $this->input->post('keywords'); 
			if(!empty($keywords)){ 
				if ( substr($keywords,0,1 )== '0' ){
					$conditions['where'] = array('konsumen.no_hp' => $keywords); 
					}elseif(substr($keywords,0,2 )== '62' ){
					$conditions['where'] = array('konsumen.no_hp' => clearnohp($keywords)); 
					}elseif(substr($keywords,0,3 )== '+62' ){
					$conditions['where'] = array('konsumen.no_hp' => clearnohp($keywords)); 
					}elseif(is_numeric($keywords)){
					$conditions['where'] = array('invoice.id_transaksi' => $keywords); 
					}else{
					$conditions['search']['keywords'] = $keywords; 
				}
			}
			
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getCariInv($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#hasil_cari_order'; 
			$config['base_url']    = base_url('pencarian/cari_invoice_order'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'cariFilterOrder'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			unset($conditions['returnType']); 
			$data['posts'] = $this->model_data->getCariInv($conditions); 
			
			// print_r($posts);
			$data['pilihan'] = $this->model_app->view('tb_users');
			// Load the data list view 
			$this->load->view('pencarian/ajax-cari-order', $data, false); 
		}
		public function open_folder(){
			$folder = $this->input->post('folder'); 
			$explorer = getenv('SystemRoot') . '\\explorer.exe';
			shell_exec("$explorer /n,/e,$folder");
			$data = ["timer"=>600,"msg"=>"Folder sedang dibuka"];
			echo json_encode($data);
		}
		
		public function update_desain(){
			$keywords = $this->input->post('keywords'); 
			$cek = $this->model_app->view_where('invoice',['id_transaksi'=>$keywords]);
			if($cek->num_rows() > 0)
			{
				$row = $cek->row();
				if($row->id_desain >0){
					$_cek = $this->model_app->view_where('tb_users',['id_user'=>$row->id_desain])->row();
					$data = ['status'=>201,"timer"=>1000,"msg"=>"Desain sudah diupdate atas nama ". $_cek->nama_lengkap];
					}else{
					$update = $this->model_app->update("invoice",['id_desain'=>$this->iduser],['id_transaksi'=>$keywords]);
					if($update['status']=='ok'){
						$data = ['status'=>200,"timer"=>600,"msg"=>"Desain berhasil diupdate"];
						}else{
						$data = ['status'=>400,"timer"=>600,"msg"=>"Desain gagal diupdate"];
					}
				}
				}else{
				$data = ['status'=>400,"timer"=>600,"msg"=>"Invoice tidak ditemukan"];
			}
			echo json_encode($data);
		}
		public function cek_folder(){
			$folder = $this->input->post('folder'); 
			$exp = explode('/',$folder);
			//cek folder A-Z
			$_folder = '//'.$exp[2].'/'.$exp[3].'/'.$exp[4];
			if (!file_exists($_folder)) {
				mkdir($_folder,0777,true);
			}
			
			if ($folder == ''){
				$pesan = ["timer"=>600,"msg"=>"Isi dulu nama foldernya"];
				}else{	
				if (!is_dir($folder)) {
					mkdir($folder,0777,true);
					$pesan = ["timer"=>600,"msg"=>"Folder sudah dibuat"];
					}else{
					$pesan = ["timer"=>600,"msg"=>"Folder sudah ada"];
				}
			}
			
			echo json_encode($pesan);
			
		}
		public function cari_invoice_desain(){
			
			$id_invoice = $this->input->post('id'); 
			$id_desain = $this->input->post('id_desain'); 
			$where = ['id_transaksi'=>$id_invoice];
			$cek = $this->model_app->view_where('invoice',$where);
			if($cek->num_rows() > 0)
			{
				$data['status'] =200;
				$row = $cek->row();
				$data['konsumen'] = $this->model_app->view_where('konsumen',['id'=>$row->id_konsumen])->row();
				$cek_desain = $this->model_data->get_desain("invoice.id_transaksi='$row->id_transaksi'");
				if(!empty($cek_desain)){
					if($cek_desain->jenis_cetakan !=''){
						$data['save_file'] = ['invoice'=>$cek_desain->id_transaksi,'ket'=>$cek_desain->tgl_trx];
						}else{
						$data['save_file'] = ['invoice'=>$id_invoice,'ket'=>$cek_desain->jenis_cetakan];
					}
					}else{
					$data['save_file'] = ['invoice'=>$id_invoice,'ket'=>'Desain'];
				}
				$data['desain'] = $this->model_app->view_where('tb_users',['id_user'=>$row->id_desain])->row();
				$data['folder'] = ["computer_name"  =>pengaturan('computer_name')];
				$data['invoice'] = $row;
				$data['detail'] = $this->model_data->get_detail("invoice.id_transaksi='$row->id_transaksi'");
				
				}else{
				$data['status'] =400;
				$data['msg'] ='Invoice tidak ditemukan';
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function cari_desain(){
			$searchTerm = $this->input->post('searchTerm'); 
			if(!isset($searchTerm)){ 
				$result = $this->model_app->view_like('tb_users',array('nama_lengkap'=>$searchTerm));
				}else{ 
				$result = $this->model_app->view_like('tb_users',array('nama_lengkap'=>$searchTerm));
			} 
			
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id_user,"name"=>$row->nama_lengkap);
			}
			 
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}																																																																																																																											