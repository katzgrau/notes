<?php include config_item('application_root') . 'views/author/includes/header.php'; ?>
<?php $this->load->helper('url'); ?>
<?php $this->load->helper('input'); ?>


		<!-- Main Content -->
		<?php if( $show_intro_message ) echo notification( 'intro_message', 'Welcome to ' . config_item('company_name') . '! 
				<a target="_blank" href="'. base_url() .'help/video/introduction">Click here</a> to watch a video tutorial which will guide you through everything you need to know about managing your new website!<br/> <br/>
				<small><i><a href="'. base_url() .'author/disable_intro_message/desktop">Click here</a> if you do not wish to see this message again.</i></small>', false, false); ?>
		<?php if( $notification ) echo notification( 'notify', $notification ); ?>
		<?php if( $warning ) echo notification( 'warn', $warning, true ); ?>
		
			<div id="left">
				<div class="pages">
					<?= rounded_box_open() ?>
						<div class="header-2">The <Site Name> Authoring Panel</div>
						<p>Choose from the items below. What would you like to do?</p>
						<div id="main-menu">
							<ul>
								<li>
									<div class="item" onclick="window.open('<?= base_url() . $site_name ?>', 'nx')">
										<div class="menu-image">
											<a target="_blank" href="<?= base_url() . $site_name ?>"><img alt="" src="<?= base_url() ?>public/common/img/globe.png" /></a>
										</div>
										<div class="menu-description">
											<a target="_blank" href="<?= base_url() . $site_name ?>">
												View Your Website
											</a>
											<p>
												Website Location: <a target="_blank" href="<?= base_url() . $site_name ?>"><?= base_url() . $site_name ?></a>
											</p>
											<p>
												This is your website's URL. Anyone who has this address and access to the internet can
												view your website by typing this in to their web browser's address bar.
											</p>
										</div>
										<div style="clear:both;"></div>
									</div>
								</li>
								<li>
									<div class="item" onclick="window.location='<?= base_url() ?>author/edit'">
										<div class="menu-image">
											<a href="<?= base_url() ?>author/edit"><img alt="" src="<?= base_url() ?>public/common/img/notes.png" /></a>
										</div>
										<div class="menu-description">
											<a href="<?= base_url() ?>author/edit">
												Edit Your Pages
											</a>
											<p>
												Here is where you control everything content-related on your website. If 
												you want to change your page content, add pages, delete them, upload images,
												or attach files, this is where you can do it.
											</p>
										</div>
										<div style="clear:both;"></div>
									</div>
								</li>
								<li>
									<div class="item" onclick="window.location='<?= base_url() ?>author/settings'">
										<div class="menu-image">
											<a href="<?= base_url() ?>author/settings"><img alt="" src="<?= base_url() ?>public/common/img/tools.png" /></a>
										</div>
										<div class="menu-description">
											<a href="<?= base_url() ?>author/settings">
												Change Your Site Settings
											</a>
											<p>
												Here is where you can change site-wide settings that don't relate to a specific
												page that you created. For example, if you want to change how your website looks, add links to the sidebar,
												or rearrange the way pages are displayed, this is where you do that.
											</p>
										</div>
										<div style="clear:both;"></div>
									</div>
								</li>
								<li>
									<div class="item" onclick="window.location='<?= base_url() ?>author/account'">
										<div class="menu-image">
											<a href="<?= base_url() ?>author/account"><img alt="" src="<?= base_url() ?>public/common/img/clipboard.png" /></a>
										</div>
										<div class="menu-description">
											<a href="<?= base_url() ?>author/account">
												Edit Your Account Information
											</a>
											<p>
												This is where you can edit things related to your user account. If you want
												to change your password, for instance, this is where you do that.
											</p>
										</div>
										<div style="clear:both;"></div>
									</div>
								</li>
								<li>
									<div class="item item-last" onclick="window.open('<?= base_url() ?>help', 'np');">
										<div class="menu-image">
											<a href="<?= base_url() ?>help"><img alt="" src="<?= base_url() ?>public/common/img/help.png"/></a>
										</div>
										<div class="menu-description">
											<a href="<?= base_url() ?>help">
												Help
											</a>
											<p>
												Are you having trouble figuring something out? Head over to our help section,
												where we have both written and video tutorials to help you learn how to use all
												of our features.
											</p>
										</div>
										<div style="clear:both;"></div>
									</div>
								</li>
							</ul>
						</div>
					<?= rounded_box_close() ?>
				</div>
			</div>
			<div id="right">
				<div class="pages">
					<?= rounded_box_open() ?>
						<div>Help Topics</div>
						<p />
						<div><a target="_blank" class="pageLink" href="<?= base_url() ?>help/introduction/learning-the-authoring-panel">Getting Started</a></div>
						<div><a target="_blank" class="pageLink" href="<?= base_url() ?>help/introduction/adding-a-page">Adding A Page</a></div>
						<div><a target="_blank" class="pageLink" href="<?= base_url() ?>help/introduction/editing-a-page">Editing A Page</a></div>
						<div><a target="_blank" class="pageLink" href="<?= base_url() ?>help/site/changing-site-design">Changing Your Design</a></div>
						<div><a target="_blank" class="pageLink" href="<?= base_url() ?>help/edit/uploading-a-picture">Uploading Pictures</a></div>
						<div><a target="_blank" class="pageLink" href="<?= base_url() ?>help/edit/attaching-a-file">Attaching Files</a></div>
					<?= rounded_box_close() ?>
				</div>
				<?php if( config_item('hit_tracking_enabled') ): ?>
					<p />
					<div class="pages">
						<?= rounded_box_open() ?>
							<div><?= generate_tooltip('Visits to Your Website', 'This is the number of times your website has been visited, broken down by day, week, month, and year.', $are_tooltips_enabled ) ?></div>
							<p />
							<table width="100%">
								<tr>
									<td>Day:</td><td><?= $hits->day ?></td>
								</tr>
								<tr>
									<td>Week:</td><td><?= $hits->week ?></td>
								</tr>
								<tr>
									<td>Month:</td><td><?= $hits->month ?></td>
								</tr>
								<tr>
									<td>Year:</td><td><?= $hits->year ?></td>
								</tr>
							</table>
							
						<?= rounded_box_close() ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
		<!-- End Main Content -->
<?php include config_item('application_root') . 'views/author/includes/footer.php'; ?>