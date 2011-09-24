<?php $this->load->helper('url') ?>
<html>
<head>
	<title><?= config_item('company_name') ?> Installation Login</title>
</head>
<body>
<h1><?= config_item('company_name') ?> Installation Login</h1>
<p>
	After you submit the form with the correct credentials, this
	script will immediately build the data model in the database.
	Therefore, make sure that:
	<ul>
		<li>You are not using database sessions yet (config.php)</li>
		<li>You have edited your database configuration (this script will insert tables in the default database in config/database.php)</li>
	</ul>
</p>
<form method="post" action="<?= base_url() ?>install/index" >
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