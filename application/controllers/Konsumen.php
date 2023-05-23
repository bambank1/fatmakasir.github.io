<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Konsumen extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			cek_session_login(0);
			$this->perPage = 10; 
			$this->title = info()['title']; 
		}
		
		public function index($id=null)
		{
			cek_menu_akses();
			cek_crud_akses(8);
			if(empty($id))
			{
				$data['title'] ="Data Konsumen | ".$this->title;
				//$data['id'] =$id;
				$conditions['returnType'] = 'count'; 
				$totalRec = $this->model_data->getKonsumen($conditions); 
				
				// Pagination configuration 
				$config['target']      = '#dataListKonsumen'; 
				$config['base_url']    = base_url('konsumen/ajaxKonsumen'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				$config['link_func']   = 'searchFilterKonsumen'; 
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config); 
				
				// Get records 
				$conditions = array( 
				'limit' => $this->perPage 
				); 
				$conditions['search']['sortBy'] = 'ASC'; 
				$data['posts'] = $this->model_data->getKonsumen($conditions); 
				
				$this->template->load('main/themes','konsumen/konsumen_data',$data);
			}
			else{
				$data['title'] = 'Detail konsumen | '.$this->title;
				$data['id'] = $id;
				
				// Get record count 
				$conditions['id'] = $id;
				$conditions['returnType'] = 'count'; 
				$totalRec = $this->model_data->getDetail($conditions); 
				
				// Pagination configuration 
				$config['target']      = '#detailKonsumen'; 
				$config['base_url']    = base_url('konsumen/ajaxDKonsumen'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config); 
				
				// Get records 
				$conditions = array( 
				'limit' => $this->perPage 
				); 
				$conditions['where'] = array(
				'konsumen.id' => $id
				);
				$data['result'] = $this->model_data->getDetail($conditions); 
				$this->template->load('main/themes','konsumen/detail_konsumen',$data);
			}
		}
		public function detail($id=null)
		{
			
			cek_crud_akses(8);
			$id = decrypt_url($id);
			if(empty($id))
			{
				
				$data['title'] ='Data Konsumen | '.$this->title;
				//$data['id'] =$id;
				$conditions['returnType'] = 'count'; 
				$totalRec = $this->model_data->getKonsumen($conditions); 
				
				// Pagination configuration 
				$config['target']      = '#dataListKonsumen'; 
				$config['base_url']    = base_url('konsumen/ajaxKonsumen'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config); 
				
				// Get records 
				$conditions = array( 
				'limit' => $this->perPage 
				); 
				$data['posts'] = $this->model_data->getKonsumen($conditions); 
				
				$this->template->load('main/themes','konsumen/konsumen',$data);
				}else{
				
				$data['title'] = 'Detail konsumen | '.$this->title;
				$data['id'] = $id;
				
				// Get record count 
				$conditions['id'] = $id;
				$conditions['returnType'] = 'count'; 
				$totalRec = $this->model_data->getDetail($conditions); 
				
				// Pagination configuration 
				$config['target']      = '#detailKonsumen'; 
				$config['base_url']    = base_url('konsumen/ajaxDKonsumen'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config); 
				
				// Get records 
				$conditions = array( 
				'limit' => $this->perPage 
				); 
				$conditions['where'] = array(
				'konsumen.id' => $id
				);
				$data['jenis'] = jenis_konsumen($id);
				$data['member'] = jenis_member($id);
				$data['result'] = $this->model_data->getDetail($conditions); 
				$this->template->load('main/themes','konsumen/detail_konsumen',$data);
			}
		}
		function ajaxDKonsumen(){
			
			cek_crud_akses(8);
			$idkon = $this->input->post('idkon'); 
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
			$conditions['id'] = $idkon;
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getDetail($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#detailKonsumen'; 
			$config['base_url']    = base_url('konsumen/ajaxDKonsumen'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'FilterKonsumen'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			$conditions['where'] = array(
            'konsumen.id' => $idkon
			);
			unset($conditions['returnType']); 
			
			$data['posts'] = $this->model_data->getDetail($conditions); 
			
			// Load the data list view 
			$this->load->view('konsumen/ajax-konsumen', $data, false); 
		}
		public function detail_konsumen($id='')
		{
			
			cek_crud_akses(8);
			if(empty($id)){
				redirect('konsumen/konsumen_data/');
			}
			$data['title'] = 'Detail konsumen |' .$this->title;
			$data['id'] = $id;
			
			// Get record count 
			$conditions['id'] = $id;
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getDetail($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#detailKonsumen'; 
			$config['base_url']    = base_url('konsumen/ajaxDKonsumen'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'limit' => $this->perPage 
			); 
			$conditions['where'] = array(
            'konsumen.id' => $id
			);
			$data['result'] = $this->model_data->getDetail($conditions); 
			$this->template->load('main/themes','konsumen/detail_konsumen',$data);
		}
		public function cari_konsumen(){
			
			cek_crud_akses(8);
			$data['title'] ='';
			$data['id'] = $this->input->post('id');
			$this->load->view('konsumen/cari_konsumen',$data);
		}
		public function cek_konsumen()
		{
			
			cek_crud_akses(8);
			$id = $this->db->escape_str($this->input->post('id'));
			$id = decrypt_url($id);
			$search=$this->model_app->view_where('konsumen',array('id'=>$id));
			if($search->num_rows()>0){
				$row =$search->row();
				$data = array(
				'id'=>encrypt_url($row->id),
				'nama'=>$row->nama,
				'panggilan'=>$row->panggilan,
				'jenis'=>(isset($row->jenis) ? $row->jenis : ''),
				'nohp'=>$row->no_hp,
				'alamat1'=>$row->alamat,
				'perusahaan'=>$row->perusahaan,
				'jenis_member'=>$row->jenis_member,
				'alamat2'=>$row->alamat_lembaga,
				'no_telp'=>$row->no_telp,
				'email'=>$row->email,
				'tampil'=>$row->tampil,
				'via'=>$row->referal,
				'boleh'=>$row->status,
				'max'=>$row->max_utang,
				'status'=>200
				);
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
			}
		}
		public function update_konsumen()
		{
			
			simpan_demo("Simpan");
			cek_crud_akses(9,'json');
			$config = array(
			array(
			'field' => 'nama_edit',
			'label' => 'Nama',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			),
			array(
			'field' => 'telepon_edit',
			'label' => 'No. HP',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			),
			array(
			'field' => 'alamat_edit',
			'label' => 'Alamat',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			),
			
			array(
			'field' => 'via_edit',
			'label' => 'Referal',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			)
			);
			$json = array('hasil'=>'error');
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() != FALSE){
				$id = $this->db->escape_str($this->input->post('id_edit'));
				$id = decrypt_url($id);
				
				$nama_edit = $this->db->escape_str($this->input->post('nama_edit'));
				$panggilan_edit = $this->db->escape_str($this->input->post('panggilan_edit'));
				$telepon_edit = $this->db->escape_str($this->input->post('telepon_edit'));
				$alamat_edit = $this->db->escape_str($this->input->post('alamat_edit'));
				$via_edit = $this->db->escape_str($this->input->post('via_edit'));
				$status = $this->db->escape_str($this->input->post('status_edit'));
				$max_u = $this->db->escape_str($this->input->post('max_u'));
				$jenis = $this->db->escape_str($this->input->post('jenis_lembaga_edit'));
				$member = $this->db->escape_str($this->input->post('jenis_member_edit'));
				$perusahaan_edit = $this->db->escape_str($this->input->post('nama_perusahaan_edit'));
				$alamat_perusahaan = $this->db->escape_str($this->input->post('alamat_perusahaan_edit'));
				$no_telp = $this->db->escape_str($this->input->post('no_telp_edit'));
				$tampil_data = $this->db->escape_str($this->input->post('tampil_edit'));
				$cek_no = cek_no($telepon_edit);
				 
				if($cek_no['akses']==0){
					$json = array('status'=>400,'msg'=>$cek_no['msg']);
					}else{
					$json = array();
					$cek =$this->model_app->view_where('konsumen',array('no_hp'=>$telepon_edit,'id !='=>$id));
					if($cek->num_rows() > 0)
					{
						$json = array('status'=>400,'msg'=>'No.hp sudah ada');
						}else{
						$_data = array(
						'nama'=>$nama_edit,
						'panggilan'=>$panggilan_edit,
						'no_hp'=>hp_3($telepon_edit),
						'jenis'=>$jenis,
						'jenis_member'=>$member,
						'alamat'=>$alamat_edit,
						'perusahaan'=>(isset($perusahaan_edit) ? $perusahaan_edit : ''),
						'alamat_lembaga'=>(isset($alamat_perusahaan) ? $alamat_perusahaan : ''),
						'no_telp'=>(isset($no_telp) ? $no_telp : ''),
						'referal'=>$via_edit,
						'tampil'=>$tampil_data,
						'status'=>$status,
						'max_utang'=>$max_u,
						'tgl_edit'=>date('Y-m-d H:i:s')
						);
						///panggil
						$search=$this->model_app->view_where('konsumen',array('id'=>$id));
						$row =$search->row();
						$catat = json_encode($_data);
						if($row->history==''){
							$catat = $catat;
							}else{
							$catat = $row->history.','.$catat;
						}
						$data = array(
						'nama'=>$nama_edit,
						'panggilan'=>$panggilan_edit,
						'no_hp'=>hp_3($telepon_edit),
						'jenis'=>$jenis,
						'jenis_member'=>$member,
						'alamat'=>$alamat_edit,
						'perusahaan'=>(isset($perusahaan_edit) ? $perusahaan_edit : ''),
						'alamat_lembaga'=>(isset($alamat_perusahaan) ? $alamat_perusahaan : ''),
						'no_telp'=>(isset($no_telp) ? $no_telp : ''),
						'referal'=>$via_edit,
						'tampil'=>$tampil_data,
						'status'=>$status,
						'max_utang'=>$max_u,
						'history'=>$catat
						);
						
						
						$res = $this->model_app->update('konsumen', $data, array("id"=>$id));
						if($res['status']=='ok'){
							$json = array('status'=>200,'msg'=>'Data berhasil diupdate','idmember'=>$member);
							}else{
							$json = array('status'=>400,'msg'=>'Data gagal diupdate','idmember'=>$member);
						}
					}
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
		public function ajax_cari(){
			
			if($_POST['type']=='konsumen_cari'){
				
				$row_num = $_POST['row_num'];
				$name = $_POST['name_startsWith'];
				$like = ['nama'=>$name];
				$no_hp = ['no_hp'=>$name];
				$no_telp = ['no_telp'=>$name];
				$result = $this->model_app->view_or_like('konsumen',$like,$no_hp,$no_telp);
				
				
				$data = array();
				foreach ($result->result_array() as $row)
				{
					if($row['tampil']==1){
						$nama = $row['perusahaan'];
						$telp = $row['no_telp'];
						$alamat = $row['alamat_lembaga'];
						}else{
						$nama = $row['nama'];
						$telp = $row['no_hp'];
						$alamat = $row['alamat'];
					}
					$name = $nama.' - '.$telp.'|'.$row['id'].'|'.$nama.'|'.$alamat.'|'.$row['perusahaan'].'|'.$row['id_member'].'|'.$row_num;
					array_push($data, $name);
				}
				echo json_encode($data);
				}else{
				array_push($data, 'Pelanggan tidak ditemukan');
				echo json_encode($data);
			}	
		}
		
		public function input_konsumen(){
			
			$config = array(
			array(
			'field' => 'nama_add',
			'label' => 'Nama',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			),
			array(
			'field' => 'telepon_add',
			'label' => 'No. HP',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			),
			array(
			'field' => 'alamat_add',
			'label' => 'Alamat',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			),
			
			array(
			'field' => 'via_add',
			'label' => 'Referal',
			'rules' => 'required',
			'errors' => array(
			'required' => '%s. Harus diisi',
			),
			)
			);
			$data = array('hasil'=>'error');
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() != FALSE){
				$perusahaan_add = $this->db->escape_str($this->input->post('perusahaan_add'));
				$alamat_perusahaan = $this->db->escape_str($this->input->post('alamat_perusahaan_add'));
				$no_telp = $this->db->escape_str($this->input->post('no_telp_add'));
				$no_telp = hp_3($no_telp);
				$jenis_lembaga_add = $this->db->escape_str($this->input->post('jenis_lembaga_add'));
				$jenis_member_add = $this->db->escape_str($this->input->post('jenis_member_add'));
				$tampil = $this->db->escape_str($this->input->post('tampil_data'));
				$cek_no = cek_no($this->input->post('telepon_add'));
				$data = array('hasil'=>'');
				if($cek_no['akses']==0){
					$data = array('status'=>400,'msg'=>$cek_no['msg']);
					}else{
					$search=$this->model_app->view_where('konsumen',array('no_hp'=>$this->input->post('telepon_add')));
					if($search->num_rows()>0){
						$data = array('hasil'=>'ada','telp'=>'No. HP Sudah ada');
						}else{
						$nama = strtolower($this->input->post('nama_add'));
						
						$idmember = autoNumbers(MEMBER,DIGIT_MEMBER);
						$unik = strtoupper(random_string('alnum',7));
						$data_arr = array(
						'id_member' => $idmember,
						'kode_unik' => $unik,
						'panggilan' =>  $this->input->post('panggilan_add'),
						'jenis' =>  $this->input->post('jenis_lembaga_add'),
						'jenis_member' =>  $this->input->post('jenis_member_add'),
						'nama' =>  ucwords($nama),
						'alamat' => $this->input->post('alamat_add'),
						'no_hp' => hp_3($this->input->post('telepon_add')),
						'perusahaan'=>(isset($perusahaan_add) ? $perusahaan_add : 'Personal'),
						'alamat_lembaga'=>(isset($alamat_perusahaan) ? $alamat_perusahaan : ''),
						'no_telp'=>(isset($no_telp) ? $no_telp : ''),
						'tampil' => $tampil,
						'referal' => $this->input->post('via_add'),
						'tgl_daftar' => date('Y-m-d'),
						);
						$result = $this->model_app->input('konsumen', $data_arr); 
						if($result['status']=='ok'){
							$id_nya = $this->input->post('id_nya');
							if(!empty($id_nya)){
								$where = array('id_invoice' => $id_nya);
								$this->model_app->update('invoice', array("id_konsumen"=>$result['id']), $where);
							}
							if($tampil > 0){
								$nama = (isset($perusahaan_edit) ? $perusahaan_edit : 'Personal');
								$telp = (isset($no_telp) ? $no_telp : '');
								$alamat = (isset($alamat_perusahaan) ? $alamat_perusahaan : 'Personal');
								}else{
								$nama = ucwords($nama);
								$telp =  hp_3($this->input->post('telepon_add'));
								$alamat = 'Personal';
							}
							$data = array(
							'idk' => $result['id'],
							'id_member' => $jenis_member_add,
							'jenis_member' => member($jenis_member_add),
							'panggilan' =>  $this->input->post('panggilan_add'),
							'nama' =>  $nama,
							'telp' => $telp,
							'referal' => $this->input->post('via_add'),
							'alamat' => $alamat,
							'perusahaan' => '',
							'msg' => 'Data berhasil disimpan',
							'hasil' => 'sukses'
							);
							}else{
							$data = array('hasil'=>'error');
						}
					}
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			
		}
		public function cari_update(){
			
			$id = clean($this->input->post('id'));//id invoice
			$telepon = clean($this->input->post('telp'));
			$search = $this->model_app->view_where('konsumen', array('no_hp' => $telepon));
			if($search->num_rows()>0){
				$row =$search->row_array();
				$unik = strtoupper(random_string('alnum',5));
				$where = array('id_invoice' => $id);
				$res= $this->model_app->update('invoice', array("id_konsumen"=>$row['id']), $where);
				if($res==true){
					$this->model_app->update('konsumen', array("kode_unik"=>$unik), array('no_hp' => $telepon));
					if($row['tampil']==1){
						$nama = $row['perusahaan'];
						$telp =  $row['no_telp'];
						$alamat = $row['alamat_lembaga'];
						}else{
						$nama = $row['nama'];
						$telp = $row['no_hp'];
						$alamat = $row['alamat'];
					}
					$data = array('idnya' => $id,
					"idk"=> $row['id'],
					"id_member"=> $row['jenis_member'],
					'jenis_member' => member($row['jenis_member']),
					"nama"=> $nama,
					"telp"=> $telp,
					"alamat"=> $alamat,
					"perusahaan"=> $row['perusahaan'],
					"hasil"=> 'sukses'
					);	
				}
				}else{
				$data = array(0 => 'error');	
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function cek_telp(){
			
			$telepon = clean($this->input->post('telp'));
			$telepon = hp_3($telepon);
			$cek_no = cek_no($telepon);
			if($cek_no['akses']==0){
				$data = array('status'=>400,'msg'=>$cek_no['msg']);
				}else{
				$search = $this->model_app->view_where('konsumen', array('no_hp' => $telepon));
				if($search->num_rows()>0){
					$rows =$search->row_array();
					if($rows['tampil']==1){
						$nama = $rows['perusahaan'];
						$telp = $rows['no_telp'];
						$alamat = $rows['alamat_lembaga'];
						}else{
						$nama = $rows['nama'];
						$telp = $rows['no_hp'];
						$alamat = $rows['alamat'];
					}
					$data = array(0 => 'ada', 
					'idnya' => $rows['id'],
					'no_hp'=>$rows['no_hp'],
					'panggilan'=>$rows['panggilan'],
					'jenis'=>$rows['jenis'],
					'jenis_member'=>$rows['jenis_member'],
					'nama'=>$nama,
					'alamat'=>$alamat,
					'no_telp'=>$telp,
					'reff'=>$rows['referal'],
					'kodeunik'=>$rows['kode_unik']);
					}else{
					$data = array(0 => 'add ','msg'=>$telepon);	
				}
			}
			echo json_encode($data);
		}
		
		public function update_konsumen_cari(){
			
			$id_invoicecari  = $this->input->post('id_invoicecari');
			$id_konsumencari = $this->input->post('id_konsumencari');
			$id_member       = $this->input->post('id_member');
			$nama            = $this->input->post('nama_cari');
			$telp            = $this->input->post('caritlp');
			$alamat          = $this->input->post('alamat_cari');
			$perusahaan      = $this->input->post('perusahaan_cari');
			$exp             = explode('-',$telp);
			
			$cek_bayar  = $this->model_cek->sum_bayar_konsumen(['`invoice`.`id_invoice`'=>$id_invoicecari,'konsumen.id'=>$id_konsumencari]);
			$cek_detail = $this->model_cek->sum_detail_konsumen(['`invoice`.`id_invoice`'=>$id_invoicecari,'konsumen.id'=>$id_konsumencari]); 
			$cek        = $cek_detail->total - $cek_bayar->total;
			$totpiutang = 0;
			$cek_member = cek_member($id_konsumencari);
			if($cek > 0){
				if($cek_detail->oto==1 AND $cek_detail->max_utang >0 OR $cek_detail->max_utang >0 AND $cek_detail->status !='batal' OR $cek_detail->oto == 0 AND $cek_detail->total_bayar ==0 AND $cek_detail->status=='baru' OR $cek_detail->statusutang ==1){
					
					$data = array(
					'id' => $id_invoicecari,
					'jenis_member' => member($cek_member),
					'id_member' => $cek_member,
					'idk' => $id_konsumencari,
					'nama' => $nama,
					'telp' =>  $exp[1],
					'alamat' => $alamat,
					'perusahaan' => $perusahaan,
					'hasil' => 'sukses',
					'error' => 'Data berhasil di input'
					);	
					$update = $this->model_app->update('invoice',['id_konsumen'=>$id_konsumencari],['id_invoice'=>$id_invoicecari]);
					if($update['status']=='ok'){
						echo json_encode($data);
						}else{
						$data = array(
						'id' => '',
						'jenis_member' => '',
						'id_member' => '',
						'nama' => '',
						'telp' => '',
						'alamat' => '',
						'perusahaan' => '',
						'hasil' => 'gagal',
						'error' => 'Data gagal di input'
						);	
						
						echo json_encode($data);
					}
					}else{
					
					$tgl        = tgl_indo($cek_detail->tgl_trx,false);
					$namakon    = $cek_detail->nama;
					$piutang    = $cek;
					$id_invoice = $cek_detail->id_invoice;
					$totpiutang = $totpiutang + $piutang;
					
					$data = array(
					'id' => $id_konsumencari,
					'totalp' => rp($totpiutang),
					'nama' => $namakon,
					'tgl' => $tgl,
					'hasil' => 'ada',
					'error' => $namakon.' Masih ada piutang sebesar Rp.'.rp($totpiutang));	
					echo json_encode($data);
				}
				}else{
				
				$data = array(
				'id' => $id_invoicecari,
				'jenis_member' => member($cek_member),
				'id_member' => $cek_member,
				'idk' => $id_konsumencari,
				'nama' => $nama,
				'telp' => $exp[1],
				'alamat' => $alamat,
				'perusahaan' => $perusahaan,
				'hasil' => 'sukses',
				'error' => 'Data berhasil di input'
				);	
				$update = $this->model_app->update('invoice',['id_konsumen'=>$id_konsumencari],['id_invoice'=>$id_invoicecari]);
				if($update['status']=='ok'){
					echo json_encode($data);
					}else{
					$data = array(
					'id' => '',
					'jenis_member' => '',
					'id_member' => '',
					'nama' => '',
					'telp' => '',
					'alamat' => '',
					'perusahaan' => '',
					'hasil' => 'gagal',
					'error' => 'Data gagal di input'
					);	
					
					echo json_encode($data);
				}
			}
		}
		public function konsumen(){
			
			$conditions['where'] = array(
			'kunci' => '0'
			); 
			$data = $this->model_app->counter('konsumen',$conditions);
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function cari(){
			
			$search=  $this->input->post('search');
			$query = $this->model_data->getdata($search);
			echo json_encode ($query);
		}
		
		
		public function data_konsumen($id)
		{
			cek_session_login();
			$data['id'] =$id;
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getKonsumen($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListKonsumen'; 
			$config['base_url']    = base_url('konsumen/ajaxKonsumen'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
			'limit' => $this->perPage 
			); 
			$data['posts'] = $this->model_data->getKonsumen($conditions); 
			
			$this->load->view('konsumen/konsumen',$data);
		}
		function ajaxKonsumen(){
			
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
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getKonsumen($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListKonsumen'; 
			$config['base_url']    = base_url('konsumen/ajaxKonsumen'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $limit; 
			$config['link_func']   = 'searchFilterKonsumen'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $limit;
			unset($conditions['returnType']);
			
			$data['sortBy'] = $sortBy; 
			$data['posts'] = $this->model_data->getKonsumen($conditions); 
			
			// Load the data list view 
			$this->load->view('konsumen/ajax-konsumen', $data, false); 
		}
		public function jenis_lembaga(){
			$status = $this->input->post('status');
			if($status=='add'){
				}else{
			}
			$result = $this->model_app->view_where('jenis_lembaga',array('pub'=>'0'));
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id,"name"=>$row->title);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function member()
		{
			cek_menu_akses();
			$data['title'] = 'Pengaturan member |' .$this->title;
			$data['judul'] ='Pengaturan member';
			
			$this->template->load('main/themes','konsumen/member',$data);
		}
		public function data_member()
		{
			$data['record'] = $this->model_app->view_ordering('member','id','DESC');
			$this->load->view('konsumen/data_member',$data);
		}
		public function edit_member(){
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$where = array('id' => $id);
				$row = $this->model_app->edit('member',$where)->row_array();
				$data = array('id'=>$id,'title'=>$row['title'],'diskon'=>$row['potongan_diskon'],'aktif'=>$row['status']);
				}else{
				$data = array('id'=>0,'title'=>"",'diskon'=>'',"aktif"=>"");
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function load_member(){
			$id= $this->db->escape_str($this->input->post('id'));
			
			$where = array('`konsumen`.`id`' => $id,'`member`.`status`'=>1);
			$sql = $this->model_app->join_where('title,potongan_diskon','member','konsumen','id','jenis_member',$where);
			if($sql->num_rows() >0 ){
				$data = array('id'=>$id,'title'=>$sql->row()->title,'diskon'=>$sql->row()->potongan_diskon);
				}else{
				$data = array('id'=>0,'title'=>"Member Biasa",'diskon'=>0);
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function save_member()
		{
			cek_nput_post('GET');
			simpan_demo('Simpan');
			$id    = $this->db->escape_str($this->input->post('id'));
			$type  = $this->db->escape_str($this->input->post('type'));
			$title = $this->db->escape_str($this->input->post('title'));
			// $diskon= $this->db->escape_str($this->input->post('diskon'));
			$aktif = $this->db->escape_str($this->input->post('aktif'));
			
			if($id > 0 AND $type=='edit'){
				$_data = array('title'=>$title,'status'=>$aktif);
				// if($aktif==1){
				// $res=  $this->model_app->update('member',$_data,array('id'=>$id));
				// $xdata = array('status'=>0);
				// $this->model_app->update('member',$xdata,array('id!='=>$id));
				// }else{
				// }
				$res=  $this->model_app->update('member',$_data,array('id'=>$id));
				///data update
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil update');
					}else{
					$data = array('status'=>400);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function jenis_member(){
			$status = $this->input->post('status');
			if($status=='add'){
				}else{
			}
			$result = $this->model_app->view_where('member',['status'=>1]);
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id,"name"=>$row->title);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}																																									