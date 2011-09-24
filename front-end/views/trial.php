<?php include fe_view_path() . 'includes/header.php'; ?>

    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
        
      <div id="col-text2">
		<div style="float:left; width: 580px;">
			<h1>Try it for 30 days &minus; Absolutely free</h1>
			<p>
				Are you ready to give <Site Name> a try? Alright! The next step to use the <strong>coupon code below</strong>, "try4free".
				Copy that code, then head over to <a href="<?= base_url() ?>home/register">the sign-up page</a>, and paste it in where it says "Coupon." 
				Fill out the rest of the information, and you're all set!
			</p>
			<div style="text-align: center; font-weight:bold; font-size:40px; color:#0891C1; margin: 50px; border: 2px dashed #0891C1; background-color: #ffffff;">
				try4free
			</div>
			
			<p>If you have any trouble logging in, send us a message at 
				<a href="mailto:customer.service@<Site Name>">customer.service@<Site Name></a>, 
				and we'll help get you started.
			</p>
		</div>
		<div style="float:right;"> 
			<div style="padding: 10px; background-color: #ffffff; border: 1px solid #808080;">
				<div style="width:287px; height: 418px; border: 1px solid #cccccc;">
					<img src="<?= fe_resource_base() ?>tmp/try-it-woman.jpg" />
				</div>
			</div>
		</div>
      </div> <!-- /col-text -->
    
    </div> <!-- /col -->
    <div id="col-bottom"></div>
    
    <hr class="noscreen" />
    
<?php include fe_view_path() . 'includes/footer.php'; ?>