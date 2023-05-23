<div class="card-body table-responsive">
	<div class="card-block">
		<table class="table table-bordered table-striped table-mailcard" id="jsonuser">
			<thead>
				<tr>
					<th style="width:1% !important;">No.</th>
					<th>Nama</th>
					<th>No. HP</th>
					<?php if($sortBy=='last_order' OR $sortBy=='min_order' OR $sortBy=='max_order'){
						echo '<th class="text-right">Tgl.Order</th>';
						}else{
						echo '<th class="text-right">Tgl.Daftar</th>';
					} ?>
					<th class="text-right">Total Order</th>
					<th style="width:5%;">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($posts)){
					$no=$this->uri->segment(3)+1;
					foreach($posts as $row){ 
						$query = $this->db->query("SELECT 
						SUM(`invoice`.`total_bayar`) AS `total`
						FROM `invoice` WHERE
						`invoice`.`id_konsumen` =".$row['id']);
						$rows = $query->row();	
						$edit = '<a href="#"  class="edit_konsumen" data-member="'.$row["jenis_member"].'" data-jenis="'.$row["jenis"].'" data-id="'.encrypt_url($row["id"]).'">'.$row["nama"].'</a>';
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?=$edit;?></td>
						<td><?=$row["no_hp"];?></td>
						<?php if($sortBy=='last_order' OR $sortBy=='min_order' OR $sortBy=='max_order'){ ?>
							<td class="text-right"><?=dtime($row["tgl_trx"]);?></td>
							<?php }else{ ?>
							<td class="text-right"><?=dtime($row["tgl_daftar"]);?></td>
						<?php } ?>
						<td class="text-right"><?=rp($rows->total);?></td>
						<td class="aksi"><a class="dropdown-item" href="<?=base_url();?>konsumen/detail/<?=encrypt_url($row["id"]); ?>"><span class="badge badge-primary">Detail</span></a></td>
					</tr>
				<?php $no++;} }else{ ?>
				<tr>
					<td colspan="10">Data belum ada</td>
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