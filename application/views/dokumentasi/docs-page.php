<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>Dokumentasi BONE Pos Kasir Percetakan</title>
		
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="description" content="Bootstrap 4 Template For Software Startups">
		<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
		<link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/logo.png">
		
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
		
		<!-- FontAwesome JS-->
		<script defer src="<?= base_url('assets/'); ?>doc/fontawesome/js/all.min.js"></script>
		
		<!-- Plugins CSS -->
		<link rel="stylesheet" href="<?= base_url('assets/'); ?>doc/css/atom-one-dark.min.css">
		<link id="theme-style" rel="stylesheet" href="<?= base_url('assets/'); ?>doc/css/glightbox.min.css">
		
		<!-- Theme CSS -->
		<link id="theme-style" rel="stylesheet" href="<?= base_url('assets/'); ?>doc/css/theme.css">
	</head>
	
	<body class="docs-page">
		<header class="header fixed-top">
			<div class="branding docs-branding">
				<div class="container-fluid position-relative py-2">
					<div class="docs-logo-wrapper">
						<button id="docs-sidebar-toggler" class="docs-sidebar-toggler docs-sidebar-visible mr-2 d-xl-none" type="button">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<div class="site-logo"><a class="navbar-brand" href="<?= base_url('dokumentasi'); ?>"><img class="logo-icon mr-2" src="<?= base_url('assets/'); ?>img/logo.png" height="32" alt="logo"><span class="logo-text">BONE<span class="text-alt">Kasir Percetakan</span></span></a></div>
					</div>
					<!--//docs-logo-wrapper-->
					<div class="docs-top-utilities d-flex justify-content-end align-items-center">
						<div class="top-search-box d-none d-lg-flex">
							
							<input type="text" placeholder="Search" name="search" id="searchtxt" class="form-control search-input">
							
						</div>
						
						<ul class="social-list list-inline mx-md-3 mx-lg-5 mb-0 d-none d-lg-flex">
							<li class="list-inline-item"><a href="#"><i class="fab fa-github fa-fw"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fab fa-product-hunt fa-fw"></i></a></li>
						</ul>
						<!--//social-list-->
					</div>
					<!--//docs-top-utilities-->
				</div>
				<!--//container-->
			</div>
			<!--//branding-->
			<style>
				.highlight {
				background: #00FF00;
				padding: 1px;
				border: #00CC00 dotted 1px;
				}
			</style>
			
		</header>
		<!--//header-->
		
		<div class="docs-wrapper">
			<div id="docs-sidebar" class="docs-sidebar">
				<div class="top-search-box d-lg-none p-3">
					<form class="search-form">
						<input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
						<button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
					</form>
				</div>
				<nav id="docs-nav" class="docs-nav navbar">
					<ul class="section-items list-unstyled nav flex-column pb-3">
						<li class="nav-item section-title"><a class="nav-link scrollto active" href="#section-0"><span class="theme-icon-holder mr-2"><i class="fas fa-map-signs"></i></span>Pendahuluan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-0-1">Server Requirements : </a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-0-2">Install Aplikasi</a></li>
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-2"><span class="theme-icon-holder mr-2"><i class="fas fa-cog"></i></span>Pengaturan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-1">Pengguna</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-2">Jenis Pembayaran</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-3">Rekening Bank</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-4">Aplikasi</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-5">Printer</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-6">Folder</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-7">Menu Admin</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-2-8">Reset & Input Sample</a></li>
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-3"><span class="theme-icon-holder mr-2"><i class="fas fa-box"></i></span>Produk</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-3-1">Kategori Produk</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-3-2">Satuan Produk</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-3-3">Produk</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-3-4">Supplier</a></li>
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-33"><span class="theme-icon-holder mr-2"><i class="fas fa-box"></i></span>Stok Barang</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-33-1">Harga Produk</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-33-2">Data Stok</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-33-3">Stok Masuk</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-33-4">Stok Keluar</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-33-5">History Stok</a></li>
						<!--end stok barang-->
						<li class="nav-item section-title"><a class="nav-link scrollto" href="#section-1"><span class="theme-icon-holder mr-2"><i class="fas fa-shopping-cart"></i></span>Transaksi</a></li>
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-4"><span class="theme-icon-holder mr-2"><i class="fas fa-money-check"></i></span>Keuangan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-4-1">Kas</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-4-2">Mutasi</a></li>
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-5"><span class="theme-icon-holder mr-2"><i class="fas fa-flag"></i></span>Laporan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-1">Omset Penjualan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-2">Rincian Pendapatan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-3">Rincian Penjualan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-4">Piutang Penjualan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-5">List Pekerjaan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-6">Desain</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-7">Pembelian</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-8">Pengeluaran</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-5-9">Log Transaksi</a></li>
						<li class="nav-item section-title mt-3">
							<a class="nav-link scrollto" href="#section-6"><span class="theme-icon-holder mr-2"><i class="fas fa-laptop-code"></i></span>Grafik</a>
						</li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-6-1">Omset Penjualan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-6-2">Penjualan Produk</a></li><li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-10"><span class="theme-icon-holder mr-2"><i class="fas fa-user"></i></span>Pelanggan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-10-1">Data Pelanggan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-10-2">Jenis Member</a></li>
						
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-7"><span class="theme-icon-holder mr-2"><i class="fas fa-user"></i></span>Pengguna</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-7-1">Admin</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-7-2">Owner</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-7-3">Kasir</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-7-4">Keuangan</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-7-5">Desain</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-7-6">Operator</a></li>
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-8"><span class="theme-icon-holder mr-2"><i class="fas fa-book-reader"></i></span>Profil</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-8-1">Detail Profil</a></li>
						<li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-9"><span class="theme-icon-holder mr-2"><i class="fas fa-database"></i></span>Backup & Update</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-9-1">Cek Update</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-9-2">Backup Database</a></li>
						<li class="nav-item"><a class="nav-link scrollto" href="#item-9-3">History User</a></li>
					</ul>
					
				</nav>
				<!--//docs-nav-->
			</div>
			<!--//docs-sidebar-->
			<div class="docs-content">
				<div class="container">
					<article class="docs-article" id="section-0">
						<header class="docs-header">
							<h1 class="docs-heading">Pendahuluan <span class="docs-time">Last updated: 2022-03-06</span></h1>
							<section class="docs-intro">
								<p>BONE Kasir Percetakan merupakan aplikasi POS yang di khususkan untuk percetakan dan digital printing yang mana POS Kasir percetakan berbeda dengan POS Kasir pada umumnya</p>
								<div class="row mb-1">
									<div class="col-12 col-md-4 mb-3">
										<a class="lightbox" href="<?= base_url('assets/'); ?>doc/images/login.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/login.png" alt="" title="login" /></a>
									</div>
									<div class="col-12 col-md-4 mb-3">
										<a class="lightbox" href="<?= base_url('assets/'); ?>doc/images/dashboard.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/dashboard.png" alt="" title="dashboard" /></a>
									</div>
									<div class="col-12 col-md-4 mb-3">
										<a class="lightbox" href="https://www.youtube.com/embed/PP8wbjcljNc"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="dashboard" /></a>
									</div>
								</div>
								<!--//gallery-->
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-0-1">
							<h2 class="section-heading">Server Requirements :</h2>
							<p>Requirement xampp / ampps atau yg sejenis</p>
							<ul>
								<li>+ Apache 2.4.4</li>
								<li>MySQL/MariaDB</li>
								<li>PHP 7.3/7.4</li>
								<li>phpMyAdmin</li>
							</ul>
							<h5>Aplikasi diatas bisa diunduh dalam satu bundel tanpa instal satu persatu dan tentunya gratis</h5>
							<div class="table-responsive my-4">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<th class="theme-bg-light">1.</th>
											<th class="theme-bg-light"><a class="theme-link" href="https://www.apachefriends.org/xampp-files/7.4.27/xampp-windows-x64-7.4.27-2-VC15-installer.exe" target="_blank">XAMPP</a></th>
											<td>
											Requirements : Windows 2008, 2012, Vista, 7, 8 (Important: XP or 2003 not supported)</td>
										</tr>
										<tr>
											<th class="theme-bg-light">2.</th>
											<th class="theme-bg-light"><a class="theme-link" href="#">AMPPS</a></th>
											<td>
											Requirements : Supported Operating Systems are Windows 11, 10, 8, 7 and Vista Windows Server 2022, 2019, 2016 and 2012. Supported only on 64-bit processor. Windows XP and Windows Server 2008 or lower is not supported. Note :You must have administrator privileges on your computer to run AMPPS.</td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<h3>Install xampp</h3>
							<p>Apa Yang Anda Butuhkan?</p>
							<ul>
								<li>Komputer dengan sistem operasi Windows</li>
								<li>File installer XAMPP</li>
							</ul>
							<h3>Langkah-langkah Instal XAMPP di Windows</h3>
							<p>Berikut langkah-langkah mudah untuk menginstal XAMPP di komputer Anda:</p>
							<ol type="I">
								<li>
									<h5>Download XAMPP</h5>
								</li>
								<p>Download XAMPP melalui website Apache Friends. <a href="https://www.apachefriends.org/xampp-files/7.4.27/xampp-windows-x64-7.4.27-2-VC15-installer.exe" target="_blank">Download disini.</a></p>
								<li>
									<h5>Instal XAMPP</h5>
								</li>
								
								<ol>
									<li>Lakukan instalasi setelah Anda selesai mengunduh. Selama proses instalasi mungkin Anda akan melihat pesan yang menanyakan apakah Anda yakin akan menginstalnya. Silakan tekan Yes untuk melanjutkan instalasi.</li>
									<li>Klik tombol Next.</li>
									
									<div class="row mb-3">
										<div class="col-12 col-md-6 mb-3">
											<a class="xampp" href="<?= base_url('assets/'); ?>doc/images/xampp/instal-xampp-di-windows.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/instal-xampp-di-windows.png" alt=""></a>
										</div>
									</div>
									<!--//gallery-->
									<li>Pada tampilan selanjutnya akan muncul pilihan mengenai komponen mana dari XAMPP yang ingin dan tidak ingin Anda instal. Beberapa pilihan seperti Apache dan PHP adalah bagian penting untuk menjalankan website dan akan otomatis diinstal. Silakan centang MySQL dan phpMyAdmin, untuk pilihan lainnya biarkan saja.</li>
									<div class="row mb-3">
										<div class="col-12 col-md-6 mb-3">
											<a class="xampp" href="<?= base_url('assets/'); ?>doc/images/xampp/tapilan-install.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/tapilan-install.png" alt="" /></a>
										</div>
									</div>
									<!--//gallery-->
									<li>Berikutnya silakan pilih folder tujuan dimana XAMPP ingin Anda instal. Contohnya di direktori C:\xampp. Disarankan install di drive selain C:</li>
									<div class="row mb-3">
										<div class="col-12 col-md-6 mb-3">
											<a class="xampp" href="<?= base_url('assets/'); ?>doc/images/xampp/directory.png" data-title="Folder install xampp"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/directory.png" alt="" /></a>
										</div>
									</div>
									<!--//gallery-->
									<li>Pada halaman selanjutnya, akan ada pilihan apakah Anda ingin menginstal Bitnami untuk XAMPP, dimana nantinya dapat Anda gunakan untuk install WordPress, Drupal, dan Joomla secara otomatis.</li>
									<div class="row mb-3">
										<div class="col-12 col-md-6 mb-3">
											<a class="xampp" href="<?= base_url('assets/'); ?>doc/images/xampp/bitnami.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/bitnami.png" alt="" title="bitnami" /></a>
										</div>
									</div>
									<!--//gallery-->
									<li>Pada langkah ini proses instalasi XAMPP akan dimulai. Silakan klik tombol Next.</li>
									<div class="row mb-3">
										<div class="col-12 col-md-6 mb-3">
											<a class="xampp" href="<?= base_url('assets/'); ?>doc/images/xampp/finish.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/finish.png" alt="" title="Install selesai" /></a>
										</div>
									</div>
									<!--//gallery-->
									<li>Setelah berhasil diinstal, akan muncul notifikasi untuk langsung menjalankan control panel. Silakan klik Finish.</li>
									<div class="row mb-3">
										<div class="col-12 col-md-6 mb-3">
											<a class="xampp" href="<?= base_url('assets/'); ?>doc/images/xampp/control-panel.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/control-panel.png" alt="" title="control-panel" /></a>
										</div>
									</div>
									<!--//gallery-->
								</ol>
								<li>Jalankan XAMPP</li>
							</ol>
							<p>Silakan buka aplikasi XAMPP kemudian klik tombol Start pada Apache dan MySQL. Jika berhasil dijalankan, Apache dan MySQL akan berwarna hijau seperti gambar di bawah ini.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-6 mb-3">
									<a class="xampp" href="<?= base_url('assets/'); ?>doc/images/xampp/xampp-dijalankan.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/xampp-dijalankan.png" alt="" title="xampp-dijalankan" /></a>
								</div>
							</div>
							<!--//gallery-->
							<h3>Install ampps</h3>
							<p>Untuk langkah-langkah install ampps bisa lihat di <a href="https://ampps.com/docs/installing-ampps/installing-on-windows/" target="_blank">link berikut</a></p>
						</section>
						<!--//section-->
						<section class="docs-section" id="item-0-2">
							<h2 class="section-heading">Install Aplikasi</h2>
							<p>Instal aplikasi ini sangat mudah hanya beberapa langkah saja aplikasi bisa langsung digunakan</p>
							<p>Berikut langkah-langkah untuk menginstall aplikasi :</p>
							<ol>
								<li>Copy file pos_kasir_v.x.x.x.zip dan paste kedalam folder instalasi xampp misal C:\xampp\htdocs,</li>
								<li>Extract file pos_kasir_v.x.x.x.zip di folder C:\xampp\htdocs, seperti pada gambar</li>
								<div class="row mb-3">
									<div class="col-12 col-md-6 mb-3">
										<a class="extract" href="<?= base_url('assets/'); ?>doc/images/xampp/extract.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/xampp/extract.png" alt="" title="Cara extract file" /></a>
									</div>
								</div>
								<li>Rename agar mudah diingat misal menjadi pos_kasir</li>
								<!--//gallery-->
								<li>Buka browser kemudian ketik <a href="http://localhost/pos_kasir/install" target="_blank">http://localhost/pos_kasir/install</a></li>
								<div class=" row mb-3">
									<div class="col-12 col-md-3 mb-3">
										<a class="install" href="<?= base_url('assets/'); ?>doc/images/xampp/install_1.png">
											<img src="<?= base_url('assets/'); ?>doc/images/xampp/install_1.png" class="figure-img img-fluid shadow rounded">
										</a>
									</div>
									<div class="col-12 col-md-3 mb-3">
										<a class="install" href="<?= base_url('assets/'); ?>doc/images/xampp/install_2.png">
											<img src="<?= base_url('assets/'); ?>doc/images/xampp/install_2.png" class="figure-img img-fluid shadow rounded">
										</a>
									</div>
									<div class="col-12 col-md-3 mb-3">
										<a class="install" href="<?= base_url('assets/'); ?>doc/images/xampp/install_3.png">
											<img src="<?= base_url('assets/'); ?>doc/images/xampp/install_3.png" class="figure-img img-fluid shadow rounded">
										</a>
									</div>
									<div class="col-12 col-md-3 mb-3">
										<a class="install" href="<?= base_url('assets/'); ?>doc/images/xampp/install_4.png">
											<img src="<?= base_url('assets/'); ?>doc/images/xampp/install_4.png" class="figure-img img-fluid shadow rounded">
										</a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3">
										<a class="install" href="https://www.youtube.com/embed/lB8-VTq1V6k"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara install aplikasi" /></a>
									</div>
								</div>
								<!--//gallery-->
								<li>Setelah selesai install klik here to login</li>
								<li>Isikan email dan password untuk masuk ke aplikasi</li>
								<div class=" row mb-3">
									<div class="col-12 col-md-6 mb-3">
										<a class="install" href="<?= base_url('assets/'); ?>doc/images/login_page.png">
											<img src="<?= base_url('assets/'); ?>doc/images/login_page.png" class="figure-img img-fluid shadow rounded">
										</a>
									</div>
									
								</div>
							</ol>
						</section>
						<!--//section-->
					</article>
					
					
					<article class="docs-article" id="section-2">
						<header class="docs-header">
							<h1 class="docs-heading">Pengaturan</h1>
							<section class="docs-intro">
								<p>Menu Pengaturan meliputi:</p>
								<ol>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-1">Penguna.</a></li>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-2">Jenis pembayaran.</a></li>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-3">Rekening Bank.</a></li>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-4">Aplikasi.</a></li>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-5">Printer.</a></li>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-6">Folder.</a></li>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-7">Menu Admin.</a></li>
									<li class="p-0"><a class="nav-link scrollto" href="#item-2-8">Reset & Input Sample</a></li>
								</ol>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-2-1">
							<h2 class="section-heading">Pengguna</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus pengguna</p>
							<p>Untuk detail pengguna <a href="#section-7">KLIK DISINI</a></p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="pengguna" href="<?= base_url('assets/'); ?>doc/images/list-pengguna.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-pengguna.png" alt="" title="List pengguna" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="pengguna" href="<?= base_url('assets/'); ?>doc/images/add-pengguna.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-pengguna.png" alt="" title="Add Pengguna" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="pengguna" href="<?= base_url('assets/'); ?>doc/images/edit-pengguna.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-pengguna.png" alt="" title="Edit Pengguna" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="pengguna" href="https://www.youtube.com/embed/Ab09URj_fvw"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input pengguna" /></a>
								</div>
							</div>
							<!--//gallery-->
							<code>Catatan : pengguna yang sudah melakukan transaksi tidak bisa dihapus hanya bisa di sunting</code>
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-2-2">
							<h2 class="section-heading">Jenis Pembayaran</h2>
							<p>Fitur ini digunakan untuk menyunting jenis pembayaran. Adapun jenis pembayaran yang disediakan meliputi</p>
							<ol>
								<li>Pembayaran Tunai</li>
								<li>Pembayaran Transfer</li>
								<li>Pembayaran Tempo</li>
							</ol>
							<div class="row mb-1">
								<div class="col-12 col-md-6 mb-3">
									<a class="pembayaran" href="<?= base_url('assets/'); ?>doc/images/list-jenis-pembayaran.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-jenis-pembayaran.png" alt="" title="List pembayaran" /></a>
								</div>
								<div class="col-12 col-md-6 mb-3">
									<a class="pembayaran" href="<?= base_url('assets/'); ?>doc/images/edit-jenis-pembayaran.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-jenis-pembayaran.png" alt="" title="Edit pembayaran" /></a>
								</div>
								<!--//col-->
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-2-3">
							<h2 class="section-heading">Rekening Bank</h2>
							<p>Fitur ini digunakan untuk menambah dan menyunting data Rekening Bank Perusahaan/pemilik.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="rekening" href="<?= base_url('assets/'); ?>doc/images/list-rekening.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-rekening.png" alt="" title="List rekening" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="rekening" href="<?= base_url('assets/'); ?>doc/images/add-rekening.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-rekening.png" alt="" title="Add rekening" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-4 mb-3">
									<a class="rekening" href="<?= base_url('assets/'); ?>doc/images/edit-rekening.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-rekening.png" alt="" title="Edit rekening" /></a>
								</div>
								<!--//col-->
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-2-4">
							<h2 class="section-heading">Aplikasi</h2>
							<p>Fitur ini digunakan untuk menyunting data aplikasi seperti :</p>
							<h5>Title/Nama Aplikasi</h5>
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/title.png" alt="" data-bs-toggle="tooltip" data-bs-placement="top" title="Title | judul aplikasi" />
								</div>
								<!--//col-->
							</div>
							<!--//row-->
							<h5>Alamat | Keterangan Login | Footer Invoice</h5>
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/alamat.png" alt="Alamat | Keterangan Login | Footer Invoice" data-bs-toggle="tooltip" data-bs-placement="top" title="Alamat | Keterangan Login | Footer Invoice" />
								</div>
								<!--//col-->
							</div>
							<!--//row-->
							<h5>Email & Nomor Handphone</h5>
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/email.png" alt="Email & Nomor Handphone" data-bs-toggle="tooltip" data-bs-placement="top" title="Email & Nomor Handphone" />
								</div>
								<!--//col-->
							</div>
							<!--//row-->
							<h5>Sosial media & Alamat tanggal pembuatan</h5>
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/sosmed.png" alt="Sosial media & Alamat tanggal pembuatan" data-bs-toggle="tooltip" data-bs-placement="top" title="Sosial media & Alamat tanggal pembuatan" />
								</div>
								<!--//col-->
							</div>
							<!--//row-->
							<h5>Warna invoice lunas dan belum lunas serta warna aplikasi</h5>
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/warna.png" alt="Warna invoice lunas dan belum lunas serta warna aplikasi" data-bs-toggle="tooltip" data-bs-placement="top" title="Warna invoice lunas dan belum lunas serta warna aplikasi" />
								</div>
								<!--//col-->
							</div>
							<!--//row-->
							<h5>Logo invoice lunas dan belum lunas serta stempel</h5>
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/logo.png" alt="Logo invoice lunas dan belum lunas serta stempel" data-bs-toggle="tooltip" data-bs-placement="top" title="Logo invoice lunas dan belum lunas serta stempel" />
								</div>
								<!--//col-->
							</div>
							<!--//row-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-2-5">
							<h2 class="section-heading">Printer</h2>
							<p>Fitur ini digunakan untuk menyunting printer mana yang akan digunakan untuk mencetak invoice penjualan.</p>
							<div class="row mb-1">
								<div class="col-12 col-md-6 mb-3">
									<a class="printer" href="<?= base_url('assets/'); ?>doc/images/list-printer.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-printer.png" alt="" title="List printer" /></a>
								</div>
								<div class="col-12 col-md-6 mb-3">
									<a class="printer" href="<?= base_url('assets/'); ?>doc/images/edit-printer.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-printer.png" alt="" title="Edit printer" /></a>
								</div>
								<!--//col-->
								
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-2-6">
							<h2 class="section-heading">Folder</h2>
							<p>Fitur ini digunakan untuk mengelola folder dan juga file konsumen serta mempermudah penamaan file untuk di cetak</p>
							<p>Agar folder bisa di buat secara otomatis dari program maka pengaturan shared folder sangat di butuhkan. gambar di bawah menunjukan nama komputer yang pada jaringan yang akan digunakan untuk mengelola folder dan menyimpan file-file konsumen</p>
							<div class="row">
								<div class="col-12 col-md-12 mb-3">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/network.png" alt="" title="Network shared" />
								</div>
							</div>
							<p>gambar di bawah menunjukan nama folder pada jaringan yang dibagi menjadi 4 kelompok abjad A-F, G-M, N-S, T-Z, folder tersebut harus atur agar bisa di baca dan ditulis agar kita bisa membuat folder sesuai nama konsumen dari aplikasi Contoh : //data/A-F/A/Andy - 08123456789</p>
							<div class="row">
								<div class="col-12 col-md-12 mb-3">
									<img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/folder-shared.png" alt="" title="Network shared" />
								</div>
							</div>
							<div class="row mb-1">
								<div class="folder row mb-1">
									<div class="col-12 col-md-12 mb-3">
										<a class="folder" href="<?= base_url('assets/'); ?>doc/images/folder.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/folder.png" alt="" title="manage folder" /></a>
									</div>
								</div>
								<!--//gallery-->
							</div>
							<!--//gallery-->
						</section>
						<section class="docs-section" id="item-2-7">
							<h2 class="section-heading">Menu Admin</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus menu-menu yang ada di halaman admin. Secara default menu ini hanya di tampilkan pada akun admin</p>
							<div class="row mb-1">
								<div class="col-12 col-md-4 mb-3">
									<a class="menu-admin" href="<?= base_url('assets/'); ?>doc/images/list-menu.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-menu-thumb.png" alt="" title="List menu" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="menu-admin" href="<?= base_url('assets/'); ?>doc/images/edit-menu.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-menu-thumb.png" alt="" title="Edit menu" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-4 mb-3">
									<a class="menu-admin" href="https://www.youtube.com/embed/Ab09URj_fvw"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara sunting menu" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						
						<section class="docs-section" id="item-2-8">
							<h2 class="section-heading">Reset & Input Sample</h2>
							<p>Fitur ini digunakan untuk mereset beberapa data pada aplikasi dan mengiinput sample</p>
							<div class="row mb-1">
								<div class="col-12 col-md-4 mb-3">
									<a class="menu-admin" href="<?= base_url('assets/'); ?>doc/images/list-menu.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-menu-thumb.png" alt="" title="List menu" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="menu-admin" href="<?= base_url('assets/'); ?>doc/images/edit-menu.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-menu-thumb.png" alt="" title="Edit menu" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-4 mb-3">
									<a class="menu-admin" href="https://www.youtube.com/embed/Ab09URj_fvw"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara sunting menu" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<!--//section-->
					</article>
					<!--//docs-article-->
					
					<article class="docs-article" id="section-3">
						<header class="docs-header">
							<h1 class="docs-heading">Produk</h1>
							<section class="docs-intro">
								<p>Produk meliputi :</p>
								<ol>
									<li>Kategori</li>
									<li>Satuan</li>
									<li>Produk</li>
									<li>Supplier</li>
								</ol>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-3-1">
							<h2 class="section-heading">Kategori</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Kategori Produk, Satuan Produk, Produk, Supplier.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="<?= base_url('assets/'); ?>doc/images/kategori.png" data-title="List kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/kategori.png" alt="" title="List kategori" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="<?= base_url('assets/'); ?>doc/images/add-kategori.png" data-title="Add kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-kategori.png" alt="" title="Add kategori" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="<?= base_url('assets/'); ?>doc/images/edit-kategori.png" data-title="Edit kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-kategori.png" alt="" title="Edit kategori" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Cara input kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input kategori" /></a>
								</div>
								
							</div>
							<!--//gallery-->
							
							<code>Catatan : untuk kategori yang memiliki hitungan seperti outdoor maka Hitung Ukuran = Ya </code>
						</section>
						<!--//section-->
						
						
						<section class="docs-section" id="item-3-2">
							<h2 class="section-heading">Satuan</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Satuan Produk.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="satuan" href="<?= base_url('assets/'); ?>doc/images/list-satuan.png" data-title="List satuan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-satuan.png" alt="" title="List satuan" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="satuan" href="<?= base_url('assets/'); ?>doc/images/add-satuan.png" data-title="Add satuan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-satuan.png" alt="" title="Add satuan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="satuan" href="<?= base_url('assets/'); ?>doc/images/edit-satuan.png" data-title="Edit satuan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-satuan.png" alt="" title="Edit satuan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="satuan" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input satuan" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-3-3">
							<h2 class="section-heading">Produk</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Produk.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="produk" href="<?= base_url('assets/'); ?>doc/images/list-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-produk.png" alt="" title="List produk" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="produk" href="<?= base_url('assets/'); ?>doc/images/add-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-produk.png" alt="" title="Add produk" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="produk" href="<?= base_url('assets/'); ?>doc/images/edit-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-produk.png" alt="" title="Edit produk" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="produk" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input produk" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						<section class="docs-section" id="item-3-4">
							<h2 class="section-heading">Supplier</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus supplier.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="supplier" href="<?= base_url('assets/'); ?>doc/images/list-supplier.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-supplier.png" alt="" title="List supplier" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="supplier" href="<?= base_url('assets/'); ?>doc/images/add-supplier.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-supplier.png" alt="" title="Add supplier" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="supplier" href="<?= base_url('assets/'); ?>doc/images/edit-supplier.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-supplier.png" alt="" title="Edit supplier" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="supplier" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input supplier" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						<section class="docs-section" id="item-3-6">
							<h2 class="section-heading">Jenis Pengeluaran</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Jenis pengeluaran.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/list-pengeluaran.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-pengeluaran.png" alt="" title="List pengeluaran" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/add-pengeluaran.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-pengeluaran.png" alt="" title="Add pengeluaran" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/edit-pengeluaran.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-pengeluaran.png" alt="" title="Edit pengeluaran" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="pengeluaran" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input pengeluaran" /></a>
								</div>
							</div>
							<!--//gallery-->
							<code>Catatan : Untuk pengeluaran yang memiliki piutang masuk ke jenis belanja khusus</code>
						</section>
						<!--//section-->
					</article>
					<article class="docs-article" id="section-33">
						<header class="docs-header">
							<h1 class="docs-heading">Stok Barang</h1>
							<section class="docs-intro">
								<p>Master data meliputi :</p>
								<ol>
									<li>Harga Produk</li>
									<li>Data Stok</li>
									<li>Stok Masuk</li>
									<li>Stok Keluar</li>
									<li>History Stok</li>
								</ol>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-33-1">
							<h2 class="section-heading">Harga Produk</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Kategori Produk.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="<?= base_url('assets/'); ?>doc/images/kategori.png" data-title="List kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/kategori.png" alt="" title="List kategori" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="<?= base_url('assets/'); ?>doc/images/add-kategori.png" data-title="Add kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-kategori.png" alt="" title="Add kategori" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="<?= base_url('assets/'); ?>doc/images/edit-kategori.png" data-title="Edit kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-kategori.png" alt="" title="Edit kategori" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="kategori" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Cara input kategori"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input kategori" /></a>
								</div>
								
							</div>
							<!--//gallery-->
							
							<code>Catatan : untuk kategori yang memiliki hitungan seperti outdoor maka Hitung Ukuran = Ya </code>
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-33-2">
							<h2 class="section-heading">Data Stok</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Bahan Produk.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="bahan" href="<?= base_url('assets/'); ?>doc/images/list-bahan.png" data-title="List bahan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-bahan.png" alt="" title="List bahan" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="bahan" href="<?= base_url('assets/'); ?>doc/images/add-bahan.png" data-title="Add bahan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-bahan.png" alt="" title="Add bahan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="bahan" href="<?= base_url('assets/'); ?>doc/images/edit-bahan.png" data-title="Edit bahan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-bahan.png" alt="" title="Edit bahan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="bahan" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input bahan" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-33-3">
							<h2 class="section-heading">Stok Masuk</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Satuan Produk.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="satuan" href="<?= base_url('assets/'); ?>doc/images/list-satuan.png" data-title="List satuan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-satuan.png" alt="" title="List satuan" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="satuan" href="<?= base_url('assets/'); ?>doc/images/add-satuan.png" data-title="Add satuan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-satuan.png" alt="" title="Add satuan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="satuan" href="<?= base_url('assets/'); ?>doc/images/edit-satuan.png" data-title="Edit satuan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-satuan.png" alt="" title="Edit satuan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="satuan" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input satuan" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-33-4">
							<h2 class="section-heading">Stok Keluar</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus Produk.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="produk" href="<?= base_url('assets/'); ?>doc/images/list-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-produk.png" alt="" title="List produk" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="produk" href="<?= base_url('assets/'); ?>doc/images/add-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-produk.png" alt="" title="Add produk" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="produk" href="<?= base_url('assets/'); ?>doc/images/edit-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-produk.png" alt="" title="Edit produk" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="produk" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input produk" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						<section class="docs-section" id="item-33-5">
							<h2 class="section-heading">History Stok</h2>
							<p>Fitur ini digunakan untuk menambah, menyunting dan menghapus supplier.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="supplier" href="<?= base_url('assets/'); ?>doc/images/list-supplier.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-supplier.png" alt="" title="List supplier" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="supplier" href="<?= base_url('assets/'); ?>doc/images/add-supplier.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-supplier.png" alt="" title="Add supplier" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="supplier" href="<?= base_url('assets/'); ?>doc/images/edit-supplier.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/edit-supplier.png" alt="" title="Edit supplier" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="supplier" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input supplier" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						<!--//section-->
					</article>
					<!--//docs-article-->
					<article class="docs-article" id="section-1">
						<header class="docs-header">
							<h1 class="docs-heading">Transaksi</h1>
							<section class="docs-intro">
								<p>Fitur ini digunakan untuk melakukan transaksi</p>
								<p>Transaksi bisa dilakukan di semua halaman karena dilengkapi dengan menu Floating (FAB), Menu FAB akan muncul disemua halaman kecuali di halaman transaksi</p>
								<div class="row mb-3">
									<div class="col-12 col-md-3 mb-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/list-cart.png" data-title="List cart"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/list-cart.png" alt="" title="List cart" /></a>
									</div>
									<div class="col-12 col-md-3 mb-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/cart.png" data-title="Form cart"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/cart.png" alt="" title="Form cart" /></a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3 mb-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/form-add-pelanggan.png" data-title="form cari pelanggan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/form-add-pelanggan.png" alt="" title="form cari pelanggan" /></a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3 mb-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/hasil-cari.png" data-title="hasil cari pelanggan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/hasil-cari.png" alt="" title="hasil cari pelanggan" /></a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/add-pelanggan.png" data-title="hasil cari pelanggan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/add-pelanggan.png" alt="" title="hasil cari pelanggan" /></a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/finishing.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/finishing.png" alt="" title="Keterangan finishing" /></a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/menu-bayar.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/menu-bayar.png" alt="" title="Menu bayar invoice" /></a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3">
										<a class="transaksi" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input transaksi" /></a>
									</div>
									<div class="col-12 col-md-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/invoice-lunas.png" title="Invoice Lunas"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/invoice-lunas.png" alt="" /></a>
									</div>
									<!--//col-->
									<div class="col-12 col-md-3">
										<a class="transaksi" href="<?= base_url('assets/'); ?>doc/images/cart/invoice-belum-lunas.png" data-title="Invoice Belum Lunas"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cart/invoice-belum-lunas.png" alt="" /></a>
									</div>
									<!--//col-->
									
								</div>
								<!--//gallery-->
								
							</section>
							<!--//docs-intro-->
						</header>
						
					</article>
					<article class="docs-article" id="section-4">
						<header class="docs-header">
							<h1 class="docs-heading">Keuangan</h1>
							<section class="docs-intro">
								<p>Fitur ini digunakan untuk melihat Uang kas dari hasil penjualan.</p>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-4-1">
							<h2 class="section-heading">Kas</h2>
							<p>Fitur ini hanya menampilkan Semua uang yang masuk dari hasil penjualan dan hasil mutasi</p>
							<div class="row mb-3">
								<div class="col-12 col-md-12 mb-3">
									<a href="<?= base_url('assets/'); ?>doc/images/list-kas.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-kas.png" alt="" title="Uang kas" /></a>
								</div>
								<!--//col-->
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-4-2">
							<h2 class="section-heading">Mutasi</h2>
							<p>Fitur ini digunakan untuk melakukan mutasi keuangan dari satu kas ke kas yang lain</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="mutasi" href="<?= base_url('assets/'); ?>doc/images/list-mutasi.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-mutasi.png" alt="" title="List Mutasi" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="mutasi" href="<?= base_url('assets/'); ?>doc/images/add-mutasi.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/add-mutasi.png" alt="" title="Add mutasi" /></a>
								</div>
								<!--//col-->
								
								<div class="col-12 col-md-4">
									<a class="mutasi" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input mutasi" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
					</article>
					<!--//docs-article-->
					
					<article class="docs-article" id="section-5">
						<header class="docs-header">
							<h1 class="docs-heading">Laporan</h1>
							<section class="docs-intro">
								<p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-5-1">
							<h2 class="section-heading">Omset Penjualan</h2>
							<p>Fitur ini menampilkan laporan penjualan per produk dan perkategori berdasarkan tanggal yang dipilih</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="penjualan" href="<?= base_url('assets/'); ?>doc/images/laporan-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/laporan-produk.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="penjualan" href="<?= base_url('assets/'); ?>doc/images/laporan-kategori.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/laporan-kategori.png" alt="" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="penjualan" href="<?= base_url('assets/'); ?>doc/images/cetak-produk.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cetak-produk.png" alt="" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="penjualan" href="<?= base_url('assets/'); ?>doc/images/cetak-kategori.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/cetak-kategori.png" alt="" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="penjualan" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Video laporan penjualan" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-5-2">
							<h2 class="section-heading">Rincian Pendapatan</h2>
							<p>Fitur ini digunakan melihat rincian penjualan berdasarkan tanggal yg dipilih</p>
							<div class="row mb-3">
								<div class="col-12 col-md-6 mb-3">
									<a class="penjualan" href="<?= base_url('assets/'); ?>doc/images/list-rincian-laporan.png"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-rincian-laporan.png" alt="" title="List rincian penjualan" /></a>
								</div>
								
								<div class="col-12 col-md-6">
									<a class="penjualan" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Video Rincian" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-5-3">
							<h2 class="section-heading">Rincian Penjualan</h2>
							<p>Fitur ini digunakan melihat rincian uang masuk berdasarkan tanggal yg dipilih dan juga per kasir</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="uangmasuk" href="<?= base_url('assets/'); ?>doc/images/list-uangmasuk.png" data-title="List rincian uang masuk"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-uangmasuk.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="uangmasuk" href="<?= base_url('assets/'); ?>doc/images/laporan-semua.png" data-title="Print PDF Laporan uang masuk semua kasir"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/laporan-semua.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="uangmasuk" href="<?= base_url('assets/'); ?>doc/images/laporan-perkasir.png" title="Print PDF Laporan uang masuk perkasir"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/laporan-perkasir.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-3">
									<a class="uangmasuk" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Video laporan uang masuk"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						<section class="docs-section" id="item-5-4">
							<h2 class="section-heading">Piutang Penjualan</h2>
							<p>Fitur ini digunakan melihat piutang berdasarkan pencarian no order, nama pelanggan dan no telepon pelanggan berdasarkan kasir, bulan dan tahun yg dipilih</p>
							<div class="row mb-3">
								<div class="col-12 col-md-12 mb-3">
									<a class="piutang" href="<?= base_url('assets/'); ?>doc/images/list-piutang.png" data-title="List piutang"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-piutang.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						<!--//section-->
						<section class="docs-section" id="item-5-5">
							<h2 class="section-heading">List Pekerjaan</h2>
							<p>Fitur ini digunakan melihat pendapatan berdasarkan tanggal yg dipilih</p>
							<div class="row mb-3">
								<div class="col-12 col-md-6 mb-3">
									<a class="pendapatan" href="<?= base_url('assets/'); ?>doc/images/list-pendapatan.png" data-title="Rincian pendapatan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/list-pendapatan.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-6 mb-3">
									<a class="pendapatan" href="<?= base_url('assets/'); ?>doc/images/laporan-pendapatan.png" data-title="Print PDF Laporan pendapatan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/laporan-pendapatan.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						
						<section class="docs-section" id="item-5-6">
							<h2 class="section-heading">Desain</h2>
							<p>Fitur ini digunakan untuk input pengeluaran</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/pengeluaran.png" data-title="List pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pengeluaran.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/print-pengeluaran.png" data-title="Print PDF Laporan pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/print-pengeluaran.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4">
									<a class="pengeluaran" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Video input pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>	
						<section class="docs-section" id="item-5-7">
							<h2 class="section-heading">Pembelian</h2>
							<p>Fitur ini digunakan untuk input pengeluaran</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/pengeluaran.png" data-title="List pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pengeluaran.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/print-pengeluaran.png" data-title="Print PDF Laporan pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/print-pengeluaran.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4">
									<a class="pengeluaran" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Video input pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>	
						<section class="docs-section" id="item-5-8">
							<h2 class="section-heading">Pengeluaran</h2>
							<p>Fitur ini digunakan untuk input pengeluaran</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/pengeluaran.png" data-title="List pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pengeluaran.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="pengeluaran" href="<?= base_url('assets/'); ?>doc/images/print-pengeluaran.png" data-title="Print PDF Laporan pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/print-pengeluaran.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4">
									<a class="pengeluaran" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Video input pengeluaran"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						<section class="docs-section" id="item-5-9">
							<h2 class="section-heading">Log Transaksi</h2>
							<p>Fitur ini digunakan untuk melihat aktifitas transaksi</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="log" href="<?= base_url('assets/'); ?>doc/images/log-transaksi.png" data-title="List log semua transaksi"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/log-transaksi.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4 mb-3">
									<a class="log" href="<?= base_url('assets/'); ?>doc/images/log-user.png" data-title="List log transaksi per user"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/log-user.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4">
									<a class="log" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Video"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
					</article>
					<!--//docs-article-->
					
					
					<article class="docs-article" id="section-6">
						<header class="docs-header">
							<h1 class="docs-heading">Grafik</h1>
							<section class="docs-intro">
								<p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-6-1">
							<h2 class="section-heading">Omset Penjualan</h2>
							<p>Fitur ini digunakan untuk melihat grafik penjualan berdasarkan periode bulan</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="grafik" href="<?= base_url('assets/'); ?>doc/images/grafik-omset.png" data-title="Grafik omset"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/grafik-omset.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4">
									<a class="grafik" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Video"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-6-2">
							<h2 class="section-heading">Penjualan Produk</h2>
							<p>Fitur ini digunakan untuk melihat grafik penjualan berdasarkan periode bulan</p>
							<div class="row mb-3">
								<div class="col-12 col-md-4 mb-3">
									<a class="grafik" href="<?= base_url('assets/'); ?>doc/images/grafik-produk.png" data-title="Grafik produk"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/grafik-produk.png" alt="" /></a>
								</div>
								<div class="col-12 col-md-4">
									<a class="grafik" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Video"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<!--//section-->
						
					</article>
					<!--//docs-article-->
					
					<article class="docs-article" id="section-10">
						<header class="docs-header">
							<h1 class="docs-heading">Pelanggan</h1>
							<section class="docs-intro">
								<p>Fitur untuk memanage data pelanggan mengecek history pembelian dll</p>
							</section>
						</header>
						<section class="docs-section" id="item-10-1">
							<h2 class="section-heading">Data Pelanggan</h2>
							<p>Fitur ini digunakan untuk melakuan crud  data pelanggan dan juga bisa mengecek history pembelian</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="pelanggan" href="<?= base_url('assets/'); ?>doc/images/pelanggan/list-pelanggan.png" data-title="List pelanggan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pelanggan/list-pelanggan.png" alt="" title="List pelanggan" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="pelanggan" href="<?= base_url('assets/'); ?>doc/images/pelanggan/detail-pelanggan.png" data-title="Detail order pelanggan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pelanggan/detail-pelanggan.png" alt="" title="Detail order pelanggan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3 mb-3">
									<a class="pelanggan" href="<?= base_url('assets/'); ?>doc/images/pelanggan/form-edit.png" data-title="form edit pelanggan"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pelanggan/form-edit.png" alt="" title="form edit pelanggan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="pelanggan" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input transaksi" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
						<section class="docs-section" id="item-10-2">
							<h2 class="section-heading">Jenis Member</h2>
							<p>Fitur ini digunakan untuk melakuan crud  Jenis Member</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="member" href="<?= base_url('assets/'); ?>doc/images/pelanggan/list-member.png" data-title="List jenis member"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pelanggan/list-member.png" alt="" title="List jenis member" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="member" href="<?= base_url('assets/'); ?>doc/images/pelanggan/edit-member.png" data-title="Edit member"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/pelanggan/edit-member.png" alt="" title="Edit member" /></a>
								</div>
								
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="member" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input transaksi" /></a>
								</div>
							</div>
							<!--//gallery-->
						</section>
					</article>
					<article class="docs-article" id="section-7">
						<header class="docs-header">
							<h1 class="docs-heading">Pengguna</h1>
							<section class="docs-intro">
								<p>Fitur ini digunakan untuk mengelola pengguna aplikasi ada 6 role yang dapat digunakan, dan masing-masing bisa dikeloala sesuai jobdesk nya</p>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-7-1">
							<h2 class="section-heading">Admin</h2>
							<p>Role admin memiliki akses penuh pada semua menu yang ada di aplikasi</p>
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-7-2">
							<h2 class="section-heading">Owner</h2>
							<p>Role owner hanya memiliki akses sesuai yang tertera pada gambar dan akses ini bisa di tambah atau di kurang oleh admin</p>
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-7-3">
							<h2 class="section-heading">Kasir</h2>
							<p>Role Kasir hanya memiliki akses sesuai yang tertera pada gambar dan akses ini bisa di tambah atau di kurang oleh admin</p>
						</section>
						<!--//section-->
						<section class="docs-section" id="item-7-4">
							<h2 class="section-heading">Keuangan</h2>
							<p>Role Keuangan hanya memiliki akses sesuai yang tertera pada gambar dan akses ini bisa di tambah atau di kurang oleh admin</p>
						</section>
						<!--//section-->
						<section class="docs-section" id="item-7-5">
							<h2 class="section-heading">Desain</h2>
							<p>Role Desain hanya memiliki akses sesuai yang tertera pada gambar dan akses ini bisa di tambah atau di kurang oleh admin</p>
						</section>
						<!--//section-->
						<section class="docs-section" id="item-7-6">
							<h2 class="section-heading">Operator</h2>
							<p>Role Operator hanya memiliki akses sesuai yang tertera pada gambar dan akses ini bisa di tambah atau di kurang oleh admin</p>
						</section>
						<!--//section-->
					</article>
					<!--//docs-article-->
					
					
					<article class="docs-article" id="section-8">
						<header class="docs-header">
							<h1 class="docs-heading">Profil</h1>
							<section class="docs-intro">
								<p>Fitur ini digunakan untuk mengelola data pengguna aplikasi</p>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-8-1">
							<h2 class="section-heading">Detail Profil</h2>
							<p></p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="profil" href="<?= base_url('assets/'); ?>doc/images/detail-profil.png" data-title="List cart"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/thumb_profile.png" alt="" title="List pelanggan" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="profil" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input transaksi" /></a>
								</div>
							</div>
						</section>
						<!--//section-->
					</article>
					<!--//docs-article-->
					
					
					<article class="docs-article" id="section-9">
						<header class="docs-header">
							<h1 class="docs-heading">Backup & Update</h1>
							<section class="docs-intro">
								<p>Fitur ini digunakan untuk melakuan pengecekan versi aplikasi dan juga backup database</p>
							</section>
							<!--//docs-intro-->
						</header>
						<section class="docs-section" id="item-9-1">
							<h2 class="section-heading">Cek Update</h2>
							<p>Untuk melakukan pengecakan aplikasi bisa dilakukan dengan menekan tombol cek update.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="update" href="<?= base_url('assets/'); ?>doc/images/update/update-1.png" data-title="List Update"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/update/update-1.png" alt="" title="List Update" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="update" href="<?= base_url('assets/'); ?>doc/images/update/update-2.png" data-title="Notif Update"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/update/update-2.png" alt="" title="Notif Update" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="update" href="<?= base_url('assets/'); ?>doc/images/update/update-3.png" data-title="Notif Update"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/update/update-3.png" alt="" title="Notif Update" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="update" href="https://www.youtube.com/watch?v=x4oXkAe_-5c" data-title="Update"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input transaksi" /></a>
								</div>
							</div>
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-9-2">
							<h2 class="section-heading">Backup Database</h2>
							<p>Fitur ini bisa digunakan secara berkala untuk membackup database dan juga bisa di restore.</p>
							<div class="row mb-3">
								<div class="col-12 col-md-3 mb-3">
									<a class="backup" href="<?= base_url('assets/'); ?>doc/images/backup/list_backup.png" data-title="List backup"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/backup/list_backup.png" alt="" title="List backup" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="backup" href="<?= base_url('assets/'); ?>doc/images/backup/notif-backup.png" data-title="Notif backup sukses"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/backup/notif-backup.png" alt="" title="Notif backup sukses" /></a>
								</div>
								<div class="col-12 col-md-3 mb-3">
									<a class="backup" href="<?= base_url('assets/'); ?>doc/images/backup/notif-unzip.png" data-title="Notif unzip sukses"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/backup/notif-unzip.png" alt="" title="Notif unzip sukses" /></a>
								</div>
								<!--//col-->
								<div class="col-12 col-md-3">
									<a class="backup" href="https://www.youtube.com/watch?v=x4oXkAe_-5c"  data-title="backup"><img class="figure-img img-fluid shadow rounded" src="<?= base_url('assets/'); ?>doc/images/video.png" alt="" title="Cara input transaksi" /></a>
								</div>
							</div>
						</section>
						<!--//section-->
						
						<section class="docs-section" id="item-9-3">
							<h2 class="section-heading">History Login User</h2>
							<p>Fitur ini digunakan untuk mengetahui siapa saja yang login pada aplikasi. dan histori ini bisa di reset ulang jika diperlukan</p>
						</section>
						<!--//section-->
					</article>
					<!--//docs-article-->
					
					<footer class="footer">
						<div class="container text-center py-5">
							<small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="theme-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
						</div>
					</footer>
				</div>
			</div>
		</div>
		<!--//docs-wrapper-->
		
		<script src="<?= base_url('assets/'); ?>doc/plugins/jquery-3.4.1.min.js"></script>
		<!-- Javascript -->
		<script src="<?= base_url('assets/'); ?>doc/plugins/popper.min.js"></script>
		<script src="<?= base_url('assets/'); ?>doc/plugins/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Page Specific JS -->
		<script src="<?= base_url('assets/'); ?>doc/plugins/smoothscroll.min.js"></script>
		
		<script src="<?= base_url('assets/'); ?>doc/plugins/gumshoe/gumshoe.polyfills.min.js"></script>
		<script src="<?= base_url('assets/'); ?>doc/js/glightbox.min.js"></script>
		<script src="<?= base_url('assets/'); ?>doc/js/jquery-highlight1.js"></script>
		<script src="<?= base_url('assets/'); ?>doc/js/docs.js?v=2"></script>
	</body>
	
</html>