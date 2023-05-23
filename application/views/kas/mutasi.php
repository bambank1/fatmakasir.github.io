<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Mutasi</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Mutasi</li>
        </ol>
    </div>
    <div class="row d-flex justify-content-center ">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="card-header  d-flex flex-row align-items-center justify-content-between">
                            <h5 class="card-title">Timeline Mutasi</h5>
                            
                            <div class="btn-group cetak_laporan" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" data-info="mutasi" class="btn btn-success btn-sm add_mutasi" data-id="0"><i class="fa fa-plus"></i> Buat Mutasi</button>
                                <button class="btn btn-info btn-sm"><i class="fa fa-calendar"></i></button>
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 8px 10px 0 10px; border: 1px solid #ccc; width: 100%;height:38px">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                                <button class="btn btn-primary url_doc" data-url="mutasi" type="button" data-toggle="tooltip" data-original-title="Dok Mutasi" data-placement="left"><i class="fa fa-info-circle"></i></button>
                            </div>
                        </div>
                        <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column" id="dataMutasi">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ModalMutasi" class="modal left fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Mutasi Kas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
                </button>
            </div>
			<div class="modal-body">
            <form id="myForm">
				<input type='hidden' name='id_mutasi' id='id_mutasi' value='0'>
				<input type='hidden' name='type' id="type">
				<div class="row">
					<div class="col-md-12">
                        <div class="form-group mb-1">
                            <label for="dari_kas">Dari Kas</label>
                            <select name="dari_kas" id="dari_kas" class="form-control form-control-sm " required>
                                 
                            </select>
                        </div>
                        <div class="form-group mb-1 rekening_dari" style="display:none">
                            <label for="rekening_dari">Rekening/Merchant</label>
                            <select name="rekening_dari" id="rekening_dari" class="form-control form-control-sm" required>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="tujuan">Tujuan Kas</label>
                            <select name="tujuan" id="tujuan" class="form-control form-control-sm" required>
                                <option value="">Pilih</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group mb-1 rekening" style="display:none">
                            <label for="rekening">Rekening/Merchant</label>
                            <select name="rekening" id="rekening" class="form-control form-control-sm" required>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="saldo">Total Saldo</label>
                            <div class="input-group mb-3">
                                <input type="text" name="saldo" id="saldo" value="0" class="form-control form-control-sm" readonly >
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info btn-sm cek_saldo" type="button">Cek</button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group mb-1">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm input" onkeyup="formatNumber(this);" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="catatan">Catatan</label>
                            <input type="text" name="catatan" id="catatan" class="form-control form-control-sm input" required>
                        </div>
                        <div class="form-group d-flex flex-row">
                        </div>
                    </div>
                    
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" name="submit" class="btn btn-info save_mutasi">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/'); ?>js/mutasi.js?r=<?=time();?>"></script>
<style>
    
    .mt-70 {
    margin-top: 70px
    }
    
    .mb-70 {
    margin-bottom: 70px
    }
    
    .vertical-timeline {
    width: 100%;
    position: relative;
    padding: 1.5rem 0 1rem
    }
    
    .vertical-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 77px;
    height: 100%;
    width: 4px;
    background: #e9ecef;
    border-radius: .25rem
    }
    
    .vertical-timeline-element {
    position: relative;
    margin: 0 0 1rem
    }
    
    .vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
    visibility: visible;
    animation: cd-bounce-1 .8s
    }
    
    .vertical-timeline-element-icon {
    position: absolute;
    top: 0;
    left: 70px
    }
    
    .vertical-timeline-element-icon .badge-dot-xl {
    box-shadow: 0 0 0 5px #fff
    }
    
    .badge-dot-xl {
    width: 18px;
    height: 18px;
    position: relative
    }
    
    .badge:empty {
    display: none
    }
    
    .badge-dot-xl::before {
    content: '';
    width: 10px;
    height: 10px;
    border-radius: .25rem;
    position: absolute;
    left: 50%;
    top: 50%;
    margin: -5px 0 0 -5px;
    background: #fff
    }
    
    .vertical-timeline-element-content {
    position: relative;
    margin-left: 100px;
    font-size: .8rem
    }
    
    .vertical-timeline-element-content .timeline-title {
    font-size: .8rem;
    text-transform: uppercase;
    margin: 0 0 .5rem;
    padding: 2px 0 0;
    font-weight: bold
    }
    
    .vertical-timeline-element-content .vertical-timeline-element-date {
    display: block;
    position: absolute;
    left: -100px;
    top: 0;
    padding-right: 10px;
    text-align: right;
    color: #adb5bd;
    font-size: .7619rem;
    white-space: nowrap
    }
    
    .vertical-timeline-element-content:after {
    content: "";
    display: table;
    clear: both
    }
</style>                                                