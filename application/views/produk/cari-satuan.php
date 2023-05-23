<div class="card-block">
	<table class="table table-striped table-mailcard">
		<thead>
			<tr>
				<th class="w-1 text-center">No</th>
				<th class="w-10">satuan</th>
				<th class="w-25">Nama satuan</th>
				<th class="w-10">Jumlah satuan</th>
				<th class="w-10 text-center">Status | Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($result)){
				$no=$this->uri->segment(3)+1;
				foreach ($result as $row){
					if ($row->pub == 0){ 
						$aktif ='<i class="fa fa-check-circle"></i>'; 
						$text ='text-white'; 
						}else{ 
						$aktif = '<i class="fa fa-minus-circle"></i>'; 
						$text ='text-white-50'; 
					}
					
					$hapus = '<button type="button" class="btn btn-danger btn-sm text-white"  data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</button>';
					echo "<tr><td class='text-center'>$no</td>
					<td class='pl-1'><a class='btn-sm add_satuan text-info' title='Edit Data' data-id='$row->id' href='#'>{$row->satuan}</a></td>
					<td class='text-left'>{$row->nama_satuan}</td>
					<td class='text-left'>{$row->jumlah}</td>
					<td class='text-right'>
					<div class='btn-group btn-group-sm' role='group'>
					<button type='button' class='btn btn-info btn-sm' data-id='".$row->id."'><span class='icon $text'>$aktif</span></button>
					<button type='button' class='btn btn-info btn-sm add_satuan' data-id='".$row->id."'><i class='fa fa-edit'></i> Edit</button>
					$hapus
					</div>
					</td>
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