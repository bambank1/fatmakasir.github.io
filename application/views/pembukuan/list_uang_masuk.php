<div class="table-responsive-sm">
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th style="width:2%">No</th>
				<th style="width:5%">Kasir</th>
				<th style="width:3%">Tgl. Setor</th>
				<th style="width:3%">Jumlah</th>
				<th style="width:2%">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$totsetors = 0;
				// print_r($result);
				if(!empty($result)) {
					$no=1;
					
					foreach($result->result() AS $rows){
						$rowuser=$this->db->query("SELECT nama_lengkap  from tb_users where id_user = ".$rows->id_user)->row();
						$totsetor = 0;
						$timestamp = strtotime($rows->tgl_setor);
						$id_user = encrypt_url($rows->id_user);
						$nama_lengkap = encrypt_url($rowuser->nama_lengkap);
					?>
					<tr>
						<td><?=$no;?></td>
						<td><?=$rowuser->nama_lengkap;?></td>
						<td><?=$rows->tgl_setor;?></td>
						<td><?=rp($rows->tot_bayar);?></td>
						<td>
							<a href="<?=base_url();?>pembukuan/cetak_setor/<?=$id_user;?>/<?=$timestamp;?>/<?=$nama_lengkap;?>" target="_blank" class="btn btn-primary btn-sm">Cetak</a> 
						</td>
						
					</tr>
					<?php 
						// $totsetor = $totsetor + $row['jml_bayar'];
						// $totsetors +=  $row['jml_bayar'];
						$no++;
					}
					
				}else{ ?>
				<tr>
					<td colspan="11">Data belum ada</td>
				</tr> 
			<?php }?>
		</tbody>
	</table>
</div>