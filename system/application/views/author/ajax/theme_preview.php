<?php $this->load->helper('url'); ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/author/css/style.css" />
	<style type="text/css">

.black_overlay{
    display: none;
    position: absolute;
    top: 20px;
    left: 0%;
    width: 100%;
    height: 570px;
    background-color: black;
    z-index:1001;
    -moz-opacity: 0.0;
    opacity:.00;
    filter: alpha(opacity=00);
}


	</style>
	</head>
	<body style="background-color: #647678;" onload="document.getElementById('overlay').style.display='block';">
	<div style="margin-left: auto; margin-right: auto; background-color: #647678;">
		<div style="color:#ffffff;">
			<div id="overlay" class="black_overlay"></div>
			<div>
				<div style="float:right; text-decoration:underline; font-size:20px; padding-right: 5px;"><a href="#" onclick="(top.window.location = '<?= base_url() ?>author/settings/set_theme/<?= $theme->id ?>');">Activate this theme</a></div>
				<div class="clear"></div>
			</div>	
		</div>
		<iframe frameborder="0" scrolling="no" src ="<?= base_url() ?>?c=view&m=preview_theme&site_name=<?= $site_name ?>&theme_name=<?= $theme->theme_name ?>" style="width:990px; height: 570px;>
			<p>Your browser does not support iframes.</p>
		</iframe>

		<!-- <img src="<?= base_url() ?>public/themes/<?= $theme->theme_name ?>/screenshot.png" /> -->

	</div>

	<script type="text/javascript">
		function relocateParent(url)
		{
			top.window.location = url;
		}
	</script>
	</body>
</html>