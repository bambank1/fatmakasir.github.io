<?php 
	$color = $info['warna_lunas'];
	
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SETORAN UANG MASUK</title>
		<link href="<?= FCPATH; ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<style>
			@page { width:21cm;height:14.8cm;margin: 0.6cm 0.5cm 0.1cm 0.5cm; }
			.invoice-box {
			width:100%;
			margin: auto;
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
			background: <?=$color;?>;
			color: #fff;
			opacity:0.7;
			font-weight: bold;
			padding: 5px;
			}
			
			.invoice-box table tr.details td {
			padding-bottom: 20px;
			}
			
			.invoice-box table tr.item td{
			border-bottom: 1px solid #000;
			
			}
			.invoice-box table tr.kepada td{
			font-weight:bold;
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
			.invoice-box table td.tgl {
			font-weight:bold;
			border-bottom:1px dotted #000;
			}
			.invoice-box table td.tkepada {
			background:<?=$color;?>;
			opacity:0.7;
			width:12%!important
			}
			.invoice-box table tr.kepada td.bawah {
			color:#000;
			width:30%!important
			}
			.invoice-box table td.nomor {
			font-weight:bold;
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
			top:<?=$top;?>;
			right:4cm;
			width:    4.5cm;
			height:   auto;
			opacity:0.2;
			z-index:-1
			
			/** Your watermark should be behind every content**/
            }
			.sosmed{font-size:10pt;}
		</style>
		<?php if($html=="Y"){ ?>
			<style>
				@media print {
				.invoice-box {
				width:100%;
				margin: auto;
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
				background: #<?=$color;?>;
				color: #fff;
				opacity:0.7;
				font-weight: bold;
				padding: 5px;
				}
				
				.invoice-box table tr.details td {
				padding-bottom: 20px;
				}
				
				.invoice-box table tr.item td{
				border-bottom: 1px solid #000;
				
				}
				.invoice-box table tr.kepada td{
				font-weight:bold;
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
				.invoice-box table td.tgl {
				font-weight:bold;
				border-bottom:1px dotted #000;
				}
				.invoice-box table td.tkepada {
				background:#<?=$color;?>;
				opacity:0.7;
				width:12%!important
				}
				.invoice-box table tr.kepada td.bawah {
				color:#000;
				width:30%!important
				}
				.invoice-box table td.nomor {
				font-weight:bold;
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
				top:<?=$top;?>;
				right:4cm;
				width:    4.5cm;
				height:   auto;
				opacity:0.2;
				z-index:-1
				
				/** Your watermark should be behind every content**/
				}
				.sosmed{font-size:10pt;}
				}
			</style>
			<script type="text/javascript">
				<!--
				window.print();
				window.onfocus=function(){ window.close();}
				//-->
			</script>
		<?php } ?>
	</head>
	
	<body>
		<div class="invoice-box">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" rowspan="5"><img src="<?=$logo;?>" style="max-width:350px;"></td>
					<td colspan="4" rowspan="6">&nbsp;</td>
					<td colspan="2" class="tgl">SETORAN UANG MASUK</td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">Kasir</td>
					<td class="bawah"><?=$kasir;?></td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">TanggalvSetor</td>
					<td class="bawah"><?=dtimes($tanggal);?></td>
				</tr>
				
			</table>
			<table style="width:100%;margin-top:5px" cellpadding="0" cellspacing="0">
				<tr class="heading">
					<th class="text-center" style='font-size:11px'>No.</th>
					<th class="text-center" style='font-size:11px'>No. Invoice</th>
					<th class="text-center" style='font-size:11px'>Tgl. Invoice</th>
					<th class="text-center" style='font-size:11px'>Nama Konsumen</th>
					<th class="text-center" style='font-size:11px'>Tgl. Bayar</th>
					<th class="text-center" style='font-size:11px'>Keterangan</th>
					<th class="total" style='font-size:11px;text-align:right'>Jml. Bayar</th>
				</tr>
				<?php 
					$no=1;  
					$grandtotal = 0;
					foreach($detail  AS $rowcara){
						$databayar = $this->db->query("SELECT 
						`bayar_invoice_detail`.`id_invoice`,
						`konsumen`.`nama`,
						`invoice`.`tgl_trx`,
						`bayar_invoice_detail`.`tgl_bayar`,
						`bayar_invoice_detail`.`jml_bayar`,
						`cara_bayar`.`cara_bayar`,
						`bayar_invoice_detail`.`id`,
						`bayar_invoice_detail`.`id_byr`
						FROM
						`invoice`
						RIGHT OUTER JOIN `bayar_invoice_detail` ON (`invoice`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`)
						INNER JOIN `cara_bayar` ON (`bayar_invoice_detail`.`id_byr` = `cara_bayar`.`id_byr`)
						INNER JOIN `konsumen` ON (`invoice`.`id_konsumen` = `konsumen`.`id`)
						WHERE  `bayar_invoice_detail`.id_byr='".$rowcara->id_byr."' AND `bayar_invoice_detail`.tgl_setor='$tanggal'
						AND `bayar_invoice_detail`.id_user = '$iduser'
						ORDER BY
						`bayar_invoice_detail`.`id`");
						
						
						$totsetor = 0;
						foreach($databayar->result() AS $row){
						?>
						<tr class="item">
							<td align="center" class="border"><?=$no;?></td>
							<td class="border"><?php echo $row->id_invoice;?></td>
							<td class="border"><?php echo $row->tgl_trx;?></td>
							<td class="border"><?php echo $row->nama;?></td>
							<td class="border" align="left"><?php echo $row->tgl_bayar;?></td>
							<td class="border" align="left"><?php echo $row->cara_bayar;?></td>
							<td class="border" align="right"><?php echo rp($row->jml_bayar);?></td>
							
						</tr>
						<?php 
							$totsetor = $totsetor + $row->jml_bayar;
						$no++; } 
					?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><i><strong><?=$rowcara->cara_bayar;?></i></strong></td>
						<td align="right"><i><strong><?= rp($totsetor);?></i></strong></td>
					</tr>
					
					<?php
						$grandtotal = $grandtotal + $totsetor;
					}
				?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><strong>Grand Total</strong></td>
					<td align="right"><i><strong><?= rp($grandtotal);?></i></strong></td>
				</tr>
			</table>
			
			
		</div>
	</body>
</html>
