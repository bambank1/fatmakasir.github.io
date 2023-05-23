<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Backup Database</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Backup</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="#" method="post">
				<div class="card">
					<div class="card-header  d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-warning">List File Database </h6>
						<span id="nestable-menu" class="float-right">
							<button type="button" class="btn btn-success btn-sm backup" data-toggle="tooltip" title="Backup DB"><i class="fa fa-database"></i> Klik Untuk Backup</button>
						</span>
					</div>
					<?php 
						$map = directory_map('./backup_db/', FALSE, TRUE); 
					?>
					<div class="card-body table-responsive">
						<div class="card-block">
							<table class="table align-items-center table-flush table-hover" id="dataTableHover">
								<thead>
									<tr>
										<th>Nama Database</th>
										<th>Tgl. Backup</th>
										<th style="width:15%!important">Size</th>
										<th style="width:15%!important">Aksi</th>
										<th style="width:5%!important">Hapus</th>
									</tr>
								</thead>
								
							</table>
						</div><!-- /.card -->
					</div><!-- /.card -->
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>
 
<script>
	$(document).ready(function() {
		$('body').tooltip({selector: '[data-toggle="tooltip"]'});
		var dataTable1 = $('#dataTableHover').DataTable({   
			"ajax":{  
				url:base_url + 'Backupdata/list_data',
				type:"POST"             
			},
			"order": [[ 0, 'desc' ]],
			"columnDefs": [
			{ "targets": [2,3], "orderable": false }
			]
			// dom: 'Bfrtip',
			// buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
			// ]
		});
		
		$(document).on('click', '.backup', function() {
			$.ajax({
				'url': base_url + 'Backupdata/backupdb',
				'method': 'POST',
				'dataType':'json',
				beforeSend: function(){	 
					$('body').loading();
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						sweet('Backup File!!!',data.msg,'success','success');
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					dataTable1.ajax.reload();  
				},
				error: function(xhr, status, error) {
					var err = xhr.responseText ;
					sweet('Server!!!',err,'error','danger');
					$('body').loading('stop');
				}
			})
		});
		$(document).on('click', '.unzipdb', function() {
			var file = $(this).attr('data-file');
			// alert(file);
			$.ajax({
				'url': base_url + 'Backupdata/unzipdb',
				'method': 'POST',
				'data': {file:file},
				'dataType':'json',
				beforeSend: function(){	 
					$('body').loading();
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						sweet('Extract DB!!!',data.msg,'success','success');
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					dataTable1.ajax.reload();  
				},
				error: function(xhr, status, error) {
					var err = xhr.responseText ;
					sweet('Server!!!',err,'error','danger');
					$(".loadings").hide();
				}
			})
		});
		
		$(document).on('click', '.downloaddb', function() {
			var file = $(this).attr('data-file');
			// alert(file);
			$.ajax({
				'url': base_url + 'Backupdata/download_db',
				'method': 'POST',
				'data': {file:file},
				'dataType': 'binary',
				'xhrFields': {
					'responseType': 'blob'
				},
				beforeSend: function(){	 
					$('body').loading();
				},
				success: function(data) {
					var link = document.createElement('a'),
                    filename = file;
					link.href = URL.createObjectURL(data);
					link.download = filename;
					link.click();
					$('body').loading('stop');
				},
				error: function(xhr, status, error) {
					var err = xhr.responseText ;
					sweet('Server!!!',err,'error','danger');
					$('body').loading('stop');
				}
			})
		});
		
		$(document).on('click', '.restoredb', function() {
			var file = $(this).attr('data-file');
			// alert(file);
			$.ajax({
				'url': base_url + 'Backupdata/restoredb',
				'method': 'POST',
				'data': {file:file},
				'dataType':'json',
				beforeSend: function () {
					$('body').loading();
				},
				success: function(data) {
					$(".loadings").hide();
					if(data.status==200){
						sweet('Restore DB!!!',data.msg,'success','success');
						}else{
						sweet('Restore DB!!!',data.msg,'warning','warning');
					}
					// dataTable1.ajax.reload();  
					$('body').loading('stop');
				},
				error: function(xhr, status, error) {
					var err = xhr.responseText ;
					sweet('Server!!!',err,'danger','danger');
					$('body').loading('stop');
				}
			});
		});
		$(document).on('click', '.hapus', function(e) {
			e.preventDefault();
			var file = $(this).attr('data-file');
			$.ajax({
				'url': base_url + 'Backupdata/hapusdb',
				'method': 'POST',
				'data':{file:file},
				'dataType':'json',
				beforeSend: function(){	 
					$('body').loading();
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						sweet('Hapus File!!!',data.msg,'success','success');
						dataTable1.ajax.reload();  
						}else{
						sweet('Hapus File!!!','File gagal dihapus','warning','warning');
					}
				},
				error: function(xhr, status, error) {
					var err = xhr.responseText ;
					sweet('Server!!!',err,'danger','danger');
					$('body').loading('stop');
				}
			})
		});
	});
	
	  
</script>