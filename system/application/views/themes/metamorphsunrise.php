<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

<link href="<?= base_url() ?>public/themes/metamorphsunrise/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="menu">
		<ul>
		<?php foreach( $sitePageMeta as $page ): ?>
          <li <?php if($page->page_title == $pageContent->page_title) echo 'class="current_page_item"'; ?>>
            <a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
          </li>
		<?php endforeach; ?>  
		</ul>
	</div>	
</div>
<div id="logo">
	<h1><a href="#"><?= $site->display_name ?></a></h1>
	<h2><a href="#" id="metamorph"><?= $pageContent->page_title ?></a></h2>
	</div>
<!-- end header -->
<hr />
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<?= get_top_banner() ?>
			<h1 class="title"><a href="#"><?= $pageContent->page_title ?></a></h1>
		  <div class="entry">
			<?= get_left_skyscraper('left') ?>
			<?= get_right_skyscraper('right') ?>
			<?= get_square_1('right') ?>
			<?= $pageContent->content ?>	
			<?= get_bottom_banner() ?>
		  </div>
			</div>
	</div>
	<!-- end content -->
	<!-- start sidebar two -->
	<div id="sidebar2" class="sidebar">
		<ul>
			<li>
				<?php if( sizeof( $files ) > 0 ): ?>
				<h2>Attachments</h2>
				<ul>
					<?php foreach( $files as $file ): ?>
						<li><a class="linked" href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</li>
			<li>
				<?php if( sizeof( $links ) > 0 ): ?>
				<h2>Links</h2>
				<ul>
					<?php foreach( $links as $link ): ?>
						<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</li>
			<li>
				<?= get_square_2() ?>
			</li>
			<li>
				<h2 style="padding-bottom:0; margin-bottom:0;">Author&nbsp;&nbsp;Login</h2>
				<form action="<?= base_url() ?>home/login" method="post" style="padding:0; padding-left: 15px;">
				<table style="border-collapse:collapse;" border="0">
					<tr>
						<td>
							Site Name: <br/><input name="site_name" style="width:165px;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" />
							<br/>
							Password: <br /><input id="password" name="password"  style="width:165px;" type="password" value=""/><br/>
							<input class="button" type="submit" value="Login" style="width:120px;; float:right;" />
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
            </form>
			</li>
		</ul>
	</div>
	<!-- end sidebar two -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<hr />
<!-- start footer -->
<div id="footer">
	<p>
		&copy; 2009 <?= $this->config->item('company_name'); ?> | Design by <a href="http://www.metamorphozis.com/" title="Free Flash Templates">Free Flash Templates</a> | <a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
	</p>
</div>
<!-- end footer -->
</body>
</html>
