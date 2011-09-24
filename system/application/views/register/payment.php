<?php $this->load->helper( config_item('payment_helper') ); ?>
<table>
<tr>
<td style="padding-right:120px; vertical-align:top;">
<h1>Step 2: Payment</h1>
<h5>Next: All Done!</h5>
	<p>
		Okay, you're almost there! The next step is to checkout. 
		Once you click the 'Buy' button, you will be taken to an order form where you can fill in your payment details. You can use 
		Visa, MasterCard, American Express or Discover.
	</p>
	<p>
		We handle all of our payments through PayPal, so you can easily pay by credit card. We don't store any sensitive data,
		and all payments are absolutely secure.
	</p>
	<p>
		To pay by credit card, look for the "Don't have a PayPal account? Use your credit card or bank account..." label,
		and follow the link. Have any questions? Email <a href="mailto:customer.service@<Site Name>">customer.service@<Site Name></a>.
	</p>
	<p>
		Once your payment is complete, your order will be automatically procesed, and account details will
		be emailed to you within minutes.
	</p>
</td>
<td style="vertical-align:top;">
<!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr>
<tr><td align="center"><a href="#" onclick="javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img  src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics"></a></td></tr></table><!-- PayPal Logo -->
<p/>

	<p>Here is a review of your order:</p>
<div style="border: 1px solid #000000; background-color: #ffffff; font-family: courier; font-size: 14px; padding: 5px;" >
		<div>1 x 1 Year subscription $<?= number_format($full_price, 2, '.', '') ?></div>
		<?php if( $savings > 0 ): ?>
		<div>1 x $<?= number_format($savings, 2, '.', '') ?> Coupon (-$<?= number_format($savings, 2, '.', '') ?>)</div>
		<?php endif; ?>
		<div style="border: dashed 1px #000000;"></div>
		<div>Total: $<?= number_format($purchase_price, 2, '.', '') ?> </div>
</div>
		<p/>
		
<?= generate_purchase_button( $purchase_price, $site_name, true, $item_title ) ?>

</td>
</tr>
</table>

