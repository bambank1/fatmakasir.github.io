<?php if(!empty($result)) { ?>
	<div class="table-responsive-sm">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th style="width:1%">No.</th>
					<th style="width:5%">Tgl. Setor</th>
					<th style="width:5%">KASIR</th>
					<th style="width:5%">PENERIMA</th>
					<th class="text-right" style="width:5%">TOTAL</th>
					<th class="text-right" style="width:5%">STATUS | AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$totsetor = 0;
					$totsetors = 0;
					
					$no=1;
					$lampiran ='';
					foreach($result AS $rows){
						$setor_btn ='';
						if ($this->session->level == 'keu'){ 
							if ($rows['status'] == 0){ 
								$aktif = '<i class="fa fa-minus-circle text-white" title="Belum di Approve"></i>'; 
								$edit_btn = "<a class='btn btn-info btn-sm verifikasi text-white' title='Edit Data' data-id='$rows[id]' href='#'><i class='fa fa-check'></i> Approve</a>";
								$btn = 'btn-info';
							}
							if ($rows['status'] == 1){
								$aktif ='<i class="fa fa-check-circle text-white" title="Sudah di Approve"></i>';
								$edit_btn = "<a class='btn btn-success btn-sm text-white' href='#'><i class='fa fa-edit'></i> Approved</a>";
								$btn = 'btn-success';
								$setor_btn = "<a class='btn btn-warning btn-sm text-white setor_btn' href='#' data-id='$rows[id]'><i class='fa fa-send'></i> Setor ke owner</a>";
								$btn = 'btn-success';
							}
							if ($rows['status'] == 2){
								$aktif ='<i class="fa fa-check-circle text-white" title="Sudah di Approve"></i>';
								$edit_btn = "<a class='btn btn-success btn-sm text-white' href='#'>Approved</a>";
								$btn = 'btn-success';
								$setor_btn = "<a class='btn btn-info btn-sm text-white' href='#' data-id='$rows[id]'><i class='fa fa-check-circle'></i> Setor</a><button class='btn btn-secondary btn-sm verifikasi text-white' title='Edit Data' data-id='$rows[id]' href='#'><i class='fa fa-spinner'></i> Menunggu diterima</button>";
								$btn = 'btn-success';
							}
							if ($rows['status'] == 3){
								$aktif ='<i class="fa fa-check-circle text-white" title="Sudah di Approve"></i>';
								$edit_btn = "<a class='btn btn-success btn-sm text-white' href='#'>Approved</a>";
								$btn = 'btn-success';
								$setor_btn = "<a class='btn btn-info btn-sm text-white' href='#' data-id='$rows[id]'><i class='fa fa-check-circle'></i> Setor</a><button class='btn btn-success btn-sm text-white' title='Edit Data' href='#'><i class='fa fa-check-circle'></i> Diterima</button>";
								$btn = 'btn-success';
							}
							
							}elseif ($this->session->level == 'owner' OR $this->session->level == 'admin'){
							if ($rows['status'] == 0){ 
								$aktif = '<i class="fa fa-minus-circle text-white" title="Belum di approve"></i>'; 
								$edit_btn = "<a class='btn btn-secondary btn-sm text-white' title='Edit Data'><i class='fa fa-edit'></i> Menunggu</a>";
								$btn = 'btn-secondary';
							}
							if ($rows['status'] == 1){ 
								$aktif = '<i class="fa fa-minus-circle text-white" title="Belum di approve"></i>'; 
								$edit_btn = "<a class='btn btn-secondary btn-sm text-white' title='Edit Data' href='#'><i class='fa fa-edit'></i> Menunggu</a>";
								$btn = 'btn-secondary';
							}
							
							if ($rows['status'] == 2){
								$aktif = '<i class="fa fa-minus-circle text-white" title="Belum di Approve"></i>'; 
								$edit_btn = "<a class='btn btn-info btn-sm approve_owner text-white' title='Edit Data' data-id='$rows[id]' href='#'><i class='fa fa-check'></i> Approve</a>";
								$btn = 'btn-info';
							}
							if ($rows['status'] == 3){
								$aktif = '<i class="fa fa-check-circle text-white" title="Belum di Approve"></i>'; 
								$edit_btn = "<a class='btn btn-success btn-sm approve_owner text-white' title='Edit Data' data-id='$rows[id]' href='#'>Approved</a>";
								$btn = 'btn-success';
							}
							}elseif ($this->session->level == 'kasir'){
							
							if ($rows['status'] == 0){ 
								$aktif = '<i class="fa fa-minus-circle text-white" title="Belum di approve"></i>'; 
								$edit_btn = "<a class='btn btn-secondary btn-sm verifikasi text-white' title='Edit Data' data-id='$rows[id]' href='#'><i class='fa fa-edit'></i> Menunggu</a>";
								$btn = 'btn-secondary';
							}
							if ($rows['status'] == 1){ 
								$aktif ='<i class="fa fa-check-circle text-white" title="Sudah di Verifikasi"></i>';
								$edit_btn = "<a class='btn btn-success btn-sm text-white' href='#'><i class='fa fa-edit'></i> approved</a>";
								$btn = 'btn-success';
								}else{
								$aktif ='<i class="fa fa-check-circle text-white" title="Sudah di Verifikasi"></i>';
								$edit_btn = "<a class='btn btn-success btn-sm text-white' href='#'>Approved</a>";
								$btn = 'btn-success';
							}
							
							}else{
							$aktif ='<i class="fa fa-check-circle text-white" title=""></i>';
							$edit_btn = "<a class='btn btn-secondary btn-sm text-white' href='#'><i class='fa fa-edit'></i> View Only</a>";
							$btn = 'btn-secondary';
						}
						if (empty($rows['id_penerima'])){ 
							$penerima = '-';
							}else{
							$penerima = cekUser($rows['id_penerima'])['nama'];
						}
						
					?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo dtimes($rows['tanggal'],false,false);?></td>
						<td><?php echo $rows['nama'];?></td>
						<td><?=$penerima;?></td>
						<td class="text-right"><?php echo rp($rows['total']);?></td>
						<td class='text-right'><div class='btn-group btn-group-sm' role='group'>
							<button type='button' class='btn <?=$btn;?> btn-sm'><span class='icon text-white'><?=$aktif;?></span></button><?=$edit_btn.$setor_btn;?>
						</div></td>
					</tr>
					<?php 
						$totsetor = $totsetor + $rows['total'];
						$totsetors +=  $rows['total'];
						$no++;
					}
					
					echo '<tr>';
					
					echo '<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="text-right"><i><strong>'.rp($totsetor).'</i></strong></td>
					<td>&nbsp;</td>
					</tr>';
					
					
				?>
			</tbody>
		</table>
		<nav aria-label="Page navigation" class="mt-2">
			<?php 
				echo $this->ajax_pagination->create_links(); 
			?>
		</nav>
	</div>
	
	<?php }else{ ?>
	Data belum ada
<?php }?>	
