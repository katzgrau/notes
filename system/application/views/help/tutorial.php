<?php include config_item('application_root') . 'views/help/includes/header.php'; ?>
<?php $this->load->helper('control'); ?>

<div id="left" style="width:1020px;">

<?= rounded_box_open() ?>

<?= $content ?>

<?= rounded_box_close() ?>

</div>
<?php include config_item('application_root') . 'views/help/includes/footer.php'; ?>