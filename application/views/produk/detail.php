
<input type="hidden" name="kode_invoice" id="kode_invoice" value="<?=$detail['invoice'];?>">
<input type="hidden" name="kode" id="kode" value="<?=$detail['idr'];?>">
<?php
	if($detail['jenis']==9){
		$title_produk = 'Input nama '.$nama_produk;
		$cek_desain = cek_desain($detail['invoice']);
	 
	?>
	<input type="hidden" name="tipe" id="tipe" value="desain">
	<div class="form-group row mb-1">
		<label class="col-sm-4 col-form-label">Nama Designer</label>
		<div class="col-sm-8">
			<div class="input-group">
				<select id='id_desain' name="id_desain" class="form-control">
					<?php foreach($desain AS $val){
						if($val->id_user == $cek_desain){
							echo "<option value='{$val->id_user}' selected>{$val->nama_lengkap}</option>";
							}else{
							echo "<option value='{$val->id_user}'>{$val->nama_lengkap}</option>";
						}
					}
					?>
				</select>
			</div>
		</div>
	</div>
	
	<?php }else{
		$title_produk = $nama_produk;
	?>
	<input type="hidden" name="tipe" id="tipe" value="all">
	<table class="table table-striped table-sm" id="tablefinish">
		<thead>
			<tr>
				<td width="10" class="p-0">
					<button class="btn btn-default btn-sm add_finishing" id="add_finishing" type="button" data-toggle="tooltip" title="Tambah"><i class="fa fa-plus-circle"></i></button>
					<button class="btn btn-default btn-sm delete_finishing" id="delete_finishing" type="button" data-toggle="tooltip" title="Hapus" style="display:none"><i class="fa fa-minus-circle"></i></button>
				</td>
				<td>Title</td>
				<td>Keterangan</td>
			</tr>
		</thead>
		<?php 
			if(!empty($finishing)){
				$na = 0; 
				foreach($finishing->data AS $key=>$val) { 
					if($val->id==0){
						$readonly = 'disabled';
						}else{
						$readonly = '';
					}
				?>
				<tr id='rowCountFinish<?=$na;?>' class="rowCountFinish" >
					<td align="center">
						<input type="hidden" id="id_finish_<?=$val->id;?>" name="id_finish[<?=$na;?>]" value="<?=$val->id;?>" />
						<input type="checkbox" class="case_finish" id="case_finish<?=$na;?>" <?=$readonly;?> >
					</td>
					<td>
						<div class="form-group p-0 m-0">
							<input class="form-control input-sm" type='text' id='title_<?=$na;?>' name="title[<?=$na;?>]" value="<?=$val->title;?>" placeholder="title" />
						</div>
					</td>
					<td>
						<div class="form-group p-0 m-0">
							<input class="form-control input-sm" type='text' id='isi_<?=$na;?>' name="isi[<?=$na;?>]" value="<?=$val->isi;?>" placeholder="keterangan"  />
						</div>
					</td>
				</tr>
			<?php $na++; } }else{ ?>
			<tr id='rowCountFinish<?=$na;?>' class="rowCountFinish" >
				<td align="center">
					<input type="hidden" id="id_finish_0" name="id_finish[0]" value="0" />
					<input type="checkbox" class="case_finish" id="case_finish0" name="case_finish0" disabled >
				</td>
				<td>
					<div class="form-group p-0 m-0">
						<input class="form-control input-sm" type='text' id='title_0' name="title[0]" value="" placeholder="title" required />
					</div>
				</td>
				<td>
					<div class="form-group p-0 m-0">
						<input class="form-control input-sm" type='text' id='isi_0' name="isi[0]" value="" placeholder="keterangan" required />
					</div>
				</td>
			</tr>
		<?php } ?>
		<tfoot>
			<tr>
				<td colspan="3"></td>
			</tr>
		</tfoot>
	</table>
	 
	<script>
		var rowCount = 0;
		$(".add_finishing").on('click', function() {
			i = $('#tablefinish > tbody tr').length;
			count=$('#tablefinish tr').length;	
			// alert(i);
			// i = document.getElementById("baris").value;
			if(i >= 12){
				sweet('Peringatan!!!','Max per trx hanya 12 product','warning','warning');	
				return;
			}
			var cols = '<tbody>';
			cols += '<tr id="rowCountFinish' + i + '" class="rowCountFinish">';
			cols += '<td align="center"><input type="hidden" id="id_finish_'+i+'" name="id_finish['+i+']" value="'+i+'"/><input type="checkbox" class="case_finish" id="case_finish'+i+'" /></td>';
			cols += '<td><div class="form-group p-0 m-0"><input class="form-control input-sm" type="text" name="title['+i+']" id="title_'+i+'" placeholder="title" required/></div></td>';
			cols += '<td><div class="form-group p-0 m-0"><input class="form-control input-sm" type="text" name="isi['+i+']" id="isi_'+i+'" placeholder="keterangan" required /></div></td>';
			cols += '</tr></tbody>';
			$('#tablefinish').append(cols);
			i++;
			$(".delete_finishing").on('click', function() {
				
				x = $("#tablefinish > tbody").children().length;
				for (var aa = 0; aa < x; aa++) {
					if ($('#case_finish' + aa).length) {
						if (document.getElementById("case_finish" + aa.toString()).checked == true) {
							kode_rinci = document.getElementById("id_finish_" + aa.toString()).value;
							hapus_finishing(kode_rinci);
							// console.log(kode_rinci);
							jQuery('#rowCountFinish' + aa.toString()).remove();aa--;
						}
					}
				}
				$(".delete_finishing").hide();
				$(".add_finishing").show();
				$("#tablefinish tr.rowCount input:checkbox").attr("disabled", false);
			});
			
			$('#tablefinish >tbody input[type="checkbox"]').click(function() {
				var rowCount = $("#tablefinish > tbody").children().length;
				var countcheck = $('#tablefinish > tbody input[type="checkbox"]:checked').length;
				if (countcheck == 0) {
					$(".delete_finishing").hide();
					$(".add_finishing").show();
				}
				if (countcheck > 0) {
					$(".delete_finishing").show();
					$(".add_finishing").hide();
					shortcut.add("ctrl+d",function() {
						$(".btn_Delete").click();
					});
				}
				if (countcheck >= rowCount) {
					sweet('Peringatan!!!','Sisain satu baris jangan di hapus semua','warning','warning');
					$(".delete_finishing").css("color", "#000");
					$("#delete_finishing").attr("disabled", true);
					$('input[name=case_finish0]').attr('checked', false);
					} else {
					$(".delete_finishing").css("color", "#ff0000");
					$(".delete_finishing").attr("disabled", false);
					
				}
			});
		});
		
		
		
		$(".delete_finishing").on('click', function() {
			
			b = $("#tablefinish > tbody").children().length;
			for (var aa = 0; aa < b; aa++) {
				if ($('#case_finish' + aa).length) {
					if (document.getElementById("case_finish" + aa.toString()).checked == true) {
						kode_rinci = document.getElementById("id_finish_" + aa.toString()).value;
						hapus_finishing(kode_rinci);
						// console.log(kode_rinci);
						jQuery('#rowCountFinish' + aa.toString()).remove();aa--;
					}
				}
			}
			$(".delete_finishing").hide();
			$(".add_finishing").show();
			$("#tablefinish tr.rowCount input:checkbox").attr("disabled", false);
		});
		
		$('#tablefinish >tbody input[type="checkbox"]').click(function() {
			var rowCount = $("#tablefinish > tbody").children().length;
			var countcheck = $('#tablefinish > tbody input[type="checkbox"]:checked').length;
			if (countcheck == 0) {
				$(".delete_finishing").hide();
				$(".add_finishing").show();
			}
			if (countcheck > 0) {
				$(".delete_finishing").show();
				$(".add_finishing").hide();
				shortcut.add("ctrl+d",function() {
					$(".btn_Delete").click();
				});
			}
			if (countcheck >= rowCount) {
				sweet('Peringatan!!!','Sisain satu baris jangan di hapus semua','warning','warning');
				$(".delete_finishing").css("color", "#000");
				$("#delete_finishing").attr("disabled", true);
				$('input[name=case_finish0]').attr('checked', false);
				} else {
				$(".delete_finishing").css("color", "#ff0000");
				$(".delete_finishing").attr("disabled", false);
				
			}
		});
		
		function hapus_finishing(c) {
			var id = c;
			var kode = $('#kode').val();
			$.ajax({
				type: "POST",
				url: base_url + "produk/hapus_finishing",
				data: { id: id,kode:kode },
				dataType: "json",
				success: function(data) {
					// alert(str);
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
		}
	</script>
<?php } ?>
<script>
	var produk = '<?=$title_produk;?>';
	$('.title-finishing').html(produk);
</script>
