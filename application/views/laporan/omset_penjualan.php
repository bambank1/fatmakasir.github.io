<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Laporan omset penjualan</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Laporan</li>
			<li class="breadcrumb-item active" aria-current="page">omset penjualan</li>
		</ol>
	</div>
	<div class="row">
		
		<div class="col-md-12">
			<!-- Tabs on Plain Card -->
			<div class="card card-nav-tabs card-plain">
				<div class="card-header card-header-primary py-3 d-flex flex-row align-items-center justify-content-between">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<ul class="nav nav-tabs" data-tabs="tabs">
								<li class="nav-item">
									<a class="nav-link active" href="#produk" data-toggle="tab">Penjualan Per Produk</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#kategori" data-toggle="tab">Penjualan Per Kategori Produk</a>
								</li>
							</ul>
						</div>
					</div>
					
					<div class="btn-group cetak_laporan" role="group" aria-label="Button group with nested dropdown">
						<button class="btn btn-info btn-sm" id="cetak_laporan"><i class="fa fa-file-pdf-o"></i> Print</button>
						
						<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<div class="dropdown dropdown-select">
								<div id="reportrange" style="background: #fff; cursor: pointer; padding: 8px 10px 0 10px; border: 1px solid #ccc; width: 100%;height:38px">
									<i class="fa fa-calendar"></i>&nbsp;
									<span></span> <i class="fa fa-caret-down"></i>
								</div>
							</div>
							<button class="btn btn-primary url_doc" data-url="penjualan" type="button" data-toggle="tooltip" data-original-title="Dok Laporan Penjualan" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
					
				</div>
				<div class="card-body ">
					<div class="tab-content">
						<div class="tab-pane active" id="produk">
							<div id="dataProduk"></div>
						</div>
						<div class="tab-pane" id="kategori">
							<div id="dataKategori"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Tabs on plain Card -->
		</div>
	</div>
</div>
<form method="POST" action="<?=base_url();?>laporan/cetak_laporan_penjualan" id="target" target="_blank">
	<input type="hidden" name="startdate" id="startdate" readonly  />
	<input type="hidden" name="enddate" id="enddate" readonly />
	<input type="hidden" name="jenis" id="jenis" readonly />
</form>
<script>
	
	var awal = '<?=$dari;?>';
	var dari = start.format(awal);
	var sampai = end.format('DD/MM/YYYY');
	$('#startdate').val(dari);
	$('#enddate').val(sampai);
	$(document).on("click",".ranges  li",function() {
		const start_date = $('input[name="daterangepicker_start"]').val();
		const end_date = $('input[name="daterangepicker_end"]').val();
		$('#startdate').val(start_date);
		$('#enddate').val(end_date);
		search_LaporanProduk(0,start_date,end_date);
	});
	$(document).on("click",".applyBtn",function() {
		const start_date = $('input[name="daterangepicker_start"]').val();
		const end_date = $('input[name="daterangepicker_end"]').val();
		$('#startdate').val(start_date);
		$('#enddate').val(end_date);
		search_LaporanProduk(0,start_date,end_date);
		
	});
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var target = $(this).attr("href").replace("#", "");
		$('#jenis').val(target);
		if(target=='produk'){
			search_LaporanProduk();
			}else{
			search_LaporanKategori();
		}
	});
	
	search_LaporanProduk(0,dari,sampai);
	
	function search_LaporanProduk(page_num,startdate,enddate){
		$('#jenis').val('produk');
		var start_date = $("#startdate").val();
		var end_date = $("#enddate").val();
		page_num = page_num?page_num:0;
		startdate = startdate?startdate:start_date;
		enddate = enddate?enddate:end_date;
		
		var urlnya = base_url+"laporan/produk/"+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,dari:startdate,sampai:enddate},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#dataProduk').html(html);
				$('body').loading('stop');
				var total_pj = $("#total_pj").val();
				if(total_pj ==0){
					$("#cetak_laporan").attr('disabled',true);
					}else{
					$("#cetak_laporan").attr('disabled',false);
				}
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	}
	
	function search_LaporanKategori(page_num){
		page_num = page_num?page_num:0;
		var start_date = $("#startdate").val();
		var end_date = $("#enddate").val();
		var urlnya = base_url+"laporan/perkategori/"+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,dari:start_date,sampai:end_date},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#dataKategori').html(html);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	}
	
	$("#cetak_laporan").click(function(e) {
		e.preventDefault();
		$( "#target" ).submit();
	});
</script>
<style>
	
	small {
    font-size: 75%;
    color: #777;
    font-weight: 400;
	}
	
	.container .title{
    color: #3c4858;
    text-decoration: none;
    margin-top: 30px;
    margin-bottom: 25px;
    min-height: 32px;
	}
	
	.container .title h3{
    font-size: 25px;
    font-weight: 300;
	}
	
	div.card {
    border: 0;
    margin-bottom: 30px;
    margin-top: 30px;
    border-radius: 6px;
	color: rgba(0,0,0,.87);
	background: #fff;
	width: 100%;
	box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
	}
	
	div.card.card-plain {
	background: transparent;
	box-shadow: none;
	}
	div.card .card-header {
	border-radius: 3px;
	padding: 1rem 15px;
	margin-left: 15px;
	margin-right: 15px;
	margin-top: -30px;
	border: 0;
	background: linear-gradient(60deg,#eee,#bdbdbd);
	}
	
	.card-plain .card-header:not(.card-avatar) {
	margin-left: 0;
	margin-right: 0;
	}
	
	.div.card .card-body{
	padding: 15px 30px;
	}
	
	div.card .card-header-primary {
	background: linear-gradient(60deg,#ab47bc,#7b1fa2);
	box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(156,39,176,.6);
	}
	
	div.card .card-header-danger {
	background: linear-gradient(60deg,#ef5350,#d32f2f);
	box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(244,67,54,.6);
	}
	
	
	.card-nav-tabs .card-header {
	margin-top: -30px!important;
	}
	
	.card .card-header .nav-tabs {
	padding: 0;
	}
	
	.nav-tabs {
	border: 0;
	border-radius: 3px;
	padding: 0 15px;
	}
	
	.nav {
	display: flex;
	flex-wrap: wrap;
	padding-left: 0;
	margin-bottom: 0;
	list-style: none;
	}
	
	.nav-tabs .nav-item {
	margin-bottom: -1px;
	}
	
	.nav-tabs .nav-item .nav-link.active {
	background-color: hsla(0,0%,100%,.2);
	transition: background-color .3s .2s;
	}
	
	.nav-tabs .nav-item .nav-link{
	border: 0!important;
	color: #fff!important;
	font-weight: 500;
	}
	
	.nav-tabs .nav-item .nav-link {
	color: #fff;
	border: 0;
	margin: 0;
	border-radius: 3px;
	line-height: 24px;
	text-transform: uppercase;
	font-size: 12px;
	padding: 10px 15px;
	background-color: transparent;
	transition: background-color .3s 0s;
	}
	
	.nav-link{
	display: block;
	}
	
	.nav-tabs .nav-item .material-icons {
	margin: -1px 5px 0 0;
	vertical-align: middle;
	}
	
	.nav .nav-item {
	position: relative;
	}
	
</style>