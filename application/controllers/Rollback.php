<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Rollback extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(0);
			$this->perPage = 10; 
			$this->title = info()['title']; 
			$this->iduser = $this->session->idu; 
			$this->akses = $this->session->type_akses; 
			$this->load->library('dummy');
			
		}
		
		public function resetdata(){
			cek_menu_akses();
			$data['title'] = 'Reset Data | '.$this->title;
			$this->template->load('main/themes','rollback',$data);
		}
		
		public function cek_data_kategori(){
			
			$conditions['where'] = array( 
            'pub'=>'Y',
			'kunci'=>0
			); 
			$counter = $this->model_app->counter('jenis_cetakan',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}		
		
		public function cek_data_bahan(){
			$conditions['where'] = array( 
            'pub'=>1,
			'kunci'=>0
			); 
			$counter = $this->model_app->counter('bahan',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		public function cek_data_satuan(){
			$conditions['where'] = array( 
            'pub'=>0
			); 
			$counter = $this->model_app->counter('satuan',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		public function cek_data_produk(){
			$conditions['where'] = array( 
            'pub'=>1,
            'kunci'=>0
			); 
			$counter = $this->model_app->counter('produk',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		
		public function cek_data_jenis(){
			$conditions['where'] = array( 
            'kunci'=>0,
            'pub'=>'Y'
			); 
			$counter = $this->model_app->counter('jenis_pengeluaran',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		
		public function cek_data_konsumen(){
			$conditions['where'] = array( 
            'kunci'=>0,
            'status'=>0
			); 
			$counter = $this->model_app->counter('konsumen',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		
		public function cek_data_supplier(){
			$conditions['where'] = array( 
            'kunci'=>0,
            'publish'=>'Y'
			); 
			$counter = $this->model_app->counter('supplier',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		
		public function cek_data_penjualan(){
			$conditions['where'] = array(); 
			$counter = $this->model_app->counter('invoice',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		public function cek_data_jurnal(){
			$conditions['where'] = array(); 
			$counter = $this->model_app->counter('jurnal_transaksi',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		public function cek_data_pembelian(){
			$conditions['where'] = array(); 
			$counter = $this->model_app->counter('pembelian',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		public function cek_data_pengeluaran(){
			$conditions['where'] = array(); 
			$counter = $this->model_app->counter('pengeluaran',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		public function cek_data_kasbon(){
			$conditions['where'] = array(); 
			$counter = $this->model_app->counter('kasbon',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		public function cek_data_pengaturan(){
			$conditions['where'] = array(); 
			$counter = $this->model_app->counter('info',$conditions);
			$data = ['status'=>200,'counter'=>$counter];
			echo json_encode($data);
		}
		
		public function install_dummy(){
			database_demo('di Install');
			$name = $this->input->post('name',true);
			
			$counter =0;
			$title ='Install sample';
			//kategori
			if($name=='kategori')
			{
				$tipe ='install_kategori';
				$this->db->truncate('jenis_cetakan');
				$jenis_cetakan = $this->dummy->kategori();
				
				$counter = count($jenis_cetakan);
				$this->db->insert_batch('jenis_cetakan', $jenis_cetakan);
				
				//bahan
			}
			elseif($name=='bahan')
			{
				$tipe ='install_bahan';
				$this->db->truncate('bahan');
				$this->db->truncate('satu_harga');
				$this->db->truncate('harga_satuan');
				$this->db->truncate('harga_member');
				$this->db->truncate('range_harga');
				$this->db->truncate('harga_range_member');
				$bahan = $this->dummy->bahan();
				$counter = count($bahan);
				$this->db->insert_batch('bahan', $bahan);
			}
			//satuan
			elseif($name=='satuan')
			{
				$tipe ='install_satuan';
				$this->db->truncate('satuan');
				$satuan = $this->dummy->satuan();
				$counter = count($satuan);
				$this->db->insert_batch('satuan', $satuan);
			}
			//produk
			elseif($name=='produk')
			{
				$tipe ='install_produk';
				$this->db->truncate('produk');
				foreach($this->dummy->produk() AS $key=>$val){
					unset($val["short_title"]);
					$produk[] = $val;
				}
				$counter = count($produk);
				$this->db->insert_batch('produk', $produk);
			}
			//supplier
			elseif($name=='supplier')
			{
				$tipe ='install_supplier';
				$this->db->truncate('supplier');
				$supplier = $this->dummy->supplier();
				$counter = count($supplier);
				$this->db->insert_batch('supplier', $supplier);
			}
			//pembelian
			elseif($name=='pembelian')
			{
				$tipe ='install_pembelian';
				$title ='Tidak ada sample';
				$counter = 0;
				
			}
			//penjualan
			elseif($name=='penjualan')
			{
				$tipe ='install_penjualan';
				$title ='Tidak ada sample';
				$counter = 0;
				
			}
			//jurnal
			elseif($name=='jurnal')
			{
				$tipe ='install_jurnal';
				$title ='Tidak ada sample';
				$counter = 0;
				
			}
			//kasbon
			elseif($name=='kasbon')
			{
				$tipe ='install_kasbon';
				$title ='Tidak ada sample';
				$counter = 0;
				
			}
			
			//jenis pengeluaran
			elseif($name=='jenis')
			{
				$tipe ='install_jenis';
				$this->db->truncate('jenis_pengeluaran');
				$pengeluaran = $this->dummy->pengeluaran();
				$counter = count($pengeluaran);
				$this->db->insert_batch('jenis_pengeluaran', $pengeluaran);
			}
			
			//konsumen
			elseif($name=='konsumen')
			{
				$tipe ='install_konsumen';
				$this->db->truncate('konsumen');
				$konsumen = $this->dummy->konsumen();
				$counter = count($konsumen);
				$this->db->insert_batch('konsumen', $konsumen);
			}
			//pengeluaran
			elseif($name=='pengeluaran')
			{
				$tipe ='install_pengeluaran';
				$title ='Tidak ada sample';
				$counter = 0;
			}
			//pengeluaran
			elseif($name=='pengaturan')
			{
				$tipe ='install_pengaturan';
				$this->db->truncate('info');
				$info = $this->dummy->info();
				$counter = count($info);
				$this->db->insert_batch('info', $info);
			}
			$data = ['status'=>200,'counter'=>$counter,'tipe'=>$tipe,'name'=>$name,'msg'=>'ok','title'=>$title];
			echo json_encode($data);
		}
		
		public function reset_dummy(){
			database_demo('di Reset');
			$name = $this->input->post('name',true);
			
			$counter =0;
			$title ='Install sample';
			//kategori
			if($name=='kategori')
			{
				$tipe ='install_kategori';
				$this->db->truncate('jenis_cetakan');
				$jenis_cetakan = $this->dummy->reset_kategori();
				$counter = 0;
				$this->db->insert_batch('jenis_cetakan', $jenis_cetakan);
				//bahan
			}
			elseif($name=='bahan')
			{
				
				$tipe ='install_bahan';
				$this->db->truncate('bahan');
				$this->db->truncate('satu_harga');
				$this->db->truncate('harga_satuan');
				$this->db->truncate('harga_member');
				$this->db->truncate('range_harga');
				$this->db->truncate('harga_range_member');
				$bahan = $this->dummy->reset_bahan();
				$counter = 0;
				$this->db->insert_batch('bahan', $bahan);
			}
			//satuan
			elseif($name=='satuan')
			{
				$tipe ='install_satuan';
				$this->db->truncate('satuan');
				$satuan = $this->dummy->reset_satuan();
				$counter = 0;
				$this->db->insert_batch('satuan', $satuan);
			}
			//produk
			elseif($name=='produk')
			{
				$tipe ='install_produk';
				$this->db->truncate('produk');
				$produk = $this->dummy->reset_produk();
				$counter = 0;
				$this->db->insert_batch('produk', $produk);
			}
			//supplier
			elseif($name=='supplier')
			{
				$tipe ='install_supplier';
				$this->db->truncate('supplier');
				$supplier = $this->dummy->reset_supplier();
				$counter = 0;
				$this->db->insert_batch('supplier', $supplier);
			}
			//jenis pengeluaran
			elseif($name=='jenis')
			{
				$tipe ='install_jenis';
				$this->db->truncate('jenis_pengeluaran');
				$pengeluaran = $this->dummy->reset_pengeluaran();
				$counter = 0;
				$this->db->insert_batch('jenis_pengeluaran', $pengeluaran);
			}
			
			//konsumen
			elseif($name=='konsumen')
			{
				$tipe ='install_konsumen';
				$this->db->truncate('konsumen');
				$konsumen = $this->dummy->reset_konsumen();
				$counter = 0;
				$this->db->insert_batch('konsumen', $konsumen);
			}
			//penjualan
			elseif($name=='penjualan')
			{
				$tipe ='install_penjualan';
				$this->db->truncate('invoice');
				$this->db->truncate('invoice_detail');
				$this->db->truncate('bayar_invoice_detail');
				$this->db->truncate('bayar_piutang');
				$this->db->truncate('kas_masuk');
				$this->db->truncate('laporan_penerimaan');
				$this->db->update('tb_users',['last_invoice'=>0,'last_idp'=>0,'last_idbeli'=>0],['aktif'=>'Y']);
				$this->session->unset_userdata("cart");
				$counter = 0;
				$title ='Tidak ada sample';
			}
			//jurnal
			elseif($name=='jurnal')
			{
				$tipe ='install_jurnal';
				$this->db->truncate('jurnal_transaksi');
				$counter = 0;
				$title ='Tidak ada sample';
			}
			//pembelian
			elseif($name=='pembelian')
			{
				$tipe ='install_pembelian';
				$this->db->truncate('pembelian');
				$this->db->truncate('pembelian_detail');
				$this->db->truncate('bayar_pembelian');
				$this->db->truncate('stok_masuk');
				$this->db->truncate('stok_keluar');
				$this->db->truncate('laporan_stok');
				$this->db->truncate('history_stok');
				$this->db->truncate('laporan_penerimaan');
				$this->db->update('tb_users',['last_invoice'=>0,'last_idp'=>0,'last_idbeli'=>0],['aktif'=>'Y']);
				$this->session->unset_userdata("cartbeli");
				$counter = 0;
				$title ='Tidak ada sample';
			}
			//pengeluaran
			elseif($name=='pengeluaran')
			{
				$tipe ='install_pengeluaran';
				$this->db->truncate('pengeluaran');
				$this->db->truncate('pengeluaran_detail');
				$this->db->truncate('bayar_pengeluaran');
				$counter = 0;
				$title ='Tidak ada sample';
			}
			//kasbon
			elseif($name=='kasbon')
			{
				$tipe ='install_kasbon';
				$this->db->truncate('kasbon');
				$counter = 0;
				$title ='Tidak ada sample';
			}
			//pengaturan
			elseif($name=='pengaturan')
			{
				$tipe ='install_pengaturan';
				$this->db->truncate('info');
				$info = $this->dummy->reset_info();
				$counter = 0;
				$this->db->insert_batch('info', $info);
			}
			$data = ['status'=>200,'counter'=>$counter,'tipe'=>$tipe,'name'=>$name,'msg'=>'Data '.$name.' berhasil di reset','title'=>$title];
			echo json_encode($data);
		}
		
		function reset_ulang()
        {
            cek_nput_post('GET');
            database_demo_admin('di Reset');
            $this->db->trans_off();    
            $this->db->trans_begin();
			
			//kosongkan jenis_cetakan
            $this->db->truncate('jenis_cetakan');
			$reset_kategori = $this->dummy->reset_kategori();
			$this->db->insert_batch('jenis_cetakan', $reset_kategori);
			
			//kosongkan bahan
            $this->db->truncate('bahan');
			$bahan = $this->dummy->reset_bahan();
			$this->db->insert_batch('bahan', $bahan);
			
			//kosongkan satuan
            $this->db->truncate('satuan');
			// $satuan = $this->dummy->reset_satuan();
			// $this->db->insert_batch('satuan', $satuan);
			
			//kosongkan produk
            $this->db->truncate('produk');
			foreach($this->dummy->reset_produk() AS $key=>$val){
				unset($val["short_title"]);
				$produk[] = $val;
			}
			// $produk = $this->dummy->reset_produk();
			$this->db->insert_batch('produk', $produk);
			
			//kosongkan supplier
            $this->db->truncate('supplier');
			$supplier = $this->dummy->reset_supplier();
			$this->db->insert_batch('supplier', $supplier);
			
			//kosongkan jenis_pengeluaran
            $this->db->truncate('jenis_pengeluaran');
			$jenis_pengeluaran = $this->dummy->reset_pengeluaran();
			$this->db->insert_batch('jenis_pengeluaran', $jenis_pengeluaran);
			
			//kosongkan konsumen
            $this->db->truncate('konsumen');
			$konsumen = $this->dummy->reset_konsumen();
            $this->db->insert_batch('konsumen', $konsumen);
			
			
			//kosongkan rekening_bank
            $this->db->truncate('rekening_bank');
			$rekening_bank = $this->dummy->reset_rekening();
            $this->db->insert_batch('rekening_bank', $rekening_bank);
			
            $this->db->truncate('harga');               //kosongkan harga
            $this->db->truncate('invoice');             //kosongkan invoice
            $this->db->truncate('invoice_detail');      //kosongkan invoice_detail
            $this->db->truncate('bayar_invoice_detail');//kosongkan bayar_invoice_detail
            $this->db->truncate('pengeluaran');         //kosongkan pengeluaran
            $this->db->truncate('pengeluaran_detail');  //kosongkan pengeluaran_detail
            $this->db->truncate('kas_masuk');           //kosongkan kas_masuk
            $this->db->truncate('surat_jalan');         //kosongkan surat_jalan
            $this->db->truncate('user_agent');          //kosongkan user_agent
            $this->db->truncate('jurnal_transaksi');          //kosongkan jurnal_transaksi
            $this->db->truncate('history_stok');          //kosongkan history_stok
            $this->db->truncate('kasbon');          //kosongkan kasbon
            $this->db->truncate('laporan_stok');          //kosongkan laporan_stok
            $this->db->truncate('bayar_piutang');          //kosongkan bayar_piutang
            $this->db->truncate('laporan_penerimaan');          //kosongkan laporan_penerimaan
			
            $this->session->unset_userdata('cart');
            $this->session->unset_userdata('cartp');
            $this->db->update('tb_users',['last_invoice'=>0,'last_idp'=>0],['aktif'=>'Y']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
                $data = array('status'=>200,'msg'=>'Database gagal di reset');
			}
			else
			{
				$this->db->trans_commit();
                $data = array('status'=>200,'msg'=>'Database berhasil di reset');
			}
			
            echo json_encode($data);
		}
		
		public function backup_table_db(){
			database_demo_admin('di Backup');
			$this->load->dbutil();
			
			$prefs = array(
			'tables'        => array('bahan'),	// Array of tables to backup.
			'ignore'        => array(),	        // List of tables to omit from the backup
			'format'        => 'txt',	        // gzip, zip, txt
			'filename'      => 'mybackup.sql',  // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'      => TRUE,            // Whether to add DROP TABLE statements to backup file
			'add_insert'    => TRUE,            // Whether to add INSERT data to backup file
			'newline'       => "\n"             // Newline character used in backup file
			);
			
			// $nama_database = 'tabelbahan-on_'. date("Y-m-d_H-i-s") .'.sql';
			// $backup = $this->dbutil->backup($prefs);
			// write_file(FCPATH.'backup_db/'.$nama_database, $backup);
			$data = ['status'=>200,'counter'=>2,'msg'=>'ok'];
			echo json_encode($data);
		}
		
		public function menu_admin(){
			cek_nput_post('GET');
            database_demo_admin('di Rollback');
            $this->db->trans_off();    
            $this->db->trans_begin();
			
            $this->db->truncate('menuadmin');
			
			$menuadmin = $this->dummy->menuadmin();
			$this->db->insert_batch('menuadmin', $menuadmin);
			
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
                $data = array('status'=>400,'msg'=>'Menu gagal di rollback');
			}
			else
			{
				$this->db->trans_commit();
                $data = array('status'=>200,'msg'=>'Menu berhasil di rollback');
			}
			
			echo json_encode($data);
		}
		
		
	}				
