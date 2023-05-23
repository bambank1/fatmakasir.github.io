<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data desain</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">desain</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header pb-1">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
						</div>
						<select id="sortBy" class="form-control form-control-sm custom-select" onchange="search_Desain()">
							<option value="ASC">ASC</option>
							<option value="DESC" selected>DESC</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control form-control-sm custom-select" onchange="search_Desain()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">JENIS</span>
						</div>
						<select id="jenis" class="form-control form-control-sm custom-select" onchange="search_Desain()">
							<option value="1">DESAIN</option>
							<option value="pending" selected>PENDING</option>
							<option value="simpan">SIMPAN</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">DESAIN</span>
						</div>
						<select name="user" id="user_desain" class="form-control form-control-sm" onchange="search_Desain()">
							<?=$select;?>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">TANGGAL</span>
						</div>
						<div id="date-omset">
							<div class="input-daterange input-group">
								<input type="text" onchange="search_Desain()" value="<?=$tgl;?>" class="form-control form-control-sm" name="dari" id="dari">
								
								<input type="text" onchange="search_Desain()" value="<?=$tgl;?>" class="form-control form-control-sm" name="sampai" id="sampai">
							</div>
						</div>
						<div class="input-group-append">
							<button type="button" data-toggle="tooltip" class="btn btn-danger btn-sm clear" id="clear" data-original-title="Clear"><i class="fa fa-times fa-1x"></i> Clear</button>
							<button type="button" data-info="harian" class="btn btn-success btn-sm" data-id="0" onclick="search_Desain()"><i class="fa fa-search"></i> Lihat</button>
							<button class="btn btn-primary url_doc" data-url="lap_rincian" type="button" data-toggle="tooltip" data-original-title="Dok Rincian Penjualan" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
				
				<div class="card-body table-responsive">
					<div class="card-block">
						<!--div id="data_omset"></div-->
						<div class="post-list pt-0" id="dataDesain">
						</div>
					</div><!-- /.card-body -->
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div>
	</div>
</div>
<style>
	.custom-select {
    display: inline-block;
    width: 100%;
    height: 30px;
    padding: 5px 1.75rem 5px .75rem;
	
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 2px;
	
	}
	.card .table td, .card .table th {
    padding-right: 5px;
    padding-left: 5px;
	}
	.small {
    height: 30px;
    padding: 2px 10px;
	}
	button, input, select, textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
	}
	
	
</style>
<script>
	var date2 = new Date();
	$('#date-omset .input-daterange').datepicker({        
        format: 'dd/mm/yyyy',        
		"endDate": date2,
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
	}); 
	$('#user_desain').attr('readonly',true);
	$("#jenis").change(function() {
		var id = $(this).val();
		if(id==1){
			$('#user_desain').attr('readonly',false);
			}else{
			$('#user_desain').attr('readonly',true);
		}
	});
	search_Desain();
	function search_Desain(page_num){
		page_num = page_num?page_num:0;
		var user = $('#user_desain').val();
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		var jenis = $('#jenis').val();
		var urlnya = base_url+'laporan/ajaxdesain/'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,user:user,dari:dari,sampai:sampai,sortBy:sortBy,limits:limits,jenis:jenis},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#dataDesain').html(html);
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
			}
		});
	}
	$('.transaksi_desain_home').click(function(e){
		e.preventDefault();
		var id =  $(this).data("id") // will return the number 123
		var mod = $(this).data('modedit');
		
		$.ajax({
			type: 'POST',
			url: base_url + "main/cek_akses",
			data: {id:id,mod:mod},
			dataType: "json",
			beforeSend: function () {
				$.LoadingOverlay("show", {
					background  : "rgba(165, 190, 100, 0.7)",
					fade:500,
					zIndex:100
				});
			},
			success: handle_Cart,
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	});
</script>			