<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
	
	if ( ! function_exists('get_id_transaksi'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function get_id_transaksi($id)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('id_transaksi,id_konsumen,id_marketing','invoice',['id_invoice'=>$id]);
			if($cek->num_rows() > 0)
			{
				return ['nomor_order'=>$cek->row()->id_transaksi,'idkonsumen'=>$cek->row()->id_konsumen,'id_fo'=>$cek->row()->id_marketing]; 
				}else{
				return false; 
			}
		}
	}
 
	if ( ! function_exists('cek_device_status'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function cek_device_status()
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih('device_status','device');
			if($cek->num_rows() > 0)
			{
				if($cek->row()->device_status=='connect')
				{
					return true; 
					}else{
					return false; 
				}
				}else{
				return false; 
			}
		}
	}
	
	if ( ! function_exists('get_device'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function get_device()
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih('device','device');
			if($cek->num_rows() > 0)
			{
				return $cek->row()->device; 	
				}else{
				return false; 
			}
		}
	}
	
	if ( ! function_exists('cek_member'))
	{
		/**
			* Code Cek Akun 
			* 
			@param int 
			@return string
		*/
		function cek_member($val)
		{
			$ci = & get_instance();
			return $ci->db->query("SELECT jenis_member FROM konsumen where id='$val'")->row()->jenis_member;
		}
	}
	
	if ( ! function_exists('member'))
	{
		/**
			* Code Cek Akun 
			* 
			@param int 
			@return string
		*/
		function member($val)
		{
			$ci = & get_instance();
			return $ci->db->query("SELECT `title` FROM `member` WHERE id=$val")->row()->title;
		}
	}
	
	if ( ! function_exists('cek_akun'))
	{
		/**
			* Code Cek Akun 
			* 
			@param int 
			@return string
		*/
		function cek_akun($val)
		{
			$ci = & get_instance();
			$title = $ci->db->query("SELECT status FROM jenis_pengeluaran where id='$val'")->row();
			return $title->status;
		}
	}
	
	if ( ! function_exists('cek_jenis_lembaga'))
	{
		/**
			* Cek Jenis Lembaga
			*
			@param int 
			@return string
		*/
		function cek_jenis_lembaga($val)
		{ $ci = & get_instance(); 
			$title = $ci->model_app->pilih_where('title','jenis_lembaga',['id'=>$val])->row(); 
			return $title->title; 
		}
	}
	
	if ( ! function_exists('cekUser'))
	{
		/**
			* Code Cek user 
			* 
			@param int 
			@return array
		*/
		function cekUser($val)
		{
			$ci = & get_instance();
			$sql_cek = $ci->db->query("SELECT * FROM tb_users where id_user='$val' AND aktif='Y'");
			if($sql_cek->num_rows() >0)
			{
				$rows=$sql_cek->row_array();
				$data = array(
				'status'=>1,
				'id'=>$rows['id_user'],
				'email'=>$rows['email'],
				'nohp'=>$rows['no_hp'],
				'nama'=>$rows['nama_lengkap'],
				'img'=>$rows['foto'],
				'idlv'=>$rows['idlevel'],
				'parent'=>$rows['parent'],
				'alamat'=>$rows['alamat'],
				'idmenu'=>$rows['idmenu'],
				'lv'=>$rows['id_level']);
				}else{
				$data = array('status'=>0,'email'=>'','nohp'=>'','id'=>0,'nama'=>'','img'=>'','idlv'=>'','parent'=>'','web'=>'','secret'=>'','alamat'=>'','percetakan'=>'','idmenu'=>'','lv'=>'');
			}
			return $data;
		}
	}
	
	if ( ! function_exists('cek_tabel'))
	{
		/**
			* Code Cek tabel 
			* 
			@param int 
			@return bolean
		*/
		function cek_tabel()
		{
			$ci = & get_instance();
			$tables = $ci->db->list_tables();
			if(empty($tables))
			{
				$ci->session->sess_destroy();
				redirect('error/401');
				exit;
			}
		}
		function ada_tabel(){
			$ci = & get_instance();
			$tables = $ci->db->list_tables();
			if(!empty($tables))
			{
				$ci->session->sess_destroy();
				redirect('error/401');
				exit;
			}
		}
	}
	
	if ( ! function_exists('cek_ip'))
	{
		/**
			* Code cek ip
			* 
			@param string 
			@return bolean
		*/
		function cek_ip($ip)
		{
			$ci = & get_instance();
			$query = $ci->db->query("SELECT ip FROM user_agent where ip='$ip'");
			
			if ($query->num_rows() <=0)
			{
				$ci->session->sess_destroy();
				redirect('error/401');
				exit;
			}
			
		}
	}
	
	if ( ! function_exists('cek_demo'))
	{
		
		/**
			* Code Cek demo 
			* 
			@return array
		*/
		function cek_demo()
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih('demo','info');
			$data = array();
			if ($query->num_rows()>=1)
			{
				if($query->row()->demo=='Y' AND $ci->session->level!='admin'){
					$data = ['status'=>200,'msg'=>'Saved user'];
					}elseif($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent!=0){
					$data = ['status'=>200,'msg'=>'Saved admin'];
					}else{
					$data = ['status'=>400];
				}
				}else{
				$data = ['status'=>400];
			}
			return $data;
		}
	}
	
	if ( ! function_exists('cek_demo_admin'))
	{
		function cek_demo_admin(){
			$ci = & get_instance();
			$query = $ci->model_app->pilih('demo','info');
			$data = array();
			if ($query->num_rows() > 0){
				if($query->row()->demo=='Y' AND $ci->session->level!='admin'){
					$data = ['status'=>200,'msg'=>'Saved user'];
					}elseif($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent!=0){
					$data = ['status'=>200,'msg'=>'Saved admin'];
					}else{
					$data = ['status'=>400,'msg'=>'erro request'];
				}
				// $data = ['status'=>200,'msg'=>'Saved user'];
				}else{
				$data = ['status'=>400,'msg'=>'erro request'];
			}
			return $data;
		}
	}
	
	if ( ! function_exists('is_admin_update'))
	{
		function is_admin_update(){
			$ci = & get_instance();
			$query = $ci->model_app->pilih('demo','info');
			$data = array();
			if ($query->num_rows() > 0){
				if($ci->session->level=='admin' AND $ci->session->idparent==0){
					$data = ['status'=>true,'msg'=>'Saved admin'];
					}else{
					$data = ['status'=>false,'msg'=>'erro request'];
				}
				// $data = ['status'=>200,'msg'=>'Saved user'];
				}else{
				$data = ['status'=>false,'msg'=>'erro request'];
			}
			return $data;
		}
	}
	
	if ( ! function_exists('is_admin'))
	{
		function is_admin(){
			$ci = & get_instance();
			$query = $ci->model_app->pilih('demo','info');
			$data = array();
			if ($query->num_rows() > 0){
				if($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent==0){
					$data = ['status'=>true,'msg'=>'Saved admin'];
					}else{
					$data = ['status'=>false,'msg'=>'erro request'];
				}
				// $data = ['status'=>200,'msg'=>'Saved user'];
				}else{
				$data = ['status'=>false,'msg'=>'erro request'];
			}
			return $data;
		}
	}
	
	
	
	if ( ! function_exists('cek_crud_akses'))
	{
		/**
			* Code Cek Crud akses 
			* 
			@param int
			@param string
			@return string
		*/
		function cek_crud_akses($str,$tipe=''){
			$ci = & get_instance();
			$query = $ci->model_cek->cek_crud($str);
			if ($query->num_rows()==0){
				$_arrNilai = explode(',', $ci->session->type_akses);
				if($tipe=='json'){
					if (!in_array($str, $_arrNilai)){
						$data = ['status'=>401,'msg'=>'akses ditolak'];
						}else{
						$data = ['status'=>401,'msg'=>'akses ditolak'];
					}
					$ci->output
					->set_content_type('application/json')
					->set_output(json_encode($data));
					exit;
					}else{
					if (!in_array($str, $_arrNilai)) {
						redirect('errorakses');
						exit;
					}
				}
			}
		}
	}
	
	if ( ! function_exists('cek_del_bayar'))
	{
		/**
			* Code Cek del bayar 
			* 
			@param int
			@param int
			@return json
		*/
		function cek_del_bayar($str,$key){
			$ci = & get_instance();
			$query = $ci->model_cek->cek_crud($str);
			if ($query->num_rows()==0){
				if($str==10 AND $key==0){
					$data = ['status'=>401,'msg'=>'akses ditolak'];
					$ci->output
					->set_content_type('application/json')
					->set_output(json_encode($data));
					exit;
				}
			}
		}
	}
	
	if ( ! function_exists('cek_type_akses'))
	{
		function cek_type_akses($idakses,$iduser,$id,$mod){
			$ci = & get_instance();
			$query = $ci->model_cek->cek_akses($idakses,$iduser);
			$total_order = $ci->model_app->sum_data('total_bayar','invoice',['id_invoice'=>$id]);
			$total_bayar = $ci->model_app->sum_data('jml_bayar','bayar_invoice_detail',['id_invoice'=>$id]);
			$data = array();
			if ($query->num_rows()>0){
				$data = ['status'=>200,'id'=>$id,'mod'=>$mod,'total_order'=>$total_order,'total_bayar'=>$total_bayar,'msg'=>'akses ok'];
				}else{
				$data = ['status'=>401,'msg'=>'akses ditolak'];
			}
			
			$ci->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
			exit;
		}
	}
	
	if ( ! function_exists('database_demo_admin'))
	{
		function database_demo_admin($val='')
		{
			$ci = & get_instance();
			$cek = cek_demo_admin();
			if($cek['status'] ==200){
				$data = array('status'=>200,'msg'=>'Data berhasil '.$val.' (demo only)');
				$ci->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				exit;
			}
		}
	}
	
	if ( ! function_exists('update_demo_admin'))
	{
		function update_demo_admin($user)
		{
			$ci = & get_instance();
			$cek = is_admin_update();
			if($cek['status'] ==false){
				$data[] = '[[b;red;black]'.$user.'] Tidak punya akses';
				$data[] .= 'help/? | version | readme | clear | wa | ping';
				echo json_encode($data);
				exit;
			}
			
		}
	}
	
	if ( ! function_exists('database_demo'))
	{
		function database_demo($val=''){
			$ci = & get_instance();
			$cek = cek_demo();
			if($cek['status'] ==200){
				$data = array('status'=>200,'msg'=>'Data berhasil '.$val.' (demo only)');
				$ci->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				exit;
			}
		}
	}
	
	if ( ! function_exists('menu_demo'))
	{
		function menu_demo(){
			$ci = & get_instance();
			$cek = cek_demo();
			if($cek['status'] ==200){
				$data = array('type'=>'edit','status'=>200,'msg'=>'Data berhasil disimpan (demo only)');
				$ci->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				exit;
			}
		}
	}
	
	if ( ! function_exists('save_demo_redirect'))
	{
		function save_demo_redirect($redir=''){
			$ci = & get_instance();
			$cek = cek_demo();
			if($cek['status'] ==200){
				$ci = & get_instance();
				$ci->session->set_flashdata('message', '<script>notif("Data berhasil di simpan (demo only)","success");</script>');
				redirect($redir);
				exit;
			}
		}
	}
	
	if ( ! function_exists('simpan_demo'))
	{
		function simpan_demo($val=''){
			$ci = & get_instance();
			$cek = cek_demo();
			if($cek['status'] ==200){
				$data = array('status'=>200,'msg'=>'Data berhasil '.$val.' (demo)');
				$ci->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
		}
	}
	
	if ( ! function_exists('input_konsumen_demo'))
	{
		function input_konsumen_demo(){
			$ci = & get_instance();
			$cek = cek_demo();
			if($cek['status'] ==200){
				$data        = array(
				'idk'        => 0,
				'id_member'  => 0,
				'panggilan'  => "",
				'nama'       => "",
				'telp'       => "",
				'referal'    => "",
				'alamat'     => "",
				'perusahaan' => "",
				'msg' => "Data berhasil disimpan (Demo Only)",
				'hasil'      => 'sukses'
				);
				$ci->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				exit;
			}
		}			
	}										
	
	if ( ! function_exists('cek_menu_akses'))
	{
		function cek_menu_akses(){
			$ci = & get_instance();
			$session = $ci->session->idu;
			$link_menu = $ci->uri->uri_string();
			// echo  $session;
			if(isset($session)){
				$menu = $ci->db->query("SELECT * FROM menuadmin WHERE link='$link_menu' AND aktif='Y'")->row_array();
				$user = $ci->db->query("SELECT * FROM tb_users WHERE id_user='$session' AND aktif='Y'")->row_array();
				$people = explode(",",$user['idmenu']);
				if (!in_array($menu['idmenu'], $people)){
					redirect(base_url().'errorakses');
				}
				}else{
				redirect(base_url());
			}
		}
	}	
	
	if ( ! function_exists('cek_session_login'))
	{
		function cek_session_login($params=0){
			$ci = & get_instance();
			$session = $ci->session->level;
			if($params==0)
			{
				if (!isset($session))
				{
					$data = ['status'=>401,'msg'=>'Login required'];
					$ci->output
					->set_status_header(401)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
					exit;
				}
				
			}
			elseif($params==1)
			{
				if (!isset($session)){
					redirect('error/401');
				}
				}else{
				if (!isset($session)){
					redirect('error/401');
				}
			}
		}
	}
	
	
	if ( ! function_exists('cekSessiLogin'))
	{
		function cekSessiLogin(){
			$ci = & get_instance();
			$ip = gethostbyname(trim(exec("hostname")));
			$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$session = $ci->session->userdata('idu');
			$ids = $ci->session->userdata('ids');
			$rses = $ci->db->query("SELECT sesi_login FROM tb_users where id_user='$session'")->row_array();
			if ($rses['sesi_login'] != $ids) {
				session_destroy();
				echo 'logout';
			}
			if ($ci->session->level==''){
				echo 'logout';
				exit;
			} 
		}	
	}				
	
	if ( ! function_exists('cek_session_admin'))
	{
		function cek_session_admin($params='')
		{
			$ci = & get_instance();
			$session = $ci->session->userdata('level');
			if($params==0)
			{
				echo json_encode(['status'=>'error_hapus_admin','msg'=>'Admin tidak boleh dihapus']);exit;
			}
			elseif($params==1)
			{
				if ($session != 'admin')
				{
					redirect('error/401');
				}
				}else{
				if ($session != 'admin')
				{
					redirect('error/401');
				}
			}
		}
	}			
	
	if ( ! function_exists('cek_input_akses'))
	{
		
		/**
			@param array
			ex : array('metode'=>'GET',
			'idakses'=>1,
			'iduser'=>1,
			'value'=>'Simpan',
			'id'=>1,
			'mod'=>'edit',
			'tipe'=>'json',
			'redir'=>'home'
			); 
			*
			$params['idakses'] : int | 1 - 10
			$params['iduser']  : int | 1 etc
			$params['id']      : int | 1 etc
			$params['metode']  : string | GET/POST 
			$params['value']   : string | simpan/edit/hapus
			$params['mod']     : string | edit
			$params['tipe']    : string | json/none
			$params['redir']   : string | home
			
		*/
		
		
		function cek_input_akses($params=array())
		{
			
			$ci = & get_instance();
			
			//cek request GET/POST
			if ($ci->input->server('REQUEST_METHOD') === $params['metode']) 
			{
				exit('BAD_REQUEST');
			}
			//cek sesi login
			$session = $ci->session->level;
			if (!isset($session))
			{
				//jika tipe json jalankan
				if($params['tipe']=='json'){
					$data = ['status'=>401,'msg'=>'Login required'];
					$ci->output
					->set_content_type('application/json')
					->set_output(json_encode($data));
					exit;
					}else{
					redirect(base_url($params['redir']));
				}
			}
			//cek status demo jika aktif = Y jalankan jika aktif = N skip
			$cek = cek_demo();
			if($cek['status'] ==200)
			{
				//$params['value'] : string
				$data = array('status'=>200,'msg'=>'Data berhasil '.$params['value'].' (demo)');
				$ci->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				exit;
			}
			
			$total_order =0;
			$total_bayar =0;
			//$params['id'] : int
			if($params['id'] >0 ){
				$total_order = $ci->model_app->sum_data('total_bayar','invoice',['id_invoice'=>$params['id']]);
				$total_bayar = $ci->model_app->sum_data('jml_bayar','bayar_invoice_detail',['id_invoice'=>$params['id']]);
			}
			$data = array();
			
			/*
				cek type akses jika ada skip
				*
				$params['id']     : int
				$params['iduser'] : int
				$params['iduser'] : int
				$params['mod']    : string
				*
			*/
			$query = $ci->model_cek->cek_akses($params['idakses'],$params['iduser']);
			if ($query->num_rows()>0){
				$data = ['status'=>200,'id'=>$params['id'],'mod'=>$params['mod'],'total_order'=>$total_order,'total_bayar'=>$total_bayar,'msg'=>'akses ok'];
				}else{
				$data = ['status'=>403,'msg'=>'akses ditolak'];
			}
			//output typ json
			$ci->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			exit;
		}
		
	}																																			