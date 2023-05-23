/**
    * @param {string} val
    * @param {number} precision
    * @param {string} prefix
    * @param {string} t
    * @param {string} decimal
    * @return {?}
*/
function formatMoney(val, precision, prefix, t, decimal) {
    val = val || 0;
    /** @type {number} */
    precision = !isNaN(precision = Math.abs(precision)) ? precision : 0;
    prefix = prefix !== undefined ? prefix : "";
    t = t || ".";
    decimal = decimal || ",";
    /** @type {string} */
    var sign = val < 0 ? "-" : "";
    /** @type {string} */
    var i = parseInt(val = Math.abs(+val || 0).toFixed(precision), 10) + "";
    /** @type {number} */
    var j = (j = i.length) > 3 ? j % 3 : 0;
    return prefix + sign + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (precision ? decimal + Math.abs(val - i).toFixed(precision).slice(2) : "");
}
/**
    * @param {!Object} options
    * @return {undefined}
*/
function formatNumber(options) {
    /** @type {string} */
    var url = "";
    var parts = options.value.toString().split("|");
    parts[0] = parts[0].replace(/[^0-9]/g, "");
    for (; parts[0].length > 3;) {
        /** @type {string} */
        url = "." + parts[0].substr(parts[0].length - 3, parts[0].length) + url;
        parts[0] = parts[0].substr(0, parts[0].length - 3);
    }
    options.value = parts[0] + url;
}
/**
    * @param {string} comment
    * @return {?}
*/
function angka(comment) {
	// console.log(comment);
    comment = comment ? comment : "";
    var sql = comment.replace("Rp.", "");
    var newClassName = replaceAll(".", "", sql);
    return newClassName;
}
/**
    * @param {string} substr
    * @param {string} replacement
    * @param {string} str
    * @return {?}
*/
function replaceAll(substr, replacement, str) {
    for (; str.indexOf(substr) > -1;) {
        str = str.replace(substr, replacement);
    }
    return str;
}
/**
    * @return {undefined}
*/
function doMath() {
    var Del = $("#tablein > tbody").children().length;
    /** @type {!Array} */
    var __WEBPACK_IMPORTED_MODULE_0__components_header__ = [];
    /** @type {!Array} */
    var __WEBPACK_IMPORTED_MODULE_0__assets_twitter_svg__ = [];
    /** @type {!Array} */
    var textGlowColor = [];
    /** @type {!Array} */
    var stride = [];
    /** @type {!Array} */
    var spacetime = [];
    /** @type {!Array} */
    var __WEBPACK_IMPORTED_MODULE_0__util_index__ = [];
    /** @type {number} */
    var t = 0;
    /** @type {number} */
    var bottomElementHeight = 0;
    /** @type {number} */
    var width = 0;
    /** @type {number} */
    var val = 0;
    /** @type {number} */
    var p = 0;
    /** @type {number} */
    var tot_uangmuka = 0;
    var value;
    t = angka($("#uangmuka").val());
    width = angka($("#pajaksum").val());
    /** @type {number} */
    var a = 0;
    for (; a < Del; a++) {
        if ($("#jumlah_" + a).length == 0) {
            continue;
        }
        __WEBPACK_IMPORTED_MODULE_0__components_header__[a] = $("#jumlah_" + a.toString()).val();
        __WEBPACK_IMPORTED_MODULE_0__assets_twitter_svg__[a] = $("#harga_" + a.toString()).val();
        textGlowColor[a] = $("#diskon_" + a.toString()).val();
        /** @type {number} */
        spacetime[a] = angka(__WEBPACK_IMPORTED_MODULE_0__assets_twitter_svg__[a]) * textGlowColor[a] / 100;
        /** @type {number} */
        __WEBPACK_IMPORTED_MODULE_0__util_index__[a] = angka(__WEBPACK_IMPORTED_MODULE_0__assets_twitter_svg__[a]) - spacetime[a];
        /** @type {number} */
        stride[a] = angka(__WEBPACK_IMPORTED_MODULE_0__components_header__[a]) * __WEBPACK_IMPORTED_MODULE_0__util_index__[a];
        document.getElementById("total_" + a.toString()).value = formatMoney(stride[a], 0, "Rp.");
        p = p + stride[a];
    }
    /** @type {number} */
    tot_uangmuka = parseInt(bottomElementHeight) + parseInt(angka(t));
    value = p + p * width / 100;
    /** @type {number} */
    val = p * width / 100 + p - angka(t);
    document.getElementById("uangmuka").value = formatMoney(angka(t), 0, "Rp.");
    document.getElementById("totalSum").value = formatMoney(value, 0, "Rp.");
    document.getElementById("sisaSum").value = formatMoney(val, 0, "Rp.");
    document.getElementById("pajak").value = width;
    document.getElementById("sisabayar").value = formatMoney(p, 0, "Rp.");
}
/**
    * @return {undefined}
*/
function doPengeluaran() {
    var inputsSize = $("#table_pengeluaran > tbody").children().length;
    /** @type {!Array} */
    var _inputValues = [];
    /** @type {!Array} */
    var aPerc = [];
    /** @type {!Array} */
    var PAIR_RESOLUTIONS_ = [];
    /** @type {number} */
    var sisa = 0;
    /** @type {number} */
    var value = 0;
    /** @type {number} */
    var i = 0;
    for (; i < inputsSize; i++) {
        if ($("#jum_" + i).length == 0) {
            continue;
        }
        _inputValues[i] = document.getElementById("jum_" + i.toString()).value;
        aPerc[i] = document.getElementById("pharga_" + i.toString()).value;
        /** @type {number} */
        PAIR_RESOLUTIONS_[i] = angka(_inputValues[i]) * angka(aPerc[i]);
        document.getElementById("ptotal_" + i.toString()).value = formatMoney(PAIR_RESOLUTIONS_[i], 0, "Rp.");
        value = value + PAIR_RESOLUTIONS_[i];
    }
    document.getElementById("total_pengeluaran").value = formatMoney(value, 0, "Rp.");
}
/**
    * @return {undefined}
*/
function dopembelian() {
    var inputsSize = $("#table_pembelian > tbody").children().length;
    /** @type {!Array} */
    var _inputValues = [];
    // var _satuanValues = [];
    /** @type {!Array} */
    var aPerc = [];
    /** @type {!Array} */
    var PAIR_RESOLUTIONS_ = [];
    /** @type {number} */
    var sisa = 0;
    /** @type {number} */
    var value = 0;
    /** @type {number} */
    var i = 0;
    for (; i < inputsSize; i++) {
        if ($("#jumbeli_" + i).length == 0) {
            continue;
        }
        _inputValues[i] = document.getElementById("jumbeli_" + i.toString()).value;
        // _satuanValues[i] = document.getElementById("jmlsatuan_" + i.toString()).value;
        aPerc[i] = document.getElementById("hargabeli_" + i.toString()).value;
        /** @type {number} */
        PAIR_RESOLUTIONS_[i] = angka(_inputValues[i]) * angka(aPerc[i]);
        document.getElementById("totalbeli_" + i.toString()).value = formatMoney(PAIR_RESOLUTIONS_[i], 0, "Rp.");
        value = value + PAIR_RESOLUTIONS_[i];
    }
    document.getElementById("total_pembelian").value = formatMoney(value, 0, "Rp.");
}
/**
    * @param {string} s
    * @param {!Object} v
    * @return {?}
*/
function formatRupiah(s, v) {
    var componentsStr = s.replace(/[^,\d]/g, "").toString();
    var obj = componentsStr.split(",");
    /** @type {number} */
    var path = obj[0].length % 3;
    var p = obj[0].substr(0, path);
    var drilldownLevelLabels = obj[0].substr(path).match(/\d{3}/gi);
    if (drilldownLevelLabels) {
        /** @type {string} */
        separator = path ? "." : "";
        /** @type {string} */
        p = p + (separator + drilldownLevelLabels.join("."));
    }
    p = obj[1] != undefined ? p + "," + obj[1] : p;
    return v == undefined ? p : p ? "Rp. " + p : "";
};

function add_more(i,idbahan,status_hitung,ukuran,harga)
{
    
    
    // count=$('#tablein tr').length;	
    if(i >= max_item){
        sweet('Peringatan!!!','Order maksimal '+max_item +' item','warning','warning');	
        return;
    }
    var cols = '<tbody>';
    cols += '<tr id="rowCount' + i + '" class="rowCount">';
    cols += '<td align="center"><input type="hidden" id="id_rincianinvoice_'+i+'" /><input type="checkbox" class="case" id="case'+i+'" /></td>';
    cols += '<td><div class="form-group p-0 m-0"><input class="form-control input-sm kodeproduk" type="text" id="kodeproduk_'+i+'" onchange="doMath()" onfocusout="sav('+i+')" /><input type="hidden" id="id_produk_'+i+'" /></div></td>'
    cols += '<td><div class="form-group p-0 m-0"> <input type="text" class="form-control input-sm input" id="jenis_cetakan_'+i+'" placeholder="-" onfocusout="sav('+i+')" readonly> <input type="hidden" id="id_jenis_'+i+'" /><input type="hidden" id="status_hitung_'+i+'" /><input type="hidden" id="type_harga_'+i+'" /></div></td>'
    
    cols += '<td><div class="form-group p-0 m-0"><input type="text" class="form-control input-sm input" placeholder="-" onchange="hitflexi('+i+');sav('+i+');doMath();" id="bahan_'+i+'" placeholder="0" /> <input type="hidden" id="id_bahan_'+i+'" onfocusout="sav('+i+')" /></div></td>';
    cols += '<td><div class="form-group p-0 m-0"><select onchange="doMath();sav('+i+')" name="satuan_'+i+'" id="satuan_'+i+'" class="form-control form-control-sm form-control-sm rounded-0 next" data-valueKey="id" data-displayKey="name" required></select><input type="hidden" class="form-control input-sm" id="id_satuan_'+i+'"/></div></td>';
    cols += '<td><div class="form-group p-0 m-0"> <input type="text" class="form-control input-sm ukur" onchange="sav('+i+');doMath();hitflexi('+i+');" id="ukuran_'+i+'" /> <input type="hidden" id="idukuran_'+i+'" /><input type="hidden" id="totukuran_'+i+'" /></div></td>'
    cols += '<td><div class="form-group p-0 m-0"> <input type="number" class="form-control input-sm ukur text-center next" onchange="harga_range('+i+')" onkeyup="formatNumber(this)" id="jumlah_'+i+'" value="1" min="1" max="50000" /></div></td>';
    cols += '<td><div class="form-group p-0 m-0"> <input type="text" class="form-control input-sm input next" onchange="doMath();sav('+i+')" onkeyup="formatNumber(this)" id="harga_'+i+'" placeholder="0" /><input class="form-control text-center input-sm" type="hidden" id="diskon_'+i+'" value="0" onchange="doMath();sav('+i+')" min="0" max="99" ></div></td>';
    cols += '<td class="text-right"><div class="form-group p-0 m-0"><input type="text" class="form-control input-sm totalsz text-right" id="total_'+i+'" placeholder="Rp.0" readonly /></div></td>';
    cols += '<td><div class="form-group p-0 m-0"><button type="button" id="button_'+i+'" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Finishing" onclick="getproduk('+i+')">...</button></div></td>';
    cols += '</tr></tbody>';
    
    $('#tablein').append(cols);
    
    $("#jumlah_"+i).focus();
    $("#jumlah_"+i).change(function() {
        if($("#jumlah_"+i).val()==0 || $("#jumlah_"+i).val()==''){
            $("#jumlah_"+i).val(1);
        }
    });
    
    $('#tablein >tbody input[type="checkbox"]').click(function() {
        var rowCount = $("#tablein > tbody tr").children().length;
        var countcheck = $('#tablein > tbody input[type="checkbox"]:checked').length;
        
        if (countcheck == 0) {
            $(".btnDelete").hide();
            $("#addmore").show();
        }
        if (countcheck > 0) {
            $(".btnDelete").show();
            $("#addmore").hide();
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
    bahan_cari(i,id_konsumen);
    
    hitung_flexi(a,idbahan,status_hitung,ukuran,harga)
  
    i++;
    
}


function hitung_flexi(a,idbahan,stat,ukuran,harga) {
    var id_member = document.getElementById("idmember").value;
    
	var h = cari_harga(idbahan,id_member);
    
    var jml = document.getElementById("jumlah_" + a.toString()).value;
    
	if(ukuran==''){
		document.getElementById("harga_" + a.toString()).value = formatMoney(h);
		return;
    }
	
	var separators = ['X', '\\\+', 'x', '\\\(', '\\\)', '\\*', '/', ':', '\\\?'];
	var sum2 = ukuran.toString().replace(/\,/g, '.');
	var data = sum2.split(new RegExp(separators.join('|'), 'g'));
	var l = parseFloat(data[0]);
	var p = parseFloat(data[1]);
	hasil = p * roundToHalf(l);
	hasil2 = p * l;
	document.getElementById("totukuran_" + a.toString()).value = hasil2;
	if (stat >0) {
		document.getElementById("harga_" + a.toString()).value = formatMoney((p * l) * angka(h));
		} else {
		document.getElementById("harga_" + a.toString()).value = formatMoney(harga);
    }
	doMath();
}
