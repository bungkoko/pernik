
<form method="post" action="<?php site_url('admin/update_produk')?>" enctype="multipart/form-data">
    <div class="grid_5">
        <div class="box-header">Ubah Stok Produk</div>
        <div class="box">
            <div class="row">
                <p><label>Produk :</label></p>
                <input type="text" readonly="readonly" name="produk" maxlength="20" value="<?php echo $get->Produk;?>"/>
            </div>
            <div class="row">
                <p><label>Harga :</label></p>
                <label>Rp. </label><input type="text" name="harga" readonly="readonly" value=<?php echo $get->harga_per_item;?>>
            </div>
              <div class="row">
                <p><label>Stok :</label></p>
                <select name="stok">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="35">35</option>
                    <option value="40">40</option>
                    <option value="45">45</option>
                    <option value="50">50</option>
                    <option value="55">55</option>
                    <option value="60">60</option>
                    <option value="65">65</option>
                </select>
                          </div>
            <div class="row">
                <input type="submit" class="button small" value="Submit" name="submit" />
            </div>
        </div>
    </div>
</form>