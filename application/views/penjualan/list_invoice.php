<?php
	$html = '';
	foreach($invoice AS $row)
	{
		if($row["oto"]==0){
			$status = 'Buka';
			$view = 'edit';
			}elseif($row["oto"]==1){
			$status = 'Edit Order';
			$view = 'edit';
			}elseif($row["oto"]==2){
			$status = 'Hapus Pembayaran';
			$view = 'view';
			}elseif($row["oto"]==3){
			$status = 'Edit Order Lunas';
			$view = 'edit';
			}elseif($row["oto"]==4){
			$status = 'Pending';
			$view = 'view';
			}elseif($row["oto"]==5){
			$status = 'Batal';
			$view = 'batal';
			}else{
			$status = 'Kunci';
			$view = 'view';
		}
		if($row["status"]=='baru'){
			$status = '<span class="badge badge-primary flat">BARU</span>';
			}else if($row["status"]=='simpan'){
			$status = '<span class="badge badge-success flat">SIMPAN</span>';
			}else if($row["status"]=='edit'){
			$status = '<span class="badge badge-info flat">EDIT</span>';
			}else if($row["status"]=='pending'){
			$status = '<span class="badge badge-warning flat">PENDING</span>';
			}else if($row["status"]=='batal'){
			$status = '<span class="badge badge-danger flat">BATAL</span>';
		}
		$lunas = '<span class="badge badge-primary flat">BELUM</span>';
		if($row["lunas"]==1 AND $row["status"]!='simpan'){
			$lunas = '<span class="badge badge-success flat">LUNAS</span>';
			}elseif($row["lunas"]==1 AND $row["status"]=='simpan'){
			$lunas = '<span class="badge badge-success flat">LUNAS</span>';
		}
		$html .='<tr>
		<td><a href="#" class="cek_transaksi" data-toggle="modal" data-id="'.$row["id_invoice"].'" data-modEdit="'.$view.'" id="cart"><span class="badge badge-info flat" data-toggle="tooltip" title="Detail Transaksi">#'.$row['id_transaksi'].'</span></a></td>
		<td class="text-right">'.$status.'</td>
		<td class="text-right">'.$lunas.'</td>
		</tr>';
	}	
echo  $html;
?>
<script>
$('.cek_transaksi').click(function(e){
	e.preventDefault();
	var id =  $(this).data("id") // will return the number 123
	var mod = $(this).data('modedit');
	 
	$.ajax({
		type: 'POST',
		url: base_url + "main/cek_akses",
		data: {id:id,mod:mod},
		dataType: "json",
		beforeSend: function () {
			$.LoadingOverlay("show", {
				background  : "rgba(165, 190, 100, 0.7)",
				fade:500,
				zIndex:100
			});
		},
		success: handleCart,
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
		}
	});
});
</script>