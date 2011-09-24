<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"/>
	<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/summer/style.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/summer/print.css" media="print"/>
    <title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
</head>

<body>
<div id="wrapper">

    <div id="navigation">
        <h1><?= $site->display_name ?></h1>

        <h2><?= $pageContent->page_title ?></h2>
        <ul>
		<?php foreach( $sitePageMeta as $page ): ?>
          <li >
            <a <?php if($page->page_title == $pageContent->page_title) echo 'class="selected"'; ?> href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<span><?= $page->page_title ?></span>
			</a>
          </li>
		<?php endforeach; ?>  
        </ul>
    </div>

    <div id="content">
		<?= get_top_banner() ?>
        <h1><?= $pageContent->page_title ?></h1>
			<?= get_left_skyscraper('left') ?>
			<?= get_right_skyscraper('right') ?>
			<?= get_square_1('right') ?>
			<?= get_square_2('right') ?>
			<?= $pageContent->content ?>
			<?= get_bottom_banner() ?>
    </div>

    <div id="sidecontent">
	
<?php if( sizeof( $files ) > 0 ): ?>
	<h4>Attachments</h4>
        <ul>
			<?php foreach( $files as $file ): ?>
				<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
			<?php endforeach; ?>
        </ul>
<?php endif; ?>
<?php if( sizeof( $links ) > 0 ): ?>		
        <h4>Links</h4>
        <ul>
			<?php foreach( $links as $link ): ?>
				<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
			<?php endforeach; ?>
        </ul>
<?php endif; ?>
		<h4>Author Login</h4>
			<form action="<?= base_url() ?>home/login" method="post" style="padding:10px 0 2px 15px;">
				<table style="border-collapse:collapse;" border="0">
					<tr>
						<td>
							Site Name: <br/><input name="site_name" style="width:140px;" value="" />
							
							Password: <br /><input id="password" name="password"  style="width:140px;" type="password" value=""/><p/>
							<p> <input class="button" type="submit" value="Login" style="float:right;" /> </p>
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
            </form>
    </div>

    <div id="footer">
        <span class="left">&copy; 2009 <?= $this->config->item('company_name'); ?> | Designed by <a href="http://www.oswd.org/user/profile/id/8671">quixotic</a>, <a href="http://www.raykdesign.net">pogy366</a> and prog</span>

     <span class="right">
		<a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
     </span>
    </div>

</div>


</body>
</html>