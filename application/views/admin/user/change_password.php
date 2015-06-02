<form method="post" action="<?php current_url(); ?>">
<div class="grid_5">
    <div class="box-header"> Ubah Password </div>
    <div class="box">
			<div class="row">
                <p><label>Password Lama:</label></p>
                <input type="password" name="old_password"/>
            </div>
			<div class="row">
                <p><label>Password Baru:</label></p>
                <input type="password" name="new_password"/>
            </div>
			<div class="row">
                <p><label>Ulangi Password Baru:</label></p>
                <input type="password" name="new_password_confirm"/>
            </div>
            <div class="row">
                <input value="ubah password" name="change_password" class="button medium" type="submit" />
            </div>       
    </div>
</div>
 </form>
<!-- End Forms -->
<br class="cl" />