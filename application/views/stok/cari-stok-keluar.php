<div class="card-block">
	<table class="table table-striped table-mailcard" >
		<thead>
			<tr>
				<th class="w-1 text-center">No</th>
				<th class="w-10 pl-1">Nama bahan</th>
				<th class="w-8 text-right">Stok Keluar</th>
				<th class="w-8 text-right">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($result)){
				$no = 1;
				$total = 0;
				foreach ($result as $row){
					$jml_masuk = stok_masuk($row->id);
					$jml_keluar = stok_keluar($row->id);
					$total = $jml_masuk - $jml_keluar;
					
					$disabled = '';
					if($jml_keluar <=0 ){
						$disabled = 'disabled';
					}
					
					echo "<tr><td class='text-center'>$no</td>
					<td class='pl-1'>".$row->title."</td>
					<td class='text-right'>".$jml_keluar."</td>
					<td class='text-right'>
					<div class='btn-group btn-group-sm' role='group'>
					<button type='button' class='btn btn-info btn-sm detail_bahan' data-id='".$row->id."' ".$disabled."><i class='fa fa-search'></i> Detail</button>
					
					</div>
					</td>
					</tr>";
					$no++;
				} }else{ ?>
				<tr>
					<td colspan="4">Data belum ada</td>
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
