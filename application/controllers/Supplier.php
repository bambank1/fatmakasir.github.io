<?php	
	defined('BASEPATH') or exit('No direct script access allowed');	
	
	class Supplier extends CI_Controller	
	{		
		public function __construct()		
		{			
			parent::__construct();		
			// cek_tabel();
			cek_session_login();
			$this->perPage = 10; 		
			$this->iduser = $this->session->idu;
			$this->title = info()['title']; 
		}		
		
		public function data(){
			$data['title'] ='Data supplier | '.$this->title;
			
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->get_supplier($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataSupplier'; 
			$config['base_url']    = base_url('supplier/ajaxSupplier'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Supplier'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'limit' => $this->perPage 
			); 
			
			$data['result'] = $this->model_data->get_supplier($conditions); 
			$this->template->load('main/themes','supplier/data_supplier',$data);
		}
		
		public function ajaxSupplier(){	
			cek_nput_post('GET');
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
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			
			$keywords = $this->input->post('keywords'); 
			if(!empty($keywords)){ 
				$conditions['search']['keywords'] = $keywords; 
			} 
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->get_supplier($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataSupplier'; 
			$config['base_url']    = base_url('supplier/ajaxSupplier'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'search_Supplier'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->get_supplier($conditions); 
			
			$conditions['offset'] = $offset; 
			// Load the data list view 
			$this->load->view('supplier/cari-supplier', $data, false); 
		}
		public function get_data()
		{
			cek_nput_post('GET');
			$id = $this->db->escape_str($this->input->post('id'));
			$search=$this->model_app->view_where('supplier',array('id_supplier'=>$id));
			if($search->num_rows()>0){
				$row =$search->row();
				$data = array(
				'id'=>$row->id_supplier,
				'nama'=>$row->nama_perusahaan,
				'pemilik'=>$row->pemilik,
				'jabatan'=>$row->jabatan,
				'telp'=>$row->telp,
				'email'=>$row->email,
				'jenis'=>$row->jenis_usaha,
				'rekening'=>$row->nomor_rekening,
				'alamat'=>$row->alamat,
				'tgl'=>$row->tgl_terdaftar
				);
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function simpan()
		{
			cek_nput_post('GET');
			simpan_demo("Simpan");
			$id = $this->db->escape_str($this->input->post('id'));
			$type = $this->db->escape_str($this->input->post('type'));
			
			$data_post           = array(
			'nama_perusahaan'    =>$this->db->escape_str($this->input->post('nama_perusahaan')),
			'pemilik'            =>$this->db->escape_str($this->input->post('atas_nama')),
			'jabatan'            =>$this->db->escape_str($this->input->post('jabatan')),
			'telp'               =>$this->db->escape_str($this->input->post('no_hp')),
			'email'              =>$this->db->escape_str($this->input->post('email')),
			'jenis_usaha'        =>$this->db->escape_str($this->input->post('jenis_usaha')),
			'nomor_rekening'     =>$this->db->escape_str($this->input->post('no_rekening')),
			'alamat'             =>$this->db->escape_str($this->input->post('alamat'))
			);
			
			if($id == 0 AND $type=='add'){
				$res= $this->model_app->input('supplier',$data_post);
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil disimpan');
					}else{
					$data = array('status'=>400,'msg'=>'Data gagal disimpan');
				}
				}elseif($id >0 AND $type=='edit'){
				$res=  $this->model_app->update('supplier',$data_post,array('id_supplier'=>$id));
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil update');
					}else{
					$data = array('status'=>400,'msg'=>'Data gagal diupdate');
				}
				}else{
				$data = array('status'=>400,'msg'=>'Bad request');
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function hapus()
		{
			cek_nput_post('GET');
			simpan_demo('Hapus');
			$id = $this->db->escape_str($this->input->post('id'));
			$type = $this->db->escape_str($this->input->post('type'));
			if($id >0 AND $type=='hapus'){
				$where = array('id_supplier' => $id);
				$cek = $this->model_app->view_where('pengeluaran_detail',$where);
				if($cek->num_rows() > 0){
					$data = array('status'=>400,'msg'=>'Data tidak bisa dihapus');
					}else{
					$cek2 = $this->model_app->view_where('supplier',$where);
					if($cek2->num_rows() > 0){
						$res=$this->model_app->hapus('supplier',$where);
						if($res['status']=='ok'){
							$data = array('status'=>200,'msg'=>'Data berhasil dihapus');
							}else{
							$data = array('status'=>400,'msg'=>'Data gagal dihapus');
						}
						}else{
						$data = array('status'=>400,'msg'=>'Jenis tidak bisa dihapus');
					}
				}
				}else{
				$data = array('status'=>400,'msg'=>'Bad request');
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}							