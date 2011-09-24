<?php $this->load->helper('url'); ?>
<h1>Your subscription to <Site Name> is about to expire!</h1>
<h5>Renew your subscription right now and receive $3 off the full price!</h5>
<p>
		We hope that you have enjoyed using our service. We do our best to make sure that it is the
		easiest way for educators to create and maintain websites.
</p>
<p>
		If you renew your subscription right now, we will give you <strong>$3 off the full the price</strong> of <Site Name>.
		We want <Site Name> to be the easiest to use, but we're set on creating the best value for you too.
</p>

<div>
	<a href="<?= base_url() ?>author">Or, skip this and take me to the author pages instead</a>
</div>
<p/>
<div id="signup" style="">
<form method="post" name="renew_form" id="renew_form">
<strong>Renew your subscription in minutes</strong>
<table>
	<tr class="row-a">
	<td>Coupon code (not required for $3 off)
	<?php if( $error ): ?>
	<div style="color:red;"><?= $error ?></div>
	<?php endif; ?>
	</td>
	<td>
		<div class="align_right">
			<input type="text" name="coupon_code" value="" />
			<input type="hidden" name="step" value="renew" />
			<br />
			<small>If you have a coupon, you can enter it here.</small>
		</div>
		</td>
	</tr>
	<tr class="row-b">
	<td></td>
	<td><input type="button" value="Continue To Renewal!" onclick="return next_step();" /></td>
	</tr>
</table>
</form>
</div>