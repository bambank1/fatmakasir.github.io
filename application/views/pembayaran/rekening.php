<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Rekening Bank / Merchant</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Rekening Bank</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="#" method="post">
				<div class="card">
					<div class="card-header  d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-warning">List Data</h6>
						<button type="button" name="tambah" class="btn btn-success edit_data" data-id="0">Tambah</button>
					</div>
					
					<div class="card-body table-responsive">
						<div class="card-block data-rekening">
							
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
						<div class="form-group-row">
							<label for="nama_bank">Nama Bank/Merchant</label>
							<input type="text" name="nama_bank" id="nama_bank" class="form-control form-control-sm" required>
						</div>
						<div class="form-group-row">
							<label for="inisial">Nama Inisial</label>
							<input type="text" name="inisial" id="inisial" class="form-control form-control-sm" required>
						</div>
						<div class="form-group-row">
							<label for="nomor_rekening">No. Rekening/virtual Account</label>
							<input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control form-control-sm" required>
						</div>
						<div class="form-group-row">
							<label for="pemilik">Pemilik</label>
							<input type="text" name="pemilik" id="pemilik" class="form-control form-control-sm" required>
						</div>
						<div class="form-group-row">
							<label for="publish">Footer Invoice</label>
							<select name="footerin" id="footerin" class="form-control form-control-sm custom-select" required>
								<option value="1">Ya</option>
								<option value="0">Tidak</option>
							</select>
						</div>
						<div class="form-group-row">
							<label for="publish">Aktif</label>
							<select name="publish" id="publish" class="form-control form-control-sm custom-select" required>
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
			url: base_url + "pembayaran/data_rekening",
			dataType: 'html',
			success: function(data) {
				$(".data-rekening").html(data);
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
				$("#id").val(data.id);
				$("#nama_bank").val(data.nama_bank);
				$("#nomor_rekening").val(data.nomor_rekening);
				$("#pemilik").val(data.pemilik);
				$("#inisial").val(data.inisial);
				$("#footerin").val(data.footer_invoice);
				$("#publish").val(data.publish);
			}
		});
	});
	$("#nama_bank").keyup(function(){
		$("#nama_bank").removeClass("is-invalid").addClass("is-valid");
	});
	$("#no_rek").keyup(function(){
		$("#no_rek").removeClass("is-invalid").addClass("is-valid");
	});
	$("#pemilik").change(function(){
		$("#pemilik").removeClass("is-invalid").addClass("is-valid");
	});
	$(document).on('click','.save_data',function(e){
		e.preventDefault();
		var id                 = $("#id").val();
		var type               = $("#type").val();
		var nama_bank         = $("#nama_bank").val();
		var nomor_rekening     = angka($("#nomor_rekening").val());
		var pemilik            = $("#pemilik").val();
		var publish            = $("#publish").val();
		var inisial            = $("#inisial").val();
		var footerin             = $("#footerin").val();
		
		if(nama_bank       ==''){
			$("#nama_bank").addClass('is-invalid');
			$("#nama_bank").focus();
			// sweet('Peringatan!!!','Nama bahan masih kosong','warning','warning');
			return;
		}
		if(inisial==''){
			$("#inisial").addClass('is-invalid');
			$("#inisial").focus();
			// sweet('Peringatan!!!','Status masih kosong','warning','warning');
			return;
		}
		if(nomor_rekening==''){
			$("#nomor_rekening").addClass('is-invalid');
			$("#nomor_rekening").focus();
			// sweet('Peringatan!!!','Harga bahan masih kosong','warning','warning');
			return;
		}
		if(pemilik==''){
			$("#pemilik").addClass('is-invalid');
			$("#pemilik").focus();
			// sweet('Peringatan!!!','Status masih kosong','warning','warning');
			return;
		}
		
		if(footerin=='' || footerin==null){
			$("#footerin").addClass('is-invalid');
			$("#footerin").focus();
			// sweet('Peringatan!!!','Status masih kosong','warning','warning');
			return;
		}
		if(publish=='' || publish==null){
			$("#publish").addClass('is-invalid');
			$("#publish").focus();
			// sweet('Peringatan!!!','Status masih kosong','warning','warning');
			return;
		}
		
		$.ajax({
			url: base_url + 'pembayaran/save_data',
			data: {id:id,type:type,cara_bayar:nama_bank,nomor:nomor_rekening,pemilik:pemilik,publish:publish,inisial:inisial,footerin:footerin},
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