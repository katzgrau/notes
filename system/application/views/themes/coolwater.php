
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
<link rel="stylesheet" href="<?= base_url() ?>public/themes/coolwater/images/CoolWater.css" type="text/css" media="screen, projection" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />
	
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="#"><?= $site->display_name ?></a></h1>	
			
		<div id="header-links">
			<p>
			Contact Me: <?= $user->email ?>
			</p>		
		</div>		
						
	</div>
		
	<!-- navigation -->	
	<div  id="menu">
		<ul>
		<?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'id="active"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>					
			
	<!-- content-wrap starts here -->
	<div id="content-wrap">
		
		<div id="main">				
				
			<a name="TemplateInfo"></a>
			<?= get_top_banner() ?>
			<?= get_left_skyscraper('left') ?>
			<?= get_right_skyscraper('right') ?>
			<h2><?= $pageContent->page_title ?></h2>
			<?= get_square_1('right') ?>
			<?= $pageContent->content ?>
			<?= get_bottom_banner() ?>
		</div>
		
			
		<div id="sidebar">
<?php if( sizeof( $links ) > 0 ): ?>
						<h3>Links</h3>
						<ul class="sidemenu">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
						</ul>
				<?php endif; ?>
<?php if( sizeof( $files ) > 0 ): ?>				
						<h3>Files</h3>
						<ul class="sidemenu">
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
						</ul>
<?php endif; ?>		
<?= get_square_2() ?>
					<h3>Login</h3>
<ul class="sidemenu"></ul>							
            <form action="<?= base_url() ?>home/login" method="post">
			
				<div align="center" style="margin-bottom: 12px;">
				<input name="site_name" value="" /></div>
				
				<div align="center" style="margin-bottom: 12px;">
				<input name="password" type="password" value="" /></div>
				
				<div align="right" style="margin-right: 12px;">
				<input class="button" type="submit" value="login" /></div>
			
            </form>  
		</div>
				
	<!-- content-wrap ends here -->	
	</div>
					
	<!--footer starts here-->
	<div id="footer">
			
		<p style="float: left; margin-left: 20px;">
&copy; 2009 <?= $this->config->item('company_name'); ?></p>

	<p style="float: right; margin-right: 20px;">
					<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
   	</p>
				
	</div>	

<!-- wrap ends here -->
</div>


<div align="center" style="font: 10px Arial, Sans-serif; margin-top:9px;">Last Update: <?= $site->modified ?></div>
</body>
</html>
