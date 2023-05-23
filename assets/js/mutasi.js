var dari = start.format('MM/DD/YYYY');
var sampai = end.format('MM/DD/YYYY');
$('#startdate').val(dari);
$('#enddate').val(sampai);
$(document).on("click",".ranges  li",function() {
	const start_date = $('input[name="daterangepicker_start"]').val();
	const end_date = $('input[name="daterangepicker_end"]').val();
	$('#startdate').val(start_date);
	$('#enddate').val(end_date);
	search_Mutasi(0,start_date,end_date);
});
$(document).on("click",".applyBtn",function() {
	const start_date = $('input[name="daterangepicker_start"]').val();
	const end_date = $('input[name="daterangepicker_end"]').val();
	$('#startdate').val(start_date);
	$('#enddate').val(end_date);
	search_Mutasi(0,start_date,end_date);
	
});
search_Mutasi(0,dari,sampai);

function search_Mutasi(page_num,startdate,enddate){
	page_num = page_num?page_num:0;
	startdate = startdate?startdate:'';
	enddate = enddate?enddate:'';
	$.ajaxQueue({
		type: 'POST',
		url: base_url+"kas/cariMutasi/"+page_num,
		data:{page:page_num,dari:startdate,sampai:enddate},
		dataType: 'html',
		beforeSend: function(){
			$('body').loading();
		},
		success: function(data){
			if (data=='NONE'){
				$("#dataMutasi").hide();
				}else{
				$("#dataMutasi").show();
				$('#dataMutasi').html(data);
			}
			$('body').loading('stop');
		},
		error: function(xhr, status, error) {
			var err = xhr.responseText ;
			sweet('Server!!!',err,'error','danger');
			$('body').loading('stop');
		}
	});
}
$('.input').click(function() {
	this.select();
});
$(document).on('click','.add_mutasi',function(e){
	e.preventDefault();
	var id = $(this).attr('data-id');
	$('#ModalMutasi').modal({backdrop: 'static', keyboard: false});
	// $("#dari_kas").attr('disabled',true);
	$("#tujuan").attr('disabled',true);
	$("#saldo").val(formatMoney(0, 0, "Rp."));
	if(id==0){
		$("#type").val('add');
		return
		}else{
		$("#type").val('edit');
	}
});

$(document).on('click','.cek_saldo',function(e){
	e.preventDefault();
	var idkas = $("#dari_kas").val();
	var rekening = $("#rekening_dari").val();
	$.ajax({
		url: base_url + "kas/cek_saldo",
		type: 'POST',
		data: {rekening:rekening,idkas:idkas},
		dataType: 'json',
		beforeSend: function () {
			$('body').loading();
		},
		success: function (response) {
			if(response.status==200 && response.saldo!=null){
				$("#saldo").val(formatMoney(response.saldo, 0, "Rp."));
				}else{
				$("#saldo").val(formatMoney(0, 0, "Rp."));
			}
			$('body').loading('stop');
		}
	});
});

// $("#dari_kas").filter(function () {
// $.ajax({
// url: base_url + "kas/jenis_pembayaran",
// type: 'POST',
// data: {type:'mutasi'},
// dataType: 'json',
// beforeSend: function () {
// $("#id_bayar").append("<option value='loading'>loading</option>");
// $("#id_bayar").empty();
// },
// success: function (response) {
// $("#id_bayar option[value='loading']").remove();
// $("#id_bayar").append("<option value=''>Pilih</option>");
// var len = response.length;
// for (var i = 0; i < len; i++) {
// var id = response[i]['id'];
// var name = response[i]['name'];
// $("#id_bayar").append("<option value='" + id + "'>" + name + "</option>");
// }
// }
// });
// });

$("#dari_kas").filter(function () {
	$.ajax({
		url: base_url + "kas/jenis_kas_mutasi",
		type: 'POST',
		dataType: 'json',
		beforeSend: function () {
			$("#dari_kas").append("<option value='loading'>loading</option>");
			$("#dari_kas").empty();
			$("#dari_kas").attr('disabled',false);
			$("#tujuan").attr('disabled',true);
		},
		success: function (response) {
			$("#dari_kas option[value='loading']").remove();
			$("#dari_kas").append("<option value=''>Pilih</option>");
			var len = response.length;
			for (var i = 0; i < len; i++) {
				var id = response[i]['id'];
				var name = response[i]['name'];
				$("#dari_kas").append("<option value='" + id + "'>" + name + "</option>");
			}
		}
	});
});

$("#dari_kas").change(function () {
	var id_tujuan = $("#dari_kas").val();
	$(".rekening").css('display','none');
	if(id_tujuan==0){
		$("#tujuan").empty();
		$("#tujuan").append("<option value=''>Pilih</option>");
		$("#tujuan").attr('disabled',true);
		return
	}
	if(id_tujuan==110){
		$("#tujuan").attr('disabled',true);
		$(".rekening_dari").css('display','block');
		load_rekening(id_tujuan);
		
		}else{
		$(".rekening_dari").css('display','none');
		$("#tujuan").attr('disabled',false);
		$.ajax({
			url: base_url + "kas/tujuan_kas",
			type: 'POST',
			data: {id:id_tujuan},
			dataType: 'json',
			beforeSend: function () {
				$("#tujuan").append("<option value='loading'>loading</option>");
				$("#tujuan").empty();
			},
			success: function (response) {
				$("#tujuan option[value='loading']").remove();
				$("#tujuan").append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					$("#tujuan").append("<option value='" + id + "'>" + name + "</option>");
				}
				// console.log(id);
			}
		});
	}
	
});

$("#tujuan").change(function () {
	var id_tujuan = $("#tujuan").val();
	var dari = $("#rekening_dari").val();
	if(id_tujuan==110){
		$(".rekening").css('display','block');
		}else{
		$(".rekening").css('display','none');
	}
	
	$.ajax({
		url: base_url + "kas/rekening",
		type: 'POST',
		data: {id:id_tujuan,dari:dari},
		dataType: 'json',
		beforeSend: function () {
			$("#rekening").append("<option value='loading'>loading</option>");
			$("#rekening").empty();
		},
		success: function (response) {
			$("#rekening option[value='loading']").remove();
			$("#rekening").append("<option value=''>Pilih</option>");
			var len = response.length;
			for (var i = 0; i < len; i++) {
				var id = response[i]['id'];
				var name = response[i]['name'];
				$("#rekening").append("<option value='" + id + "'>" + name + "</option>");
			}
			// console.log(id);
		}
	});
});
$(document).on('click','.save_mutasi',function(e){
	$('#myForm').submit();
});
$('#myForm').submit(function(e){
	e.preventDefault();
	//id kas
	// var dari_kas = $("#dari_kas").val();
	// //id rekening dari
	// var rekening_dari = $("#rekening_dari").val();
	// //id rekening tujuan
	// var rekening_tujuan = $("#rekening").val();
	var tujuan = $("#tujuan").val();
	var jumlah = angka($("#jumlah").val());
	var saldo = angka($("#saldo").val());
	// var catatan = $("#catatan").val();
	// if(id_bayar==''){
	// $("#id_bayar").addClass('is-invalid');
	// $("#id_bayar").focus();
	// return;
	// }
	// if(dari_kas==''){
	// $("#dari_kas").addClass('is-invalid');
	// $("#dari_kas").focus();
	// return;
	// }
	if(tujuan==''){
		$("#tujuan").addClass('is-invalid');
		$("#tujuan").focus();
		return;
	}
	if(parseInt(saldo)==0){
		sweet_time(2000,'Status!!!','saldo tidak mencukupi');
		return;
	}
	if(jumlah=='' || jumlah <= 0 ){
		$("#jumlah").addClass('is-invalid');
		$("#jumlah").focus();
		return;
	}
	// return
	$.ajax({
		url: base_url + "kas/simpan_mutasi",
		type: 'POST',
		data: $(this).serialize(),
		dataType: 'json',
		beforeSend: function () {
			$(".loadings").show();
		},
		success: function (response) {
			if(response.status==200){
				sweet_time(2000,'Status!!!',response.msg);
				}else{
				sweet_time(2000,'Status!!!',response.msg);
			}
			search_Mutasi();
			$('#ModalMutasi').modal('hide');
			$(".loadings").hide();
		}
	});
});

function load_tujuan(id_tujuan){
	$.ajax({
		url: base_url + "kas/tujuan_kas",
		type: 'POST',
		data: {id:id_tujuan},
		dataType: 'json',
		beforeSend: function () {
			$("#tujuan").append("<option value='loading'>loading</option>");
			$("#tujuan").empty();
		},
		success: function (response) {
			$("#tujuan option[value='loading']").remove();
			$("#tujuan").append("<option value=''>Pilih</option>");
			var len = response.length;
			for (var i = 0; i < len; i++) {
				var id = response[i]['id'];
				var name = response[i]['name'];
				$("#tujuan").append("<option value='" + id + "'>" + name + "</option>");
			}
			// console.log(id);
		}
	});
}
function load_rekening(id){
	$.ajax({
		url: base_url + "kas/rekening",
		type: 'POST',
		data: {id:id},
		dataType: 'json',
		beforeSend: function () {
			$("#rekening_dari").append("<option value='loading'>loading</option>");
			$("#rekening_dari").empty();
		},
		success: function (response) {
			$("#rekening_dari option[value='loading']").remove();
			$("#rekening_dari").append("<option value=''>Pilih</option>");
			var len = response.length;
			for (var i = 0; i < len; i++) {
				var id = response[i]['id'];
				var name = response[i]['name'];
				$("#rekening_dari").append("<option value='" + id + "'>" + name + "</option>");
			}
		}
	});
}

$("#rekening_dari").change(function () {
	var id = $("#rekening_dari").val();
	$("#tujuan").attr('disabled',false);
		$.ajax({
			url: base_url + "kas/tujuan_kas",
			type: 'POST',
			data: {id:id},
			dataType: 'json',
			beforeSend: function () {
				$("#tujuan").append("<option value='loading'>loading</option>");
				$("#tujuan").empty();
			},
			success: function (response) {
				$("#tujuan option[value='loading']").remove();
				$("#tujuan").append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					$("#tujuan").append("<option value='" + id + "'>" + name + "</option>");
				}
				// console.log(id);
			}
		});
});
var jumlah = document.getElementById('jumlah');
jumlah.addEventListener('keyup', function(e)
    {
        jumlah.value = formatRupiah(this.value, 'Rp. ');
        jml_bayar = angka(this.value);
        saldo = angka($("#saldo").val());
        if(parseInt(jml_bayar) > parseInt(saldo)){
            sweet_time(2000,'Status!!!','saldo tidak mencukupi');
            $("#jumlah").val(formatMoney(0, 0, "Rp."));
		}
        
	});					