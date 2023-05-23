<?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    class Migrasi extends CI_Controller { 
        function __construct() { 
            parent::__construct(); 
           cek_session_login(1);
        } 
        //generat migration
        function index(){
            // if ($this->input->server('REQUEST_METHOD') === 'GET') {
            // exit('bad_request');
            // }
            $this->load->library('ci_migrations_generator/Sqltoci');
            
            // All Tables:
            $this->sqltoci->generate();
            
            //Single Table:
            // $this->sqltoci->generate('table');
            
        }
        
    }                