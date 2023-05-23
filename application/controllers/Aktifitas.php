<?php	
	defined('BASEPATH') or exit('No direct script access allowed');	
	
	class Aktifitas extends CI_Controller	
	{		
		public function __construct()		
		{			
			parent::__construct();		
			
			cek_session_login();
			$this->load->helper('date');			
			// $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");			
			$this->perPage = 10; 		
			$this->iduser = $this->session->idu;
			$this->title = info()['title']; 
		}		
		public function transaksi(){
			cek_menu_akses();
			$format = "%Y-%m-%d";			
			$harian = mdate($format);			
			$data['title'] = 'Log Transaksi | '.$this->title;		
			$data['dari'] =tgl_dari_slash();			
			$data['sampai'] =tgl_sampai_slash();			
			 
			$data['user'] = $this->model_app->view('tb_users');			
			$conditions['returnType'] = 'count'; 	
			
            $conditions['search']['dari'] = tgl_awal_dash(); 
            $conditions['search']['sampai'] = $harian; 
			
			$totalRec = $this->model_data->getLog($conditions); 			
			// Pagination configuration 			
			$config['target']      = '#dataLog'; 			
			$config['base_url']    = base_url('transaksi/ajaxLog'); 			
			$config['total_rows']  = $totalRec; 			
			$config['per_page']    = $this->perPage; 			
			
			// Initialize pagination library 			
			$this->ajax_pagination->initialize($config); 			
			
			// Get records 			
			$conditions = array( 			
			'limit' => $this->perPage 			
			); 			
			$conditions['search']['dari'] = tgl_awal_dash(); 
            $conditions['search']['sampai'] = $harian; 
			$data['result'] = $this->model_data->getLog($conditions); 			
			
			$this->template->load('main/themes','aktifitas/aktifitas',$data);			
		}
		public function ajaxLog(){
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
            $dari = $this->input->post('dari'); 
            $sampai = $this->input->post('sampai'); 
            $user = $this->input->post('user'); 
			if(!empty($user)){ 
				$conditions['where'] = array(			
				'kas_masuk.id_user' => $user			
				);	
			} 
            if(!empty($dari)){
                $_dari = date_slash($dari);
                $conditions['search']['dari'] = $_dari; 
			}
            if(!empty($sampai)){ 
                $_sampai = date_slash($sampai);
                $conditions['search']['sampai'] = $_sampai; 
			}
            
			
            if(!empty($sortBy)){ 
                $conditions['search']['sortBy'] = $sortBy; 
			} 
			
            // Get record count 
            $conditions['returnType'] = 'count'; 
            $totalRec = $this->model_data->getLog($conditions); 
            
            // Pagination configuration 
            $config['target']      = '#dataLog'; 
            $config['base_url']    = base_url('aktifitas/ajaxLog'); 
            $config['total_rows']  = $totalRec; 
            $config['per_page']    = $limit; 
            $config['link_func']   = 'FilterLog'; 
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config); 
            // Get records 
            
			$conditions = array( 
            'start' => $offset, 
            'limit' => $limit 
			); 
			if(!empty($user)){ 
				$conditions['where'] = array(			
				'kas_masuk.id_user' => $user			
				);	
			} 
			if(!empty($dari)){
                $_dari = date_slash($dari);
                $conditions['search']['dari'] = $_dari; 
			}
            if(!empty($sampai)){ 
                $_sampai = date_slash($sampai);
                $conditions['search']['sampai'] = $_sampai; 
			}
            
			
            // print_r($conditions);
			
            unset($conditions['returnType']); 
			
            $data['result'] = $this->model_data->getLog($conditions); 
            
            // Load the data list view 
            $this->load->view('aktifitas/ajax-aktifitas', $data); 
		}
		
	}																																																																																																							