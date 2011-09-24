<?php $this->load->helper('url') ?>
<?php $this->load->helper('number') ?>
<h1><?= config_item('company_name') ?> Usage Summary</h1>

<h3>By the numbers</h3>
<table border style="border-collapse: collapse;">
	<tr>
		<td><b>Number of Users</b></td>
		<td><?= $number_of_users ?></td>
	</tr>
	<tr>
		<td><b>Disk Usage</b></td>
		<td><?= byte_format( $disk_usage_kb * 8 ) ?></td>
	</tr>	
	<tr>
		<td><b>Page Count</b></td>
		<td><?= $page_count ?></td>
	</tr>
</table>

<h3>10 Most recent coupons signups</h3>
<table border style="border-collapse: collapse;">
	<tr>
		<td>Site Name</td>
		<td>Owner Email Address</td>
		<td>Coupon Creator</td>
		<td>Created</td>
	</tr>
	<?php foreach( $accounts as $account ): ?>
	<tr>
		<td><a href="<?= base_url() . $account->site_name ?>">
				<?= base_url() . $account->site_name ?>
			</a>
		</td>
		<td><?= $account->email ?></td>
		<td><?= $account->username ?></td>
		<td><?= $account->created ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<h3>Most popular coupons</h3>
<table border style="border-collapse: collapse;">
	<tr>
		<td># Times Used</td><td>Coupon Code</td><td>Creator</td><td>Creation Date</td>
	</tr>
	<?php foreach( $coupons as $coupon ): ?>
	<tr>
		<td><?= $coupon->number_used ?></td>
		<td><?= $coupon->code ?></td>
		<td><?= $coupon->username ?></td>
		<td><?= $coupon->created ?></td>
	</tr>
	<?php endforeach; ?>
</table>

