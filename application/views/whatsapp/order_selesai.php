<form id="form-wa" method="post">
	
	<div class="form-group mb-1">
		<label for="device">Device</label>
		<input type="text" class="form-control form-control-sm fcs" id="device" name="device" value="<?=$device;?>" readonly required>
	</div>
	
	<div class="form-group mb-1">
		<label for="nomor_tujuan">Nomor Tujuan</label>
		<input type="text" class="form-control form-control-sm fcs" id="nomor_tujuan" name="nomor_tujuan" value="<?=$nomor;?>" readonly required>
	</div>
	<div class="form-group mb-1">
		<label for="nomor_order">Nomor Order</label>
		<input type="hidden" class="form-control" id="id" name="id" value="<?=$id;?>">
		<input type="hidden" class="form-control" id="device_status" name="device_status" value="<?=$device_status;?>">
		<input type="hidden" class="form-control" id="tgl_order" name="tgl_order" value="<?=$tgl;?>">
		<input type="hidden" class="form-control" id="user" name="user" value="<?=$user;?>">
		<input type="text" class="form-control form-control-sm fcs" id="nomor_order" name="nomor_order" value="<?=$id_invoice;?>" readonly required>
	</div>
	<div class="form-group mb-1">
		<label for="jenis_pesan">Jenis Pesan</label>
		<select name="jenis_pesan" id="jenis_pesan" class="form-control custom-select" required>
			<option value="" selected>Pilih Jenis Pesan</option>
			<?php if(ip_in_range()==true){ ?>
				<option value="1">Link Invoice</option>
				<option value="2">Text</option>
				<?php }else{ ?>
				<option value="2">Text</option>
			<?php } ?>
		</select>
		
	</div>
	<div class="form-group mb-1">
		<label for="isi_pesan">Pesan</label>
		<textarea class="form-control form-control-sm fcs" rows="8" id="isi_pesan" name="isi_pesan" required></textarea>
	</div>
</form>		
<script>
	
	$("#jenis_pesan").on("change", function() {
		var id = $(this).val();
		var idorder = $('#id').val();
		var nomor_order = $('#nomor_order').val();
		var tgl = $('#tgl_order').val();
		var user = $('#user').val();
		$.ajax({
			url: base_url + 'whatsapp/get_pesan',
			data: {status:id,idorder:idorder,nomor_order:nomor_order,tgl:tgl,user:user},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$("#isi_pesan").val(decodeURIComponent(data.msg));
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