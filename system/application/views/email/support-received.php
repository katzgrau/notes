<?php include config_item('application_root') . 'views/email/includes/header.php'; ?>

<h1>Your <?= config_item('company_name') ?> Support Request Has Been Received</h1>

<p>We will respond to you via email as soon as possible. Thank you taking the time to 
request our help!</p>

<h3>Subject:</h3>
<p>
	<?= $subject ?>
</p>

<h3>Message:</h3>
<p>
	<?= $message ?>
</p>

<?php include config_item('application_root') . 'views/email/includes/footer.php'; ?>