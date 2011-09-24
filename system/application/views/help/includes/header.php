<?php $this->load->helper('url'); ?>
<?php $this->load->helper('control'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>
			<?php echo config_item('company_name'); ?> Author :: Help
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/author/css/style.css" >
	</head>
	<body> 
		<div id="top"><?php echo config_item('company_name'); ?> Author &#8594; Help</div>
		<div id="nav">
				<div><a class="navLink" href="<?php echo base_url(); ?>help">Main Help Page</a></div>
				<div><a class="navLink" href="<?php echo base_url(); ?>help/support">Contact Support</a></div>
				<div class="clear"></div>
		</div>
		<div id="sub"></div>
		<p />
		<div id="main">
		<div id="help_main">
		