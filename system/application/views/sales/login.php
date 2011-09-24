<html>
	<head>
		<title>Sales Login</title>
	</head>
	<body>
	<?php if( $error ): ?>
		<p><?= $error ?></p>
	<?php endif; ?>
		<form method="post">
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" /></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Login" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>