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

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/summerbreeze/default.css" media="screen"/>
<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
</head>
<body>

<div class="header">
	<h1><?= $site->display_name ?></h1>
</div>

<div class="navigation">
		<?php $count = 0; ?>
		<?php foreach( $sitePageMeta as $page ): ?>
            <?php $count++; ?>
			<a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
		<?php endforeach; ?>
		<?php for( $i = ($count == 5 ? 5 : ($count % 5)); $i < 5; $i++ ): ?>
			<a href="#">&nbsp;</a>
		<?php endfor; ?>
	<div class="clearer"><span></span></div>
</div>

<div class="container">
	<div class="content">
		<?= get_top_banner() ?>
		<h1><?= $pageContent->page_title ?></h1>
	
				<?php if( sizeof( $files ) > 0 ): ?>
				<div class="links">
					<span>Attachments</span> 
					<?php foreach( $files as $file): ?>
						<a class="linked" href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a>
					<?php endforeach; ?>
					<div style="clear:both;"></div>
				</div>
				<?php endif; ?>
				
			<?php if( sizeof( $links ) > 0 ): ?>	
			<div class="links">
				<span>Links</span> 
				<?php foreach( $links as $link ): ?>
					<a class="linked" href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a>
				<?php endforeach; ?>
				<div style="clear:both;"></div>
			</div>
			<p />
			<?php endif; ?>
		<?= get_left_skyscraper('left') ?>
		<?= get_right_skyscraper('right') ?>
		<?= get_square_1('right') ?>
		<?= get_square_2('right') ?>
		<?= $pageContent->content ?>
		<?= get_bottom_banner() ?>
	</div>

	<div class="footer">
		&copy; 2009 <?= $this->config->item('company_name'); ?> | <a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
	</div>

</div>

</body>
</html>