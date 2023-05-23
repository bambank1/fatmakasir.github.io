$(document).fcs(".shift-focus");
/**
	* @param {?} i
	* @param {string} heading
	* @param {string} message
	* @param {string} iconType
	* @return {undefined}
*/
showToastPosition = function(i, heading, message, iconType) {
	resetToastPosition();
	$.toast({
		heading : heading,
		text : message,
		position : String(i),
		icon : iconType,
		stack : false,
		loaderBg : "#f96868"
	});
};

$('.input').click(function() {
	this.select();
});

$(".custom-file-input").on("change", function() {
	var fileName = $(this).val().split("\\").pop();
	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	$("body").loading({zIndex:1060});
});
$('.preview').attr('disabled',false);
$("#lampiran").change(function () {
	var fileExtension = ['jpeg', 'jpg', 'png','webp'];
	if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		// alert("Only formats are allowed : "+fileExtension.join(', '));
		showNotif("top-center", "Lampiran", "Format tidak didukung", "error");
		$('#lampiran').val('')
		$('.custom-file-label').text('Format file jpeg | jpg | png | webp')
		$('body').loading('stop');
		return
	}
	readURL(this);
	$('.preview').attr('disabled',false);
	
});

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function(e) {
			$('#imageresource').attr('src', e.target.result);
			loadImg(e.target.result)
		};
		reader.readAsDataURL(input.files[0]);
	}
	
}
function loadImg(img){
	var span = document.getElementsByClassName("mklbItem")[0];
	_mklbOpen(span);
	$('body').loading('stop');
}

/**
	* @return {undefined}
*/
resetToastPosition = function() {
	$(".jq-toast-wrap").removeClass("bottom-left bottom-right top-left top-right mid-center");
	$(".jq-toast-wrap").css({
		"top" : "",
		"left" : "",
		"bottom" : "",
		"right" : ""
	});
};
/**
	* @param {string} pos
	* @param {string} title
	* @param {string} msg
	* @param {string} show
	* @return {undefined}
*/
showNotif = function(pos, title, msg, show) {
	resetToastPosition();
	$.toast({
		heading : title,
		text : msg,
		position : String(pos),
		icon : show,
		stack : false,
		loaderBg : "#f96868"
	});
};
/**
	* @return {undefined}
*/
function cari_konsumen() {
	$("#modal-cari-2").modal({
		backdrop : "static",
		keyboard : false
	});
	$("#modal-tambah-1").modal("hide");
	$("#error_piutang").hide();
	$("#error_piutang").html("");
	var CAPTURE_ID = $("id_invoice").val();
	$.ajax({
		"url" : base_url + "konsumen/cari_konsumen",
		"data" : {
			id : CAPTURE_ID
		},
		"method" : "POST",
		success : function(htmlExercise) {
			$("#error_piutang").css("display", "none");
			$("#data-cari").html(htmlExercise);
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
shortcut.add("F1", function() {
	$("#cari_produk").focus();
});
shortcut.add("F2", function() {
	$(".cari").click();
});
shortcut.add("F3", function() {
	$(".tambah").click();
});
shortcut.add("F4", function() {
	$(".bayar_l").click();
});
shortcut.add("ctrl+p", function() {
	$(".print").click();
	hideCari();
	hideTambah();
});
shortcut.add("ctrl+z", function() {
	$(".pending").click();
	hideCari();
	hideTambah();
});
shortcut.add("ctrl+b", function() {
	$(".bayarin").click();
	// hideTambah();
});
shortcut.add("ctrl+s", function() {
	$(".simpan").click();
	hideCari();
	hideTambah();
});
shortcut.add("ctrl+o", function() {
	$("#OpenCart-1").modal("show");
});
// shortcut.add("escape", function() {
// hideCart();
// });
// shortcut.add("ctrl+i", function() {
// $(".addmore").click();
// });
shortcut.add("ctrl+j", function() {
	$("#jumlah_0").focus();
});
$(document).on("click", ".tambah", function() {
	$(".tampil_add").hide();
	document.getElementById("form-tambah").reset();
	load_jenis_lembaga("add");
	load_jenis_member("add");
	var values = $("#tambah").attr("data-id");
	// console.log(values);
	$("#modal-tambah-1").modal({
		backdrop : "static",
		keyboard : false
	});
	$("#id_nya").val(values);
	$("#type_add").val("add_on_invoice");
	$("#modal-cari-2").modal("hide");
});
$("#modal-tambah-1").on("shown.bs.modal", function() {
	$("#telepon_add").focus();
});
$("#modal-cari-2").on("shown.bs.modal", function() {
	$("#caritlp").focus();
});




$(document).on("click", ".cari", function() {
	$("#modal-cari-2").modal({
		backdrop : "static",
		keyboard : false
	});
	$("#modal-tambah-1").modal("hide");
	var sampleID = $(this).attr("data-id");
	$.ajax({
		"url" : base_url + "konsumen/cari_konsumen",
		"data" : {
			id : sampleID
		},
		"method" : "POST",
		success : function(htmlExercise) {
			$("#error_piutang").css("display", "none");
			$("#data-cari").html(htmlExercise);
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
});
/**
	* @param {string} id
	* @return {undefined}
*/
function cari_show(id) {
	$('#keranjang').loading('stop');
	$("#modal-cari-2").modal({
		backdrop : "static",
		keyboard : false
	});
	$("#modal-tambah-1").modal("hide");
	setTimeout(function() {
		$("#caritlp").focus();
	}, 1000);
	$.ajax({
		"url" : base_url + "konsumen/cari_konsumen",
		"data" : {
			id : id
		},
		"method" : "POST",
		success : function(htmlExercise) {
			$("#error_piutang").css("display", "none");
			$("#data-cari").html(htmlExercise);
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
$("#modal-cari-2").on("hidden.bs.modal", function() {
	$("#error_piutang").css("display", "none");
	$(this).find("form").trigger("reset");
	$("#error_piutang").hide();
});
/**
	* @return {undefined}
*/
function hideCari() {
	// $("#modal-cari-2").removeClass("in");
	// $(".modal-backdrop").remove();
	$("#modal-cari-2").hide();
	$("#error_piutang").hide();
}
$("#panggilan_add").change(function() {
	$("#panggilan_add").removeClass("is-invalid").addClass("is-valid");
});
$("#jenis_lembaga_add").change(function() {
	$("#jenis_lembaga_add").removeClass("is-invalid").addClass("is-valid");
});
$("#telepon_add").keyup(function() {
	const tlp = $("#telepon_add").val().length;
	if (tlp <= 10) {
		$("#feedback-telp").text("Telepon min 11 digit");
		$("#feedback-telp").addClass("text-danger");
		$("#telepon_add").addClass("is-invalid text-danger");
		} else {
		if (tlp > 17) {
			$("#feedback-telp").text("Telepon max 17 digit");
			$("#feedback-telp,#telepon_add").addClass("is-invalid text-danger");
			} else {
			$("#feedback-telp").text("");
			$("#feedback-telp,#telepon_add").removeClass("is-invalid text-danger").addClass("is-valid text-default");
		}
	}
});
$("#nama_add").keyup(function() {
	const nama = $("#nama_add").val().length;
	if (nama < 3) {
		$("#feedback-nama").text("Nama min 3 karakter");
		$("#nama_add").removeClass("is-valid").addClass("is-invalid");
		} else {
		if (nama > 25) {
			$("#feedback-nama").text("Nama max 25 karakter");
			$("#feedback-nama,#nama_add").removeClass("is-valid").addClass("is-invalid text-danger");
			} else {
			$("#nama_add").removeClass("is-invalid text-danger").addClass("is-valid text-default");
			$("#feedback-nama").text("Nama pelanggan");
		}
	}
	$("#nama_add").removeClass("is-invalid").addClass("is-valid");
});
$("#alamat_add").keyup(function() {
	const alamat = $("#alamat_add").val().length;
	if (alamat <= 5) {
		$("#alamat_add").removeClass("is-valid").addClass("is-invalid");
		$("#feedback-nama").text("Nama minimal 3");
		} else {
		$("#alamat_add").removeClass("is-invalid").addClass("is-valid");
	}
});
$("#perusahaan_add").keyup(function() {
	$("#perusahaan_add").removeClass("is-invalid").addClass("is-valid");
});
$("#alamat_perusahaan_add").keyup(function() {
	$("#alamat_perusahaan_add").removeClass("is-invalid").addClass("is-valid");
});
$("#no_telp_add").keyup(function() {
	$("#no_telp_add").removeClass("is-invalid").addClass("is-valid");
});
$("#save-cari").click(function() {
	if ($("#telepon_add").val() == "") {
		$("#telepon_add").addClass("is-invalid");
		return;
	}
	if ($("#panggilan_add").val() == "") {
		$("#panggilan_add").addClass("is-invalid");
		return;
	}
	if ($("#nama_add").val() == "") {
		$("#nama_add").addClass("is-invalid");
		return;
	}
	if ($("#alamat_add").val() == "") {
		$("#alamat_add").addClass("is-invalid");
		return;
	}
	if ($("#jenis_lembaga_add").val() == "") {
		$("#jenis_lembaga_add").addClass("is-invalid");
		return;
	}
	if ($("#jenis_lembaga_add").val() > 1 && $("#perusahaan_add").val() == "") {
		$("#perusahaan_add").addClass("is-invalid");
	}
	if ($("#jenis_lembaga_add").val() > 1 && $("#alamat_perusahaan_add").val() == "") {
		$("#alamat_perusahaan_add").addClass("is-invalid");
	}
	if ($("#jenis_lembaga_add").val() > 1 && $("#no_telp_add").val() == "") {
		$("#no_telp_add").addClass("is-invalid");
		return;
	}
	$("#form-tambah").submit();
});
$(document).on("click", ".clearada", function() {
	$("#telepon_add").val("");
	$("#panggilan").val("");
	$("#namaadd").val("");
	$("#alamatadd").val("");
	$("#perusahaanadd").val("");
	$("#via").val("");
	$("#panggilan,#namaadd,#telepon_add,#alamatadd,#perusahaanadd,#via,#save-cari").prop("disabled", this.value == "" ? true : false);
});
$(document).on("click", ".cariada", function() {
	$("#modal-tambah-1").modal("hide");
	var idkon = $(this).attr("data-idkon");
	var CAPTURE_ID = $(this).attr("data-idin");
	var telpID = $(this).attr("data-idTelp");
	var primaryExtension = $("#telepon_add").val();
	if (primaryExtension != "") {
		telps = primaryExtension;
		} else {
		/** @type {string} */
		telps = "0";
	}
	$.ajax({
		url : base_url + "konsumen/cari_update",
		data : {
			id : CAPTURE_ID,
			idkon : idkon,
			telp : telpID
		},
		method : "POST",
		dataType : "json",
		success : function(a) {
			$("#error_piutang").css("display", "");
			if (a.hasil == "ada") {
				$("#error_piutang").show();
				$("#error_piutang").html(a.error);
				} else {
				if (a.hasil == "sukses") {
					$("#id_konsumen").val(a.idk);
					$("#namanya").html(a.nama);
					$("#tlpnya").html(a.telp);
					$("#alamatnya").html(a.alamat);
					$("#perusahaannya").html(a.perusahaan);
					$("#idmember").val(a.id_member);
					$("#idmember_add").val(a.id_member);
					$("#modal-cari").modal("hide");
					clearModal();
					hideTambah();
					searchFilter();
					} else {
					sweet("Peringatan!!!", "Maaf data tidak ditemukan", "warning", "warning");
				}
			}
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
});
/**
	* @return {undefined}
*/
function clearModal() {
	$("#telepon_add").val("");
	$("#panggilan").val("");
	$("#namaadd").val("");
	$("#alamatadd").val("");
	$("#perusahaanadd").val("");
	$("#via").val("");
	$("#panggilan,#namaadd,#telepon_add,#alamatadd,#perusahaanadd,#via,#save-cari").prop("disabled", this.value == "" ? true : false);
}
/**
	* @return {undefined}
*/
function hideTambah() {
	$("#modal-tambah-1").removeClass("in");
	$(".modal-backdrop").remove();
	$("#modal-tambah-1").hide();
	$(".cariada").hide();
	$(".takada").hide();
}
$("#modal-tambah-1").on("hidden.bs.modal", function() {
	$("#dispu").html("");
	$("#telepon_add").focus();
	$("#panggilan_add,#nama_add,#telepon_add,#alamat_add,#perusahaan_add,#jenis_lembaga_add,#alamat_perusahaan_add,#no_telp_add,#tampil_data,#via_add,#save-cari,#status_add,#max_u_add").prop("disabled", false);
	$(".cariada").hide();
	$(".takada").hide();
});
/**
	* @return {undefined}
*/
function load_modal() {
	$.ajax({
		url : base_url + "produk/modal_popup",
		success : function(htmlExercise) {
			$("#load-modal").html(htmlExercise);
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
$(document).on("click", ".bayarin", function(event) {
	event.preventDefault();
	event.stopPropagation();
	$('.preview').attr('disabled',true);
	$('#Bayar1').prop('checked', true);
	// $('#keranjang').loading({zIndex:1050,message:'saving data'});
	var canCreateDiscussions = angka($("#id_konsumen").val());
	var programStatusId = $("#iduser").val();
	var ownerStyles = angka($("#idlunas").val());
	var tentacleGroupCount = angka($("#totalSum").val());
	var prevStoryId = $(this).attr("data-id");
	/** @type {string} */
	var simNamespace = "bayar";
	var readersLength = $("#tablein > tbody").children().length;
	/** @type {number} */
	var r = 0;
	for (; r < readersLength; r++) {
		if ($("#kodeproduk_" + r).val() == "") {
			showNotif("top-right", "Simpan", "Produk masih kosong", "warning");
			$("#kodeproduk_" + r).focus();
			showNotif("top-right", "Simpan", "Data masih kosong", "warning");
			return;
		}
		if ($("#jenis_cetakan_" + r).val() == "") {
			showNotif("top-right", "Simpan", "Jenis cetakan masih kosong", "warning");
			$("#jenis_cetakan_" + r).focus();
			return;
		}
		if ($("#ket_" + r).val() == "") {
			showNotif("top-right", "Simpan", "Keterangan masih kosong", "warning");
			$("#ket_" + r).focus();
			return;
		}
		if ($("#bahan_" + r).val() == "") {
			showNotif("top-right", "Simpan", "Bahan masih kosong", "warning");
			$("#bahan_" + r).focus();
			return;
		}
		if ($("#jumlah_" + r).val() == "") {
			showNotif("top-right", "Simpan", "Jumlah masih kosong", "warning");
			$("#jumlah_" + r).focus();
			return;
		}
		if ($("#harga_" + r).val() == "" || $("#harga_" + r).val() == 0) {
			showNotif("top-right", "Simpan", "Harga masih kosong", "warning");
			$("#harga_" + r).focus();
			return;
		}
		if ($("#satuan_" + r).val() == "") {
			sweet("Peringatan!!!", "Satuan masih kosong", "warning", "warning");
			$("#satuan_" + r).focus();
			$("#satuan_" + r).val('-');
			return;
		}
	}
	if (canCreateDiscussions == 1 && kasir ==1) {
		showNotif("top-right", "Simpan", "Pelanggan masih kosong", "warning");
		cari_show(prevStoryId);
		} else {
		if (tentacleGroupCount == 0) {
			sweet("Peringatan!!!", "Maaf data masih kosong", "warning", "warning");
			} else {
			simpan_data(prevStoryId, programStatusId, ownerStyles, tentacleGroupCount, simNamespace, canCreateDiscussions);
		}
		$('#keranjang').loading('stop');
	}
});

$(document).on("click", ".bayar_sisa", function(event) {
	$("#pembayaran-sisa").modal({
		backdrop : "static",
		keyboard : false
	});
	load_bayar_piutang();
	var id = $(this).attr("data-id");
	var sub = $(this).attr("data-trx");
	var sisa = $(this).attr("data-sisa");
	var total = $(this).attr("data-total");
	var bayar = $(this).attr("data-bayar");
	var type_bayar = $(this).attr("data-type");
	load_list_bayar(id);
	// console.log(id)
	$(".tinvoice-1").html(sub);
	$("#type_bayar-1").val(type_bayar);
	$("#id_invoice_bayar").val(id);
	$("#sisabayar-1").val(formatMoney(total, 0, "Rp."));
	$("#totalbyr-1").val(formatMoney(sisa, 0, "Rp."));
	$("#total_bayar-1").val(formatMoney(sisa, 0, "Rp."));
	$("#jml_bayar-1").val(formatMoney(bayar, 0, "Rp."));
	$("#uangm-1").val(formatMoney(0, 0, "Rp."));
	$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
	$('#Bayar1-1').prop('checked', true);
	$("#Bayar1-1").filter(function() {
		
		if (this.checked) {
			// console.log(1)
			// var sisaSum = angka($("#sisaSum-1").val());
			/** @type {number} */
			
			$("#uangm-1").attr("readonly", true);
			// $("#totalbyr-1").val(formatMoney(sisaSum, 0, "Rp."));
			$("#uangm-1").val(formatMoney(sisa, 0, "Rp."));
			// $("#total_bayar-1").val(sisaSum);
			// $("#kembalian-1").val(formatMoney(0, 0, "Rp."));
			$(".lunas-1").attr("disabled", true);
			$(".n-bayar-1").attr("disabled", true);
		}
	});
});

$("#Bayar1-1").change(function() {
	if (this.checked) {
		// console.log(1)
		// var sisaSum = angka($("#sisaSum-1").val());
		/** @type {number} */
		var sisabayar = angka($("#sisabayar-1").val());
		var totalbyr = angka($("#totalbyr-1").val());
		$("#total_bayar-1").val(formatMoney(totalbyr, 0, "Rp."));
		$("#uangm-1").attr("readonly", true);
		$("#uangm-1").val(formatMoney(totalbyr, 0, "Rp."));
		// $("#total_bayar-1").val(sisaSum);
		$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
		$(".lunas-1").attr("disabled", true);
		$(".n-bayar-1").attr("disabled", true);
		if(totalbyr == 0){
			$("#total_bayar-1").val(formatMoney(sisabayar, 0, "Rp."));
			$("#uangm-1").val(formatMoney(sisabayar, 0, "Rp."));
		}
	}
});

$(".n-bayar-1").click(function() {
	var value = $(this).attr("data-id");
	var sisabayar = angka($("#sisabayar-1").val());
	var totalbyr = angka($("#totalbyr-1").val());
	// var uangm = angka($("#uangm-1").val());
	// console.log(value)
	var uang = uang_kembalian(totalbyr,value,sisabayar);
	// console.log(uang)
	if (parseInt(totalbyr) == 0) {
		$("#total_bayar-1").val(formatMoney(value, 0, "Rp."));
		} else if (parseInt(value) > parseInt(totalbyr)){
		console.log(2)
		$("#total_bayar-1").val(formatMoney(totalbyr, 0, "Rp."));
		} else {
		console.log(3)
		// $("#totalbyr").val(formatMoney(value, 0, "Rp."));
		$("#total_bayar-1").val(formatMoney(value, 0, "Rp."));
	}
	$("#kembalian-1").val(formatMoney(uang, 0, "Rp."));
	$("#uangm-1").val(formatMoney(value, 0, "Rp."));
});

$("#Bayar2-1").change(function() {
	if (this.checked) {
		var sisabayar = angka($("#totalbyr-1").val());
		// var value = angka($("#uangmuka-1").val());
		// console.log(sisabayar)
		// $("#totalbyr").val(formatMoney(value, 0, "Rp."));
		$("#uangm-1").val(formatMoney(sisabayar, 0, "Rp."));
		$("#total_bayar-1").val(formatMoney(sisabayar, 0, "Rp."));
		$("#uangm-1").attr("readonly", false);
		$(".lunas-1").attr("disabled", false);
		$(".n-bayar-1").attr("disabled", false);
	}
});


function uang_kembalian(aa,ba,ca) {
	const a = parseInt(aa); //a = total sisa bayar 
	const b = parseInt(ba); //b = uang yg dibayarkan
	const c = parseInt(ca); //c = total order
	
	if(a == 0 && b > c){
		hasil = parseInt(b) - parseInt(c);
	}
	
	if(a == 0 && b < c){
		hasil = 0;
	}
	
	if(a == 0 && b == c){
		hasil = 0;
	}
	
	if(a > 0 && b > a){
		hasil = b - a;
	}
	
	if(a > 0 && b < a){
		hasil = 0;
	}
	
	if(a > 0 && b == a){
		hasil = 0;
	}
	
	return hasil;
}

function load_bayar_piutang() {
	$(".lampiran-1").hide();
	$.ajax({
		url : base_url + "pembayaran/jenis_pembayaran",
		type : "GET",
		dataType : "json",
		beforeSend : function() {
			$("#id_byr-1").append("<option value='loading'>loading</option>");
			$("#id_byr-1").empty();
		},
		success : function(response) {
			$("#id_byr-1 option[value='loading']").remove();
			$("#id_byr-1").append("<option value=''>Pilih</option>");
			var msize = response.length;
			/** @type {number} */
			var i = 0;
			for (; i < msize; i++) {
				var teg = response[i]["id"];
				var last_supr = response[i]["name"];
				$("#id_byr-1").append("<option value='" + teg + "'>" + last_supr + "</option>");
			}
		}
	});
}
$("#id_byr-1").change(function() {
	var id = $(this).val();
	var rekening = $('#rekening-1').val();
	$(".bayar_kan").attr("disabled", true);
	if(rekening==0){
		$(".bayar_kan").attr("disabled", true);
		$(".rekening-1").attr("disabled", false);
		}else{
		$(".bayar_kan").attr("disabled", false);
		$(".rekening-1").attr("disabled", true);
	}
	$("#rekening-1").empty();
	if (id == 2) {
		$(".lampiran-1").show();
		// $(".pajak").hide();
		$.ajax({
			url : base_url + "pembayaran/get_rekening",
			type : "post",
			data : {
				type : "cari"
			},
			dataType : "json",
			success : function(response) {
				var msize = response.length;
				$(".rekening-1").attr("disabled", false);
				$("#rekening-1").append("<option value='0'>Pilih rekening</option>");
				/** @type {number} */
				var i = 0;
				for (; i < msize; i++) {
					var teg = response[i]["id"];
					var last_supr = response[i]["name"];
					$("#rekening-1").append("<option value='" + teg + "'>" + last_supr + "</option>");
				}
			}
		});
		} else {
		$(".lampiran-1").hide();
		// $(".pajak").show();
		if (id == 1) {
			$("#rekening-1").append("<option value='0'>Pilih rekening</option>");
			} else {
			$(".bayar_kan").attr("disabled", true);
		}
	}
});
$("#id_byr-1").change(function() {
	var id = $(this).val();
	console.log(id)
	$.ajax({
		url : base_url + "pembayaran/jenis_pembayaran",
		type : "GET",
		dataType : "json",
		beforeSend : function() {
			$("#id_byr-1").append("<option value='loading'>loading</option>");
			$("#id_byr-1").empty();
		},
		success : function(response) {
			$("#id_byr-1 option[value='loading']").remove();
			$("#id_byr-1").append("<option value=''>Pilih</option>");
			var msize = response.length;
			/** @type {number} */
			var i = 0;
			for (; i < msize; i++) {
				var teg = response[i]["id"];
				var last_supr = response[i]["name"];
				// $('#id_byr-1  option[value="'+id+'"]').prop("selected", true);
				if(teg==id){
					$("#id_byr-1").append("<option value='" + teg + "' selected>" + last_supr + "</option>");
					}else{
					$("#id_byr-1").append("<option value='" + teg + "'>" + last_supr + "</option>");
				}
			}
		}
	});
	
});

$("#rekening-1").change(function() {
	var rekening = $(this).val();
	if(rekening==0){
		$(".bayar_kan").attr("disabled", true);
		
		}else{
		$(".bayar_kan").attr("disabled", false);
		
	}
});

$("#lampiran-1").change(function () {
	var fileExtension = ['jpeg', 'jpg', 'png','webp'];
	if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		// alert("Only formats are allowed : "+fileExtension.join(', '));
		showNotif("top-center", "Lampiran", "Format tidak didukung", "error");
		$('#lampiran-1').val('')
		$('.custom-file-label').text('Format file jpeg | jpg | png | webp')
		$('body').loading('stop');
		return
	}
	read_URL(this);
	$('.preview-1').attr('disabled',false);
	
});
function read_URL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function(e) {
			$('#imageresource-1').attr('src', e.target.result);
			load_Img(e.target.result)
		};
		reader.readAsDataURL(input.files[0]);
	}
	
}
function load_Img(img){
	var span = document.getElementsByClassName("mklbItem-1")[0];
	_mklbOpen(span);
	$('body').loading('stop');
}

$(".bayar_kan").click(function(e) {
	e.preventDefault();
	// var num_splits = $("#tablein > tbody").children().length;
	var total_bayar = angka($("#total_bayar-1").val());
	var right = angka($("#totalbyr-1").val());
	var left = angka($("#uangm-1").val());
	var totalSum = angka($("#totalSum-1").val());
	var sisabayar = angka($("#sisabayar-1").val());
	var noin = $("#id_invoice_bayar").val();
	var attString = $("#id_byr-1").val();
	var rekening = $("#rekening-1").val();
	var type_bayar = $("#type_bayar-1").val();
	
	var kembalian = angka($("#kembalian-1").val());
	var lampiran = $('#lampiran-1').prop('files')[0];
	
	if (parseInt(left) < parseInt(right)) {
		right = left;
	}
	
	if (attString==2 && lampiran==undefined) {
		sweet_time(5000, "Status!!!", "Lampiran belum dipilih");
		return;
	}
	var form_data = new FormData(); // Creating object of FormData class
	form_data.append("lampiran", lampiran) 
	form_data.append("uang", total_bayar)
	form_data.append("sisabayar", sisabayar)
	form_data.append("noin", noin)
	form_data.append("id_byr", attString)
	form_data.append("rekening", rekening)
	form_data.append("type_bayar", type_bayar)
	form_data.append("type", 'simpan_bayar')
	
	if (attString == "" || attString == 0) {
		sweet_time(5000, "Status!!!", "Cara bayar belum dipilih");
		} else {
		if (left == "" || left == 0) {
			sweet_time(5000, "Status!!!", "Uangnya masih kosong");
			$("#uangm-1").focus();
			} else {
			$("#bayar-1").prop("disabled", true);
			
			$.ajax({
				url : base_url + "penjualan/save_bayar_piutang",
				dataType : "json",
				method : "POST",
				secureuri :false,
				processData:false,
				contentType:false,
				cache:false,
				async:false,
				data:form_data,
				beforeSend : function() {
					$("#saving-bayar-1").loading({zIndex:1051,message:'saveing data'});
					$("#bayar-1").html('<i class="fa fa-spinner fa-spin"></i>');
					$("#error_piutang").css("display", "block");
				},
				success : function(data) {
					if (data.status == 301 && data.id >0) {
						sweet("Peringatan!!!", data.msg, "warning", "warning");
						// searchFilter();
						$("#pembayaran-sisa").modal("hide");
						}else if (data.status == 304) {
						sweet("Peringatan!!!", "Pajak belum disimpan", "warning", "warning");
						} else {
						if (data.status == 200) {
							
							$("#pembayaran-sisa").modal("hide");
							} else {
							sweet("Peringatan!!!", "Data gagal disimpan", "warning", "warning");
						}
					}
					if(type_bayar=='piutang'){
						search_Piutang();
					}
					
					if(type_bayar=='bayar'){
						searchFilter();
					}
					
					$('#imageresource-1').attr('src', base_url+'assets/img/bone.jpg');
					$("#lampiran-1").val('');
					$(".custom-file-label").html('Format file jpeg | jpg | png | webp');
					$("#bayar-1").prop("disabled", false);
					$("#bayar-1").html("Simpan");
					$("#saving-bayar-1").loading('stop');
				},
				error : function(res, status, httpMessage) {
					sweet("Peringatan!!!", httpMessage, "warning", "warning");
					$("#bayar-1").prop("disabled", false);
					$("#bayar-1").html("Simpan");
					$("#saving-bayar-1").loading('stop');
				}
			});
		}
	}
});

function lunas_1() {
	
	totalbyr = angka(document.getElementById("totalbyr-1").value);
	totalbyr = parseInt(totalbyr);
	sisabayar = angka(document.getElementById("sisabayar-1").value);
	sisabayar = parseInt(sisabayar);
	if(totalbyr==0){
		// console.log(1)
		document.getElementById("uangm-1").value = document.getElementById("sisabayar-1").value; 
		document.getElementById("totalbyr-1").value = document.getElementById("sisabayar-1").value; 
		document.getElementById("total_bayar-1").value = document.getElementById("sisabayar-1").value; 
		}else if(totalbyr > sisabayar){
		// console.log(2)
		
		document.getElementById("total_bayar-1").value = document.getElementById("totalbyr-1").value; 
		document.getElementById("uangm-1").value = document.getElementById("totalbyr-1").value; 
		}else{
		// console.log(3)
		
		document.getElementById("total_bayar-1").value = document.getElementById("totalbyr-1").value; 
		document.getElementById("uangm-1").value = document.getElementById("totalbyr-1").value;
		// document.getElementById("totalbyr-1").value = document.getElementById("sisaSum-1").value;
	}
	$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
}

function kembalian_1(){
	var total;
	var bayar;
	var kembalian;
	var totbayar;
	var totalbyr;
	var tbyr;
	var sumpajak;
	
	
	tbyr = angka(document.getElementById("totalbyr-1").value);
	tbyr = parseInt(tbyr);
	total = angka(document.getElementById("sisabayar-1").value);
	total = parseInt(total);
	bayar = angka(document.getElementById("uangm-1").value);
	bayar = parseInt(bayar);
	
	if(bayar > tbyr)
	{
		document.getElementById("total_bayar-1").value = document.getElementById("totalbyr-1").value; 
		totalbyr = angka(document.getElementById("totalbyr-1").value);
		kembalian = parseInt(bayar)-parseInt(totalbyr);
		kembalian = formatMoney(kembalian, 0, "Rp.");
		$("#kembalian-1").val(kembalian);
		
		
	}else if(bayar < tbyr)
	{
		$("#total_bayar-1").val(formatMoney(bayar, 0, "Rp."));
		$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
		}else{
		$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
	}
	
}

function inputan_1(){
	var total;
	var bayar;
	var kembalian;
	var totbayar;
	var bpajak;
	var totalbyr;
	var tbyr;
	tbyr = angka(document.getElementById("totalbyr-1").value);
	tbyr = parseInt(tbyr);
	total = angka(document.getElementById("sisabayar-1").value);
	total = parseInt(total);
	bayar = angka(document.getElementById("uangm-1").value);
	bayar = parseInt(bayar);
	
	if(bayar > tbyr){
		// document.getElementById("totalbyr-1").value = document.getElementById("sisabayar-1").value; 
		totalbyr = angka(document.getElementById("totalbyr-1").value);
		kembalian = parseInt(bayar)-parseInt(totalbyr);
		kembalian = formatMoney(kembalian, 0, "Rp.");
		$("#kembalian-1").val(kembalian);
		}else if(bayar == tbyr){
		document.getElementById("totalbyr").value = document.getElementById("sisabayar-1").value; 
		$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
		
		}else if(bayar < tbyr){
		$("#totalbyr-1").val(formatMoney(bayar, 0, "Rp."));
		$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
		
		}else{
		$("#pajak-1").val(0);
		$("#kembalian-1").val(formatMoney(0, 0, "Rp."));
	}
	$("#uangm-1").val(formatMoney(bayar, 0, "Rp."));
}
/**
	* @param {string} type
	* @return {undefined}
*/
function load_list(type) {
	$.ajax({
		"url" : base_url + "penjualan/list_bayar",
		"data" : {
			id : type
		},
		"method" : "POST",
		success : function(htmlExercise) {
			$(".load-bayar").html(htmlExercise);
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}

function load_list_bayar(type) {
	$.ajax({
		"url" : base_url + "penjualan/list_bayar",
		"data" : {
			id : type
		},
		"method" : "POST",
		success : function(htmlExercise) {
			$(".load-bayar-sisa").html(htmlExercise);
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
/**
	* @param {string} newWayId
	* @return {undefined}
*/
function cek_di_invoice(newWayId) {
	var _extraRepetitionsTotal = $("#totalSum").val();
	var pajak = $("#pajaksum").val();
	$.ajax({
		type : "POST",
		url : base_url + "penjualan/cek_di_invoice",
		data : {
			id : newWayId,
			total : _extraRepetitionsTotal,
			pajak : pajak
		},
		dataType : "json",
		beforeSend : function() {
		},
		success : handleDataInv
	});
}
/**
	* @param {!Object} result
	* @return {undefined}
*/
function handleDataInv(result) {
	if (result.ok == "ok") {
		$("#pembayaran-5").modal({
			backdrop : "static",
			keyboard : false
		});
		$.ajax({
			"url" : base_url + "penjualan/list_bayar",
			"data" : {
				id : result.id
			},
			"method" : "POST",
			success : function(htmlExercise) {
				$(".load-bayar").html(htmlExercise);
			},
			error : function(res, status, httpMessage) {
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
		} else {
		simpan_data(result.id, result.iduser, idlunas, totalSum, "", result.idkon);
	}
}
/**
	* @param {string} id
	* @param {?} programStatusId
	* @param {?} store
	* @param {number} total
	* @param {string} namespace
	* @param {?} canCreateDiscussions
	* @return {undefined}
*/
function simpan_data(id, programStatusId, store, total, namespace, canCreateDiscussions) {
	$.ajax({
		type : "POST",
		url : base_url + "penjualan/update_data",
		data : {
			id : id,
			iduser : programStatusId,
			idlunas : store,
			total : total,
			tipe : namespace,
			idkon : canCreateDiscussions
		},
		dataType : "json",
		beforeSend : function() {
			sweet_time(500, "Status!!!", "Data sedang disimpan");
		},
		success : handleSave
	});
}
/**
	* @param {!Object} req
	* @return {undefined}
*/
function handleSave(req) {
	if (req.ok == "ok" && req.tipe == "bayar") {
		$("#pembayaran-5").modal({
			backdrop : "static",
			keyboard : false
		});
		
		load_list(req.id);
		load_jenis();
		setTimeout(function() {
			$("#id_byr").focus();
		}, 1000);
		$("#Bayar1").filter(function() {
			if (this.checked) {
				var totalSum = angka($("#totalSum").val());
				var sisaSum = angka($("#sisaSum").val());
				/** @type {number} */
				
				$("#sisabayar").val(formatMoney(totalSum, 0, "Rp."));
				$("#totalbyr").val(formatMoney(sisaSum, 0, "Rp."));
				$("#uangm").val(formatMoney(sisaSum, 0, "Rp."));
				$("#total_bayar").val(sisaSum);
				$("#uangm").attr("readonly", true);
				$(".lunasd").attr("disabled", true);
				$(".n-bayar").attr("disabled", true);
			}
		});
		$("#Bayar2").filter(function() {
			if (this.checked) {
				var totalSum = angka($("#totalSum").val());
				var sisaSum = angka($("#sisaSum").val());
				/** @type {number} */
				
				$("#sisabayar").val(formatMoney(totalSum, 0, "Rp."));
				$("#totalbyr").val(formatMoney(sisaSum, 0, "Rp."));
				$("#uangm").val(formatMoney(sisaSum, 0, "Rp."));
				$("#total_bayar").val(sisaSum);
				$("#uangm").attr("readonly", false);
				$(".lunasd").attr("disabled", false);
				$(".n-bayar").attr("disabled", false);
			}
		});
		} else {
		if (req.ok == "ok" && req.tipe == "print") {
			sweet_cetak(req.id, req.total, req.idkon);
			} else {
			sweet("Peringatan!!!", "Data gagal disimpan", "error", "danger");
		}
	}
	$('#keranjang').loading('stop');
}
$(document).on("click", ".print", function(event) {
	event.preventDefault();
	event.stopPropagation();
	var prevStoryId = $(this).attr("data-id");
	var readersLength = $("#tablein > tbody").children().length;
	var totalSum = angka($("#totalSum").val());
	var idkon = angka($("#id_konsumen").val());
	
	if (totalSum == 0) {
		showNotif("top-right", "Peringatan!!", "Order masih kosong", "warning");
		$("#kodeproduk_" + r).focus();
		} else {
		/** @type {number} */
		var r = 0;
		for (; r < readersLength; r++) {
			var ukuran = $("#ukuran_" + r).val();
			var aDraggedText = $("#kodeproduk_" + r).val();
			kodeproduk = aDraggedText.replace(/\s/g, "");
			if (kodeproduk == "" || kodeproduk == "-" || kodeproduk == 1) {
				showNotif("top-right", "Simpan", "Produk masih kosong", "warning");
				$("#kodeproduk_" + r).focus();
				return;
			}
			if ($("#ket_" + r).val() == "") {
				showNotif("top-right", "Simpan", "Keterangan masih kosong", "warning");
				$("#ket_" + r).focus();
				return;
			}
			var prop = $("#bahan_" + r).val();
			prop = prop.replace(/\s/g, "");
			if (prop == "" || prop == "-" || prop == 1) {
				showNotif("top-right", "Simpan", "Bahan masih kosong", "warning");
				$("#bahan_" + r).focus();
				return;
			}
			var stat = $("#status_" + r.toString()).val();
			if(stat > 0 && ukuran ==''){
				showNotif("top-right", "Peringatan!!", "Ukuran masih kosong", "warning");
				$("#ukuran_" + r.toString()).focus();
				return;
			}
			if ($("#jumlah_" + r).val() == "") {
				showNotif("top-right", "Simpan", "Jumlah masih kosong", "warning");
				$("#jumlah_" + r).focus();
				return;
			}
			if ($("#harga_" + r).val() == "") {
				showNotif("top-right", "Simpan", "Harga masih kosong", "warning");
				$("#harga_" + r).focus();
				return;
			}
			if ($("#satuan_" + r).val() == "") {
				showNotif("top-right", "Simpan", "Satuan masih kosong", "warning");
				$("#satuan_" + r).focus();
				return;
			}
		}
		if (idkon == 1 && kasir ==1) {
			sweet_time(500, "Peringatan!!!", "Maaf Pelanggan kosong");
			cari_show(prevStoryId);
			$('#keranjang').loading('stop');
			return;
		}
		cek_data_total(prevStoryId);
	}
});
/**
	* @param {string} id
	* @return {undefined}
*/
function cek_data_total(id) {
	var pajak = $("#pajaksum").val();
	var iduser = $("#iduser").val();
	$.ajax({
		type : "POST",
		url : base_url + "penjualan/cek_data_total",
		data : {
			id : id,
			iduser : iduser,
			pajak : pajak
		},
		dataType : "json",
		beforeSend : function() {
		},
		success : handleData
	});
}
/**
	* @param {!Object} result
	* @return {undefined}
*/
function handleData(result) {
	var ownerStyles = angka($("#idlunas").val());
	var tentacleGroupCount = angka($("#totalSum").val());
	var canCreateDiscussions = $("#id_konsumen").val();
	var status_data = $("#status").val();
	/** @type {string} */
	var pluginName = "print";
	if (result.status == "harus_dp") {
		// sweet("Peringatan!!!", result.msg, "warning", "warning");
		action_save("warning",result.msg,"warning");
		return
		}else if (result.ok == "ok") {
		var selfTabId = result.id;
		var courseSections = result.iduser;
		var total = result.total;
		$.ajax({
			type : "POST",
			url : base_url + "penjualan/update_lunas",
			data : {
				id : selfTabId,
				iduser : courseSections,
				total : total,
				status : status_data
			},
			dataType : "json",
			success : function(retu_data) {
				if(retu_data.ok=='ok'){
					$('#cari_produk').attr('disabled',true);
					$('#button-simpan').attr('disabled',true);
					$('.show_qr').attr('disabled',true);
					}else{
					$('#cari_produk').attr('disabled',false);
					$('#button-simpan').attr('disabled',false);
					$('.show_qr').attr('disabled',false);
				}
				searchFilter();
			},
			error : function(res, status, httpMessage) {
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
		sweet_cetak(result.id, tentacleGroupCount, canCreateDiscussions);
		} else {
		simpan_data(result.id, result.iduser, ownerStyles, tentacleGroupCount, pluginName, canCreateDiscussions);
	}
}
$(document).on("click", ".pending", function(canCreateDiscussions) {
	var uangmuka = angka($("#uangmuka").val());
	if (uangmuka > 0) {
		sweet("Peringatan!!!", "Data tidak bisa di pending karena sudah ada pembayaran", "warning", "warning");
	}
});
$(document).on("click", ".simpan", function(event) {
	event.preventDefault();
	event.stopPropagation();
	var prevStoryId = $(this).attr("data-id");
	var readersLength = $("#tablein > tbody").children().length;
	var programStatusId = $("#iduser").val();
	var id_konsumen = $("#id_konsumen").val();
	var ownerStyles = angka($("#idlunas").val());
	var tentacleGroupCount = angka($("#totalSum").val());
	if (id_konsumen == 1) {
		sweet("Peringatan!!!", "Maaf Pelanggan masih kosong", "warning", "warning");
		} else {
		if (tentacleGroupCount == 0) {
			sweet("Peringatan!!!", "Maaf data masih kosong", "warning", "warning");
			} else {
			/** @type {number} */
			var r = 0;
			for (; r < readersLength; r++) {
				if ($("#kodeproduk_" + r).val() == "") {
					sweet("Peringatan!!!", "kodeproduk masih kosong", "warning", "warning");
					return;
				}
				if ($("#jenis_cetakan_" + r).val() == "") {
					sweet("Peringatan!!!", "jenis_cetakan_ masih kosong", "warning", "warning");
					return;
				}
				if ($("#ket_" + r).val() == "") {
					sweet("Peringatan!!!", "Keterangan masih kosong", "warning", "warning");
					return;
				}
				if ($("#bahan_" + r).val() == "") {
					sweet("Peringatan!!!", "Bahan masih kosong", "warning", "warning");
					return;
				}
				if ($("#jumlah_" + r).val() == "") {
					sweet("Peringatan!!!", "jumlah_ masih kosong", "warning", "warning");
					return;
				}
				if ($("#satuan_" + r).val() == "") {
					sweet("Peringatan!!!", "satuan_ masih kosong", "warning", "warning");
					return;
				}
				if ($("#harga_" + r).val() == "") {
					sweet("Peringatan!!!", "harga_ masih kosong", "warning", "warning");
					return;
				}
				if ($("#harga_" + r).val() == 0) {
					sweet("Peringatan!!!", "harga_ masih kosong", "warning", "warning");
					return;
				}
			}
			simpan_data(prevStoryId, programStatusId, ownerStyles, tentacleGroupCount);
		}
	}
});
$(document).on("click", ".delbayar", function(event) {
	event.preventDefault();
	event.stopPropagation();
	var sampleID = $(this).attr("data-id");
	var rcpt = $(this).attr("data-idin");
	var kunci = $(this).attr("data-kunci");
	var idbayar = $(this).attr("data-bayar");
	var min = $(this).attr("data-jml");
	if (kunci == 0) {
		sweet("Peringatan!!!", "data tidak bisa dihapus hub. admin", "warning", "warning");
		return;
	}
	
	$.ajax({
		type : "POST",
		url : base_url + "penjualan/del_bayar",
		data : {
			id : sampleID,
			noin : rcpt,
			kunci : kunci,
			idbayar : idbayar,
			jml : min
		},
		dataType : "json",
		beforeSend : function() {
			$(".tbayar").loading({zIndex:1060});
		},
		success : function(stats) {
			if (stats.ok == "ok") {
				var max = angka($("#uangmuka").val());
				var row_prefix_len = angka($("#sisaSum").val());
				var value = parseInt(angka(row_prefix_len)) + min;
				/** @type {number} */
				var val = parseInt(max) - parseInt(min);
				$("#sisaSum").val(formatMoney(value, 0, "Rp."));
				$("#uangmuka").val(formatMoney(val, 0, "Rp."));
				load_list(rcpt);
				doMath();
			}
			$(".tbayar").loading('stop');
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
			$(".tbayar").loading('stop');
		}
	});
});
$("#Bayar1").change(function() {
	if (this.checked) {
		
		var sisaSum = angka($("#sisaSum").val());
		/** @type {number} */
		
		$("#totalbyr").val(formatMoney(sisaSum, 0, "Rp."));
		$("#uangm").val(formatMoney(sisaSum, 0, "Rp."));
		$("#total_bayar").val(sisaSum);
		$("#uangm").attr("readonly", true);
		$("#kembalian").val(formatMoney(0, 0, "Rp."));
		$(".lunasd").attr("disabled", true);
		$(".n-bayar").attr("disabled", true);
	}
});

$(".n-bayar").click(function() {
	var value = $(this).attr("data-id");
	var min = angka($("#sisaSum").val());
	if (value > parseInt(min)) {
		/** @type {number} */
		kembalian = parseInt(value) - parseInt(min);
		// $("#totalbyr").val(formatMoney(value, 0, "Rp."));
		$("#kembalian").val(formatMoney(kembalian, 0, "Rp."));
		$("#total_bayar").val(formatMoney(min, 0, "Rp."));
		} else {
		// $("#totalbyr").val(formatMoney(value, 0, "Rp."));
		$("#kembalian").val(formatMoney(0, 0, "Rp."));
		$("#total_bayar").val(value);
	}
	$("#uangm").val(formatMoney(value, 0, "Rp."));
});
$("#Bayar2").change(function() {
	if (this.checked) {
		var sisabayar = $("#sisabayar").val();
		var value = angka($("#uangmuka").val());
		// console.log(value)
		// $("#totalbyr").val(formatMoney(value, 0, "Rp."));
		$("#uangm").val(formatMoney(0, 0, "Rp."));
		$("#total_bayar").val(0);
		$("#uangm").attr("readonly", false);
		$(".lunasd").attr("disabled", false);
		$(".n-bayar").attr("disabled", false);
	}
});
/**
	* @param {string} action
	* @param {number} fname
	* @param {?} callback
	* @return {undefined}
*/
function save_data(action, fname, callback) {
	sweet_time(500, "Status!!!", "Data sedang disimpan");
	$.ajax({
		type : "POST",
		url : base_url + "penjualan/simpan_data",
		data : {
			id : action,
			idk : callback,
			total : fname,
			simpan : "simpan"
		},
		cache : false,
		dataType : "json",
		beforeSend : function() {
			$('body').loading();
		},
		success : function(data) {
			if (data.status == 200) {
				$("#OpenCart-1").modal("hide");
				} else {
			}
			$('body').loading('stop');
			searchFilter();
		},
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
			$('body').loading('stop');
		}
	});
}
$(".print_pdf").click(function() {
	var sampleID = $(this).attr("data-id");
	$.ajax({
		type : "POST",
		url : base_url + "produk/print_cek",
		data : {
			id : sampleID
		},
		dataType : "json",
		beforeSend : function() {
			$('body').loading();
		},
		success : handlePrint,
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
			$('body').loading();
		}
	});
});
/**
	* @param {string} newWayId
	* @return {undefined}
*/
function cetak(newWayId) {
	$.ajax({
		type : "POST",
		url : base_url + "produk/print_cek",
		data : {
			id : newWayId
		},
		dataType : "json",
		beforeSend : function() {
			$('body').loading();
		},
		success : handlePrint,
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
			$('body').loading();
		}
	});
}
/**
	* @param {!Object} params
	* @return {undefined}
*/
function handlePrint(params) {
	if (params.status == 200) {
		var id = params.id;
		var url = params.encrypt_url;
		var requireCacheUrl = base_url + "produk/print_invoice/" + url;
		var remoteUrl = base_url + "produk/print_invoice_html/" + url;
		if (thermal === 1) {
			$("#OpenCart-1").modal("hide");
			$.post(remoteUrl, {
				id : id
				}, function(data, status) {
				if (status == "success") {
				}
			});
			// console.log(1)
			}else if (thermal === 2) {
			$("#OpenCart-1").modal("hide");
			$.post(remoteUrl, {
				id : id
				}, function(data, status) {
				if (status == "success") {
				}
			});
			// console.log(2)
			}else if (thermal === 3) {
			// console.log(3)
			$("#OpenCart-1").modal("hide");
			window.open(remoteUrl, '_blank');
			
			}else if (thermal === 4) {
			$("#OpenCart-1").modal("hide");
			window.open(remoteUrl, '_blank');
			// console.log(4)
			} else {
			$("#OpenCart-1").modal("hide");
			$(".cetak_invoice").html(id);
			$(".invoice_print_url").html('<a href="' + requireCacheUrl + '" target="_blank"><i class="fas fa-file-pdf"></i></a>');
			$(".print_url").html('<a href="' + remoteUrl + '" target="_blank"><i class="fa fa-print"></i> Cetak Invoice</a>');
			$("#print-4").modal({
				backdrop : "static",
				keyboard : false
			});
			$(".load-pdf").html('<iframe  id="documentiframe" src="' + base_url + "produk/print_invoice/" + url + '" frameborder="no" width="100%" height="600px" onload="success()"></iframe>');
		}
		searchFilter();
	}
	$('body').loading();
}

$("body").on("hidden.bs.modal", ".modal", function(e) {
	e.preventDefault();
	e.stopPropagation();
	$(this).removeData("bs.modal");
	$(this).find("input,textarea,select").val('').end();
	$('body').loading('stop');
	$("#pending,#bayarin,#simpan,#batal").prop("disabled", false);
	e.stopPropagation();
	
});
$("#pembayaran-5").on("show.bs.modal", function() {
	$("#id_byr").val(0);
	$("#uangm").val(formatMoney(0, 0, "Rp."));
	$("#totalbyr").val(0);
	$("#kembalian").val(formatMoney(0, 0, "Rp."));
	$("#sumpajak").val(formatMoney(0, 0, "Rp."));
	$(".rekening").attr("disabled", true);
	$(".bayar_l").attr("disabled", true);
});
$("#pembayaran-5").on("hide.bs.modal", function() {
	$("#id_byr").val(0);
	$("#uangm").val(formatMoney(0, 0, "Rp."));
	$("#totalbyr").val(0);
	$("#kembalian").val(formatMoney(0, 0, "Rp."));
	$("#sumpajak").val(formatMoney(0, 0, "Rp."));
});

// $(".cek_transaksi").on('click', function (e) {

$('.cek_transaksi').unbind().on('click', function (e) {
	e.preventDefault();
	e.stopPropagation();
	var id = $(this).data("id");
	var mod = $(this).data("modedit");
	$.ajax({
		type : "POST",
		url : base_url + "main/cek_akses",
		data : {
			id : id,
			mod : mod
		},
		dataType : "json",
		cache: false,
		beforeSend : function() {
			$('body').loading();
		},
		success : handle_Cart,
		error : function(res, status, httpMessage) {
			$('body').loading('stop');
			if(res.status==401){
				// console.log(401);
				sweet_login(httpMessage,'warning',base_url);
				}else{
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}			
			
		}
	});
	
});

$('.button_transaksi').unbind().on('click', function (e) {
	e.preventDefault();
	e.stopPropagation();
	var id = $(this).data("id");
	var mod = $(this).data("modedit");
	$.ajax({
	type : "POST",
	url : base_url + "main/cek_akses",
	data : {
		id : id,
		mod : mod
	},
	dataType : "json",
	cache: false,
	beforeSend : function() {
		$('body').loading();
	},
	success : handle_Cart,
	error : function(res, status, httpMessage) {
		$('body').loading('stop');
		if(res.status==401){
			// console.log(401);
			sweet_login(httpMessage,'warning',base_url);
			}else{
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}			
		
	}
});
});
/**
	* @param {!Object} result
	* @return {undefined}
*/
function handle_Cart(result) {
	// console.log(result);
	$('body').loading('stop');
	$("#OpenCart-1").addClass("in");
	if (result.status == 200) {
		$("#OpenCart-1").modal("show");
		var id = result.id;
		var permissions = result.mod;
		$("#print_pdf").attr("data-id", id);
		$("#batal_order").attr("data-id", id);
		$("#batal_order").attr("data-modEdit", "batal");
		if (permissions == "view" && result.total_order == result.total_bayar && result.total_order > 0) {
			$("#print").hide();
			$("#bayarin").hide();
			$("#pending").hide();
			$("#batal_order").show();
			$("#print_pdf").show();
			} else {
			$("#print").show();
			$("#bayarin").show();
			$("#pending").show();
			$("#batal_order").hide();
			$("#print_pdf").hide();
		}
		$.ajax({
			type : "POST",
			url : base_url + "penjualan/cart",
			data : {
				id : id,
				edit : permissions
			},
			cache : false,
			beforeSend : function() {
				$("script[src*='penjualan.js']").remove();
			},
			success : function(htmlExercise) {
				$.getScript(base_url + "assets/js/penjualan.js");
				$(".load-data").html(htmlExercise);
				// $("#OpenTrx-1").modal("hide");
			},
			error : function(res, status, httpMessage) {
				if(res.status==401){
					sweet_login(httpMessage,'warning',base_url);
					}else{
					sweet("Peringatan!!!", httpMessage, "warning", "warning");
				}	
				$('body').loading('stop');
			}
		});
		} else {
		Swal.fire({
			title : result.msg,
			icon : "warning",
			showDenyButton : false,
			showCancelButton : false,
			confirmButtonText : "OK",
			denyButtonText : `Don't save`
			}).then((tx) => {
			if (tx.isConfirmed) {
				// $("#OpenTrx-1").modal("hide");
				$("#OpenCart-1").modal("hide");
				$('body').loading('stop');
				} else {
				if (tx.isDenied) {
					Swal.fire("Changes are not saved", "", "info");
					$('body').loading('stop');
				}
			}
		});
	}
}
/**
	* @return {undefined}
*/
function hideCart() {
	$("#OpenCart-1").removeClass("in");
	$("#OpenCart-1").hide();
	
	$(".modal-backdrop").remove();
	$('body').loading('stop');
}
// $("#OpenTrx-1").on("show.bs.modal", function(event) {
// var url = $(event.relatedTarget).data("id");
// $.ajax({
// type : "POST",
// url : base_url + "penjualan/trx/" + url,
// cache : false,
// beforeSend : function() {
// $('body').loading();
// },
// success : function(htmlExercise) {
// $('body').loading('stop');
// $(".load-trx").html(htmlExercise);
// },
// error : function(res, status, httpMessage) {
// if(res.status==401){
// sweet_login(httpMessage,'warning',base_url);
// }else{
// sweet("Peringatan!!!", httpMessage, "warning", "warning");
// }	
// $('body').loading('stop');
// }
// });
// });
$("#OpenKon").on("show.bs.modal", function(event) {
	var url = $(event.relatedTarget).data("id");
	$.ajax({
		type : "POST",
		url : base_url + "konsumen/data_konsumen/" + url,
		cache : false,
		beforeSend : function() {
			$('body').loading();
		},
		success : function(htmlExercise) {
			$('body').loading('stop');
			$(".load-data-konsumen").html(htmlExercise);
		},
		error : function(res, status, httpMessage) {
			if(res.status==401){
				sweet_login(httpMessage,'warning',base_url);
				}else{
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}	
			$('body').loading('stop');
		}
	});
});
$(".pajakd").click(function() {
	$("#pajak").prop("disabled",false);
	$("#pajakd").hide();
	$("#batal").show();
	$("#savpajak").show();
	$("#kembalian").val(formatMoney(0, 0, "Rp."));
	$("#uangm").val(formatMoney(0,0,"Rp."));
	$("#totalbyr").val(0);
});
$('#lampiran').val('');
$(".bayar_l").click(function(e) {
	e.preventDefault();
	e.stopPropagation();
	var num_splits = $("#tablein > tbody").children().length;
	var right = angka($("#totalbyr").val());
	var left = angka($("#uangm").val());
	var totalSum = angka($("#totalSum").val());
	var sisabayar = angka($("#sisabayar").val());
	var noin = $("#id_invoice").val();
	var uid = $("#marketing").val();
	var attString = $("#id_byr").val();
	var diskon = angka($("#diskon").val());
	var tdiskon = angka($("#tdiskon").val());
	var nourut = $("#no_bayar").val();
	var pajak = angka($("#pajak").val());
	var kembalian = angka($("#kembalian").val());
	var rekening = $("#rekening").val();
	var lampiran = $('#lampiran').prop('files')[0];
	
	if (parseInt(left) < parseInt(right)) {
		right = left;
	}
	if (attString == 1) {
		/** @type {number} */
		rekening = 0;
		} else {
		if (rekening == 0) {
			sweet_time(5000, "Status!!!", "Rekening belum dipilih");
			return;
		}
		rekening = rekening;
	}
	if (rekening >0 && lampiran==undefined) {
		sweet_time(5000, "Status!!!", "Lampiran belum dipilih");
		return;
	}
	var form_data = new FormData(); // Creating object of FormData class
	form_data.append("lampiran", lampiran) 
	form_data.append("uang", right)
	form_data.append("sisabayar", sisabayar)
	form_data.append("noin", noin)
	form_data.append("uid", uid)
	form_data.append("id_byr", attString)
	form_data.append("rekening", rekening)
	form_data.append("nourut", nourut)
	form_data.append("pajak", pajak)
	form_data.append("type", 'simpan_bayar')
	// console.log(lampiran);return;
	if (attString == "" || attString == 0) {
		sweet_time(5000, "Status!!!", "Cara bayar belum dipilih");
		} else {
		if (left == "" || left == 0) {
			sweet_time(5000, "Status!!!", "Uangnya masih kosong");
			$("#uangm").focus();
			} else {
			$("#bayar_l").prop("disabled", true);
			$("#pending").hide();
			$("#pending").prop("disabled", true);
			$("#batal_order").show();
			$.ajax({
				url : base_url + "penjualan/save_bayar",
				dataType : "json",
				method : "POST",
				secureuri :false,
				processData:false,
				contentType:false,
				cache:false,
				async:false,
				data:form_data,
				beforeSend : function() {
					$("#saving-bayar").loading({zIndex:1051,message:'saveing data'});
					$("#bayar_l").html('<i class="fa fa-spinner fa-spin"></i>');
					$("#error_piutang").css("display", "block");
				},
				success : function(data) {
					if (data.status == 301 && data.id >0) {
						sweet("Peringatan!!!", data.msg, "warning", "warning");
						searchFilter();
						$("#pembayaran-5").modal("hide");
						}else if (data.status == 304) {
						sweet("Peringatan!!!", "Pajak belum disimpan", "warning", "warning");
						} else {
						if (data.status == 200) {
							var index = data.total;
							var bayar = data.uang;
							var totalSum = angka($("#totalSum").val());
							var top = angka($("#uangmuka").val());
							var row_prefix_len = angka($("#sisaSum").val());
							/** @type {number} */
							var val = parseInt(angka(row_prefix_len)) - bayar;
							/** @type {number} */
							var value = parseInt(top) + parseInt(bayar);
							$("#sisaSum").val(formatMoney(val, 0, "Rp."));
							$("#uangmuka").val(formatMoney(value, 0, "Rp."));
							$("#sisabayar").val(formatMoney(totalSum, 0, "Rp."));
							$("#uangm").val(formatMoney(0, 0, "Rp."));
							if (value == index) {
								/** @type {number} */
								$("#cari_produk").prop("disabled", true);
								$("#button-simpan").attr("disabled", true);
								$(".show_qr").attr("disabled", true);
								var i = 0;
								for (; i < num_splits; i++) {
									
									$("#case" + i).prop("disabled", true);
									$("#harga_" + i).prop("readonly", true);
									$("#ket_" + i).prop("readonly", true);
									$("#satuan_" + i).attr("readonly", true);
									$("#bahan_" + i).prop("readonly", true);
									$("#hargasatuan_" + i).prop("readonly", true);
									$("#jumlah_" + i).prop("readonly", true);
									$("#ukuran_" + i).prop("readonly", true);
									$("#kodeproduk_" + i).prop("readonly", true);
									$("#jenis_cetakan_" + i).prop("readonly", true);
									$("#diskon_" + i).prop("readonly", true);
								}
								searchFilter();
								} else {
								/** @type {number} */
								i = 0;
								for (; i < num_splits; i++) {
									$("#case" + i).prop("disabled", true);
									$("#kodeproduk_" + i).prop("readonly", true);
									$("#jenis_cetakan_" + i).prop("readonly", true);
									$("#bahan_" + i).prop("readonly", true);
									$("#satuan_" + i).prop("readonly", true);
									$("#ukuran_" + i).prop("readonly", true);
									$("#jumlah_" + i).prop("readonly", true);
									$("#hargasatuan_" + i).prop("readonly", true);
									$("#harga_" + i).prop("readonly", true);
									$("#diskon_" + i).prop("readonly", true);
								}
							}
							searchFilter();
							$("#pembayaran-5").modal("hide");
							} else {
							sweet("Peringatan!!!", "Data gagal disimpan", "warning", "warning");
						}
					}
					$("#bayar_l").prop("disabled", false);
					$("#bayar_l").html("Simpan");
					$("#saving-bayar").loading('stop');
				},
				error : function(res, status, httpMessage) {
					if(res.status==401){
						sweet_login(httpMessage,'warning',base_url);
						}else{
						sweet("Peringatan!!!", httpMessage, "warning", "warning");
					}	
					$("#bayar_l").prop("disabled", false);
					$("#bayar_l").html("Simpan");
					$("#saving-bayar").loading('stop');
				}
			});
		}
	}
});

$('#Bayar1-1').val($(this).is(':checked'));

$("#id_byr").filter(function() {
	$(".lampiran").hide();
	$("select[data-source]").each(function() {
		var element = $(this);
		element.append('<option value="0">Pilih</option>');
		$.ajax({
			url : element.attr("data-source")
			}).then(function(buildInTemplates) {
			buildInTemplates.map(function(match) {
				var url = $("<option>");
				url.val(match[element.attr("data-valueKey")]).text(match[element.attr("data-displayKey")]);
				element.append(url);
			});
		});
	});
});
$("#id_byr").change(function() {
	var id = $("#id_byr").val();
	$(".bayar_l").attr("disabled", false);
	$(".rekening").attr("disabled", true);
	$("#rekening").empty();
	if (id == 2) {
		$(".lampiran").show();
		// $(".pajak").hide();
		$.ajax({
			url : base_url + "pembayaran/get_rekening",
			type : "post",
			data : {
				type : "cari"
			},
			dataType : "json",
			success : function(response) {
				var msize = response.length;
				$(".rekening").attr("disabled", false);
				$("#rekening").append("<option value='0'>Pilih rekening</option>");
				/** @type {number} */
				var i = 0;
				for (; i < msize; i++) {
					var teg = response[i]["id"];
					var last_supr = response[i]["name"];
					$("#rekening").append("<option value='" + teg + "'>" + last_supr + "</option>");
				}
			}
		});
		} else {
		$(".lampiran").hide();
		// $(".pajak").show();
		if (id == 1) {
			$("#rekening").append("<option value='0'>Pilih rekening</option>");
			} else {
			$(".bayar_l").attr("disabled", true);
		}
	}
});
/**
	* @return {undefined}
*/
function load_jenis() {
	$.ajax({
		url : base_url + "pembayaran/jenis_pembayaran",
		type : "GET",
		dataType : "json",
		beforeSend : function() {
			$("#id_byr").append("<option value='loading'>loading</option>");
			$("#id_byr").empty();
		},
		success : function(response) {
			$("#id_byr option[value='loading']").remove();
			$("#id_byr").append("<option value=''>Pilih</option>");
			var msize = response.length;
			/** @type {number} */
			var i = 0;
			for (; i < msize; i++) {
				var teg = response[i]["id"];
				var last_supr = response[i]["name"];
				$("#id_byr").append("<option value='" + teg + "'>" + last_supr + "</option>");
			}
		}
	});
}

$("#form-finishing").submit(function(event) {
	event.preventDefault();
	event.stopPropagation();
	var maindata3 = $("#form-finishing").serialize();
	// console.log(2);
	$.ajax({
		url : base_url + "produk/update_finishing",
		type : "POST",
		data : maindata3,
		dataType : "json",
		beforeSend : function() {
			$('body').loading();
		},
		success : function(data) {
			// console.log(data);
			if (data.ok == "ok") {
				$("#DetailCart").modal("hide");
			}
			$('body').loading('stop');
		},
		error : function(res, status, httpMessage) {
			if(res.status==401){
				sweet_login(httpMessage,'warning',base_url);
				}else{
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}	
			$('body').loading('stop');
		}
	});
});
$("#form-tambah").submit(function(event) {
	event.preventDefault();
	event.stopPropagation();
	$("#error_namaadd").html("");
	$("#error_telepon_add").html("");
	$("#error_alamatadd").html("");
	$("#error_perusahaanadd").html("");
	$("#error_via").html("");
	var maindata3 = $("#form-tambah").serialize();
	$.ajax({
		url : base_url + "konsumen/input_konsumen",
		type : "post",
		data : maindata3,
		dataType : "json",
		success : function(a) {
			if (a.hasil == "sukses") {
				$("#modal-tambah-1").modal("hide");
				$("#id_konsumen").val(a.idk);
				$("#panggilan").val(a.nama);
				$("#namanya").html(a.nama);
				$("#tlpnya").html(a.telp);
				$("#alamatnya").html(a.alamat);
				$("#perusahaannya").html(a.perusahaan);
				$("#idmember").val(a.id_member);
				$("#idmember_add").val(a.id_member);
				$("#jenis_member").html(a.jenis_member);
				cek_harga_detail(a.idk);
				} else {
				if (a.hasil == "ada") {
					$("#error_telepon_add").html(a.telp);
					$("#error_input").hide();
					} else {
					if (a.hasil == "gagal") {
						$("#error_input").html(a.input);
						} else {
						$("#error_namaadd").html(a.nama);
						$("#error_telepon_add").html(a.telp);
						$("#error_alamatadd").html(a.alamat);
						$("#error_perusahaanadd").html(a.perusahaan);
					}
				}
			}
		},
		error : function(res, status, httpMessage) {
			if(res.status==401){
				sweet_login(httpMessage,'warning',base_url);
				}else{
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}	
		}
	});
});
$("#form-cari").submit(function(event) {
	event.preventDefault();
	event.stopPropagation();
	$("#error_nama_cari").html("");
	$("#error_caritlp").html("");
	$("#tlpnya").html("");
	var maindata3 = $("#form-cari").serialize();
	$.ajax({
		url : base_url + "konsumen/update_konsumen_cari",
		type : "POST",
		data : maindata3,
		dataType : "json",
		beforeSend : function() {
			$('body').loading();
			$("#error_piutang").css("display", "block");
			$("#jenis_member").html('');
		},
		success : function(a) {
			if (a.hasil == "ada") {
				$("#error_piutang").show();
				$("#error_piutang").html(a.error);
				} else {
				if (a.hasil == "sukses") {
					cek_harga_detail(a.idk)
					$("#id_konsumen").val(a.idk);
					$("#namanya").html(a.nama);
					$("#tlpnya").html(a.telp);
					$("#alamatnya").html(a.alamat);
					$("#perusahaannya").html(a.perusahaan);
					$("#jenis_member").html(a.jenis_member);
					$("#idmember").val(a.id_member);
					$("#idmember_add").val(a.id_member);
					$("#modal-cari-2").modal("hide");
					hideCari();
					} else {
					sweet("Peringatan!!!", "Maaf data tidak ditemukan", "warning", "warning");
				}
			}
			$('body').loading('stop');
			searchFilter();
		},
		error : function(res, status, httpMessage) {
			if(res.status==401){
				sweet_login(httpMessage,'warning',base_url);
				}else{
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}	
			$('body').loading('stop');
		}
	});
});

function cek_harga_detail(idkonsumen) {
	var str = $("#id_invoice").val();
	
	var b = $("#tablein > tbody").children().length;	
	for (var a = 0; a < b; a++) {
		// var idr = $("#id_rincianinvoice_" + a).val();
		var idbahan = $("#id_bahan_" + a.toString()).val();
		var status = $("#type_harga_" + a.toString()).val();
		var jumlah = $("#jumlah_" + a.toString()).val();
		var totukuran = $("#totukuran_" + a.toString()).val();
		update_invoice_detail(idkonsumen,idbahan,status,jumlah,a,totukuran);
	}
	
}
function update_invoice_detail(idkonsumen,idbahan,status,jumlah,baris,totukuran) {
	doMath();
	$.ajax({
		type: "POST",
		url: base_url + "penjualan/update_detail",
		data: {idkonsumen:idkonsumen,idbahan:idbahan,status:status,jumlah:jumlah,baris:baris,totukuran:totukuran},
		dataType: "json",
		success: function(res) {
			if (res.status == true) {
				$("#harga_"+ res.baris).val(res.harga);
				$('#satuan_'+res.baris+'  option[value="'+res.satuan+'"]').prop("selected", true);
				sav(res.baris);
				
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			if(xhr.status==401){
				sweet_login(thrownError,'warning',base_url);
				}else{
				sweet("Peringatan!!!", thrownError, "warning", "warning");
			}	
		}
	});
}
$(document).on("click", ".hapusbayar", function(event) {
	event.preventDefault();
	event.stopPropagation();
	var sampleID = $(this).attr("data-id");
	var idin = $(this).attr("data-idin");
	var kunci = $(this).attr("data-kunci");
	var idbayar = $(this).attr("data-bayar");
	var min = $(this).attr("data-jml");
	if (kunci == 0) {
		sweet("Peringatan!!!", "data tidak bisa dihapus hub. admin", "warning", "warning");
		return;
	}
	
	$.ajax({
		type : "POST",
		url : base_url + "pengeluaran/del_bayar",
		data : {
			id : sampleID,
			idin : idin,
			kunci : kunci,
			idbayar : idbayar,
			jml : min
		},
		dataType : "json",
		beforeSend : function() {
			$(".tbayar").loading({zIndex:1060});
		},
		success : function(stats) {
			if (stats.ok == "ok") {
				var max = angka($("#uangmuka").val());
				var row_prefix_len = angka($("#sisaSum").val());
				var value = parseInt(angka(row_prefix_len)) + min;
				/** @type {number} */
				var val = parseInt(max) - parseInt(min);
				$("#sisaSum").val(formatMoney(value, 0, "Rp."));
				$("#uangmuka").val(formatMoney(val, 0, "Rp."));
				load_list(rcpt);
				doMath();
			}
			$(".tbayar").loading('stop');
		},
		error : function(res, status, httpMessage) {
			if(res.status==401){
				sweet_login(httpMessage,'warning',base_url);
				}else{
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}	
			$(".tbayar").loading('stop');
		}
	});
});

$('#Bayar1').prop('checked', true);
