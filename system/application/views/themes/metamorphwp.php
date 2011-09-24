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

<link href="<?= base_url() ?>public/themes/metamorphwp/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main">
<!-- start header -->
<div id="header">
 <div id="logo">
	<h1><a href="#"><?= $site->display_name ?></a></h1>
	<h2><a href="#" id="metamorph"><?= $pageContent->page_title ?></a></h2>
  </div>
	<div id="menu">
		<ul>
		<?php foreach( $sitePageMeta as $page ): ?>
          <li <?php if($page->page_title == $pageContent->page_title) echo 'class="active"'; ?>>
            <a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
          </li>
		<?php endforeach; ?>  
		</ul>
	</div>	
<!-- end header -->
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="back">
		 <div class="top">
			<div class="bottom">
			<h2><?= $pageContent->page_title ?></h2>
			<?= get_top_banner() ?>
			<?= get_left_skyscraper('left') ?>
			<?= get_right_skyscraper('right') ?>
			<?= get_square_1('right') ?>
				<?= $pageContent->content ?>
			<?= get_bottom_banner() ?>
				<div style="clear:both;"></div>
			</div>
			</div>
			</div>
			<div><img src="images/spacer.gif" width="1" height="20px" alt="" /></div>
	  </div>

	<!-- end content -->
	<!-- start sidebar two -->
	<div id="sidebar2" class="sidebar">
			<?php if( sizeof( $files ) > 0 ): ?>
		    <div class="r1">
				<h2>Attachments</h2>
				<ul>
					<?php foreach( $files as $file): ?>
						<li><a class="linked" href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
					<?php endforeach; ?>
				</ul>
		      </div>
			  <?php endif; ?>
			  <div><img src="images/spacer.gif" width="1" height="20px" alt="" /></div>
			  <?php if( sizeof( $links ) > 0 ): ?>
			  <div class="r1">
				<h2>Links</h2>
				<ul>
					<?php foreach( $links as $link ): ?>
						<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
					<?php endforeach; ?>
				</ul>
		      </div>
			  <?php endif; ?>
			  <div><img src="images/spacer.gif" width="1" height="20px" alt="" /></div>
			  <?= get_square_2() ?>
			  <div class="r1">
				<h2>Author Login</h2>
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse; width:100%;" border="0">
					<tr>
						<td>
						<p/>
							Site Name: <br/><input name="site_name" style="width:100%;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" />
							
							Password: <br /><input id="password" name="password"  style="width:100%;" type="password" value=""/><p/>
							<p> <input class="button" type="submit" value="Login" style="width:165px; float:right;" /> </p>
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
            </form>
		      </div>
	</div>
	<!-- end sidebar two -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<!-- start footer -->
<div id="footer">

	 <p>&copy; 2009 <?= $this->config->item('company_name'); ?> | <a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a> | Design by <a href="http://www.metamorphozis.com/" title="Flash Templates">Flash Templates</a></p>
</div><!-- end footer -->
</div></body>
</html>
