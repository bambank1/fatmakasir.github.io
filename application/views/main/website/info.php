<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?=$title;?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$title;?></li>
        </ol>
    </div>
    <?php
        echo $this->session->flashdata('message');
    ?>
    <div class="row">
        <div class="col-md-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <form id="simpan_data" method="POST" action="<?=base_url();?>main/info_save" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="card-header p-0 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><?=$title;?></h6>
                            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        </div>
                        
                        <div class="form-group">
                            <label for="judul">Title</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="1" required>
                            <input type="text" class="form-control" id="judul" name="title" value="<?=$rows['title'];?>" required>
                        </div>
                        <div class="form-group">
                            <label for="judul">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="<?=$rows['perusahaan'];?>" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="deskripsi">Alamat</label>
                                <textarea class="form-control textarea" id="deskripsi" name="deskripsi"  required><?=base64_decode($rows['deskripsi']);?></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ket">Keterangan Login</label>
                                <textarea class="form-control textarea" id="ket" name="ket" required><?=base64_decode($rows['ket']);?></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="footer">Footer Invoice</label>
                                <textarea class="form-control textarea" id="footer" name="footer" required><?=base64_decode($rows['footer_invoice']);?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?=$rows['email'];?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?=$rows['phone'];?>" required>
                            </div>
                             <div class="form-group col-md-4">
                                <label for="token">Token Fonnte</label>
                                <input type="text" class="form-control" id="token" name="token" value="<?=$rows['tw'];?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="fb">Facebook</label>
                                <input type="text" class="form-control" id="fb" name="fb" value="<?=$rows['fb'];?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ig">Instagram</label>
                                <input type="text" class="form-control" id="ig" name="ig" value="<?=$rows['ig'];?>" required>
                            </div> 
                            <div class="form-group col-md-4">
                                <label for="keywords">Alamat tanggal</label>
                                <input type="text" class="form-control" id="keywords" name="keywords" value="<?=$rows['keywords'];?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="warna_lunas">Warna Invoice Lunas</label>
                                <div class="input-group">
                                    <span class="input-group-btn input-group-prepend"><span class="picker" id="picker1"></span></span>
                                    <input type="text" class="form-control" id="warna_lunas" name="warna_lunas" value="<?=$rows['warna_lunas'];?>" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="warna_blunas">Warna Invoice Belum Lunas</label>
                                <div class="input-group">
                                    <span class="input-group-btn input-group-prepend"><span class="picker picker2" id="picker2"></span></span>
                                    <input type="text" class="form-control" id="warna_blunas" name="warna_blunas" value="<?=$rows['warna_blunas'];?>" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tema">Warna Tema</label>
                                <div class="input-group">
                                    <span class="input-group-btn input-group-prepend"><span class="picker tema" id="picker3"></span></span>
                                    <input type="text" class="form-control" id="tema" name="tema" value="<?=$rows['tema'];?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="logo">Logo Lunas</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03">
                                            <img class="imglogo" data-id="1" id="imglogo1" src="<?=base_url();?>uploads/<?=$rows['logo'];?>" height="20" alt="" />
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo" name="logo">
                                        <label class="custom-file-label" for="logo">Pilih logo</label>
                                    </div>
                                </div>
                                <small id="logoHelp" class="form-text text-muted">size 700x164 pixel</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="logo_bw">Logo Belum Lunas</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03">
                                            <img class="imglogo" data-id="2" id="imglogo2" src="<?=base_url();?>uploads/<?=$rows['logo_bw'];?>" height="20" alt="" />
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo_bw" name="logo_bw">
                                        <label class="custom-file-label" for="logo_bw">Pilih logo</label>
                                    </div>
                                </div>
                                <small id="logoHelp" class="form-text text-muted">size 700x164 pixel</small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="icon">Icon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03">
                                            <img src="<?=base_url();?>uploads/<?=$rows['favicon'];?>" height="20" alt="" />
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="icon" name="icon">
                                        <label class="custom-file-label" for="icon">Pilih icon</label>
                                    </div>
                                </div>
                                <small id="iconHelp" class="form-text text-muted">size 32x32 pixel</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="lunas">Stamp Lunas</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03">
                                            <img class="imglogo" src="<?=base_url();?>uploads/<?=$rows['stamp_l'];?>" height="20" alt="" />
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="lunas" name="lunas">
                                        <label class="custom-file-label" for="lunas">Pilih Stamp LUNAS</label>
                                    </div>
                                </div>
                                <small id="logoHelp" class="form-text text-muted">size 300x100 pixel</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blunas">Stamp Lunas</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03">
                                            <img class="imglogo" src="<?=base_url();?>uploads/<?=$rows['stamp_b'];?>" height="20" alt="" />
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="blunas" name="blunas">
                                        <label class="custom-file-label" for="blunas">Pilih Stamp Belum Lunas</label>
                                    </div>
                                </div>
                                <small id="iconHelp" class="form-text text-muted">size 300x100 pixel</small>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!--Row-->
    </div>
</div>
<!-- The Modal -->
<div id="myModals" class="modals">
    
    <!-- The Close Button -->
    <span class="closes">&times;</span>
    
    <!-- Modal Content (The Image) -->
    <img class="modal-contents" id="viewimglogo">
    
    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>
<style>
    .trumbowyg-box,
    .trumbowyg-editor {
    min-height: 100px!important;
    }
    .picker {
    border-radius: 0;
    width: 43px;
    height: 43px;
    cursor: pointer;
    }
    
    
    /* The Modal (background) */
    .modals {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 100; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background: #fff; /* Fallback color */
    }
    
    /* Modal Content (Image) */
    .modal-contents {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    position: fixed; /* or absolute */
    top: 25%;
    left: 25%;
    }
    
    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
    }
    
    /* Add Animation - Zoom in the Modal */
    .modal-contents, #caption {
    animation-name: zoom;
    animation-duration: 0.6s;
    }
    
    @keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
    }
    
    /* The Close Button */
    .closes {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    }
    
    .closes:hover,
    .closes:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
    }
    
    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
    .modal-content {
    width: 100%;
    }
    } 
</style>
<script src="<?= base_url('assets/'); ?>vendor/colorpick/colorPick.js"></script>  
<script>
    setInterval(function() {
        $('body').loading('stop');
    }, 1000);
    // Get the modal
    var modal = document.getElementById("myModals");
    let img = "";
    $(".imglogo").click(function(){
        
        var id = $(this).data('id');
        var modalImg = document.getElementById("viewimglogo");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    });
    
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closes")[0];
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    } 
    
    $(document).ready(function() {
        
        var warna = "<?=$rows['warna_lunas'];?>";
        $(".picker").css("background-color",warna);
        $("#warna_lunas").val(warna);
        
        var warna2 = "<?=$rows['warna_blunas'];?>";
        $("#warna_blunas").val(warna2);
        $(".picker2").css("background-color",warna2);
        
        var warna3 = "<?=$rows['tema'];?>";
        $("#temma").val(warna3);
        $(".tema").css("background-color",warna3);
        
        // $('.textarea').trumbowyg();
        $('.textarea').trumbowyg({
            btns: [
            ['viewHTML','link'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ]
        });
    });
    $("#picker1").colorPick({
        'initialColor' : '#8e44ad',
        'palette': ["#1abc9c", "#16a085", "#2ecc71", "#27ae60", "#3498db", "#2980b9", "#9b59b6", "#8e44ad", "#34495e", "#2c3e50", "#f1c40f", "#f39c12", "#e67e22", "#d35400", "#e74c3c", "#c0392b", "#444444","#ED3237"],
        'onColorSelected': function() {
            $("#warna_lunas").val(this.color);
            // console.log("The user has selected the color: " + this.color)
            this.element.css({'backgroundColor': this.color, 'color': this.color});
        }
    });
    $("#picker2").colorPick({
        'initialColor' : '#8e44ad',
        'palette': ["#1abc9c", "#16a085", "#2ecc71", "#27ae60", "#3498db", "#2980b9", "#9b59b6", "#8e44ad", "#34495e", "#2c3e50", "#f1c40f", "#f39c12", "#e67e22", "#d35400", "#e74c3c", "#c0392b", "#444444","#ED3237"],
        'onColorSelected': function() {
            $("#warna_blunas").val(this.color);
            // console.log("The user has selected the color: " + this.color)
            this.element.css({'backgroundColor': this.color, 'color': this.color});
        }
    });
    $("#picker3").colorPick({
        'initialColor' : '#8e44ad',
        'palette': ["#1abc9c", "#16a085", "#2ecc71", "#27ae60", "#3498db", "#2980b9", "#9b59b6", "#8e44ad", "#34495e", "#2c3e50", "#f1c40f", "#f39c12", "#e67e22", "#d35400", "#e74c3c", "#c0392b", "#444444","#ED3237"],
        'onColorSelected': function() {
            $("#tema").val(this.color);
            // console.log("The user has selected the color: " + this.color)
            this.element.css({'backgroundColor': this.color, 'color': this.color});
        }
    });
</script>