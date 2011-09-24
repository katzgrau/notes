<?php include config_item('application_root') . 'views/author/includes/header.php'; ?>
<?php $this->load->helper('url'); ?>
<?php $this->load->helper('input'); ?>


		<!-- Main Content -->
		<?php if( $notification ) echo notification( 'notify', $notification ); ?>
		<?php if( $warning ) echo notification( 'warn', $warning, true ); ?>
		<form id="page_form" method="post" action="<?= base_url() ?>author/account/save/">
			<div id="left">
				<div class="pages">
					<?= rounded_box_open() ?>
						<div>
							<div style="float:left;">First Name</div>
							<div style="float:right;"><input class="settings_text" type="text" name="first_name" value="<?= get_post('first_name', $user->first_name) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>						
						<div>
							<div style="float:left;">Last Name</div>
							<div style="float:right;"><input class="settings_text" type="text" name="last_name" value="<?= get_post('last_name', $user->last_name) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>		
						<div>
							<div style="float:left;">Email</div>
							<div style="float:right;"><input class="settings_text" type="text" name="email" value="<?= get_post('email', $user->email) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>	
<?php if( config_item('individual_accounts_enabled') ): ?>						
						<div>
							<div style="float:left;">Address</div>
							<div style="float:right;"><input class="settings_text" type="text" name="address" value="<?= get_post('address', $user->address ) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>
						<div>
							<div style="float:left;">City</div>
							<div style="float:right;"><input class="settings_text" type="text" name="city" value="<?= get_post('city', $user->city) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>
						<div>
							<div style="float:left;">State</div>
							<div style="float:right;"><input class="settings_text" type="text" name="state" value="<?= get_post('state', $user->state) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>
						<div>
							<div style="float:left;">Zip</div>
							<div style="float:right;"><input class="settings_text" type="text" name="zip" value="<?= get_post('zip', $user->zip) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>
						<div>
							<div style="float:left;">Country</div>
							<div style="float:right;"><input class="settings_text" type="text" name="country" value="<?= get_post('country', $user->country) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>
						<div>
							<div style="float:left;">Phone</div>
							<div style="float:right;"><input class="settings_text" type="text" name="phone" value="<?= get_post('phone', $user->phone) ?>"/></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>
						<div>
							<div style="float:left;">Fax</div>
							<div style="float:right;"><input class="settings_text" type="text" name="fax" value="<?= get_post('fax', $user->fax) ?>" /></div>
							<div class="clear"></div>
							<div class="separator"></div>
						</div>
<?php endif; ?>					
						<div>
							<div style="float:left;">Password</div>
							<div style="float:right;">
								<span id="edit_credit" style="cursor:pointer;"><i>Click to Change Your Password</i></span>
								<span id="done_editing" style="display:none; cursor:pointer;"><i>Click to Hide</i></span>
							</div>
							<div class="clear"></div>
						</div>
						
						<div id="credit_form" style="display:none;">
						<div class="separator"></div>
							<div>
								<div style="float:left;">Current Password</div>
								<div style="float:right;"><input class="settings_text" type="password" name="current_password" value="" /></div>
								<div class="clear"></div>
								<div class="separator"></div>
							</div>	
							<div>
								<div style="float:left;">New Password</div>
								<div style="float:right;"><input class="settings_text" type="password" name="new_password" value="" /></div>
								<div class="clear"></div>
								<div class="separator"></div>
							</div>	
							<div>
								<div style="float:left;">New Password (Again)</div>
								<div style="float:right;"><input class="settings_text" type="password" name="new_password_again" value=""></div>
								<div class="clear"></div>
							</div>	
							<!--
							<div>
								<div style="float:left;">Name on Credit Card</div>
								<div style="float:right;"><input class="settings_text" type="text" name="credit_name" value="<?= $user->credit_name ?>"></div>
								<div class="clear"></div>
								<div class="separator"></div>
							</div>	
							<div>
							<div style="float:left;">Credit Card Provider</div>
								<div style="float:right;"><input type="radio" name="credit_provider" value="Visa" <?php if( $user->credit_provider == "Visa" ) echo "Checked"; ?>/>Visa 
														 <input type="radio" name="credit_provider" value="MasterCard" <?php if( $user->credit_provider == "MasterCard" ) echo "Checked"; ?>/>MasterCard 
														 <input type="radio" name="credit_provider" value="American Express" <?php if( $user->credit_provider == "American Express" ) echo "Checked"; ?>/>Amex 
														 <input type="radio" name="credit_provider" value="Discover" <?php if( $user->credit_provider == "Discover" ) echo "Checked"; ?>/>Discover</div>
								<div class="clear"></div>
								<div class="separator"></div>
							</div>
							<div>
								<div style="float:left;">Credit Card Number</div>
								<div style="float:right;"><input class="settings_text" type="text" name="credit_number" value="<?= $user->credit_number ?>"></div>
								<div class="clear"></div>
								<div class="separator"></div>
							</div>							
							<div>
								<div style="float:left;">Credit Card Expiration Month</div>
								<div style="float:right;"><input class="settings_text" type="text" name="credit_expiration_month" value="<?= $user->credit_expiration_month ?>"></div>
								<div class="clear"></div>
								<div class="separator"></div>
							</div>							
							<div>
								<div style="float:left;">Credit Card Expiration Year</div>
								<div style="float:right;"><input class="settings_text" type="text" name="credit_expiration_year" value="<?= $user->credit_expiration_year ?>"></div>
								<div class="clear"></div>
								<div class="separator"></div>
							</div>							
							<div>
								<div style="float:left;">Credit Card Security Code</div>
								<div style="float:right;"><input class="settings_text" type="text" name="credit_security" value="<?= $user->credit_security ?>"></div>
								<div class="clear"></div>
							</div>
							-->
						</div>
						
							<div class="separator"></div>
							<input type="submit" value="Save Account Information" style="float:right" />
							<div class="clear"></div>
					<?= rounded_box_close() ?>
				</div>
			</div>
			<div id="right">
				<div class="pages">
					<?= rounded_box_open() ?>
						<!-- TODO: Kill ugly javascript -->
						<a class="button" href="javascript:document.getElementById('page_form').submit()"><span class="edit_button">Save Account Information</span></a><br/>
					<?= rounded_box_close() ?>
				</div>
				<p/>
			</div>
			<div class="clear"></div>
		</form>
		<script type="text/javascript">
			Event.observe('edit_credit', 'click', function()
			{
				Effect.BlindDown('credit_form');
				$('edit_credit').hide();
				$('done_editing').show();
			});

			Event.observe('done_editing', 'click', function()
			{
				Effect.BlindUp('credit_form');
				$('done_editing').hide();
				$('edit_credit').show();
			});
		</script>
		<!-- End Main Content -->
<?php include config_item('application_root') . 'views/author/includes/footer.php'; ?>