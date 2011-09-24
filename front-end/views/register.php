<?php include fe_view_path() . 'includes/header.php'; ?>
    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
        
      <div id="col-text2">
		<div id="loading" style="display:none;">
			<img src="<?= base_url() ?>public/common/img/ajax-loader.gif" />
		</div>
		<div id="signup_frame" style="display:none;">

		</div>

        </div> <!-- /col-text -->
    
    </div> <!-- /col -->
    <div id="col-bottom"></div>
    
    <hr class="noscreen" />
    
<script type="text/javascript">
	Event.observe(window, 'load', function(){
		register();
	});
	
	function register(post_info){
				$('signup_frame').hide();
				$('loading').show();
				
				new Ajax.Request('<?= base_url(); ?>ajax/register', {
				  method: 'post',
				  parameters: post_info,
				  onSuccess: function(transport)
				  {
					if( transport.responseText != '')
						$('signup_frame').update(transport.responseText);
					//Effect.BlindDown('signup_frame');
					
					$('signup_frame').show();
					$('loading').hide();
				  }
				});
	}
	
	function next_step()
	{
		post_data = Form.serialize('register_form', true);
		register( post_data );
	}
	
	function check_sitename()
	{
		site_name = $('site_name').value;
		
		$('site_name_gif').update('<img src="<?= base_url() ?>public/common/img/ajax-loader2.gif" />');
		$('site_name_gif').show();
		
		new Ajax.Request('<?= base_url(); ?>ajax/is_new_sitename_valid', {
		  method: 'post',
		  parameters: {'site_name' : site_name},
		  onSuccess: function(transport)
		  {
			$('site_name_gif').hide();
			
			if( transport.responseText == '-1' )
			{
				//Not valid
				$('site_name_gif').update('<img src="<?= base_url() ?>public/common/img/exclamation.png" />');
				$('site_name_status').update('This site name has invalid characters ');
			}
			else if( transport.responseText == '-2' )
			{
				$('site_name_gif').update('<img src="<?= base_url() ?>public/common/img/exclamation.png" />');
				$('site_name_status').update('This site name is already in use ');
			}
			else if( transport.responseText == '1' )
			{
				$('site_name_gif').update('<img src="<?= base_url() ?>public/common/img/checkmark2.png" />');
				$('site_name_status').update('This site name is available');
			}
			else
			{
				$('site_name_status').update('Fuck you: ' + transport.responseText );
			}
			
			$('site_name_gif').show();
		  }
		});		
		
	}

</script>
<script language="JavaScript">

Event.observe('body', 'keypress', function (event){
     var key;      
	 
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox      
    
	if( key == 13 ) Event.stop( event );
});

</script>

 <?php include fe_view_path() . 'includes/footer.php'; ?>