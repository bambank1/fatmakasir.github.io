<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Adm extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
			$this->title = info()['title']; 
		}
		function index(){
			$data['title'] = 'Administrator &rsaquo; Log In | '.$this->title;
			$data['description'] = 'Aplikasi POS Percetakan';
			$data['keywords'] = 'point of sale, pos percetakan, aplikasi percetakan';
			$data['email'] = '';
			$data['list'] = [];
			if(!empty($this->input->get('email'))){
				$data['email'] = decrypt_url($this->input->get('email'));
				
				$data['list'] = $this->model_app->pilih_where('email','tb_users',['email'=>$data['email']]);
			}
			if (isset($_POST['submit'])){
				//cek ip
				$cek_info   = cek_info();
				$cekip      = $this->model_app->view_where('user_agent',['ip'=>$cek_info['ip']]);
				$email_user = $this->input->post('email_user');
				$password   = $this->input->post('pass_user');
				$cek        = $this->model_app->cek_user($email_user);
				$total      = $cek->num_rows();
				
				if ($total > 0){
					$sid_baru = session_id();
					$row = $cek->row_array();
					$hash = $row['password'];
					if (password_verify($password, $hash)) {
						$this->session->set_userdata(
						array('idu'=>$row['id_user'],
						'emailu'=>$row['email'],
						'nama'=>$row['nama_lengkap'],
						'idparent'=>$row['parent'],
						'id_lv'=>$row['id_level'],
						'idlv'=>$row['idlevel'],
						'level'=>$row['level'],
						'id_session'=>$row['id_session'],
						'type_akses'=>$row['type_akses'],
						'ids'=>$sid_baru,
						'sesi'=>$sid_baru)
						);
						$this->model_app->update('tb_users', array("sesi_login"=>$sid_baru),array('id_user'=>$this->session->idu));
						
						if ($cekip->num_rows() > 0){
							$rowcek = $cekip->row();
							$counter = $rowcek->counter + 1;
							$this->model_app->update('user_agent', array("counter"=>$counter),array('ip'=>$cek_info['ip']));
							}else{
							$data_info = array(
							'ip'=>$cek_info['ip'],
							'os'=>$cek_info['os'],
							'browser'=>$cek_info['browser'],
							'create_date'=>date('Y-m-d H:i:s')
							);
							$this->model_app->insert('user_agent',$data_info);
						}
						if($row['level']=='kasir'){
							redirect('penjualan/order');
							}else{
							redirect('home');
						}
						}else{
						echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username atau Password Salah!!</center></div>');
						$data['title'] = 'Username atau Password salah!';
						$this->load->view('element/login', $data);
					}
					}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username atau Password Salah!!</center></div>');
					$data['title'] = 'username salah atau akun anda sedang diblokir';
					$this->load->view('element/login', $data);
				}
				}else{
				if ($this->session->level!=''){
					redirect('home');
					}else{
					$this->load->view('element/login', $data);
				}
			}
		}
		
	}	