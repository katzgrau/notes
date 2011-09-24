
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
<link rel="stylesheet" href="<?= base_url() ?>public/themes/pluralism/style.css" type="text/css" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />

</head>
<body>
<div id="wrapper">
	<div id="wrapper2">
		<div id="header">
			<div id="logo">
				<h1><?= $site->display_name ?></h1>
			</div>
			<div id="menu">
				<ul>
			<?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'id="current"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a></li>
			<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<!-- end #header -->
		<div id="page">
			<div id="content">
				<div class="post">
					<h2 class="title"><a href="#"><?= $pageContent->page_title ?></a></h2>
					<?= get_top_banner() ?>
					<?= get_left_skyscraper('left') ?>
					<?= get_right_skyscraper('right') ?>
					<?= get_square_1('right') ?>
						<div class="entry"> <?= $pageContent->content ?>
					<?= get_bottom_banner() ?>
					</div>
				</div>
			</div>
			<!-- end #content -->
			<div id="sidebar">
				<ul>
<?php if( sizeof( $files ) > 0 ): ?>
<li>				
						<h3>Attachments</h3>
						<ul class="sidemenu">
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
						</ul></li>
<?php endif; ?>			
			
								<?php if( sizeof( $links ) > 0 ): ?>
								<li>
						<h3>Links</h3>
						<ul class="sidemenu">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
						</ul></li>
				<?php endif; ?>

					<li id="search">			
						
						
									<h3>Login</h3>	
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse;" border="0"><tr><td>
                <input name="site_name" value="" /><input name="password" type="password" value="" /></td><td valign="middle">
				<input class="button" type="submit" value="login"/></td></tr></table>
            </form>  

					</li>
					<li>
						<?= get_square_2() ?>
					</li>
				</ul>
			</div>
			<!-- end #sidebar -->
			<div style="clear: both;">&nbsp;</div>
			<div id="widebar">
				<p style="float: left; margin-left: 5px;">
&copy; 2009 <?= $this->config->item('company_name'); ?></p>
	<p style="float: right; margin-right: 5px;">
					<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
   	</p>
				<div style="clear: both;">&nbsp;</div>
			</div>
			
			<!-- end #widebar -->
		</div>
		<!-- end #page -->
	</div>
	<!-- end #wrapper2 -->
	<div id="footer"><br>
<div align="center" style="font: 10px Arial, Sans-serif; margin-top:9px;">Last Update: <?= $site->modified ?></div>
	</div>
</div>
<!-- end #wrapper -->


</body>
</html>
