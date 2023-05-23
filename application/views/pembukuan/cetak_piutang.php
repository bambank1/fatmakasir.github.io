<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cetak Laporan Piutang</title>
		<link href="<?= FCPATH; ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<style>
			@page {
			margin: 0 0;
            }
			body {
			margin-top: 0cm;
			margin-left: 0.5cm;
			margin-right: 1cm;
			margin-bottom: 0cm;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }
			/** Define the footer rules **/
            footer {
			position: fixed; 
			bottom: 0cm; 
			left: 0cm; 
			right: 0cm;
			height: 0.5cm;
			padding:5px;
			
			/** Extra personal styles **/
			background-color: <?=$info['warna_lunas'];?>;
			color: white;
			text-align: center;
            }
			.invoice-box {
			width:100%;
			margin: 0 auto;
			padding: 10px;
			font-size: 12px;
			line-height: 18px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
			}
			
			.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
			}
			
			.invoice-box table td {
			padding: 0 5px 0 5px;
			vertical-align: top;
			}
			
			.invoice-box table tr td:nth-child(2) {
			
			}
			
			.invoice-box table tr.top table td {
			padding-bottom: 0;
			}
			
			.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
			}
			
			.invoice-box table tr.information table td {
			
			}
			
			.invoice-box table tr.heading td {
			background: <?=$info['warna_lunas'];?>;
			color: #fff;
			font-weight: bold;
			padding: 5px;
			}
			
			.invoice-box table tr.details td {
			padding-bottom: 20px;
			}
			
			.invoice-box table tr.item td{
			border-bottom: 1px dotted #000;
			
			}
			.invoice-box table tr.kepada td{
			color: #fff;
			border-bottom:1px dotted #000
			}
			
			.invoice-box table tr.item.last td {
			
			}
			
			.invoice-box table tr.total{
			font-weight: bold;
			text-align:right;
			}
			.invoice-box table tr.hormat{
			font-weight: bold;
			text-align:left;
			}
			.invoice-box table tr.pelanggan{
			font-weight: bold;
			text-align:center;
			}
			.invoice-box table td.total {
			text-align:right;
			}
			
			.invoice-box table td.ket {
			text-align:left;
			}
			.invoice-box table td.tgl {
			border-bottom:1px dotted #000;
			font-weight:bold;
			}
			.invoice-box table td.tkepada {
			background:<?=$info['warna_lunas'];?>;
			width:12%!important
			}
			.invoice-box table tr.kepada td.bawah {
			color:#000;
			width:30%!important
			}
			.invoice-box table td.total1 {
			border-left:1px solid #000;
			border-top:1px solid #000;
			border-bottom:1px dotted #000;
			}
			.invoice-box table td.total2 {
			border-top:1px solid #000;
			border-right:1px solid #000;
			border-bottom:1px dotted #000;
			text-align:right;
			font-weight:bold;
			}
			.invoice-box table td.umuka1 {
			border-left:1px solid #000;
			border-bottom:1px dotted #000;
			}.invoice-box table td.umuka2 {
			border-right:1px solid #000;
			border-bottom:1px dotted #000;
			text-align:right;
			font-weight:bold;
			}
			.invoice-box table td.sisa1 {
			border-left:1px solid #000;
			border-bottom:1px solid #000;
			}
			.invoice-box table td.sisa2 {
			border-right:1px solid #000;
			border-bottom:1px solid #000;
			text-align:right;
			font-weight:bold;
			}
			.invoice-box table td.ttd {
			border-bottom:1px dotted #000;
			text-align:center;
			font-weight:bold;
			}
			.invoice-box table td.border {
			border-right:1px dotted #000;
			}
			.invoice-box table td.borderl {
			border-left:1px dotted #000;
			}
			.invoice-box table td.borderr {
			border-right:1px dotted #000;
			}
			
			.invoice-box .table img{
			position: fixed;
			z-index:-1000;
			}
			.watermark{
			right:4cm;
			width:    4.5cm;
			height:   auto;
			opacity:0.2;
			z-index:-1
			
			/** Your watermark should be behind every content**/
            }
			
		</style>
	</head>
	<body>
		<?php
			$alamat = base64_decode($info['deskripsi']);
			$alamat = cleanString($alamat);
		?>
		<footer>
			<?=$info['title'];?> © <?php echo date("Y");?> 
		</footer>
		<div class="invoice-box">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" rowspan="5" style="width:350px;"><img src="<?=$logo;?>" style="width:100%; max-width:350px;max-height:80px"></td>
					<td colspan="2" class="tgl">LAPORAN PIUTANG</td>
				</tr>
				<tr class="">
					<td colspan="2"><?=tgl_indo(date('Y-m-d'));?></td>
				</tr>
				<tr class="">
					<td colspan="2"></td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">KASIR</td>
					<td class="bawah"><?=$user;?></td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">Periode</td>
				<td class="bawah"><?=getBulan($bulan);?> <?=($tahun);?></td>
				</tr>
				<tr class="">
				<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="4">
						<span class="alamat"><?=($alamat);?></span><br>
						M:<span class="sosmed"><?=$info['phone'];?></span>&nbsp;E:<span class="sosmed"><?=$info['email'];?></span>&nbsp;FB:<span class="sosmed"><?=$info['fb'];?></span>&nbsp;IG:<span class="sosmed"><?=$info['ig'];?></span>
						<td colspan="2"></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:5px" cellpadding="0" cellspacing="0">
					<tr class="heading">
						<td style="width:1%;" class="text-center">No.</td>
						<td style="width:5%"  class="text-center">No.Order.</td>
						<td style="width:5%"  class="text-left">Pelanggan</td>
						<td style="width:2%"  class="text-left">Tgl.Order</td>
						<td style="width:5%"  class="total">Order</td>
						<td style="width:2%"  class="total">Pajak</td>
						<td style="width:2%"  class="total">Diskon</td>
						<td style="width:5%"  class="total">Total</td>
						<td style="width:5%"  class="total">Bayar</td>
						<td style="width:5%"  class="total">Piutang</td>
					</tr>
					<?php 
						$no=1;
						$t_omset=0;
						$total_beli=0;
						$totalDiskon=0;
						$totalbeli=0;
						$Totalbayar=0;
						$total_bayar=0;
						$total_diskon=0;
						$diskon=0;
						$piutang=0;
						$subtotal=0;
						$total_pajak=0;
						$total_piutang=0;
						foreach($detail  AS $val){
							$aksi = '';
							if($val['sisa'] >0){
								$aksi = '<button type="button" data-id="'.$val["id_invoice"].'" data-modEdit="view"  id="cart" class="btn btn-info btn-sm cek_transaksi">BAYAR</button>';
							}
							$rows = bayar($val['id_invoice']);
							if (isset($rows)) {
								$Totalbayar = $rows['Totalbayar'];
								}else{
								$Totalbayar = 0;
							}
							$t_order = sumOrder($val['id_invoice']);
							$t_omset = sumOrder($val['id_invoice']);
							$totalDiskon = totalDiskon($val['id_invoice']);
							$t_omset = $t_omset - $totalDiskon;
							$piutang = sumPiutang($val['id_invoice']);
							if($val['pajak']>0){
								$sub_tpajak = ($t_omset * $val['pajak']) /100;
								$piutang =  $t_omset + $sub_tpajak - $Totalbayar;
								}else{
								$piutang = $t_omset - $piutang[0]['piutang'];
								$sub_tpajak = $val['pajak'];
							}
							
							$subtotal = $val['jumlah'] * $val['harga'];
							if($val['diskon'] > 0){
								$diskon = ($subtotal * $val['diskon']) /100;
								$subtotal = $subtotal - $diskon;
								}else{
								$diskon = 0;
								$subtotal = $subtotal;
							}
							$t_omset = sumOrder($val['id_invoice']);
							$totalDiskon = totalDiskon($val['id_invoice']);
							$t_omset = $t_omset - $totalDiskon;
							$piutang = sumPiutang($val['id_invoice']);
							if($val['pajak']>0){
								$sub_tpajak = ($t_omset * $val['pajak']) /100;
								$piutang =  $t_omset + $sub_tpajak - $Totalbayar;
								}else{
								$piutang = $t_omset - $piutang[0]['piutang'];
								$sub_tpajak = $val['pajak'];
							}
							
							
							$totalbeli += $val['totalbeli'];
							$total_beli += $t_omset;
							$total_diskon += $diskon;
							$total_bayar += $val['totalbayar']+$val['diskon'];
							$total_pajak += $sub_tpajak;
							$total_piutang += $piutang;
							
						?>
						<tr class="item">
							<td class="borderl"><?php echo $no;?></td>
							<td class="borderr borderl">#<?=$val['id_transaksi'];?></td>
							<td class="borderr"><?=$val['namak'];?></td>
							<td class="borderr"><?=date_time($val['tgl_trx'],false);?></td>
							<td class="borderr total"><?=rp($t_order);?></td>
							<td class="borderr total"><?=rp($sub_tpajak);?></td>
							<td class="borderr total"><?=rp($totalDiskon);?></td>
							<td class="borderr total"><?=rp($t_omset);?></td>
							<td class="borderr total"><?=rp($val['totalbayar']);?></td>
							<td class="borderr total"><?=rp($piutang);?></td>
						</tr>
						<?php 
							
							$no++; 
						}
						
					?>
					
				</table>
				<table class="table" style="width:100%;margin-top:10px" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td class="total1" style="width:12%">Total Piutang</td>
						<td class="total2" style="width:19%"><?=rp($total_piutang);?></td>
					</tr>
				</table>
				</div>
		</body>
	</html>			