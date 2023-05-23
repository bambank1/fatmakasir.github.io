<div class="card-block">
	<table class="table table-striped table-mailcard">
		<thead>
			<tr>
				<th class='w-1 text-center'>No</th>
				<th>Uraian</th>
				<th class='w-20 text-right'>Status | Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($result)){
				$no=$this->uri->segment(3)+1;
				foreach ($result as $row){
					if ($row['pub'] == 'Y'){ $aktif ='<i class="fa fa-check-circle text-white" title="Aktif"></i>'; }else{ $aktif = '<i class="fa fa-minus-circle text-danger" title="Nonaktif"></i>'; }
					
					// if ($row['status'] == 1){ $status ='<i class="fa fa-check-circle text-success"></i>'; }else{ $status = '<i class="fa fa-minus-circle"></i>'; }
					
					if ($row['id_jenis'] == 9){
						$edit_jenis = "<a class='btn-sm text-warning' href='#'>$row[jenis_cetakan]</a>";
						$edit_btn = "<a class='btn btn-secondary btn-sm text-white' href='#'><i class='fa fa-edit'></i> Edit</a>";
						$hapus = '<a class="btn btn-secondary btn-sm text-white" href="#"><i class="fa fa-trash "></i> Hapus</a>';
						}else{
						$edit_jenis = "<a class='btn-sm jenis text-info' title='Edit Data' data-id='$row[id_jenis]' href='#'>$row[jenis_cetakan]</a>";
						$edit_btn = "<a class='btn btn-info btn-sm jenis text-white' title='Edit Data' data-id='$row[id_jenis]' href='#'><i class='fa fa-edit'></i> Edit</a>";
						$hapus = '<a class="btn btn-danger btn-sm text-white" data-id="'.$row['id_jenis'].'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</a>';
					}
					echo "<tr><td class='text-center'>$no</td>
					<td class='pl-1'>$edit_jenis</td>
					<td class='text-right'><div class='btn-group btn-group-sm' role='group'>
					<button type='button' class='btn btn-info btn-sm ' data-id='".$row['id_jenis']."'><span class='icon text-white'>$aktif</span></button>$edit_btn $hapus
					</div></td>
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