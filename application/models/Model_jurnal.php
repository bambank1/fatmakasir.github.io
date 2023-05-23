<?php 
	defined("BASEPATH") or exit();
	class Model_jurnal extends CI_model{
		private $table = 'jurnal_transaksi';
        function __construct() { 
            
			$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
			
		} 
		public function sum_jurnal($jenis='',$where='',$bulan='',$tahun=''){
			$ci = & get_instance();
			$ci->db->select('SUM(saldo) AS `total`')
			->where('jenis_saldo',$jenis)
			->where('no_reff',$where)
			->where('month(jurnal_transaksi.tgl_transaksi)',$bulan)
            ->where('year(jurnal_transaksi.tgl_transaksi)',$tahun);
			$query = $ci->db->get('jurnal_transaksi');
			return ($query->num_rows() > 0)?$query->row():0; 
		}
		public function getJurnalByYear(){
            return $this->db->select('tgl_transaksi')
            ->from($this->table)
            ->group_by('year(tgl_transaksi)')
            ->order_by('id_transaksi','ASC')
            ->get()
            ->result();
		}
		public function getAbsenByYear(){
            return $this->db->select('tgl')
            ->from('absen')
            ->group_by('year(tgl)')
            ->order_by('ID','ASC')
            ->get()
            ->result();
		}
        
        public function getJurnalByYearAndMonth(){
            return $this->db->select('tgl_transaksi')
            ->from($this->table)
            ->group_by('month(tgl_transaksi)')
            ->group_by('year(tgl_transaksi)')
			->order_by('id_transaksi','ASC')
            ->get()
            ->result();
		}
		public function sumDetail($bulan,$tahun){
			return $this->db->select('SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) AS `total`')
            ->from('invoice_detail')
            ->where('month(invoice_detail.update_date)',$bulan)
            ->where('year(invoice_detail.update_date)',$tahun)
            ->get()
            ->row()->total;
		}
		
		public function sumBayar($bulan,$tahun){
			return $this->db->select('SUM(`bayar_invoice_detail`.`jml_bayar`) AS `total`')
            ->from('bayar_invoice_detail')
            ->where('month(bayar_invoice_detail.tgl_bayar)',$bulan)
            ->where('year(bayar_invoice_detail.tgl_bayar)',$tahun)
            ->get()
            ->row()->total;
		}
		
		public function sumKasMasukByMonthYear($bulan,$tahun){
			return $this->db->select('SUM(`kas_masuk`.`pemasukan`) AS `total`')
            ->from('kas_masuk')
            ->where('month(kas_masuk.create_date)',$bulan)
            ->where('year(kas_masuk.create_date)',$tahun)
            ->get()
            ->row()->total;
		}
		
		public function sumKasKeluarByMonthYear($bulan,$tahun){
			return $this->db->select('SUM(`kas_masuk`.`pengeluaran`) AS `total`')
            ->from('kas_masuk')
            ->where('month(kas_masuk.create_date)',$bulan)
            ->where('year(kas_masuk.create_date)',$tahun)
            ->get()
            ->row()->total;
		}
		 
		public function getAkunByMonthYear($bulan,$tahun){
            return $this->db->select('akun.no_reff,akun.nama_reff,akun.keterangan,jurnal_transaksi.tgl_transaksi')
            ->from('akun')
            ->where('month(jurnal_transaksi.tgl_transaksi)',$bulan)
            ->where('year(jurnal_transaksi.tgl_transaksi)',$tahun)
            ->join('jurnal_transaksi','jurnal_transaksi.no_reff = akun.no_reff')
            ->group_by('akun.nama_reff')
            ->order_by('jurnal_transaksi.id_transaksi','ASC')
            ->get()
            ->result();
		}
		public function getJurnalByNoReffMonthYear($noReff,$bulan,$tahun){
            return $this->db->select('jurnal_transaksi.id_transaksi,jurnal_transaksi.tgl_transaksi,akun.nama_reff,jurnal_transaksi.no_reff,jurnal_transaksi.jenis_saldo,jurnal_transaksi.saldo,jurnal_transaksi.tgl_input')
            ->from($this->table)            
            ->where('jurnal_transaksi.no_reff',$noReff)
            ->where('month(jurnal_transaksi.tgl_transaksi)',$bulan)
            ->where('year(jurnal_transaksi.tgl_transaksi)',$tahun)
            ->join('akun','jurnal_transaksi.no_reff = akun.no_reff')
            ->order_by('tgl_transaksi','ASC')
            ->get()
            ->result();
		}
		
		public function getJurnalByNoReffSaldoMonthYear($noReff,$bulan,$tahun){
            return $this->db->select('jurnal_transaksi.jenis_saldo,jurnal_transaksi.saldo')
            ->from($this->table)            
            ->where('jurnal_transaksi.no_reff',$noReff)
            ->where('month(jurnal_transaksi.tgl_transaksi)',$bulan)
            ->where('year(jurnal_transaksi.tgl_transaksi)',$tahun)
            ->join('akun','jurnal_transaksi.no_reff = akun.no_reff')
            ->order_by('tgl_transaksi','ASC')
            ->get()
            ->result();
		}
		
		 public function getJurnalJoinAkunDetail($bulan,$tahun){
            return $this->db->select('jurnal_transaksi.id_transaksi,jurnal_transaksi.tgl_transaksi,akun.nama_reff,jurnal_transaksi.no_reff,jurnal_transaksi.jenis_saldo,jurnal_transaksi.saldo,jurnal_transaksi.tgl_input')
            ->from($this->table)
            ->where('month(jurnal_transaksi.tgl_transaksi)',$bulan)
            ->where('year(jurnal_transaksi.tgl_transaksi)',$tahun)
            ->join('akun','jurnal_transaksi.no_reff = akun.no_reff')
            ->order_by('id_transaksi','ASC')
            ->order_by('tgl_input','ASC')
            ->order_by('jenis_saldo','ASC')
            ->get()
            ->result();
        }
		
		public function getTotalSaldoDetail($jenis_saldo,$bulan,$tahun){
            return $this->db->select_sum('saldo')
            ->from($this->table)
            ->where('month(jurnal_transaksi.tgl_transaksi)',$bulan)
            ->where('year(jurnal_transaksi.tgl_transaksi)',$tahun)
            ->where('jenis_saldo',$jenis_saldo)
            ->get()
            ->row();
        }
		 public function getJurnalById($id){
            return $this->db->where('id_transaksi',$id)->get($this->table)->row();
        }
		public function insertJurnal($data){
            return $this->db->insert($this->table,$data);
        }
        
        public function updateJurnal($id,$data){
            return $this->db->where('id_transaksi',$id)->update($this->table,$data);
        }
        
        public function deleteJurnal($id){
            return $this->db->where('id_transaksi',$id)->delete($this->table);
        }
		
		public function getDefaultValues(){
            return [
            'tgl_transaksi'=>date('Y-m-d'),
            'no_reff'=>'',
            'jenis_saldo'=>'',
            'saldo'=>'',
            ];
        }
		 public function validate(){
            $rules = $this->getValidationRules();
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<span class="text-danger" style="font-size:14px">','</span>');
            return $this->form_validation->run();
        }
		 public function getValidationRules(){
            return [
            [
            'field'=>'tgl_transaksi',
            'label'=>'Tanggal Transaksi',
            'rules'=>'trim|required'
            ],
            [
            'field'=>'no_reff',
            'label'=>'Nama Akun',
            'rules'=>'trim|required'
            ],
            [
            'field'=>'jenis_saldo',
            'label'=>'Jenis Saldo',
            'rules'=>'trim|required'
            ],
            [
            'field'=>'saldo',
            'label'=>'Saldo',
            'rules'=>'trim|required|numeric'
            ],
            ];
        }
	}					