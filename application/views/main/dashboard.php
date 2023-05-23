<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="row mb-3">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100 ">
                <div class="card-body" id="LoadingTotal">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Order Total </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-count">0</div>
						</div>
                        <div class="col-auto" data-toggle='tooltip' title="Transaksi Baru [CTRL+O]">
							<a href="#" class="cek_transaksi" data-id='0' data-modEdit="baru"  id="cart"><i class="fa fa-fw fa-cart-plus fa-2x mdlFire"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body" id="LoadingToday">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Order Hari ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-now">0</div>
						</div>
                        <div class="col-auto">
							<a href="#">
							<i class="fa fa-shopping-cart fa-2x text-success"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body" id="LoadingBaru">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Order Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-baru">0</div>
						</div>
                        <div class="col-auto">
							<a href="#">
							<i class="fa fa-shopping-cart fa-2x text-info"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body" id="LoadingPending">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Order Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-pending">0</div>
						</div>
                        <div class="col-auto">
							<a href="#">
							<i class="fa fa-shopping-cart fa-2x text-warning"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body" id="LoadingBatal">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Order Batal</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-batal">0</div>
						</div>
                        <div class="col-auto">
							<a href="#">
							<i class="fa fa-shopping-cart fa-2x text-danger"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body" id="LoadingKonsumen">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Konsumen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-konsumen">0</div>
						</div>
                        <div class="col-auto">
							<a href="<?=base_url('konsumen');?>" data-toggle="modal" data-target="#OpenKon" data-id="1">
								<i class="fa fa-user-plus fa-2x text-primary"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Area Chart -->
		<div class="col-sm-12 col-md-8 col-lg-8" id="LoadingGrafik">
			<div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary" id="nama_bulan_pendapatan"></h6>
					<div class="btn-group cetak_laporan" role="group" aria-label="Button group with nested dropdown">
						<button class="btn btn-info btn-sm" id="grafik_bulan_omset"><i class="fa fa-calendar"></i> Bulan</button>
						<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<div class="dropdown dropdown-select">
								<a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?=getBulan(date('m'));?>
								</a>
								<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
								aria-labelledby="dropdownMenuLink">
									<div class="dropdown-header">Pilih Periode</div>
									<?php
										$bulan = loopBulan();
										$bulanini = date('m');
										foreach($bulan AS $key=>$val){
											if($key==$bulanini){
												$active = 'active';
												}else{
												$active = '';
											}
											echo '<a class="dropdown-item '.$active.' p-0 pl-3" data-tipe="omset" data-id="'.$key.'" href="javascript:void(0);">'.$val.'</a>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="card-body">
					<div class="chart-area">
						<canvas class="myAreaChart" id="myAreaChart"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4">
			<div class="card" id="LoadingInvoice">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
					<a class="m-0 float-right btn btn-danger btn-sm" href="<?=base_url('penjualan/order');?>">View More</a>
				</div>
                <div class="table-responsive">
					<table class="table align-items-center table-flush">
						<thead class="thead-light">
							<tr>
								<th>ORDER ID</th>
								<th class="text-right">STATUS</th>
								<th class="text-right">LUNAS</th>
							</tr>
						</thead>
						<tbody id="load-invoice">
							
						</tbody>
					</table>
				</div>
                <div class="card-footer"></div>
			</div>
		</div>	
	</div>
</div>
<style>
	.title {
	
	margin-bottom: 50px;
	text-transform: uppercase;
	}
	
	.card-block {
	font-size: 1em;
	position: relative;
	margin: 0;
	padding: 1em;
	border: none;
	border-top: 1px solid rgba(34, 36, 38, .1);
	box-shadow: none;
	
	}
	.card {
	font-size: 1em;
	overflow: hidden;
	padding: 5;
	border: none;
	border-radius: .28571429rem;
	box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
	margin-top:20px;
	}
	
	.carousel-indicators li {
	border-radius: 12px;
	width: 12px;
	height: 12px;
	background-color: #404040;
	}
	.carousel-indicators li {
	border-radius: 12px;
	width: 12px;
	height: 12px;
	background-color: #404040;
	}
	.carousel-indicators .active {
	background-color: white;
	max-width: 12px;
	margin: 0 3px;
	height: 12px;
	}
	.carousel-control-prev-icon {
	background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
	}
	
	.carousel-control-next-icon {
	background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
	}
	lex-direction: column;
	}
	
	.btn {
	margin-top: auto;
	}
</style>
<script>
	
	$('.dropdown-select').on( 'click', '.dropdown-menu a', function() { 
		var target = $(this).html();
		var id = $(this).attr('data-id');
		var tipe = $(this).attr('data-tipe');
		
		if(tipe=='omset'){
			load_chart(id);
		}
		 
		$('.dropdown-item.active').removeClass("active");
		$(this).addClass("active");
		 
		$(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <span class="caret"></span>');
		 
	});
	
	$(document).ready(function() {
		loadcount();baru();pending();konsumen();hari_ini();batal();
		load_chart();loadinvoice();
		
	});
	
	function loadinvoice(){
		$.ajaxQueue({
			url:  base_url+"penjualan/list_invoice",
			cache: false,
			beforeSend: function(){
				$("#LoadingInvoice").loading();
			},
			success: function (data) {
				$("#LoadingInvoice").loading('stop');
				$('#load-invoice').html(data);
			}
		});
	}
	
	
	function loadcount(){
		$.ajaxQueue({
			url:  base_url+"penjualan/totaltrx",
			cache: false,
			beforeSend: function(){
				$("#LoadingTotal").loading();
			},
			success: function (data) {
				$("#LoadingTotal").loading("stop");
				$('.load-count').html(data);
			}
		});
	}
	function hari_ini(){
		$.ajaxQueue({
			url:  base_url+"penjualan/hari_ini",
			cache: false,
			beforeSend: function(){
				$("#LoadingToday").loading();
			},
			success: function (data) {
				$("#LoadingToday").loading('stop');
				$('.load-now').html(data);
			}
		});
	}
	function baru(){
		$.ajaxQueue({
			url:  base_url+"penjualan/baru",
			cache: false,
			beforeSend: function(){
				$("#LoadingBaru").loading();
			},
			success: function (data) {
				$("#LoadingBaru").loading('stop');
				$('.load-baru').html(data);
			}
		});
	}
	function pending(){
		$.ajaxQueue({
			url:  base_url+"penjualan/pending",
			cache: false,
			beforeSend: function(){
				$("#LoadingPending").loading();
			},
			success: function (data) {
				$("#LoadingPending").loading('stop');
				$('.load-pending').html(data);
			}
		});
	}
	function batal(){
		$.ajaxQueue({
			url:  base_url+"penjualan/batal",
			cache: false,
			beforeSend: function(){
				$("#LoadingBatal").loading();
			},
			success: function (data) {
				$("#LoadingBatal").loading('stop');
				$('.load-batal').html(data);
			}
		});
	}
	function konsumen(){
		$.ajaxQueue({
			url:  base_url+"penjualan/konsumen",
			cache: false,
			beforeSend: function(){
				$("#LoadingKonsumen").loading();
			},
			success: function (data) {
				$("#LoadingKonsumen").loading('stop');
				$('.load-konsumen').html(data);
			}
		});
	}
	
</script>				