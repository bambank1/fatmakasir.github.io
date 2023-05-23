<div class="card-block">
	<table class="table table-striped table-mailcard">
		<thead>
			<tr>
				<th class="w-1 text-center">No</th>
				<th>Nama Barang/Merk</th>
				<th class="">Kategori</th>
				<th class="w-8 text-right">Harga_Beli</th>
				<th class="w-2 text-right">Jml.Stok</th>
				<th class="w-2">Satuan</th>
				<th class="w-2 text-center">Stok</th>
				<th class="w-20 text-right">Status | Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($result)){
				$no=$this->uri->segment(3)+1;
				foreach ($result as $row){
					if ($row->pub == 1){ 
						$aktif ='<i class="fa fa-check-circle"></i>'; 
						$text ='text-white'; 
						}else{ 
						$aktif = '<i class="fa fa-times"></i>'; 
						$text ='text-white-50'; 
					}
					if ($row->status_stok == 'Y'){ 
						$stok ='<i class="fa fa-check-circle"></i>'; 
						}else{ 
						$stok = '<i class="fa fa-times"></i>'; 
					}
					$jml_masuk = stok_masuk($row->id) - stok_keluar($row->id);
					$hapus = '<button type="button" class="btn btn-danger btn-sm text-white"  data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</button>';
					echo "<tr><td class='text-center'>$no</td>
					<td class='pl-1'><a class='btn-sm add_bahan text-info' title='Edit Data' data-id='".$row->id."' href='#'>".$row->title."</a></td>
					<td class='text-left'>".jenis_cetakan($row->id_jenis)."</td>
					<td class='text-right'>".rp($row->harga_modal)."</td>
					<td class='text-right'>".rp($jml_masuk)."</td>
					<td>".$row->satuan."</td>
					<td class='text-center'>".$stok."</td>
					<td class='text-right'>
					<div class='btn-group btn-group-sm' role='group'>
					<button type='button' class='btn btn-success btn-sm menu_harga' data-type='".$row->type_harga."' data-id='".$row->id."' data-toggle='tooltip' data-original-title='Pengaturan Harga' data-placement='left'><span class='icon'><i class='fa fa-bars'></i></span></button>
					<button type='button' class='btn btn-info btn-sm' data-id='".$row->id."'><span class='icon $text'>$aktif</span></button>
					<button type='button' class='btn btn-info btn-sm add_bahan' data-id='".$row->id."'><i class='fa fa-edit'></i> Edit</button>
					$hapus
					</div>
					</td>
					</tr>";
					$no++;
				} }else{ ?>
				<tr>
					<td colspan="7">Data belum ada</td>
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
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>