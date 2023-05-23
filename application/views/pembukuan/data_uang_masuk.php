<?php if(!empty($result)) { ?>
	<div class="table-responsive-sm">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th style="width:1%">No.</th>
					<th style="width:2%">ID_Order</th>
					<th style="width:5%">Tgl. Transaksi</th>
					<th style="width:5%">Nama Konsumen</th>
					<th style="width:5%">Tgl. Bayar</th>
					<th style="width:5%">Keterangan</th>
					<th style="width:5%">Lampiran</th>
					<th style="width:5%" class="text-right">Jml. Bayar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$totsetors = 0;
					
					$no=1;
					$lampiran ='';
					foreach($result AS $rows){
						$cara_bayar = $rows['nama_bayar'];
						
						$conditions['where'] = array( 
						'`bayar_invoice_detail`.id_bayar'=>$rows['id'],
						'`invoice`.`status`'=>'simpan'
						); 
						
						if(!empty($user)){ 
							$conditions['where'] = array(
							'bayar_invoice_detail.id_user' => $user
							);
						} 
						
						$databayar = $this->model_data->detailBayar($conditions);
						$totsetor = 0;
						if(!empty($databayar)) {
							foreach($databayar AS $row){
								$bank = bank($row['id_sub_bayar']);
								
								
								if(!empty($row['lampiran'])){
									$lampiran ='<a class="lightbox" href="'.base_url('uploads/lampiran/').$row['lampiran'].'">View</a>';
								}
								$nama_bayar = $row['nama_bayar'];
								if(!empty($bank) AND $rows['id'] !=1){
									$nama_bayar = $row['nama_bayar'] .'('.$bank.')';
								}
							?>
							
							<tr>
								<td><?php echo $no;?></td>
								<td>#<?php echo $row['id_invoice'];?></td>
								<td><?php echo dtimes($row['tgl_trx'],false,false);?></td>
								<td><?php echo $row['nama'];?></td>
								<td><?php echo dtimes($row['tgl_bayar'],false,false);?></td>
								<td><?=$nama_bayar;?></td>
								<td><?=$lampiran;?></td>
								<td class="text-right"><?php echo rp($row['jml_bayar']);?></td>
							</tr>
							<?php 
								$totsetor = $totsetor + $row['jml_bayar'];
								$totsetors +=  $row['jml_bayar'];
								$no++;
							} }
							
							echo '<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><i><strong>'.$cara_bayar.'</i></strong></td>
							<td>&nbsp;</td>
							<td class="text-right"><i><strong>'.rp($totsetor).'</i></strong></td>
							</tr>';
					}
					echo '<tfoot><tr>';
					echo '<td colspan="2"><button class="btn btn-info btn-sm" id="cetak_u_masuk"><i class="fa fa-file-pdf-o"></i> Print</button></td>';
					if($id_jenis_bayar==1 AND $user==$this->session->idu){
						echo '<td colspan="2"><button class="btn btn-success btn-sm setor" id="setor_u_masuk"><i class="fa fa-send"></i> Setor</button></td>';
						}else{
						echo '<td></td>';
						echo '<td></td>';
					}
					echo '<td></td>';
					echo '<td></td>';
					echo '<td><i><strong>Total</i></strong></td>';
					echo '<td class="text-right"><i><strong>'.rp($totsetors).'</i></strong>
					<input type="hidden" name="total_u" id="total_u" value="'.$totsetors.'">
					</td>';
					echo '</tr></tfoot>';
				?>
			</tbody>
		</table>
	</div>
	<script>
		var lampiran = '<?=$lampiran;?>';
		if(lampiran !=''){
		var lightboxDescription = GLightbox({
			selector: '.lightbox',
			loop: true,
		});
	}
	</script>
	<?php }else{ ?>
	Data belum ada
<?php }?>	
