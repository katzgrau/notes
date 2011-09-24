
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
		
<?php #print_r( $sitePageMeta ); ?>
<?php #print_r( $pageContent ); ?>
<?php #print_r( $site ); exit;?>
<?php #print_r( $links ); exit;?>

<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>

<!-- Meta Tags -->
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />


<!-- Favicon -->
<link rel="shortcut icon" href="" />

<!-- CSS -->
<link rel="stylesheet" href="<?= base_url() ?>public/themes/terrafirma/default.css" type="text/css" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />

</head>
<body>

<div id="outer">

	<div id="upbg"></div>

	<div id="inner">

		<div id="header">
			<h1><span><?= $site->display_name ?></span></h1>
			<h2><?= $user->email ?></h2>
			
		</div>
	
		<div id="splash"></div>
	
		<div id="menu">
			<ul>
			<?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'class="first"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a></li>
			<?php endforeach; ?>
			</ul>
		
		<div id="date">Last Update: <?= $site->modified ?></div>
		</div>
	

		<div id="primarycontent">
		
			<!-- primary content start -->
		
			<div class="post">
				<div class="header">
					<h3><?= $pageContent->page_title ?></h3>
				</div>
				<div class="content">
					<?= get_top_banner() ?>
					<?= get_left_skyscraper('left') ?>
					<?= get_right_skyscraper('right') ?>
					<?= get_square_1('right') ?>
					<?= $pageContent->content ?>
					<?= get_bottom_banner() ?>
				</div>			
				
			</div>

			<!-- primary content end -->
	
		</div>
		
		<div id="secondarycontent">

			<!-- secondary content start -->
	<?php if( sizeof( $files ) > 0 ): ?>				
						<h3>Attachments</h3>
						<div class="content">
				<ul class="linklist">
                <?php foreach( $files as $file ): ?>
					<li class="first"><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
						</ul></div>
<?php endif; ?>		
	
	<?php if( sizeof( $links ) > 0 ): ?>
						<h3>Links</h3>
				<div class="content">
				<ul class="linklist">
                <?php foreach( $links as $link ): ?>
					<li class="first"><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
						</ul></div>
				<?php endif; ?>
			<?= get_square_2() ?>
			<h3>Login</h3>	
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse;" border="0"><tr><td>
                <input name="site_name" value="" /><input name="password" type="password" value="" /></td><td valign="middle">
				<input class="button" type="submit" value="login"/></td></tr></table>
            </form>  <br /><br />

			<!-- secondary content end -->

		</div>
	
		<div id="footer">
		
					<p style="float: left; margin-left: 20px;">
&copy; 2009 <?= $this->config->item('company_name'); ?></p>
	<p style="float: right; margin-right: 20px;">
					<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
   	</p>
		
		</div>

	</div>

</div>

</body>
</html>