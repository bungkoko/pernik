<?php
if ($this->session->flashdata('message')): ?>
<!-- Start Notification -->
<div class="grid_12">
	<div style="display: block;" class="notification success">
		<span class="strong">Sukses!</span>
		<span class="close" title="Dismiss"></span>
		<p><?php echo $this->session->flashdata('message'); ?></p>
	</div>
</div>
<!-- Start Notification -->
<?php endif; ?>
<form method="post" action="<?php site_url('admin/produk')?>" enctype="multipart/form-data">
    <div class="grid_5">
        <div class="box-header">Tambah Produk</div>
        <div class="box">
            <div class="row">
                <p><label>Produk :</label></p>
                <input type="text" name="produk" maxlength="50" />
            </div>
            <div class="row">
                <p><label>Harga :</label></p>
                <label>Rp. </label><input type="text" name="harga" />
            </div>
            <div class="row">
                <p><label>Gambar :</label></p>
                <input type="file" name="produk_photo"/>
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

<div class="grid_7">
    <div class="box-header">

		Daftar Produk
    </div>
    <div class="box table">
        <table cellspacing="0">
            <thead>
                <tr>
                    <td class="tc" width="25px">No</td>
                    <td width="130px">Produk</td>
                    <td width="90px">Harga</td>
                    <td width="40px">Stok</td>
                    <td width="50px">option</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
                foreach($daftar->result() as $df):?>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $df->Produk;?></td>
                    <td>Rp. <?php echo number_format($df->harga_per_item,0,",",".");?></td>
                    <?php if($df->stok>0):?>
                    <td><a href="<?php echo site_url('admin/update_produk/'.$df->KdProduk.'')?>"><?php echo $df->stok;?></a></td>
                    <?php else:?>
                    <td><a href="<?php echo site_url('admin/update_produk/'.$df->KdProduk.'')?>">0</a></td>
                    <?php endif;?>
                    <td>
                        <a href="<?php echo site_url('admin/hapus_produk/'.$df->KdProduk.''); ?>" title="Delete Data"><img src="<?php echo base_url()?>assets/admin/images/user_delete.png" alt="delete data" border="0"></a>
                    </td>

                </tr>
               
                <?php endforeach;?>
                 <tr>
                    <td colspan="5"><?php echo $paging;?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
