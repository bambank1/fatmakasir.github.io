<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Pembayaran</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Metode Pembayaran</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="#" method="post">
				<div class="card">
					<div class="card-header  d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-warning">List Data</h6>
					</div>
					
					<div class="card-body table-responsive">
						<div class="card-block caraBayar">
							
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalBayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Form edit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<input type='hidden' name='id' id='id' value='0'>
				<input type='hidden' name='type' id="type">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="judul">Title</label>
							<input type="text" name="cara_bayar" id="cara_bayar" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="harga">No. Rekening</label>
							<input type="text" name="no_rek" id="no_rek" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="harga">Pemilik</label>
							<input type="text" name="pemilik" id="pemilik" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="slug">Slug</label>
							<input type="text" name="slug" id="slug" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="publish">Aktif</label>
							<select name="publish" id="publish" class="form-control">
								<option value="Y">Ya</option>
								<option value="N">Tidak</option>
								</select>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_data">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		data_pembayaran();
		
	});
	function data_pembayaran(){
		$.ajax({
			url: base_url + "pembayaran/data_pembayaran",
			dataType: 'html',
			success: function(data) {
				$(".caraBayar").html(data);
			}
		});
	}
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// alert(id);
		if(id==0){
            $("#type").val('add');
			}else{
            $("#type").val('edit');
		}
		$('#ModalBayar').modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + 'pembayaran/get_data',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				$("#id").val(data.id_byr);
				$("#cara_bayar").val(data.cara_bayar);
				$("#no_rek").val(data.no_rek);
				$("#pemilik").val(data.pemilik);
				$("#slug").val(data.slug);
				$("#publish").val(data.publish);
			}
		});
	});
	$("#cara_bayar").keyup(function(){
		$("#cara_bayar").removeClass("is-invalid").addClass("is-valid");
	});
	$("#no_rek").keyup(function(){
		$("#no_rek").removeClass("is-invalid").addClass("is-valid");
	});
	$("#pemilik").change(function(){
		$("#pemilik").removeClass("is-invalid").addClass("is-valid");
	});
	$(document).on('click','.save_data',function(e){
		e.preventDefault();
		var id         = $("#id").val();
		var type       = $("#type").val();
		var cara_bayar = $("#cara_bayar").val();
		var no_rek     = angka($("#no_rek").val());
		var pemilik    = $("#pemilik").val();
		var publish    = $("#publish").val();
		var slug    = $("#slug").val();
	
		if(cara_bayar       ==''){
			$("#cara_bayar").addClass('is-invalid');
			$("#cara_bayar").focus();
			// sweet('Peringatan!!!','Nama bahan masih kosong','warning','warning');
			return;
		}
		if(no_rek==''){
			$("#no_rek").addClass('is-invalid');
			$("#no_rek").focus();
			// sweet('Peringatan!!!','Harga bahan masih kosong','warning','warning');
			return;
		}
		if(pemilik==''){
			$("#pemilik").addClass('is-invalid');
			$("#pemilik").focus();
			// sweet('Peringatan!!!','Status masih kosong','warning','warning');
			return;
		}
		
		$.ajax({
			url: base_url + 'pembayaran/save_data',
			data: {id:id,type:type,cara_bayar:cara_bayar,no_rek:no_rek,pemilik:pemilik,publish:publish,slug:slug},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				if(data.status==200){
					data_pembayaran();
					sweet('Sukses!!!',data.msg,'success','success');
					$('#ModalBayar').modal('hide');
					}else{
					sweet('Peringatan!!!','Data gagal disimpan','warning','warning');
				}
			}
		});
	});
</script>