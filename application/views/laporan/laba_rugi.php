<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Laporan Pendapatan</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Laporan</li>
			<li class="breadcrumb-item active" aria-current="page">Pendapatan</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12 mb-4">
			<!-- Simple Tables -->
			<div class="card">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Laporan Pendapatan</h6>
					<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
						<button class="btn btn-info btn-sm" id="cetak_laporan"><i class="fa fa-file-pdf-o"></i> Print</button>
						<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							<div class="dropdown dropdown-select">
								<div id="reportrange" style="background: #fff; cursor: pointer; padding: 8px 10px 0 10px; border: 1px solid #ccc; width: 100%;height:38px">
									<i class="fa fa-calendar"></i>&nbsp;
									<span></span> <i class="fa fa-caret-down"></i>
								</div>
							</div>
							<button class="btn btn-primary url_doc" data-url="pendapatan" type="button" data-toggle="tooltip" data-original-title="Dok Laporan pendapatan" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table align-items-center table-flush" id="labaRugi">
						
					</table>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
	</div>
</div>
<form method="POST" action="<?=base_url();?>laporan/cetak_laporan_pendapatan" id="target" target="_blank">
	<input type="hidden" name="startdate" id="startdate" readonly  />
	<input type="hidden" name="enddate" id="enddate" readonly />
</form>
<script>
	
	$("#cetak_laporan").click(function(e) {
		e.preventDefault();
		$( "#target" ).submit();
	});
	var dari = start.format('MM/DD/YYYY');
	var sampai = end.format('MM/DD/YYYY');
	$('#startdate').val(dari);
	$('#enddate').val(sampai);
	$(document).on("click",".ranges  li",function() {
		const start_date = $('input[name="daterangepicker_start"]').val();
		const end_date = $('input[name="daterangepicker_end"]').val();
		$('#startdate').val(start_date);
		$('#enddate').val(end_date);
		LaporanLabarugi(start_date,end_date);
	});
	$(document).on("click",".applyBtn",function() {
		const start_date = $('input[name="daterangepicker_start"]').val();
		const end_date = $('input[name="daterangepicker_end"]').val();
		$('#startdate').val(start_date);
		$('#enddate').val(end_date);
		LaporanLabarugi(start_date,end_date);
		
	});
	LaporanLabarugi(dari,sampai);
	
	function LaporanLabarugi(startdate,enddate){
		var start_date = $("#startdate").val();
		var end_date = $("#enddate").val();
		startdate = startdate?startdate:start_date;
		enddate = enddate?enddate:end_date;
		var urlnya = base_url+"laporan/cariLabaRugi/";
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{dari:startdate,sampai:enddate},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#labaRugi').html(html);
				$('body').loading('stop');
				var total_pj = $("#total_um").val();
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
	
	
</script>
