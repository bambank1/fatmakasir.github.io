<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Dummy {
		private $name; 
		
		public function akun()
		{
			$akun = array(
			array('no_reff' => '102','id_user' => '1','nama_reff' => 'Persediaan','keterangan' => 'Persediaan Barang','aktiva' => '2','pasiva' => '0','kewajiban' => '0','urutan' => '4','kunci' => '0'),
			array('no_reff' => '110','id_user' => '1','nama_reff' => 'Bank','keterangan' => 'Kas di Bank','aktiva' => '1','pasiva' => '0','kewajiban' => '0','urutan' => '2','kunci' => '0'),
			array('no_reff' => '111','id_user' => '1','nama_reff' => 'Kas','keterangan' => 'Kas','aktiva' => '1','pasiva' => '0','kewajiban' => '0','urutan' => '1','kunci' => '0'),
			array('no_reff' => '112','id_user' => '1','nama_reff' => 'Piutang','keterangan' => 'Piutang Usaha','aktiva' => '1','pasiva' => '0','kewajiban' => '0','urutan' => '3','kunci' => '0'),
			array('no_reff' => '113','id_user' => '1','nama_reff' => 'Perlengkapan','keterangan' => 'Perlengkapan Perusahaan','aktiva' => '0','pasiva' => '1','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '121','id_user' => '1','nama_reff' => 'Peralatan','keterangan' => 'Peralatan Perusahaan','aktiva' => '0','pasiva' => '1','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '122','id_user' => '1','nama_reff' => 'Akumulasi Peralatan','keterangan' => 'Akumulasi Penyusutan Peralatan','aktiva' => '0','pasiva' => '1','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '211','id_user' => '1','nama_reff' => 'Utang Usaha','keterangan' => 'Utang Usaha','aktiva' => '0','pasiva' => '0','kewajiban' => '1','urutan' => '0','kunci' => '0'),
			array('no_reff' => '212','id_user' => '1','nama_reff' => 'Utang Gaji','keterangan' => 'Utang Gaji','aktiva' => '0','pasiva' => '0','kewajiban' => '1','urutan' => '0','kunci' => '0'),
			array('no_reff' => '213','id_user' => '1','nama_reff' => 'Utang pajak','keterangan' => 'Utang pajak','aktiva' => '2','pasiva' => '0','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '311','id_user' => '1','nama_reff' => 'Modal','keterangan' => 'Modal','aktiva' => '4','pasiva' => '0','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '312','id_user' => '1','nama_reff' => 'Prive','keterangan' => 'Prive','aktiva' => '2','pasiva' => '2','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '400','id_user' => '1','nama_reff' => 'Pendapatan','keterangan' => 'Pendapatan','aktiva' => '0','pasiva' => '0','kewajiban' => '0','urutan' => '0','kunci' => '1'),
			array('no_reff' => '401','id_user' => '1','nama_reff' => 'Retur Penjualan','keterangan' => 'Retur Penjualan','aktiva' => '2','pasiva' => '1','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '402','id_user' => '1','nama_reff' => 'Potongan Penjualan','keterangan' => 'Potongan Penjualan','aktiva' => '2','pasiva' => '1','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '411','id_user' => '1','nama_reff' => 'Pendapatan jasa/usaha
			','keterangan' => 'Pendapatan jasa/usaha
			','aktiva' => '0','pasiva' => '0','kewajiban' => '0','urutan' => '0','kunci' => '0'),
			array('no_reff' => '412','id_user' => '1','nama_reff' => 'Pendapatan lain-lain','keterangan' => 'Pendapatan lain-lain','aktiva' => '0','pasiva' => '0','kewajiban' => '0','urutan' => '0','kunci' => '1'),
			array('no_reff' => '511','id_user' => '1','nama_reff' => 'Beban Gaji','keterangan' => 'Beban Gaji','aktiva' => '2','pasiva' => '2','kewajiban' => '1','urutan' => '0','kunci' => '0'),
			array('no_reff' => '512','id_user' => '1','nama_reff' => 'Beban Sewa','keterangan' => 'Beban Sewa','aktiva' => '2','pasiva' => '2','kewajiban' => '1','urutan' => '0','kunci' => '0'),
			array('no_reff' => '513','id_user' => '1','nama_reff' => 'Beban Penyusutan Peralatan','keterangan' => 'Beban Penyusutan Peralatan','aktiva' => '2','pasiva' => '0','kewajiban' => '1','urutan' => '0','kunci' => '0'),
			array('no_reff' => '514','id_user' => '1','nama_reff' => 'Beban Lat','keterangan' => 'Beban air, listrik, dan telepon','aktiva' => '2','pasiva' => '0','kewajiban' => '1','urutan' => '0','kunci' => '0'),
			array('no_reff' => '515','id_user' => '1','nama_reff' => 'Beban Perlengkapan','keterangan' => 'Beban Perlengkapan','aktiva' => '2','pasiva' => '0','kewajiban' => '1','urutan' => '0','kunci' => '0')
			);
			
			return $this->name = $akun;
		}
		
		public function jenis_bayar()
		{
			$jenis_bayar = array(
			array('id' => '1','nama_bayar' => 'Tunai','publish' => 'Y'),
			array('id' => '2','nama_bayar' => 'Transfer','publish' => 'Y'),
			array('id' => '3','nama_bayar' => 'Tempo','publish' => 'Y')
			);
			return $this->name = $jenis_bayar;
		}
		
		public function info()
		{
			$info = array(
			array('id' => '1','title' => 'Aplikasi Kasir Percetakan & Retail','perusahaan' => 'BONE KASIR','deskripsi' => 'PHA+SmwuIEtIIEFiZHVsIEZhdGFoIEhhc2FuPGJyPjwvcD4=','keywords' => 'Serang','email' => 'pospercetakan@gmail.com','phone' => '089611274798','fb' => '-','tw' => 'https://twitter.com/','ig' => '-','logo' => 'bon_app.png','logo_bw' => 'logo_bw.png','favicon' => 'bone.png','stamp_l' => 'STAM_LUNAS.png','stamp_b' => 'belum_lunas.png','warna_lunas' => '#1ABC9C','warna_blunas' => '#444444','tema' => '#8E44AD','ket' => 'PHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPkFwbGlrYXNpIEthc2lyIFBlcmNldGFrYW4gJmFtcDsgUmV0YWlsPGJyPkRlZmF1bHQgTG9naW4gQWRtaW48YnI+ZW1haWwgOiBhZG1pbkBteS5pZDxicj5wYXNzIDogMTIzNDU8YnI+PC9wPg==','footer_invoice' => 'PHA+TWVudW5kYSBudW5kYSBwZW1iYXlhcmFuIGh1dGFuZyBvbGVoIG9yYW5nIG1hbXB1PGJyPm1lcnVwYWthbiBzdWF0dSBrZWR6YWxpbWFuIHwgSC5ULiBBYnUgRGF1ZCB8PC9wPg==','demo' => 'N','api_key' => '12345z','version' => '1.2.3','user_name' => 'xposappx','user_pass' => '')
			);
			return $this->name = $info;
		}
		function reset_info() {
			$info = array(
			array('id' => '1','title' => 'Aplikasi Kasir Percetakan & Retail','perusahaan' => 'BONE KASIR','deskripsi' => 'PHA+SmwuIEtIIEFiZHVsIEZhdGFoIEhhc2FuPGJyPjwvcD4=','keywords' => 'Serang','email' => 'pospercetakan@gmail.com','phone' => '089611274798','fb' => '-','tw' => 'https://twitter.com/','ig' => '-','logo' => 'bon_app.png','logo_bw' => 'logo_bw.png','favicon' => 'bone.png','stamp_l' => 'STAM_LUNAS.png','stamp_b' => 'belum_lunas.png','warna_lunas' => '#1ABC9C','warna_blunas' => '#444444','tema' => '#8E44AD','ket' => 'PHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPkFwbGlrYXNpIEthc2lyIFBlcmNldGFrYW4gJmFtcDsgUmV0YWlsPGJyPkRlZmF1bHQgTG9naW4gQWRtaW48YnI+ZW1haWwgOiBhZG1pbkBteS5pZDxicj5wYXNzIDogMTIzNDU8YnI+PC9wPg==','footer_invoice' => 'PHA+TWVudW5kYSBudW5kYSBwZW1iYXlhcmFuIGh1dGFuZyBvbGVoIG9yYW5nIG1hbXB1PGJyPm1lcnVwYWthbiBzdWF0dSBrZWR6YWxpbWFuIHwgSC5ULiBBYnUgRGF1ZCB8PC9wPg==','demo' => 'N','api_key' => '12345z','version' => '1.2.3','user_name' => 'xposappx','user_pass' => '')
			);
			return $this->name = $info;
		}
		public function hak_akses()
		{
			$hak_akses = array(
			array('id_level' => '1','id_parent' => '0','nama' => 'Administrator','level' => 'admin','publish' => 'Y','status' => '0'),
			array('id_level' => '2','id_parent' => '0','nama' => 'Owner','level' => 'owner','publish' => 'Y','status' => '0'),
			array('id_level' => '3','id_parent' => '0','nama' => 'Kasir','level' => 'kasir','publish' => 'Y','status' => '0'),
			array('id_level' => '4','id_parent' => '0','nama' => 'Keuangan','level' => 'keu','publish' => 'Y','status' => '0'),
			array('id_level' => '5','id_parent' => '0','nama' => 'Desain','level' => 'desain','publish' => 'Y','status' => '0'),
			array('id_level' => '6','id_parent' => '0','nama' => 'Operator','level' => 'operator','publish' => 'Y','status' => '0')
			);
			return $this->name = $hak_akses;
		}
		
		public function jenis_kas()
		{
			$jenis_kas = array(
			array('id' => '1','title' => 'Kas Kecil','id_akun' => '111','kunci' => '0'),
			array('id' => '2','title' => 'Kas Penjualan','id_akun' => '411','kunci' => '0'),
			array('id' => '3','title' => 'Kas Bank Umum','id_akun' => '110','kunci' => '0'),
			array('id' => '4','title' => 'Hutang Usaha','id_akun' => '211','kunci' => '1'),
			array('id' => '5','title' => 'Piutang Usaha','id_akun' => '112','kunci' => '1')
			);
			return $this->name = $jenis_kas;
		}
		
		public function jenis_lembaga()
		{
			$jenis_lembaga = array(
			array('id' => '1','title' => 'Personal','pub' => '0'),
			array('id' => '2','title' => 'Perusahaan Swasta','pub' => '0'),
			array('id' => '3','title' => 'Perusahaan BUMN','pub' => '0'),
			array('id' => '4','title' => 'Lembaga Pendidikan','pub' => '0'),
			array('id' => '5','title' => 'Hotel','pub' => '0'),
			array('id' => '6','title' => 'Instansi Pemerintahan','pub' => '0'),
			array('id' => '7','title' => 'Lainya','pub' => '0')
			);
			return $this->name = $jenis_lembaga;
		}
		
		public function kategori()
		{
			$jenis_cetakan = array(
			array('id_jenis' => '1','jenis_cetakan' => '-','kunci' => '1','status' => '0','id_akun' => '0','pub' => 'Y'),
			array('id_jenis' => '2','jenis_cetakan' => 'Indoor','kunci' => '0','status' => '1','id_akun' => '411','pub' => 'Y'),
			array('id_jenis' => '3','jenis_cetakan' => 'Outdoor','kunci' => '0','status' => '1','id_akun' => '400','pub' => 'Y'),
			array('id_jenis' => '4','jenis_cetakan' => 'Digital','kunci' => '0','status' => '0','id_akun' => '411','pub' => 'Y'),
			array('id_jenis' => '5','jenis_cetakan' => 'Offset','kunci' => '0','status' => '0','id_akun' => '411','pub' => 'Y'),
			array('id_jenis' => '6','jenis_cetakan' => 'Konveksi','kunci' => '0','status' => '0','id_akun' => '411','pub' => 'Y'),
			array('id_jenis' => '7','jenis_cetakan' => 'Sablon','kunci' => '0','status' => '0','id_akun' => '411','pub' => 'Y'),
			array('id_jenis' => '8','jenis_cetakan' => 'Merchandise','kunci' => '0','status' => '0','id_akun' => '411','pub' => 'Y'),
			array('id_jenis' => '9','jenis_cetakan' => 'Desain','kunci' => '0','status' => '0','id_akun' => '411','pub' => 'Y')
			);
			return $this->name = $jenis_cetakan;
		}
		
		public function reset_kategori()
		{
			$jenis_cetakan = array(
			array('id_jenis' => '1','jenis_cetakan' => '-','kunci' => '1','status' => '0','id_akun' => '0','pub' => 'Y')
			);
			
			return $this->name = $jenis_cetakan;
		}
		
		public function bahan()
		{
			$bahan = array(
			array('id' => '1','id_jenis' => '1','title' => 'NONE','harga_modal' => '0','harga_jual' => '0','harga' => '0','id_satuan' => '0','status_stok' => 'N','kunci' => '1','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '2','id_jenis' => '3','title' => 'VINYL RITRAMA','harga_modal' => '14500','harga_jual' => '0','harga' => '0','id_satuan' => '5','status_stok' => 'N','kunci' => '0','status' => '1','pub' => '1','type_harga' => '1'),
			array('id' => '3','id_jenis' => '3','title' => 'FLEXI CHINA 280Gr','harga_modal' => '8000','harga_jual' => '0','harga' => '0','id_satuan' => '5','status_stok' => 'N','kunci' => '0','status' => '1','pub' => '1','type_harga' => '2'),
			array('id' => '4','id_jenis' => '3','title' => 'FLEXI KOREA 440Gr','harga_modal' => '10000','harga_jual' => '0','harga' => '0','id_satuan' => '5','status_stok' => 'N','kunci' => '0','status' => '1','pub' => '1','type_harga' => '1'),
			array('id' => '5','id_jenis' => '2','title' => 'BACKLITE JERMAN 550Gr','harga_modal' => '21000','harga_jual' => '0','harga' => '0','id_satuan' => '5','status_stok' => 'N','kunci' => '0','status' => '1','pub' => '1','type_harga' => '1'),
			array('id' => '6','id_jenis' => '3','title' => 'VINYL CINA ','harga_modal' => '12000','harga_jual' => '50000','harga' => '60000','id_satuan' => '5','status_stok' => 'N','kunci' => '0','status' => '1','pub' => '1','type_harga' => '1'),
			array('id' => '7','id_jenis' => '4','title' => 'PVC','harga_modal' => '3000','harga_jual' => '0','harga' => '0','id_satuan' => '1','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '8','id_jenis' => '9','title' => 'Desain','harga_modal' => '10000','harga_jual' => '15000','harga' => '20000','id_satuan' => '1','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '9','id_jenis' => '2','title' => 'Roll Up Baner 60x160','harga_modal' => '200000','harga_jual' => '0','harga' => '0','id_satuan' => '1','status_stok' => 'N','kunci' => '0','status' => '1','pub' => '1','type_harga' => '1'),
			array('id' => '10','id_jenis' => '2','title' => 'X-Banner','harga_modal' => '50000','harga_jual' => '0','harga' => '0','id_satuan' => '1','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '11','id_jenis' => '4','title' => 'ART PAPER 150','harga_modal' => '4000','harga_jual' => '0','harga' => '0','id_satuan' => '4','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '12','id_jenis' => '4','title' => 'ART CARTON 260','harga_modal' => '5000','harga_jual' => '0','harga' => '0','id_satuan' => '4','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '13','id_jenis' => '5','title' => 'HVS 80 Offset','harga_modal' => '360000','harga_jual' => '500000','harga' => '650000','id_satuan' => '6','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '14','id_jenis' => '4','title' => 'PIN 5.5 CM','harga_modal' => '1000','harga_jual' => '0','harga' => '0','id_satuan' => '1','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '15','id_jenis' => '4','title' => 'PIN 4.4 CM','harga_modal' => '1000','harga_jual' => '0','harga' => '0','id_satuan' => '1','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1'),
			array('id' => '16','id_jenis' => '4','title' => 'HVS 70','harga_modal' => '300','harga_jual' => '0','harga' => '0','id_satuan' => '4','status_stok' => 'N','kunci' => '0','status' => '0','pub' => '1','type_harga' => '1')
			);
			
			return $this->name = $bahan;
		}
		
		public function reset_bahan()
		{
			$bahan = array(
			array('id' => '1','id_jenis' => '1','title' => 'NONE','harga_modal' => '0','harga_jual' => '0','harga' => '0','id_satuan' => '0','status_stok' => 'N','kunci' => '1','status' => '0','pub' => '1','type_harga' => '1')); 
			return $this->name = $bahan;
		}
		function satuan() {
			$satuan = array(
			array('id' => '1','satuan' => 'PCS','nama_satuan' => 'Pieces','jumlah' => '1','pub' => '0'),
			array('id' => '2','satuan' => 'BOX','nama_satuan' => 'Box','jumlah' => '1','pub' => '0'),
			array('id' => '3','satuan' => 'LSN','nama_satuan' => 'Lusin','jumlah' => '12','pub' => '0'),
			array('id' => '4','satuan' => 'LBR','nama_satuan' => 'Lembar','jumlah' => '1','pub' => '0'),
			array('id' => '5','satuan' => 'MTR','nama_satuan' => 'Meter','jumlah' => '1','pub' => '0'),
			array('id' => '6','satuan' => 'RIM','nama_satuan' => 'Rim','jumlah' => '500','pub' => '0'),
			array('id' => '7','satuan' => 'ROLL','nama_satuan' => 'Roll','jumlah' => '210','pub' => '0')
			);
			
			return $this->name = $satuan;
		}
		function reset_satuan() {
			$satuan = array(
			array('id' => '1','satuan' => 'PCS','nama_satuan' => 'Pieces','jumlah' => '1','pub' => '0'));
			return $this->name = $satuan;
		}
		
		function produk() {
			$produk = array(
			array('id' => '1','id_jenis' => '1','id_bahan' => '1','title' => '-','short_title' => NULL,'barcode' => '0','ukuran' => NULL,'jumlah' => '0','pub' => '1','kunci' => '1','lock_harga' => 'N'),
			array('id' => '2','id_jenis' => '4','id_bahan' => '16,11,12','title' => 'Print A3+','short_title' => NULL,'barcode' => '8265854397434','ukuran' => 'A3+','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '3','id_jenis' => '9','id_bahan' => '8','title' => 'Desain','short_title' => NULL,'barcode' => '5740240467186','ukuran' => '-','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '4','id_jenis' => '3','id_bahan' => '3,4,5','title' => 'SPANDUK','short_title' => '','barcode' => '1544358514177','ukuran' => '1x1m','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '5','id_jenis' => '4','id_bahan' => '12','title' => 'KARTU NAMA','short_title' => NULL,'barcode' => '4509329213091','ukuran' => '9x5.5cm','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '6','id_jenis' => '3','id_bahan' => '3,4','title' => 'X BANNER','short_title' => NULL,'barcode' => '3277642155639','ukuran' => '60x160cm','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '7','id_jenis' => '3','id_bahan' => '4','title' => 'ROLL BANNER','short_title' => NULL,'barcode' => '9377984626466','ukuran' => '60x160cm','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '8','id_jenis' => '3','id_bahan' => '2,3','title' => 'umbul - umbul','short_title' => NULL,'barcode' => '9899580373781','ukuran' => '1x1m','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '9','id_jenis' => '3','id_bahan' => '3,4','title' => 'baliho','short_title' => NULL,'barcode' => '1897548643969','ukuran' => '1x1m','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '10','id_jenis' => '3','id_bahan' => '3','title' => 'banner','short_title' => NULL,'barcode' => '7792950395494','ukuran' => '1x1m','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '11','id_jenis' => '4','id_bahan' => '12','title' => 'Poster','short_title' => NULL,'barcode' => '7029651846148','ukuran' => 'A3+','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '12','id_jenis' => '13','id_bahan' => '24','title' => 'Jasa','short_title' => NULL,'barcode' => '0','ukuran' => '-','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '13','id_jenis' => '8','id_bahan' => '7','title' => 'PIN','short_title' => NULL,'barcode' => '9725138235505','ukuran' => '4.4cm','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '14','id_jenis' => '3','id_bahan' => '6','title' => 'Stiker','short_title' => NULL,'barcode' => '7983035157380','ukuran' => '1x1m','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '15','id_jenis' => '5','id_bahan' => '11','title' => 'Brosur Offset','short_title' => '','barcode' => '5654086457695','ukuran' => 'A4','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '16','id_jenis' => '5','id_bahan' => '13','title' => 'Note Book','short_title' => NULL,'barcode' => '4117487511190','ukuran' => '10x14cm','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '17','id_jenis' => '4','id_bahan' => '7','title' => 'ID CARD','short_title' => NULL,'barcode' => '7847932039218','ukuran' => '8.7x5.7cm','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '18','id_jenis' => '3','id_bahan' => '5','title' => 'Neon Box','short_title' => NULL,'barcode' => '0369522625803','ukuran' => '1x1m','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '19','id_jenis' => '5','id_bahan' => '12','title' => 'paper bag','short_title' => NULL,'barcode' => '7537907236032','ukuran' => '30x40cm','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '20','id_jenis' => '5','id_bahan' => '16','title' => 'Amplop','short_title' => NULL,'barcode' => '9884264119371','ukuran' => '22x10cm','jumlah' => '100','pub' => '1','kunci' => '0','lock_harga' => 'N'),
			array('id' => '21','id_jenis' => '2','id_bahan' => '6','title' => 'Print Indoor','short_title' => NULL,'barcode' => '8742353829174','ukuran' => '1x1m','jumlah' => '1','pub' => '1','kunci' => '0','lock_harga' => 'N')
			);
			
			return $this->name = $produk;
		}
		
		function reset_produk() {
			$produk = array(
			array('id' => '1','id_jenis' => '1','id_bahan' => '1','title' => '-','short_title' => NULL,'barcode' => '0','ukuran' => NULL,'jumlah' => '0','pub' => '1','kunci' => '1','lock_harga' => 'N'));
			
			return $this->name = $produk;
		}
		
		function supplier() {
			$supplier = array(
			array('id_supplier' => '1','nama_perusahaan' => 'UMUM','jenis_usaha' => '-','pemilik' => '-','jabatan' => '-','alamat' => '-','telp' => '-','email' => '-','nomor_rekening' => '-','publish' => 'Y','kunci' => '1')
			);
			return $this->name = $supplier;
		}
		
		function reset_supplier() {
			$supplier = array(
			array('id_supplier' => '1','nama_perusahaan' => 'UMUM','jenis_usaha' => '-','pemilik' => '-','jabatan' => '-','alamat' => '-','telp' => '-','email' => '-','nomor_rekening' => '-','publish' => 'Y','kunci' => '1')
			);
			return $this->name = $supplier;
		}
		
		function pengeluaran() {
			$jenis_pengeluaran = array(
			array('id_jenis' => '1','title' => '-','kunci' => '1','id_akun' => '0','pub' => 'Y','status' => '0'),
			array('id_jenis' => '2','title' => 'Persediaan Bahan Pin','kunci' => '0','id_akun' => '102','pub' => 'Y','status' => '0'),
			array('id_jenis' => '3','title' => 'Prive Owner','kunci' => '0','id_akun' => '312','pub' => 'Y','status' => '1'),
			array('id_jenis' => '4','title' => 'Jasa Pengiriman','kunci' => '0','id_akun' => '514','pub' => 'Y','status' => '0'),
			array('id_jenis' => '5','title' => 'Persediaan Bahan Flexi','kunci' => '0','id_akun' => '102','pub' => 'Y','status' => '0'),
			array('id_jenis' => '6','title' => 'Persediaan Bahan Digital','kunci' => '0','id_akun' => '102','pub' => 'Y','status' => '0'),
			array('id_jenis' => '7','title' => 'Persediaan Bahan Merchandise','kunci' => '0','id_akun' => '102','pub' => 'Y','status' => '0'),
			array('id_jenis' => '8','title' => 'Token Listrik','kunci' => '0','id_akun' => '514','pub' => 'Y','status' => '0')
			);
			
			
			return $this->name = $jenis_pengeluaran;
		}
		
		function reset_pengeluaran() {
			$jenis_pengeluaran = array(
			array('id_jenis' => '1','title' => '-','kunci' => '1','id_akun' => '0','pub' => 'Y','status' => '0'));
			return $this->name = $jenis_pengeluaran;
		}
		
		function printer() {
			$printer = array(
			array('id' => '1','name' => 'Inject/PDF','ukuran_kertas' => 'A5','ukuran_font' => '10','posisi' => 'landscape','max_item' => '12','shared_name' => 'AdobePDF','slug' => 'in','pub' => '0'),
			array('id' => '2','name' => 'Thermal 85mm','ukuran_kertas' => '85','ukuran_font' => '10','posisi' => 'potrait','max_item' => '12','shared_name' => 'POS80 Printer','slug' => 'th','pub' => '0'),
			array('id' => '3','name' => 'Thermal 58mm','ukuran_kertas' => '58','ukuran_font' => '0','posisi' => 'potrait','max_item' => '12','shared_name' => 'POS80 Printer','slug' => 'th58','pub' => '0'),
			array('id' => '4','name' => 'Direct Thermal 58mm','ukuran_kertas' => '58','ukuran_font' => '10','posisi' => 'potrait','max_item' => '12','shared_name' => 'EPSON L120 Series','slug' => 'direct58','pub' => '1'),
			array('id' => '5','name' => 'Direct Thermal 85mm','ukuran_kertas' => '85','ukuran_font' => '10','posisi' => 'potrait','max_item' => '12','shared_name' => 'EPSON L120 Series','slug' => 'direct85','pub' => '0')
			);
			
			return $this->name = $printer;
		}
		
		function konsumen() {
			$konsumen = array(
			array('id' => '1','id_member' => 'P000001','kode_unik' => 'Axzerf','panggilan' => NULL,'jenis' => '1','nama' => 'Default','no_hp' => '-','tgl_daftar' => '2020-12-07','referal' => '-','alamat' => '-','perusahaan' => '-','alamat_lembaga' => '','no_telp' => '','email' => '','tampil' => '0','kunci' => '1','status' => '0','hapus' => '0','history' => NULL,'max_utang' => '0'),
			array('id' => '2','id_member' => 'P000002','kode_unik' => 'KCEME','panggilan' => 'Mas','jenis' => '1','nama' => 'Ibnu','no_hp' => '089611274798','tgl_daftar' => '2021-02-02','referal' => 'wa','alamat' => 'serang','perusahaan' => 'Personal','alamat_lembaga' => '','no_telp' => '','email' => '','tampil' => '0','kunci' => '0','status' => '0','hapus' => '0','history' => NULL,'max_utang' => '2')
			);
			
			return $this->name = $konsumen;
		}
		
		function reset_konsumen() {
			$date = ('Y-m-d');
			$last_update = ('Y-m-d H:i:s');
			$konsumen = array(
            array('id' => '1','id_member' => 'P000001','kode_unik' => 'Axzerf','panggilan' => NULL,'jenis' => '1','nama' => 'Default','no_hp' => '-','tgl_daftar' => '2020-12-07','referal' => '-','alamat' => '-','perusahaan' => '-','alamat_lembaga' => '','no_telp' => '','email' => '','tampil' => '0','kunci' => '1','status' => '0','hapus' => '0','history' => NULL,'max_utang' => '0')
            );
			return $this->name = $konsumen;
		}
		
		function shared_folder() {
			$shared_folder = array(
			array('id' => '1','nama' => 'computer_name','isi' => 'data'),
			array('id' => '2','nama' => 'folder_af','isi' => 'A-F'),
			array('id' => '3','nama' => 'folder_gm','isi' => 'G-M'),
			array('id' => '4','nama' => 'folder_ns','isi' => 'N-S'),
			array('id' => '5','nama' => 'folder_tz','isi' => 'T-Z')
			);
			return $this->name = $shared_folder;
		}
		
		function tb_users() {
			$tb_users = array(
			array('id_user' => '2','parent' => '1','idmenu' => '188,147,171,174,155,180,159,156,160,157,186,162,166,141,187','id_level' => '3','idlevel' => '1,2,3,4','password' => '$2y$10$ZqdQMiPOkkqa90..01i55enR23a0z5OZAWYbrDxZcIFxJA73M0Xcy','nama_lengkap' => 'Kasir','tgl_daftar' => '2020-08-28','alamat' => 'Banten','email' => 'kasir@my.id','no_hp' => '0899828282','foto' => '/upload/images/user/favicon.png','level' => 'kasir','aktif' => 'Y','hak_akses' => '0','type_akses' => '6,7,8,9','id_session' => 'ca43-608e-5c5b-7b50-2085','sesi_login' => '68f6ac57e5ddfb129a4a285ffb66aae57a8c6d9f','logo' => NULL,'verify' => '1','app_secret' => 'f947976c8ec41e321ddc5926333c75d8a550e5e0a17535cda6234b26ca9e8d98','last_invoice' => '0','last_idp' => '0','last_idbeli' => '0'),
			array('id_user' => '7','parent' => '1','idmenu' => '188,155,190,162,141,187,167','id_level' => '5','idlevel' => '1,2,3,4,5,6','password' => '$2y$10$vfqlf3iR8SNhbTtp6c.g4eZJbXwAzgga9K8w.vr9aa2izpm2udvI.','nama_lengkap' => 'Desain','tgl_daftar' => '2022-03-07','alamat' => 'Serang','email' => 'desain@my.id','no_hp' => '-','foto' => NULL,'level' => 'desain','aktif' => 'Y','hak_akses' => '0','type_akses' => '7,8,9','id_session' => 'tIYT1rpJ8D','sesi_login' => 'e14da4dff71bdae57d7086777321a1c25279435f','logo' => NULL,'verify' => '0','app_secret' => NULL,'last_invoice' => '0','last_idp' => '0','last_idbeli' => '0'),
			array('id_user' => '1','parent' => '0','idmenu' => '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203','id_level' => '1','idlevel' => '1,2,3,4,5,6','password' => '$2y$10$EsjOkK3lmn630f3uBJMA5ewG2o2m.tZH6IYkGH/YaXxe2HCwZHySy','nama_lengkap' => 'Admin App','tgl_daftar' => '2021-04-22','alamat' => NULL,'email' => 'admin@my.id','no_hp' => '089611274798','foto' => NULL,'level' => 'admin','aktif' => 'Y','hak_akses' => '1','type_akses' => '1,2,4,5,6,7,8,9,10','id_session' => '2R86je3fod','sesi_login' => '70662e63778f99bca26c7d04db1c8b39a3e4b665','logo' => NULL,'verify' => '1','app_secret' => NULL,'last_invoice' => '0','last_idp' => '1','last_idbeli' => '2'),
			array('id_user' => '4','parent' => '1','idmenu' => '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203','id_level' => '2','idlevel' => '2,3,4,5,6','password' => '$2y$10$5ufGYO.SuJwFfDgR94SrbOojZPtOsxuHYSz9Dd/9Xc4AyEF/2XmqW','nama_lengkap' => 'Owner','tgl_daftar' => '2021-04-22','alamat' => '-','email' => 'owner@my.id','no_hp' => '-','foto' => NULL,'level' => 'owner','aktif' => 'Y','hak_akses' => '0','type_akses' => '1,2,4,5,6,7,8,9,10','id_session' => NULL,'sesi_login' => '581ec9338255068c262de68b115da0ba95325e96','logo' => NULL,'verify' => '0','app_secret' => NULL,'last_invoice' => '0','last_idp' => '0','last_idbeli' => '0'),
			array('id_user' => '5','parent' => '1','idmenu' => '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203','id_level' => '1','idlevel' => '1,2,3,4,5,6','password' => '$2y$10$/cq8kTBKrejyHTQ0sHsHveg9I7ggTDzIUf7XJNoBHw1L3xIYuAYfu','nama_lengkap' => 'Admin Demo','tgl_daftar' => '2022-02-25','alamat' => 'Serang','email' => 'admindemo@my.id','no_hp' => '089611274798','foto' => NULL,'level' => 'admin','aktif' => 'Y','hak_akses' => '0','type_akses' => '2,4,5,6,8','id_session' => NULL,'sesi_login' => '7c0892e2a43cb3825206a1a21408ff79c8725604','logo' => NULL,'verify' => '0','app_secret' => NULL,'last_invoice' => '0','last_idp' => '0','last_idbeli' => '0'),
			array('id_user' => '11','parent' => '1','idmenu' => '188,155,193,162,141,187,167','id_level' => '6','idlevel' => '1,2,3,4,5,6','password' => '$2y$10$sDlUBn8ehHCMGI95WBNCGOtGAdhHSjal/ma7QZBBQACSafIGVRQji','nama_lengkap' => 'Budi','tgl_daftar' => '2022-07-16','alamat' => 'Serang','email' => 'op@my.id','no_hp' => '08123456789','foto' => NULL,'level' => 'operator','aktif' => 'Y','hak_akses' => '0','type_akses' => '7,8,9','id_session' => NULL,'sesi_login' => '7862cd208143c77003c751bdc6ff52141c4a7044','logo' => NULL,'verify' => '0','app_secret' => NULL,'last_invoice' => '0','last_idp' => '0','last_idbeli' => '0')
			);
			
			return $this->name = $tb_users;
		}
		
		function type_akses() {
			$type_akses = array(
			array('id' => '1','id_parent' => '0','title' => 'Edit Order','slug' => 'edit','status' => '1','pub' => '0'),
			array('id' => '2','id_parent' => '0','title' => 'Hapus Pembayaran','slug' => 'hapus','status' => '1','pub' => '0'),
			array('id' => '3','id_parent' => '0','title' => 'Edit Order Lunas','slug' => 'lunas','status' => '1','pub' => '1'),
			array('id' => '4','id_parent' => '0','title' => 'Pending Order','slug' => 'pending','status' => '1','pub' => '0'),
			array('id' => '5','id_parent' => '0','title' => 'Batal Order','slug' => 'batal','status' => '1','pub' => '0'),
			array('id' => '6','id_parent' => '0','title' => 'Buat Order','slug' => 'add','status' => '0','pub' => '0'),
			array('id' => '7','id_parent' => '0','title' => 'Create Data','slug' => 'create','status' => '0','pub' => '0'),
			array('id' => '8','id_parent' => '0','title' => 'Read Data','slug' => 'read','status' => '0','pub' => '0'),
			array('id' => '9','id_parent' => '0','title' => 'Update Data','slug' => 'update','status' => '0','pub' => '0'),
			array('id' => '10','id_parent' => '0','title' => 'Delete Data','slug' => 'delete','status' => '0','pub' => '0'),
			array('id' => '11','id_parent' => '0','title' => 'Reset Database','slug' => 'reset','status' => '0','pub' => '0'),
			array('id' => '12','id_parent' => '0','title' => 'Rollback Data','slug' => 'rollback','status' => '0','pub' => '0')
			);
			return $this->name = $type_akses;
		}
		
		function rekening() {
			$rekening_bank = array(
			array('id' => '1','nama_bank' => 'Bank Nasional Indonesia','inisial' => 'BNI','nomor_rekening' => '123 456 789','pemilik' => 'Ibnu','footer_invoice' => '1','publish' => 'Y'),
			array('id' => '2','nama_bank' => 'Bank Rakyat Indonesia','inisial' => 'BRI','nomor_rekening' => '123 4567 89','pemilik' => 'Mzie','footer_invoice' => '1','publish' => 'Y')
			);
			return $this->name = $rekening_bank;
		}
		function reset_rekening() {
			$rekening_bank = array(
			array('id' => '1','nama_bank' => 'Bank Nasional Indonesia','inisial' => 'BNI','nomor_rekening' => '123 456 789','pemilik' => 'Ibnu','footer_invoice' => '1','publish' => 'Y'));
			return $this->name = $rekening_bank;
		}
		
		function pengaturan_kertas() {
			$pengaturan_kertas = array(
			array('id' => '1','title' => 'Cetak Invoice','modul' => 'cetak_invoice','ukuran' => 'A5','posisi' => 'landscape'),
			array('id' => '2','title' => 'Cetak Data Order','modul' => 'cetak_order','ukuran' => 'A4','posisi' => 'potrait'),
			array('id' => '3','title' => 'Cetak Laporan Stok','modul' => 'cetak_stok','ukuran' => 'A5','posisi' => 'landscape')
			);
		}
		
		function menuadmin() {
			$menuadmin = array(
			array('idmenu' => '154','idparent' => '116','id_level' => '1,2','nama_menu' => 'Satuan','link' => 'produk/satuan','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '5'),
			array('idmenu' => '148','idparent' => '116','id_level' => '1,2','nama_menu' => 'Kategori','link' => 'produk/jenis','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '4'),
			array('idmenu' => '24','idparent' => '112','id_level' => '1','nama_menu' => 'Menu Admin','link' => 'main/menuadmin','target' => '_self','link_on' => 'N','treeview' => '','classes' => '','classicon' => 'N','icon' => '','aktif' => 'Y','level' => 'admin','urutan' => '48'),
			array('idmenu' => '33','idparent' => '112','id_level' => '1,2','nama_menu' => 'Pengguna','link' => 'user','target' => '_self','link_on' => 'Y','treeview' => 'treeview','classes' => 'menu5','classicon' => 'N','icon' => '','aktif' => 'Y','level' => 'admin','urutan' => '42'),
			array('idmenu' => '109','idparent' => '116','id_level' => '1,2','nama_menu' => 'Produk','link' => 'produk/data','target' => '_self','link_on' => 'N','treeview' => '','classes' => 'menu5','classicon' => 'N','icon' => 'file-text','aktif' => 'Y','level' => '','urutan' => '6'),
			array('idmenu' => '112','idparent' => '0','id_level' => '1,2','nama_menu' => 'Pengaturan','link' => '#pengaturan','target' => '_self','link_on' => 'Y','treeview' => 'treeview','classes' => 'icon-settings','classicon' => 'Y','icon' => 'fa-cog','aktif' => 'Y','level' => '','urutan' => '41'),
			array('idmenu' => '116','idparent' => '0','id_level' => '1,2,4','nama_menu' => 'Produk','link' => '#master','target' => '_self','link_on' => 'Y','treeview' => 'treeview','classes' => 'icon-newspaper-o','classicon' => 'Y','icon' => 'fa-file','aktif' => 'Y','level' => '','urutan' => '3'),
			array('idmenu' => '199','idparent' => '0','id_level' => '1,2','nama_menu' => 'Pembukuan','link' => '#','target' => '_self','link_on' => 'Y','treeview' => 'treeview','classes' => NULL,'classicon' => 'Y','icon' => 'fa-address-book','aktif' => 'Y','level' => NULL,'urutan' => '15'),
			array('idmenu' => '139','idparent' => '112','id_level' => '1,2','nama_menu' => 'Aplikasi','link' => 'main/info','target' => '_self','link_on' => 'N','treeview' => '','classes' => '','classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '45'),
			array('idmenu' => '141','idparent' => '0','id_level' => '1,2,3,4,5,6','nama_menu' => 'Profile','link' => 'user/profil','target' => '_self','link_on' => 'N','treeview' => '','classes' => 'icon-user','classicon' => 'Y','icon' => 'fa-user','aktif' => 'Y','level' => NULL,'urutan' => '39'),
			array('idmenu' => '153','idparent' => '196','id_level' => '1,2,3','nama_menu' => 'Harga Produk','link' => 'produk/bahan','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '9'),
			array('idmenu' => '147','idparent' => '0','id_level' => '1,3','nama_menu' => 'Data Transaksi','link' => 'penjualan/order','target' => '_self','link_on' => 'N','treeview' => '','classes' => 'icon-chart','classicon' => 'Y','icon' => 'fa-cart-plus','aktif' => 'Y','level' => NULL,'urutan' => '1'),
			array('idmenu' => '155','idparent' => '0','id_level' => '1,2,3,4,5,6','nama_menu' => 'Laporan','link' => 'pembukuan','target' => '_self','link_on' => 'Y','treeview' => 'treeview','classes' => NULL,'classicon' => 'Y','icon' => 'fa-book','aktif' => 'Y','level' => NULL,'urutan' => '24'),
			array('idmenu' => '156','idparent' => '155','id_level' => '1,2,3,4','nama_menu' => 'Rincian Penjualan','link' => 'pembukuan/omset','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '27'),
			array('idmenu' => '157','idparent' => '155','id_level' => '1,2,3,4','nama_menu' => 'Pengeluaran','link' => 'pengeluaran/data','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '33'),
			array('idmenu' => '180','idparent' => '155','id_level' => '1,2,3,4','nama_menu' => 'Omset Penjualan','link' => 'laporan/penjualan','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '25'),
			array('idmenu' => '159','idparent' => '155','id_level' => '1,2,3,4','nama_menu' => 'Rincian Pendapatan','link' => 'pembukuan/uang_masuk','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '26'),
			array('idmenu' => '160','idparent' => '155','id_level' => '1,2,3,4','nama_menu' => 'Piutang Penjualan','link' => 'pembukuan/piutang','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '28'),
			array('idmenu' => '162','idparent' => '0','id_level' => '1,2,3,4,5,6','nama_menu' => 'Grafik','link' => 'grafik','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-bar-chart','aktif' => 'Y','level' => NULL,'urutan' => '35'),
			array('idmenu' => '185','idparent' => '112','id_level' => '1,2','nama_menu' => 'Folder','link' => 'main/folder','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-folder-open','aktif' => 'Y','level' => NULL,'urutan' => '47'),
			array('idmenu' => '165','idparent' => '0','id_level' => '1','nama_menu' => 'Backup Database','link' => 'backupdata/database','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-database','aktif' => 'Y','level' => NULL,'urutan' => '58'),
			array('idmenu' => '166','idparent' => '0','id_level' => '1,2,3,4','nama_menu' => 'Pelanggan','link' => '#','target' => '_self','link_on' => 'Y','treeview' => 'treeview','classes' => NULL,'classicon' => 'Y','icon' => 'fa-user-circle-o','aktif' => 'Y','level' => NULL,'urutan' => '36'),
			array('idmenu' => '167','idparent' => '0','id_level' => '1,2,3,4,6','nama_menu' => 'Dokumentasi','link' => 'dokumentasi/page','target' => '_blank','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-file-text','aktif' => 'Y','level' => NULL,'urutan' => '60'),
			array('idmenu' => '168','idparent' => '0','id_level' => '1','nama_menu' => 'Cek Update','link' => 'updateversi','target' => '_self','link_on' => 'N','treeview' => 'a','classes' => NULL,'classicon' => 'Y','icon' => 'fa-cloud-download','aktif' => 'Y','level' => NULL,'urutan' => '57'),
			array('idmenu' => '170','idparent' => '112','id_level' => '1,2,4','nama_menu' => 'Jenis Pembayaran','link' => 'pembayaran/jenis','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '43'),
			array('idmenu' => '171','idparent' => '0','id_level' => '1,2,3,4','nama_menu' => 'Keuangan','link' => '#','target' => '_self','link_on' => 'N','treeview' => 'treeview','classes' => NULL,'classicon' => 'Y','icon' => 'fa-credit-card','aktif' => 'Y','level' => NULL,'urutan' => '21'),
			array('idmenu' => '174','idparent' => '171','id_level' => '1,2,3,4','nama_menu' => 'Kas','link' => 'kas/data','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-file-pdf-o','aktif' => 'Y','level' => NULL,'urutan' => '22'),
			array('idmenu' => '175','idparent' => '112','id_level' => '1,2,3,4','nama_menu' => 'Printer','link' => 'main/printer','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '46'),
			array('idmenu' => '176','idparent' => '0','id_level' => '1','nama_menu' => 'History User','link' => 'history','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-history','aktif' => 'Y','level' => NULL,'urutan' => '59'),
			array('idmenu' => '177','idparent' => '112','id_level' => '1,2','nama_menu' => 'Rekening Bank','link' => 'pembayaran/rekening','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '44'),
			array('idmenu' => '178','idparent' => '171','id_level' => '1,2,4','nama_menu' => 'Mutasi Kas','link' => 'kas/mutasi','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '23'),
			array('idmenu' => '179','idparent' => '116','id_level' => '1,2,3,4','nama_menu' => 'Supplier','link' => 'supplier/data','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '7'),
			array('idmenu' => '181','idparent' => '199','id_level' => '1,2,4','nama_menu' => 'Jenis Transaksi Akun','link' => 'kas/pengeluaran','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '20'),
			array('idmenu' => '182','idparent' => '199','id_level' => '1,2,3,4','nama_menu' => 'Laba Rugi','link' => 'pembukuan/laba-rugi','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '18'),
			array('idmenu' => '183','idparent' => '0','id_level' => '1,2','nama_menu' => 'Master Data','link' => '#','target' => '_self','link_on' => 'N','treeview' => 'header','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '2'),
			array('idmenu' => '184','idparent' => '0','id_level' => '1','nama_menu' => 'backup & update','link' => '#','target' => '_self','link_on' => 'N','treeview' => 'header','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '56'),
			array('idmenu' => '186','idparent' => '155','id_level' => '1,2,3,4','nama_menu' => 'Log Transaksi','link' => 'aktifitas/transaksi','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '34'),
			array('idmenu' => '187','idparent' => '0','id_level' => '1,2,3,4,5,6','nama_menu' => 'Akun Demo','link' => 'home/account','target' => '_self','link_on' => 'N','treeview' => 'a','classes' => NULL,'classicon' => 'Y','icon' => 'fa-user-circle-o','aktif' => 'Y','level' => NULL,'urutan' => '50'),
			array('idmenu' => '188','idparent' => '0','id_level' => '1,2,3,4,5,6','nama_menu' => 'Dashboard','link' => 'home','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-dashboard','aktif' => 'Y','level' => NULL,'urutan' => '0'),
			array('idmenu' => '189','idparent' => '112','id_level' => '1','nama_menu' => 'Reset & Input Sample','link' => 'rollback/resetdata','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '49'),
			array('idmenu' => '190','idparent' => '155','id_level' => '1,2,3,4,5','nama_menu' => 'Desain','link' => 'laporan/desain','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => 'fa-desktop','aktif' => 'Y','level' => NULL,'urutan' => '30'),
			array('idmenu' => '191','idparent' => '155','id_level' => '1,2,4','nama_menu' => 'PPN','link' => 'laporan/ppn','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'N','level' => NULL,'urutan' => '31'),
			array('idmenu' => '193','idparent' => '155','id_level' => '1,6','nama_menu' => 'List Pekerjaan','link' => 'laporan/operator','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '29'),
			array('idmenu' => '194','idparent' => '196','id_level' => '1,2','nama_menu' => 'Data Stok','link' => 'stok/data','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '10'),
			array('idmenu' => '195','idparent' => '196','id_level' => '1,2','nama_menu' => 'History stok','link' => 'stok/history','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '13'),
			array('idmenu' => '198','idparent' => '199','id_level' => '1,2','nama_menu' => 'Neraca','link' => 'pembukuan/neraca','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '17'),
			array('idmenu' => '196','idparent' => '0','id_level' => '1,2','nama_menu' => 'Stok Barang','link' => '#','target' => '_self','link_on' => 'Y','treeview' => 'treeview','classes' => NULL,'classicon' => 'Y','icon' => 'fa-book','aktif' => 'Y','level' => NULL,'urutan' => '8'),
			array('idmenu' => '197','idparent' => '196','id_level' => '1,2','nama_menu' => 'Stok Keluar','link' => 'stok/keluar','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '12'),
			array('idmenu' => '200','idparent' => '155','id_level' => '1,2','nama_menu' => 'Pembelian','link' => 'pembelian/data','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '32'),
			array('idmenu' => '201','idparent' => '196','id_level' => '1,2','nama_menu' => 'Stok Masuk','link' => 'stok/masuk','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '11'),
			array('idmenu' => '202','idparent' => '199','id_level' => '1,2','nama_menu' => 'Neraca Saldo','link' => 'pembukuan/neraca_saldo','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '19'),
			array('idmenu' => '203','idparent' => '199','id_level' => '1,2','nama_menu' => 'Jurnal Umum','link' => 'jurnal','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '16'),
			array('idmenu' => '204','idparent' => '196','id_level' => '1,2','nama_menu' => 'Harga Range','link' => 'produk/harga_range','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '14'),
			array('idmenu' => '205','idparent' => '166','id_level' => '1,2,4','nama_menu' => 'Jenis Member','link' => 'konsumen/member','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '38'),
			array('idmenu' => '206','idparent' => '166','id_level' => '1,2,3,4','nama_menu' => 'Data pelanggan','link' => 'konsumen','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '37'),
			array('idmenu' => '207','idparent' => '0','id_level' => '1','nama_menu' => 'Whatsapp','link' => '#','target' => '_self','link_on' => 'N','treeview' => 'treeview','classes' => NULL,'classicon' => 'Y','icon' => 'fa-whatsapp','aktif' => 'Y','level' => NULL,'urutan' => '51'),
			array('idmenu' => '208','idparent' => '207','id_level' => '1','nama_menu' => 'Device','link' => 'whatsapp','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '52'),
			array('idmenu' => '209','idparent' => '207','id_level' => '1','nama_menu' => 'Template Pesan','link' => 'whatsapp/template','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '53')
			);
			
			
			return $this->name = $menuadmin;
		}
		function get_name() {
			return $this->name;
		}
	}																																														