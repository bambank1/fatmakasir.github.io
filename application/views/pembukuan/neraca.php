<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Neraca</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Laporan</li>
			<li class="breadcrumb-item active" aria-current="page">Neraca</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12 mb-4">
			<!-- Simple Tables -->
			<div class="card">
				
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Laporan Neraca</h6>
					<div class="input-group input-group-sm w-25">
						<div class="input-group-prepend">
							<button class="btn btn-info btn-sm" id="cetak_neraca"><i class="fa fa-file-pdf-o"></i> Print</button>
						</div>
						<input type="text" id="tanggal" value="<?=$periode;?>" class="form-control date-laporan" placeholder="mm/yyyy" onchange="LaporanNeraca();"/>
						 <div class="input-group-append">
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
<form method="POST" action="<?=base_url();?>pembukuan/cetak_neraca_saldo" id="target" target="_blank">
<input type="hidden" name="startdate" id="startdate" readonly  />
</form>
<script>
	
	$("#cetak_neraca").click(function(e) {
		e.preventDefault();
		$( "#target" ).submit();
	});
	  
	var date2 = new Date();
	$('.date-laporan').datepicker({        
        format: 'mm/yyyy', 
		"endDate": date2,
        autoclose: true,     
        startView: "months", 
		minViewMode: "months", 
	});  
	
	LaporanNeraca();
	
	function LaporanNeraca(){
		var tanggal = $("#tanggal").val();
		 $("#startdate").val(tanggal);
		var urlnya = base_url+"pembukuan/laporan_neraca/";
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{tanggal:tanggal},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#labaRugi').html(html);
				$('body').loading('stop');
				var total_pj = $("#total_um").val();
				if(total_pj ==0){
					$("#cetak_neraca").attr('disabled',true);
					}else{
					$("#cetak_neraca").attr('disabled',false);
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
