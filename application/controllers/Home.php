<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Home extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(1);
			$this->perPage = 10; 
			$this->title = info()['title']; 
			$this->iduser = $this->session->idu; 
			$this->level = $this->session->level; 
			$this->akses = $this->session->type_akses; 
			
		}
		
		public function index()
		{
			cek_crud_akses(8);
			$this->template->set('title', 'Dashboard | '.$this->title);
			if($this->level=='desain'){
				$this->template->load('main/themes','main/dashboard_desain');
			}elseif($this->level=='operator'){
				$this->template->load('main/themes','main/dashboard_operator');
				}else{
				$this->template->load('main/themes','main/dashboard');
			}
		}
		
		public function account()
		{
			cek_crud_akses(8);
			$this->template->set('title', 'Account Demo | '.$this->title);
			$this->template->load('main/themes','main/account');
		}
		
	}				
