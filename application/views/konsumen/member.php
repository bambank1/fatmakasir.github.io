<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
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
					<div class="card-header  d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-warning">List Data</h6>
					</div>
					
					<?php echo $this->session->flashdata('message'); ?>
					<div class="card-body table-responsive">
						<div class="card-block dataMember">
							
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalPrinter" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Jenis member</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<input type='hidden' name='member_id' id='member_id' value='0'>
				<input type='hidden' name='type' id="type">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" name="title" id="title" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Aktif </label>
							<select name="aktif" id="aktif" class="form-control custom-select" required>
								<option value="">Pilih</option>
								<option value="1">Ya</option>
								<option value="0">Tidak</option>
							</select>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_printer">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		member();
	});
	function member(){
		$.ajax({
			url: base_url + "konsumen/data_member",
			dataType: 'html',
			beforeSend: function () {
				$('body').loading();
			},
			success: function(data) {
				$(".dataMember").html(data);
				$('body').loading('stop');
				} ,error: function(xhr, status, error) {
                showNotif('bottom-right','Load data',error,'error');
                $('body').loading('stop');
			}
		});
	}
	
	
	$("#title").keyup(function(){
		$("#title").removeClass("is-invalid").addClass("is-valid");
	});
	$("#diskon").keyup(function(){
		$("#diskon").removeClass("is-invalid").addClass("is-valid");
	});
	$("#aktif").change(function(){
		$("#aktif").removeClass("is-invalid").addClass("is-valid");
	});
	
	$(document).on('click','.edit_printer',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// alert(id);
		if(id==0){
            $("#type").val('add');
			}else{
            $("#type").val('edit');
		}
		$('#ModalPrinter').modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + 'konsumen/edit_member',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
				$('body').loading();
			},
			success: function(data) {
				$("#member_id").val(data.id);
				$("#title").val(data.title);
				$("#diskon").val(data.diskon);
				$("#aktif").val(data.aktif);
				$('body').loading('stop');
				} ,error: function(xhr, status, error) {
                showNotif('bottom-right','Load data',error,'error');
                $('body').loading('stop');
			}
		});
	});
	
	$(document).on('click','.save_printer',function(e){
		e.preventDefault();
		var id = $("#member_id").val();
		var type = $("#type").val();
		var title = $("#title").val();
		var diskon = $("#diskon").val();
		var aktif = $("#aktif").val();
		if(title==''){
			$("#title").addClass('is-invalid');
			$("#title").focus();
			// sweet('Peringatan!!!','Nama bahan masih kosong','warning','warning');
			return;
		}
		if(diskon==''){
			$("#diskon").addClass('is-invalid');
			$("#diskon").focus();
			// sweet('Peringatan!!!','Harga bahan masih kosong','warning','warning');
			return;
		}
		if(aktif==''){
			$("#aktif").addClass('is-invalid');
			$("#aktif").focus();
			// sweet('Peringatan!!!','Status masih kosong','warning','warning');
			return;
		}
		$.ajax({
			url: base_url + 'konsumen/save_member',
			data: {id:id,type:type,title:title,diskon:diskon,aktif:aktif},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
				$('body').loading();
			},
			success: function(data) {
				if(data.status==200){
					member();
					sweet('Sukses!!!',data.msg,'success','success');
					$('#ModalPrinter').modal('hide');
					}else{
					sweet('Peringatan!!!','Data gagal disimpan','warning','warning');
				}
				$('body').loading('stop');
				} ,error: function(xhr, status, error) {
                showNotif('bottom-right','Simpan data',error,'error');
                $('body').loading('stop');
			}
		});
	});
	
	
</script>