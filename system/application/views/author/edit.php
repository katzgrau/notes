<?php include config_item('application_root') . 'views/author/includes/header.php'; ?>
<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
		<!-- Main Content -->
		<?php if( $notification ) echo notification( 'notify', $notification ); ?>
		<?php if( $warning ) echo notification( 'warn', $warning, true ); ?>
			<div id="left">
				<div class="pages">
				
					<?= rounded_box_open() ?>
					<form id="page_form" method="post" action="<?= base_url() ?>author/save/<?= $page->parent_id ?>" style="padding:0px; margin:0px;">
						<div style="float:left;">
							<?= generate_tooltip( 'Page Title', 'This will be the title of the current page you are editing.', $are_tooltips_enabled ); ?>
						</div>
						<input type="text" name="title" id="title" value="<?= $page->page_title ?>" />
						<div style="padding-top: 10px; padding-bottom: 10px;">
						<div id="taskbar">
							<ul id="tasklist">
								<li><a href="<?= base_url() ?>author/edit/new"><?= generate_tooltip('New Page', 'Create a new page on your website by clicking here.', $are_tooltips_enabled, false) ?></a></li>
								<li><a id="insert_image_link" <?php if( $page ): ?> rel="gb_page_center[550,240]" <?php endif; ?> href="<?php if( !$page ): ?>#<?php else: ?><?= base_url() ?>author/upload_image/<?= $page->parent_id ?><?php endif; ?>"><?= generate_tooltip('Insert An Image', 'You can upload and insert an image into the page below by clicking here. The image will appear wherever the cursor is.', $are_tooltips_enabled, false) ?></a></li>
								<li><a id="attach_file_link" href="<?php if( !$page ): ?>#<?php else: ?>#attach<?php endif; ?>"><?= generate_tooltip('Attach A File', 'Click here or scroll down to the bottom of this page to attach files to the current page.', $are_tooltips_enabled, false) ?></a></li>
								<li><a rel="gb_page_center[800,250]" href="<?= base_url() ?>author/insert_template"><?= generate_tooltip('Insert A Template', 'Click here to insert a template for this page, like a listing of contact information, schedules, and more.', $are_tooltips_enabled, false) ?></a></li>
								<li><a id="toolbar_save" href="#"><?= generate_tooltip('Save', 'Click here to save the content below as a draft. It will save, but the changes will not be viewable on your website until you click `Publish`.', $are_tooltips_enabled, false) ?></a></li>
								<li><a id="toolbar_publish" href="#"><?= generate_tooltip('Publish', 'Click here to save the content below and make it publicly viewable on your website.', $are_tooltips_enabled, false) ?></a></li>
							</ul>
						</div>
						</div>
						
						<div style="clear:both;"></div>
						<textarea name="content" id="content" >
							<?= $page->content ?>
						</textarea>

						<p/>
					</form>
					<a name="attach"></a>
					<?php if( $page ): ?>
					<?= generate_tooltip( 'Attachments (After you choose a file, click \'Attach File\'):', 'Here you can upload a file from your computer, and attach it to the current page. Click "Browse," choose a file, and then click "Attach File."', $are_tooltips_enabled ); ?>
					<div class="separator"></div>
						<form id="upload_form" method="post" action="<?= base_url() ?>author/upload/<?= $page->parent_id ?>" enctype="multipart/form-data">
							<input type="file" name="userfile" style="float:left;" />
							<input type="submit" value="Attach File" style="float:right;"/>
							<div class="clear"></div>
						</form>
					<?php endif; ?>
					<div>
					<div class="separator"></div>
						<?php foreach( $files as $file ): ?>
							<?php if( !$file->is_insertable_image ): ?>
								<div id="file_<?= $file->id ?>">
									<div style="float:left;"><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->file_name ?></a></div>
									<div style="float:right;">
										<span style="cursor:pointer;" id="remove_<?= $file->id ?>">
											<?php generate_tooltip('<i>Remove</i>', 'Clicking this will remove \''. $file->file_name .'\' from this page, and delete it from your account.', $are_tooltips_enabled); ?>
										</span></div>
									<div class="clear"></div>
									<div class="separator"></div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<div>
						<?php foreach( $files as $file ): ?>
							<?php if( $file->is_insertable_image ): ?>
								<div id="file_<?= $file->id ?>">
									<div style="float:left;"><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->file_name ?></a></div>
									<div style="float:right;">
										<span style="cursor:pointer;" id="remove_<?= $file->id ?>">
											<?php generate_tooltip('<i>Remove</i>', 'Clicking this will remove \''. $file->file_name .'\' from this page, and delete it from your account.', $are_tooltips_enabled); ?>
										</span>
									</div>
									<div style="float:right;">
										<span style="cursor:pointer; padding-right:40px;" id="insert_<?= $file->id ?>">
											<?php generate_tooltip('<i>Insert Image Into Page</i>', 'Clicking this will insert the image \''. $file->file_name .'\' into the current cursor position of the text editor above.', $are_tooltips_enabled); ?>
										</span></div>
									<div class="clear"></div>
									<div class="separator"></div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<?= rounded_box_close() ?>
				
				</div>
			</div>
			<div id="right">
				<div class="pages">
					<?= rounded_box_open() ?>
						<!-- TODO: Kill ugly javascript -->
						<a class="button" href="#" id="save_draft_link"><span class="edit_button">Save Draft</span></a><br/>
						<a class="button" href="#" id="publish_link"><span class="edit_button">Publish</span></a>
						<?= generate_tooltip('<p style="font-style:italic; padding:0; margin:0;" id="ajax_update_status"></p>', 'Your work is saved as a draft automatically every 45 seconds so you don\'t lose anything.', $are_tooltips_enabled) ?>
					<?= rounded_box_close() ?>
				</div>
				<p/>
				<div>
					<?= rounded_box_open() ?>
						<?= generate_tooltip('Pages On Your Site:', 'Here are all the pages you have on your website. Click a page to edit it in the text area to the left.', $are_tooltips_enabled ) ?>
						<br/>
						<small><i>Click a page to edit</i></small>
						<p/>
						<div id="pages">
							<div><a class="pageLink" href="<?= base_url() ?>author/edit/new">New Page <img src="<?= base_url() ?>/public/author/img/new-document.gif" height="16" width="16"/></a></div>
							<?php foreach($page_meta as $meta): ?>
								<div><a class="pageLink" href="<?= base_url() ?>author/edit/<?= $meta->parent_id ?>"><?= $meta->page_title ?></a></div>
							<?php endforeach; ?>
						</div>
					<?= rounded_box_close() ?>
				</div>
				<?php if( config_item('hit_tracking_enabled') && $hits ): ?>
					<p />
					<div class="pages">
						<?= rounded_box_open() ?>
							<div><?= generate_tooltip('Visits To This Page', 'This is the number of times this page has been visited, broken down by day, week, month, and year.', $are_tooltips_enabled ) ?></div>
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
				<p/>
				<?php if( $page ): ?>
				<div>
					<?= rounded_box_open() ?>
					<?php if( $page->is_draft && $has_published_version ): ?>
						<a class="button" href="<?= base_url() ?>author/revert/<?= $page->parent_id ?>"><span class="edit_button">Revert To Published</span></a>
					<?php endif; ?>

						<?php if( $has_published_version ): ?>
							<a class="button" href="<?= base_url() ?>author/unpublish/<?= $page->parent_id ?>"><span class="edit_button">Unpublish</span></a>
						<?php endif; ?>
						
						<a class="button" href="<?= base_url() ?>author/delete/all/<?= $page->parent_id ?>"><span class="edit_button">Delete Page</span></a>
					<?= rounded_box_close() ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
			
			<script type="text/javascript">	

				<?php if( $page ): ?>
					form_submit_url 	= '<?= base_url() ?>author/save/<?= $page->parent_id ?>';
					ajax_submit_url 	= '<?= base_url() ?>author/ajax_save/<?= $page->parent_id ?>';
					is_new 				= false;
				<?php else: ?>
					form_submit_url 	= '<?= base_url() ?>author/save/';
					ajax_submit_url 	= '<?= base_url() ?>author/ajax_save/';
					is_new 				= true;
				<?php endif; ?>

				last_length = $('content').value.length;
				pId = parseInt( '0' + '<?= $page->parent_id ?>', 10 );
				
				function save_draft_ajax()
				{
					title = $('title').value;
					
					if (title.length == 0) return;
					
					tinyMCE.activeEditor.save();
					
					content_length = $('content').value.length;
					
					if ( content_length == last_length ) { return; }
					
					last_length = content_length;
					
					new Ajax.Request(ajax_submit_url,
					  {
						method:'post',
						parameters: $('page_form').serialize(true),
						onSuccess: function(transport){
						
						  var curtime 					= new Date();
						  var curhour 					= curtime.getHours();
						  if( curhour == 0 ) curhour 	= 12;
						  if ( curhour > 12 ) curhour 	-= 12;
						  var curmin 					= curtime.getMinutes();
						  if( curmin < 10 ) curmin 		= '0' + curmin;
						  
						  $('ajax_update_status').update('A draft was autosaved at ' + curhour + ':' + curmin + '.');
						  
							if( is_new )
							{
								pId						= transport.responseText;
								ajax_submit_url 		= ajax_submit_url + pId;
								form_submit_url 		= form_submit_url + pId;
								$('page_form').action 	= form_submit_url;
								Element.insert('pages', '<div><a class="pageLink" href="<?= base_url() ?>author/edit/' + 
												transport.responseText + '">' + title + '</a></div>');
								is_new = false;
							}
						
						},
						onFailure: function(){ alert('Something went wrong...'); }
					  });	
				}

				Event.observe('save_draft_link', 'click', function(){
					$('page_form').submit();
				});
				
				Event.observe('toolbar_save', 'click', function(){
					$('page_form').submit();
				});
				
				Event.observe('publish_link', 'click', function(){
					$('page_form').action = '<?= base_url() ?>author/publish/' + pId;
					$('page_form').submit();
				});
				
				Event.observe('toolbar_publish', 'click', function(){
					$('page_form').action = '<?= base_url() ?>author/publish/' + pId;
					$('page_form').submit();
				});
				
				new PeriodicalExecuter(save_draft_ajax, <?= config_item('editor_autosave_timeout_seconds') ?>);



			</script>
			
			<?php if( ! $page ): ?>
			<script type="text/javascript">
					Event.observe('insert_image_link', 'click', function(e){
						conf = confirm('To upload and insert an image you must first save the page. Would you like to do that?');
						if( conf ) $('page_form').submit();
					});
					
					Event.observe('attach_file_link', 'click', function(e){
						conf = confirm('To attach a file you must first save the page. Would you like to do that?');
						if( conf ) $('page_form').submit();
					});
			</script>
			<?php endif; ?>
			
			<?php if( $page ): ?>
			<script type="text/javascript">
				function remove_file( id, contId )
				{
					new Ajax.Request('<?= base_url(); ?>author/remove_file/<?= $page->parent_id ?>/' + id,
					  {
						method:'get',
						onSuccess: function(transport){
							Effect.DropOut( contId );
						}
					  });
				}
				
				function insert_file( id, markup )
				{
					tinyMCE.activeEditor.focus();
					tinyMCE.activeEditor.selection.setContent( markup );
					parent.parent.GB_hide();
				}

				
				<?php foreach( $files as $file ): ?>
					Event.observe('remove_<?= $file->id ?>', 'click', function(){
						remove_file( <?= $file->id ?>, 'file_<?= $file->id ?>' );
					});
				<?php endforeach ?>
				
				<?php foreach( $files as $file ): ?>
					<?php if( $file->is_insertable_image ): ?>
						Event.observe('insert_<?= $file->id ?>', 'click', function(){
							insert_file( <?= $file->id ?>, '<img src="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>" />' );
						});
					<?php endif; ?>
				<?php endforeach ?>
			</script>
			<?php endif; ?>
		<!-- End Main Content -->
<?php include config_item('application_root') . 'views/author/includes/footer.php'; ?>