<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#table').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>
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
<div class="grid_12">
    <div class="box-header">
		Daftar Order
    </div>
    <div class="box table">
        
            <table cellspacing="0" id="table" class="display">
                <thead>
                    <tr>

                        <td class="tc" width="25px">No</td>
                        <td width="130px">Tanggal Order</td>
                        <td width="90px">Kode Order</td>
                        <td width="90px">Member/Pemesan</td>
                        <td width="90px">Penerima</td>
                        <td width="90px">Produk Yang Dibeli</td>
                        <td width="90px">Jumlah Yang Dibeli</td>
                        <td width="90px">Harga Per Item</td>
                        <td width="90px">Konfirmasi</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach($daftar->result() as $df):?>
                    <tr>
                        <td><?php echo $no++?></td>
                        <td><?php echo $df->tanggal_order;?></td>
                        <td><?php echo $df->KdOrder;?></td>
                        <td><?php echo $df->fullname;?></td>
                        <td><?php echo $df->nama_penerima;?></td>
                        <td><?php echo $df->Produk;?></td>
                        <td><?php echo $df->jumlah_detail;?></td>
                        <td>Rp. <?php echo number_format($df->harga_detail,0,",",".");?></td>
                        <td><a href="<?php echo site_url('admin/konfirmasi_order/'.$df->TbOrder_KdOrder.'/'.$df->konfirmasi.''); ?>"><?php echo $df->konfirmasi;?></a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    
</div>
