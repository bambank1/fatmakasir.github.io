<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">History Login</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">History Login</li>
		</ol>
	</div>
	<div class="card">
		<div class="row">
			<div class="col-md-12">
				<div class="card-header pb-2">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
						</div>
						<select id="sortBy" class="form-control custom-select w-5" onchange="searchFilterHistory()">
							<option value="ASC">ASC</option>
							<option value="DESC" selected>DESC</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control custom-select" onchange="searchFilterHistory()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
						</select>
						<input type="text" id="keywords" class="form-control" placeholder="Cari data" onkeyup="searchFilterHistory();"/>
						<button type="button" data-toggle="tooltip"  class="btn btn-danger btn-sm clear" id="clear" data-original-title="Clear"><i class="fa fa-times fa-1x"></i> Clear</button>
						<button type="button" class="btn btn-warning btn-sm resethistory" data-toggle="tooltip" title="Reset History"><i class="fa fa-refresh"></i> Reset</button>
					</div>
				</div>
				<div class="post-list pt-0" id="dataListHistory">
					<div class="table-responsive-sm">
						<div class="card-block">
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th style="width:1% !important;">No.</th>
										<th>IP</th>
										<th>Browser</th>
										<th>OS</th>
										<th>Create Date</th>
										<th>Update Date</th>
										<th style="width:1%;">Counter</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($posts)){
										$no=1;
										foreach($posts as $row){ 
										?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?=$row["ip"];?></td>
											<td><?=kata($row["browser"],12);?></td>
											<td><?=$row["os"];?></td>
											<td><?=date_time($row["create_date"]);?></td>
											<td><?=date_time($row["update_date"]);?></td>
											<td align="center"><?=$row["counter"];?></td>
										</tr>
									<?php $no++;} }else{ ?>
									<tr>
										<td colspan="10">Data belum ada</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div><!-- /.card-body -->
						<nav aria-label="Page navigation" class="p-2">
							<?php 
								echo $this->ajax_pagination->create_links(); 
							?>
						</nav>
					</div><!-- /.card-body -->
					<!-- Display posts list -->
					
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function searchFilterHistory(page_num){
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limits = $('#limits').val();
        var urlnya = base_url+'history/ajaxHistory/'+page_num
        $.ajax({
            type: 'POST',
            url: urlnya,
            data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
            beforeSend: function(){
                $('body').loading();
			},
            success: function(html){
                $('#dataListHistory').html(html);
                $('body').loading('stop');
			}, 
			error: function (xhr, ajaxOptions, thrownError) {
				$('body').loading('stop');
				var jsonResponse = JSON.parse(xhr.responseText);
				if(jsonResponse.status==401){
					swalredir(base_url,jsonResponse.msg)
					}else{
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			}
		});
	}
	$(document).on('click', '.clear', function() {
		$("#keywords").val('');
		searchFilterHistory();
	});
	
	$(document).on('click', '.resethistory', function() {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})
		
		swalWithBootstrapButtons.fire({
			title: 'Anda yakin?',
			text: "Data akan di reset!",
			icon: 'error',
			showCancelButton: true,
			confirmButtonText: 'Ya Reset!',
			cancelButtonText: 'Batal!',
			reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: base_url+"history/resethistory/",
					data: {'type' : 'reset'},
					cache : false,
					dataType:'json',
					beforeSend: function (xhr) {
						// $("#load").show();
					},
					success: function(data){
						if(data.status==200){
							swalWithBootstrapButtons.fire(
							'Reset!',
							data.msg,
							'success'
							)
							}else{
							swalWithBootstrapButtons.fire(
							'Reset!',
							data.msg,
							'error'
							)
						}
						searchFilterHistory();
						} ,error: function(xhr, status, error) {
						swalWithBootstrapButtons.fire(
						'Batal',
						'Database masih aman :)',
						'error'
						)
					},
				});
				// swalWithBootstrapButtons.fire(
				// 'Deleted!',
				// 'Your file has been deleted.',
				// 'success'
				// )
			} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire(
				'Cancelled',
				'Data gagal dihapus',
				'error'
				)
			}
		})
	});
</script>	