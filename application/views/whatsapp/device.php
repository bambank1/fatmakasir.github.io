<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Device</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Device</li>
		</ol>
	</div>
	 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  d-flex flex-row align-items-center justify-content-between">
					
				</div>
                <div class="card-body">
                    <div class="loading-overlay" style="display:none"><div class="overlay-content">Loading.....</div></div>
					<table class="table table-bordered table-striped table-mailcard" id="data_Table">
						<thead>
							<tr>
								<th>Device</th>
								<th>Device_Status</th>
								<th>Expired</th>
								<th>Quota</th>
								<th>Paket</th>
							</tr>
						</thead>
						<tbody id="posts_content">
							
						</tbody>
					</table>
					
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div>
	</div>
</div>

<div class="modal fade" id="Openqr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelPengguna">Scan Device</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
				<div class="load-qr text-center p-2"></div>
                <div class="text-center">
					<img src="" id="thumbnail" alt="" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<style>
    .select2-container {
    width: 100% !important;
    padding: 0;
    }
</style>

<script>
	var myVar;	
	search_device();
    function search_device(){
        
        $.ajax({
            type: 'POST',
            url: base_url+'whatsapp/cek_device/',
            beforeSend: function(){
                $('body').loading();
			},
            success: function(html){
                $('#posts_content').html(html);
                $('body').loading('stop');
			}
		});
	}
	
	function scan_qr()
	{
		$.ajax({
			url: base_url + 'whatsapp/cek_status',
			method: 'POST',
			dataType: "json",
			beforeSend: function () {
                $('body').loading();　
			},
			success: function(data) {
				// console.log(data);
				if(data.device_status=='connect'){
					$('#Openqr').modal('hide')  
					search_device();
					myStopFunction();
					}else{
					myVar = setTimeout(function(){ scan_qr() }, 8000);
				}
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
		
	}
	
    $(document).on('click','.scan_qr',function(e){
		
		$.ajax({
			url: base_url + 'whatsapp/scan_qr',
			method: 'POST',
			dataType: "json",
			beforeSend: function () {
                $('body').loading();
				$('.load-qr').html('');　
			},
			success: function(data) {
				console.log(data);
				$('#Openqr').modal({backdrop: 'static', keyboard: false})  
				if(data.status==true){
					$("#thumbnail").attr("src", "data:image/png;base64,"+data.url);
					myVar = setTimeout(function(){ scan_qr() }, 8000);
					}else{
					var detail = data.reason+'<br><button type="button" class="btn btn-danger logout_device">Logout</button>';
					$('.load-qr').html(detail);
					// myVar = setTimeout(function(){ scan_qr() }, 8000);
				}
				$('body').loading('stop');　
				
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	
    $(document).on('click','.logout_device',function(e){
		
		$.ajax({
			url: base_url + 'whatsapp/logout_device',
			method: 'POST',
			dataType: "json",
			beforeSend: function () {
                $('body').loading();　
			},
			success: function(data) {
				// console.log(data);
				if(data.detail=='device disconnected'){
					$('#Openqr').modal('hide')  
					search_device();
				}
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	
    $(document).on('click','.register',function(e){
		window.open('https://md.fonnte.com/new/register.php?ref=57', '_blank');
	});
	
	function myStopFunction() {
		clearTimeout(myVar);
	}
</script>        