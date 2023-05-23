<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="row mb-3">
		<!-- Grafik Omset -->
		<div class="col-sm-12 col-md-12 col-lg-12" id="LoadingGrafik">
			<div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary" id="nama_bulan_omset"></h6>
					<div class="btn-group cetak_laporan" role="group" aria-label="Button group with nested dropdown">
						<button class="btn btn-info btn-sm" id="grafik_omset_bulan"><i class="fa fa-calendar"></i> Bulan</button>
						<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<div class="dropdown dropdown-select">
								<a class="dropdown-toggle btn btn-success btn-sm" href="#" role="button" id="dropdownMenuLink"
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
											echo '<a class="dropdown-item p-0 pl-3 '.$active.'" data-tipe="omset" data-id="'.$key.'" href="javascript:void(0);">'.$val.'</a>';
										}
									?>
								</div>
							</div>
							<button class="btn btn-primary btn-sm url_doc" data-url="grafik_omset" type="button" data-toggle="tooltip" data-original-title="Dok grafik omset" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
                <div class="card-body">
					<div class="chart-area" id="ChartOmsetLoading">
						<canvas id="ChartOmset"></canvas>
					</div>
				</div>
			</div>
		</div>
		<!-- Grafik Penjualan Produk -->
		<div class="col-sm-12 col-md-12 col-lg-12" id="LoadingGrafik">
			<div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary" id="nama_bulan_produk"></h6>
					<div class="btn-group cetak_laporan" role="group" aria-label="Button group with nested dropdown">
						<button class="btn btn-info btn-sm" id="grafik_produk_bulan"><i class="fa fa-calendar"></i> Bulan</button>
						<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<div class="dropdown dropdown-select">
								<a class="dropdown-toggle btn btn-success btn-sm" href="#" role="button" id="dropdownMenuLink"
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
											echo '<a class="dropdown-item p-0 pl-3 '.$active.' " data-tipe="produk" data-id="'.$key.'" href="javascript:void(0);">'.$val.'</a>';
										}
									?>
								</div>
							</div>
							<button class="btn btn-primary btn-sm url_doc" data-url="grafik_produk" type="button" data-toggle="tooltip" data-original-title="Dok grafik produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
                <div class="card-body">
					<div class="chart-area" id="ChartOmsetProdukLoading">
						<canvas id="ChartOmsetProduk"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url('assets/');?>js/chart/chart-omset.js?v=<?=time();?>" type="text/javascript"></script>
<script>
	
	$('.dropdown-select').on( 'click', '.dropdown-menu a', function() { 
	var target = $(this).html();
	var id = $(this).attr('data-id');
	var tipe = $(this).attr('data-tipe');
	
	if(tipe=='omset'){
	$("#data_id_omset").val(id);
	load_chart_omset(id);
	}else{
	load_chart_omset_produk(id);
	$("#data_id_produk").val(id);
	}
	//Adds active class to selected item
	$('.dropdown-item.active').removeClass("active");
	$(this).addClass("active");
	
	//Displays selected text on dropdown-toggle button
	$(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <span class="caret"></span>');
	// $(this).parents('.dropdown-menu').find('a').addClass('active');
	});
	
</script>