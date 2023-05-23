<div class="card-body table-responsive" id="DetailStok">
	<div class="card-block">
		<table class="table table-striped table-mailcard" >
			<thead>
				<tr>
					<th class="w-1 text-center">No</th>
					<th class="w-5 text-left">Tanggal</th>
					<th class="w-4 text-left">Stok Masuk</th>
					<th class="w-5 text-left">Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					// print_r($result);
					if(!empty($result)){
						$no = 1;
						$total = 0;
						foreach ($result as $key=>$row){
							echo "<tr>";
							echo "<td class='text-center'>".$no."</td>";
							echo "<td class='text-left'>".$row->create_date."</td>";
							echo "<td class='text-left'>".$row->jumlah."</td>";
							echo "<td class='text-left'>".$row->ket."</td>";
							echo "</tr>";
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
</div><!-- /.card-body -->
<script>
	function search_detail_stok(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("stok/cariStokMasuk/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,limits:limits},
			beforeSend: function(){
				$('#DetailStok').loading();
			},
			success: function(html){
				$('#DetailStok').html(html);
				$('#halaman').val(page_num);
				$('#DetailStok').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#DetailStok').loading('stop');
			}
		});
	}
</script>