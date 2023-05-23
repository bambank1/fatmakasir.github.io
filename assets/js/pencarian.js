$("#cari_order").keyup(function() {
    $(".cari_order").prop("disabled", this.value == "" ? true : false);
});

$("#cari_desain").keyup(function() {
    $(".cari_desain,.updateDesain,.cek_folder,.buka_folder,.cbtn").prop("disabled", this.value == "" ? true : false);
	if (event.keyCode == 13) {
    cariDesain();
    }
});

$("#myModalTab").on("hidden.bs.modal", function(event) {
    event.preventDefault();
    $(this).find("input,textarea,select").val("").end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    $("#hasil_cari").hide();
    $("#hasil_cari_order").hide();
    $("#hasil_cari_desain").hide();
    $("#detail_cetak").hide();
});
$("#myModalTab").on("show.bs.modal", function(canCreateDiscussions) {
    $("#link_folder").val("");
    $("#link_pelanggan").val("");
    $("#saved_file").val("");
    $("#cari_desain").val("");
    $("#detail_cetak").hide();
});
/**
	* @param {number} place
	* @return {undefined}
*/
function cariFilterIn(place) {
	place = place ? place : 0;
	var value = $("#keyword_cari").val();
	console.log(1);
	if (value.length >= 1) {
		$.ajax({
			type : "POST",
			url : base_url + "pencarian/cari_invoice",
			data : {
				page : place,
				keywords : value
            },
			beforeSend : function() {
				$(".load-cari").loading({zIndex:1080});
				$("#cari_invoice").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$("#cari_invoice").attr('disabled',true);
				$(".alert").hide();
				
            },
			success : function(statusText) 
            {
                $("#cari_invoice").attr('disabled',false);
				if (statusText == "error") 
                {
					sweet("Peringatan!!!", "Maaf No. Order tidak ditemukan", "warning", "warning");
                    clear_cari()
                    return;
					} else {
					if (statusText == "ada") 
                    {
						sweet("Peringatan!!!", "Maaf No. Order #" + value + " sudah dibatalkan", "warning", "warning");
                        clear_cari()
						return;
						} else {
						$("#staticBackdrop").modal("show");
						$("#hasil_cari").show();
						$("#hasil_cari").html(statusText);
                        $(".load-cari").loading('stop');
                        $("#cari_invoice").html('<i class="fa fa-search fa-sm"></i>');
                    }
                }
				
            },
			error : function(res, status, httpMessage) {
				$("#cari_invoice").html('<i class="fa fa-search fa-sm"></i>');
				$("#cari_invoice").attr('disabled',false);
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
				$(".load-cari").loading('stop');
            }
        });
    }
}
$(document).on("click", ".cari_invoice", function() {
	cariFilterIn();
	$('.custom-select').attr('style', 'height: 38px !important');
});
$("#keyword_cari").keyup(function(event) {
	if (event.keyCode == 13) {
		cariFilterIn();
    }
});
$(".cari_invoice").prop("disabled", true);
$("#keyword_cari").keyup(function() {
	$("#hasil_cari").hide();
	$(".cari_invoice").prop("disabled", this.value == "" ? true : false);
});

function clear_cari()
{
    $("#keyword_cari").val('');
    $(".load-cari").loading('stop');
    $("#cari_invoice").html('<i class="fa fa-search fa-sm"></i>');
    
}
$(document).on("click", ".save_cari", function() {
	var clojIsReversed = $("#idorder").val();
	var presetItemClicked = $("#idedit").val();
	var inactiveactivenotetext = $("#idkasir").val();
	var e = angka($("#jml_uang").val());
	if (e != "") {
		$.ajax({
			type : "POST",
			url : base_url + "produk/cari_nominal",
			data : {
				idorder : clojIsReversed,
				idedit : presetItemClicked,
				idkasir : inactiveactivenotetext,
				jml : e
            },
			success : handleCari,
			error : function(res, status, httpMessage) {
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
            }
        });
		return;
    }
	if (presetItemClicked == 0) {
		sweet("Peringatan!!!", "Maaf Status belum dipilih", "warning", "warning");
		return;
    }
	if (inactiveactivenotetext == 0) {
		sweet("Peringatan!!!", "Maaf kasir masih kosong", "warning", "warning");
		return;
    }
	simpan_cari(clojIsReversed, presetItemClicked, inactiveactivenotetext, e);
});
/**
	* @param {!Object} response
	* @return {undefined}
*/
function handleCari(response) {
	if (response.status == 400) {
		sweet("Peringatan!!!", "Maaf Nominal tidak ditemukan", "warning", "warning");
		return;
		} else {
		if (response.status == "edit") {
			$("#staticBackdrop").modal("hide");
			sweet("Edit!!!", "Pembayaran sudah bisa dihapus", "success", "success");
			return;
			} else {
			simpan_cari(response.idorder, response.idedit, response.idkasir, response.jml);
        }
    }
}
/**
	* @param {?} isSlidingUp
	* @param {number} event
	* @param {number} text
	* @param {string} images
	* @return {undefined}
*/
function simpan_cari(isSlidingUp, event, text, images) {
	$.ajax({
		"url" : base_url + "produk/save_cari_invoice",
		"data" : {
			idorder : isSlidingUp,
			idedit : event,
			idkasir : text,
			jml : images
        },
		"method" : "POST",
		"dataType" : "json",
		success : function(datas) {
			if (datas.status == 200) {
				$("#myModalTab").modal("hide");
				} else {
				if (datas.status == 400) {
					sweet("Peringatan!!!", datas.msg, "warning", "warning");
					} else {
					sweet("Peringatan!!!", "Maaf anda tidak punya akses", "warning", "warning");
					return;
                }
            }
			searchFilter();
			$("#myModalTab").modal("hide");
        },
		error : function(res, status, httpMessage) {
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
        }
    });
}

/**
    * @return {undefined}
*/
function cariDesain() {
    var CAPTURE_ID = $("#cari_desain").val();
    if (CAPTURE_ID.length >= 1) {
        $.ajax({
            type : "POST",
            dataType : "json",
            url : base_url + "pencarian/cari_invoice_desain",
            data : {
                id : CAPTURE_ID
            },
            beforeSend : function() {
                $(".load-cari").loading({zIndex:1080});
				$("#cari_invoice").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$("#cari_invoice").attr('disabled',true);
                $(".alert").hide();
                $("#link_folder").val("");
                $("#link_pelanggan").val("");
                $("#saved_file").val("");
                $("#detail_cetak").show();
            },
            success : function($scope) {
                if ($scope.status == 200) {
                    huruf = $scope.konsumen.nama.substring(0, 1);
                    /** @type {string} */
                    folder = $scope.konsumen.nama + " - " + $scope.konsumen.no_hp;
                    /** @type {string} */
                    saved_file = $scope.save_file.invoice + " - " + $scope.save_file.ket;
                    if (huruf.toLowerCase() <= "f") {
                        /** @type {string} */
                        var yunjiao = "A-F";
                        } else {
                        if (huruf.toLowerCase() <= "m") {
                            /** @type {string} */
                            yunjiao = "G-M";
                            } else {
                            if (huruf.toLowerCase() <= "s") {
                                /** @type {string} */
                                yunjiao = "N-S";
                                } else {
                                /** @type {string} */
                                yunjiao = "T-Z";
                            }
                        }
                    }
                    /** @type {string} */
                    var endpoint = "//" + $scope.folder.computer_name + "/" + yunjiao + "/" + huruf + "/" + folder;
                    /** @type {string} */
                    var path = "\\\\" + $scope.folder.computer_name + "\\" + yunjiao + "\\" + huruf + "\\" + folder;
                    $("#link_folder_hide").val(endpoint);
                    $("#link_folder").val(path);
                    $("#link_pelanggan").val(folder);
                    $("#saved_file").val(saved_file);
                    $(".hapusR").remove();
                    if ($scope.detail.length > 0) {
                        /** @type {number} */
                        i = 0;
                        for (; i < $scope.detail.length; i++) {
                            /** @type {!Date} */
                            var d = new Date($scope.detail[i]["tgl_ambil"]);
                            /** @type {number} */
                            var groupNamePrefix = d.getDate();
                            /** @type {number} */
                            var dupeNameCount = d.getMonth() + 1;
                            /** @type {number} */
                            var year = d.getFullYear();
                            /** @type {number} */
                            var _transactionName = d.getHours();
                            /** @type {number} */
                            var mins = d.getMinutes();
                            /** @type {string} */
                            var zmins = groupNamePrefix + "." + dupeNameCount + "." + year + "_" + _transactionName + "." + mins;
                            detail = $scope.detail[i]["detail"];
                            /** @type {string} */
                            finishing = "";
                            if (detail != null) {
                                /** @type {*} */
                                var item = JSON.parse(detail);
                                if (item.kode == $scope.detail[i]["id_rincianinvoice"]) {
                                    if (item.data.length > 0) {
                                        /** @type {number} */
                                        a = 0;
                                        for (; a < item.data.length; a++) {
                                            /** @type {string} */
                                            finishing = "F." + item.data[a]["title"] + "-" + item.data[a]["isi"] + "-";
                                        }
                                    }
                                    } else {
                                    /** @type {string} */
                                    finishing = "";
                                }
                            }
                            file_cetak = $scope.detail[i]["id_transaksi"] + "-U." + $scope.detail[i]["ukuran"] + "-Q." + $scope.detail[i]["jumlah"] + $scope.detail[i]["satuan"] + "-B." + $scope.detail[i]["bahan"] + "-P." + $scope.detail[i]["produk"] + "-K." + $scope.detail[i]["keterangan"] + "-" + finishing + "TGL." + zmins + "-FO." + $scope.detail[i]["fo"];
                            /** @type {string} */
                            tampil = "<div class='hapusR mb-1'><div class='input-group input-group-sm'><input class='form-control form-control-sm' id='fileD" + i + "' value='" + file_cetak + "' readonly><div class='input-group-append'><button type='button' class='cbtn btn btn-outline-secondary' data-clipboard-target='#fileD" + i + "'>Copy</button></div></div></div>";
                            $("#detail_cetak").append(tampil);
                        }
                    }
                    } else {
                    $("#cari_desain").val('');
                    $("#cari_invoice").attr('disabled',true);
					showNotif("top-center", $scope.msg, "error");
                    $(".hapusR").remove();
                }
                $(".load-cari").loading('stop');
				$("#cari_invoice").html('<i class="fa fa-search fa-sm"></i>');
				$("#cari_invoice").attr('disabled',false);
            },
            error : function(res, status, httpMessage) {
                sweet("Peringatan!!!", httpMessage, "warning", "warning");
                $(".load-cari").loading('stop');
            }
        });
    }
}
/**
    * @param {number} place
    * @return {undefined}
*/
function cariFilterOrder(place) {
    place = place ? place : 0;
    var value = $("#cari_order").val();
    if (value.length >= 1) {
        $.ajax({
            type : "POST",
            url : base_url + "pencarian/cari_invoice_order",
            data : {
                page : place,
                keywords : value
            },
            beforeSend : function() {
                $(".load-cari").loading({zIndex:1080});
                $("#cari_invoice_order").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $("#cari_invoice_order").attr('disabled',true);
            },
            success : function(statusText) {
                if (statusText == "error") {
                    sweet("Peringatan!!!", "Maaf No. Order tidak ditemukan", "warning", "warning");
                    return;
                    } else {
                    if (statusText == "ada") {
                        sweet("Peringatan!!!", "Maaf No. Order #" + value + " sudah dibatalkan", "warning", "warning");
                        return;
                        } else {
                        $("#staticBackdrop").modal("show");
                        $("#hasil_cari_order").show();
                        $("#hasil_cari_order").html(statusText);
                    }
                }
                $(".load-cari").loading('stop');
                $("#cari_invoice_order").html('<i class="fa fa-search fa-sm"></i>');
				$("#cari_invoice_order").attr('disabled',false);
            },
			error : function(res, status, httpMessage) {
				$("#cari_invoice_order").html('<i class="fa fa-search fa-sm"></i>');
				$("#cari_invoice_order").attr('disabled',false);
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
				$(".load-cari").loading('stop');
            }
        });
    }
}
$(document).on("click", ".cbtn", function() {
    var titleVal = $("#link_folder").val();
    var startDateTimeVal = $("#link_pelanggan").val();
    var resAIW = $("#saved_file").val();
    if (titleVal == "" || startDateTimeVal == "" || resAIW == "") {
        sweet("Peringatan!!!", "Maaf data masih kosong", "warning", "warning");
        return;
    }
});
$(document).on("click", ".updateDesain", function() {
    var LITERALS = $("#cari_desain").val();
    $.ajax({
        type : "POST",
        dataType : "json",
        url : base_url + "pencarian/update_desain",
        data : {
            keywords : LITERALS
        },
        beforeSend : function() {
        },
        success : function(status) {
            cariFilterOrder();
            sweet_time(status.timer, "Status!!!", status.msg);
        }
    });
});
$(document).on("click", ".buka_folder", function() {
    var prefix = $("#link_folder").val();
    if (prefix == "") {
        sweet("Peringatan!!!", "Maaf folder masih kosong", "warning", "warning");
        return;
    }
    $.ajax({
        type : "POST",
        dataType : "json",
        url : base_url + "pencarian/open_folder",
        data : {
            folder : prefix
        },
        beforeSend : function() {
        },
        success : function(status) {
            sweet_time(status.timer, "Status!!!", status.msg);
        }
    });
});
$(document).on("click", ".cek_folder", function() {
    var prefix = $("#link_folder_hide").val();
    if (prefix == "") {
        sweet("Peringatan!!!", "Maaf link folder masih kosong", "warning", "warning");
        return;
    }
    $.ajax({
        type : "POST",
        dataType : "json",
        url : base_url + "pencarian/cek_folder",
        data : {
            folder : prefix
        },
        beforeSend : function() {
        },
        success : function(status) {
            sweet_time(status.timer, "Status!!!", status.msg);
        }
    });
});
$(document).on("click", ".cari_order", function() {
    cariFilterOrder();
});
$("#cari_order").keyup(function(event) {
    if (event.keyCode == 13) {
        cariFilterOrder();
    }
});
$(".cari_desain").prop("disabled", true);
$(".updateDesain").prop("disabled", true);
$(".cari_order").prop("disabled", true);
$(".cek_folder").prop("disabled", true);
$(".buka_folder").prop("disabled", true);
$(".cbtn").prop("disabled", true);
$("#cari_order").keyup(function() {
    
    $("#hasil_cari_order").hide();
    $(".cari_order").prop("disabled", this.value == "" ? true : false);
	
});
