
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
		
<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>

<!-- Meta Tags -->
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<meta name="robots"      content="index, follow" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />


<!-- Favicon -->
<link rel="shortcut icon" href="" />

<!-- CSS -->
<link rel="stylesheet" href="<?= base_url() ?>public/themes/nautica/style.css" type="text/css" media="screen, projection" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />
</head>

<body>

<div id="menu-top">
	<ul>
		<?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'id="active"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><span><?= $page->page_title ?></span></a></li>
		<?php endforeach; ?>
	</ul>
</div><!--menu-top-->

<div id="wrapper-header">
<div id="header">
<div id="wrapper-header2">
<div id="wrapper-header3">
	<h1><?= $site->display_name ?></h1>
</div><!--wrapper-header3-->
</div><!--wrapper-header2-->
</div><!--header-->
</div><!--wrapper-header-->

<div id="wrapper-content">
	<div id="wrapper-menu-page">
	<div id="menu-page">
<?php if( sizeof( $files ) > 0 ): ?>

                <h3>Attachments</h4>

                
			<!-- 
            This part was designed to handle images
            -->

            <ul class="links" id="subnav">
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
            </ul>

<?php endif; ?>
			
			
	<?php if( sizeof( $links ) > 0 ): ?>
                <h3>Links</h4>
                
			<!-- 
            This part was designed to handle images
            -->
            <ul class="links" id="subnav">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
            </ul>
			

				<?php endif; ?>
				

		
				<h3>Login</h3>						
            <form action="<?= base_url() ?>home/login" method="post">
			
				<div align="center" style="margin-bottom: 12px;">
				<input name="site_name" value="" /></div>
				
				<div align="center" style="margin-bottom: 12px;">
				<input name="password" type="password" value="" /></div>
				
				<div align="right" style="margin-right: 12px;">
				<input class="button" type="submit" value="login" /></div>
			
            </form>  
				<?= get_square_2() ?>
	</div><!--menu-page-->
	</div><!--wrapper-menu-page-->
	
	<div id="content">
		<?= get_top_banner() ?>
		<h2><?= $pageContent->page_title ?></h2>
		 <?= get_left_skyscraper('left') ?>
		 <?= get_right_skyscraper('right') ?>
		 <?= get_square_2('right') ?>
		 <?= $pageContent->content ?>
		<?= get_bottom_banner() ?>
  </div><!--content-->
</div><!--wrapper-content-->

<div id="wrapper-footer">
	<div id="footer">
	&copy; 2009 <?= $this->config->item('company_name'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
	</div>
</div><!--wrapper-footer-->


<div align="center" style="font: 10px Arial, Sans-serif; margin-top:9px;">Last Update: <?= $site->modified ?></div>
</body>
</html>
