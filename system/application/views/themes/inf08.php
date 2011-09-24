<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/inf08/style.css" />
</head>

<body>

<div id="container">

	<!-- ###  Header  ### -->
	
	<div id="header">	
	
		<h1><a href="#"><?= $site->display_name ?></a></h1>

		<!-- ### Top menu ### -->
		
		<div id="topmenu">
		<ul>
		<?php foreach( $sitePageMeta as $page ): ?>
          <li <?php if($page->page_title == $pageContent->page_title) echo 'class="active"'; ?>>
            <a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<span><?= $page->page_title ?></span>
			</a>
          </li>
		<?php endforeach; ?>  
		</ul>	
		</div>

	</div>
	<div id="contentcontainer">

		<div id="content">
		
		<!-- ### Post Entry Begin ###  -->

		<div class="post">
		<?= get_top_banner() ?>
		<h2><a href="#"><?= $pageContent->page_title ?></a></h2>

		<div class="entry">
			<?= get_left_skyscraper('left') ?>
			<?= get_right_skyscraper('right') ?>
			<?= get_square_1('right') ?>
			<?= $pageContent->content ?>
			<?= get_bottom_banner() ?>
		</div>

		</div>

		<!-- ### Post Entry End ### -->

		</div>
		
		<!-- ### Sidebar ### -->

		<div id="sidebar">
		<?= get_square_2() ?>
		<?php if( sizeof( $files ) > 0 ): ?>
		<ul>
			<li><h2>Attachments</h2>
			<ul>
					<?php foreach( $files as $file ): ?>
						<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
					<?php endforeach; ?>
			</ul>
			</li>
		</ul>
		<?php endif; ?>		
		
		<?php if( sizeof( $links ) > 0 ): ?>
		<ul>
			<li><h2>Links</h2>
			<ul>
					<?php foreach( $links as $link ): ?>
						<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
					<?php endforeach; ?>
			</ul>
			</li>
		</ul>
		<?php endif; ?>
		

		<p />
<div class="about">
		<h2>Author Login</h2>
		<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse; width:100%;" border="0">
					<tr>
						<td>
							<p>
							Site Name: <br/><input name="site_name" style="width:100%;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" /></p>
							
							<p>Password: <br /><input id="password" name="password"  style="width:100%;" type="password" value=""/></p>
							<input class="button" type="submit" value="login" style="width:165px; float:right;" />
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
            </form>
		</div>

		</div>
		
		<!-- ### Sidebar End ### -->

	</div>
	

	<div id="contentb">
			<div style="float:left;">&copy; 2009 <?= $this->config->item('company_name'); ?> | Design By <a href="http://www.infscripts.com/">Inf Design</a></div>
			<div style="float:right;"><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></div>
			<div style="clear:both;"></div>
	</div>
</div>
	
</body>
</html>