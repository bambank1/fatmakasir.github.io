<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Template Pesan</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Template Pesan</li>
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
						<div class="card-block data-template">
							
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalTemplate" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Form edit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-template" method="post">
					<input type='hidden' name='id' id='id_template' value='0'>
					<input type='hidden' name='type' id="type_template">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group-row">
								<label for="title">Title</label>
								<input type="text" name="title" id="title_template" class="form-control form-control-sm" required>
							</div>
							<div class="form-group-row">
								<label for="inisial">Deskripsi</label>
								<textarea class="form-control form-control-sm fcs" rows="8" id="deskripsi_template" name="deskripsi" required></textarea>
								
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
				</form>
			</div>
			<div class="modal-footer">
				<a href="javascript:void(0);"  data-toggle="modal" data-target="#template-shortcut"  class="btn btn-info btn-sm mr-auto flat" data-url="transaksi" data-toggle="tooltip" data-original-title="Shortcut" data-placement="top">
					<span class="icon text-white-50">
						<i class="fa fa-info-circle fa-fw fa-lg"></i>
					</span>	
				</a>
				<button type="button" name="submit" class="btn btn-info save_data">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="template-shortcut" tabindex="-1"
aria-labelledby="modal-shortcut" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title">SHORT TAG</h5>
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-body">
				<ul class="pl-3">
					<li><small>{selamat} : SELAMAT PAGI | SIANG | SORE | MALAM</small></li>
					<li><small>{invoice} : NOMOR ORDER</small></li>
					<li><small>{tgl} : TANGGAL ORDER</small></li>
					<li><small>{fo} : KASIR PENERIMA ORDER</small></li>
					<li><small>{hp} : NO HP KANTOR</small></li>
					<li><small>{token} : TOKEN E-INVOICE</small></li>
					<li><small>{total} : TOTAL ORDER</small></li>
					<li><small>{bayar} : TOTAL BAYAR</small></li>
					<li><small>{piutang} : TOTAL PIUTANG</small></li>
				</ul>
			</div>
			
		</div>
	</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="confirm-delete" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<p>Anda akan menghapus satu url, prosedur ini tidak dapat diubah.</p>
				<p>Apakah Anda ingin melanjutkan?</p>
				<p class="debug-url"></p>
				<input type="hidden" id="data-hapusid">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		data_template();
		
	});
	function data_template(){
		$.ajax({
			url: base_url + "whatsapp/data_template",
			dataType: 'html',
			success: function(data) {
				$(".data-template").html(data);
			}
		});
	}
	
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// alert(id);
		if(id==0){
            $("#type_template").val('add');
			}else{
            $("#type_template").val('edit');
		}
		$('#ModalTemplate').modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: base_url + 'whatsapp/get_template',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				$("#id_template").val(data.id);
				$("#title_template").val(data.title);
				$("#publish").val(data.publish);
				$("#deskripsi_template").val(decodeURI(data.deskripsi));
			}
		});
	});
	
	$(document).on('click','.save_data',function(e){
		e.preventDefault();
		var dataform = $("#form-template").serialize();
		
		$.ajax({
			url: base_url + 'whatsapp/save_template',
			data: dataform,
			method: 'POST',
			dataType:'json',
			success: function(data) {
				if(data.status==true){
					data_template();
					sweet('Sukses!!!',data.msg,'success','success');
					$('#ModalTemplate').modal('hide');
					}else{
					sweet('Peringatan!!!','Data gagal disimpan','warning','warning');
				}
			}
		});
	});
	
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$('#data-hapusid').val($(e.relatedTarget).data('id'));
	});
	
	$(document).on('click','.hapus',function(e){
		e.preventDefault();
		var id = $("#data-hapusid").val();
		$.ajax({
			url: base_url + 'whatsapp/save_template',
			method: 'POST',
			dataType:'json',
			data:{id:id,type:"hapus"},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				if(data.status==200){
					$('#confirm-delete').modal('hide');
					sweet_time(500,'Status!!!',data.msg);
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				data_template();
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
</script>