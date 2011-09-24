<?php include config_item('application_root') . 'views/email/includes/header.php'; ?>

<h1><?= config_item('company_name') ?> Support Request</h1>

<b>Site Name: <?= $site_name ?></b><br />
<b>URL: <?= config_item('base_url') . $site_name ?></b><br />
<b>Email Address: </b> <?= $email ?><br />
<b>Subject:</b><?= $subject ?><br />
<b>Message: </b><br />
<?= $message ?>

<?php include config_item('application_root') . 'views/email/includes/footer.php'; ?>