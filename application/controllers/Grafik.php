<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Grafik extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			cek_session_login();
			$this->perPage = 10; 
			$this->title = info()['title']; 
		}
		
		public function index($id=null)
		{
			cek_menu_akses();
			
			$data['title'] ="Grafik | ".$this->title;
			
			$this->template->load('main/themes','penjualan/grafik',$data);
			
		}
		
		public function omset()
		{
			$page = $this->input->post('bulan'); 
			$hari = date("d");
			if(!empty($page)){
				$bulan = $page;
				}else{
				$bulan = date("m");
			}
			$tahun = date("Y");
			$totalRec = $this->model_data->grafik_omset($bulan,$tahun);
			
			$hasil =array();
			if(!empty($totalRec)){
				foreach($totalRec as $row)
				{
					$hasil['omset'][]=array(
					'total'=>$row->Total,
					'tanggal'=>'TGL.'.$row->hari
					);	
				}
				}else{
				$hasil['omset'][]=array(
				'total'=>0,
				'tanggal'=> "TGL." . $hari
				);	
			}
			$bulan = array('bulan'=>getBulan($bulan));
			$array_merge = array_merge($hasil,$bulan);
			print json_encode($array_merge);
		}
		public function omset_produk()
		{
			$page = $this->input->post('bulan'); 
			$hari = date("d");
			if(!empty($page)){
				$bulan = $page;
				}else{
				$bulan = date("m");
			}
			$tahun = date("Y");
			$totalRec = $this->model_data->grafik_omset_produk($bulan,$tahun);
			
			$hasil =[];
			if(!empty($totalRec)){
				foreach($totalRec as $row)
				{
					$hasil['omset'][]=array(
					'title'=>$row->title,
					'harga'=>$row->Total
					);	
				}
				}else{
				$hasil['omset'][]=array(
				'title'=>0,
				'harga'=> "TGL." . $hari
				);	
			}
			$bulan = array('bulan'=>getBulan($bulan));
			$array_merge = array_merge($hasil,$bulan);
			print json_encode($array_merge);
		}
		
	}						