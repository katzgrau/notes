<?php include config_item('application_root') . 'views/admin/includes/header.php'; ?>
		<?php if( $notification ) echo notification( 'notify', $notification ); ?>
			<div id="left">
				<div class="pages">
					<?= rounded_box_open() ?>
							<div style="float:left;">Users Currently Using Site:</div>
							<div style="float:right;"><?= $session_count ?></div>
							<div class="clear"></div>
							<div class="separator"></div>

							<div style="float:left;">Memory Consumption:</div>
							<div style="float:right;"><?= $this->benchmark->memory_usage(); ?></div>
							<div class="clear"></div>
							<div class="separator"></div>
							
							<div style="float:left;">Upload Disk Usage:</div>
							<div style="float:right;"><?= $upload_disk_usage ?>MB</div>
							<div class="clear"></div>
							<div class="separator"></div>	
							
							<div style="float:left;">Last Site Access (Excluding This Session):</div>
							<div style="float:right;"><?= $last_activity ?></div>
							<div class="clear"></div>
							<div class="separator"></div>								
							
							<div style="float:left;">Total File Count:</div>
							<div style="float:right;"><?= $upload_file_count ?></div>
							<div class="clear"></div>
							<div class="separator"></div>							
							
							<div style="float:left;">Number of Users:</div>
							<div style="float:right;"><?= $user_count ?></div>
							<div class="clear"></div>
							<div class="separator"></div>							
							
							<div style="float:left;">Number of Sites:</div>
							<div style="float:right;"><?= $site_count ?></div>
							<div class="clear"></div>
							<div class="separator"></div>							
							
							<div style="float:left;">Number of Pages:</div>
							<div style="float:right;"><?= $page_count ?></div>
							<div class="clear"></div>
							<div class="separator"></div>
					<?= rounded_box_close() ?>
				</div>
				<p/>
				<div class="pages">
					<form method="post" action="<?= base_url() ?>admin/delete_user">
					<?= rounded_box_open() ?>
					Top Sites By Disk Usage
					<div class="separator"></div>
					<?php foreach( $top_disk_usage_sites as $site ): ?>
						<div style="float:left;"><a target="_blank" href="<?= base_url() ?><?= $site->site_name ?>"><?= $site->site_name ?></a></div>
						<div style="float:right;"><?= round($site->file_usage/1000, 2) ?>MB</div>
						<div class="clear"></div>
						<div class="separator"></div>
					<?php endforeach; ?>
					<?= rounded_box_close() ?>
					</form>
				</div>
			</div>
			<div id="right">
				<div class="pages">
					<?= rounded_box_open() ?>
						<!-- TODO: Kill ugly javascript -->
						<a href="<?= base_url() ?>admin/logout">Logout</a>
					<?= rounded_box_close() ?>
				</div>
			</div>
<?php include config_item('application_root') . 'views/admin/includes/footer.php'; ?>