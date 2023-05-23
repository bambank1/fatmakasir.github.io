<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    class Migrate extends CI_Controller { 
        public function __construct()
        {
            parent::__construct();
            $this->load->library('migration');
        }
        public function index() {
            if ($this->input->server('REQUEST_METHOD') === 'GET') {
				exit('bad_request');
            }
            if ($this->migration->current() === FALSE)
            {
                $data = ['status'=>400,'msg'=>$this->migration->error_string()];
                }else{
                $data = ['status'=>200,'msg'=>'Install sukses'];
            }
            echo json_encode($data);
        }
        public function version($version){
            // if ($this->input->server('REQUEST_METHOD') === 'GET') {
				// exit('bad_request');
            // }
            if(!$this->migration->version($version)){
                show_error($this->migration->error_string());
                }else{
                echo 'Migration(s) done'.PHP_EOL;
            }
        }

    }
