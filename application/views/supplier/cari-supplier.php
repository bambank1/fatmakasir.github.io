<div class="card-body table-responsive">
	<div class="card-block">
		<table class="table table-bordered table-striped table-mailcard" id="jsonuser">
			<thead>
				<tr>
					<th style="width:1% !important;">No.</th>
					<th>Nama Perusahaan</th>
					<th>Atas Nama</th>
					<th>Jabatan</th>
					<th>No. HP</th>
					<th>Jenis usaha</th>
					<th>Tgl. Register</th>
					<th style="width:16%;text-align:center">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($result)){
					$no=$this->uri->segment(3)+1;
					foreach($result as $row){ 
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><a href="#" class="edit_supplier text-info" data-id="<?php echo $row["id_supplier"]; ?>"><?php echo $row["nama_perusahaan"]; ?></a></td>
						<td><?=$row["pemilik"];?></td>
						<td><?=$row["jabatan"];?></td>
						<td><?=$row["telp"];?></td>
						<td><?=$row["jenis_usaha"];?></td>
						<td><?=dtimes($row["tgl_terdaftar"],false,false);?></td>
						<td class="text-center">
							<a href="#" class="edit_supplier text-info" data-id="<?php echo $row["id_supplier"]; ?>"><i class='fa fa-edit'></i> Edit</a> | <a class="text-danger" data-id="<?=$row["id_supplier"]; ?>" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash"></i> Hapus</a>
						</td>
					</tr>
				<?php $no++;} }else{ ?>
				<tr>
					<td colspan="8">Data belum ada</td>
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
</div><!-- /.card-body -->
<!-- Display posts list -->