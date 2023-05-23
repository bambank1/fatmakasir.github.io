<form id="formproduk">
    <div class="form-group mb-1">
        <label for="nama">Nama produk | Jenis</label>
        <input type="hidden" class="form-control" id="id" name="id" value="<?=$record['id'];?>">
        <input type="hidden" class="form-control" id="type" name="type" value="<?=$tipe;?>">
        <input type="text" class="form-control form-control-sm fcs" id="nama" name="nama" value="<?=$record['title'];?>" required>
    </div>
    <div class="form-group mb-1">
		<label for="barcode">Barcode</label>
        <div class="input-group input-group-sm">
			<input type="text" class="form-control form-control-sm fcs" id="barcode" name="barcode" value="<?=$record['barcode'];?>" required>
			<div class="input-group-append">
				<button class="btn btn-outline-secondary generate" type="button" id="generate_edit">Generate</button>
            </div>
        </div>
		
    </div>
    <div class="form-group row mb-1">
        <div class="col-md-6">
            <label for="ukuran_default">Ukuran default</label>
            <input type="text" class="form-control form-control-sm fcs" id="ukuran_default" name="ukuran" value="<?=$record['ukuran'];?>" required>
        </div>
        <div class="col-md-6">
            <label for="jumlah_default">Jumlah default</label>
            <input type="text" class="form-control form-control-sm fcs" id="jumlah_default" name="jumlah" value="<?=$record['jumlah'];?>" required>
        </div>
    </div>
    
    <div class="form-group row mb-1">
        <div class="col-md-6">
            <label for="jenis">Kategori</label>
            <select placeholder="Pilih bahan" name="jenis" class="form-control custom-select fcs" required>
                <?php
                    foreach($jenis AS $row){
                        if($row['id_jenis']==$record['id_jenis']){
                            echo '<option value="'.$row['id_jenis'].'" selected>'.$row['jenis_cetakan'].'</option>';
                            }else{
                            echo '<option value="'.$row['id_jenis'].'">'.$row['jenis_cetakan'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6 mb-1">
            <label for="lock_harga">Lock Harga</label>
            <select placeholder="Pilih bahan" name="lock_harga" id="lock_harga" class="form-control custom-select fcs" required>
                <?php if($record['lock_harga']=='Y'){ ?>
                    <option value="Y" selected>Ya</option>
                    <option value="N">Tidak</option>
                    <?php }else{ ?>
                    <option value="Y">Ya</option>
                    <option value="N" selected>Tidak</option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group mb-1">
        <label for="bahan">Merk Produk</label>
        <select placeholder="Pilih bahan" name="bahan[]" class="selectize-control fcs" id="chosen-tags" multiple required>
            <?=tags_bahan($record['id']);?>
        </select>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.generate').on('click', function(){
            var digits = Math.floor(Math.random() * 9000000000000) + 1000000000000;
            $('#barcode').val(digits);
        });
        
        $('#chosen-tags').selectize({
            labelField: 'name',
            valueField: 'id',
            searchField: 'name',
            plugins: ['remove_button'],
            // options: [],
            create: false,
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: base_url+'produk/cari_bahan/',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        name: query,
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res);
                    }
                });
            }
        });
        
        $(document).fcs(".fcs");
    });
</script>