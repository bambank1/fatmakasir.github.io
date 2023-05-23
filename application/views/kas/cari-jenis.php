<div class="card-block">
	<table class="table table-bordered table-striped table-mailcard">
		<thead>
			<tr>
				<th class='w-1 text-center'>No</th>
				<th class='text-left w-10'>Uraian</th>
				<th class='text-left w-10'>Akun</th>
				<th class='text-center w-1'>Aktif</th>
				<th class='text-center w-5'>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($result)){
				$no=$this->uri->segment(3)+1;
				foreach ($result as $row){
					if ($row['pub'] == 'Y'){ $aktif ='<i class="fa fa-check-circle text-success"></i>'; }else{ $aktif = '<i class="fas fa-minus-circle text-danger"></i>'; }
					$hapus = '<a class="text-danger" data-id="'.$row['id_jenis'].'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash text-danger"></i> Hapus</a>';
					echo "<tr><td class='text-center'>$no</td>
					<td><a class='btn-sm jenis text-info' title='Edit Data' data-id='$row[id_jenis]' href='#'>$row[title]</a></td>
					<td>$row[no_reff] - $row[nama_reff]</td>
					<td class='text-center'>$aktif</td>
					<td class='text-center'>
					<a class='btn-sm jenis text-info' title='Edit Data' data-id='$row[id_jenis]' href='#'><i class='fa fa-edit'></i> Edit</a> $hapus</td>
					</tr>";
					$no++;
				} }else{ ?>
				<tr>
					<td colspan="5">Data belum ada</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<nav aria-label="Page navigation" class="mt-2">
		<?php 
			echo $this->ajax_pagination->create_links(); 
		?>
	</nav>
</div><!-- /.card-body -->