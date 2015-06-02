<div class="grid_12">
    <div class="box-header">
		Laporan Transaksi Bulanan
    </div>

    <div class="box table">
        <label>&nbsp;</label>
        <form style="padding-left:15px;" method="post" action="<?php echo base_url(); ?>admin/transaksi_tahunan">
            <select name="tahun" class="login-inp">
                <?php
                for($k=2010;$k<=date('Y');$k++) {
                    echo '<option value="'.$k.'">'.$k.'</option>';
                }
                ?>
            </select>
            <input type="submit" value="Lihat Transaksi" class="input-tombol" />
        </form>
        <div style="clear:both; margin-bottom:10px;"></div>

        <table id="table" class="display">
            <thead>
                <tr>
                    <td class="tc" width="25px">No</td>
                    <td width="90px">Kode Order</td>
                    <td width="90px">Member/Pemesan</td>
                    <td width="90px">Penerima</td>
                    <td width="90px">Produk Yang Dibeli</td>
                    <td width="90px">Jumlah Yang Dibeli</td>
                    <td width="90px">Harga Per Item</td>
                    <td style="padding:5px;">Total Harga</td>
                </tr>

            </thead>

            <tbody>
                <?php
                $no=1;
                foreach($tampil->result() as $tp):
                    ?>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $tp->KdOrder?></td>
                    <td><?php echo $tp->fullname?></td>
                    <td><?php echo $tp->nama_penerima?></td>
                    <td><?php echo $tp->Produk?></td>
                    <td><?php echo $tp->jumlah_detail?></td>
                    <td>Rp. <?php echo number_format($tp->harga_detail,0,",",".")?></td>
                    <td>Rp. <?php echo number_format($tp->harga_detail*$tp->jumlah_detail,0,",",".")?></td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <div style="clear:both;padding:15px 10px 15px 15px">
            <form name="cetak">

                <input type="submit" value="Cetak Transaksi"  name="submit_cetak" class="input-tombol" />

            </form>
        </div>

    </div>



</div>

