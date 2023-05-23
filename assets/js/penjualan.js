$(document).ready(function() {
	cek_idawal();
	
	var idprint = $("#id_invoice").val();
	var id_trx = $("#id_transaksi").val();
	
	$('#print,#simpan,#cari').attr("data-id",idprint); 
	$('.tinvoice').html(id_trx); 
	$('#id_nya').val(idprint); 
	$('#bayarin').attr("data-id",idprint); 
    $(".btnDelete").hide();
	var rowCount = 0;
    $(".addmore").on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
        i = $('#tablein > tbody tr').length;
		count=$('#tablein tr').length;	
		if(i >= max_item){
			sweet('Peringatan!!!','Order maksimal '+max_item +' item','warning','warning');	
			return;
		}
		insert_invoice_detail(i);
        var cols = '<tbody>';
		cols += '<tr id="rowCount' + i + '" class="rowCount">';
        cols += '<td align="center"><input type="hidden" id="id_rincianinvoice_'+i+'" /><input type="checkbox" class="case" id="case'+i+'" /></td>';
		cols += '<td><div class="form-group p-0 m-0"><input class="form-control input-sm kodeproduk" type="text" id="kodeproduk_'+i+'" onchange="doMath()" onfocusout="sav('+i+')" /><input type="hidden" id="id_produk_'+i+'" /></div></td>'
		cols += '<td><div class="form-group p-0 m-0"> <input type="text" class="form-control input-sm input" id="jenis_cetakan_'+i+'" placeholder="-" onfocusout="sav('+i+')" readonly> <input type="hidden" id="id_jenis_'+i+'" /><input type="hidden" id="status_hitung_'+i+'" /><input type="hidden" id="type_harga_'+i+'" /></div></td>'
		
		cols += '<td><div class="form-group p-0 m-0"><input type="text" class="form-control input-sm input" placeholder="-" onchange="hitflexi('+i+');sav('+i+');doMath();" id="bahan_'+i+'" placeholder="0" /> <input type="hidden" id="id_bahan_'+i+'" onfocusout="sav('+i+')" /></div></td>';
		cols += '<td><div class="form-group p-0 m-0"><select onchange="harga_satuan('+i+');doMath();sav('+i+')" name="satuan_'+i+'" id="satuan_'+i+'" class="form-control form-control-sm form-control-sm rounded-0 next" data-valueKey="id" data-displayKey="name" required></select><input type="hidden" class="form-control input-sm" id="id_satuan_'+i+'"/></div></td>';
		cols += '<td><div class="form-group p-0 m-0"> <input type="text" class="form-control input-sm ukur" onchange="hitflexi('+i+');doMath();sav('+i+');" id="ukuran_'+i+'" /> <input type="hidden" id="idukuran_'+i+'" /><input type="hidden" id="totukuran_'+i+'" /></div></td>'
		cols += '<td><div class="form-group p-0 m-0"> <input type="number" class="form-control input-sm ukur text-center next" onclick="harga_range('+i+');hitflexi('+i+');doMath();sav('+i+')" onchange="harga_range('+i+');hitflexi('+i+');doMath();sav('+i+')"  onkeyup="formatNumber(this)" id="jumlah_'+i+'" value="1" min="1" max="50000" /></div></td>';
		if(level=='desain'){
			cols += '<td style="display:none"><div class="form-group p-0 m-0"> <input type="text" class="form-control input-sm input next" onchange="doMath();sav('+i+')" onkeyup="formatNumber(this)" id="harga_'+i+'" placeholder="0" /><input class="form-control text-center input-sm" type="hidden" id="diskon_'+i+'" value="0" onchange="doMath();sav('+i+')" min="0" max="99" ></div></td>';
			cols += '<td class="text-right" style="display:none"><div class="form-group p-0 m-0"><input type="text" class="form-control input-sm totalsz text-right" id="total_'+i+'" placeholder="Rp.0" readonly /></div></td>';
			}else{
			cols += '<td><div class="form-group p-0 m-0"> <input type="text" class="form-control input-sm input next" onchange="doMath();sav('+i+')" onkeyup="formatNumber(this)" id="harga_'+i+'" placeholder="0" /><input class="form-control text-center input-sm" type="hidden" id="diskon_'+i+'" value="0" onchange="doMath();sav('+i+')" min="0" max="99" ></div></td>';
			cols += '<td class="text-right"><div class="form-group p-0 m-0"><input type="text" class="form-control input-sm totalsz text-right" id="total_'+i+'" placeholder="Rp.0" readonly /></div></td>';
		}
		
		
		cols += '<td><div class="form-group p-0 m-0"><button type="button" id="button_'+i+'" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Finishing" onclick="getproduk('+i+')" disabled>...</button></div></td>';
        cols += '</tr></tbody>';
        $('#tablein').append(cols);
		// $("#kodeproduk_"+i).focus();
		$("#jumlah_"+i).focus();
		$("#jumlah_"+i).change(function() {
			if($("#jumlah_"+i).val()==0 || $("#jumlah_"+i).val()==''){
				$("#jumlah_"+i).val(1);
			}
		});
		$(document).fcs(".input-sm");
        
        $('.input, .pilih, .kodeproduk').click(function() {
			this.select();
		});
		$('#tablein >tbody input[type="checkbox"]').click(function() {
			var rowCount = $("#tablein > tbody tr").children().length;
			var countcheck = $('#tablein > tbody input[type="checkbox"]:checked').length;
			
			if (countcheck == 0) {
				$(".btnDelete").hide();
				$(".addmore").show();
			}
			if (countcheck > 0) {
				$(".btnDelete").show();
				$(".addmore").hide();
				shortcut.add("ctrl+d",function() {
					$(".btnDelete").click();
				});
			}
			if (countcheck >= rowCount) {
				sweet('Peringatan!!!','Sisain satu baris jangan di hapus semua','warning','warning');
				$(".btnDelete").attr("disabled", true);
				$(".btnDelete").css("color", "#000");
				} else {
				$(".btnDelete").attr("disabled", false);
				$(".btnDelete").css("color", "#ff0000");
			}
		});
		$("#btnDelete").on('click', function() {
			
            if ($('#case' + i).length) {
                if (document.getElementById("case" + i.toString()).checked == true) {
                    kodeinvo = document.getElementById("id_rincianinvoice_" + i.toString()).value;
                    hapus_invoice_detail(kodeinvo);
					
                    jQuery('#rowCount' + i.toString()).remove();i--;
					return;
				}
			}
			
			$(".btnDelete").hide();
			$("#addmore").show();
			$("#tablein tr.rowCount input:checkbox").attr("disabled", false);
			doMath();
		});
        
		var id_konsumen = $('#id_konsumen').val();
		produk_cari(i);
		// load_satuan(i);
		bahan_cari(i,id_konsumen);
		jenis_cari(i);
		doMath();
		i++;
		
		var inputWdithReturn = '100%';
		$('.ukur').focus(function() {
			if ($(this).attr('id').substring(0, 6) == 'jumlah') {
				inputWdith = '100px';
				
				} else if ($(this).attr('id').substring(0, 6) == 'ukuran') {
				inputWdith = '120px';
				} else if ($(this).attr('id').substring(0, 6) == 'satuan') {
				inputWdith = '100px';
			} else { inputWdith = '100px';}
			$(this).animate({
				width: inputWdith
			}, 400)
		});
		
		$('.ukur').blur(function() {
			$(this).animate({
				width: inputWdithReturn
			}, 500)
		});
		
		$('.totalsz').focus(function() {
			inputWdith = '170px';
			$(this).animate({
				width: inputWdith
			}, 400)
			var nourut = $(this).attr('id').substring(0, 5);
			$('#total_' + nourut).animate({
				width: '120px'
			}, 400)
			
		});
		
		
		$('.totalsz').blur(function() {
			$(this).animate({
				width: inputWdithReturn
			}, 500)
			
		});
		$('.input').focus(function() {
			if ($(this).attr('id').substring(0, 5) == 'bahan') {
				inputWdith = '200px';
				} else if ($(this).attr('id').substring(0, 5) == 'jenis') {
				inputWdith = '150px';
				} else if ($(this).attr('id').substring(0, 6) == 'diskon') {
				inputWdith = '100px';
				} else if ($(this).attr('id').substring(0, 5) == 'harga') {
				inputWdith = '150px';
				} else if ($(this).attr('id').substring(0, 11) == 'hargasatuan') {
				inputWdith = '150px';
			} else { inputWdith = '200px'; }
			$(this).animate({
				width: inputWdith
			}, 400)
		});
		
		$('.input').blur(function() {
			$(this).animate({
				width: inputWdithReturn
			}, 500)
		});
		
	}); 
	
	
	
	function insert_invoice_detail(a) {
		var str = $("#id_invoice").val();
		$.ajax({
			type: "POST",
			url: base_url + "penjualan/add_detail",
			data: { id: str },
			dataType: "json",
			success: function(res) {
				if (res.status == 200) {
					$("#id_rincianinvoice").val(res.idr);
					$("#id_rincianinvoice_" + a).val(res.idr);
					} else {
					alert('error');
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	
	$('#tablein >tbody input[type="checkbox"]').click(function() {
		var rowCount = $("#tablein > tbody").children().length;
		var countcheck = $('#tablein > tbody input[type="checkbox"]:checked').length;
		
		if (countcheck == 0) {
			$(".btnDelete").hide();
			$("#addmore").show();
		}
        if (countcheck > 0) {
            $(".btnDelete").show();
            $("#addmore").hide();
			shortcut.add("ctrl+d",function() {
				$(".btn_Delete").click();
			});
		}
        if (countcheck >= rowCount) {
			sweet('Peringatan!!!','Sisain satu baris jangan di hapus semua','warning','warning');
			
			$(".btnDelete").css("color", "#000");
            $("#btnDelete").attr("disabled", true);
            
			} else {
			$(".btnDelete").css("color", "#ff0000");
            $(".btnDelete").attr("disabled", false);
            
		}
	});
	
	$(".btnDelete").on('click', function() {
		
		b = $("#tablein > tbody").children().length;
		for (var aa = 0; aa < b; aa++) {
			if ($('#case' + aa).length) {
				if (document.getElementById("case" + aa.toString()).checked == true) {
					kodeinvo = document.getElementById("id_rincianinvoice_" + aa.toString()).value;
					hapus_invoice_detail(kodeinvo);
					jQuery('#rowCount' + aa.toString()).remove();aa--;
				}
			}
		}
		$(".btnDelete").hide();
		$("#addmore").show();
		$("#tablein tr.rowCount input:checkbox").attr("disabled", false);
		doMath();
	});
});
$(document).on('click', '#pending', function() {
	var id = $("#id_invoice").val();
	$.ajax({
		url: base_url + 'penjualan/pending_data',
		data: {id: id},
		method: 'POST',
		dataType:"json",
		success: function(data) {
			if(data.ok=='ok'){
				sweet('Pending!!!','Order berhasil dipending','success','success');
				$('#OpenCart-1').modal('hide');
				searchFilter();
				}else if(data.ok=='pending'){
				sweet('Pending!!!','Order masih dipending','success','success');
				$("#pending").prop("disabled",true);
				}else{
				sweet('Pending!!!','Order gagal dipending','warning','warning');
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
		}
	})
});
function hapus_invoice_detail(c) {
    var str = c;
    $.ajax({
        type: "POST",
        url: base_url + "penjualan/hapus_detail",
        data: { idr: str },
        success: function(data) {
			if(data.status==200){
				console.log(data.msg)
				}else{
				console.log(data.msg)
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
		}
	});
}


$('.cariada').tooltip('show');
$('.cariada').tooltip();

function cektglpesan() {
    
    var startDate = $("#tgl_invoice").val();
	
	var d = new Date();
	month = (d.getMonth()+1).toString().padStart(2, "0");
	day = (d.getDate()).toString().padStart(2, "0");
	var today = d.getFullYear() +"-"+ month + "-" +day;
	
	if(startDate > today){
		sweet('Peringatan!!!','tanggal order harus sesuai!!','error','danger');
		$("#tgl_invoice").val(today);
		return;
	}
	
	save_invoice();
	
}

function cektgl() {
    var tgl_invoice = $("#tgl_invoice").val();
    var tgl_ambil = $("#tgl_ambil").val();
    var jam_ambil = $("#jam_ambil").val();
	var d = new Date();
	month = (d.getMonth() + 1).toString().padStart(2, "0");
	day = (d.getDate()).toString().padStart(2, "0");
	var today = d.getFullYear() +"-"+ month + "-" +day;
	var jam_today = d.getHours() + ":" + d.getMinutes();;
	
	if(tgl_invoice < today || tgl_invoice > today){
		sweet('Peringatan!!!','tanggal order tidak sesuai!!','error','danger');
		$("#tgl_invoice").val(today);
		return;
	}
	if(tgl_ambil < today && jam_ambil < jam_today){
		sweet('Peringatan!!!','tanggal / jam pengambilan tidak sesuai!!','error','danger');
		$("#tgl_ambil").val(today);
		return;
	}
	
	save_invoice();
}

function save_invoice() {
	var id = $("#id_invoice").val();
	var tglin = $("#tgl_invoice").val();
	var tglambil = $("#tgl_ambil").val();
	var jamambil = $("#jam_ambil").val();
	var marketing = $("#marketing").val();
	$.ajax({
		url: base_url+"penjualan/auto_save_invoice",
		type: "POST",
		data: {id:id,tglin:tglin,tgla:tglambil,jam:jamambil,marketing:marketing},
		dataType: "json",
		success: function(arr) {
			
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!','error','warning','warning');
		}
	});
}

function sav(a) {
	
	
    ukuran            = $("#ukuran_" + a.toString()).val(); 
    totukuran         = $("#totukuran_" + a.toString()).val(); 
    id_invoice        = $("#id_invoice").val(); 
    totalSum          = angka($("#totalSum").val()); 
    uangmuka          = angka($("#uangmuka").val()); 
    id_produk         = $("#id_produk_" + a.toString()).val(); 
    jumlah            = angka($("#jumlah_" + a.toString()).val()); 
    harga             = angka($("#harga_" + a.toString()).val()); 
    id_rincianinvoice = $("#id_rincianinvoice_" + a.toString()).val(); 
    satuan            = $("#satuan_" + a.toString()).val(); 
    id_bahan          = $("#id_bahan_" + a.toString()).val(); 
    jenis          	  = $("#id_jenis_" + a.toString()).val(); 
    diskon            = angka($("#diskon_" + a.toString()).val()); 
    type_harga        = $("#type_harga_" + a.toString()).val(); 
    status_hitung     = $("#status_hitung_" + a.toString()).val(); 
	// console.log(satuan);
	$.ajax({
		url: base_url+"penjualan/auto_save_invoice_detail",
		type: "POST",
		data: {id_invoice:id_invoice,
			id_produk:id_produk,
			jumlah:jumlah,
			harga:harga,
			id_rincianinvoice:id_rincianinvoice,
			ukuran:ukuran,
			totukuran:totukuran,
			satuan:satuan,
			id_bahan:id_bahan,
			jenis:jenis,
			diskon:diskon,
			jml:totalSum,
			uangmuka:uangmuka,
			type_harga:type_harga,
			status_hitung:status_hitung
		},
		dataType: "json",
		success: function(arr) {
			$("#button_" + a.toString()).attr('disabled',false);
			if(arr.status==400){
				sweet('Peringatan!!!','Maaf data tidak bisa di update','warning','warning');
				$("#jumlah_" + a.toString()).val(arr.jml);
				$("#harga_" + a.toString()).val(arr.harga);
				$("#diskon_" + a.toString()).val(arr.diskon);
				}else if(arr.status==401){
				sweet_time(2500, "Peringatan!!!", arr.msg);
				$("#harga_" + a.toString()).val(arr.harga);
				$("#hargasatuan_" + a.toString()).val(0); 
				$("#hargasatuan_" + a.toString()).focus(); 
			}
			// doMath();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
		}
	});
	
}

$(document).ready(function() {
    var inputWdithReturn = '100%';
	
	$('.ukur').focus(function() {
        if ($(this).attr('id').substring(0, 6) == 'jumlah') {
            inputWdith = '100px';
			} else if ($(this).attr('id').substring(0, 6) == 'ukuran') {
            inputWdith = '120px';
			} else if ($(this).attr('id').substring(0, 6) == 'satuan') {
            inputWdith = '100px';
		} else { inputWdith = '100px'; }
        $(this).animate({
            width: inputWdith
		}, 400)
	});
	
    $('.ukur').blur(function() {
        $(this).animate({
            width: inputWdithReturn
		}, 500)
	});
	
	$('.totalsz').focus(function() {
        inputWdith = '170px';
        $(this).animate({
            width: inputWdith
		}, 400)
        var nourut = $(this).attr('id').substring(0, 5);
        $('#total_' + nourut).animate({
            width: '120px'
		}, 400)
		
	});
	$('.totalsz').blur(function() {
        $(this).animate({
            width: inputWdithReturn
		}, 500)
		
	});
    $('.input').focus(function() {
        if ($(this).attr('id').substring(0, 5) == 'bahan') {
            inputWdith = '200px';
			} else if ($(this).attr('id').substring(0, 5) == 'jenis') {
            inputWdith = '150px';
			} else if ($(this).attr('id').substring(0, 6) == 'diskon') {
			inputWdith = '100px';
			} else if ($(this).attr('id').substring(0, 5) == 'harga') {
            inputWdith = '150px';
			} else if ($(this).attr('id').substring(0, 11) == 'hargasatuan') {
            inputWdith = '150px';
		} else { inputWdith = '200px'; }
        $(this).animate({
            width: inputWdith
		}, 400)
	});
	
    $('.input').blur(function() {
        $(this).animate({
            width: inputWdithReturn
		}, 500)
	});
	$("#jumlah_0").change(function() {
		if($("#jumlah_0").val()==0 || $("#jumlah_"+i).val()==''){
			$("#jumlah_0").val(1);
		}
	});
});

function cari_harga(a,idbahan,id_member,jml,totukuran) {
    var result="";
    $.ajax({
		url:base_url + "produk/cari_harga",
		"data" : {
			id : idbahan,
			id_member : id_member,
			jml : jml,
			totukuran : totukuran
		},
		async: false,  
		dataType:'json',
		success:function(data) {
			if(data.status==false){
				showNotif('top-center','Input Data',data.msg,'warning');
				$("#jumlah_" + a.toString()).val(0);
				return;
			}
			$("#satuan_" + a.toString()).val(data.satuan);
			result = data.harga; 
		}
	});
	return result;
}
function hitflexi(a) {
    var id_member = document.getElementById("idmember").value;
    var idbahan = document.getElementById("id_bahan_" + a.toString()).value;
    var jml = document.getElementById("jumlah_" + a.toString()).value;
    var stat = document.getElementById("status_hitung_" + a.toString()).value;
	
    var jc = document.getElementById("id_jenis_" + a.toString()).value;
    var ukuran = document.getElementById("ukuran_" + a.toString()).value;
	if(ukuran==''){
		var h = cari_harga(a,idbahan,id_member,jml,1);
		document.getElementById("harga_" + a.toString()).value = formatMoney(h);
		return;
	}
	var harga = angka(document.getElementById("harga_" + a.toString()).value);
	
	if (stat >0) {
		var separators = ['X', '\\\+', 'x', '\\\(', '\\\)', '\\*', '/', ':', '\\\?'];
		var sum2 = ukuran.toString().replace(/\,/g, '.');
		var data = sum2.split(new RegExp(separators.join('|'), 'g'));
		var l = parseFloat(data[0]);
		var p = parseFloat(data[1]);
		hasil = p * roundToHalf(l);
		hasil2 = p * l;
		
		var hh = cari_harga(a,idbahan,id_member,jml,hasil2);
		// console.log(hasil2);
		document.getElementById("totukuran_" + a.toString()).value = hasil2;
		document.getElementById("harga_" + a.toString()).value = formatMoney((p * l) * angka(hh));
		// document.getElementById("harga_" + a.toString()).value = formatMoney(hh);
		} else {
		
		document.getElementById("harga_" + a.toString()).value = formatMoney(harga);
	}
	// console.log(harga)
	// doMath();
}
function roundToHalf(value) {
    var converted = parseFloat(value); 
    var decimal = (converted - parseInt(converted, 10));
    decimal = Math.round(decimal * 10);
    if (converted > 2 && converted < 3) {
		return (parseInt(converted, 10) + 1);
	}
    if (converted > 0 && converted < 1) {
        return (1);
	}
    if (decimal == 5) { return (parseInt(converted, 10) + 0.5); }
    if ((decimal < 1) || (decimal > 5)) {
        return Math.round(converted);
		} else {
        return (parseInt(converted, 10) + 0.5);
	}
}


function harga_range(x){
	var id_member = $('#id_konsumen').val();
	var id_bahan = $('#id_bahan_' + x).val();
	var harga = angka($('#harga_' + x).val());
	var jumlah = $('#jumlah_' + x).val();
	var status = $('#type_harga_' + x).val();
	var totukuran = $('#totukuran_' + x).val();
	var status_hitung = $('#status_hitung_' + x).val();
	if(status_hitung==0){
		return;
	}
	$.ajax({
		"url" : base_url + "penjualan/cek_harga_range",
		"data" : {
			id_member : id_member,
			id_bahan : id_bahan,
			harga : harga,
			jumlah : jumlah,
			totukuran : totukuran,
			status : status
		},
		"method" : "POST",
		dataType:'json',
		success : function(response) {
			// console.log(response)
			if(response.status==true){
				if(response.type_harga==4 || response.type_harga==5){
					$('#harga_'+x).val(formatMoney(response.harga));
					hitflexi(x)
					}else{
					$('#harga_'+x).val(formatMoney(response.harga));
				}
				// sav(x);
				}else{
				sweet("Peringatan!!!", response.msg, "warning", "warning");
				$('#jumlah_'+x).val(response.stok);
			}
			
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
function harga_satuan(x){
	var id_bahan = $('#id_bahan_' + x).val();
	var satuan = $('#satuan_' + x).val();
	var harga = $('#harga_' + x).val();
	var jumlah = $('#jumlah_' + x).val();
	var status = $('#type_harga_' + x).val();
	var totukuran = $('#totukuran_' + x).val();
	var idmember = $('#idmember').val();
	$.ajax({
		"url" : base_url + "penjualan/cek_harga_satuan",
		"data" : {
			satuan : satuan,
			id_bahan : id_bahan,
			harga : harga,
			jumlah : jumlah,
			totukuran : totukuran,
			idmember : idmember,
			status : status
		},
		"method" : "POST",
		dataType:'json',
		success : function(response) {
			// console.log(response)
			if(response.status==true){
				$('#harga_'+x).val(response.harga);
				$('#satuan_'+x).val(response.satuan);
				$('#id_satuan_'+x).val(response.satuan);
				}else{
				sweet("Peringatan!!!", response.msg, "warning", "warning");
				$('#jumlah_'+x).val(response.stok);
			}
			doMath();
			sav(x);
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
function produk_cari(x){
	$('#kodeproduk_' + x).autocomplete({
		source: function(request, response) {
			$.ajax({
				url: base_url + 'produk/ajax',
				dataType: "json",
				method: 'POST',
				data: {
					name_startsWith: request.term,
					type: 'produk_table',
					row_num: 1
				},
				success: function(data) {
					response($.map(data, function(item) {
						var code = item.split("|");
						return {
							label: code[0],
							value: code[0],
							data: item
						}
					}));
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
		},
		autoFocus: true,
		minLength: 0,
		select: function(event, ui) {
			var names = ui.item.data.split("|");
			id_arr = $(this).attr('id');
			id = id_arr.split("_");
			$('#kodeproduk_' + id[1]).val(names[0]);
			$('#harga_' + id[1]).val(names[1]);
			$('#id_produk_' + id[1]).val(names[2]);
			$('#jenis_cetakan_' + id[1]).val(names[3]);
			$('#bahan_' + id[1]).val(names[4]);
			$('#id_jenis_' + id[1]).val(names[5]);
			$('#id_bahan_' + id[1]).val(names[6]);
			$('#status_' + id[1]).val(names[7]);
			$('#satuan_' + id[1]).val(names[8]);
			$('#ukuran_' + id[1]).val(names[9]);
			$('#jumlah_' + id[1]).val(names[10]);
			$('#lock_' + id[1]).val(names[11]);
			if(names[11] == 'Y'){
				$('#jumlah_' + id[1]).attr('readonly',true);
				$('#harga_' + id[1]).attr('readonly',true);
				}else{
				$('#jumlah_' + id[1]).attr('readonly',false);
				$('#harga_' + id[1]).attr('readonly',false);
			}
			if(names[7] >0){
				$('#ukuran_' + id[1]).attr("placeholder", "PxL|1:1");
			}
		},
		change: function (event, ui) {
			if(ui.item==null){
				id_arr = $(this).attr('id');
				id = id_arr.split("_");
				$('#kodeproduk_' + id[1]).val("-");
				$('#jenis_cetakan_' + id[1]).val("-");
				$('#harga_' + id[1]).val(1);
				$('#id_jenis_' + id[1]).val(1);
				}else{
				var names = ui.item.data.split("|");
				id_arr = $(this).attr('id');
				id = id_arr.split("_");
				if(names[0]=="NONE"){
					$('#kodeproduk_' + id[1]).val("-");
					$('#jenis_cetakan_' + id[1]).val("-");
					$('#harga_' + id[1]).val(1);
					$('#id_jenis_' + id[1]).val(1);
				}
			}
			
		}
		
	});
}
function load_satuan(a,b){
	var valjenis = $('#id_satuan_'+a.toString()).val();
	var valid = b?b:valjenis;
	
	$.ajax({
		url: base_url+"produk/load_satuan",
		type: 'POST',
		dataType: 'json',
		beforeSend: function () {
			$("#satuan_"+a.toString()).append("<option value='loading'>loading</option>");
			$("#satuan_"+a.toString()).empty();
		},
		success: function (response) {
			$("#satuan_"+a.toString()+" option[value='loading']").remove();
			$("#satuan_"+a.toString()).append("<option value=''>Pilih</option>");
			var len = response.length;
			for (var i = 0; i < len; i++) {
				var id = response[i]['id'];
				var name = response[i]['name'];
				if(valid==id){
					$("#satuan_"+a.toString()).append("<option value='" + id + "' selected>" + name + "</option>");
					}else{
					$("#satuan_"+a.toString()).append("<option value='" + id + "'>" + name + "</option>");
				}
				// $('#satuan_'+a+'  option[value="'+valjenis+'"]').prop("selected", true);
			}
		}
	});
}


function ukuran_cari(x){
	$('#ukuran_' + x.toString()).autocomplete({
		source: function(request, response) {
			$.ajax({
				url: base_url + 'produk/ajax',
				dataType: "json",
				method: 'post',
				data: {
					name_startsWith: request.term,
					type: 'ukuran_table',
					row_num: 1
				},
				success: function(data) {
					response($.map(data, function(item) {
						var code = item.split("|");
						return {
							label: code[0],
							value: code[0],
							data: item
						}
					}));
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
		},
		autoFocus: true,
		minLength: 0,
		select: function(event, ui) {
			var names = ui.item.data.split("|");
			id_arr = $(this).attr('id');
			id = id_arr.split("_");
			$('#ukuran_' + id[1]).val(names[1]);
			$('#idukuran_' + id[1]).val(names[2]);
		}
		
	});
}


function bahan_cari(x,y){
	$('#bahan_' + x.toString()).autocomplete({
		source: function(request, response) {
			var idprod = $('#id_produk_' + x.toString()).val();
			$.ajax({
				url: base_url + 'produk/ajax',
				dataType: "json",
				method: 'post',
				data: {
					name_startsWith: request.term,
					type: 'bahan_table',
					idprod: idprod,
					id_konsumen: y,
					row_num: 1
				},
				success: function(data) {
					response($.map(data, function(item) {
						var code = item.split("|");
						return {
							label: code[0],
							value: code[0],
							data: item
						}
					}));
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
		},
		autoFocus: true,
		minLength: 0,
		select: function(event, ui) {
			var names = ui.item.data.split("|");
			id_arr = $(this).attr('id');
			id = id_arr.split("_");
			$('#bahan_' + id[1]).val(names[0]);
			$('#id_bahan_' + id[1]).val(names[1]);
			$('#satuan_' + id[1]).val(names[2]);
			$('#harga_' + id[1]).val(names[3]);
			$('#status_hitung_'+id[1]).val(names[4]);
			$('#type_harga_'+id[1]).val(names[5]);
			
		},
		change: function (event, ui) {
			if(ui.item==null){
				$('#bahan_' + id[1]).val('');
				$('#id_bahan_' + id[1]).val(1);
				}else{
				var names = ui.item.data.split("|");
				id_arr = $(this).attr('id');
				id = id_arr.split("_");
				if(names[0]=="NONE"){
					$('#bahan_' + id[1]).val('');
					$('#id_bahan_' + id[1]).val(1);
				}
			}
		}
		
	});
}
function jenis_cari(x){
	
	$("#jenis_cetakan_" + x.toString()).autocomplete({
		source: function(request, response) {
			$.ajax({
				url: base_url + 'produk/ajax',
				dataType: "json",
				method: 'post',
				data: {
					name_startsWith: request.term,
					type: 'jenis_table',
					row_num: 1
				},
				success: function(data) {
					response($.map(data, function(item) {
						var code = item.split("|");
						return {
							label: code[0],
							value: code[0],
							data: item
						}
					}));
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
		},
		autoFocus: true,
		minLength: 0,
		select: function(event, ui) {
			var names = ui.item.data.split("|");
			$('#jenis_cetakan_'+x.toString()).val(names[0]);
			$('#id_jenis_'+x.toString()).val(names[1]);
		},
		change: function (event, ui) {
			var names = ui.item.data.split("|");
			if(names[0]=="NONE"){
				$('#jenis_cetakan_' + x.toString()).val('');
				$('#id_jenis_' + x.toString()).val(1);
			}
		}
		
	});
}

var b = $("#tablein > tbody").children().length;	
var id_konsumen = $('#id_konsumen').val();
for (var a = 0; a < b; a++) {
	// var ket = $('#ket_' + a).val();
	produk_cari(a);
	load_satuan(a);
	bahan_cari(a,id_konsumen);
	jenis_cari(a);
	
}

function getproduk(pro) {
	
	if (document.getElementById("jenis_cetakan_" + pro).value == '-') {
		// alert('Isi dulu jenis Cetakannya !!!');
		sweet_time(800, "Status!!!", "Produk belum diisi")
		return;
	}
	var invoice = $("#id_invoice").val();
	pro = pro.toString();
	
	var idr = document.getElementById("id_rincianinvoice_" + pro).value;
	var kode = document.getElementById("id_produk_" + pro).value;
	var jenis = document.getElementById("id_jenis_" + pro).value;
	$.ajax({
		type: 'POST',
		url: base_url + "produk/finishing",
		data: { id: idr, kode: kode, jenis: jenis,invoice:invoice },
		cache: false,
		
		success: function(data) {
			$('#finishing').html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
		}
	});
	$("#DetailCart").modal('show');
}
$('.input, .pilih').click(function() {
	this.select();
});

$("#pajak").prop("disabled",true);
$("#pajak").val(0);
$("#sumpajak").val(formatMoney(0, 0, "Rp."));
$("#uangm").val(formatMoney(0, 0, "Rp."));
$("#kembalian").val(formatMoney(0, 0, "Rp."));
$("#total_bayar").val(0);

function lunasd() {
	sumpajak = angka(document.getElementById("sumpajak").value);
	totalbyr = angka(document.getElementById("totalbyr").value);
	totalbyr = parseInt(totalbyr);
	sisabayar = angka(document.getElementById("sisabayar").value);
	sisabayar = parseInt(sisabayar);
	if(totalbyr==0){
		// console.log(1)
		document.getElementById("uangm").value = document.getElementById("sisabayar").value; 
		document.getElementById("totalbyr").value = document.getElementById("sisabayar").value; 
		document.getElementById("total_bayar").value = document.getElementById("sisabayar").value; 
		}else if(totalbyr > sisabayar){
		// console.log(2)
		
		document.getElementById("total_bayar").value = document.getElementById("totalbyr").value; 
		document.getElementById("uangm").value = document.getElementById("totalbyr").value; 
		}else{
		// console.log(3)
		
		document.getElementById("total_bayar").value = document.getElementById("totalbyr").value; 
		document.getElementById("uangm").value = document.getElementById("totalbyr").value;
		document.getElementById("totalbyr").value = document.getElementById("sisaSum").value;
	}
	$("#kembalian").val(formatMoney(0, 0, "Rp."));
}
function sumawal(){
	var bpajak;var total;
	var sumpajak = angka($("#sumpajak").val());
	if(sumpajak >0){
		bpajak = angka(document.getElementById("pajak").value);
		total = angka(document.getElementById("sisabayar").value);
		hbayar = ((total * bpajak) /100);
		total_order = parseInt(total) + parseInt(hbayar);
		document.getElementById("totalbyr").value = formatMoney(total_order, 0, "Rp."); 
		document.getElementById("sumpajak").value = formatMoney(hbayar, 0, "Rp."); 
		}else{
		total = angka(document.getElementById("sisaSum").value);
		document.getElementById("totalbyr").value = formatMoney(total, 0, "Rp.");
		$("#sumpajak").val(formatMoney(0, 0, "Rp."));
	}
	
	
}
function rehitung(){
	total = angka(document.getElementById("sisabayar").value);
	$("#sumpajak").val(formatMoney(total, 0, "Rp."));
}
function savpajak(){
	var noin=$("#id_invoice").val();
	var pj = $("#pajak").val();
	if(pj==0 || pj==''){
		sweet_time(5000, "Status!!!", "Pajak masih kosong");
		return;
	}
	$.ajax({
		url : base_url +'penjualan/simpan_pajak',
		dataType: "json",
		method: 'POST',
		data: {
			id: noin,
			pajak: pj,
			type: 'simpan_pajak'
		},
		success: function(res){
			if(res.ok=='ok'){
				
				$("#pajaksum").val(res.pajak);
				doMath();
				}else{
				
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
		}
	});
}

function batal(){
	$("#pajak").prop("disabled",true);
	$("#batal").hide();
	$("#savpajak").hide();
	$("#pajakd").show();
}

function inputan(){
	var total;
	var bayar;
	var kembalian;
	var totbayar;
	var bpajak;
	var totalbyr;
	var tbyr;
	bpajak = angka(document.getElementById("pajak").value);
	tbyr = angka(document.getElementById("totalbyr").value);
	tbyr = parseInt(tbyr);
	total = angka(document.getElementById("sisabayar").value);
	total = parseInt(total);
	bayar = angka(document.getElementById("uangm").value);
	bayar = parseInt(bayar);
	if(bpajak >0 ){
		hbayar = ((total * bpajak) /100);
		$("#sumpajak").val(formatMoney(hbayar, 0, "Rp."));
		totalbyr = parseInt(total) + parseInt(hbayar);
		$("#totalbyr").val(formatMoney(totalbyr, 0, "Rp."));
		}else{
		$("#sumpajak").val(formatMoney(0, 0, "Rp."));
		if(bayar > total){
			document.getElementById("totalbyr").value = document.getElementById("sisabayar").value; 
			totalbyr = angka(document.getElementById("totalbyr").value);
			kembalian = parseInt(bayar)-parseInt(totalbyr);
			kembalian = formatMoney(kembalian, 0, "Rp.");
			$("#kembalian").val(kembalian);
			
			}else if(bayar == total){
			document.getElementById("totalbyr").value = document.getElementById("sisabayar").value; 
			$("#kembalian").val(formatMoney(0, 0, "Rp."));
			
			}else if(bayar < total){
			$("#totalbyr").val(formatMoney(bayar, 0, "Rp."));
			$("#kembalian").val(formatMoney(0, 0, "Rp."));
			
			}else{
			$("#pajak").val(0);
			$("#kembalian").val(formatMoney(0, 0, "Rp."));
		}
	}
}

function kembalian(){
	var total;
	var bayar;
	var kembalian;
	var totbayar;
	var totalbyr;
	var tbyr;
	var sumpajak;
	
	sumpajak = angka(document.getElementById("sumpajak").value);
	tbyr = angka(document.getElementById("totalbyr").value);
	tbyr = parseInt(tbyr);
	total = angka(document.getElementById("sisabayar").value);
	total = parseInt(total);
	bayar = angka(document.getElementById("uangm").value);
	bayar = parseInt(bayar);
	
	if(bayar > total && sumpajak ==0){
		document.getElementById("totalbyr").value = document.getElementById("sisabayar").value; 
		totalbyr = angka(document.getElementById("totalbyr").value);
		kembalian = parseInt(bayar)-parseInt(totalbyr);
		kembalian = formatMoney(kembalian, 0, "Rp.");
		$("#kembalian").val(kembalian);
		}else if(bayar > total && sumpajak > 0){
		$("#total_bayar").val(formatMoney(bayar, 0, "Rp."));
		kembalian = parseInt(bayar)-parseInt(tbyr);
		kembalian = formatMoney(kembalian, 0, "Rp.");
		$("#kembalian").val(kembalian);
		}else if(bayar < total){
		$("#total_bayar").val(formatMoney(bayar, 0, "Rp."));
		$("#kembalian").val(formatMoney(0, 0, "Rp."));
		}else{
		$("#kembalian").val(formatMoney(0, 0, "Rp."));
	}
	
}

var total_cek = angka($("#totalSum").val());
var sisa_cek = angka($("#uangmuka").val());
var sisa_sum = angka($("#sisaSum").val());
if(total_cek == sisa_cek && sisa_sum > 0){
	$("#uangm").prop("disabled",true);
	$(".lunasd").prop("disabled",true);
	$("#id_byr").prop("disabled",true);
}
$('#namamarketing').autocomplete({
	source: function( request, response ) {
		$.ajax({
			url: base_url + 'produk/ajax',
			dataType: "json",
			method: 'post',
			data: {
				name_startsWith: request.term,
				type: 'marketing_table',
				row_num : 1
			},
			success: function( data ) {
				response( $.map( data, function( item ) {
					var code = item.split("|");
					return {
						label: code[0],
						value: code[0],
						data : item
					}
				}));
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	},
	autoFocus: true,	      	
	minLength: 0,
	select: function( event, ui ) {
		var names = ui.item.data.split("|");	
		$('#namamarketing').val(names[0]);
		$('#marketing').val(names[1]);
	}	
	
});

function cek_idawal(){
	var idkonsumen = $('#id_konsumen').val();
	var sisaSum = angka($('#sisaSum').val());
	if(idkonsumen==1 && level!='desain'){
		$("#pending").prop("disabled",true);
	}
	if(sisaSum >0){
		$("#pending").prop("disabled",false);
		$("#bayarin").prop("disabled",false);
	}
}
$('#Bayar1').val($(this).is(':checked'));

$('#cari_produk').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: base_url + 'produk/ajax',
			dataType: "json",
			method: 'POST',
			data: {
				name_startsWith: request.term,
				type: 'produk_table',
				row_num: 1
			},
			success: function(data) {
				response($.map(data, function(item) {
					var code = item.split("|");
					return {
						label: code[0],
						value: code[0],
						data: item
					}
				}));
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	},
	autoFocus: true,
	minLength: 0,
	select: function(event, ui) {
		var names = ui.item.data.split("|");
		
		$('#kodeproduk').val(names[0]);
		$('#harga').val(names[1]);
		$('#id_produk').val(names[2]);
		$('#jenis_cetakan').val(names[3]);
		$('#bahan').val(names[4]);
		$('#id_jenis').val(names[5]);
		$('#id_bahan').val(names[6]);
		$('#status_hitung').val(names[7]);
		$('#satuan_add').val(names[8]);
		$('#ukuran').val(names[9]);
		$('#jumlah').val(names[10]);
		$('#lock').val(names[11]);
		$('#type_harga').val(names[12]);
		
		if(names[11] == 'Y'){
			$('#jumlah').attr('readonly',true);
			$('#harga').attr('readonly',true);
			}else{
			$('#jumlah').attr('readonly',false);
			$('#harga').attr('readonly',false);
		}
		if(names[7] >0){
			$('#ukuran').attr("placeholder", "PxL|1:1");
		}
	},
	change: function (event, ui) {
		if(ui.item==null){
			id_arr = $(this).attr('id');
			id = id_arr.split("_");
			$('#kodeproduk').val("-");
			$('#jenis_cetakan').val("-");
			$('#harga').val(1);
			$('#id_jenis').val(1);
			}else{
			var names = ui.item.data.split("|");
			id_arr = $(this).attr('id');
			id = id_arr.split("_");
			if(names[0]=="NONE"){
				$('#kodeproduk').val("-");
				$('#jenis_cetakan').val("-");
				$('#harga').val(1);
				$('#id_jenis').val(1);
			}
		}
		
	}
	
});	