<?php	
	defined('BASEPATH') or exit('No direct script access allowed');	
	
	class Pembukuan extends CI_Controller	
	{		
		public function __construct()		
		{			
			parent::__construct();		
			// cek_tabel();
			cek_session_login(1);
			$this->load->helper('date');			
			$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");			
			$this->perPage = 10; 		
			$this->iduser = $this->session->idu;
			$this->title = info()['title']; 
		}		
		
		public function index(){
			cek_session_login(1);
		}
		public function omset(){
			$data['title'] ='Laporan omset | '.$this->title;
			
			$data['pilihan'] = $this->model_app->view('tb_users');			
			$data['jenis'] = $this->model_app->view('jenis_cetakan');
			
			
			$conditions['where'] = array(
			'invoice.id_user' => $this->iduser,
			'invoice.status' => 'simpan'
			);
			
			$dari 	= date('Y-m-').'01';				
			$conditions['search']['dari'] = $dari; 
			$conditions['search']['sampai'] = date("Y-m-d"); 
			
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->get_harian($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListOmset'; 
			$config['base_url']    = base_url('pembukuan/harian'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Omset'; 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions = array( 
            'limit' => $this->perPage 
			); 
			
			$conditions['where'] = array(
			'invoice.id_user' => $this->iduser,
			'invoice.status' => 'simpan'
			);
			
			$conditions['search']['dari'] = $dari; 
			$conditions['search']['sampai'] = date("Y-m-d"); 
			
			$data['dari'] = tgl_dari_slash();
			$data['sampai'] = tgl_sampai_slash();
			$data['posts'] = $this->model_data->get_harian($conditions); 
			$this->template->load('main/themes','pembukuan/omset',$data);
		}
		
		public function harian(){	
			$page = $this->input->post('page'); 
			if(!$page){ 
				$offset = 0; 
				}else{ 
				$offset = $page; 
			} 
			$sortBy = $this->input->post('sortBy'); 
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			$limits = $this->input->post('limits'); 
			if(!empty($limits)){ 
				$limit = $limits; 
				}else{ 
				$limit = $this->perPage; 
			} 
			// Set conditions for search and filter 
			$user = $this->input->post('user'); 
			$dari = date_slash($this->input->post('dari')); 
			$sampai = date_slash($this->input->post('sampai')); 
			
			if(!empty($user)){
				$conditions['where'] = array(
				'invoice.id_user' => $user,
				'invoice.status' => 'simpan'
				);
				}else{
				$conditions['where'] = array(
				'invoice.status' => 'simpan'
				);
			}
			if(!empty($dari)){ 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$conditions['search']['sampai'] = $sampai; 
			} 
			
			// Get record count 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->get_harian($conditions); 
			
			// Pagination configuration 
			$config['target']      = '#dataListOmset'; 
			$config['base_url']    = base_url('pembukuan/harian'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'search_Omset'; 
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			
			// Get records 
			$conditions['start'] = $offset; 
			$conditions['limit'] = $this->perPage;
			if(!empty($user)){
				$conditions['where'] = array(
				'invoice.id_user' => $user,
				'invoice.status' => 'baru'
				);
				}else{
				$conditions['where'] = array(
				'invoice.status' => 'baru'
				);
			}
			unset($conditions['returnType']); 
			$data['result'] = $this->model_data->get_harian($conditions); 
			
			// Load the data list view 
			$this->load->view('pembukuan/ajax-omset', $data, false); 
		}
		
		
		
		public function load_pengeluaran(){
			$info= $this->db->escape_str($this->input->post('info'));			
			$user= $this->db->escape_str($this->input->post('user'));			
			$dari = date_slash($_POST['dari']);			
			$sampai = date_slash($_POST['sampai']);			
			$exp = explode('-',$dari);			
			$tahun = $exp[0];			
			$bulan = $exp[1];			
			
			if($info=='harian'){				
				$proses = "pengeluaran.tgl_pengeluaran BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE)";				
				}else{				
				$proses = "MONTH(pengeluaran.tgl_pengeluaran)='$bulan' AND YEAR(pengeluaran.tgl_pengeluaran)='$tahun'";				
			}			
			if ($user=='0'){				
				$where = "WHERE pengeluaran.pos='Y' AND $proses";				
				}else{				
				$where = "WHERE pengeluaran.pos='Y' AND $proses";				
			}			
			$data['result'] = $this->model_data->get_Satu($where);			
			$this->load->view('pembukuan/data_pengeluaran', $data); 			
			
		}		
		public function uang_masuk(){	
			cek_menu_akses();
			$data['title'] = 'Laporan uang masuk | '.$this->title;			
			
			$dari 	= date('Y-m-').'01';				
			$sampai = date('Y-m-d');				
			
			$where = "WHERE `bayar_invoice_detail`.`tgl_bayar` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) AND bayar_invoice_detail.setor='N'";	
			
			if(!empty($dari)){ 
				$conditions['search']['dari'] = $dari; 
			} 
			if(!empty($sampai)){ 
				$conditions['search']['sampai'] = $sampai; 
			}
			
			$data['dari'] = tgl_dari_slash();
			$data['sampai'] = tgl_sampai_slash();			
			$data['user'] = $this->iduser;		
			$data['pilihan'] = $this->model_app->view_where('tb_users',['aktif'=>'Y'])->result_array();	
			$data['jenis_bayar'] = $this->model_app->view_where('jenis_bayar',['publish'=>'Y','kunci'=>0]);	
			$data['conditions'] = $conditions;			
			$data['result'] = $this->model_data->carabayar($where);	
			$this->template->load('main/themes','pembukuan/uang_masuk',$data);			
		}	
		
		public function data_uang_masuk(){			
			$setor= $this->db->escape_str($this->input->post('setor'));
			$info= $this->db->escape_str($this->input->post('info'));
			$jenis_bayar= $this->db->escape_str($this->input->post('jenis_bayar'));			
			$user= $this->db->escape_str($this->input->post('user'));			
			$dari= $this->db->escape_str($this->input->post('dari'));			
			$sampai= $this->db->escape_str($this->input->post('sampai'));			
			
			
			if(!empty($dari)){				
				$dari = date_slash($dari);				
			}
			if(!empty($sampai)){				
				$sampai = date_slash($sampai);				
			}			
			$jenis = '';
			$id_jenis_bayar = 0;
			if(!empty($jenis_bayar)){				
				$jenis = 'AND id_bayar='.$jenis_bayar;				
				$id_jenis_bayar = $jenis_bayar;
			}			
			
			if ($user=='0' AND $dari!='' AND $sampai!=''){
				 		
				$where = "WHERE `bayar_invoice_detail`.`tgl_bayar` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) $jenis AND `bayar_invoice_detail`.`setor`='$setor'";	
				
				$conditions['where'] = array( 
				'`invoice`.`status`!='=>'baru',
				'`invoice`.`status`!='=>'pending',
				'`invoice`.`status`!='=>'batal'
				); 
				if(!empty($dari)){ 
					$conditions['search']['dari'] = $dari; 
				} 
				if(!empty($sampai)){ 
					$conditions['search']['sampai'] = $sampai; 
				}
				}elseif ($user!='0' AND $dari!='' AND $sampai!=''){
				 
				$where = "WHERE `bayar_invoice_detail`.`tgl_bayar` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) $jenis AND `bayar_invoice_detail`.`setor`='$setor'";				
				
				
				if(!empty($dari)){ 
					$conditions['search']['dari'] = $dari; 
				} 
				if(!empty($sampai)){ 
					$conditions['search']['sampai'] = $sampai; 
				}		
			}	
			// print_r($where);
			$data['setor'] = $setor;			
			$data['dari'] = $dari;			
			$data['sampai'] = $sampai;			
			$data['user'] = $user;			
			$data['conditions'] = $conditions;			
			$data['id_jenis_bayar'] = $id_jenis_bayar;			
			if($setor=='N'){
				$data['result'] = $this->model_data->carabayar($where);	
				$this->load->view('pembukuan/data_uang_masuk', $data); 			
				}else{
				if(!empty($dari)){ 
					$condition['search']['dari'] = $dari; 
				} 
				if(!empty($sampai)){ 
					$condition['search']['sampai'] = $sampai; 
				}
				$condition['returnType'] = 'count'; 
				$totalRec = $this->model_data->uang_setoran($condition); 
				
				// Pagination configuration 
				$config['target']      = '#dataProduk'; 
				$config['base_url']    = base_url('produk/cariProduk'); 
				$config['total_rows']  = $totalRec; 
				$config['per_page']    = $this->perPage; 
				$config['link_func']   = 'search_Produk'; 
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config); 
				
				// Get records 
				$condition = array( 
				'limit' => $this->perPage 
				); 
				if(!empty($dari)){ 
					$condition['search']['dari'] = $dari; 
				} 
				if(!empty($sampai)){ 
					$condition['search']['sampai'] = $sampai; 
				}	
				$data['result'] = $this->model_data->uang_setoran($condition);	
				$this->load->view('pembukuan/setor_uang_masuk', $data); 			
			}
		}		
		
		public function verifikasi()
		{
			cek_nput_post('GET');
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$where = array('id' => $id);
				$row = $this->model_app->edit('laporan_penerimaan',$where)->row_array();
				$data = array('id'=>$id,'total'=>$row['total'],'tanggal'=>$row['tanggal_verifikasi'],'status'=>$row['status']);
				}else{
				$data = array('id'=>0,'total'=>"","status"=>"");
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function save_verifikasi()
		{
			cek_nput_post('GET');
			simpan_demo('Simpan');
			$id= $this->db->escape_str($this->input->post('id'));
			$type= $this->db->escape_str($this->input->post('type'));
			$tanggal= $this->db->escape_str($this->input->post('tanggal'));
			$status= $this->db->escape_str($this->input->post('status'));
			$_data = array('id_penerima'=>$this->iduser,
			'tanggal_verifikasi'=>$tanggal,
			'status'=>$status);
			
			if($id > 0 AND $type=='edit'){
				$res=  $this->model_app->update('laporan_penerimaan',$_data,array('id'=>$id));
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil approve');
					}else{
					$data = array('status'=>400,'msg'=>'gagal berhasil approve');
				}
				}else{
				$data = array('status'=>400,'msg'=>'Data tidak ditemukan');
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function approve_owner()
		{
			cek_nput_post('GET');
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$where = array('id' => $id);
				$row = $this->model_app->edit('laporan_penerimaan',$where)->row_array();
				$data = array('id'=>$id,'total'=>$row['total']);
				}else{
				$data = array('id'=>0,'total'=>"");
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function save_owner()
		{
			cek_nput_post('GET');
			simpan_demo('Simpan');
			$id= $this->db->escape_str($this->input->post('id'));
			$type= $this->db->escape_str($this->input->post('type'));
			$tanggal= $this->db->escape_str($this->input->post('tanggal'));
			
			$_data = [
			'tanggal_terima'=>$tanggal,
			'status'        =>3
			];
			
			if($id > 0 AND $type=='edit'){
				$res=  $this->model_app->update('laporan_penerimaan',$_data,array('id'=>$id));
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil diterima');
					}else{
					$data = array('status'=>400,'msg'=>'gagal berhasil diterima');
				}
				}else{
				$data = array('status'=>400,'msg'=>'Data tidak ditemukan');
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function setor()
		{
			cek_nput_post('GET');
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$where = array('id' => $id,'status'=>1);
				$row = $this->model_app->edit('laporan_penerimaan',$where)->row_array();
				$data = array('id'=>$id,'total'=>$row['total'],'tanggal'=>$row['tanggal_verifikasi'],'status'=>$row['status']);
				}else{
				$data = array('id'=>0,'total'=>"","status"=>"");
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function setor_to_owner()
		{
			cek_nput_post('GET');
			simpan_demo('Simpan');
			$id= $this->db->escape_str($this->input->post('id'));
			$type= $this->db->escape_str($this->input->post('type'));
			$tanggal= $this->db->escape_str($this->input->post('tanggal'));
			$tanggal_setor= $this->db->escape_str($this->input->post('tanggal_setor'));
			$status= $this->db->escape_str($this->input->post('status'));
			$_data = array('tanggal_setor'=>$tanggal,
			'status'=>2);
			
			if($id > 0 AND $type=='edit'){
				$res=  $this->model_app->update('laporan_penerimaan',$_data,array('id'=>$id));
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil disetor');
					}else{
					$data = array('status'=>400,'msg'=>'gagal berhasil disetor');
				}
				}else{
				$data = array('status'=>400,'msg'=>'Data tidak ditemukan');
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function setor_uang_masuk()
		{
			
			$id_user= $this->db->escape_str($this->input->post('user'));	
			$total= $this->db->escape_str($this->input->post('total'));	
			$dari= $this->db->escape_str($this->input->post('dari'));	
			$sampai= $this->db->escape_str($this->input->post('sampai'));	
			if($id_user!=$this->iduser){
				$data = ['status'=>400,'msg'=>'Maaf user tidak sesuai'];
				$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
			if(!empty($dari)){				
				$dari = date_slash($dari);		
				}else{
				$data = ['status'=>400,'msg'=>'Tanggal dari masih kosong'];
				$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
			if(!empty($sampai)){				
				$sampai = date_slash($sampai);				
				}else{
				$data = ['status'=>400,'msg'=>'Tanggal sampai masih kosong'];
				$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
			
			$data_arr = [
			'id_user'=>$id_user,
			'total'=>$total,
			'tanggal'=>day_ymd()
			];
			
			$result = $this->model_app->input('laporan_penerimaan', $data_arr); 
			
			if($result['status']=='ok'){
				$this->setorin();
				$data = ['status'=>200,'msg'=>'Berhasil disetor'];
				}else{
				$data = ['status'=>400,'msg'=>'Gagal disetor'];
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		private function setorin(){
			// print_r($_POST);exit;
			$id_user= $this->db->escape_str($this->input->post('user'));
			$dari= $this->db->escape_str($this->input->post('dari'));	
			$sampai= $this->db->escape_str($this->input->post('sampai'));	
			$dari = date_slash($dari);	
			$sampai = date_slash($sampai);	
			
			$conditions['id_user'] = $id_user; 
			$conditions['where'] = ['id_bayar'=>1]; 
			$conditions['search']['dari'] = $dari; 
			$conditions['search']['sampai'] = $sampai; 
			$bayar = $this->model_data->simpan_setor($conditions);	
			
			foreach($bayar AS $row){
				$this->model_data->update_setor($conditions);	
			}
			
		}
		
		public function piutang(){	
			cek_menu_akses();
			$data['title'] = 'Laporan Piutang | '.$this->title;
			$data['periode'] = date('M Y');			
			$data['pilihan'] = $this->model_app->view('tb_users');			
			$this->template->load('main/themes','pembukuan/piutang',$data);			
		}		
		
		public function cari_piutang(){			
			$info= $this->db->escape_str($this->input->post('info'));			
			$iduser= $this->db->escape_str($this->input->post('user'));			
			$periode= $this->db->escape_str($this->input->post('periode'));			
			$tahun= $this->db->escape_str($this->input->post('tahun'));			
			$keywords= $this->db->escape_str($this->input->post('keywords'));			
			$bulan = periode($periode)['bulan'];
			$tahun = periode($periode)['tahun'];
			
			$waktu = "month(invoice.tgl_trx) ='$bulan' AND YEAR(invoice.tgl_trx) ='$tahun'";				
			
			if ( substr($keywords,0,1 )== '0' )			
			{
				// echo 1;				
				$whereSQL = "AND konsumen.no_hp LIKE '%$keywords%'";				
				}elseif($keywords!=''){
				$whereSQL = "AND konsumen.nama LIKE '%$keywords%'";				
				}elseif(is_numeric($keywords)){				
				// echo 2;				
				$whereSQL = "AND invoice.id_invoice =".$keywords;				
				}else{				
				// echo 3;				
				$whereSQL = "";				
			}			
			
			if ($iduser=='0' AND $keywords==''){				
				// echo "a";				
				$where = "WHERE $waktu AND `invoice`.`status` = 'simpan'";				
				}elseif ($iduser=='0' AND $keywords!=''){				
				// echo "b";				
				$where = "WHERE $waktu  $whereSQL  AND `invoice`.`status` = 'simpan'";				
				}else{				
				// echo "c";				
				$where = "WHERE $waktu AND `invoice`.`id_user` = '$iduser' $whereSQL  AND `invoice`.`status` = 'simpan'" ;				
			}						
			
			$data['result'] = $this->model_data->piutang($where);			
			$this->load->view('pembukuan/cari_piutang', $data); 			
		}		
		public function cetak_pengeluaran($noid){			
			$id = array('id_pengeluaran' => $noid);			
			
			$search = $this->model_app->view_where('pengeluaran', $id);			
			$data['logo'] = FCPATH.'uploads/'.info()['logo'];			
			
			if($search->num_rows()>0){				
				$this->session->unset_userdata('cartp');				
				$row = $search->row_array();				
				$data['cetak'] = $row;				
				$data['info'] = info();				
				$data['detail'] = $this->model_app->view_where('pengeluaran_detail', array('id_pengeluaran' => $noid))->result_array();				
				$data['user'] = $this->model_app->view_where('tb_users', array('id_user' => $row['id_user']))->row_array();				
				$this->load->library('pdf');				
				$this->pdf->setPaper('A5', 'landscape');				
				$this->pdf->filename = "pengeluaran_".$noid."_".$row['tgl_pengeluaran'];				
				$this->pdf->load_view('pembukuan/cetak_pengeluaran', $data);				
				// $this->load->view('pembukuan/cetak_pengeluaran',$data);				
				}else{				
				$data['heading'] = 'Halaman error';				
				$data['message'] = 'Data tidak ditemukan';				
				$this->load->view('errors/html/error_404',$data);				
			}			
		}		
		
		
		
		public function reset_table(){			
			$this->db->truncate('bayar_invoice_detail'); 			
			$this->db->truncate('data_rekap'); 			
			$this->db->truncate('invoice'); 			
			$this->db->truncate('invoice_detail'); 			
			$this->db->truncate('pengeluaran'); 			
			$this->db->truncate('pengeluaran_detail'); 			
		}		
		
		public function omset_produk(){			
			cek_menu_akses();
			$data['title'] = 'Laporan Omset per produk | '.$this->title;			
			$data['tgl'] = date('d/m/Y');			
			$data['jenis'] = $this->model_app->view_where('jenis_cetakan',array('kunci'=>0,'status'=>0,'pub'=>'Y'))->result_array();			
			$this->template->load('main/themes','pembukuan/omset_produk',$data);			
		}		
		
		public function cetak_uang_masuk(){			
			if(isset($_POST['id_user'])){
				$jenis_bayar= $this->db->escape_str($this->input->post('jenis_bayar'));			
				$user= $this->db->escape_str($this->input->post('id_user'));			
				$dari= date_slash($this->db->escape_str($this->input->post('dari')));				
				$sampai= date_slash($this->db->escape_str($this->input->post('sampai')));				
				
				if($user==0){
					$where = "WHERE `bayar_invoice_detail`.`tgl_bayar` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE)";				
					$AND = "AND `bayar_invoice_detail`.`tgl_bayar` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) AND `invoice`.`status` != 'baru' AND `invoice`.`status` != 'pending' AND `invoice`.`status` != 'batal'";
					$data['user'] = '-';
					}else{
					$where = "WHERE `bayar_invoice_detail`.`tgl_bayar` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) AND `bayar_invoice_detail`.id_user = '$user'";				
					$AND = "AND `bayar_invoice_detail`.`tgl_bayar` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) AND `bayar_invoice_detail`.id_user = '$user' AND `invoice`.`status` != 'baru' AND `invoice`.`status` != 'pending' AND `invoice`.`status` != 'batal'";
					$_user = $this->model_app->view_where('tb_users', array('id_user' => $user))->row();
					$data['user'] = $_user->nama_lengkap;
				}
				
				
				$data['dari'] = $dari;
				$data['sampai'] = $sampai;
				$data['and'] = $AND;				
				$data['logo'] = FCPATH.'uploads/'.info()['logo'];				
				$data['info'] = info();				
				
				$data['alamat'] = base64_decode(info()['deskripsi']);				
				$data['detail'] = $this->model_data->carabayar($where);				
				$this->load->library('pdf');				
				$this->pdf->setPaper('A4', 'potrait');				
				$this->pdf->filename = "rekap_uang_masuk_".$user."_".$dari;				
				$this->pdf->load_view('pembukuan/cetak_uang_masuk', $data);	
				// $this->load->view('pembukuan/cetak_uang_masuk',$data);
				}else{				
				$data['heading'] = 'Halaman error';								
				$data['message'] = 'Data tidak ditemukan';								
				$this->load->view('errors/404',$data);	
			}			
		}		
		
		public function perjenis(){			
			$jenis= $this->db->escape_str($this->input->post('jenis'));			
			$info= $this->db->escape_str($this->input->post('info'));			
			$dari= $this->db->escape_str($this->input->post('dari'));			
			$sampai= $this->db->escape_str($this->input->post('sampai'));			
			if(!empty($dari) AND !empty($sampai)){
				$dari = date_slash($dari);			
				$sampai = date_slash($sampai);			
				}else{
				$dari = date('Y-m-d');			
				$sampai = date('Y-m-d');			
			}		
			if($jenis > 0){				
				$omset = "SELECT 				
				`jenis_cetakan`.`jenis_cetakan`,				
				`invoice_detail`.`id_produk`,				
				`invoice_detail`.`jenis_cetakan`,				
				`invoice_detail`.`keterangan`,				
				`invoice_detail`.`jumlah`,				
				`invoice_detail`.`harga`,				
				`invoice_detail`.`diskon`,				
				`invoice_detail`.`satuan`,				
				`invoice_detail`.`ukuran`,				
				`invoice_detail`.`id_bahan`,				
				`invoice`.`total_bayar`,				
				`invoice`.`pajak`,				
				`invoice`.`tgl_trx`,				
				`invoice`.`id_invoice`,				
				`invoice`.`id_transaksi`,				
				`invoice`.`id_konsumen`,				
				`invoice`.`id_marketing`,				
				`invoice`.`oto`,				
				`tb_users`.`nama_lengkap`,				
				`konsumen`.`nama`				
				FROM				
				`invoice_detail`				
				INNER JOIN `jenis_cetakan` ON (`invoice_detail`.`jenis_cetakan` = `jenis_cetakan`.`id_jenis`)				
				INNER JOIN `invoice` ON (`invoice_detail`.`id_invoice` = `invoice`.`id_invoice`)				
				INNER JOIN `tb_users` ON (`invoice`.`id_marketing` = `tb_users`.`id_user`)				
				INNER JOIN `konsumen` ON (`invoice`.`id_konsumen` = `konsumen`.`id`)				
				WHERE `invoice`.`tgl_trx` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) AND invoice.status='simpan' AND `invoice_detail`.`jenis_cetakan` = '$jenis' group by `invoice_detail`.`id_invoice`";				
				}else{				
				$omset = "SELECT 				
				`konsumen`.`nama`,				
				`konsumen`.`id`,				
				`invoice`.`id_invoice`,				
				`invoice`.`id_transaksi`,				
				`invoice`.`total_bayar`,				
				`invoice`.`tgl_trx`,				
				`invoice`.`oto`,				
				`tb_users`.`id_user`,				
				`tb_users`.`nama_lengkap`,				
				`invoice`.`pajak`				
				FROM				
				`konsumen`				
				INNER JOIN `invoice` ON (`konsumen`.`id` = `invoice`.`id_konsumen`)				
				INNER JOIN `tb_users` ON (`invoice`.`id_marketing` = `tb_users`.`id_user`)				
				WHERE				
				`invoice`.`tgl_trx` BETWEEN CAST('$dari' AS DATE) AND CAST('$sampai' AS DATE) AND invoice.status='simpan'";				
			}			
			$data['result'] = $this->db->query($omset)->result_array();			
			
			$data['jenis'] = $jenis;			
			$data['dari'] = $dari;			
			$data['sampai'] = $sampai;			
			
			$this->load->view('pembukuan/omset_perjenis', $data); 			
		}		
		
		public function cetak_setor()
		{
			$array  = $this->uri->segment_array();
			$iduser = decrypt_url($array[3]);
			$tgl    = $array[4];
			$tgl    = date("Y-m-d H:i:s",$array[4]);
			$data['logo'] = FCPATH.'uploads/'.info()['logo'];
			$data['logop'] = base_url().'uploads/'.info()['logo'];
			$data['info'] = info();
			$data['html'] = 'N';
			$data['iduser'] = decrypt_url($array[3]);
			$data['kasir'] = decrypt_url($array[5]);
			$data['tanggal'] = $tgl;
			
			$data['detail'] = $this->db->query("SELECT 
			`jenis_bayar`.`nama_bayar`,
			`jenis_bayar`.`id`
			FROM
			`jenis_bayar`
			RIGHT OUTER JOIN `bayar_invoice_detail` ON (`jenis_bayar`.`id` = `bayar_invoice_detail`.`id_bayar`)
			WHERE  `bayar_invoice_detail`.tgl_setor='$tgl' AND `bayar_invoice_detail`.id_user = '$iduser'
			GROUP BY
			`jenis_bayar`.`nama_bayar`, `jenis_bayar`.`id`")->result();
			$this->load->library('pdf');
			$this->pdf->setPaper('A5', 'landscape');
			$this->pdf->filename = "rekap_".$tgl;
			$this->pdf->load_view('pembukuan/print_uang_setor', $data);
			// $this->load->view('pembukuan/print_uang_setor',$data);
		}	
		
		
		public function neraca()
		{
			$data['title'] ='Laporan Neraca | '.info()['title'];
			$data['periode'] = date('m/Y');	
			$this->template->load('main/themes','pembukuan/neraca',$data);
		}
		public function laporan_neraca()
		{
			// cek_nput_post('GET');
			$tanggal = $this->input->post('tanggal'); 
			$tanggal = date_my($tanggal);
			$data['bulan'] 			= $tanggal['bulan'];
			$data['tahun'] 			= $tanggal['tahun'];
			
			$data['aktiva'] 		= $this->model_app->view_where_ordering('akun',['aktiva'=>1,'kunci'=>0],'urutan','ASC')->result();
			$data['pasiva'] 		= $this->model_app->view_where('akun',['pasiva'=>1,'kunci'=>0])->result();
			$data['kewajiban'] 			= $this->model_app->view_where('akun',['kewajiban'=>1,'kunci'=>0])->result();
			$data['modal'] 			= $this->model_app->view_where('akun',['aktiva'=>4,'kunci'=>0])->result();
			$this->load->view('pembukuan/laporan-neraca', $data, false);
		}
		public function neraca_saldo(){
			$data['title'] ='Neraca saldo | '.$this->title;
			$data['listJurnal'] = $this->model_jurnal->getJurnalByYearAndMonth();
			$data['tahun'] = $this->model_jurnal->getJurnalByYear();
			$this->template->load('main/themes','pembukuan/neraca_saldo',$data);
		}
		public function neracaSaldoDetail()
		{
			$data['title'] ='Neraca saldo | '.$this->title;
			$bulan = $this->input->post('bulan',true);
			$tahun = $this->input->post('tahun',true);
			$_data = null;
			$saldo = null;
			$dataAkun = $this->model_jurnal->getAkunByMonthYear($bulan,$tahun);
			
			foreach($dataAkun as $row){
				$_data[] = $this->model_jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
				$saldo[] =  $this->model_jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
			}
			
			$data['data'] = $_data;
			$data['saldo'] = $saldo;
			if($_data == null || $saldo == null){
				$this->session->set_flashdata('dataNull','Neraca Saldo Bulan '.getBulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
				redirect('pembukuan/neraca_saldo');
			}
			
			$data['jumlah'] = count($_data);
			$this->template->load('main/themes','pembukuan/neraca_saldo_detail',$data);
		}
		public function cetak_neraca_saldo(){
			$tanggal = $this->input->post('startdate'); 
			
			
			if(!empty($this->input->post())){
				$tanggal = date_my($tanggal);
				$data['bulan']	= $tanggal['bulan'];
				$data['tahun']	= $tanggal['tahun'];
				// // $data['penjualan'] 		= $this->model_app->view_where('jenis_cetakan',['kunci'=>0])->result();
				// // $data['pengeluaran'] 	= $this->model_app->view_where('jenis_pengeluaran',['kunci'=>0])->result();
				$data['aktiva'] = $this->model_app->view_where_ordering('akun',['aktiva'=>1,'kunci'=>0],'urutan','ASC')->result();
				$data['pasiva'] = $this->model_app->view_where('akun',['pasiva'=>1,'kunci'=>0])->result();
				$data['kewajiban'] = $this->model_app->view_where('akun',['kewajiban'=>1,'kunci'=>0])->result();
				$data['modal'] = $this->model_app->view_where('akun',['aktiva'=>4,'kunci'=>0])->result();
				
				$data['logo'] = FCPATH.'uploads/'.info()['logo_bw'];			
				$data['info'] = info();
				$data['user'] = $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
				$this->load->library('pdf');				
				$this->pdf->setPaper('A4', 'potrait');				
				$this->pdf->filename = "laporan_penjualan";	
				
				$this->pdf->load_view('pembukuan/cetak_neraca_saldo', $data);				
				
				}else{
				$data['cetak']       = 'error';
				$this->load->view('errors/404',$data);
			}
		}
		public function labarugi()
		{
			$data['title'] ='Laporan Laba Rugi | '.info()['title'];
			$data['periode'] = date('m/Y');	
			$this->template->load('main/themes','pembukuan/laba_rugi',$data);
		}
		
		
		public function laporan_laba_rugi()
		{
			// cek_nput_post('GET');
			$tanggal = $this->input->post('tanggal'); 
			$tanggal = date_my($tanggal);
			$data['bulan'] = $tanggal['bulan'];
			$data['tahun'] = $tanggal['tahun'];
			
			$data['pendapatan'] = $this->model_app->view_where('akun',['no_reff'=>411])->row();
			$data['saldo'] = $this->model_app->sum_data('saldo','jurnal_transaksi',['jenis_saldo'=>'kredit','no_reff'=>411,'YEAR(tgl_transaksi)'=>$data['tahun'],'MONTH(tgl_transaksi)'=>$data['bulan']]);
			
			$data['pengeluaran'] 	= $this->model_app->view_where('akun',['kunci'=>0,'aktiva'=>2])->result();
			
			$this->load->view('pembukuan/laporan-labarugi', $data, false);
		}
		public function cetak_laporan_laba_rugi(){
			$tanggal = $this->input->post('startdate'); 
			
			
			if(!empty($this->input->post())){
				$tanggal = date_my($tanggal);
				$data['bulan'] 			= $tanggal['bulan'];
				$data['tahun'] 			= $tanggal['tahun'];
				// $data['penjualan'] 		= $this->model_app->view_where('jenis_cetakan',['kunci'=>0])->result();
				// $data['pengeluaran'] 	= $this->model_app->view_where('jenis_pengeluaran',['kunci'=>0])->result
				
				$data['pendapatan'] = $this->model_app->view_where('akun',['no_reff'=>411])->row();
				$data['saldo'] = $this->model_app->sum_data('saldo','jurnal_transaksi',['jenis_saldo'=>'kredit','no_reff'=>411,'YEAR(tgl_transaksi)'=>$data['tahun'],'MONTH(tgl_transaksi)'=>$data['bulan']]);
				
				$data['pengeluaran'] 	= $this->model_app->view_where('akun',['kunci'=>0,'aktiva'=>2])->result();
				
				$data['logo'] = FCPATH.'uploads/'.info()['logo_bw'];			
				$data['info'] = info();
				$data['user'] = $this->model_app->view_where('tb_users', array('id_user' => $this->iduser))->row_array();
				$this->load->library('pdf');				
				$this->pdf->setPaper('A4', 'potrait');				
				$this->pdf->filename = "laporan_penjualan";	
				
				$this->pdf->load_view('laporan/cetak_laporan_laba_rugi', $data);				
				
				}else{
				$data['cetak']       = 'error';
				$this->load->view('errors/404',$data);
			}
		}
		
	}																																				