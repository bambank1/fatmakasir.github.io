function cek_data(str)
{
    $.ajax({
        'url': base_url + 'rollback/cek_data_'+str,
        'method': 'POST',
        'dataType':'json',
        beforeSend: function(){	 
           $('body').loading();
        },
        success: function(data) {
          $('body').loading('stop');
            
            if(data.status==200 && data.counter >=1){
                class_install('install_'+str)
                $('#install_'+str).addClass('confirm_reset').removeClass('confirm_install');
                $('#data-'+str).text(data.counter);
                }else{
                $('#data-'+str).text(data.counter);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('body').loading('stop');
            sweet('Peringatan!!!',thrownError,'warning','warning');
        }
    });
}


$(document).on('click', '.full_reset', function(e){
    e.preventDefault();
    $('#confirm-fullreset').modal('show')
})
$(document).on('click', '.confirm_install', function(e){
    e.preventDefault();
    $('#confirm-install').modal('show')
    $('#install-data').val($(this).attr('data-name'));
    $('.title-install').text($(this).attr('data-name'));
    $('#Label_Install').html('Confirm Install '+$(this).attr('data-name'))
})

$(document).on('click', '.confirm_reset', function(e){
    e.preventDefault();
    $('#confirm-reset').modal('show')
    $('#reset-data').val($(this).attr('data-name'));
    $('.title-reset').text($(this).attr('data-name'));
    $('#Label_Reset').html('Confirm Reset '+$(this).attr('data-name'))
})
$(document).on('click', '.install_dummy', function(e){
    e.preventDefault();
    var name = $('#install-data').val();
    
    $.ajax({
        'url': base_url + 'rollback/install_dummy',
        'method': 'POST',
        'data': {name:name},
        'dataType':'json',
        beforeSend: function(){	 
            $('body').loading();
        },
        success: function(data) {
            $('#confirm-install').modal('hide')
            $('body').loading('stop');
            if(data.status==200 && data.counter >=1){
                class_install(data.tipe)
                $('#'+data.tipe).addClass('confirm_reset');
                $('#'+data.tipe).removeClass('confirm_install');
                $('#data-'+data.name).text(data.counter);
                }else{
                $('#data-'+data.name).text(data.counter);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('body').loading('stop');
            var jsonResponse = JSON.parse(xhr.responseText);
            if(jsonResponse.status==401){
                swalredir(base_url,thrownError)
                }else{
                sweet('Peringatan!!!',thrownError,'warning','warning');
            }
        }
    });
});

$(document).on('click', '.reset_dummy', function(e) {
    e.preventDefault();
    var name = $('#reset-data').val();
    $.ajax({
        'url': base_url + 'rollback/reset_dummy',
        'method': 'POST',
        'data': {name:name},
        'dataType':'json',
        beforeSend: function(){	 
            $('body').loading();
        },
        success: function(data) {
            $('#confirm-reset').modal('hide')
            $('body').loading('stop');
            if(data.status==200 && data.counter >=1){
                $('#data-'+data.name).text(data.counter);
                }else{
                class_reset(data.tipe)
                $('#data-'+data.name).text(data.counter);
                
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('body').loading('stop');
            var jsonResponse = JSON.parse(xhr.responseText);
            if(jsonResponse.status==401){
                swalredir(base_url,thrownError)
                }else{
                sweet('Peringatan!!!',thrownError,'warning','warning');
            }
        }
    });
});

$(document).on('click', '.reset_ulang', function(e) {
    e.preventDefault();
    var name = $('#reset-data').val();
    $.ajax({
        'url': base_url + 'rollback/reset_ulang',
        'method': 'POST',
        'dataType':'json',
        beforeSend: function(){	 
            $('body').loading();
        },
        success: function(data) {
            $('#confirm-fullreset').modal('hide')
            $('body').loading('stop');
            cek_data('kategori');
            fullreset_data('install_kategori');
            cek_data('bahan');
            fullreset_data('install_bahan');
            cek_data('satuan');
            fullreset_data('install_satuan');
            cek_data('produk');
            fullreset_data('install_produk');
            cek_data('pengeluaran');
            fullreset_data('install_pengeluaran');
            cek_data('konsumen');
            fullreset_data('install_konsumen');
            cek_data('supplier');
            fullreset_data('install_supplier'); 
			cek_data('pengaturan');
            fullreset_data('install_pembelian');
            fullreset_data('install_penjualan');
            fullreset_data('install_pengeluaran');
            fullreset_data('install_jurnal');
            fullreset_data('install_kasbon');
            fullreset_data('install_pengaturan');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('body').loading('stop');
            
            var jsonResponse = JSON.parse(xhr.responseText);
            if(jsonResponse.status==401){
                swalredir(base_url,thrownError)
                }else{
                sweet('Peringatan!!!',thrownError,'warning','warning');
            }
        }
    });
});
function fullreset_data(str)
{
    $('#'+str).removeClass('confirm_reset').addClass('confirm_install');
    $('#'+str+' > .card').removeClass('bg-secondary text-white');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-uppercase').text('Install sample');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-gray-800').addClass('text-gray-800');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-muted').addClass('text-muted');
    $('#'+str+' > .card > .card-body > .row  > .col > .mt-2 > .text-white').removeClass('text-white').addClass('text-success');
    $('#'+str+' > .card > .card-body > .row  > .col-auto > .fa-database').addClass('text-primary');
}

function class_install(str)
{
    
    $('#'+str+' > .card').addClass('bg-secondary text-white');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-uppercase').text('reset sample');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-gray-800').removeClass('text-gray-800');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-muted').removeClass('text-muted');
    $('#'+str+' > .card > .card-body > .row  > .col > .mt-2 > .text-success').removeClass('text-success').addClass('text-white');
    $('#'+str+' > .card > .card-body > .row  > .col-auto > .text-primary').removeClass('text-primary');
}

function class_reset(str)
{
    $('#'+str).removeClass('confirm_reset').addClass('confirm_install');
    $('#'+str+' > .card').removeClass('bg-secondary text-white');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-uppercase').text('Install sample');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-gray-800').addClass('text-gray-800');
    $('#'+str+' > .card > .card-body > .row  > .col > .text-muted').addClass('text-muted');
    $('#'+str+' > .card > .card-body > .row  > .col > .mt-2 > .text-white').removeClass('text-white').addClass('text-success');
    $('#'+str+' > .card > .card-body > .row  > .col-auto > .fa-database').addClass('text-primary');
}
