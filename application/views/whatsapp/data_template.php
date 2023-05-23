<table class="table table-bordered table-striped table-mailcard" id="TemplatePesan">
	<thead>
		<tr>
			<th style="width:1% !important;">No</th>
			<th>Title</th>
			<th style="width:5%;text-align:center">Aktif</th>
			<th style="width:20%;text-align:center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 1;
			foreach ($record as $row){
				if($row->active=='Y'){
					$active = 'Ya';
					}else{
					$active = 'Tidak';
				}
				echo "<tr><td>$no</td>
				<td><a class='btn-sm edit_data' title='Edit Data' data-id='$row->id' href='#'>$row->title</a></td>
				<td class='text-center'>{$active}</td>
				<td><center>
				<a class='btn-sm edit_data' title='Edit Data' data-id='$row->id' href='#'><i class='fa fa-edit'></i> Edit</a><a class='btn-sm text-danger' data-toggle='modal' data-id='{$row->id}' data-target='#confirm-delete' title='Edit Data' data-id='$row->id' href='#'><i class='fa fa-remove'></i> Hapus</a>
				</center></td>
				</tr>";
				$no++;
			}
		?>
	</tbody>
</table>
<script>
	var uTable;
	$(document).ready(function() {
		uTable = $('#TemplatePesan').DataTable();
	});
</script>