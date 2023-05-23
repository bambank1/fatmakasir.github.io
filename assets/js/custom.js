/** @type {string} */
var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search;
/** @type {!Array<string>} */
var pathArray = newURL.split("/");
/** @type {number} */
var len = pathArray.length;
if (location.hostname === "localhost" || location.hostname === "127.0.0.1" || location.hostname === my_ip) {
	if (len > 5) {
		/** @type {string} */
		var url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3] + "/" + pathArray[4] + "/" + pathArray[5];
		} else {
		/** @type {string} */
		url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3] + "/" + pathArray[4];
	}
	} else {
	if (len > 4) {
		/** @type {string} */
		url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3] + "/" + pathArray[4];
		} else {
		/** @type {string} */
		url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3];
	}
}
$("li.nav-item a").filter(function() {
	return this.href == url;
}).parentsUntil(".sidebar > .nav-link collapsed").addClass("active");
$("li.nav-item a").filter(function() {
	return this.href == url;
}).closest(".collapse").addClass("show");
$(".collapse-item").filter(function() {
	return this.href == url;
	}).closest("a").siblings().removeClass("active").end().addClass("active").css({
	display : "block"
});
jQuery(document).ready(function() {
	jQuery("#viewerContainer").scrollbar();
	jQuery(".scrollbar-inner").scrollbar();
	jQuery(".scrollbar-dynamic").scrollbar();
	jQuery(".scrollbar-vista").scrollbar({
		"showArrows" : true,
		"scrollx" : "advanced",
		"scrolly" : "advanced"
	});
});
$(".dropdown").on("shown.bs.dropdown", function(canCreateDiscussions) {
	$(".dropdown-menu input").focus();
});

/**
	* @param {number} path
	* @return {undefined}
*/
function searchFilter(path) {
	path = path ? path : 0;
	var trx = $("#trx").val();
	var LITERALS = $("#keywords").val();
	var sortBy = $("#sortBy").val();
	var limits = $("#limits").val();
	var tgl = $("#tgl").val();
	var param = base_url + "penjualan/ajaxPaginationData/" + path;
	$.ajax({
		type : "POST",
		url : param,
		data : {
			page : path,
			keywords : LITERALS,
			sortBy : sortBy,
			limits : limits,
			trx : trx,
			tgl : tgl
		},
		beforeSend : function() {
			$("body").loading();
		},
		success : function(htmlExercise) {
			$("#dataList").html(htmlExercise);
			$("body").loading('stop');
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
			$("body").loading('stop');
		}
	});
}
$(document).on("click", ".clear", function() {
	$(this).tooltip("hide");
	$(".date-order").val("");
	$("#keywords").val("");
	$("#trx").val(0);
	$("#limits").val(10);
	$("#sortBy").val("DESC");
	searchFilter();
});
$(document).on("click", ".ceklunas", function() {
	$("#trx").val(1);
	searchFilter();
});
$(document).on("click", ".cekPending", function() {
	$("#trx").val("pending");
	searchFilter();
});
$(document).on("click", ".cekBaru", function() {
	$("#trx").val("baru");
	searchFilter();
});
$(document).on("click", ".cekBatal", function() {
	$("#trx").val("batal");
	searchFilter();
});
$(document).ready(function() {
	$("body").tooltip({
		selector : "[data-tooltip=tooltip]",
		container : "body"
	});
});
$(".select2-profil").select2();
/** @type {(Element|null)} */
var dengan_rupiah = document.getElementById("uangm");
dengan_rupiah.addEventListener("keyup", function(canCreateDiscussions) {
	dengan_rupiah.value = formatRupiah(this.value, "Rp. ");
});
// var start = moment();
var start = moment().startOf("month");
var end = moment();
/**
	* @param {!Object} start
	* @param {!Object} end
	* @return {undefined}
*/
function cb(start, end) {
	$("#reportrange span").html(start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY"));
}
$("#reportrange").daterangepicker({
	startDate : start,
	endDate : end,
	ranges : {
		"Today" : [moment(), moment()],
		"Yesterday" : [moment().subtract(1, "days"), moment().subtract(1, "days")],
		"Last 7 Days" : [moment().subtract(6, "days"), moment()],
		"Last 30 Days" : [moment().subtract(29, "days"), moment()],
		"This Month" : [moment().startOf("month"), moment().endOf("month")],
		"Last Month" : [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
	}
}, cb);
cb(start, end);

// $('#formcheckqr').submit(function(e){
$(document).on('click','.cari_qr',function(e){
	e.preventDefault();
	// event.stopPropagation()
	var cari_produk = $("#cari_qr").val();
	if($("#cari_qr").val()==''){
		$("#cari_qr").addClass('form-control-warning');
		showNotif('top-center','Input Data','Harus diisi','warning');
		$("#cari_qr").focus();
		return;
	}
	$.ajax({
		url : base_url + "produk/ajax",
		type : "POST",
		data: {
			name_startsWith: cari_produk,
			type: 'produk_table_qr',
			row_num: 1
		},
		dataType : "json",
		success: function(arr) {
			var names = arr[0].split("|");
			
			// console.log(names[8]);
			$('#cari_produk').val(names[0]);
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
			
			$("#button-qr").modal('hide');
			$("#formcheckin").submit();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
		}
	});
	
	
});


function saved(a) {
	
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
	type_harga        = $("#status_" + a.toString()).val(); 
	hargasatuan       = angka($("#hargasatuan_" + a.toString()).val()); 
	
	$('#satuan_'+a.toString()+'  option[value="'+satuan+'"]').prop("selected", true);
	
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
			type_harga:type_harga
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
