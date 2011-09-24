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

<link href="<?= base_url() ?>public/themes/metamorphhills/styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="menu">
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
<div id="content">
<!-- header begins -->
<div id="header">    
	<div id="logo">
		<h1><a href="#"><?= $site->display_name ?></a></h1>
		<h2><a href="#"><?= $pageContent->page_title ?></a></h2>
	</div>
  
</div>

<!-- header ends -->
<!-- content begins -->
 <div id="main">
	<div id="right">
		<h2><?= $pageContent->page_title ?></h2><br />
			<?= get_top_banner() ?>
			<?= get_left_skyscraper('left') ?>
			<?= get_left_skyscraper('right') ?>
			<?= get_square_1('right') ?>
			<?= $pageContent->content ?>
			<?= get_bottom_banner() ?>
	</div>
	<div id="left">		
			<?php if( sizeof( $files ) > 0 ): ?>
			<h3>Attachments</h3>
			<ul>
			  <li><ul>
					<?php foreach( $files as $file ): ?>
						<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
					<?php endforeach; ?>			  
				  </ul>
			  </li>
			</ul>
			<?php endif; ?>
			<?php if( sizeof( $links ) > 0 ): ?>
			<h3>Links</h3>
			<ul>
			  <li><ul>
				<?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
				<?php endforeach; ?>		  
				  </ul>
			  </li>
			</ul>
			<?php endif; ?>
			<?= get_square_2() ?>
		  <h3>Author Login</h3>
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse; width:100%;" border="0">
					<tr>
						<td>
							<p>
							Site Name: <br/><input name="site_name" style="width:100%;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" /><br />
							
							Password: <br /><input id="password" name="password"  style="width:100%;" type="password" value=""/></p>
							<input class="button" type="submit" value="Login" style="width:100px; float:right;" />
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
            </form>
			<br />
	</div>
<!--content ends -->
<!--footer begins -->
	</div>

<div id="footer">
<p>&copy; 2009 <?= $this->config->item('company_name'); ?> | <a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></p> 
	<p>Design by <a href="http://www.metamorphozis.com/" title="Flash Templates">Flash Templates</a>
		</p>
	</div>
</div>
<!-- footer ends-->
</body>
</html>