<?php $this->load->helper('input'); ?>
<?php $this->load->helper('url'); ?>
<form id="register_form" name="register_form" method="post">
<h1>Step 1: Set Up Your Account</h1>
<?php if( $errors ): ?>
<ul>
	<?= $errors ?>
</ul>
<?php endif; ?>
<h5>Next: Payment Information. After that: Done!</h5>
	<div id="signup">
	<table>
		<tr class="row-a">
			<td><span style="float:left;"><strong>Site Name</strong></span>
				<span id="site_name_gif" style="float:right; display:none; padding:3px;"></span>
				<span id="site_name_status" style="float:right;"></span>
				<div style="clear:both"></div>
			</td>
			<td style="width:400px;">
				<div class="align_right">
					<input type="text" id="site_name" name="site_name" value="<?= get_post('site_name') ?>" />
					<br /><small>This will be used in your website address. <br/>It can be like <strong>sitename</strong>, <strong>site-name</strong>, <strong>site.name</strong> and more.<br/>Example: <?= config_item('base_url') ?><b>sitename</b></small>
					<p>
						<input onclick="check_sitename()" type="button" value="Check Site Name Availability" />
					</p>
				</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
		<tr class="row-b">
			<td><strong>Email Address</strong></td>
			<td>
				<div class="align_right">
					<input type="text" name="email" value="<?= get_post('email') ?>" />
					<br /><small>Your email address must be valid.<br/> We will use it to verify any coupons or payments!</small>
				</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
		<tr class="row-a">
			<td><strong>Password</strong></td>
			<td>
				<div class="align_right">
					<input type="password" name="admin_password" value="<?= get_post('admin_password') ?>" />
					<br /><small>Make sure your password is secure.<br/> It must be at least 5 characters long.</small>
				</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
		<tr class="row-b">
			<td><strong>Password (Again)</strong></td>
			<td>
				<div class="align_right">
					<input type="password" name="admin_password_again" value="<?= get_post('admin_password_again') ?>" />
					<br /><small>Re-enter your password.</small>
				</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
		<tr class="row-a">
			<td><strong>Coupon (Not Required)</strong></td>
			<td>
				<div class="align_right">
					<input type="text" name="coupon_id" value="<?= get_post('coupon_id') ?>" />
					<br /><small>If you have a coupon code, enter it here.<br/> We will check it on the next step.</small>
				</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
		<tr class="row-b">
			<td><strong><?= $robot_question ?></strong></td>
			<td>
				<div class="align_right">
					<input type="text" name="verification" value="<?= get_post('verification') ?>" />
					<br /><small>We need to make sure this form isn't being submitted by a<br/> a crawler like Google!</small>
					</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
		<tr class="row-a">
			<td><strong>Almost there!</strong></td>
			<td>
				<div class="align_right">
					<input type="button" value="Continue" onclick="return next_step();" />
					
				</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
	</table>
	</div>
	<input type="hidden" name="step" value="register" />
</form>