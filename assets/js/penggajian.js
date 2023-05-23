//@params {type} string
//@params {id} int
function liburAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var LiburData = '';
    if (type == 'add') {
        LiburData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
		}else if (type == 'edit'){
        LiburData = $("#editForm").find('.form').serialize()+'&action_type='+type;
		}else{
        LiburData = 'action_type='+type+'&id='+id;
	}
    $.ajax({
        type: 'POST',
        url: base_url+"post/crud_libur",
        data: LiburData,
        success:function(msg){
			if(msg.status  == 200){
				sweet(type, "Data telah berhasil di "+statusArr[type]+"", "success","success");
                $('.detail_kehadiran').click();
                $('.form')[0].reset();
                $('.formData').slideUp();
				}else if(msg.status=='gagal'){
				sweet("Peringatan!!!", msg.msg, "warning", "warning");
				}else{
				sweet('Error', "Data gagal di "+statusArr[type]+"", "error","error");
			}
		},
		error : function(res, status, httpMessage) {
			// $("body").loading('stop');
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
//@params {id} int
function editLibur(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: base_url+"post/crud_libur",
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEditL').val(data.id);
            $('#tglEditL').val(data.tgl);
            $('#keteranganEditL').val(data.keterangan);
            $('#editForm').slideDown();
		},
		error : function(res, status, httpMessage) {
			// $("body").loading('stop');
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}
//@params {type} string
//@params {id} int
function cutiAction(type,id){
	
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var CutiData = '';
    if (type == 'add') {
        CutiData = $("#addFormC").find('.form').serialize()+'&action_type='+type+'&id='+id;
		}else if (type == 'edit'){
        CutiData = $("#editFormC").find('.form').serialize()+'&action_type='+type;
		}else{
        CutiData = 'action_type='+type+'&id='+id;
	}
    $.ajax({
        type: 'POST',
        url: base_url+'post/crud_cuti',
		dataType: 'json',
        data: CutiData,
        success:function(msg){
            if(msg.status  == 200){
				sweet(type, "Data telah berhasil di "+statusArr[type]+"", "success","success");
                $('.detail_kehadiran').click();
                $('.form')[0].reset();
                $('.formData').slideUp();
				}else if(msg.status=='gagal'){
				sweet("Peringatan!!!", msg.msg, "warning", "warning");
				}else{
				sweet('Error', "Data gagal di "+statusArr[type]+"", "error","error");
			}
		},
		error : function(res, status, httpMessage) {
			// $("body").loading('stop');
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}

//@params {id} int
function editCuti(id){
    $.ajax({
		url: base_url+'post/crud_cuti',
        type: 'POST',
        dataType:'JSON',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#iduserEdit').val(data.iduser);
            $('#tglEdit').val(data.tgl);
            $('#keteranganEdit').val(data.keterangan);
            $('#tglaEdit').val();
            $('#tglakEdit').val();
            $('#editFormC').slideDown();
		},
		error : function(res, status, httpMessage) {
			// $("body").loading('stop');
			sweet("Peringatan!!!", httpMessage, "warning", "warning");
		}
	});
}

//Tampilkan Modal 
function showModalsG( id )
{
	clearModalsG();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id)
	{
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_gaji",
			dataType: 'json',
			data: {id:id,type:"get"},
			success: function(res) {
				setModalDataG( res );
			}
		});
	}
	// Untuk Tambahkan Data
	else
	{
		$("#myModalsK").modal("show");
		$("#myModalLabel").html("Input Gaji Pokok");
		$("#type").val("new"); 
		
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalDataG( data )
{
	
	$("#id").val(data.id);
	$("#type").val("edit");
	$("#gaji_pokokE").val(toRp(data.gajipokok));
	$("#makanE").val(toRp(data.makan));
	$("#transportE").val(toRp(data.transport));
	$("#asuransiE").val(toRp(data.asuransi));
	$("#tun_jabE").val(toRp(data.tunjab));
	$("#jam_kerjaE").val(data.jamkerja);
	$("#istirahatE").val(data.istirahat);
	$("#edit_gaji").modal("show");
	
}

//Submit Untuk Eksekusi Data 
function submitGaji()
{
	var gaji_pokok = $("#gaji_pokokE").val();
	var makan = $("#makanE").val();
	var transport = $("#transportE").val();
	var asuransiE = $("#asuransiE").val();
	var tun_jabE = $("#tun_jabE").val();
	var jam_kerjaE = $("#jam_kerjaE").val();
	var istirahatE = $("#istirahatE").val();
	if(gaji_pokok==''){
		$('.errorn').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else{
		var formData = $("#formGaji").serialize();
		
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_gaji",
			dataType: 'json',
			data: formData,
			success: function(data) {
				if(data['status']==200){
					$('.detail_kehadiran').trigger('click');
					sweet_time(500, "Status!!!", "Data sedang disimpan");
					$('#edit_gaji').modal('hide');
					}else{
					sweet_time(1000, "Status!!!", "Gagal disimpan");
					$('#edit_gaji').modal('hide');
				}
			}
		});
	}
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalsG()
{
	$("#removeWarning").hide();
	$("#id").val("").removeAttr( "disabled" );
	$("#gaji_pokokE").val("").removeAttr( "disabled" );
	$("#makanE").val("").removeAttr( "disabled" );
	$("#transportE").val("").removeAttr( "disabled" );
	$("#asuransiE").val("").removeAttr( "disabled" );
	$("#tun_jabE").val("").removeAttr( "disabled" );
	$("#jam_kerjaE").val("").removeAttr( "disabled" );
	$("#istirahatE").val("").removeAttr( "disabled" );
	$("#type").val("");
}
//* bonus ----
function showModalsB(id,tgl1,tgl2)
{
	clearModalsB();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id)
	{
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_bonus",
			dataType: 'json',
			data: {id:id,tgl1:tgl1,tgl2:tgl2,type:"get"},
			beforeSend: function(){
				$("body").loading('start');
			},
			success: function(res) {
				$("body").loading('stop');
				setModalDataB(res);
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
	// Untuk Tambahkan Data
	else
	{
		$("#edit_bonus").modal("show");
		$("#myModalLabel").html("Baru");
		$("#type").val("new"); 
		
	}
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setModalDataB( data )
{
	
	$("#myModalLabel").html("");
	$("#iduser_bonus").val(data.iduser);
	$("#type_bonus").val("edit");
	$("#ket_bonus").val(data.ketbonus);
	$("#tglawal_bonus").val(data.tgl1);
	$("#tglakhir_bonus").val(data.tgl2);
	$("#bonus_bonus").val(toRp(data.bonusb));
	$("#edit_bonus").modal("show");
}

//Submit Untuk Eksekusi Data 
function submitBonus()
{
	
	var bonusb = $("#bonus_bonus").val();
	if(bonusb==''){
		$('.errorn').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else{
		$("body").loading();
		var formData = $("#formBonus").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_bonus",
			dataType: 'json',
			data: formData,
			success: function(data) {
				$("body").loading('stop');
				console.log(bonusb)
				$('#bonus').val(bonusb);
				$('#edit_bonus').modal('hide');
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearModalsB()
{
	$("#removeWarning").hide();
	$("#iduser_bonus").val("").removeAttr( "disabled" );
	$("#ket_bonus").val("").removeAttr( "disabled" );
	$("#bonus_bonus").val("").removeAttr( "disabled" );
	$("#tglawal_bonus").val("").removeAttr( "disabled" );
	$("#tglakhir_bonus").val("").removeAttr( "disabled" );
	$("#type_bonus").val("");
}
//bayar gaji
//Submit Untuk Eksekusi Data 
function submitBayar()
{
	var uang = $("#uang").val();
	var sisabayar = $("#sisabayar").val();
	if (uang > sisabayar) {
		$('#notif').html('<div class="alert alert-danger">Uangnya kebesaran</div>');
		}else if(uang == 0){
		$('#notif').html('<div class="alert alert-danger">Masukan dulu uangnya</div>');
		}else{
		var formData = $("#formBayar").serialize();
		
		$.ajax({
			type: "GET",
			url: "views/absensi/save_bayar.php",
			// dataType: 'json',
			data: formData,
			success: function(data) {
				if(data=="OK"){
					$('#bayar').modal('hide');
					
					swal("Bayar", "Data telah berhasil di simpan", "success");
					$('.bayar')[0].reset();
					setTimeout(reloadx, 2000);
				}
			}
		});
	}
}

//uang makan
function showUangMakan(id,tgl1,tgl2)
{
	clearUangMakan();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id)
	{
		
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_uang_makan",
			dataType: 'json',
			data: {id:id,tgl1:tgl1,tgl2:tgl2,type:"get"},
			beforeSend: function(){
				$("body").loading('start');
			},
			success: function(res) {
				$("body").loading('stop');
				setUangMakan(res);
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
	
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setUangMakan( data )
{
	
	$("#myModalLabel").html("");
	$("#iduser_makan").val(data.iduser);
	$("#type_makan").val("edit");
	$("#tglawal_makan").val(data.dari);
	$("#tglakhir_makan").val(data.sampai);
	$("#jumlah_uang_makan_diambil").val(toRp(data.jumlah));
	$("#edit_uang_makan").modal("show");
}

//Submit Untuk Eksekusi Data 
function submitUangMakan()
{
	
	var jumlah = $("#jumlah_uang_makan_diambil").val();
	if(jumlah==''){
		$('.errorn').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else{
		$("body").loading();
		var formData = $("#formUangMakan").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_uang_makan",
			dataType: 'json',
			data: formData,
			success: function(data) {
				$("body").loading('stop');
				$('#uang_makan_diambil').val(jumlah);
				$('#edit_uang_makan').modal('hide');
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearUangMakan()
{
	$("#removeWarning").hide();
	$("#iduser_makan").val("").removeAttr( "disabled" );
	$("#jumlah_uang_makan_diambil").val("").removeAttr( "disabled" );
	$("#tglawal_makan").val("").removeAttr( "disabled" );
	$("#tglakhir_makan").val("").removeAttr( "disabled" );
	$("#type_makan").val("");
}

//uang transport
function showUangTransport(id,tgl1,tgl2)
{
	clearTrans();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id)
	{
		
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_uang_transport",
			dataType: 'json',
			data: {id:id,tgl1:tgl1,tgl2:tgl2,type:"get"},
			beforeSend: function(){
				$("body").loading('start');
			},
			success: function(res) {
				$("body").loading('stop');
				setTrans(res);
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
	
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setTrans( data )
{
	
	$("#myModalLabel").html("");
	$("#iduser_trans").val(data.iduser);
	$("#type_trans").val("edit");
	$("#tglawal_trans").val(data.dari);
	$("#tglakhir_trans").val(data.sampai);
	$("#jumlah_uang_transport_diambil").val(toRp(data.jumlah));
	$("#edit_uang_transport").modal("show");
}

//Submit Untuk Eksekusi Data 
function submitUangTransport()
{
	
	var jumlah = $("#jumlah_uang_transport_diambil").val();
	if(jumlah==''){
		$('.errorn').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else{
		$("body").loading();
		var formData = $("#formUanTrans").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_uang_transport",
			dataType: 'json',
			data: formData,
			success: function(data) {
				$("body").loading('stop');
				$('#uang_transport_diambil').val(jumlah);
				$('#edit_uang_transport').modal('hide');
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearTrans()
{
	$("#removeWarning").hide();
	$("#iduser_trans").val("").removeAttr( "disabled" );
	$("#jumlah_uang_transport_diambil").val("").removeAttr( "disabled" );
	$("#tglawal_trans").val("").removeAttr( "disabled" );
	$("#tglakhir_trans").val("").removeAttr( "disabled" );
	$("#type_trans").val("");
}


//uang kasbon
function showKasbon(id,tgl1,tgl2)
{
	clearKasbon();
	// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
	if(id)
	{
		
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_kasbon",
			dataType: 'json',
			data: {id:id,tgl1:tgl1,tgl2:tgl2,type:"get"},
			beforeSend: function(){
				$("body").loading('start');
			},
			success: function(res) {
				$("body").loading('stop');
				setKasbon(res);
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
	
}

//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
function setKasbon( data )
{
	if(data.jumlah > 0){
		$("#jml_bayar_kasbon").val(toRp(data.jumlah));
		}else{
		$("#jml_bayar_kasbon").val(0);
	}
	$("#myModalLabel").html("");
	$("#iduser_kasbon").val(data.iduser);
	$("#type_kasbon").val("edit");
	$("#tglawal_kasbon").val(data.dari);
	$("#tglakhir_kasbon").val(data.sampai);
	
	$("#edit_kasbon").modal("show");
}

//Submit Untuk Eksekusi Data 
function submitKasbon()
{
	
	var jumlah = $("#jml_bayar_kasbon").val();
	if(jumlah==''){
		$('.errorn').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
		}else{
		$("body").loading();
		var formData = $("#formKasbon").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"post/crud_kasbon",
			dataType: 'json',
			data: formData,
			success: function(data) {
				$("body").loading('stop');
				$('#kasbon').val(jumlah);
				$('#edit_kasbon').modal('hide');
			},
			error : function(res, status, httpMessage) {
				$("body").loading('stop');
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
			}
		});
	}
}

//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
function clearKasbon()
{
	$("#removeWarning").hide();
	$("#iduser_kasbon").val("").removeAttr( "disabled" );
	$("#jml_bayar_kasbon").val("").removeAttr( "disabled" );
	$("#tglawal_kasbon").val("").removeAttr( "disabled" );
	$("#tglakhir_kasbon").val("").removeAttr( "disabled" );
	$("#type_kasbon").val("");
}