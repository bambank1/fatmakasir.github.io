<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cetak Uang Masuk</title>
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
			border-bottom: 1px solid #000;
			
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
		<footer>
			<?=$info['title'];?> © <?php echo date("Y");?> 
		</footer>
		<div class="invoice-box">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" rowspan="5" style="width:350px;"><img src="<?=$logo;?>" style="width:100%; max-width:350px;max-height:80px"></td>
					<td colspan="2" class="tgl">LAPORAN UANG MASUK</td>
				</tr>
				<tr class="">
					<td colspan="2">Serang, <?=tgl_indo(date('Y-m-d'));?></td>
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
					<td class="bawah"><?=tgl_ambil($dari);?> s/d <?=tgl_ambil($sampai);?></td>
				</tr>
				<tr class="">
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="4">
						<span class="alamat"><?=cleanString($alamat);?></span><br>
						M:<span class="sosmed"><?=$info['phone'];?></span>&nbsp;E:<span class="sosmed"><?=$info['email'];?></span>&nbsp;FB:<span class="sosmed"><?=$info['fb'];?></span>&nbsp;IG:<span class="sosmed"><?=$info['ig'];?></span>
						<td colspan="2"></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:5px" cellpadding="0" cellspacing="0">
					<tr class="heading">
						<td style="width:3%!important" class="text-right">No.</td>
						<td style="width:10%!important" class="text-right">ID_Order</td>
						<td class="total">Tgl. Order</td>
						<td class="total">Tgl. Bayar</td>
						<td class="ket">Nama Pelanggan</td>
						<td class="ket">Keterangan</td>
						<td class="total" style="width:16%!important">Jml. Bayar</td>
					</tr>
					<?php 
						$no=1; 
						$totsetors = 0;
						$totsetor = 0;
						foreach($detail  AS $rows){
							$databayar = $this->db->query("SELECT 
							`bayar_invoice_detail`.`id_invoice`,
							`konsumen`.`nama`,
							`invoice`.`id_transaksi`,
							`invoice`.`tgl_trx`,
							`bayar_invoice_detail`.`tgl_bayar`,
							`bayar_invoice_detail`.`jml_bayar`,
							`jenis_bayar`.`nama_bayar`,
							`bayar_invoice_detail`.`id`,
							`bayar_invoice_detail`.`id_bayar`,
							`bayar_invoice_detail`.`id_sub_bayar`
							FROM
							`invoice`
							RIGHT OUTER JOIN `bayar_invoice_detail` ON (`invoice`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`)
							INNER JOIN `jenis_bayar` ON (`bayar_invoice_detail`.`id_bayar` = `jenis_bayar`.`id`)
							INNER JOIN `konsumen` ON (`invoice`.`id_konsumen` = `konsumen`.`id`)
							WHERE  `bayar_invoice_detail`.id_bayar='$rows[id]' $and
							ORDER BY
							`bayar_invoice_detail`.`id`");
							foreach($databayar->result_array() AS $row){
								if($row['id_sub_bayar']==0){
									$nama_bayar = $row['nama_bayar'];
									}else{
									$bank = bank($row['id_sub_bayar']);
									$nama_bayar = $row['nama_bayar'].' - '.$bank;
								}
							?>
							<tr>
								<td class="total"><?php echo $no;?>.</td>
								<td><?php echo $row['id_transaksi'];?></td>
								<td class="total"><?php echo dtimes($row['tgl_trx'],false,false);?></td>
								<td class="total"><?php echo dtimes($row['tgl_bayar'],false,false);?></td>
								<td class="ket"><?php echo $row['nama'];?></td>
								<td class="ket"><?php echo $nama_bayar;?></td>
								<td class="total"><?php echo rp($row['jml_bayar']);?></td>
							</tr>
							<?php 
								$totsetor = $totsetor + $row['jml_bayar'];
								$totsetors +=  $row['jml_bayar'];
							$no++; } 
						} 
						
						?>
						
							</table>
							<table class="table" style="width:100%;margin-top:10px" cellpadding="0" cellspacing="0">
								<tr>
									
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="total1" style="width:12%">Total Bayar</td>
									<td class="total2" style="width:19%"><?=rp($totsetors);?></td>
								</tr>
							</table>
			</div>
		</body>
	</html>
