<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Pembayaran extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login();
			$this->iduser = $this->session->idu;
			$this->title = info()['title']; 
		}
		
		public function jenis()
		{
			cek_menu_akses();
			$data['title'] = 'Jenis Pembayaran | '.$this->title;
			$this->template->load('main/themes','pembayaran/pembayaran',$data);
		}
		public function rekening()
		{
			cek_menu_akses();
			$data['title'] = 'Rekening Bank | '.$this->title;
			$this->template->load('main/themes','pembayaran/rekening',$data);
		}
		public function jenis_pembayaran(){
			$result = $this->model_app->view_where('jenis_bayar',array('publish'=>'Y','kunci'=>0));
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id,"name"=>$row->nama_bayar);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			
		}
		public function jenis_pembayaran_pengeluaran(){
			$result = $this->model_app->view_where('jenis_bayar',array('publish'=>'Y'));
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id,"name"=>$row->nama_bayar);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			
		}
		
		public function jenis_pembayaran_pembelian($id=''){
			$arr['a'] = ['id_bayar'=>'','id_akun'=>'','title'=>'','tgl'=>'']; 
			if(!empty($id)){
				$cek = $this->model_app->view_where('pembelian',array('id_pembelian'=>$id))->row();
				$arr['a'] = ['id_bayar'=>$cek->id_bayar,'id_akun'=>getIdAkun($cek->id_bayar),'title'=>getNameKas($cek->id_kas),'tgl'=>tgl_ambil($cek->tgl_jatuhtempo)]; 				
			}
			$result = $this->model_app->view_where('jenis_bayar',array('publish'=>'Y'));
			$data = array();
			foreach ($result->result() as $row)
			{
				$data['b'][] = array("id"=>$row->id,"name"=>$row->nama_bayar);
			}
			$data = array_merge($arr,$data);
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			
		}
		public function jenis_pembayaran_piutang(){
			$result = $this->model_app->view_where('jenis_bayar',array('publish'=>'Y','kunci'=>0));
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id,"name"=>$row->nama_bayar);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			
		}
		public function jenis_kas(){
			$result = $this->model_app->view_where('jenis_kas',array('kunci'=>0));
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id,"name"=>$row->title);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function tujuan_kas(){
			$id= $this->db->escape_str($this->input->post('id'));
			if(!empty($id)){
				$result = $this->model_app->view_where('jenis_kas',array('id!='=>$id,'kunci'=>0));
				$data = array();
				foreach ($result->result() as $row)
				{
					$data[] = array("id"=>$row->id,"name"=>$row->title);
				}
				}else{
				$data[] = array("id"=>0,"name"=>'Pilih','msg'=>'disabled');
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function data_pembayaran()
		{
			$data['record'] = $this->model_app->view_where_ordering('jenis_bayar',array('publish'=>'Y'),'id','DESC')->result();
			$this->load->view('pembayaran/data_jenis',$data);
		}
		public function data_rekening()
		{
			$data['record'] = $this->model_app->view_where_ordering('rekening_bank',array(),'id','DESC')->result();
			$this->load->view('pembayaran/data_rekening',$data);
		}
		
		
		public function get_data_bayar(){
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$where = array('id' => $id);
				$row = $this->model_app->edit('jenis_bayar',$where)->row_array();
				$data = $row;
				}else{
				$data = [];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		function get_data(){
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$where = array('id' => $id);
				$row = $this->model_app->edit('rekening_bank',$where)->row_array();
				$data = $row;
				}else{
				$data = [];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		function get_rekening(){
			$type= $this->db->escape_str($this->input->post('type'));
			if($type=='cari'){
				$where = array('publish' => 'Y');
				$result = $this->model_app->view_where('rekening_bank',$where)->result();
				foreach($result AS $row){
					$data[] = ['id'=>$row->id,'name'=>$row->nama_bank];
				}
				}else{
				$data = [];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function save_data_bayar()
		{
			simpan_demo('Simpan');
			$id      = $this->db->escape_str($this->input->post('id'));
			$type    = $this->db->escape_str($this->input->post('type'));
			$judul   = $this->db->escape_str($this->input->post('cara_bayar'));
			$publish = $this->db->escape_str($this->input->post('publish'));
			
			
			$_data   = array('nama_bayar'=>$judul,'publish'=>$publish);
			
			$data = [];
			if($type=='edit'){
				///data update
				$res=  $this->model_app->update('jenis_bayar',$_data,array('id'=>$id));
				if($res==true){
					$data = array('status'=>200,'msg'=>'Data berhasil update');
					}else{
					$data = array('status'=>400);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function save_data()
		{
			simpan_demo('Simpan');
			$id      = $this->db->escape_str($this->input->post('id'));
			$type    = $this->db->escape_str($this->input->post('type'));
			$judul   = $this->db->escape_str($this->input->post('cara_bayar'));
			$no_rek  = $this->db->escape_str($this->input->post('nomor'));
			$pemilik = $this->db->escape_str($this->input->post('pemilik'));
			$inisial = $this->db->escape_str($this->input->post('inisial'));
			$footerin = $this->db->escape_str($this->input->post('footerin'));
			$publish = $this->db->escape_str($this->input->post('publish'));
			
			$_data   = array('nama_bank'=>$judul,'nomor_rekening'=>$no_rek,'pemilik'=>$pemilik,'publish'=>$publish,'inisial'=>$inisial,'footer_invoice'=>$footerin);
			if(!empty($id)){
				$data = [];
				if($type=='edit'){
					///data update
					$res=  $this->model_app->update('rekening_bank',$_data,array('id'=>$id));
					if($res['status']=='ok'){
						$data = array('status'=>200,'msg'=>'Data berhasil update');
						}else{
						$data = array('status'=>400);
					}
				}
				}else{
				if($type=='add'){
					$input=  $this->model_app->input('rekening_bank',$_data);
					if($input['status']=='ok'){
						$data = array('status'=>200,'msg'=>'Data berhasil update');
						}else{
						$data = array('status'=>400);
					}
					}else{
					$data = array('status'=>400);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}																						