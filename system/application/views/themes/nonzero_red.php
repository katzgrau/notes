<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	Nonzero1.0 by nodethirtythree design
	http://www.nodethirtythree.com
	missing in a maze

-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/nonzero_red/style.css" />
</head>
<body>

<div id="header">

	<div id="header_inner" class="fixed">

		<div id="logo">
			<h1><span><?= $site->display_name ?></h1>
			<h2><?= $pageContent->page_title ?></h2>
		</div>
		
		<div id="menu">
			<ul>
		<?php foreach( $sitePageMeta as $page ): ?>
          <li >
            <a <?php if($page->page_title == $pageContent->page_title) echo 'class="active"'; ?> href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
          </li>
		<?php endforeach; ?>  
			</ul>
		</div>
		
	</div>
</div>

<div id="main">

	<div id="main_inner" class="fixed">

		<div id="primaryContent_2columns">

			<div id="columnA_2columns">
				<h3><?= $pageContent->page_title ?></h3>
					<?= get_top_banner() ?>
				<?= get_left_skyscraper('left') ?>
				<?= get_right_skyscraper('right') ?>
				<?= get_square_1('right') ?>
				<?= $pageContent->content ?>
				<?= get_bottom_banner() ?>
		
			</div>
	
		</div>
		
		<div id="secondaryContent_2columns">
			<div id="columnC_2columns">
			<?= get_square_2('right') ?>
			<?php if( sizeof( $files ) > 0 ): ?>
			  <h4><span>Attachments</span></h4>
				<ul class="links">
					<?php foreach( $files as $file ): ?>
						<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>		
			
			<?php if( sizeof( $links ) > 0 ): ?>
			  <h4><span>Links</span></h4>
				<ul class="links">
					<?php foreach( $links as $link ): ?>
						<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
	
	<h4><span>Author Login</span></h4>
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse; width:100%;" border="0">
					<tr>
						<td>

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

		<br class="clear" />

	</div>

</div>

<div id="footer" class="fixed">
		<div style="float:left;">&copy; 2009 <?= $this->config->item('company_name'); ?> | Design By <a href="http://www.nodethirtythree.com/">NodeThirtyThree Design</a></div>
		<div style="float:right;"><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></div>
		<div style="clear:both;"></div>
</div>

</body>
</html>