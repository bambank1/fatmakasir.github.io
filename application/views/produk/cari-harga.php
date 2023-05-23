<div class="card-block">
	<table class="table table-bordered table-striped table-mailcard">
		<thead>
			<tr>
				<th class="w-1 text-center">No</th>
				<th class="">Nama Barang</th>
				<th class="w-15">Jumlah Min</th>
				<th class="w-15">Jumlah Max</th>
				<th class="w-15 text-right">Harga Jual</th>
				<th class="w-15 text-center">Status | Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($result)){
				$no=$this->uri->segment(3)+1;
				foreach ($result as $row){
					if ($row->pub == 0){ $aktif ='<i class="fa fa-check-circle"></i>'; }else{ $aktif = '<i class="fas fa-minus-circle text-danger"></i>'; }
					$hapus = '<a class="text-info" data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash text-danger"></i> Hapus</a>';
					echo "<tr><td class='text-center'>$no</td>
					<td class='pl-1'><a class='btn-sm add_harga text-info' title='Edit Data' data-id='$row->id' href='#'>{$row->title}</a></td>
					<td class='text-left'>{$row->jumlah_minimal}</td>
					<td class='text-left'>{$row->jumlah_maksimal}</td>
					<td class='text-right'>".rp($row->harga_jual)."</td>
					<td class='text-center pl-0 pr-0'><center>
					<a class='btn-sm add_satuan text-info' title='Edit Data' data-id='$row->id' href='#'><i class='fa fa-edit text-info'></i> Edit</a> | ".$hapus."
					</center></td>
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