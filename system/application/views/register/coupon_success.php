<?php $this->load->helper('url'); ?>
<h1>Contratulations!</h1>

<div style="float:left; width: 450px; margin-top: 0; padding-top:0;">
	<p>
		Your coupon worked. Now you can <a href="<?= base_url() ?>home/login">login</a> by using the 
		login area to the right. Use the site name and password you entered in the last step.
	</p>
	<p>
		You will receive an email soon containing your login information too.
	</p>
	<p>
		Don't forget that in case you ever need a little help getting started, we have an extensive 
		<a href="<?= base_url() ?>help">help section</a>
		complete with written tutorials, and video tutorials. 
	</p>
	<p class="with_picture_frame">
		<img src="<?= base_url() ?>public/common/img/media.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/notes.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/help.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/tools.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/globe.png" width="65" alt="email" />
		<img src="<?= base_url() ?>public/common/img/downloads.png" width="65" alt="email" />
	</p>
</div>

<div style="float:right; border: solid 3px #75B6D4; padding: 15px; padding-bottom: 5px; background-color: white;">
<div style="font-size: 18px; color: #808080; padding-bottom: 10px; border-bottom: solid 1px #cccccc;">Login</div>
		<form method="post" action="<?= base_url() . 'home/login' ?>">
		<div id="login">
			<table>
				<tr>
					<td>Site Name</td>
					<td>
						<input type="text" name="site_name" value="<?= $username ?>" />
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
						<div style="float:right;"><input class="style_button" type="submit" value="Login" /></div>
						<div style="clear:both;"></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
</div>