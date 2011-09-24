<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/hobbit/default.css" media="screen"/>
<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
</head>

<body>

<div class="container">

	<div class="gfx"><span></span></div>

	<div class="top">

		<div class="navigation">
		<?php foreach( $sitePageMeta as $page ): ?>
            <a <?php if($page->page_title == $pageContent->page_title) echo 'id="selected"'; ?> href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
		<?php endforeach; ?> 
		</div>

		<div class="pattern"><span></span></div>

		<div class="header">
			<h1><?= $site->display_name ?></h1>
			
		</div>

		<div class="pattern"><span></span></div>

	</div>

	<div class="content">

		<div class="spacer"></div>

		<div class="item">
			<?= get_top_banner() ?>
			<div class="links">
				<span>Links</span> 
				<?php foreach( $links as $link ): ?>
					<a class="linked" href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a>
				<?php endforeach; ?>
				<div style="clear:both;"></div>
			</div>
			<div class="title"><?= $pageContent->page_title ?></div>
			<!-- <div class="metadata">Jun 13, 2006 by Vulputate</div> -->
			
			<div class="body">
				<div class="divider"><span></span></div>
				
				<div class="links">
					<span>Attachments</span> 
					<?php foreach( $files as $file): ?>
						<a class="linked" href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a>
					<?php endforeach; ?>
					<div style="clear:both;"></div>
				</div>
				
				<?= get_left_skyscraper('left') ?>
				<?= get_left_skyscraper('right') ?>
				<?php if( config_item('ads_enabled') ): ?>
				<div style="float:right;">
					<?= get_square_1(); ?>
					<?= get_square_2(); ?>
				</div>
				<?php endif; ?>
				<?= $pageContent->content ?>
				<div style="clear:both;"></div>
				<div class="divider"><span></span></div>
				<?= get_bottom_banner() ?>

			</div>

		</div>

	</div>
	<div id="end_body"></div>
	<div class="footer">
			&copy; 2009 <?= $this->config->item('company_name'); ?> | Design by <a href="http://arcsin.se">Arcsin</a> | 
			<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
	</div>

</div>

</body>

</html>