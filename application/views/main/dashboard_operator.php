<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="row mb-3">
          
		<!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body" id="Loadingdesain">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-baru">0</div>
						</div>
                        <div class="col-auto">
							<a href="#">
							<i class="fa fa-photo fa-2x text-warning"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body" id="Loadingdesainnow">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Proses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-proses">0</div>
						</div>
                        <div class="col-auto">
							<a href="#" >
							<i class="fa fa-photo fa-2x text-info"></i></a>
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
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-selesai">0</div>
						</div>
                        <div class="col-auto">
							<a href="#">
								<i class="fa fa-photo fa-2x text-success"></i></a>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Area Chart -->
	
		<div class="col-xl-12 col-lg-12">
			<div class="card" id="LoadingInvoice">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Data Pekerjaan</h6>
					<a class="m-0 float-right btn btn-danger btn-sm" href="<?=base_url('laporan/operator');?>">Detail</a>
				</div>
                <div class="table-responsive">
					<table class="table align-items-center table-flush">
						<thead class="thead-light">
							<tr>
								<th>ORDER ID</th>
								<th class="text-left">JUMLAH</th>
								<th class="text-left">PRODUK</th>
								<th class="text-left">JENIS</th>
								<th class="text-left">KETERANGAN</th>
								<th class="text-left">OPERATOR</th>
								<th class="text-right">STATUS</th>
							</tr>
						</thead>
						<tbody id="dataListPekerjaan">
							
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
	
 
	
	$(document).ready(function() {
		baru();proses();selesai();loadinvoice();
		
	});
	
	function loadinvoice(){
		$.ajaxQueue({
			url:  base_url+"operator/list_pekerjaan",
			cache: false,
			beforeSend: function(){
				$("#LoadingInvoice").loading();
			},
			success: function (data) {
				$("#LoadingInvoice").loading('stop');
				$('#dataListPekerjaan').html(data);
			}
		});
	}
	
	   
	function baru(){
		$.ajaxQueue({
			url:  base_url+"operator/baru",
			cache: false,
			beforeSend: function(){
				$("#Loadingdesain").loading();
			},
			success: function (data) {
				$("#Loadingdesain").loading('stop');
				$('.load-baru').html(data);
			}
		});
	}
	function proses(){
		$.ajaxQueue({
			url:  base_url+"operator/proses",
			cache: false,
			beforeSend: function(){
				$("#Loadingdesainnow").loading();
			},
			success: function (data) {
				$("#Loadingdesainnow").loading('stop');
				$('.load-proses').html(data);
			}
		});
	}
	 
	 function selesai(){
		$.ajaxQueue({
			url:  base_url+"operator/selesai",
			cache: false,
			beforeSend: function(){
				$("#Loadingdesainnow").loading();
			},
			success: function (data) {
				$("#Loadingdesainnow").loading('stop');
				$('.load-selesai').html(data);
			}
		});
	}
	 
</script>				