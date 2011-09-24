<?php include fe_view_path() . 'includes/header.php'; ?>
<?php $this->load->helper('url'); ?>

    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
        
      <div id="col-text2">

 <h2>Password Recovery</h2>
 
 <?php if( $status ): ?>
	<p style="color:red;"><?= $status ?></p>
<?php endif; ?>
<div style="float:left; width: 450px; margin-top: 0; padding-top:0;">
	<p>
		Enter your site name in the box to the right, and click "Send Reminder."
		This will send an email your username and password to the email address you signed up with.
	</p>
	<p>
		Your password recovery email will arrive within 15 minutes of submitting this request. If you
		do not receive an email, contact customer service at <a href="mailto:<?= config_item('customer_service_email') ?>"><?= config_item('customer_service_email') ?></a>.
	</p>
</div>

<div style="float:right; border: solid 3px #75B6D4; padding: 15px; padding-bottom: 5px; background-color: white;">
<div style="font-size: 18px; color: #808080; padding-bottom: 10px; border-bottom: solid 1px #cccccc;">Password Recovery</div>
		<form method="post" action="<?= base_url() . 'home/forgot_password' ?>">
		<div id="login">
			<table>
				<tr>
					<td>Site Name</td>
					<td>
						<input type="text" name="site_name" value="" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div style="float:right;"><input class="style_button" type="submit" value="Send Reminder" /></div>
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
