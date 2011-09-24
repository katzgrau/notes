<?php include config_item('application_root') . 'views/help/includes/header.php'; ?>
<?php $this->load->helper('control'); ?>
<?php $this->load->helper('url'); ?>

<div id="left" style="width:800px;">

<?= rounded_box_open() ?>
<p>Your support ticket has been sent. We we be in contact with you via
	email shortly. Please make sure your email address is up to date in the
	account settings page.</p>

<?= rounded_box_close() ?>

</div>
<?php include config_item('application_root') . 'views/help/includes/footer.php'; ?>