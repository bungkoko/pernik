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
<form method="post" action="<?php echo site_url('admin/bank')?>" enctype="multipart/form-data">
    <div class="grid_5">
        <div class="box-header">Tambah Bank</div>
        <div class="box">
            <div class="row">
                <p><label>Bank :</label></p>
                <input type="text" name="bank" maxlength="20" />
            </div>
            <div class="row">
                <p><label>No. Rekening :</label></p>
                <input type="text" name="no_rekening" maxlength="20" />
            </div>
            <div class="row">
                <p><label>Atas Nama :</label></p>
                <input type="text" name="atasnama" maxlength="20" />
            </div>
            <div class="row">
                <p><label>Logo :</label></p>
                <input type="file" name="logo"/>
            </div>
            
            <div class="row">
                <input type="submit" class="button small" value="Submit" name="submit" />
            </div>
        </div>
    </div>
</form>

<div class="grid_7">
    <div class="box-header">

		Daftar Bank
    </div>
    <div class="box table">
        <table cellspacing="0">
            <thead>
                <tr>
                    <td class="tc" width="25px">No</td>
                    <td width="90px">Bank</td>
                    <td width="130px">Atas Nama</td>
                    <td width="90px">No. Rekening</td>
                    
                    <td width="50px">option</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
              if($daftar->num_rows()> 0):
                foreach($daftar->result() as $df):?>
                <tr>
                   
                    <td><?php echo $no++?></td>
                    <td><?php echo $df->Bank_Nm;?></td>
                    <td><?php echo $df->no_rekening;?></td>
                    <td><?php echo $df->nama_pemilik;?></td>
                    
                    <td>
                        <a href="<?php echo site_url('admin/hapus_bank/'.$df->IdBank.''); ?>" title="Delete Data"><img src="<?php echo base_url()?>assets/admin/images/user_delete.png" alt="delete data" border="0"></a>
                    </td>
                  

                </tr>
                <?php endforeach;
                else :
					echo "<tr><td colspan=\"4\">Belum ada data</td></tr>";
				endif;
                                ?>
                
                
            </tbody>
        </table>
    </div>
</div>
