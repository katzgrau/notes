<?php $this->load->helper('url') ?>
<html>
<head>
	<title><?= config_item('company_name') ?> Administration Login</title>
</head>
<body>
<h1><?= config_item('company_name') ?> Administration Login</h1>
<form method="post" action="<?= base_url() ?>admin/login">
<?= $message ?>
	<table>
		<tr>
			<td>Username</td>
			<td>
				<input type="text" name="username" value="" />
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input type="password" name="password" value="" />
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<div style="float:right;"><input type="submit" value="Login" /></div>
				<div style="clear:both;"></div>
			</td>
		</tr>
	</table>
</form>
</body>
</html>