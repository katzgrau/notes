<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

  <title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>

  <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />


  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/nautica05/css/layout.css" media="screen, projection, tv " />
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/nautica05/css/html.css" media="screen, projection, tv " />

  <!-- CSS specific to current theme -->
  <link rel="stylesheet"           type="text/css" href="<?= base_url() ?>public/themes/nautica05/css/light.css" title="light" media="screen, projection, tv " />
  <link rel="alternate stylesheet" type="text/css" href="<?= base_url() ?>public/themes/nautica05/css/dark.css"  title="dark"  media="screen, projection, tv " />

</head>

<body>

<!-- #content: holds all except site footer - causes footer to stick to bottom -->
<div id="content">

  <!-- #header: holds the logo and top links -->
  <div id="header" class="width">

     <span class="heading"><?= $site->display_name ?></span>



  </div>
  <!-- #header end -->


  <!-- #headerImg: holds the main header image or flash -->
  <div id="headerImg" class="width"></div>



  <!-- #menu: the main large box site menu -->
  <div id="menu" class="width">

    <ul>
      <li>    		
		<?php foreach( $sitePageMeta as $page ): ?>
          <li>
            <a style="width:<?= 100 / sizeof( $sitePageMeta ) ?>%;" onfocus="blur()" href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				 <span class="title "><?= $page->page_title ?></span>
				 <span class="desc">&nbsp;</span>
			</a>
          </li>
		<?php endforeach; ?>  
    </ul>

  </div>
  <!-- #menu end -->



  <!-- #page: holds the page content -->
  <div id="page">


    <!-- #columns: holds the columns of the page -->
    <div id="columns" class="widthPad">


    <!-- Left column -->
    <div class="floatLeft width73">
	  <?= get_top_banner() ?>
	  <?= get_left_skyscraper('left') ?>
      <?= get_right_skyscraper('right') ?>
      <?= get_square_1('right') ?>
	  <h1><?= $pageContent->page_title ?></h1>
	  <?= $pageContent->content ?>
	  <?= get_bottom_banner() ?>

    </div>
    <!-- Left column end -->


    <!-- Right link column -->
    <div class="floatRight width25 lightBlueBg horzPad"> 
	<?= get_square_2() ?>
	<?php if( sizeof( $files ) > 0 ): ?>
	  <h2>Attachments</h2>
		<ul class="submenu1">
			<?php foreach( $files as $file ): ?>
				<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	
	<?php if( sizeof( $links ) > 0 ): ?>
	  <h2>Links</h2>
		<ul class="submenu1">
			<?php foreach( $links as $link ): ?>
				<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>


	<h2 style="margin-bottom:0;">Author Login</h2>
	<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse; width:100%;" border="0">
					<tr>
						<td>
							<p>
							Site Name: <br/><input name="site_name" style="width:100%;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" /></p>
							
							<p>
							Password: <br /><input id="password" name="password"  style="width:100%;" type="password" value=""/></p>
							<p> <input class="button" type="submit" value="Login" style="width:165px; float:right;" /> </p>
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
            </form>

    </div>
    <!-- Right links column end -->



    </div>
    <!-- #columns end -->

  </div>
  <!-- #page end -->

</div>
<!-- #content end -->




<!-- #footer: holds the site footer (logo and links) -->
<div id="footer">

  <!-- #bg: applies the site width and footer background -->
  <div id="bg" class="width">
	<p>
		&copy; 2009 <?= $this->config->item('company_name'); ?> | Design By <a href="http://www.infscripts.com/">Inf Design</a>, <a href="http://www.studio7designs.com" class="last">studio7designs.com</a>
		  | <a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
		  
	</p>
  </div>
  <!-- #bg end -->

</div>
<!-- #footer end -->

</body>

</html>