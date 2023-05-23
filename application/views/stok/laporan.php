<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?=$judul;?></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$judul;?></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="#" method="post">
				<div class="card">
					<div class="card-header pb-0">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text" for"limits">LIMIT</span>
							</div>
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Stok()">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Stok()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Stok();"/>
							<div class="input-group-append">
								<button class="btn btn-danger clears" type="button"><i class="fa fa-times"></i> Clear</button>
								<button type="button" class="btn btn-info add_bahan" data-id="0"><i class="fa fa-plus"></i> Buat Laporan</button>
								<button class="btn btn-primary url_doc" data-url="bahan" type="button" data-toggle="tooltip" data-original-title="Dok Bahan Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					
					<div class="card-body table-responsive" id="dataStok">
						<div class="card-block">
							<table class="table table-striped table-mailcard" >
								<thead>
									<tr>
										<th class="w-1 text-center">No</th>
										<th class="w-10">Title</th>
										<th class="w-10 text-right">Tanggal</th>
										<th class="w-8 text-right">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($result)){
										$no = 1;
										$total = 0;
										foreach ($result as $row){
											echo "<tr><td class='text-center'>$no</td>
											<td class=''>".$row->title."</td>
											<td class='text-right'>".$row->tanggal."</td>
											<td class='text-right'>
											<div class='btn-group btn-group-sm' role='group'>
											<a href='".base_url('stok/history/').encrypt_url($row->id)."/?type=pdf' class='btn btn-info btn-sm detail_history' data-id='".$row->id."'><i class='fa fa-search'></i> Detail</a>
											</div>
											</td>
											</tr>";
											$no++;
										} }else{ ?>
										<tr>
											<td colspan="7">Data belum ada</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<nav aria-label="Page navigation" class="mt-2">
								<?php 
									echo $this->ajax_pagination->create_links(); 
								?>
							</nav>
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>
<div id="ModalHistory" class="modal left fade" role="dialog">
    <div class="modal-dialog" id="load-save-bahan">
        <div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
				<input type="hidden" name="type" id="type" class="form-control" required>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" name="title" id="title" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="title">Tanggal</label>
							<input type="text" id="tanggal" value="<?=$tgl;?>" class="form-control date-order"placeholder="dd/mm/yyyy"/>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_laporan">Simpan [ctrl+s]</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="halaman" id="halaman" value="0">
<script>
	var date2 = new Date();
	$('.date-order').datepicker({        
        format: 'dd/mm/yyyy', 
		"endDate": date2,
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
	});  
	$('.clears').on('click', function(){
		$('#keywords').val('');
		search_Stok();
	});
	
	
	function search_Stok(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("stok/carilaporan/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('#dataStok').loading();
			},
			success: function(html){
				$('#dataStok').html(html);
				$('#halaman').val(page_num);
				$('#dataStok').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#dataStok').loading('stop');
			}
		});
	}
	$(document).ready(function() {
		$('input').click(function() {
			this.select();
		});
	});
	
	shortcut.add("ctrl+s",function() {
		$(".save_laporan").click();
	});
	function clearform(){
		$("#title").val("");
		
	}
	
	$('#ModalHistory').on('shown.bs.modal', function() {
		$('#title').focus();
	})
	$(function(){
		$(document).fcs(".form-control");
	});
	
	
	$(document).on('click','.add_bahan',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('.form-control').addClass('form-control-sm');
		$('.form-group').css('margin-bottom','5px');
		clearform();
		$('#ModalHistory').modal('show');
		if(id==0){
            $("#type").val('add');
			return
			}else{
            $("#type").val('edit');
		}
		
	});
	
	$("#title").keyup(function(){
		$("#harga_beli").removeClass("is-invalid").addClass("is-valid");
	});
	
	$(document).on('click','.save_laporan',function(e){
		e.preventDefault();
		var type = $("#type").val();
		var title = $("#title").val();
		var tanggal = $("#tanggal").val();
		
		var halaman = $("#halaman").val();
		if(title==''){
			$("#title").addClass('is-invalid');
			$("#title").focus();
			return;
		}
		
		$.ajax({
			url: base_url + 'stok/save_laporan',
			data: {type:type,title:title,tanggal:tanggal},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('#load-save-bahan').loading({zIndex:1060,theme:'dark'});
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right','Hapus data',data.msg,'success');
					$('#ModalHistory').modal('hide');
					}else{
					sweet('Peringatan!!!','Data gagal disimpan','warning','warning');
				}
				$('#confirm-delete').modal('hide');
				search_Stok(halaman);
				$('#load-save-bahan').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#load-save-bahan').loading('stop');
			}
		});
	});
	
</script>
<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>