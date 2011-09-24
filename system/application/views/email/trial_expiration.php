<?php include config_item('application_root') . 'views/email/includes/header.php'; ?>
<font face="Georgia">
<h1>Your trial with <?= config_item('company_name') ?> is about to expire!</h1>

Website: <a href="<?= config_item('base_url') ?><?= $site_name ?>"><?= config_item('base_url') ?><?= $site_name ?></a><br /><br />

We hope that you have enjoyed using the <?= config_item('company_name') ?> Service! We work hard to keep
our system running smoothly and quickly. But of course, our number one goal is making
our system easy for you to use.

<p>
We truly care about your thoughts and opinions regarding our service.
If something wasn't as intuitive as you had hoped, or there was a feature you wish existed, we want to hear about it! You can send us an email any time at <a href="mailto:<?= config_item('customer_service_email') ?>"><?= config_item('customer_service_email') ?></a>.
</p>

<p>
	You can continue using your account at <a href="<?= config_item('base_url') ?>home/renew"><?= config_item('base_url') ?>home/renew</a> for only <?= $price ?> &minus; 
	the lowest price you will find anywhere for the features you get with <?= config_item('company_name') ?>.
</p>
<p>
	We'll show you what to do as soon as you log in. Thank you for choosing <?= config_item('company_name') ?>!
</p>
</font>
<?php include config_item('application_root') . 'views/email/includes/footer.php'; ?>