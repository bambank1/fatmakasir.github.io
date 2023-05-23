<style>
	.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;}
	.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
	.tbl-qa .table-row td {background-color: #bfcfffn;}
	.ajax-action-links {color: #09F; margin: 10px 0px;cursor:pointer;}
	.ajax-action-button {border:#094 1px solid;color: #09F; margin: 10px 0px;cursor:pointer;display: inline-block;padding: 10px 20px;}
	.edited td {padding:5px!important;background:#f7f7f7}
</style>

<div class="table-wrapper">
	
	<table class="table table-bordered tbl-qa" id="table_range_level">
		<thead>
			<tr>
				<th>No.</th>
				<th>Satuan</th>
				<th>Level</th>
				<th>Jml. Min</th>
				<th>Jml. Max</th>
				<th>Harga Jual</th>
				<th> <button class="btn btn-info btn-sm" id="add-range" onClick="createNew();"><i class="fa fa-plus"></i> Tambah</button></th>
			</tr>
		</thead>
		<tbody id="table-body-level">
			<?php 
				$a = 0;
				$no = 1;
				foreach($result AS $row) {
					$id=$row->id; 
					$satuan=$row->id_satuan; 
					$id_member=$row->id_member; 
					$jumlah_minimal=$row->jumlah_minimal; 
					$jumlah_maksimal=$row->jumlah_maksimal; 
					$harga_jual=$row->harga_jual; 
				?>
				 
				<tr class="table-row" id="table-row-level-<?php echo $id; ?>" data-satuan="<?php echo $satuan; ?>" data-member-range="<?php echo $id_member; ?>" data-row-range="<?php echo $a; ?>">
					<td><?=$no;?></td>
					<td onChange="getData(<?=$a;?>,<?=$id;?>)" >
						<select name="load_satuan_range_edit" id="load_satuan_range_level_<?=$a;?>" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required>
						</select>
					</td>
					<td onChange="getLevel(<?=$a;?>,<?=$id;?>)" >
						<select name="load_level_edit" id="load_level_range_<?=$a;?>" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required>
						</select>
					</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,'jumlah_minimal','<?php echo $id; ?>')" onClick="editRow(this);"><?php echo $jumlah_minimal; ?></td>
					<td contenteditable="true" onBlur="saveToDatabase(this,'jumlah_maksimal','<?php echo $id; ?>')" onClick="editRow(this);"><?php echo $jumlah_maksimal; ?></td>
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
		$("#add-range").hide();
		i = $('#table_range_level > tbody tr').length+1;
		var data = '<tr class="table-row" id="new_row_range">' +
		'<td>'+i+'</td><td><select name="load_satuan_range_add" id="load_satuan_range_level_add" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required></select></td><td><select name="load_level_add" id="load_level_range_'+i+'" class="form-control form-control-sm" data-valueKey="id" data-displayKey="name" required></select></td>' +
		'<td contenteditable="true" id="txt_jumlah_minimal" onBlur="addToHiddenField(this,\'jumlah_minimal\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="txt_jumlah_maksimal" onBlur="addToHiddenField(this,\'jumlah_maksimal\')" onClick="editRow(this);"></td>' +
		'<td contenteditable="true" id="txt_harga_jual" onBlur="addToHiddenField(this,\'harga_jual\')" onClick="editRow(this);"></td>' +
		'<td><input type="hidden" id="id_satuan" /><input type="hidden" id="jumlah_minimal" /><input type="hidden" id="jumlah_maksimal" /><input type="hidden" id="harga_jual" /><span id="confirmAdd"><button onClick="addToDatabase('+i+')" class="btn btn-success btn-sm">Simpan</button>  <button onclick="cancelAdd();" class="btn btn-danger btn-sm">Batal</button></span></td>' +	
		'</tr>';
		$("#table-body-level").append(data);
		satuan_range('add',0)
		load_level_range(i,0)
	}
	function saveData(a) {
		console.log(a)
	}
	function cancelAdd() {
		$("#add-range").show();
		$("#new_row_range").remove();
	}
	function editRow(editableObj) {
		$(editableObj).css("background","#FFF");
	}
	
	function addToDatabase(i) {
		var satuan = $("#load_satuan_range_level_add").val();
		var level = $("#load_level_range_"+i).val();
		var minimal = $("#jumlah_minimal").val();
		var maksimal = $("#jumlah_maksimal").val();
		var harga = $("#harga_jual").val();
		var id_bahan = $("#id_bahan").val();
		$("#confirmAdd").html('<img src="'+base_url+'assets/img/ajax-loader.gif" />');
		$.ajax({
			url: base_url+"produk/add_harga_range_level",
			type: "POST",
			data:{id:id_bahan,satuan:satuan,level:level,minimal:minimal,maksimal:maksimal,harga:harga,no:i},
			success: function(data){
				$("#new_row_range").remove();
				$("#add-range").show();		  
				$("#table-body-level").append(data);
				satuan_range(i,satuan);
				load_level_range(i,level)
			}
		});
	}
	function addToHiddenField(addColumn,hiddenField) {
		var columnValue = $(addColumn).text();
		$("#"+hiddenField).val(columnValue);
	}
	function getData(a,id) {
		// console.log(id);
		var id_satuan = $("#load_satuan_range_level_"+a).val();
		saveToDatabase(id_satuan,'id_satuan',id)
	}
	
	function getLevel(a,id) {
		// console.log(id);
		var id_member = $("#load_level_range_"+a).val();
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
			url: base_url+"produk/edit_harga_range_level",
			type: "POST",
			data:'column='+column+'&editval='+editval+'&id='+id,
			success: function(data){
				if(!$.isNumeric(editableObj)){
					$(editableObj).css("background","#F5F5F5");
				}
			}
		});
	}
	function deleteRecord(id) {
		if(confirm("Are you sure you want to delete this row?")) {
			$.ajax({
				url: base_url+"produk/delete_harga_range_level",
				type: "POST",
				data:'id='+id,
				success: function(data){
					$("#table-row-level-"+id).remove();
				}
			});
		}
	}
	
	document.querySelectorAll('#table_range_level > tbody tr').forEach(trObj => {
		var tableValue = trObj.id;
		
		var result = tableValue.split('-');
		var data = 	$('#'+tableValue).attr('data-row-range');
		var idsatuan = 	$('#'+tableValue).attr('data-satuan');
		var member = 	$('#'+tableValue).attr('data-member-range');
		satuan_range(data,idsatuan);
		load_level_range(data,member);
		console.log(member)
		// console.log(result[2])
	});
	
	function satuan_range(tipe,idjenis){
		
		$.ajax({
			url: base_url + "produk/load_satuan_range",
			type: 'POST',
			data: {id:idjenis},
			dataType: 'json',
			beforeSend: function () {
				$("#load_satuan_range_level_"+tipe).append("<option value='loading'>loading</option>");
				$("#load_satuan_range_level_"+tipe).empty();
			},
			success: function (response) {
				// $("#jenis_lembaga_"+jenis+" option[value='loading']").remove();
				$("#load_satuan_range_level_"+tipe).append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					if(id==idjenis){
						$("#load_satuan_range_level_"+tipe).append("<option value='" + id + "' selected>" + name + "</option>");
						}else{
						$("#load_satuan_range_level_"+tipe).append("<option value='" + id + "'>" + name + "</option>");
					}
					
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	
	function load_level_range(tipe,member){
		
		$.ajax({
			url: base_url + "produk/load_member",
			type: 'POST',
			data: {id:member},
			dataType: 'json',
			beforeSend: function () {
				$("#load_level_range_"+tipe).append("<option value='loading'>loading</option>");
				$("#load_level_range_"+tipe).empty();
			},
			success: function (response) {
				// $("#jenis_lembaga_"+jenis+" option[value='loading']").remove();
				$("#load_level_range_"+tipe).append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					if(id==member){
						$("#load_level_range_"+tipe).append("<option value='" + id + "' selected>" + name + "</option>");
						}else{
						$("#load_level_range_"+tipe).append("<option value='" + id + "'>" + name + "</option>");
					}
					
				}
				
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
</script>

