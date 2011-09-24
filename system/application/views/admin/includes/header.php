<?php $this->load->helper('url'); ?>
<?php $this->load->helper('control'); ?>
<html>
<head>
	<title>
		<?php echo config_item('company_name'); ?> Admin
	</title>
	<style type="text/css">
	</style>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/author/css/style.css" />
	<script src="<?php echo base_url(); ?>public/common/js/prototype.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/common/js/scriptaculous.js?load=effects,dragdrop" type="text/javascript"></script>
</head>
<body>
		<div id="top"><?php echo config_item('company_name'); ?> Administration</div>
		<div id="nav">
				<div><a class="navLink" href="<?php echo base_url() ."admin#stats"; ?>">View Stats</a></div>
				<div><a class="navLink" href="<?php echo base_url() ."admin#users"; ?>">Edit Users</a></div>
				<div><a class="navLink" href="<?php echo base_url() ."admin#sites"; ?>">Edit Sites</a></div>
				<div><a class="navLink" href="<?php echo base_url() ."admin/logout"; ?>">Logout</a></div>
		</div>
		
		<div id="sub"></div>
		<p />
		<div id="main">