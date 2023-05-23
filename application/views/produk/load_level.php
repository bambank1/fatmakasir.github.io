<style>
	.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;}
	.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
	.tbl-qa .table-row td {background-color: #bfcfffn;}
	.ajax-action-links {color: #09F; margin: 10px 0px;cursor:pointer;}
	.ajax-action-button {border:#094 1px solid;color: #09F; margin: 10px 0px;cursor:pointer;display: inline-block;padding: 10px 20px;}
	.edited td {padding:5px!important;background:#f7f7f7}
</style>

<div class="table-wrapper">
	
	<table class="table table-bordered tbl-qa" id="table_level">
		<thead>
			<tr>
				<th>No.</th>
				<th>Satuan</th>
				<th>Level</th>
				<th>Harga Jual</th>
				<th> <button class="btn btn-info btn-sm" id="add-level" onClick="createNew();"><i class="fa fa-plus"></i> Tambah</button></th>
			</tr>
		</thead>
		<tbody id="table-level">
			<?php 
				$a = 0;
				$no = 1;
				foreach($result AS $row) {
					$id=$row->id; 
					$satuan=$row->id_satuan; 
					$id_member=$row->id_member; 
					$harga_jual=$row->harga_jual; 
				?>
				<tr class="table-row" id="table-level-<?php echo $id; ?>" data-id="<?php echo $satuan; ?>" data-member="<?php echo $id_member; ?>" data-row="<?php echo $a; ?>">
					<td><?=$no;?></td>
					<td onChange="getData(<?=$a;?>,<?=$id;?>)" >
						<select name="satuan_level_edit" id="satuan_level_<?=$a;?>" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required>
						</select>
					</td>
					<td onChange="getLevel(<?=$a;?>,<?=$id;?>)" >
						<select name="load_level_edit" id="load_level_<?=$a;?>" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required>
						</select>
					</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,'harga_jual','<?php echo $id; ?>')" onClick="editRow(this);"><?php echo $harga_jual; ?></td>
					<td><button class="btn btn-danger btn-sm" onclick="deleteRecord(<?php echo $id; ?>);"><i class="fa fa-remove"></i> Hapus</button></td>
				</tr>
			<?php $a++;$no++;} ?>     
		</tbody>
	</table>
	
	<input type="hidden" id="id_bahan" value="<?=$id_bahan;?>">
</div>

<script type="text/javascript">
	
	function createNew() {
		$("#add-level").hide();
		no = $('#table_level > tbody tr').length+1;
		i = $('#table_level > tbody tr').length;
		var data = '<tr class="table-row" id="new_row_level">' +
		'<td>'+no+'</td><td><select name="load_satuan_add" id="satuan_level_'+i+'" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required></select></td><td><select name="load_level_add" id="load_level_'+i+'" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required></select></td>' +
		'<td contenteditable="true" id="txt_harga_jual" onBlur="addToHiddenField(this,\'harga_jual_'+i+'\')" onClick="editRow(this);"></td>' +
		'<td><input type="hidden" id="id_satuan" /><input type="hidden" id="harga_jual_'+i+'" /><span id="confirmAdd"><button onClick="addToDatabase('+i+')" class="btn btn-success btn-sm">Simpan</button>  <button onclick="cancelAdd();" class="btn btn-danger btn-sm">Batal</button></span></td>' +	
		'</tr>';
		$("#table-level").append(data);
		satuan_load(i,0)
		level_load(i,0)
	}
	
	function cancelAdd() {
		$("#add-level").show();
		$("#new_row_level").remove();
	}
	function editRow(editableObj) {
		$(editableObj).css("background","#FFF");
	}
	
	function addToDatabase(i) {
		var satuan = $("#satuan_level_"+i).val();
		var level = $("#load_level_"+i).val();
		var harga = $("#harga_jual_"+i).val();
		var id_bahan = $("#id_bahan").val();
		// $("#confirmAdd").html('<img src="'+base_url+'assets/img/ajax-loader.gif" />');
		$.ajax({
			url: base_url+"produk/add_harga_level",
			type: "POST",
			data:{id:id_bahan,level:level,satuan:satuan,harga:harga,no:i},
			beforeSend: function () {
				$("body").loading({zIndex:1060});
			},
			success: function(data){
				$("#new_row_level").remove();
				$("#add-level").show();		  
				$("#table-level").append(data);
				satuan_load(i,satuan);
				level_load(i,level)
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('body').loading('stop');
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	function addToHiddenField(addColumn,hiddenField) {
		var columnValue = $(addColumn).text();
		$("#"+hiddenField).val(columnValue);
	}
	function getData(a,id) {
		// console.log(id);
		var id_satuan = $("#satuan_level_"+a).val();
		saveToDatabase(id_satuan,'id_satuan',id)
	}
	function getLevel(a,id) {
		// console.log(id);
		var id_member = $("#load_level_"+a).val();
		saveToDatabase(id_member,'id_member',id)
	}
	function saveToDatabase(editableObj,column,id) {
		$(editableObj).css("background","#FFF url("+base_url+"assets/img/ajax-loader.gif) no-repeat right");
		if($.isNumeric(editableObj)){
			var editval = editableObj;
			}else{
			var editval = $(editableObj).text();
		}
		$.ajax({
			url: base_url+"produk/edit_harga_level",
			type: "POST",
			data:'column='+column+'&editval='+editval+'&id='+id,
			beforeSend: function () {
				$("body").loading({zIndex:1060});
			},
			success: function(data){
				if(!$.isNumeric(editableObj)){
					$(editableObj).css("background","#F5F5F5");
				}
				$("body").loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('body').loading('stop');
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	function deleteRecord(id) {
		if(confirm("Are you sure you want to delete this row?")) {
			$.ajax({
				url: base_url+"produk/delete_harga_level",
				type: "POST",
				data:'id='+id,
				beforeSend: function () {
				$("body").loading({zIndex:1060});
			},
			success: function(data){
				$("#table-level-"+id).remove();
				$("body").loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('body').loading('stop');
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
			});
		}
	}
	
	document.querySelectorAll('#table_level > tbody tr').forEach(trObj => {
		var tableValue = trObj.id;
		
		var result = tableValue.split('-');
		var baris = 	$('#'+tableValue).attr('data-row');
		var idsatuan = 	$('#'+tableValue).attr('data-id');
		var member = 	$('#'+tableValue).attr('data-member');
		satuan_load(baris,idsatuan);
		level_load(baris,member);
		// console.log(idsatuan)
		
	});
	
	function level_load(tipe,member){
		
		$.ajax({
			url: base_url + "produk/load_member",
			type: 'POST',
			data: {id:member},
			dataType: 'json',
			beforeSend: function () {
				$("#load_level_"+tipe).append("<option value='loading'>loading</option>");
				$("#load_level_"+tipe).empty();
			},
			success: function (response) {
				// $("#jenis_lembaga_"+jenis+" option[value='loading']").remove();
				$("#load_level_"+tipe).append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					if(id==member){
						$("#load_level_"+tipe).append("<option value='" + id + "' selected>" + name + "</option>");
						}else{
						$("#load_level_"+tipe).append("<option value='" + id + "'>" + name + "</option>");
					}
					
				}
				
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	
	function satuan_load(tipe,idjenis){
		
		$.ajax({
			url: base_url + "produk/load_satuan_range",
			type: 'POST',
			data: {id:idjenis},
			dataType: 'json',
			beforeSend: function () {
				$("#satuan_level_"+tipe).append("<option value='loading'>loading</option>");
				$("#satuan_level_"+tipe).empty();
			},
			success: function (response) {
				// $("#jenis_lembaga_"+jenis+" option[value='loading']").remove();
				$("#satuan_level_"+tipe).append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					if(id==idjenis){
						$("#satuan_level_"+tipe).append("<option value='" + id + "' selected>" + name + "</option>");
						}else{
						$("#satuan_level_"+tipe).append("<option value='" + id + "'>" + name + "</option>");
					}
					
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
</script>

