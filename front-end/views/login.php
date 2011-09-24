<?php include fe_view_path() . 'includes/header.php'; ?>

    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
        
      <div id="col-text2">

 <h2>Login</h2>
 
 <?php if( $status ): ?>
	<p style="color:red;"><?= $status ?></p>
<?php endif; ?>
<div style="float:left; width: 450px; margin-top: 0; padding-top:0;">
	<?php if( !config_item('individual_accounts_enabled') ): ?>
	<p>
		This is the author login page for the staff of <?= config_item('customer_name') ?>.
	</p>
	<?php endif; ?>
	<p>
		Enter your site name and password in the box to the right, and click "Login."
	</p>
	<?php if( config_item('individual_accounts_enabled') ): ?>
	<p>
		If you don't already have a site, <a href="<?= base_url() ?>home/how_it_works">checkout the tour of our service</a>, and our
		<a href="<?= base_url() ?>home/pricing">pricing for individuals, schools and districts</a>. You can try it before you buy it
		too! <a href="<?= base_url() ?>home/trial">Click here for a free trial!</a>
	</p>
	<?php endif; ?>
	
	<p>
		Did you forget your password? <a href="<?= base_url() ?>home/forgot_password">Click here to recover it</a>.
	</p>
	<p class="with_picture_frame">
		<img src="<?= base_url() ?>public/common/img/media.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/notes.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/help.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/tools.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/globe.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/downloads.png" width="65" alt="email" />
	</p>
</div>

<div style="float:right; border: solid 3px #75B6D4; padding: 15px; padding-bottom: 5px; background-color: white;">
<div style="font-size: 18px; color: #808080; padding-bottom: 10px; border-bottom: solid 1px #cccccc;">Login</div>
		<form method="post" action="<?= base_url() . 'home/login' ?>">
		<div id="login">
			<table>
				<tr>
					<td>Site Name</td>
					<td>
						<input type="text" name="site_name" value="<?= $username ?>" />
					</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>
						<input type="password" name="password" value="" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div style="float:right;"><input class="style_button" type="submit" value="Login" /><br /><small><a href="<?= base_url() ?>home/forgot_password" style="float:right;">Forgot Your Password?</a></small></div>
						<div style="clear:both;"></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
</div>

        </div> <!-- /col-text -->
    
    </div> <!-- /col -->
    <div id="col-bottom"></div>
    
    <hr class="noscreen" />
    

<?php include fe_view_path() . 'includes/footer.php'; ?>
