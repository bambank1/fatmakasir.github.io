<?php	
	defined('BASEPATH') or exit('No direct script access allowed');	
	
	class Pengeluaran extends CI_Controller	
	{		
		public function __construct()		
		{			
			parent::__construct();		
			
			cek_session_login();
			$this->load->helper('date');			
			$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");			
			$this->perPage = 10; 		
			$this->iduser = $this->session->idu;
			$this->title = info()['title']; 
		}		
		public function data(){
			cek_menu_akses();
			$format = "%Y-%m-%d";			
			$harian = mdate($format);			
			$data['title'] = 'Laporan Pengeluaran | '.$this->title;	
			$tgl_awal = date('01/m/Y', strtotime($harian));
			$data['tgl_awal'] = $tgl_awal;			
			$data['tgl'] = date('d/m/Y');			
			$data['jenis'] = $this->model_app->view_where('jenis_pengeluaran',array('id_akun!='=>102,'kunci'=>0,'pub'=>'Y'))->result_array();			
			$data['pilihan'] = $this->model_app->view('tb_users');			
			
			$conditions['where'] = array(
			'tgl_pengeluaran' => $harian			
			);			
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->model_data->getPengeluaran($conditions); 			
			// Pagination configuration 			
			$config['target']      = '#dataListPengeluaran'; 			
			$config['base_url']    = base_url('ajax/ajaxPengeluaran'); 			
			$config['total_rows']  = $totalRec; 			
			$config['per_page']    = $this->perPage; 			
			
			// Initialize pagination library 			
			$this->ajax_pagination->initialize($config); 			
			
			// Get records 			
			$conditions = array( 			
			'limit' => $this->perPage 			
			); 			
			$conditions['where'] = array(
			'tgl_pengeluaran' => $harian			
			);	
			$data['result'] = $this->model_data->getPengeluaran($conditions); 			
			
			$this->template->load('main/themes','pengeluaran/data_pengeluaran',$data);			
		}
		public function simpan_bayar_pengeluaran(){
			
			// Array ( [id] => 1 [total] => 100000 [jml_bayar] => 100000 [jatuh_tempo] => [cara_bayar] => 1 [sumber_kas] => 2 ) 
			$id_pengeluaran = $this->db->escape_str($this->input->post('id'));
			$total          = $this->db->escape_str($this->input->post('total'));
			$jml_bayar      = $this->db->escape_str($this->input->post('jml_bayar'));
			
			$cara_bayar     = $this->db->escape_str($this->input->post('cara_bayar'));
			$sumber_kas     = $this->db->escape_str($this->input->post('sumber_kas'));
			
			// print_r($_POST);
			// exit();
			if($cara_bayar==3){
				$jatuh_tempo    = $this->db->escape_str($this->input->post('jatuh_tempo'));
				$jatuh_tempo    = date_slash($jatuh_tempo);
				$data = array('total_bayar' =>$total,'tgl_jatuhtempo'=>$jatuh_tempo,'id_kas'=>$sumber_kas,'id_bayar'=>$cara_bayar);
				$where = array('id_pengeluaran'=>$id_pengeluaran,'id_user'=>$this->iduser);			
				$res= $this->model_app->update('pengeluaran', $data, $where);			
				if($res['status']=='ok'){				
					$data = array("status"=>200,"msg"=>"simpan data");				
					}else{				
					$data = array("status"=>400,"msg"=>"error");				
				}
				}else{
				$data = array(
				'id_pengeluaran'=>$id_pengeluaran,
				'tgl_bayar'=>date("Y-m-d"),
				'jml_bayar'=>$jml_bayar,
				'id_bayar'=>$cara_bayar,
				'id_sub_bayar'=>$sumber_kas,
				'id_user'=>$this->iduser
				);
				$sum_detail = $this->model_app->sum_data_math("SUM(jumlah * harga) AS total",'pengeluaran_detail',['id_pengeluaran'=>$id_pengeluaran],'id_pengeluaran');
				$sisa = $sum_detail - $jml_bayar;
				//jurnal
				$reff = "P-$id_pengeluaran";
				$ket_debet = "No. " . $id_pengeluaran.' - ';
				if($sum_detail == $jml_bayar){
					$ket_kredit = "Bayar pengeluaran No. " . $id_pengeluaran;
					$query = $this->model_app->view_select_where('id_biaya,jumlah,harga,keterangan','pengeluaran_detail',['id_pengeluaran'=>$id_pengeluaran])->result();
					foreach($query AS $val){
						$jmlbayar = $val->jumlah * $val->harga;
						$batch_debet[] = [
						"id_user" => $this->iduser,
						"no_reff" => getIdAkunPengeluaran($val->id_biaya),
						"reff" => $reff,
						"tgl_input" => today(),
						"tgl_transaksi" => today(),
						"jenis_saldo" => "debit",
						"saldo" => $jmlbayar,
						"keterangan" => $ket_debet.$val->keterangan,
						];
					}
					$batch_kredit = [
					"id_user" => $this->iduser,
					"no_reff" => getIdAkun($cara_bayar),
					"reff" => $reff,
					"tgl_input" => today(),
					"tgl_transaksi" => today(),
					"jenis_saldo" => "kredit",
					"saldo" => $jml_bayar,
					"keterangan" => $ket_kredit,
					];
					$this->db->insert_batch('jurnal_transaksi', $batch_debet);
					$this->db->insert('jurnal_transaksi', $batch_kredit);
					//jika bayar dp
					}elseif($jml_bayar < $sum_detail){
					$ket_kredit = "Bayar pengeluaran No. " . $id_pengeluaran;
					$ket_debit_sisa = "Utang usaha No. " . $id_pengeluaran;
					$ket_kredit_sisa = "Utang usaha No. " . $id_pengeluaran;
					$query = $this->model_app->view_select_where('id_biaya,jumlah,harga,keterangan','pengeluaran_detail',['id_pengeluaran'=>$id_pengeluaran])->result();
					foreach($query AS $val){
						$jmlbayar = $val->jumlah * $val->harga;
						$batch_debet[] = [
						"id_user" => $this->iduser,
						"no_reff" => getIdAkunPengeluaran($val->id_biaya),
						"reff" => $reff,
						"tgl_input" => today(),
						"tgl_transaksi" => today(),
						"jenis_saldo" => "debit",
						"saldo" => $jmlbayar,
						"keterangan" => $ket_debet.$val->keterangan,
						];
						
						$batch_debet_sisa[] = [
						"id_user" => $this->iduser,
						"no_reff" => getIdAkunPengeluaran($val->id_biaya),
						"reff" => $reff,
						"tgl_input" => today(),
						"tgl_transaksi" => today(),
						"jenis_saldo" => "debit",
						"saldo" => $sisa,
						"keterangan" => $ket_debet.$val->keterangan,
						];
					}
					$batch_kredit = [
					"id_user" => $this->iduser,
					"no_reff" => getIdAkun($cara_bayar),
					"reff" => $reff,
					"tgl_input" => today(),
					"tgl_transaksi" => today(),
					"jenis_saldo" => "kredit",
					"saldo" => $jml_bayar,
					"keterangan" => $ket_kredit,
					];
					$batch_kredit_sisa = [
					"id_user" => $this->iduser,
					"no_reff" => 211,
					"reff" => $reff,
					"tgl_input" => today(),
					"tgl_transaksi" => today(),
					"jenis_saldo" => "kredit",
					"saldo" => $sisa,
					"keterangan" => $ket_kredit_sisa,
					];
					$this->db->insert_batch('jurnal_transaksi', $batch_debet);
					$this->db->insert_batch('jurnal_transaksi', $batch_debet_sisa);
					$this->db->insert('jurnal_transaksi', $batch_kredit);
					$this->db->insert('jurnal_transaksi', $batch_kredit_sisa);
					}else{
					$ket_kredit = "Utang usaha No. " . $id_pengeluaran;
					$query = $this->model_app->view_select_where('id_biaya,jumlah,harga,keterangan','pengeluaran_detail',['id_pengeluaran'=>$id_pengeluaran])->result();
					foreach($query AS $val){
						$jmlbayar = $val->jumlah * $val->harga;
						$batch_debet[] = [
						"id_user" => $this->iduser,
						"no_reff" => getIdAkunPengeluaran($val->id_biaya),
						"reff" => $reff,
						"tgl_input" => today(),
						"tgl_transaksi" => today(),
						"jenis_saldo" => "debit",
						"saldo" => $jmlbayar,
						"keterangan" => $ket_debet.$val->keterangan,
						];
					}
					$batch_kredit = [
					"id_user" => $this->iduser,
					"no_reff" => 211,
					"reff" => $reff,
					"tgl_input" => today(),
					"tgl_transaksi" => today(),
					"jenis_saldo" => "kredit",
					"saldo" => $jml_bayar,
					"keterangan" => $ket_kredit,
					];
					$this->db->insert_batch('jurnal_transaksi', $batch_debet);
					$this->db->insert('jurnal_transaksi', $batch_kredit);
				}
				// print_r($batch_kredit);
				$_data = array('total_bayar' =>$total,'id_kas'=>$sumber_kas,'id_bayar'=>$cara_bayar);
				$where = array('id_pengeluaran'=>$id_pengeluaran,'id_user'=>$this->iduser);			
				$update= $this->model_app->update('pengeluaran', $_data, $where);			
				if($update['status']=='ok'){
					$input = $this->model_app->input('bayar_pengeluaran', $data);
					if($input['status']=='ok'){
						$data = array('status'=>200,'msg'=>'sukses');
						$autoNumber = autoNumber(NOMOR_REFF,DIGIT_REFF,'id_generate','kas_masuk');
						$this->model_app->insert('kas_masuk',['id_bayar'=>$cara_bayar,'no_reff'=>$sumber_kas,'id_user'=>$this->iduser,'id_generate'=>$autoNumber,'pengeluaran'=>$jml_bayar,'catatan'=>'Pengeluaran No.#'.$id_pengeluaran]);
						}else{				
						$data = array('status'=>400,'msg'=>'Input Gagal');				
					}				
					}else{				
					$data = array("status"=>400,"msg"=>"error");				
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function simpan_bayar_piutang(){
			
			$idinfo = $this->db->escape_str($this->input->post('idinfo'));
			$id_pengeluaran = $this->db->escape_str($this->input->post('id'));
			$total          = $this->db->escape_str($this->input->post('total'));
			$jml_bayar      = $this->db->escape_str($this->input->post('jml_bayar'));
			$cara_bayar     = $this->db->escape_str($this->input->post('cara_bayar'));
			$sumber_kas     = $this->db->escape_str($this->input->post('sumber_kas'));
			
			// print_r($_POST);
			// exit();
			$data = array(
			'id_pengeluaran'=>$id_pengeluaran,
			'tgl_bayar'=>date("Y-m-d"),
			'jml_bayar'=>$jml_bayar,
			'id_bayar'=>$cara_bayar,
			'id_sub_bayar'=>$sumber_kas,
			'id_user'=>$this->iduser
			);
			
			$sum_bayar = $this->model_app->sum_data_group('jml_bayar','bayar_pengeluaran',['id_pengeluaran'=>$id_pengeluaran],'id_pengeluaran');
			
			$sum_detail = $this->model_app->sum_data_math("SUM(jumlah * harga) AS total",'pengeluaran_detail',['id_pengeluaran'=>$id_pengeluaran],'id_invoice');
			
			$sisa = $sum_detail - $sum_bayar;
			if($sisa > 0){
				$input = $this->model_app->input('bayar_pengeluaran', $data);
				if($input['status']=='ok'){
					$data = array('status'=>200,'msg'=>'sukses');
					$autoNumber = autoNumber(NOMOR_REFF,DIGIT_REFF,'id_generate','kas_masuk');
					$this->model_app->insert('kas_masuk',['id_bayar'=>$cara_bayar,'no_reff'=>$sumber_kas,'id_user'=>$this->iduser,'id_generate'=>$autoNumber,'pengeluaran'=>$this->input->post('total'),'catatan'=>'Bayar Hutang Usaha No.#'.$id_pengeluaran]);
					}else{
					$data = array('status'=>400,'msg'=>'Input Gagal');				
				}				
				}else{
				$input = $this->model_app->input('bayar_pengeluaran', $data);
				
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function jenis_kas(){
			$id = $this->db->escape_str($this->input->post('id'));
			if($id==2){
				$result = $this->model_app->view_where('jenis_kas',array('id'=>3,'kunci'=>0));
				}elseif($id==3){
				$result = $this->model_app->view_where('jenis_kas',array('id'=>4,'kunci'=>1));
				}else{
				$result = $this->model_app->view_where('jenis_kas',array('id !='=>3,'kunci'=>0));
			}
			$data = array();
			foreach ($result->result() as $row)
			{
				$data[] = array("id"=>$row->id_akun,"name"=>$row->title);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function list_bayar(){
			
			$noin = $this->db->escape_str($this->input->post('id'));
			$data['total_bayar']=$this->model_app->pilih('total_bayar','pengeluaran',array('id_pengeluaran'=>$noin))->row();
			$data['bayar']=$this->model_app->view_where('bayar_pengeluaran',array('id_pengeluaran'=>$noin));
			$this->load->view('pengeluaran/list_bayar',$data);
		}
		public function save_data(){
			$id = $this->input->post('id');			
			$idkas = $this->input->post('kas');
			$jenis_bayar = $this->input->post('jenis_bayar');
			if($this->input->post('tempo')==""){
				$tgl = null;		
				}else{
				$tgl = date_slash($this->input->post('tempo'));		
			}
			$data = array('total_bayar' =>$this->input->post('total'),'tgl_jatuhtempo'=>$tgl,'id_kas'=>$idkas,'id_bayar'=>$jenis_bayar);	
			
			$where = array('id_pengeluaran'=>$id,'id_user'=>$this->iduser);			
			$res= $this->model_app->update('pengeluaran', $data, $where);			
			if($res['status']=='ok'){				
				$data = array("ok"=>200,"msg"=>"ok",'tgl'=>$this->input->post('tempo'));				
				}else{				
				$data = array("ok"=>400,"msg"=>"error");				
			}			
			$this->output			
			->set_content_type('application/json')			
			->set_output(json_encode($data));			
		}
		
		public function save_pengeluaran(){			
			$id = $this->input->post('id');			
			$id_user = $this->iduser;
			$tgl = date_slash($this->input->post('tgl'));			
			$data = array('total_bayar' =>$this->input->post('total'), 			
			'pos' =>'Y','tgl_pengeluaran'=>$tgl);			
			$where = array('id_pengeluaran'=>$id,'id_user'=>$id_user);			
			$res= $this->model_app->update('pengeluaran', $data, $where);			
			if($res['status']=='ok'){
				$this->model_app->update('tb_users',array('last_idp'=>0),array('id_user'=>$id_user));
				$this->session->unset_userdata('cartp');				
				$data = array("ok"=>"ok","id"=>$id);				
				}else{				
				$data = array('error');				
			}			
			$this->output			
			->set_content_type('application/json')			
			->set_output(json_encode($data));			
		}
		
		public function save_detail(){			
			$id = $this->input->post('id');			
			$jenis = $this->input->post('jenis');	
			if(empty($jenis)){
				$jenis = 1;	
			}
			$ket = strtolower($this->input->post('ket'));			
			$ket = ucwords($ket);
			$data = array('keterangan' =>$ket, 			
			'id_biaya' =>$jenis, 			
			'jumlah' =>$this->input->post('jum'), 			
			'harga' =>$this->input->post('harga'), 			
			'satuan' =>$this->input->post('satuan'));			
			$where = array('no'=>$id);			
			$res= $this->model_app->update('pengeluaran_detail', $data, $where);			
			if($res['status']=='ok'){				
				$data = array("ok"=>"ok","id"=>$id);				
				}else{				
				$data = array('error');				
			}			
			echo json_encode($data);			
		}		
		public function hapus_detail(){			
			$idx = $this->input->post('id');			
			$id = array('no' => $idx);			
			$res=$this->model_app->hapus('pengeluaran_detail',$id);			
			if($res['status']=='ok'){				
				$data = array('ok'=>'ok','msg'=>'Data berhasil dihapus');				
				}else{				
				$data = array('ok'=>'err','msg'=>'Data gagal dihapus');				
			}			
			$this->output			
			->set_content_type('application/json')			
			->set_output(json_encode($data));			
		}		
		
		public function add_detail(){			
			$id = $this->db->escape_str($this->input->post('id'));			
			$res = $this->model_app->input('pengeluaran_detail', array('id_pengeluaran' => $id,'id_biaya'=>1));
			$last_id = $res['id'];			
			if($res['status']=='ok'){				
				$data = array('ok'=>'ok','idr'=>$last_id,'jenis'=>1,'msg'=>'sukses');				
				}else{				
				$data = array('ok'=>'no','idr'=>0,'jenis'=>1,'msg'=>'Input Gagal');				
			}			
			echo json_encode($data);			
		}
		
		public function load_modal(){
			$info= $this->db->escape_str($this->input->post('info'));			
			$id= $this->db->escape_str($this->input->post('id'));			
			$iduser= $this->db->escape_str($this->input->post('user'));			
			$format = "%Y-%m-%d";			
			$mdate = mdate($format);		
			
			$arr['a'] = '';
			$data['jenis_bayar'] = $this->model_app->view_where('jenis_bayar',['publish'=>'Y'])->result();
			if($iduser=='' AND $id !=0){
				$arr['a'] = 'a';
				$search=$this->model_app->edit('pengeluaran',array('id_pengeluaran'=>$id));				
				$rows =$search->row();	
				$data['info'] =$info;
				$data['loadp'] =$rows;				
				$data['loadd'] = $this->model_app->pengeluaran_detail(array('pengeluaran_detail.id_pengeluaran' => $rows->id_pengeluaran))->result_array();				
				$cek_user=$this->model_app->edit('tb_users',array('id_user'=>$rows->id_user))->row();				
				$data['nama'] =$cek_user->nama_lengkap;				
				$data['id_user'] =$cek_user->id_user;				
				$this->load->view('pengeluaran/load_modal', $data, false); 				
				
				}else{
				if(empty($iduser)){
					$iduser = $this->iduser;
					}else{
					$iduser = $iduser;
				}
				$cek_user=$this->model_app->edit('tb_users',array('id_user'=>$iduser))->row();				
				$data['nama'] =$cek_user->nama_lengkap;				
				$data['id_user'] =$iduser;				
				
				//tambah				
				if($info=='tambah'){
					if(isset($this->session->cartp)){
						$arr['a'] = 'b';
						$cek=$this->model_app->edit('pengeluaran',array('id_pengeluaran'=>$this->session->cartp,'id_user'=>$iduser));						
						$rows = $cek->row();						
						$data['info'] =$info;		
						$data['loadp'] =$rows;		
						$data['loadd'] = $this->model_app->pengeluaran_detail(array('pengeluaran_detail.id_pengeluaran' => $rows->id_pengeluaran))->result_array();						
						$this->load->view('pengeluaran/load_modal', $data, false); 						
						}else{
						$arr['a'] = 'c';
						$array = array('tgl_pengeluaran'=>$mdate,'id_user'=>$iduser);						
						$this->model_app->insert('pengeluaran',$array);						
						$last_id = $this->db->insert_id();						
						$this->session->set_userdata(array('cartp'=>$last_id));						
						$this->model_app->insert('pengeluaran_detail',array('id_pengeluaran'=>$last_id,'id_biaya'=>1));$data['info'] =$info;					
						$data['loadp'] = $this->model_app->view_where('pengeluaran', array('id_pengeluaran' => $last_id))->row();						
						$data['loadd'] = $this->model_app->pengeluaran_detail(array('pengeluaran_detail.id_pengeluaran' => $last_id))->result_array();						
						$this->model_app->update('tb_users',array('last_idp'=>$last_id),array('id_user'=>$iduser));						
						$this->load->view('pengeluaran/load_modal', $data, false); 						
					}					
					//edit					
					}elseif($info=='bayar'){
					$arr['a'] = 'd';
					$search=$this->model_app->edit('pengeluaran',array('id_pengeluaran'=>$id));					
					$rows =$search->row();					
					if($rows->rekap=='Y'){						
						echo "error";						
						}else{
						$data['info'] =$info;						
						$data['loadp'] =$rows;						
						$data['loadd'] = $this->model_app->pengeluaran_detail(array('pengeluaran_detail.id_pengeluaran' => $rows->id_pengeluaran))->result_array();						
						$this->load->view('pengeluaran/load_modal', $data, false); 						
					}		
					}elseif($info=='edit' OR $info=='view'){
					$arr['a'] = 'e';
					$search=$this->model_app->edit('pengeluaran',array('id_pengeluaran'=>$id));					
					$rows =$search->row();		
					$data['info'] =$info;						
					$data['loadp'] =$rows;						
					$data['loadd'] = $this->model_app->pengeluaran_detail(array('pengeluaran_detail.id_pengeluaran' => $rows->id_pengeluaran))->result_array();						
					$this->load->view('pengeluaran/load_modal', $data, false);
					}elseif($info=='lunas'){
					$arr['a'] = 'f';
					$search=$this->model_app->edit('pengeluaran',array('id_pengeluaran'=>$id));					
					$rows =$search->row();		
					$data['info'] =$info;						
					$data['loadp'] =$rows;						
					$data['loadd'] = $this->model_app->pengeluaran_detail(array('pengeluaran_detail.id_pengeluaran' => $rows->id_pengeluaran))->result_array();						
					$this->load->view('pengeluaran/load_modal', $data, false);
				}
				
			}			
			// print_r($arr);
		}
		public function load_total_bayar(){
			$id= $this->db->escape_str($this->input->post('id'));		
			$total = $this->model_cek->sum_pengeluaran(['id_pengeluaran'=>$id]);
			echo $total;
		}
		public function load_bayar(){
			$info= $this->db->escape_str($this->input->post('info'));			
			$id= $this->db->escape_str($this->input->post('id'));			
			$iduser= $this->db->escape_str($this->input->post('user'));			
			$format = "%Y-%m-%d";			
			$mdate = mdate($format);		
			$data['jenis_bayar'] = $this->model_app->view_where('jenis_bayar',['publish'=>'Y'])->result();
			if($id > 0){
				if($info=='bayarh'){
					$search=$this->model_app->edit('bayar_pengeluaran',array('id_pengeluaran'=>$id));
					$data['bayar'] =$search;					
					$this->load->view('pengeluaran/list_piutang', $data, false); 				
					}else{
					$search=$this->model_app->edit('bayar_piutang',array('id_pengeluaran'=>$id));
					$data['bayar'] =$search;					
					$this->load->view('pengeluaran/list_piutang', $data, false); 	
				}
			}			
		}
		public function del_bayar()
		{
			
			cek_nput_post('GET');
			cek_crud_akses(10);
			$id = $this->db->escape_str($this->input->post('id'));
			$idin = $this->db->escape_str($this->input->post('idin'));
			$kunci      = $this->db->escape_str($this->input->post('kunci'));
			$jml        = $this->db->escape_str($this->input->post('jml'));
			$idbayar	= $this->db->escape_str($this->input->post('idbayar'));
			
			if ($this->session->level == 'admin' or $this->session->level == 'owner') {
				$where = array('id' => $id, 'id_pengeluaran' => $idin);
				} else {
				$where = array('id' => $id, 'id_pengeluaran' => $idin, 'kunci' => $kunci);
			}
			$res = $this->model_app->delete('bayar_pengeluaran', $where);
			if ($res == true) {
				$_where = ["catatan" => "Pengeluaran No.#" . $idin];
				$this->model_app->delete("kas_masuk", $_where);
				$this->model_app->delete("jurnal_transaksi", ['reff'=>'P-'.$idin]);
				 
				$data = array('ok' => 'ok', 'uang' => $jml);
				} else {
				$data = array('ok' => 'no', 'uang' => 0);
			}
			echo json_encode($data);
		}
	}																																																																																																																														