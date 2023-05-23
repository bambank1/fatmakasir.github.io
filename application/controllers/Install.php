<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Install extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->library('dummy');
			// ini_set('max_execution_time', 0); 
			// ini_set('memory_limit','2048M'); 
		}
		public function index() {
			if ($this->input->server('REQUEST_METHOD') === 'GET') {
				exit('bad_request');
			}
			$this->db->trans_start();
			## insert akun dummy
			$akun = $this->dummy->akun();
			$this->db->insert_batch('akun', $akun);
			##insert end
			
			## insert bahan dummy
			$bahan = $this->dummy->bahan();
			$this->db->insert_batch('bahan', $bahan);
			
			##insert end
			
			##insert dummy jenis_bayar
			$jenis_bayar = $this->dummy->jenis_bayar();
			$this->db->insert_batch('jenis_bayar', $jenis_bayar);
			##insert end
			
			$hak_akses = $this->dummy->hak_akses();
			$this->db->insert_batch('hak_akses', $hak_akses);
			$field = array('status'=>1);
			$where = array('id_level'=>5);
			$this->db->update('hak_akses', $field,$where);
			
			##Insert dummy
			$info = $this->dummy->info();
			$this->db->insert_batch('info', $info);
			##end
			
			##Insert dummy jenis_cetakan
			$jenis_cetakan = $this->dummy->kategori();
			$this->db->insert_batch('jenis_cetakan', $jenis_cetakan);
			##Insert dummy END
			
			##end##Insert dummy
			$jenis_kas = $this->dummy->jenis_kas();
			$this->db->insert_batch('jenis_kas', $jenis_kas);
			##end
			
			##end##Insert dummy
			$jenis_lembaga = $this->dummy->jenis_lembaga();
			$this->db->insert_batch('jenis_lembaga', $jenis_lembaga);
			##end
			
			
			##end##Insert dummy
			$jenis_pengeluaran = $this->dummy->pengeluaran();
			$this->db->insert_batch('jenis_pengeluaran', $jenis_pengeluaran);
			##end
			
			##Insert dummy
			$konsumen = $this->dummy->reset_konsumen();
			$this->db->insert_batch('konsumen', $konsumen);
			##end
			
			##Insert dummy
			$menuadmin = $this->dummy->menuadmin();
			$this->db->insert_batch('menuadmin', $menuadmin);
			##end
			
			##Insert dummy
			$printer = $this->dummy->printer();
			$this->db->insert_batch('printer', $printer);
			##end
			
			##Insert dummy
			$produk = $this->dummy->produk();
			$this->db->insert_batch('produk', $produk);
			##end
			
			##Insert dummy
			$rekening_bank = $this->dummy->rekening();
			$this->db->insert_batch('rekening_bank', $rekening_bank);
			##end
			
			##Insert dummy
			$satuan = $this->dummy->satuan();
			$this->db->insert_batch('satuan', $satuan);
			##end
			
			##Insert dummy
			$shared_folder = $this->dummy->shared_folder();
			$this->db->insert_batch('shared_folder', $shared_folder);
			##end
 
			##Insert dummy
			$supplier = $this->dummy->reset_supplier();
			$this->db->insert_batch('supplier', $supplier);
			##end
			
			##Insert dummy
			$tb_users = $this->dummy->tb_users();
			$this->db->insert_batch('tb_users', $tb_users);
			##end
			
			$themes = array(
			array('id' => '1','title' => 'dashboard','folder' => 'dashboard','pub' => '0')
			);
			##Insert dummy
			$this->db->insert_batch('themes', $themes);
			
			##Insert dummy
			$type_akses = $this->dummy->type_akses();
			$this->db->insert_batch('type_akses', $type_akses);
			##end
			
			$this->db->trans_complete();
			$data = ['status'=>404,'msg'=>''];
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$data = ['status'=>400,'msg'=>'Gagal'];
			}
			else
			{
				$this->db->trans_commit();
				$data = ['status'=>200,'msg'=>'Berhasil'];
				// $hapus_file = FCPATH.'application/controllers/Install.php';
				// if(unlink($hapus_file)) {
				// $data = ['status'=>200,'msg'=>'Berhasil'];
				// }
				// else {
				// $data = ['status'=>400,'msg'=>'Gagal'];
				// }
				
			}
			echo json_encode($data);
			
		}			
	}																																																															