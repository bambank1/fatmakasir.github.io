<style>
	.custom-select {
    display: inline-block;
    width: 100%;
    height: 38px;
     
	}
</style>
	
<div class="input-group mb-3 mt-2">
	<div class="input-group-prepend">
		<label class="input-group-text" >No. Order</label>
	</div>
	<input type="text" class="form-control" id="idorder" value="<?=$posts;?>" readonly>
</div>
<div class="input-group mb-3">
	<div class="input-group-prepend">
		<label class="input-group-text" for="idedit">Status</label>
	</div>
	<select class="custom-select" name="idedit" id="idedit">
		<option value="0" selected>Pilih...</option>
		<?php  
			foreach ($kategori AS $values){
				echo '<option value="'.$values->id.'">'.$values->title.'</option>';
			}
		?>
	</select>
</div>
<div class="input-group mb-3 jml_uang">
	<div class="input-group-prepend">
		<label class="input-group-text" for="jml_uang">Nominal</label>
	</div>
	<input type="text" onkeyup='formatNumber(this)' name="jml_uang" id="jml_uang" class="form-control">
</div>
<div class="input-group mb-3 jml_uang">
	<div id="load_bayar"></div>
</div>
<div class="input-group mb-3">
	<div class="input-group-prepend">
		<label class="input-group-text" for="idkasir">Kasir</label>
	</div>
	<select class="custom-select" id="idkasir">
		<option selected>Pilih kasir...</option>
		<?php  
			foreach ($pilihan AS $values){
				if($this->session->idu==$values['id_user']){
					echo '<option value="'.$values['id_user'].'" selected>'.$values['nama_lengkap'].'</option>';
					}else{
					echo '<option value="'.$values['id_user'].'">'.$values['nama_lengkap'].'</option>';
				}
			}
		?>
	</select>
</div>
<script>
	$(".jml_uang").hide();
	$("#idedit").change(function() {
		var idorder = $("#idorder").val();
		var idedit = $("#idedit").val();
		if(idedit==2){
			$(".jml_uang").show();
			load_bayar(idorder)
			}else{
			$(".jml_uang").hide();
		}
	});
	function load_bayar(a){
		$.ajax({
			'url': base_url + 'load/load_bayar',
			'data': {idorder:a},
			'method': 'POST',
			success: function(data) {
				if(data=='kosong'){
					$(".jml_uang").hide();
					}else{
					$('#load_bayar').html(data);
				}
			}
		});
	}
</script>	