<table class="table table-bordered table-striped table-mailcard" id="caraBayar">
	<thead>
		<tr>
			<th style="width:1% !important;">No</th>
			<th>Nama Bank/Merchant</th>
			<th>Nomor Rekening/Virtual Account</th>
			<th>Pemilik</th>
			<th style="width:10%;text-align:center">Aktif</th>
			<th style="width:10%;text-align:center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 1;
			foreach ($record as $row){
				if ($row->publish == 'Y'){ $aktif ='<i class="fa fa-check-circle"></i>'; }else{ $aktif = '<i class="fa fa-check-circle-o"></i>'; }
				echo "<tr><td>$no</td>
				<td>$row->nama_bank</td>
				<td>$row->nomor_rekening</td>
				<td>$row->pemilik</td>
				<td align='center'>$row->publish</td>
				<td><center>
				<a class='btn-sm edit_data' title='Edit Data' data-id='$row->id' href='#'><i class='fa fa-edit'></i></a>
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
		uTable = $('#caraBayar').DataTable();
	});
</script>