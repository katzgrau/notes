<?php $this->load->helper( config_item('payment_helper') ); ?>
<table style="width:100%;">
<tr>
<td style="padding-right:120px; vertical-align:top;">
<h1>Renew your subscription</h1>
<h5>Receive $3 off the full price if you re-order now!</h5>
	<p>
		Paying now is just as easy as when you signed up! Below is a summary of your renewal.
		You can pay via credit card. Just click the "Buy Now" button below.
	</p>
	<p>
		You will be taken to the paypal payment page.
	</p>
</td>
<td style="vertical-align:top;">
<!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr>
<tr><td align="center"><a href="#" onclick="javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img  src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics"></a></td></tr></table><!-- PayPal Logo -->
<p/>

	<p>Here is a review of your order:</p>
<div style="border: 1px solid #000000; background-color: #ffffff; font-family: courier; font-size: 14px; padding: 5px;" >
		<div>1 x 1 Year Renewal $<?= number_format( $full_price, 2, '.', '') ?></div>
		<div>1 x $3.00 Discount (-$<?= number_format($savings, 2, '.', '') ?>)</div>
		<div style="border: dashed 1px #000000;"></div>
		<div>Total: $<?= number_format($purchase_price, 2, '.', '') ?> </div>
</div>
		<p/>

<?= generate_purchase_button( $purchase_price, $site_name, false, $item_title, $account_id ) ?>

</td>
</tr>
</table>