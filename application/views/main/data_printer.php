<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
<table class="table table-bordered table-striped table-mailcard" id="data_Table">
	<thead>
		<tr>
			<th style="width:1% !important;">No</th>
			<th>Jenis printer</th>
			<th>Nama shared printer</th>
			<th>Ukuran Kertas</th>
			<th>Posisi</th>
			<th>Max Item</th>
			<th style="width:5%;text-align:center">Aktif</th>
			<th style="width:10%;text-align:center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 1;
			foreach ($record as $row){
			
				if ($row['pub'] == 1){ $aktif ='<i class="fa fa-check-circle text-success"></i>'; }else{ $aktif = '<i class="fa fa-minus-circle text-danger"></i>'; }
				echo "<tr><td>$no</td>
				<td><a class='btn-sm edit_printer text-success' title='Edit Data' data-id='$row[id]' href='#'>$row[name]</a></td>
				<td>$row[shared_name]</td>
				<td>$row[ukuran_kertas]</td>
				<td>$row[posisi]</td>
				<td>$row[max_item]</td>
				<td class='text-center'>$aktif</td>
				<td><center>
				<a class='btn-sm edit_printer text-success' title='Edit Data' data-id='$row[id]' href='#'><i class='fa fa-edit'></i> Edit</a>
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
		uTable = $('#dataPrinter').DataTable();
	});
</script>