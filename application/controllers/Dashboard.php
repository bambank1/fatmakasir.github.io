<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller
	{
		// public function __construct()
		// {
			// parent::__construct();
			// cek_tabel();
		// }
		
		public function index()
		{
			
			$data['description'] = 'Aplikasi POS Percetakan';
			$data['keywords'] = 'point of sale, pos percetakan, aplikasi percetakan';
			if ($this->session->level!=''){
				redirect('home');
				}else{
				if(info()['status']==''){
					redirect('install');
					}else{
					$data['email'] = '';
					 $data['list'] = '';
					if(!empty($this->input->get('email'))){
						$data['email'] = decrypt_url($this->input->get('email'));
						 
						$data['list'] = $this->model_app->pilih_where('email','tb_users',['email'=>$data['email']]);
					}
					$data['title'] = 'Administrator &rsaquo; Log In | Aplikasi POS Percetakan';
					$this->load->view('element/login', $data);
				}
			}
			
		}
		
		
	}						