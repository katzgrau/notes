
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
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />


<!-- Favicon -->
<link rel="shortcut icon" href="" />

<!-- CSS -->
<link rel="stylesheet" href="<?= base_url() ?>public/themes/naturalessence/style.css" type="text/css" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />

</head>

<body>

<div id="wrapper">
<div id="container">

<div class="title">
	
	<h1><a href="#"><?= $site->display_name ?></a></h1>

</div>

<div class="header"></div>

<div class="navigation">
	
	
				<?php foreach( $sitePageMeta as $page ): ?>
			<a <?php if($page->page_title == $pageContent->page_title) echo 'id="active"'; ?> href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a>
			<?php endforeach; ?>

	<div class="clearer"></div>

</div>

<div class="main" id="two-columns">

	<div class="col2">

		<div class="left">

			<div class="content">
				<?= get_top_banner() ?>
				<h1><?= $pageContent->page_title ?></h1>
				<?= get_left_skyscraper('left') ?>
				<?= get_right_skyscraper('right') ?>
				<?= get_square_1('right') ?>
				<?= $pageContent->content ?>
				<?= get_bottom_banner() ?>
			</div>
	
		</div>

		<div class="right">
			
			<div class="content">
			<?= get_square_2() ?>
			<?php if( sizeof( $files ) > 0 ): ?>				
						<h2>Attachments</h2>
						<ul class="block">
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
						</ul>
			<?php endif; ?>	
			
			<?php if( sizeof( $links ) > 0 ): ?>
						<h2>Links</h2>
						<ul class="block">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
						</ul>
				<?php endif; ?>

			
			<h2>Login</h2>	
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse;" border="0"><tr><td>
                <input name="site_name" value="" /><input name="password" type="password" value="" /></td><td valign="middle">
				<input class="button" type="submit" value="login"/></td></tr></table>
            </form>  
	
			</div>

		</div>

		<div class="clearer"></div>

	</div>


	<div class="bottom">

		<div align="left" style="font: 10px Arial, Sans-serif; margin-top:0px;">Last Update: <?= $site->modified ?></div>

		<div class="clearer"></div>

	</div>


	<div class="footer">
		
		<div class="left">
			&copy; 2009 <?= $this->config->item('company_name'); ?>
		</div>

		<div class="right">
			<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
		</div>

		<div class="clearer"></div>

	</div>		

</div>

</div>
</div>

</body>
</html>