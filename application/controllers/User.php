<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class User extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login();
			$this->title = info()['title']; 
			$this->iduser = $this->session->idu; 
            $this->level = $this->session->level; 
			$this->perPage = 10;
		}
		
		public function index()
        {
			cek_menu_akses();
			$data['title'] = 'Data pengguna | '.$this->title;
			
            $cekUser = cekUser($this->iduser);
			
			
            $data['lv'] = $cekUser['lv'];
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            // Get record count 
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('user/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchPengguna';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
            $cekUser = cekUser($this->iduser);
            $data['lv'] = $cekUser['lv'];
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            // Get record count 
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
			$data['kategori'] = $this->model_app->views('type_akses')->result();
            $data['record'] = $this->model_data->getPengguna($conditions);
			$this->template->load('main/themes','user/pengguna',$data);
		}
        function ajaxPengguna()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
			}
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('user/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchPengguna';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            
            $conditions['where'] = array(
            'parent' => $this->iduser
            );
            // $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['record'] = $this->model_data->getPengguna($conditions);
            
            
            // Load the data list view 
			$this->load->view('user/ajax-pengguna',$data);
		}
		public function add_user(){
			cek_nput_post('GET');
			$tipe = $this->db->escape_str($this->input->post('tipe'));
			$where = array('kunci' => 0);
			$data['tipe'] = $tipe;
			$data['kategori'] = $this->model_app->view_where('type_akses',['pub'=>0])->result();
			$data['jenis'] = $this->model_app->view_where('jenis_cetakan',$where)->result_array();
			$this->load->view('user/form_add',$data);
			
		}
		function edit_user(){
			cek_nput_post('GET');
			$id = $this->db->escape_str($this->input->post('id'));
			$index = decrypt_url($id);
			$data['kategori'] = $this->model_app->view_where('type_akses',['pub'=>0])->result();
			$data['arr'] = $this->model_app->edit('tb_users', ['id_user'=>$index])->row();
			$this->load->view('user/form_edit', $data, false);
		}
		public function tag()
		{
			$res = $this->db->query("SELECT type_akses FROM `tb_users`");
			$TampungData = array();
			foreach($res->result_array() AS $data_tags){
				$tags = explode(',',strtolower(trim($data_tags['type_akses'])));
				if(empty($data_tags['type_akses'])){echo'';}else{
					foreach($tags as $val) {
						$TampungData[] = $val;
					}
				}
			}
			$totalTags = count($TampungData);
			$jumlah_tag = array_count_values($TampungData);
			ksort($jumlah_tag);
			if ($totalTags > 0) {
				$output = array();
				foreach($jumlah_tag as $key=>$val) {
					// $output[] = '<option value="'.$key.'">'.$key.'</options>';
					$output[] = array("id"=>$key,"name"=>$key);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
			
		}
		public function cari_tag(){
			$id  = $this->input->post('id',TRUE);
			$tag = $this->input->post('tag',TRUE);
			$exp = explode(",",$tag);
			foreach ($exp as  $row)
			{
				$data[] = array("id"=>$row,"name"=>$row);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		function simpan_pengguna(){
			cek_nput_post('GET');
			simpan_demo("Simpan");
			$type = $this->input->post('type',TRUE);
			$query = $this->db->get_where('hak_akses',['id_level'=>$this->input->post('id_level',TRUE)]);
			$row = $query->row_array();
			if($type=='new'){
				$akses ='';
				if(!empty($this->input->post('cat',TRUE))){
					$akses	= $this->input->post('cat',TRUE);
					$akses	= implode(',',$akses);
				}
				$data ='';
				if(!empty($this->input->post('data',TRUE))){
					$data_cat	= $this->input->post('data',TRUE);
					$data		= implode(',',$data_cat);
				}
				$query = $this->model_app->view_where('tb_users',['email'=>$this->input->post('mail',TRUE)]);
				if($query->num_rows() > 0){
					$arr = [
					'status'=>201,
					'title' =>'Input data',
					'msg'   =>'Data sudah ada'
					];
					}else{
					if($this->level=='admin'){
						$idlevel = '1,2,3,4,5,6';
						}elseif($this->level=='owner'){
						$idlevel = '2,3,4,5,6';
						}elseif($this->level=='keuangan'){
						$idlevel = '3,4,5,6';
						}elseif($this->level=='kasir'){
						$idlevel = '3';
						}elseif($this->level=='desain'){
						$idlevel = '5';
						}elseif($this->level=='operator'){
						$idlevel = '6';
					}
					
					if($this->input->post('password',TRUE))
					{
						$password = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
						$data_post 	= [
						"nama_lengkap"	=> $this->input->post('title',TRUE),
						"app_secret"	=> $this->input->post('jabatan',TRUE),
						"password"	    => $password,
						"alamat"	    => $this->input->post('alamat',TRUE),
						"email"	        => $this->input->post('mail',TRUE),
						"no_hp"	        => $this->input->post('phone',TRUE),
						"tgl_daftar"	=> $this->input->post('daftar',TRUE),
						"aktif"	        => $this->input->post('aktif',TRUE),
						"level"	    	=> $row['level'],
						"parent"	    => $this->iduser,
						"idlevel"	    => $idlevel,
						"id_level"	    => $this->input->post('id_level',TRUE),
						"idmenu"	    => $data,
						"type_akses"	=> $akses
						];
					}
					else
					{
						$data_post 	= [
						"nama_lengkap"	=> $this->input->post('title',TRUE),
						"app_secret"	=> $this->input->post('jabatan',TRUE),
						"alamat"	    => $this->input->post('alamat',TRUE),
						"email"	        => $this->input->post('mail',TRUE),
						"no_hp"	        => $this->input->post('phone',TRUE),
						"tgl_daftar"	=> $this->input->post('daftar',TRUE),
						"aktif"	        => $this->input->post('aktif',TRUE),
						"level"	    	=> $row['level'],
						"idlevel"	    => $idlevel,
						"parent"	    => $this->iduser,
						"id_level"	    => $this->input->post('id_level',TRUE),
						"idmenu"	    => $data,
						"type_akses"	=> $data
						];
					}
					$insert = $this->model_app->input('tb_users',$data_post);
					if($insert['status']=='ok')
					{
						$arr = [
						'status'=>200,
						'title' =>'Input data',
						'msg'   =>'Data berhasil Input'
						];
					}
					else
					{
						$arr = [
						'status'=>201,
						'title' =>'Input data',
						'msg'   =>'Data gagal Input'
						];
					}
				}
			}
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id',TRUE));
				$data ='';
				$query = $this->db->get_where('hak_akses',['id_level'=>$this->input->post('id_level',TRUE)]);
				$row = $query->row_array();
				$akses ='';
				if(!empty($this->input->post('cat',TRUE))){
					$akses	= $this->input->post('cat',TRUE);
					$akses	= implode(',',$akses);
				}
				if(!empty($this->input->post('data',TRUE))){
					$data_cat	= $this->input->post('data',TRUE);
					$data		= implode(',',$data_cat);
				}
				if($this->input->post('password',TRUE))
				{
					$password = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"app_secret"	=> $this->input->post('jabatan',TRUE),
					"password"	    => $password,
					"alamat"	    => $this->input->post('alamat',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"id_level"	    => $this->input->post('id_level',TRUE),
					"idmenu"	    => $data,
					"type_akses"	=> $akses
					];
				}
				else
				{
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"app_secret"	=> $this->input->post('jabatan',TRUE),
					"alamat"	    => $this->input->post('alamat',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"id_level"	    => $this->input->post('id_level',TRUE),
					"idmenu"	    => $data,
					"type_akses"	=> $akses
					];
				}
				
				$update = $this->model_app->update('tb_users',$data_post, ['id_user'=>$postid]);
				if($update['status']=='ok')
				{
					$arr = [
					'status'=>200,
					'title' =>'Update data',
					'msg'   =>'Data berhasil diupdate'
					];
				}
				else
				{
					$arr = [
					'status'=>201,
					'title' =>'Update data',
					'msg'   =>'Data gagal diupdate'
					];
				}
			}
			if($type==''){
				$arr = [
				'status'=>201,
				'title' =>'Input data',
				'msg'   =>'Data gagal'
				];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function delete_user()
		{
			cek_nput_post('GET');
			simpan_demo("Hapus");
			$id = decrypt_url($this->input->post('id',TRUE));
			$cek_posting = cek_posting($id);
			if($cek_posting===false){
				$cek = $this->model_app->view_where('tb_users', ['id_user'=>$id]);
				if($cek->num_rows() > 0)
				{
					$row = $cek->row();
					if($row->level!='admin'){
						$delete = $this->model_app->hapus('tb_users', ['id_user'=>$id]);
						if($delete['status']=='ok')
						{
							$arr = ['status'=>'ok','id'=>$cek_posting];
							}else{
							$arr = ['status'=>'error'];
						}
						}else{
						$arr = ['status'=>'error_delete','id'=>$cek_posting];
					}
					}else{
					$arr = ['status'=>'error'];
				}
				
				}else{
				$arr = ['status'=>'error_delete','id'=>$cek_posting];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function profil()
		{
			
			$data['title'] = 'Edit Data | ' .$this->title;
			$id = $this->uri->segment(3);
			$id = decrypt_url($id);
			if (isset($_POST['submit'])){
				cek_crud_akses(9);
				save_demo_redirect('user/profil');
				$pid = $this->input->post('id');
				if($pid !=''){
					if(!empty($this->input->post('akses',TRUE))){
						$akses	= $this->input->post('akses',TRUE);
						$akses	= implode(',',$akses);
					}
					
					$data_cat = $this->input->post('data');
					$input_data=implode(',',$data_cat);
					$level = $this->input->post('level');
					$level=explode(',',$level);
					if($this->input->post('password') ==''){
						$data = array('idmenu'=>$input_data,
						'nama_lengkap'=>$this->db->escape_str($this->input->post('nama')),
						'app_secret'=>$this->db->escape_str($this->input->post('jabatan')),
						'email'=>$this->db->escape_str($this->input->post('email')),
						'id_level'=>$level[0],
						'level'=>$level[1],
						'type_akses'=>$akses,
						'aktif'=>$this->input->post('aktif'));
						}else{
						$data = array('idmenu'=>$input_data,
						'nama_lengkap'=>$this->db->escape_str($this->input->post('nama')),
						'app_secret'=>$this->db->escape_str($this->input->post('jabatan')),
						'email'=>$this->db->escape_str($this->input->post('email')),
						'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
						'id_level'=>$level[0],
						'level'=>$level[1],
						'type_akses'=>$akses,
						'aktif'=>$this->input->post('aktif'));
					}
					$where = array('sesi_login' => $this->input->post('id'));
					$res= $this->model_app->update('tb_users', $data, $where);
					if($res['status']=='ok'){
						$this->session->set_flashdata('message', '<script>notif("Data di simpan","success");</script>');
						redirect('user/profil/'.$pid);
						}else{
						$this->session->set_flashdata('message', '<script>notif("Data gagal simpan","danger");</script>');
						redirect('user/profil/'.$pid);
					}
					}else{
					redirect('home/');
				}
				
				exit;
				}else{
				cek_crud_akses(8,'json');
				$data['judul'] = 'Form edit';
				$data['kategori'] = $this->model_app->view_where('type_akses',['pub'=>0])->result();
				if(!empty($id)){
					$cek = $this->model_app->edit('tb_users', array('id_user' => $id));
					if($cek->num_rows() > 0){
						$data['rows'] = $cek->row_array();
						$this->template->load('main/themes','user/edit_profil',$data);
						}else{
						redirect('home/');
					}
					}else{
					$id = $this->session->idu;
					$cek = $this->model_app->edit('tb_users', array('id_user' => $id));
					if($cek->num_rows() > 0){
						$data['rows'] = $cek->row_array();
						$this->template->load('main/themes','user/edit_profil',$data);
						}else{
						redirect('home/');
					}
				}
			}
		}
		
		
		function hapus_user(){
			cek_nput_post('GET');
			simpan_demo('Hapus');
			$id = $this->db->escape_str($this->input->post('id'));
			$where = array('id_user' => $id);
			
			$cek_invoice = $this->model_app->edit('invoice', $where);
			if($cek_invoice->num_rows()>0){
				$data = array('status'=>400,'msg'=>'User sudah memiliki order tidak bisa dihapus');
				}else{
				$search = $this->model_app->edit('tb_users', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					if($row['level']=='admin' AND $row['parent']==0){
						$data = array('status'=>'error_hapus_admin','msg'=>'Admin tidak boleh dihapus');
						}else{
						$res = $this->model_app->delete('tb_users',$where);
						if($res==true){
							$data = array('status'=>200,'title'=>'Hapus data','msg'=>'Data berhasil dihapus');
							}else{
							$data = array('status'=>400,'title'=>'Hapus data','msg'=>'Data gagal dihapus');
						}
					}
					}else{
					$data = array('status'=>500,'msg'=>'Data gagal dihapus');
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}																																							