<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Created by: Reality Software | www.realitysoftware.ca
Released by: Flash MP3 Player | www.flashmp3player.org
Note: This is a free template released under the Creative Commons Attribution 3.0 license, 
which means you can use it in any way you want provided you keep links to authors intact.
Don't want our links in template? You can pay a link removal fee: www.realitysoftware.ca/templates/
You can also purchase a PSD-file for this template.
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
<link href="<?= base_url() ?>public/themes/redmusic/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="container">
    	<!-- header -->
        <div id="logo"><a href="#"><?= $site->display_name ?></a></div>
        <div id="menu">
		<?php foreach( $sitePageMeta as $page ): ?>
            <a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
		<?php endforeach; ?>  
        </div>
        <!--end header -->     
        <!-- main -->
        <div id="main">
		<div id="sidebarz">
		<?php if( sizeof( $files ) > 0 ): ?>
		<div id="sidebar2">
			<?= get_square_2() ?>
          	<h2>Attachments</h2>
            <ul>
					<?php foreach( $files as $file ): ?>
						<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
					<?php endforeach; ?>
        </div>
		<?php endif; ?>
		<?php if( sizeof( $links ) > 0 ): ?>
        <div id="sidebar">
          	<h2>Links</h2>
            <ul>
				<?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
				<?php endforeach; ?>
            </ul>
        </div>
		<div id="sidebar3">
			<h2>Author Login</h2>
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
		</div>
		<?php endif; ?>
		</div>
          <div id="text">
			<?= get_top_banner() ?>
            <h1><?= $pageContent->page_title ?></h1>
				<?= get_left_skyscraper('left') ?>
				<?= get_right_skyscraper('right') ?>
				<?= get_square_1('right') ?>
				<?= $pageContent->content ?>
				<?= get_top_banner('center') ?>
           </div>
    </div>
    <!-- end main -->
    <!-- footer -->
    <div id="footer">
            <div id="menu_footer">&nbsp;</div>
            <div id="left_footer">&copy; 2009 <?= $this->config->item('company_name'); ?> | 
				<a href="http://www.realitysoftware.ca/services/website-development/design/"><strong>Design</strong></a> by <a href="http://www.flashmp3player.org/"><strong>Flash MP3 Player</strong></a>
			</div>
            <div id="right_footer">

<!-- Please do not change or delete these links. Read the license! Thanks. :-) -->
<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>

   		</div>
	</div>
    <!-- end footer -->
</div>
</body>
</html>
