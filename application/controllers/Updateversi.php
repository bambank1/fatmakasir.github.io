<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	use \VisualAppeal\AutoUpdate;
	use Curl\Curl;
	
	class Updateversi extends CI_Controller
	{
		public $title;
		public $versi;
		private $user;
		private $pass;
		private $api_key;
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
			// cek_tabel();
			cek_session_login();
			
			$this->load->library('add_menu');
			$this->lang->load('update_controller_lang', 'indonesia');
			
			$this->curl        = new Curl();
			$this->url_checker = URL_CHECKER;
			$this->url_api     = URL_API;
			$this->api_key     = info()['api_key'];
			$this->title       = info()['title'];
			$this->versi       = info()['version'];
			
			$this->user = info()['user_name'];
		}
		
		/**
			* index
			*
			* @return html
		*/
		public function index()
		{
			cek_menu_akses();
			$data['title'] = 'Cek Update | ' . $this->title;
			$data['tema'] =  info()['tema'];
			$data['nama'] =  $this->session->nama;
			$this->template->load('main/themes', 'update', $data);
		}
		
		/**
			* cek_notif
			*
			* @return html
		*/
		public function cek_notifikasi()
		{
			// cek_nput_post('GET');
			$cek_notif = $this->input->post('tipe');
			
			$fileOffline = FCPATH . "version.json";
			
			if (!is_file($fileOffline)) {
				echo "";
				die();
			}
			if (ENVIRONMENT=='development') {
				$url_checker = URL_CHECKER_SANDBOX;
				$file_checker = '/update_checker_sandbox_kasir.json';
				} else {
				$url_checker = $this->url_checker;
				$file_checker = '/update_checker_kasir.json';
			}
			$html = "";
			$url_update = base_url('updateversi');
			$url_checker = $url_checker . $file_checker;
			 
			$fileOffline = site_url('', 'http') . "version.json";
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->get($url_checker);
			if ($this->curl->error) {
				$response  =  (object)$this->curl->errorMessage;
				 
				$html .= '';
				} else {
				$response = (object)$this->curl->response;
				$last_version = end($response->aplikasi);
		 
				$this->curl->get($fileOffline);
				if ($this->curl->error) {
					// $response_offline  =  (object)$this->curl->errorMessage;
					$html .= '';
					} else {
					$response_offline = (object)$this->curl->response;
					if ($last_version->version == $response_offline->aplikasi[0]->version) {
						$html .= '<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-bell fa-fw"></i>
						<span class="badge badge-danger badge-counter" id="remove-notif">0</span>
						</a>';
						} elseif ($last_version->version > $response_offline->aplikasi[0]->version) {
						$html .= '<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-bell fa-fw"></i>
						<span class="badge badge-danger badge-counter">1</span>
						</a>
						<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="alertsDropdown">
						<h6 class="dropdown-header">Versi ' . $last_version->version . ' tersedia</h6>
						<div id="slimm">
						<a class="dropdown-item d-flex align-items-center remove-notif" href="' . $url_update . '" id="remove-notif">
						<div class="dropdown-list-image mr-3">
						<img class="rounded-circle" src="' . $last_version->url_image . '" style="max-width: 60px" alt="">
						<div class="status-indicator bg-success"></div>
						</div>
						<div>
						<div class="small text-gray-500">Versi ' . $last_version->version . '</div>
						<span class="font-weight-bold">' . $last_version->caption . '</span>
						<div class="small text-gray-500">' . dtime($last_version->updateDate) . '</div>
						</div>
						</a>';
						
						array_pop($response->aplikasi);
						rsort($response->aplikasi);
						foreach ($response->aplikasi as $key => $val) {
							$html .= '
							<a class="dropdown-item d-flex align-items-center remove-notif" href="#" id="remove-notif">
							<div class="dropdown-list-image mr-3">
							<img class="rounded-circle" src="' . $val->url_image . '" style="max-width: 60px" alt="">
							<div class="status-indicator bg-default"></div>
							</div>
							<div>
							<div class="small text-gray-500">Versi ' . $val->version . '</div>
							<span class="font-weight-bold">' . $val->caption . '</span>
							<div class="small text-gray-500">' . dtime($val->updateDate) . '</div>
							</div>
							</a>';
						}
						$html .= '</div>
						<a class="dropdown-item text-center small text-gray-500" href="https://pospercetakan.my.id/detail-update" target="_blank">Detail update</a>';
						} else {
						$html .= '';
					}
				}
				$html .= '<script>
				$("#slimm").slimscroll({
				height: "260px"
				});
				</script>';
				echo $html;
			}
		}
		
		
		/**
			* update_app
			*
			* @return json
		*/
		public  function update_app()
		{
			
			$command = strtolower($this->input->post('command'));
			if (ENVIRONMENT=='development') {
				$url_api = URL_API_SANDBOX;
				$url_api = $this->url_api;
				} else {
				$url_api = $this->url_api;
			}
			
			if ($command == 'update') {
				update_demo_admin($this->session->nama);
				$data = [
				'APP-API-KEY'  => $this->api_key,
				'text'  => $command
				];
				
				$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Content-Type', 'application/json');
				$this->curl->post($url_api . '/api/command', $data);
				if ($this->curl->error) 
				{
					$response = $this->curl->errorMessage;
					echo json_encode($response);
					exit;
					} else {
					$response = (object)$this->curl->response;
				}
				
				$update = new AutoUpdate($response->status, __DIR__ . $response->path, $response->time);
				$update->setCurrentVersion($this->versi);
				
				$update->setInstallDir('./');
				$update->setBasicAuth($this->user, $response->auth);
				
				$logger = new \Monolog\Logger("default");
				$logger->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . $response->logs));
				$update->setLogger($logger);
				
				// Check for a new update
				if ($update->checkUpdate() === false) {
					die($this->lang->line('check_update'));
				}
				
				if ($update->newVersionAvailable()) {
					// Install new update
					$arr[] = $this->lang->line('new_version') .' : ' . $update->getLatestVersion();
					
					$array_map =  array_map(function ($version) {
						return (string) $version;
					}, $update->getVersionsToUpdate());
					
					$arr[] =  $this->lang->line('processing_update') . ':';
					$arr[] =  $array_map;
					
					// Optional - empty log file
					$f = @fopen(__DIR__ . $response->logs, 'rb+');
					if ($f !== false) {
						ftruncate($f, 0);
						fclose($f);
					}
					
					// Optional Callback function - on each version update
					function eachUpdateFinishCallback($updatedVersion)
					{
						$arr[] =  'callback for version' . $updatedVersion;
					}
					$update->onEachUpdateFinish('eachUpdateFinishCallback');
					
					// Optional Callback function - on each version update
					function onAllUpdateFinishCallbacks($updatedVersions)
					{
						$arr[] =  'callback for all updated versions : ';
						
						foreach ($updatedVersions as $v) {
							$arr[] =   $v;
						}
					}
					$update->setOnAllUpdateFinishCallbacks('onAllUpdateFinishCallbacks');
					
					$result = $update->update(false);
					
					if ($result === true) {
						$res = $this->model_app->update('info', ['version' => $update->getLatestVersion()], ['id' => 1]);
						$arr[] =  'update success';
						} else {
						$arr[] =  'update failed : ' . $result . '!';
						
						if ($result = AutoUpdate::ERROR_SIMULATE) {
							$arr[] = $update->getSimulationResults();
						}
					}
					} else {
					$arr[] =  'the latest current version';
				}
				} elseif ($command == 'ping') {
				$output ='';
				$status ='';
				$ip =   "pospercetakan.my.id";
				exec("ping -n 3 $ip", $output, $status) . '\n';
				$arr = $output;
				} elseif ($command == 'log') {
				update_demo_admin($this->session->nama);
				$data = [
				'APP-API-KEY'  => $this->api_key,
				'text'  => $command
				];
				
				$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Content-Type', 'application/json');
				$this->curl->post($url_api . '/api/command', $data);
				if ($this->curl->error) 
				{
					$response = $this->curl->errorMessage;
					echo json_encode($response);
					exit;
					} else {
					$response = (object)$this->curl->response;
				}
				$arr['status'] = 'log';
				$filename = FCPATH . $response->status;
				if (file_exists($filename)) {
					$arr['data'] = file_get_contents(__DIR__ . $response->logs);
					} else {
					$arr['data'] =  $response->msg;
				}
				
				} elseif ($command == 'version' or $command == 'versi') {
				$data = [
				'APP-API-KEY'  => $this->api_key,
				'text'  => $command
				];
				
				$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Content-Type', 'application/json');
				$this->curl->post($url_api . '/api/command', $data);
				if ($this->curl->error) 
				{
					$response = $this->curl->errorMessage;
					echo json_encode($response);
					exit;
					} else {
					$response = (object)$this->curl->response;
				}
				
				$update = new AutoUpdate($response->status, __DIR__ . $response->path, $response->time);
				$update->setCurrentVersion($this->versi);
				$update->setInstallDir('./');
				$update->setBasicAuth($this->user, $response->auth);
				
				// Custom logger (optional)
				$logger = new \Monolog\Logger("default");
				$logger->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . $response->logs));
				$update->setLogger($logger);
				
				if ($update->checkUpdate() === false) {
					die($this->lang->line('check_update'));
				}
				
				if ($update->newVersionAvailable()) {
					// Install new update
					$arr[]  = $this->lang->line('current_version_available').' [[b;green;black]' . $update->getLatestVersion() . '] '.$this->lang->line('current_version').' [[b;red;black]' . $this->versi . ']';
					$arr[] .= $this->lang->line('read_instructions').' [[b;blue;black]README]';
					$arr[] .= $this->lang->line('commands'). '> [[b;green;black]UPDATE] '.$this->lang->line('app_updates');
					} else {
					$arr['j'] =  $this->lang->line('latest_current_version') .' : ' . $this->versi;
				}
				} elseif ($command == 'clearlog') {
				$data = [
				'APP-API-KEY'  => $this->api_key,
				'text'  => $command
				];
				
				$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Content-Type', 'application/json');
				$this->curl->post($url_api . '/api/command', $data);
				if ($this->curl->error) 
				{
					$response = $this->curl->errorMessage;
					echo json_encode($response);
					exit;
					} else {
					$response = (object)$this->curl->response;
				}
				$path_to_file = FCPATH . $response->status;
				if (unlink($path_to_file)) {
					$arr['i'] =  $this->lang->line('logs_cleared_success');
					} else {
					$arr['i'] =  $this->lang->line('logs_cleared_failed');
				}
				
				} elseif ($command == 'migrasi') {
				update_demo_admin($this->session->nama);
				$data = [
				'APP-API-KEY'  => $this->api_key,
				'version'  => $this->versi
				];
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Content-Type', 'application/json');
				
				$this->curl->post($url_api . '/api/migrasi', $data);
				if ($this->curl->error) {
					$arr['status'] = $this->curl->errorMessage;
					} else {
					$response = (object)$this->curl->response;
					$arr[] = 'status :' . $response->status;
					$arr[] .= 'versi :' . $response->version;
					$arr[] .= $response->message;
				}
				} else {
				
				$data = [
				'APP-API-KEY'  => $this->api_key,
				'text'  => $command,
				'version'  => $this->cek_versi($command)
				];
				
				$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Content-Type', 'application/json');
				
				$this->curl->post($url_api . '/api/command', $data);
				if ($this->curl->error) 
				{
					$arr['status'] = $this->curl->errorMessage;
					} else {
					$response = (object)$this->curl->response;
					
					if (empty($response->status)) {
						echo json_encode($response->message);
						exit;
					}
					// print_r($response);
					if ($response->status == 'add_column') {
						update_demo_admin($this->session->nama);
						$fields = $response->fields;
						$kolom = array_keys($fields);
						if ($this->db->field_exists($kolom[0], $response->table)) {
							$arr['status'] =  $this->lang->line('column_already_exists');
							} else {
							$this->load->dbforge();
							$this->dbforge->add_column($response->table, $fields);
							$arr['status'] =  $response->message;
						}
						} elseif ($response->status == 'modify_column') {
						update_demo_admin($this->session->nama);
						$fields = $response->fields;
						$kolom = array_keys($fields);
						$this->load->dbforge();
						
						$this->dbforge->modify_column($response->table, $fields);
						$arr['status'] =  $this->lang->line('column_moved_success');
						
						} elseif ($response->status == 'drop_column') {
						$fields = $response->fields;
						$kolom = array_keys($fields);
						if ($this->db->field_exists($kolom[0], $response->table)) {
							$this->load->dbforge();
							$this->dbforge->drop_column($response->table, $kolom[0]);
							$arr['status'] =  $response->message;
							} else {
							$arr['status'] =  $this->lang->line('column_not_found');
						}
						
						} elseif ($response->status == 'add_key') {
						update_demo_admin($this->session->nama);
						
						} elseif ($response->status == 'create_table') {
						update_demo_admin($this->session->nama);
						$fields = $response->fields;
						$kolom = array_keys($fields);
						if ($this->db->table_exists($response->table) ){
							$arr['status'] =  'Table '.$response->table.' sudah ada';
							} else {
							$this->load->dbforge();
							$this->dbforge->add_field($fields);
							$this->dbforge->add_key($response->key, TRUE);
							$attributes = array('ENGINE' => 'MyISAM');
							$this->dbforge->create_table($response->table, FALSE, $attributes);
							$arr['status'] =  $response->message;
						}
						
						} elseif ($response->status == 'drop_table') {
						update_demo_admin($this->session->nama);
						} elseif ($response->status == 'input_data') {
						update_demo_admin($this->session->nama);
						$cek_row = $this->model_app->view_where($response->table, ['nama_menu' => $response->nama_menu]);
						if ($cek_row->num_rows() > 0) {
							$arr[] =  $this->lang->line('menu').' ' . $response->nama_menu . ' '.$this->lang->line('already_available');
							} else {
							$insert = $this->model_app->input($response->table, $response->fields);
							if ($insert['status'] == 'ok') {
								$arr[] =  $response->message;
								} else {
								$arr[] =  $this->lang->line('add_menu_fail');
							}
						}
						} elseif ($response->status == 'update_data') {
						update_demo_admin($this->session->nama);
						} elseif ($response->status == 'readme') {
						$arr  =  $response->message;
						} elseif ($response->status == 'mkdir') {
						update_demo_admin($this->session->nama);
						if (!is_dir($response->message)) {
							// mkdir($response->message, 0777, true);
							$arr[]  =  'Folder ' . $response->message . ' berhasil dibuat';
							} else {
							$arr[]  =  'Folder ' . $response->message . ' sudah ada';
						}
						} elseif ($response->status == 'demo') {
						$update = $this->model_app->update($response->table,[$response->status=>$response->fields],['id'=>1]);
						if ($update['status'] == 'ok') {
							$arr[] =  $response->message;
							} else {
							$arr[] =  $this->lang->line('update_failed');
						}
						} elseif ($response->status == 'help') {
						$arr  =  $response->message;
						} else {
						$arr  =  $response->message;
					}
				}
			}
			echo json_encode($arr);
		}
		
		private function cek_versi($command)
		{
			$data = [
			'APP-API-KEY'  => $this->api_key,
			'text'  => $command
			];
			
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post($this->url_api . '/api/command', $data);
			if ($this->curl->error) 
			{
				$response = $this->curl->errorMessage;
				echo json_encode($response);
				exit;
				} else {
				$response = (object)$this->curl->response;
			}
			// print_r($response);
			$update = new AutoUpdate($response->temp, __DIR__ . $response->path, $response->time);
			$update->setCurrentVersion($this->versi);
			$update->setInstallDir('./');
			$update->setBasicAuth($this->user, $response->auth);
			
			// Custom logger (optional)
			$logger = new \Monolog\Logger("default");
			$logger->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . $response->logs));
			$update->setLogger($logger);
			
			if ($update->checkUpdate() === false) {
				die($this->lang->line('check_update'));
			}
			
			if ($update->newVersionAvailable()) {
				$data = $update->getLatestVersion();
				}else{
				$data = $this->versi;
			}
			
			return $data;
		}
		
	}		