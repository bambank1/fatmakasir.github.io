<div class="card-body table-responsive">
	<div class="card-block">
		<table class="table  table-striped table-mailcard" id="jsonuser">
			<thead class="thead-dark">
				<tr>
					<th class="w-2 text-center">#</th>
					<th class="w-10">ID.Transaksi</th>
					<th class="w-25">Tanggal</th>
					<th class="text-left">Catatan</th>
					<th class="text-left">Kasir</th>
					<th class="w-10 text-right">Nominal</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					// print_r($result);
					$total_masuk=0;
					$total_keluar=0;
					$button='';
					if(!empty($result)){
						$no=$this->uri->segment(3)+1;
						foreach($result AS $aRow){ 
							if($aRow->pemasukan){
								$nominal = '<span class="text-success">'.rp($aRow->pemasukan).'</span>';
								$jenis = '<button class="btn btn-success btn-sm"><i class="fa fa-arrow-circle-right"></i></button>';
								$total_masuk += $aRow->pemasukan;
								}else{
								$nominal = '<span class="text-danger">'.rp($aRow->pengeluaran).'</span>';
								$jenis = '<button class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i></button>';
								$total_keluar +=$aRow->pengeluaran;
							}
						?>
						<tr style="">
							<td class="w-2 text-center"><?=$jenis;?></td>
							<td class="text-left"><?=$aRow->id_generate;?></td>
							<td class="text-left"><?=dtimes($aRow->create_date,true,false);?></td>
							<td class="text-left"><?=$aRow->catatan;?></td>
							<td class="text-left"><?=$aRow->nama_lengkap;?></td>
							<td class="text-right"><?=$nominal;?></td>
						</tr>
					<?php $no++;} ?>
					<?php }else{ ?>
					<tr>
						<td colspan="6">BELUM ADA DATA</td>
					</tr>
				<?php } ?>
				<tr>
					<td class="w-2 text-center"><button class="btn btn-success btn-sm"><i class="fa fa-arrow-circle-right"></i></button></td>
					<td colspan="3" class="text-left text-success"><strong>TOTAL PEMASUKAN</strong></td>
					<td colspan="3" class="text-right text-success"><strong><?=rp($total_masuk);?></strong></td>
				</tr>
				<tr>
					<td class="w-2 text-center"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i></button></td>
					<td colspan="3" class="text-left text-danger"><strong>TOTAL PENGELUARAN</strong></td>
					<td colspan="3" class="text-right text-danger"><strong><?=rp($total_keluar);?></strong></td>
				</tr>
				
			</tbody>
		</table>
		<nav aria-label="Page navigation" class="mt-3">
			<?php echo $this->ajax_pagination->create_links(); ?>
		</nav>
	</div><!-- /.card-body -->
</div><!-- /.card-body -->
<script>
	$(".rekap").on('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var tgl = $("#dari").val();
		var user = $('#user').val();
		var subtotal = $('#subtotal').val();
		
		if(subtotal==0){
			sweet('Peringatan!!!','Maaf Data masih kosong','warning','warning');
			return;
		}
		$.ajax({
			url: base_url + 'pembukuan/save_rekap_pengeluaran',
			method: 'POST',
			dataType: 'json',
			data :{tgl:tgl,id:id,user:user,subtotal:subtotal},
			success: function(data) {
				console.log(data);
				if(data.ok=='ok'){
					sweet('Rekap data!!!','Data berhasil direkap','success','success');
					FilterPengeluaran();
					}else{
					sweet('Rekap data!!!','Data telah direkap','warning','warning');
				}
			}
		})
		});
	</script>										