<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Errorakses extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(1);
			
			$this->title = info()['title']; 
			$this->iduser = $this->session->idu; 
			$this->akses = $this->session->type_akses; 
			
		}
		
		public function index()
		{
			
			$data['title'] = 'Dashboard | '.$this->title;
			$this->template->load('main/themes','error',$data);
		}
		
	}
