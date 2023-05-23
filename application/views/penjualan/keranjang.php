
<?php
	if(!empty($proses)){
	?>
	<div class="keranjang" id="container">
		<?php
			if($id>0){
				$kon = pilih('konsumen','id',$proses['id_konsumen']);;
				$iduser = $this->session->idu;
				$id_invoice = $id;
				$pos = $proses['pos'];
				$oto = $proses['oto'];
				$pajak = $proses['pajak'];
				$id_konsumen = $proses['id_konsumen'];
				
				if(!empty($kon['panggilan'])){
					$nama = $kon['panggilan'].'. '.$kon['nama'];
				}
				
				// $idmember        = $kon['id_member'];
				$cek_member = cek_member($id_konsumen);
				$jenis_member    = member($cek_member);
				$idmember        = $cek_member;
				if($kon['tampil']==1){
					$nick        = '';
					$nama        = $kon['perusahaan'];
					$telp        = $kon['no_telp'];
					$alamat      = $kon['alamat_lembaga'];
					}else{
					$nick        = $kon['panggilan'];
					$nama        = $kon['nama'];
					$telp        = $kon['no_hp'];
					$alamat      = $kon['alamat'];
				}
				$disabled    = '';
				$tgl_invoice = get_day($proses['tgl_trx']);
				$tomorrow = date('Y-m-d',strtotime($proses['tgl_ambil'] . "+1 days"));
				$tgl_ambil   = get_day($tomorrow);
				$jam_ambil   = jam_ambil($proses['tgl_ambil']);
				$marketing   = $proses['id_marketing'];
				$total_bayar = $proses['total_bayar'];
				$auto_number  = $proses['id_transaksi'];
				$lunas       = $proses['lunas'];
				$button_1    = "";//pelanggan
				$button_2    = "";//tgl_order
				$readonly    = "";
				$readonlym   = "";
				$button_lunas   = "";
				$status   = $proses['status'];
				
				if($status=='baru' AND $this->session->level=='desain'){
					$readonlym = "readonly";
				}
				
				if($status=='simpan'){
					$readonly = "readonly";
					$disabled = 'disabled';
					$button_1 = 'disabled';
					$button_2 = 'readonly';
				}
				
				}else{
				$iduser      =0;
				$id_invoice  =0;
				$pos         ='N';
				$oto         =0;
				$pajak       =0;
				$id_konsumen = 0;
				$idmember    = '-';
				$nick        = '-';
				$nama        = '-';
				$disabled    = '';
				$telp        = '-';
				$alamat      = '-';
				$readonly    = '';
				$button_1    = '';
				$button_2    = '';
				$tgl_invoice = '-';
				$tgl_ambil   = '-';
				$jam_ambil   = '-';
				$marketing   = '-';
				$total_bayar =0;
				$status ='baru';
				$auto_number =$autonumber;
				$lunas       =0;
				// echo "B";
			}
			$totbayar = 0;
			
			
			if($diskon->num_rows()>0)
			{
				$rows =$diskon->row();
				$totbayar = $rows->totbayar;
				if($rows->jdiskon>0)
				{
					$tdiskon=($totbayar*10)/100;
					$tdiskon = ($totbayar-$rows->jdiskon)/$totbayar*100;
					$tdiskon = 100-$tdiskon;
					$totbayar = rp($totbayar-$rows->jdiskon);
				}
				}else{
				$tdiskon = 0;
				$totbayar = 0;
			}
			
			if($oto==6)
			{ 
				$disabled = 'disabled';
				$script0 = <<< JS
				
				$("#pending,#bayarin").prop("disabled",true);
				
				JS;
				
				echo "<script>{$script0}</script>";
				
			}
			
			if($oto==5)
			{ 
				$disabled = 'disabled';
				$script1 = <<< JS
				
				$("#print,#pending,#bayarin,#simpan").prop("disabled",true);
				
				JS;
				
				echo "<script>{$script1}</script>";
				
			}
			
			if($oto==1){ 
				
				$script2 = <<< JS
				
				$("#pending,#bayarin,#simpan").prop("disabled",false);
				
				JS;
				
				echo "<script>{$script2}</script>";
				
				
			}
			if($oto==3)
			{ 
				$button_1 = 'disabled';$button_2 = 'readonly';
				
				$script3 = <<< JS
				
				$("#pending,#bayarin,#simpan").prop("disabled",false);
				
				JS;
				
				echo "<script>{$script3}</script>";
				
			}
			if($totbayar >0){ 
				$script4 = <<< JS
				
				$("#pending").prop("disabled",true);
				
				JS;
				
				echo "<script>{$script4}</script>";
				
			}
			if($cdetail==$totbayar AND $pos=='Y' AND $lunas==1 AND $oto !=3){
				$readonly = "readonly";
				$disabled = 'disabled';
				$button_lunas = 'disabled';
				$button_1 = 'disabled';
				$button_2 = 'readonly';
				$script5 = <<< JS
				
				$("#pending").prop("disabled",true);
				
				JS;
				
				echo "<script>{$script5}</script>";
				
			}
			
			// echo $total_bayar;
			
			if($type=='edit'){
				$readonly = '';
				$disabled = '';
				}elseif($type=='lunas'){
				$readonly = 'readonly';
				$button_1 = 'disabled';
				}elseif($type=='pelunasan'){
				$readonly = 'readonly';
				$button_1 = 'disabled';
				}elseif($type=='pending'){
				$readonly = 'readonly';
				}elseif($type=='view'){
				$readonly = 'readonly';
				}elseif($type=='batal'){
				$readonly = 'disabled';
				$button_2 = 'disabled';
			}
			if($id_konsumen==1){
				$button_1 = '';
				
			}
			$none = '';
			$nonee = '';
			if($this->session->level=='desain'){
				$none = 'style="display:none"';
				$nonee = 'display:none';
				$script6 = <<< JS
				
				$("#print").hide();
				$("#bayarin").hide();
				$(".pending").attr("disabled",false);
				JS;
				
				echo "<script>{$script6}</script>";
			}
			
		?>
		<input type="hidden" name="id_transaksi" id="id_transaksi" value="<?=$auto_number;?>">
		<input type="hidden" name="id_invoice" id="id_invoice" value="<?=$id_invoice;?>">
		<input type="hidden" name="id_konsumen" id="id_konsumen" value="<?=$id_konsumen;?>">
		<input type="hidden" name="idmember" id="idmember" value="<?=$idmember;?>">
		<input type="hidden" name="iduser" id="iduser" value="<?=$iduser;?>">
		<input type='hidden' id='idsesi' value="<?=$idsesi;?>" />
		<input type='hidden' id='idlunas' value="<?=$lunas;?>" />
		<input type='hidden' id='status' value="<?=$status;?>" />
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-none row">
					<div class="card-body py-0">
						<div class="row">
							<div class="col-md-4">
								<div class="card shadow-none row">
									<div class="card-header d-flex justify-content-between py-0">
										<h5 class="card-title"><strong id="namanya"><?=ucwords($nama);?></strong></h5>
										<div class="d-flex ">
											<div class="btn-group" role="group">
												<button type="button" data-id="<?=$id_invoice;?>" data-toggle='tooltip' title="Cari pelanggan" class="btn btn-primary btn-sm cari flat" <?=$button_1;?>><i class="fa fa-search fa-1x" ></i> [F2]</button>
												<button type="button"  data-id="<?=$id_invoice;?>" data-toggle='tooltip' title="Tambah pelanggan" class="btn btn-info btn-sm tambah flat" id="tambah" <?=$button_1;?>><i class="fa fa-user-plus fa-1x"></i> [F3]</button>
											</div>
										</div>
										
									</div>
									<div class="card-body py-0">
										Status : <span id="jenis_member"><?php echo $jenis_member; ?></span>
										<hr class="p-1 m-0">
										Telp: <span id="tlpnya"><?php echo $telp;?></span>
										<hr class="p-1 m-0">
										<form id="formcheckin">
											<div class="input-group input-group-sm mb-0">
												<input type="text" name="cari_produk" id="cari_produk"  class="form-control" placeholder="Cari produk/ scan barcode" <?=$button_lunas;?>>
												<input type="hidden" name="invoice_add" id="invoice_add" value="<?=$id_invoice;?>">
												<input type="hidden" name="idmember_add" id="idmember_add" value="<?=$idmember;?>">
												<input type="hidden" name="kodeproduk" id="kodeproduk">
												<input type="hidden" name="id_produk" id="id_produk">
												<input type="hidden" name="harga" id="harga">
												<input type="hidden" name="jenis_cetakan" id="jenis_cetakan">
												<input type="hidden" name="bahan" id="bahan">
												<input type="hidden" name="id_jenis" id="id_jenis">
												<input type="hidden" name="id_bahan" id="id_bahan">
												<input type="hidden" name="type_harga" id="type_harga">
												<input type="hidden" name="status_hitung" id="status_hitung">
												<input type="hidden" name="satuan" id="satuan_add">
												<input type="hidden" name="ukuran" id="ukuran">
												<input type="hidden" name="jumlah" id="jumlah">
												<input type="hidden" name="lock" id="lock">
												<input type="hidden" name="id_konsumen_cari" id="id_konsumen_cari" value="<?=$id_konsumen;?>">
												<div class="input-group-append">
													<button class="btn btn-outline-secondary" type="submit" id="button-simpan" <?=$button_lunas;?>>Tambah</button>
													<button class="btn btn-outline-secondary show_qr" type="button" <?=$button_lunas;?>>Scan</button>
												</div>
											</div>
										</form>
										
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-1">
									<div class="input-group">
										<span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
											<span class="input-group-text border-info bg-info col-12" data-toggle="tooltip" data-placement="right" title="Format MM/DD/YYYY">Tanggal Order</span>
										</span>
										<input type="date" class="form-control text-center tgl_invoice"  onchange="cektglpesan();" id="tgl_invoice" value="<?=$tgl_invoice;?>" <?=$button_2;?>>
									</div>
								</div>
								<div class="form-group mb-1">
									<div class="input-group">
										<span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
											<span class="input-group-text border-success bg-success col-12" data-toggle="tooltip" data-placement="right" title="Format MM/DD/YYYY">Tanggal Kirim</span>
										</span>
										<input type="date" class="form-control text-center" onchange="cektgl();" id="tgl_ambil" style="width:120px!important" value="<?=$tgl_ambil;?>" <?=$readonly;?>>
										<span class="input-group-text"><i class="fa fa-clock-o"></i></span>
										<input type="text" class="form-control text-center jam" onchange="cektgl()"
										id="jam_ambil"  value="<?=$jam_ambil;?>" placeholder="Jam" <?=$readonly;?>>
									</div>
								</div>
								<div class="form-group mb-1">
									<?php
										$pilih = pilih('tb_users','id_user',$marketing);
										$namamarketing=$pilih['nama_lengkap'];
										$id_user=$pilih['id_user'];
										// print_r($pilih);
									?>
									<input type="hidden" id="marketing" value="<?=$marketing;?>">
									
									<div class="input-group">
										<span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
											<span class="input-group-text border-primary bg-primary col-12">Kasir</span>
										</span>
										<input type="text" class="form-control" onchange="save_invoice()" id="namamarketing" value="<?=$namamarketing;?>" <?=$readonlym;?>  required <?=$button_2;?>>
									</div>
								</div>
							</div>
							<div class="col-md-4" <?=$none;?>>
								<div class="form-group mb-1">
									<div class="input-group">
										<span class="input-group-prepend col-3 ml-0 mr-0 pl-0 pr-0">
											<span class="input-group-text col-12">Pajak</span>
										</span>
										<input type="text" class="form-control text-center w-10" id="pajaksum" value="<?=$pajak;?>" readonly="readonly">
										<span class="input-group-prepend">
											<span class="input-group-text">Total Order</span>
										</span>
										<input type="text" class="form-control text-right w-30" id="totalSum" name="totalSum"
										readonly="readonly" aria-describedby="sizing-addon1">
									</div>
								</div>
								<div class="form-group mb-1">
									<div class="input-group">
										
										<span class="input-group-prepend col-3 ml-0 mr-0 pl-0 pr-0">
											<span class="input-group-text col-12">Total Bayar</span>
										</span>
										<input type="text" class="form-control text-right margin-5" id="uangmuka" value="<?=$totbayar;?>" readonly="readonly">
									</div>
								</div>
								<div class="form-group mb-1">
									<div class="input-group">
										<span class="input-group-prepend col-3 ml-0 mr-0 pl-0 pr-0">
											<span class="input-group-text border-danger bg-danger  col-12">Piutang</span>
										</span>
										<input type="text" class="form-control text-right margin-5" id="sisaSum" value="0"
										readonly="readonly">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class="col-md-12">
				<table class="table table-striped table-sm" id="tablein">
					<thead>
						<tr>
							<td width="10" class="p-0 align-middle">
								<button class="btn btn-primary btn-xs flat addmore" type="button" id="addmore" readonly><i class="fa fa-plus-circle fa-lg"></i></button>
								<button class="btn btn-danger btn-xs flat btnDelete text-white" id="btnDelete" type="button" data-toggle="tooltip" title="Hapus" <?=$disabled;?> style="display:none"><i class="fa fa-minus-circle fa-lg"></i></button>
							</td>
							<td>Produk</td>
							<td>Kategori</td>
							<td>Merk/Bahan</td>
							<td style="width:70px!important">Satuan</td>
							<td style="width:70px!important">Ukuran</td>
							<td class="text-center" style="width:100px!important">qty</td>
							<td style="width:120px!important;<?=$nonee;?>">@Harga</td>
							<!--td style="width:70px!important">Disc %</td-->
							<td class="text-right" <?=$none;?>>Sub Total</td>
							<td class="text-center"><i class="fa fa-cog"></i></td>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							$ni=1;
							// print_r($detail);
							$lock_harga = '';
							foreach($detail AS $val){
								$kunci = kunci_harga($val['id_produk']);
								if($kunci =='Y'){
									$lock_harga = 'readonly';
								}
								if($val['status_hitung']==2){
									$lock_status = '';
									}else{
									$lock_status = 'readonly';
								}
								$status_hitung = cek_hitung($val['idbahan']);
								$cek_type_harga = cek_type_harga($val['idbahan']);
							?>
							<tr id='rowCount<?=$no;?>' class="rowCount" >
								<td align="center">
									<input type='hidden' id='id_rincianinvoice_<?=$no;?>' value="<?=$val['id_rincianinvoice'];?>" />
									<input type='checkbox' class='case' id="case<?=$no;?>" <?=$disabled;?> />
								</td>
								<td>
									<div class="form-group p-0 m-0">
										<input class="form-control input-sm input" type='text' id='kodeproduk_<?=$no;?>'
										onchange="doMath()" value="<?=$val['title'];?>" onfocusout="sav(<?=$no;?>)"  <?=$readonly;?> />
										<input type='hidden' id='id_produk_<?=$no;?>' value="<?=$val['id'];?>" />
									</div>
								</td>
								<td>
									<div class="form-group p-0 m-0">
										<input type="text" class="form-control input-sm input" value="<?=$val['jenis'];?>" id="jenis_cetakan_<?=$no;?>" placeholder="jenis"  onfocusout="sav(<?=$no;?>)" <?=$readonly;?> readonly>
										<input type='hidden' id='id_jenis_<?=$no;?>' value="<?=$val['id_jenis'];?>" />
										<input type='hidden' class="input" id='status_hitung_<?=$no;?>' value="<?=$status_hitung;?>" />
										<input type='hidden' class="input" id='type_harga_<?=$no;?>' value="<?=$cek_type_harga;?>" />
									</div>
								</td>
								
								<td>
									<div class="form-group p-0 m-0">
										<input type="text" class="form-control input-sm input"
										placeholder="bahan" onchange="sav(<?=$no;?>);hitflexi(<?=$no;?>);doMath();" id="bahan_<?=$no;?>" placeholder="0" 
										value="<?=$val['nbahan'];?>" <?=$readonly;?> />
										<input type='hidden' id='id_bahan_<?=$no;?>' value="<?=$val['idbahan'];?>" onfocusout="sav(<?=$no;?>)" />
									</div>
								</td>
								<td>
									<div class="form-group p-0 m-0">
										<select name="satuan_<?=$no;?>" id="satuan_<?=$no;?>" class="form-control form-control-sm rounded-0 next"  data-valueKey="id" data-displayKey="name" required <?=$readonly;?> onchange="harga_satuan(<?=$no;?>);doMath();sav(<?=$no;?>);" <?=$lock_status;?>>
										</select>
										<input type="hidden" class="form-control input-sm input" value="<?=$val['id_satuan'];?>" onchange="sav(<?=$no;?>)" id="id_satuan_<?=$no;?>"  required readonly />
									</div>
								</td>
								<td>
									<div class="form-group p-0 m-0">
										<input type="text" value="<?=$val['ukuran'];?>" class="form-control input-sm ukur pilih" onchange="hitflexi(<?=$no;?>);doMath();sav(<?=$no;?>);"
										id="ukuran_<?=$no;?>"  <?=$readonly;?>/>
										<input type='hidden' id='totukuran_<?=$no;?>' value="<?=$val['tot_ukuran'];?>" />
									</div>
								</td>
								<td>
									<div class="form-group p-0 m-0">
										<input type="number" class="form-control input-sm pilih ukur text-center next" value="<?=$val['jumlah'];?>"
										onchange="harga_range(<?=$no;?>);doMath();sav(<?=$no;?>);" onclick="harga_range(<?=$no;?>);hitflexi(<?=$no;?>);doMath();sav(<?=$no;?>);" onkeyup='formatNumber(this)' id="jumlah_<?=$no;?>" placeholder="0" min="1" max="50000" <?=$readonly;?>/>
									</div>
								</td>
								<td <?=$none;?>>
									<div class="form-group p-0 m-0">
										<input type="text" class="form-control input-sm input next" value="<?=rp($val['harga']);?>"
										onchange="doMath();sav(<?=$no;?>)" onkeyup='formatNumber(this)' id="harga_<?=$no;?>" placeholder="0" <?=$readonly;?> <?=$lock_harga;?> />
										<input class="form-control text-center input-sm input" type="hidden" id="diskon_<?=$no;?>" value="<?=$val['diskon'];?>" onchange="sav(<?=$no;?>)" min="0" max="99" <?=$readonly;?> >
									</div>
								</td>
								<td class="text-right" <?=$none;?>>
									<div class="form-group p-0 m-0">
										<input type="text" class="form-control input-sm totalsz text-right" id="total_<?=$no;?>" placeholder="0" readonly />
									</div>
								</td>
								<td>
									<div class="form-group p-0 m-0">
										<button type="button" id='button_<?=$no;?>'
										class='btn btn-warning btn-sm flat' data-toggle='tooltip' title="Finishing" onclick="getproduk(<?=$no;?>)"
										<?=$disabled;?>><i class="fa fa-ellipsis-h"></i></button>
									</div>
								</td>
							</tr>
						<?php $no++;$ni++;} ?>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
	<input type="hidden" name="baris" id="baris" value="<?=$no;?>">
	<input type="hidden" name="idnya" id="idnya" value="<?=$id_invoice;?>">
	
	
	
	<script>
		
		
		function onScanSuccess(decodedText, decodedResult) {
			// console.log(`Code scanned = ${decodedText}`, decodedResult);
			$("#cari_produk").val(decodedText);
			$("#formcheckin").submit();
			$("#button-qr").modal('hide');
			html5QrcodeScanner.clear();
		}
		
		
		$(document).on('click','.show_qr',function(e){
			e.preventDefault();
			$('#cari_qr').val('');
			var html5QrcodeScanner = new Html5QrcodeScanner(
			"qr-reader", { fps: 10, qrbox: 250 });
			
			html5QrcodeScanner.render(onScanSuccess);
			$('#button-qr').modal({backdrop: 'static', keyboard: false});
			
		});
		
		setTimeout(function() {
			$("#cari_produk").focus();
		}, 500);
		
		$('#formcheckin').submit(function(e){
			e.preventDefault();
			e.stopPropagation()
			// console.log('submit');
			if($("#cari_produk").val()==''){
				$("#cari_produk").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#cari_produk").focus();
				return;
			}
			var id_detail = $('#tablein > tbody tr').length;
			// var maindata = $("#formcheckin").serialize();
			var data_save = $('#formcheckin').serializeArray();
			data_save.push({ name: id_detail});
			// var id_konsumen_cari = $("#id_konsumen_cari").val();
			const maindata = $('#formcheckin').serializeArray().concat({
				name: "id_detail", value: id_detail
			});
			
			$.ajax({
				url : base_url + "penjualan/cek_harga_type",
				type : "POST",
				data: maindata,
				dataType : "json",
				success : handleMember
			});
			
			
		});
		
		function handleMember(response)
		{
			// console.log(response);
			// id_detail = $('#tablein > tbody tr').length;
			
			if(response.status=='qr')
			{
				
				var id_detail = response.iddetail;
			 	var id_bahan = response.id_bahan;
			 	var status_hitung = response.status_hitung;
			 	var ukuran = response.ukuran;
			 	var harga = response.harga;
				
				add_more(id_detail,id_bahan,status_hitung,ukuran,harga)
				// $(".addmore").click();
				load_satuan(id_detail,response.id_satuan);
				// console.log(id_detail);
				// console.log(response.id_bahan);
				$("#id_rincianinvoice_" + a).val(response.id);
				$('#kodeproduk_' + id_detail).val(response.kodeproduk);
				$('#id_produk_' + id_detail).val(response.id_produk);
				$('#harga_' + id_detail).val(response.harga);
				$('#diskon_' + id_detail).val(0);
				$('#jenis_cetakan_' + id_detail).val(response.jenis_cetakan);
				$('#bahan_' + id_detail).val(response.bahan);
				$('#id_bahan_' + id_detail).val(response.id_bahan);
				$('#id_jenis_' + id_detail).val(response.id_jenis);
				$('#status_hitung_' + id_detail).val(response.status_hitung);
				$('#type_harga_' + id_detail).val(response.type_harga);
				$('#id_satuan_' + id_detail).val(response.id_satuan);
				$('#ukuran_' + id_detail).val(response.ukuran);
				// $('#totukuran_' + id_detail).val(1);
				$('#jumlah_' + id_detail).val(response.jumlah);
				$('#lock_' + id_detail).val(response.lock_harga);
				$('#satuan_' + id_detail).val(response.id_satuan);
				
				$('#satuan_'+a.toString()+'  option[value="'+satuan_add+'"]').prop("selected", true);
				// $('#satuan_' + id_detail).attr('readonly',true);
				if(response.lock_harga=='Y'){
					$('#harga_' + id_detail).attr('readonly',true);
				}
				if(type_harga==2){
					$('#satuan_' + id_detail).attr('readonly',false);
				}
				
				
				setTimeout(function() {
					saved(id_detail)
				}, 3000);
				
				}else if(response.status==false){
				$("#cari_produk").focus();
				showNotif('top-center','Input Data',response.msg,'warning');
				}else{
				var id_produk = $("#id_produk").val();
				var kodeproduk_ = $("#kodeproduk").val();
				var harga_ = $("#harga").val();
				var jenis_cetakan_ = $("#jenis_cetakan").val();
				var bahan_ = $("#bahan").val();
				var id_jenis_ = $("#id_jenis").val();
				var id_bahan_ = $("#id_bahan").val();
				var status_hitung = $("#status_hitung").val();
				var type_harga = $("#type_harga").val();
				var satuan_add = parseInt($("#satuan_add").val());
				var ukuran_ = $("#ukuran").val();
				var jumlah_ = $("#jumlah").val();
				var lock_ = $("#lock").val();
				
				id_detail = $('#tablein > tbody tr').length;
				$(".addmore").click();
				load_satuan(id_detail,satuan_add);
				
				$('#kodeproduk_' + id_detail).val(kodeproduk_);
				$('#id_produk_' + id_detail).val(id_produk);
				$('#harga_' + id_detail).val(response.harga);
				$('#diskon_' + id_detail).val(0);
				$('#jenis_cetakan_' + id_detail).val(jenis_cetakan_);
				$('#bahan_' + id_detail).val(bahan_);
				$('#id_jenis_' + id_detail).val(id_jenis_);
				$('#id_bahan_' + id_detail).val(id_bahan_);
				$('#status_hitung_' + id_detail).val(status_hitung);
				$('#type_harga_' + id_detail).val(type_harga);
				$('#id_satuan_' + id_detail).val(satuan_add);
				$('#ukuran_' + id_detail).val(ukuran_);
				$('#jumlah_' + id_detail).val(jumlah_);
				$('#lock_' + id_detail).val(lock_);
				$('#satuan_' + id_detail).val(satuan_add);
				
				$('#satuan_'+a.toString()+'  option[value="'+satuan_add+'"]').prop("selected", true);
				// $('#satuan_' + id_detail).attr('readonly',true);
				if(lock_=='Y'){
					$('#harga_' + id_detail).attr('readonly',true);
				}
				if(type_harga==2){
					$('#satuan_' + id_detail).attr('readonly',false);
				}
				doMath();
				setTimeout(function() {
					saved(id_detail)
				}, 3000);
				
			}
			reset_input()
		}
		function reset_input()
		{
			$('#cari_produk').val('');
			$('#kodeproduk').val('');
			$('#id_produk').val('');
			$('#harga').val('');
			$('#jenis_cetakan').val('');
			$('#bahan').val('');
			$('#id_jenis').val('');
			$('#id_bahan').val('');
			$('#type_harga').val('');
			$('#status_hitung').val('');
			$('#satuan').val('');
			$('#ukuran').val('');
			$('#jumlah').val('');
			$('#lock').val('');
		}
		
		doMath();
		window.onload = doMath;	
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		// $('#table').arrowTable();
		$(document).fcs(".next");
	</script>
<?php }else{ echo "error";} ?>

<style>
	.img-responsive-height
	{
	display: block;
	width: auto;
	max-height: 500px
	}
	input[readonly] {
	pointer-events: none;
	}
	#tablein thead tr td{text-transform:uppercase}
	.card.shadow-none {
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
	}
	
	.form-control {
	border-radius: 0 !important;
	}
	
	.input-group .form-control:last-child,
	.input-group-prepend:last-child,
	.input-group-btn:first-child>.btn-group:not(:first-child)>.btn,
	.input-group-btn:first-child>.btn:not(:first-child),
	.input-group-btn:last-child>.btn,
	.input-group-btn:last-child>.btn-group>.btn,
	.input-group-btn:last-child>.dropdown-toggle {
	border-top-left-radius: 0px !important;
	border-bottom-left-radius: 0px !important;
	
	}
	
	.input-group-lg>.input-group-prepend>.input-group-text {
	padding: .5rem 1rem;
	font-size: 1.25rem;
	line-height: 1.5;
	border-radius: 0;
	}
	
	.input-group-prepend span {
	-webkit-box-shadow: 0 0.125rem 0.25rem 0 rgba(58, 59, 69, 0.2) !important;
	box-shadow: 0 0.125rem 0.25rem 0 rgba(58, 59, 69, 0.2) !important;
	color: #fff;
	background-color: #888888;
	border-color: #777777;
	}
	
	.input-group-text {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-align: center;
	-ms-flex-align: center;
	align-items: center;
	padding: .375rem .75rem;
	margin-bottom: 0;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.5;
	color: #6e707e;
	text-align: center;
	white-space: nowrap;
	background-color: #eaecf4;
	border: 1px solid #d1d3e2;
	border-top-color: rgb(209, 211, 226);
	border-right-color: rgb(209, 211, 226);
	border-bottom-color: rgb(209, 211, 226);
	border-left-color: rgb(209, 211, 226);
	border-radius: 0;
	
	}
	
	.btnDelete {
	cursor: pointer;
	color: red
	}
	.addmore{
	pointer-events: none;
	cursor: not-allowed! important;
	}
	
</style>				