<?php include fe_view_path() . 'includes/header.php'; ?>

    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
        
      <div id="col-text2">
		<div id="loading" style="display:none;">
			<img src="<?= base_url() ?>public/common/img/ajax-loader.gif" />
		</div>
		<div id="renew_frame" style="display:none;">

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
				$('renew_frame').hide();
				$('loading').show();
				
				new Ajax.Request('<?= base_url(); ?>ajax/renew', {
				  method: 'post',
				  parameters: post_info,
				  onSuccess: function(transport)
				  {
					if( transport.responseText != '')
						$('renew_frame').update(transport.responseText);
					//Effect.BlindDown('renew_frame');
					
					$('renew_frame').show();
					$('loading').hide();
				  }
				});
	}
	
	function next_step()
	{
		post_data = Form.serialize('renew_form', true);
		register( post_data );
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