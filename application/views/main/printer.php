<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Pengaturan printer</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Pengaturan printer</li>
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
						<div class="card-block dataPrinter">
							
						</div><!-- /.card-body -->
						<code>Catatan : A5 Landscape Max item 12/page | A4 Potrait Max item 33/page invoice</code>
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
				<h5 class="modal-title" id="exampleModalScrollableTitle">Jenis printer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<input type='hidden' name='print_id' id='print_id' value='0'>
				<input type='hidden' name='type' id="type">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="jenis">Jenis printer</label>
							<input type="text" name="jenis" id="jenis" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="shared">Shared name</label>
							<input type="text" name="shared" id="shared" class="form-control" required>
						</div>
						<label>Ukuran Kertas </label>
						<div class="form-group d-flex flex-row">
							<select name="ukuran" id="ukuran" class="form-control custom-select" required>
								<option value="">Pilih</option>
								<option value="A5">A5</option>
								<option value="A4">A4</option>
								<option value="58">58 mm</option>
								<option value="85">85 mm</option>
							</select>
						</div>	
						<div class="form-group">
							<label for="font_size">Ukuran Font</label>
							<input type="number" name="font_size" id="font_size" class="form-control" min="7" required>
						</div>
						<label>Posisi Kertas </label>
						<div class="form-group d-flex flex-row">
							<select name="posisi" id="posisi" class="form-control custom-select" required>
								<option value="">Pilih</option>
								<option value="potrait">Potrait</option>
								<option value="landscape">Landscape</option>
							</select>
						</div>	
						<div class="form-group">
							<label for="item">Max Item</label>
							<input type="text" name="item" id="item" class="form-control" required>
						</div>
						<label>Aktif </label>
						<div class="form-group d-flex flex-row">
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
		printer();
	});
	function printer(){
		$.ajax({
			url: base_url + "main/data_printer",
			dataType: 'html',
			success: function(data) {
				$(".dataPrinter").html(data);
			}
		});
	}
	
	
	$("#jenis").keyup(function(){
		$("#jenis").removeClass("is-invalid").addClass("is-valid");
	});
	$("#shared").keyup(function(){
		$("#shared").removeClass("is-invalid").addClass("is-valid");
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
			url: base_url + 'main/edit_printer',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				$("#print_id").val(data.id);
				$("#jenis").val(data.jenis);
				$("#shared").val(data.shared);
				$("#ukuran").val(data.ukuran);
				$("#font_size").val(data.font_size);
				$("#posisi").val(data.posisi);
				$("#item").val(data.item);
				$("#aktif").val(data.aktif);
			}
		});
	});
	
	$(document).on('click','.save_printer',function(e){
		e.preventDefault();
		var id = $("#print_id").val();
		var type = $("#type").val();
		var judul = $("#jenis").val();
		var shared = $("#shared").val();
		var ukuran = $("#ukuran").val();
		var font_size = $("#font_size").val();
		var posisi = $("#posisi").val();
		var item = $("#item").val();
		var aktif = $("#aktif").val();
		if(judul==''){
			$("#jenis").addClass('is-invalid');
			$("#jenis").focus();
			// sweet('Peringatan!!!','Nama bahan masih kosong','warning','warning');
			return;
		}
		if(shared==''){
			$("#shared").addClass('is-invalid');
			$("#shared").focus();
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
			url: base_url + 'main/save_printer',
			data: {id:id,type:type,judul:judul,shared:shared,ukuran:ukuran,font_size:font_size,posisi:posisi,item:item,aktif:aktif},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				if(data.status==200){
					printer();
					sweet('Sukses!!!',data.msg,'success','success');
					$('#ModalPrinter').modal('hide');
					}else{
					sweet('Peringatan!!!','Data gagal disimpan','warning','warning');
				}
			}
		});
	});
	
	
</script>