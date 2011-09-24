<?php include config_item('application_root') . 'views/email/includes/header.php'; ?>

<h1>Your payment has been received!</h1>

<p>Thank you for choosing <?= config_item('company_name') ?>! We work very hard to make sure that you have an easy, but excellent experience using our service.</p>

<p>
You may use this email as a reciept. Your account will be active until <?= $expiration_date ?>. But we'll remind you when that time rolls around.
Until then, you can start using our service anytime you want! You will receive a welcome email with your login information in a few minutes.
</p>
<p>
If you would like to log in now, you can head over to .
</p>
<pre>
Account Details:
    Site Name     : <?= $site_name ?>
    Price         : <?= $purchase_price ?>
    Expiration    : <?= $expiration_date ?>
<pre>
<p>
	Once again, thank you for choosing <?= config_item('company_name') ?>!
</p>


<?php include config_item('application_root') . 'views/email/includes/footer.php'; ?>