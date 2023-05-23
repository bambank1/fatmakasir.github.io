<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Jurnal extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login();
			$this->info = info();
			$this->back = $this->agent->referrer();
			$this->iduser = $this->session->idu;
			$this->perPage = 10; 
			$this->title = info()['title']; 
		}
		
		public function index(){
			$data['title'] ='Jurnal Umum | '.info()['title'];
			$data['periode'] = date('m/Y');	
			$data['listJurnal'] = $this->model_jurnal->getJurnalByYearAndMonth();
            $data['tahun'] = $this->model_jurnal->getJurnalByYear();
			$this->template->load('main/themes','pembukuan/jurnal_umum',$data);
		}
		
		public function detail(){
			$data['title'] ='Jurnal Umum | '.info()['title'];
			$bulan = $this->input->post('bulan',true);
            $tahun = $this->input->post('tahun',true);
            $jurnals = null;
            
            if(empty($bulan) || empty($tahun)){
                redirect('jurnal');
			}
            
            $data['jurnals'] = $this->model_jurnal->getJurnalJoinAkunDetail($bulan,$tahun);
            $data['totalDebit'] = $this->model_jurnal->getTotalSaldoDetail('debit',$bulan,$tahun);
            $data['totalKredit'] = $this->model_jurnal->getTotalSaldoDetail('kredit',$bulan,$tahun);
            
            if($data['jurnals']==null){
                $this->session->set_flashdata('dataNull','Data Jurnal Dengan Bulan '.bulan_indo($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
                redirect('jurnal');
			}
			$this->template->load('main/themes','pembukuan/jurnal_umum_detail',$data);
		}
		public function tambah(){
			$data['title'] ='Tambah Jurnal | '.info()['title'];
            $data['button'] ='Tambah';
            $data['action'] = 'jurnal_umum/tambah'; 
            $tgl_input = date('Y-m-d H:i:s'); 
            $id_user = $this->iduser; 
			
            if(!$_POST){
                $data['data'] = (object) $this->model_jurnal->getDefaultValues();
                }else{
                $data = (object) [
                'id_user'=>$id_user,
                'no_reff'=>$this->input->post('no_reff',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                'saldo'=>$this->input->post('saldo',true)
                ];
			}
            if(!$this->model_jurnal->validate()){
                $this->template->load('main/themes','pembukuan/form_jurnal',$data);
                return;
			}
			
            $this->model_jurnal->insertJurnal($data);
			
            redirect('jurnal');    
		}
		public function edit_form(){
            if($_POST){
                $id = $this->input->post('id',true);
                $data['title'] ='Jurnal Edit | '.info()['title'];
                $data['button'] ='Update';
				
				$data['action'] = 'jurnal/edit_jurnal'; 
				
                $data['data'] = (object) $this->model_jurnal->getJurnalById($id);
                
                $this->template->load('main/themes','pembukuan/form_jurnal',$data);
                }else{
                redirect('jurnal_umum');
			}
		}
		
		public function edit(){
            
            if($_POST){
                $data = (object) [
                'id_user'=>$id_user,
                'no_reff'=>$this->input->post('no_reff',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                'saldo'=>$this->input->post('saldo',true)
                ];
                $id = $this->input->post('id',true);
			}
            
			
            $this->model_jurnal->updateJurnal($id,$data);
            // $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Ubah');
            redirect('jurnal');    
		}
		public function hapus(){
            $id = $this->input->post('id',true);
            $this->model_jurnal->deleteJurnal($id);
            $this->session->set_flashdata('berhasilHapus','Data Jurnal berhasil di hapus');
            redirect('jurnal/detail');
		}
	}																																																																																																																									