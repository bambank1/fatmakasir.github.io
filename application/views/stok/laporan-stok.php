<div class="card-block">
	<table class="table table-striped table-mailcard">
		<thead>
			<tr>
				<th class="w-1 text-center">No</th>
				<th class="w-10">Title</th>
				<th class="w-10 text-right">Tanggal</th>
				<th class="w-8 text-right">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($result)){
				$no=$this->uri->segment(3)+1;
				foreach ($result as $row){
					echo "<tr><td class='text-center'>$no</td>
					<td class='pl-1'><a class='btn-sm detail_history text-info' title='Edit Data' data-id='".$row->id."' href='#'>".$row->title."</a></td>
					<td class='text-right'>".$row->tanggal."</td>
					<td class='text-right'>
					<div class='btn-group btn-group-sm' role='group'>
					<a href='".base_url('stok/history/').encrypt_url($row->id)."/?type=pdf' class='btn btn-info btn-sm detail_history' data-id='".$row->id."'><i class='fa fa-search'></i> Detail</a>
					</div>
					</td>
					</tr>";
					$no++;
					$no++;
				} }else{ ?>
				<tr>
					<td colspan="6">Data belum ada</td>
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