<?php $this->load->helper('url'); ?>
<html>
	<head>
		<title>Sales Portal</title>
	</head>
	<body>
	<h1>
		Logged in as <?= $this->session->userdata('username'); ?>
	</h1>
	<p><a href="<?= base_url() ?>sales/logout">Logout</a></p>
	<h2>Create a coupon</h2>
	<?php if( $message ): ?>
		<h4><?= $message ?></h4>
	<?php endif; ?>
	<?php if( $error ): ?>
	A coupon could not be created. Check that you:
		<ul>
			<li>Supplied a valid price</li>
			<li>Supplied a valid number of weeks for the coupon to expire after</li>
			<li>Supplied a valid coupon code</li>
		</ul>
	<?php endif; ?>
		<p>Make coupons</p>
		<form method="post">
			<table>
				<tr>
					<td>
						Coupon code
					</td>
					<td>
						<input type="text" name="coupon_code" value="<?= $random_hash ?>" />
					</td>
				</tr>
				<tr>
					<td>
						Expected final price (after coupon is applied )
					</td>
					<td>
						<input type="text" name="after_price" />
					</td>
				</tr>
				<tr>
					<td>
						Is this a single use coupon?
					</td>
					<td>
						<select name="is_single_use">
						  <option value="1">Yes</option>
						  <option value="0">No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						After a user signs up, when will his account expire (days)?
					</td>
					<td>
						<input type="text" name="days_expiration" value="<?= $default_expiration ?>" />
					</td>
				</tr>
				<tr>
					<td>
						Is this coupon for a trial?
					</td>
					<td>
						<select name="is_trial">
						<option value="0">No</option>
						<option value="1">Yes</option>  
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Any Comments
					</td>
					<td>
						<input type="text" name="comment" />
					</td>
				</tr>	
				<tr>
					<td>
						
					</td>
					<td>
						<input type="submit" value="Create Coupon" />
					</td>
				</tr>				
			</table>
		</form>
		<h2>View/Activate/Reactivate Coupons</h2>
		<table border>
			<tr>
				<td>
					Coupon Code
				</td>
				<td>
					Final Price
				</td>
				<td>
					Single Use?
				</td>
				<td>
					Trial?
				</td>				
				<td>
					Days after signup until expiration?
				</td>
				<td>
					Still Active?
				</td>
				<td>
					Comments
				</td>
				<td>
					Created
				</td>
				<td>
					Deactivate/Reactivate
				</td>
			</tr>
		<?php foreach( $coupons as $coupon ): ?>
			<tr>
				<td>
					<?= $coupon->code ?>
				</td>
				<td>
					<?= $coupon->after_price ?>
				</td>
				<td>
					<?= ($coupon->is_single_use ? "Yes" : "No") ?>
				</td>
				<td>
					<?= ($coupon->is_trial ? "Yes" : "No") ?>
				</td>
				<td>
					<?= ($coupon->term_expiration) ?>
				</td>
				<td>
					<?= ($coupon->is_active ? "Yes" : "No") ?>
				</td>
				<td>
					<?= (!$coupon->comment ? "None" : $coupon->comment) ?>
				</td>
				<td>
					<?= $coupon->created ?>
				</td>
				<td>
					<?php if( $coupon->is_active ): ?>
						<a href="<?= base_url() ?>sales/deactivate_coupon/<?= $coupon->code ?>">Deactivate</a>
					<?php else: ?>
						<a href="<?= base_url() ?>sales/reactivate_coupon/<?= $coupon->code ?>">Reactivate</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
		<h2>Password Change</h2>
		<form method="post" action="<?= base_url() ?>sales/change_password">
			<table>
				<tr>
					<td>
						Old Password
					</td>
					<td>
						<input type="password" name="old_password" />
					</td>
				</tr>
				<tr>
					<td>
						New Password
					</td>
					<td>
						<input type="password" name="new_password" />
					</td>
				</tr>
				<tr>
					<td>
						New Password Again
					</td>
					<td>
						<input type="password" name="new_password_again" />
					</td>
				</tr>
				<tr>
					<td>
						
					</td>
					<td>
						<input type="submit" value="Change Password" style="float:right;" />
					</td>
				</tr>
			</table>
		</form>
		<h2>100 Most Recent Coupon Signups</h2>
		<table border>
			<tr>
				<td>Site Name</td>
				<td>Email Address</td>
				<td>Signup Coupon</td>
				<td>Coupon Owner</td>
				<td>Starting Price</td>
				<td>Creation Date</td>
			</tr>
			<?php foreach( $recent_signups as $signup ): ?>
			<tr>
				<td><a target="_blank" href="<?= base_url() . $signup->site_name ?>"><?= $signup->site_name ?></a></td>
				<td><a href="mailto:<?= $signup->email ?>"><?= $signup->email ?></a></td>
				<td><?= $signup->code ?></td>
				<td><?= $signup->username ?></td>
				<td>$<?= $signup->starting_cost ?></td>
				<td><?= $signup->created ?></td>
			</tr>				
			<?php endforeach; ?>
		</table>
	</body>
</html>