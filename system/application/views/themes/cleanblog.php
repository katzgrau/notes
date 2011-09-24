
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
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />


<!-- Favicon -->
<link rel="shortcut icon" href="" />

<!-- CSS -->
<link rel="stylesheet" href="<?= base_url() ?>public/themes/cleanblog/css/main.css" type="text/css" media="screen, projection" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />

	</head>
	<body>
		<div id="outer-wrapper">
			<div id="inner-wrapper">
				<div id="content-wrapper">

					<!-- Begin Content -->
					<div id="content">

					
	
						<!-- Main Navigation -->
						<ul id="nav">
		<?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'id="active"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a></li>
		<?php endforeach; ?>
						</ul>						
	
						<!-- Body Content -->
						<div id="content-inner">

							<div class="content-full">
							<?= get_left_skyscraper('left') ?>
							<?= get_right_skyscraper('right') ?>
							<?= get_top_banner() ?>
							<?= get_square_2('right') ?>
							<h2><?= $pageContent->page_title ?></h2>
								<p class="intro"><?= $pageContent->content ?></p>
							<?= get_bottom_banner() ?>
							</div>
							
						</div>
						
					</div>
	
					<!-- Begin Left Column -->
					<div id="sidebar">
						<div id="logo">
							<?= $site->display_name ?>
						</div>
<?php if( sizeof( $files ) > 0 ): ?>				
						<h4>Attachments</h4>
						<ul class="side-nav">
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
						</ul>
<?php endif; ?>

<?php if( sizeof( $links ) > 0 ): ?>
						<h4>Links</h4>
						<ul class="side-nav">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
						</ul>
				<?php endif; ?>
<?= get_square_2() ?>
							<h4>Login</h4>						
            <form action="<?= base_url() ?>home/login" method="post">
			
				<div align="center" style="margin-bottom: 12px;">
				<input name="site_name" value="" /></div>
				
				<div align="center" style="margin-bottom: 12px;">
				<input name="password" type="password" value="" /></div>
				
				<div align="right" style="margin-right: 12px;">
				<input class="button" type="submit" value="login" /></div>
			
            </form>  						
					</div>

				</div><!-- End Content-Wrapper -->

				<!-- Begin Footer -->
				<div id="footer">
<p class="copyright">					
					&copy; 2009 <?= $this->config->item('company_name'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></p>
					
			  </div>
				
			</div>
		</div>

<div align="center" style="font: 10px Arial, Sans-serif; margin-top:9px;">Last Update: <?= $site->modified ?></div>
	</body>
</html>