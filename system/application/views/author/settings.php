<?php include config_item('application_root') . 'views/author/includes/header.php'; ?>
<?php $this->load->helper('url'); ?>
		<!-- Main Content -->
		<?php if( $notification ) echo notification( 'notify', $notification ); ?>
		<?php if( $warning ) echo notification( 'warn', $warning, true ); ?>
		<form id="page_form" method="post" action="<?= base_url() ?>author/settings/save/">
			<div id="left">
				<div class="pages">
					<?= rounded_box_open() ?>
						<div class="pages">
							<div style="float:left;">
								<?php echo generate_tooltip('Site Title', 'This is the main title that will be displayed on your website. Your website address &minus;<br/> '. base_url() . $site_name . '<br/> will remain the same.', $are_tooltips_enabled) ?>
							</div>
							<div style="float:right;"><input class="settings_text" type="text" name="site_display_name" id="site_name" value="<?= $siteMeta->display_name ?>"/></div>
							<div class="clear"></div>
							<div class="separator"></div>
							<div style="float:left;">
								<?php echo generate_tooltip('Site Design', 'Here you can choose what your website looks like. Only the design will change &minus not the content. Click on a design to preview your website with that layout.', $are_tooltips_enabled) ?>
							</div>
							<div style="float:right;">
								<div style="display:none;" id="loading"><img src="<?= base_url() ?>public/author/img/ajax-loader.gif" /></div>
							</div>
							<div class="clear"></div>
							<div id="theme_selector">
								<div id="theme_frame">
								</div>
								<div>
									<div style="float:left;">
										<span style="display: none; cursor:pointer;" id="get_last">
											<?php echo generate_tooltip('<i>&#8592;Get Last</i>', 'Click here to go to the last page of designs that you can use with your website.', $are_tooltips_enabled) ?>
										</span>
									</div>
									<div style="float:right;">
										<span style="display: none; cursor:pointer;" id="get_next">
											<?php echo generate_tooltip('<i>Get Next&#8594;</i>', 'Click here to get the next page of designs that you can use with your website.', $are_tooltips_enabled) ?>
										</span>
									</div>
									<div class="clear"></div>
								</div>
							</div>
							<div class="separator"></div>
						</div>
						<br/>
						<div>
							<div class="settings_column_left">
							<?php echo generate_tooltip('Page Order', 'These are the pages that are publicly visible on your website. You can click and drag any of these items to any position in the list.', $are_tooltips_enabled) ?>
							<br/><small><i>Click and drag to reorder</i></small>
							<p/>
								<div id="page_list" class="cursor_updown">
									<?php foreach($pageMeta as $page): ?>
									<div id="list_<?= $page->id ?>"><?= $page->page_title ?></div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="settings_column_right">
								<?php echo generate_tooltip('Link Order', 'This is where you can rearrange the way links are displayed on your website. You can click and drag any of these items to any position in the list.', $are_tooltips_enabled) ?>
							<br/><small><i>Click and drag to reorder</i></small>
							<p/>
								<div id="link_list">
									<?php foreach($linkMeta as $link): ?>
									<div id="link_list_<?= $link->id ?>">
										<span style="float:left;" class="link_handle cursor_updown"><?= $link->title ?></span>
										<span style="cursor: pointer; float:right;" id="remove_link_<?= $link->id ?>">
											<small>
												<?php echo generate_tooltip('<i>Remove</i>', 'Clicking this will remove the \''. $link->title .'\' link from your website.', $are_tooltips_enabled) ?>
											</small>
										</span>
										<br style="clear:both; display;" />
									</div>
									<?php endforeach; ?>
								</div>
							<br/>
							<p/>
							<?php echo generate_tooltip('Add Links', 'Here you can enter website links, and they will appear automatically on your website. <br /><br />Just enter the website URL (or address) below, and the name to display for the link below that. Then click "Add Link."', $are_tooltips_enabled) ?>
							<br/><small><i>Enter the URL, and the name you would like to <br/>display. Then click 'Add Link'.</i></small><p/>
							<table style="width:100%; padding-right:10px;">
								<tr>
									<td><span class="label" style="color:#ffffff;">
										<?= generate_tooltip( 'Url:', 'Enter the website address of the page you would like to link to here (like http://google.com).', $are_tooltips_enabled ); ?>
									</span></td><td><input class="settings_text" style="width:100%;" type="text" name="new_link_url" id="new_link_url" /></td></tr>
								<tr>
									<td><span class="label" style="color:#ffffff;" >
										<?= generate_tooltip( 'Title:', 'Enter the title, or display name of the page you would like to link to here (like "Google"). Then click "Add Link"', $are_tooltips_enabled ); ?>
									</span></td><td><input class="settings_text" style="width:100%;" type="text" name="new_link_title" id="new_link_title" /></td></tr>
								<tr>	
									<td></td><td><input style="float:right; clear:both;" type="button" id="btnAddLink" value="Add Link"/></td></tr>
							</table>
							
							</div>
							<div class="clear"></div>
							<br/>
							<div class="separator"></div>
							<input type="submit" value="Save Settings" style="float:right" />
							<div class="clear"></div>
						</div>
					<?= rounded_box_close() ?>
				</div>
			</div>
			<div id="right">
				<div class="pages">
					<?= rounded_box_open() ?>
						<!-- TODO: Kill ugly javascript -->
						<a class="button" href="javascript:document.getElementById('page_form').submit()"><span class="edit_button">Save Settings</span></a><br/>
					<?= rounded_box_close() ?>
				</div>
				<p/>
			</div>
			<div class="clear"></div>
		</form>
		<script type="text/javascript">
		// <!--
			Sortable.create("page_list", {onUpdate: UpdatePageOrder, tag: 'div'});
			function UpdatePageOrder()
			{
				new Ajax.Request('<?= base_url(); ?>ajax/savePageOrder',
				  {
					method:'post',
					parameters: {page_list: Sortable.serialize('page_list')},
					onSuccess: function(transport){
					  var response = transport.responseText;
					  //alert("Success! \n\n" + response);
					}
					//onFailure: function(){ alert('Something went wrong...') }
				  });
			}
			Sortable.create("link_list", {onUpdate: UpdateLinkOrder, handle: 'link_handle', tag: 'div' });
			function UpdateLinkOrder()
			{
				new Ajax.Request('<?= base_url(); ?>ajax/saveLinkOrder',
				  {
					method:'post',
					parameters: {link_list: Sortable.serialize('link_list')},
					onSuccess: function(transport){
					  var response = transport.responseText;
					  //alert("Success! \n\n" + response);
					}
					//onFailure: function(){ alert('Something went wrong...') }
				  });
			}
			
			Event.observe('btnAddLink', 'click', function addLink(event)
			{
				var url = $('new_link_url');
				var title = $('new_link_title');
				
				if( title.value.replace(/\s+/,"").length == 0 )
				{	
					alert('Please enter a descriptive title for the link in the field labeled \'Title\'.'); 
					return; 
				}
				
				new Ajax.Request('<?= base_url(); ?>ajax/add_link', {
				  method: 'post',
				  parameters: { linkUrl: url.value, linkTitle: title.value },
				  onSuccess: function(transport)
				  {
				    id = transport.responseText;
					
					Element.insert('link_list', '<div id="link_list_' + id + '">' + 
										'<span style="float:left;" class="link_handle cursor_updown">'+ title.value +'</span>' +
										'<span style="cursor: pointer; float:right;" id="remove_link_' + id + '"><i><small>Remove</small></i></span>' +
										'<br style="clear:both; display;" />' +
									'</div>');
									
					Event.observe('remove_link_' + id + '', 'click', function() { 
						removeLink('remove_link_' + id + '', id);
					});
					
					url.value = '';
					title.value = '';
					Sortable.create("link_list", {onUpdate: UpdateLinkOrder, handle: 'link_handle', tag: 'div'});
				  }
				});	
			});
			
			function removeLink(id, linkId)
			{	
				new Ajax.Request('<?= base_url(); ?>ajax/remove_link', {
				  method: 'post',
				  parameters: { link_id: linkId },
				  onSuccess: function(transport)
				  {
				    Effect.DropOut(('link_list_' + linkId));
					Sortable.create("link_list", {onUpdate: UpdateLinkOrder, handle: 'link_handle', tag: 'div'});
				  }
				});
			}
			
			<?php foreach( $linkMeta as $link ): ?>
				Event.observe('remove_link_<?= $link->id; ?>', 'click', function() { 
					removeLink('remove_link_<?= $link->id; ?>', <?= $link->id; ?>);
				});
			<?php endforeach;?>
			
			/* Event.observe('show_selector', 'click', function(){
				show_themes();
			}); */			
			
			/* Event.observe('hide_selector', 'click', function(){
				current_page = 0;
				$('hide_selector').hide();
				$('show_selector').show();
				$('loading').hide();
				Effect.BlindUp('theme_selector');
			}); */

			Event.observe(window, 'load', function(){
				show_themes();
			});
			
			function show_themes()
			{
				$('theme_frame').update('');
				$('loading').show();
				//$('show_selector').hide();
				//$('hide_selector').show();
				Effect.BlindDown('theme_selector');
				setTimeout( get_next, 1250 );
			}
			
			function get_next() 
			{ 
				current_page += 1;
				get_themes(current_page);			
			}
			
			function get_last() 
			{ 
				current_page -= 1;
				get_themes(current_page);			
			}
			
			function get_themes(page)
			{
				$('loading').show();
				
				new Ajax.Request('<?= base_url(); ?>ajax/get_theme_view', {
				  method: 'post',
				  parameters: { page: current_page },
				  onSuccess: function(transport)
				  {
					if( transport.responseText != '')
						$('theme_frame').update(transport.responseText);

					$('loading').hide();

					if( transport.responseText.indexOf("<!-- LP -->"	) != -1) 
						$('get_next').hide();
					else
						$('get_next').show();
					
					if( transport.responseText.indexOf("<!-- FP -->"	) != -1)
						$('get_last').hide();
					else
						$('get_last').show();
				  }
				});
				
			}
			
			Event.observe('get_next', 'click', get_next);
			Event.observe('get_last', 'click', get_last);
			
			current_page = 0;
		// -->
		</script>
		<!-- End Main Content -->
<?php include config_item('application_root') . 'views/author/includes/footer.php'; ?>