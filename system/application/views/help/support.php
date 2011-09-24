<?php include config_item('application_root') . 'views/help/includes/header.php'; ?>
<?php $this->load->helper('control'); ?>
<?php $this->load->helper('url'); ?>
		<?php if( $notification ) echo notification( 'notify', $notification, false, false ); ?>
		<?php if( $warning ) echo notification( 'warn', $warning, true, false ); ?>
<div id="left" style="width:800px;">

<?= rounded_box_open() ?>

<p>Do you need help with something that isn't covered in our tutorials?
   Send us a message, and we'll get back to you as quickly as possible</p>
<p>Make sure you are as descriptive as possible to ensure a prompt resolution.</p>
<form method="post" action="<?= base_url() ?>help/support" >
	<div class="separator"></div>
	<div style="float:left;">Subject<br/>
	</div>
	<input type="text" name="subject" value="<?= $subject ?>" class="settings_text" style="float:right; width:500px;" />
	<div style="clear:both;"></div>
	<div class="separator"></div>	
	
	<div style="float:left;">Message<br/>
	</div>
	
	<div style="float:right;">
		<textarea name="message" style="width:500px; height:400px;"><?= $message ?></textarea>
	</div>
	<div style="clear:both;"></div>
	<div class="separator"></div>	
	
	<div style="float:left;">Send it Off<br/>
	</div>
	
	<div style="float:right;">
		<input type="submit" value="Send Support Ticket" />
	</div>
	<div style="clear:both;"></div>

	
	
	</input>
<form>

<?= rounded_box_close() ?>

</div>
<?php include config_item('application_root') . 'views/help/includes/footer.php'; ?>