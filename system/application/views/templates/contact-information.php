<table cellpadding="10" border style="border-collapse: collapse; width:100%;">
	<tr>
		<td>
			<b>Name</b>
		</td>
		<td>
			<?= $user->first_name ?> <?= $user->last_name ?>
		</td>
	</tr>	
	<tr>
		<td>
			<b>Email Address</b>
		</td>
		<td>
			<?= $user->email ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>Address</b>
		</td>
		<td>
			<?= $user->address ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>City</b>
		</td>
		<td>
			<?= $user->city ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>State</b>
		</td>
		<td>
			<?= $user->state ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>Zip</b>
		</td>
		<td>
			<?= $user->zip ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>Phone</b>
		</td>
		<td>
			<?= $user->phone ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>Fax</b>
		</td>
		<td>
			<?= $user->fax ?>
		</td>
	</tr>
</table>