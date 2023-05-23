<?php	
	defined('BASEPATH') or exit('No direct script access allowed');	
	use Curl\Curl;
	
	class Whatsapp extends CI_Controller	
	{		
		public function __construct()		
		{			
			parent::__construct();		
			cek_session_login();
			$this->perPage = 10; 		
			$this->iduser = $this->session->idu;
			$this->title = info()['title'];
			$this->token = info()['tw'];
			$this->curl = new Curl();
		}		
		
		public function index(){
			cek_menu_akses();
			$data['title'] ='Device| '.$this->title;
			$data['ip'] = $this->input->ip_address();
			$this->template->load('main/themes','whatsapp/device',$data);
		}
		
		public function cek_device(){
			$result = $this->fonnte('https://api.fonnte.com/device');
			$html = '';
			if($result['status']==true){
				$array = $result['msg'];
				if($array->status==true){
					$device_btn = 'danger';
					$device_status = 'Click to scan';
					
					$data=[
					'device'       =>$array->device,
					'device_status'=>$array->device_status,
					'expired'      =>$array->expired,
					'messages'     =>$array->messages,
					'name'         =>$array->name,
					'package'      =>$array->package,
					'quota'        =>$array->quota,
					];
					
					// print_r($data);
					if($array->device_status=='connect'){
						$device_status = 'connect';
						$device_btn = 'success';
						$this->update_device($data);
						}else{
						$this->update_device($data);
					}
					$html .= '<tr>';
					$html .= '<td>'.$array->device.'</td>';
					$html .= '<td><button type="button" class="btn  btn-'.$device_btn.' btn-circle btn-sm rounded-circle scan_qr" id="'.$array->device.'" title="'.$device_status.'"><i class="fa fa-qrcode rounded-circle"></i></button>&nbsp;&nbsp;'.$device_status.'</td>';
					$html .= '<td>'.$array->expired.'</td>';
					$html .= '<td>'.$array->quota.'</td>';
					$html .= '<td>'.$array->package.'</td>';
					$html .= '</tr>';
					}else{
					$html .= '<tr>';
					$html .= '<td colspan="5" class="text-center">'.strtoupper($array->reason).' / BELUM PUNYA AKUN <br><a href="javascript:void(0)" class="btn btn-outline-info btn-sm register">KLIK UNTUK MENDAFTAR</a> </td>';
					$html .= '</tr>';
				}
			}
			if($result['status']==false){
				$html .= '<tr>';
				$html .= '<td colspan="5" class="text-center">'.$result['msg'].'</td>';
				$html .= '</tr>';
			}
			echo $html;
		}
		
		public function cek_status(){
			
			$result = $this->fonnte('https://api.fonnte.com/device');
			if($result['status']==true){
				if($result['msg']->status==true){
					$data = $result['msg'];
					}else{
					$data = $result['msg'];
				}
			}
			if($result['status']==false){
				$data = ['status'=>false,'msg'=>$result['msg']];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function logout_device(){
			$response = $this->fonnte('https://api.fonnte.com/disconnect');
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
		}
		public function scan_qr(){
			$result = $this->fonnte('https://api.fonnte.com/qr');
			if($result['status']==true){
				if($result['msg']->status==true){
					$data = $result['msg'];
					}else{
					$data = $result['msg'];
				}
			}
			if($result['status']==false){
				$data = ['status'=>false,'msg'=>$result['msg']];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function validate_number(){
			
			$cek_nomor = array(
			'target' => '089611274798',
			'countryCode' => '62'
			);
			
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Authorization', $this->token);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post('https://api.fonnte.com/validate', $cek_nomor);
			if ($this->curl->error) {
				$result = ['status'=>false,'msg'=>$this->curl->errorMessage];
				} else {
				$result = ['status'=>true,'msg'=>(object)$this->curl->response];
			}
			
			if($result['status']==true){
				if(!empty($result->registered)){
					$data = ['status'=>true,'msg'=>'OK'];
					}else{
					$data = ['status'=>false,'msg'=>'ERROR'];
				}
				}else{
				$data = ['status'=>false,'msg'=>$result['msg']];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		private function fonnte($url)
		{
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Authorization', $this->token);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post($url);
			if ($this->curl->error) {
				$result = ['status'=>false,'msg'=>$this->curl->errorMessage];
				} else {
				$result = ['status'=>true,'msg'=>(object)$this->curl->response];
			}
			return $result;
		}
		
		private function update_device($param)
		{
			$cek = $this->model_app->view_where('device',['token'=>$this->token]); 
			if($cek->num_rows() >0){
				$this->model_app->update('device',$param,['token'=>$this->token]);
				}else{
				$token = ["token"=>$this->token];
				$arr_input = $token + $param;
				$res= $this->model_app->input('device',$arr_input);
			}
			
		}
		
		public function get_pesan()
		{
			$status = $this->db->escape_str($this->input->post('status'));
			$idorder = $this->db->escape_str($this->input->post('idorder'));
			$nomor_order = $this->db->escape_str($this->input->post('nomor_order'));
			$tgl = $this->db->escape_str($this->input->post('tgl'));
			$user = $this->db->escape_str($this->input->post('user'));
			$deid =decrypt_url($idorder);
			
			if(empty($status)){
				$msg = "";
				
			}
			
			$pesan = $this->model_app->view_where('template_pesan',['id'=>$status])->row()->deskripsi; 
			// Array containing search string
			$searchVal = array("{token}","{selamat}", "{invoice}", "{tgl}", "{fo}", "{hp}","{total}","{bayar}","{piutang}");
			
			// Array containing replace string from  search string
			$replaceVal = array($idorder,ucapan(), $nomor_order, dtimes($tgl,false,false), $user, info()['phone'],$this->total($deid)['total'],$this->total($deid)['bayar'],$this->total($deid)['piutang']);
			
			// Function to replace string
			$msg = str_replace($searchVal, $replaceVal, $pesan);
			
			
			$data = ['status'=>true,'msg'=>$msg];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function kirim_pesan()
		{
			$nomor_tujuan = $this->db->escape_str($this->input->post('nomor_tujuan'));
			$device_status = $this->db->escape_str($this->input->post('device_status'));
			$isi_pesan = $this->input->post('isi_pesan');
			$remove = array("\r\n", "\r", "<p>", "</p>", "<h1>", "</h1>", "<br>", "<br />", "<br/>");
			$content = str_replace($remove, '', $isi_pesan);
			
			$data_send = array(
			'target' => $nomor_tujuan,
			'message' => $isi_pesan,
			'countryCode' => '62'
			);
			
			if($device_status==true){
				$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Authorization', $this->token);
				$this->curl->setHeader('Content-Type', 'application/json');
				$this->curl->post('https://api.fonnte.com/send', $data_send);
				if ($this->curl->error) {
					$result = ['status'=>false,'msg'=>$this->curl->errorMessage];
					} else {
					$result = ['status'=>true,'msg'=>(object)$this->curl->response];
				}
				
				}else{
				$result = ['status'=>false,'target'=>hp62($nomor_tujuan),'msg'=>$isi_pesan];
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
		}
		
		public function get_form_wa()
		{
			$id = $this->db->escape_str($this->input->post('id'));
			$nomor = $this->db->escape_str($this->input->post('nomor'));
			$tgl = $this->db->escape_str($this->input->post('tgl'));
			$deid =decrypt_url($id);
			$data['device_status'] = cek_device_status();
			$data['id'] = $id;
			$data['nomor'] = $nomor;
			$data['tgl'] = $tgl;
			$data['user'] = cekUser($deid)['nama'];
			$data['device'] = get_device();
			$data['id_invoice'] = get_id_transaksi($deid)['nomor_order'];
			$data['jenis'] = $this->model_app->view_where('template_pesan',['active'=>'Y'])->result();
			$data['kirim'] = $this->model_app->view_where('invoice',['id_invoice'=>$deid])->row();
			$this->load->view('whatsapp/kirim_wa',$data);
		}
		
		public function template(){
			$data['title'] ='Template Pesan | '.$this->title;
			$this->template->load('main/themes','whatsapp/template',$data);
		}
		
		public function data_template()
		{
			$data['record'] = $this->model_app->view_where_ordering('template_pesan',array(),'id','DESC')->result();
			$this->load->view('whatsapp/data_template',$data);
		}
		
		private function total($id)
		{
			$total_order = $this->model_app->sum_data('total_bayar','invoice',['id_invoice'=>$id]);
			$totalorder = $total_order > 0 ? rp($total_order) : 0;
			$total_bayar = $this->model_app->sum_data('jml_bayar','bayar_invoice_detail',['id_invoice'=>$id]);
			$totalbayar = $total_bayar > 0 ? rp($total_bayar) : 0;
			$piutang = $total_bayar > 0 ?  $total_order - $total_bayar : 0;
			return ['total'=>$totalorder,'bayar'=>$totalbayar,'piutang'=>rp($piutang)];
		}
		
		public function get_template()
		{
			$id = $this->db->escape_str($this->input->post('id'));
			$row = $this->model_app->view_where('template_pesan',['id'=>$id])->row(); 
			$result = ['status'=>true,
			'id'=>$id,
			'title'=>$row->title,
			'deskripsi'=>$row->deskripsi,
			'publish'=>$row->active
			];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
		}		
		
		public function save_template()
		{
			
			$type = $this->db->escape_str($this->input->post('type'));
			$title = $this->db->escape_str($this->input->post('title'));
			$deskripsi = $this->input->post('deskripsi');
			$active = $this->input->post('publish');
			
			if($type=='add'){
				simpan_demo('Simpan');
				$param = ['title'=>$title,'deskripsi'=>$deskripsi,'status'=>5,'active'=>$active];
				$input=  $this->model_app->input('template_pesan',$param);
				if($input['status']=='ok'){
					$result = array('status'=>true,'msg'=>'Data berhasil diinput');
					}else{
					$result = array('status'=>false);
				}
			}
			if($type=='edit'){
				$id = $this->db->escape_str($this->input->post('id'));
				$param = ['title'=>$title,'deskripsi'=>$deskripsi,'active'=>$active];
				$update = $this->model_app->update('template_pesan',$param,['id'=>$id]);
				if($update['status']=='ok')
				{
					$result = ['status'=>true,'msg'=>'Berhasil'];
					}else{
					$result = ['status'=>false,'msg'=>'Gagal'];
				}
			}
			
			if($type=='hapus'){
				simpan_demo('Hapus');
				cek_crud_akses(10);
				$id = $this->db->escape_str($this->input->post('id'));
				$cek = $this->model_app->view_where('template_pesan',array('id' => $id));
				if($cek->num_rows() > 0){
					$res=$this->model_app->hapus('template_pesan',array('id' => $id));
					if($res['status']=='ok'){
						$result = array('status'=>200,'msg'=>'Data berhasil dihapus');
						}else{
						$result = array('status'=>400,'msg'=>'Data gagal dihapus');
					}
					}else{
					$result = array('status'=>400,'msg'=>'Data tidak ditemukan');
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
		}
		
		
	}																																																					