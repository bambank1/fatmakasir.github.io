<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class History extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->perPage = 10; 
			$this->title = info()['title']; 
		}
		
		public function index($id=null)
		{
			cek_menu_akses();
			
			$data['title'] ="History | ".$this->title;
			//$data['id'] =$id;
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getHistory($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListHistory'; 
			$config['base_url']    = base_url('main/ajaxHistory'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			
			$config['link_func']   = 'searchFilterHistory'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$data['posts'] = $this->model_data->getHistory($conditions); 
			$this->template->load('main/themes','main/history',$data);
			
		}
		
		function ajaxHistory(){
			cek_session_login();
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
			// Set conditions for search and filter 
			$keywords = $this->input->post('keywords'); 
			$sortBy = $this->input->post('sortBy'); 
			
			if(!empty($keywords)){ 
				$conditions['search']['keywords'] = $keywords; 
			} 
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			if(!empty($limits)){ 
				$conditions['search']['limits'] = $limits; 
			}
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getHistory($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListHistory'; 
			$config['base_url']    = base_url('history/ajaxHistory'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'searchFilterHistory'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			unset($conditions['returnType']); 
			$data['start'] = $offset; 
			$data['posts'] = $this->model_data->getHistory($conditions); 
			
			// Load the data list view 
			$this->load->view('main/ajax-history', $data, false); 
		}
		function resethistory()
        {
			cek_session_login(1);
            database_demo('Reset');
			$data = array();
            if($this->db->truncate('user_agent')===TRUE){
                $data = array('status'=>200);
				}else{
                $data = array('status'=>400);
			}
            echo json_encode($data);
		}														
	}				