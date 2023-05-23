<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Laporan Laba Rugi</title>
		<link href="<?= FCPATH; ?>assets/vendor/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css">
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
			
			.invoice-box {
			width:100%;
			margin: 0 auto;
			padding: 10px;
			font-size: 12px;
			line-height: 18px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
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
			background-color:#333;
			color: white;
			text-align: center;
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
			background:#333;
			color: #fff;
			font-weight: bold;
			padding: 5px;
			}
			.invoice-box table tr.heading_1 td {
			background:#cccccc;
			color: #000;
			font-weight: bold;
			padding: 5px;
			}
			.invoice-box table tr.heading_2 td {
			background:#999999;
			color: #000;
			font-weight: bold;
			padding: 5px;
			}
			
			.invoice-box table tr.profit td {
			background: #444444;
			color: #fff;
			font-weight: bold;
			padding: 5px;
			}
			
			.invoice-box table tr.details td {
			padding-bottom: 20px;
			}
			
			.invoice-box table td.title{
			font-weight: bold;
			}
			.invoice-box table tr.kepada td{
			color: #fff;
			border-bottom:1px dotted #000
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
			font-weight: bold;
			}
			.invoice-box table td.tgl {
			border-bottom:1px dotted #000;
			font-weight:bold;
			}
			.invoice-box table td.tkepada {
			background:#333;
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
			if(!empty($pendapatan)){
				$alamat = base64_decode($info['deskripsi']);
				$alamat = cleanString($alamat);
				$wa = $email = $_fb = $fb ='';
				if($info['phone']!='-'){
					$wa = $info['phone'];
				}
				if($info['email']!='-'){
					$email = $info['email'];
				}
				
				if($info['fb']!='-'){
					$fb = '<i class="fa fa-facebook-square"></i>&nbsp;<span class="sosmed">'.$info['fb'].'</span>&nbsp;';
				}
				
				$_ig ='';$ig ='';
				if($info['ig']!='-'){
					$ig = '<i style="margin-top:1px" class="fa fa-instagram"></i>&nbsp;<span class="sosmed">'.$info['ig'].'</span>';
				}
			?>
			<footer>
				<?=$info['title'];?> © <?php echo date("Y");?> 
			</footer>
			<div class="invoice-box">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="4" rowspan="5"><img src="<?=$logo;?>" style="max-width:300px;"></td>
						<td colspan="2" class="tgl">LAPORAN LABA RUGI</td>
					</tr>
					<tr class="">
						<td colspan="2">Periode, <?=getBulan($bulan).' '.$tahun;?></td>
					</tr>
					<tr class="">
						<td colspan="2"></td>
					</tr>
					<tr class="kepada">
						<td class="tkepada">Dicetak oleh</td>
						<td class="bawah"><?=$user['nama_lengkap'];?></td>
					</tr>
					<tr class="">
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="4"><i style="margin-bottom:-3px" class="fa fa-whatsapp"></i>&nbsp;<span class="sosmed"><?=$wa;?></span> <i style="margin-bottom:-3px" class="fa fa-envelope-square"></i>&nbsp;<span class="sosmed"><?=$email;?></span> <?=$fb;?> <?=$ig;?> </td>
						<td colspan="2"></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:5px" cellpadding="0" cellspacing="0">
					<tr class="heading">
						<td class="">Produk & Jasa</td>
						<td class="total" style="width:16%!important">&nbsp;</td>
						<td class="total" style="width:16%!important">&nbsp;</td>
					</tr>
					
					<tr>
						<td><?=$pendapatan->nama_reff;?></td>
						<td class="text-right"></td>
						<td class="total"><?=rp($saldo);?></td>
					</tr>
					<?php 
						$hpp = sum_hpps($bulan,$tahun);
						$laba_kotor =$saldo - $hpp ;
					?>
					
					<tr class="heading_1">
						<td>Harga Pokok Penjualan</td>
						<td>&nbsp;</td>
						<td class="total"><?=rprp($hpp);?></td>
					</tr>
					
					<tr class="heading_2">
						<td>Laba Kotor</td>
						<td>&nbsp;</td>
						<td class="total"><?=rprp($laba_kotor);?></td>
					</tr>
					
					<tr class="heading">
						<td class="">Beban & Biaya</td>
						<td class=""></td>
						<td class="total" style="width:16%!important">&nbsp;</td>
					</tr>
					<?php 
						$total_beban = 0;
						foreach($pengeluaran AS $val){
							$beban = sum_jurnal('debit',$val->no_reff,$bulan,$tahun);
						?>
						<tr>
							<td><?=$val->keterangan;?></td>
							<td class="text-right"><?=rp($beban->total);?></td>
							<td class="text-right"></td>
						</tr>
						<?php 
							$total_beban += $beban->total;
						} ?>
						
						<?php 
							$laba = 0;
							$rugi = 0;
							$laba_rugi = $saldo - $hpp;
							if($laba_rugi > $total_beban){
								$laba = $laba_rugi - $total_beban;
								$title = 'LABA BERSIH';
								}elseif($total_beban > $laba_rugi){ 
								$laba = $laba_rugi - $total_beban;
								$title = 'LABA RUGI';
								}else{
								$laba = 0;
								$title = 'LABA RUGI';
							}
						?>
						<tr class="">
							<td class="">Total Beban</td>
							<td class="text-right"><?=rp($total_beban);?></td>
							<td class=""></td>
						</tr>
						<tr class="profit">
							<td class=""><?=$title;?></td>
							<td class=""></td>
							<td class="total" style="width:16%!important"><?=rprp($laba);?></td>
						</tr>
				</table>
				
			</div>
		</body>
	<?php }else{ echo "Belum ada data penjualan";} ?>
</html>
