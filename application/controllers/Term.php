<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	use Curl\Curl;
	
	class Term extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->url_api     = URL_API;
			$this->api_key     = info()['api_key'];
			$this->curl = new Curl();
		}
		public function index()
		{
			echo ENVIRONMENT;
			$html = "";
			$url_update = base_url('updateversi');
			$url_checker = 'https://mywidget.github.io/update_checker_sandbox.json';
			
			$fileOffline = site_url('', 'http') . "version.json";
			$this->curl->get($url_checker);
			if ($this->curl->error) {
				// $response  =  (object)$this->curl->errorMessage;
				$html .= '';
				} else {
				$response = (object)$this->curl->response;
				$versi = $response->aplikasi[0]->version;
				$this->curl->get($fileOffline);
				if ($this->curl->error) {
					// $response_offline  =  (object)$this->curl->errorMessage;
					$html .= '';
					} else {
					$response_offline = (object)$this->curl->response;
					if ($response->aplikasi[0]->version == $response_offline->aplikasi[0]->version) {
						$html .= '<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-bell fa-fw"></i>
						<span class="badge badge-danger badge-counter" id="remove-notif">0</span>
						</a>';
						} elseif ($response->aplikasi[0]->version > $response_offline->aplikasi[0]->version) {
						$html .= '<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-bell fa-fw"></i>
						<span class="badge badge-danger badge-counter">1</span>
						</a>
						<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in "
						aria-labelledby="alertsDropdown">
						<h6 class="dropdown-header">Versi ' . $response->aplikasi[0]->version . ' tersedia</h6>
						<a class="dropdown-item d-flex align-items-center remove-notif" href="' . $url_update . '" id="remove-notif">
						<div class="dropdown-list-image mr-3">
						<img class="rounded-circle" src="' . $response->aplikasi[0]->url_image . '" style="max-width: 60px" alt="">
						<div class="status-indicator bg-success"></div>
						</div>
						<div>
						<div class="small text-gray-500">Versi ' . $response->aplikasi[0]->version . '</div>
						<span class="font-weight-bold">' . $response->aplikasi[0]->caption . '</span>
						<div class="small text-gray-500">' . dtime($response->aplikasi[0]->updateDate) . '</div>
						</div>
						</a>';
						unset($response->aplikasi[0]);
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
						} else {
						$html .= '';
					}
				}
				echo $html;
			}
			// print_r($response);
		}
		public function upload()
		{
			if (isset($_POST['btnUpload']))
			{
				$data = [
				'APP-API-KEY'  => $this->api_key,
				'filedata'  => $_FILES
				];
				
				$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
				$this->curl->setDefaultJsonDecoder($assoc = true);
				$this->curl->setHeader('Content-Type', 'multipart/form-data');
				$this->curl->setHeader('Content-Type', 'application/json');
				
				$this->curl->post('https://pospercetakan.go/api/upload', $data);
				if ($this->curl->error) {
					echo 'Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
					}else{
						echo "<pre>";
					print_r($this->curl->response);
						echo "</pre>";
					 
				}
				}else{
				echo ' <form action="" method="post" name="frmUpload" enctype="multipart/form-data">
				<tr>
				<td>Upload</td>
				<td align="center">:</td>
				<td><input name="image" type="file" id="file"/></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td align="center">&nbsp;</td>
				<td><input name="btnUpload" type="submit" value="Upload" /></td>
				</tr>
				</form> ';
			}
		}
		public function cookie()
		{
			$this->load->view('cookie');
		}
		
		public function privacy()
		{
			$this->load->view('privacy_policy');
		}
		
		public function disclaimer()
		{
			$this->load->view('disclaimer');
		}
	}			