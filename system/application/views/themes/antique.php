<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

    <title>
      <?= $site->display_name ?> - <?= $pageContent->page_title ?>
    </title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/antique/css/style.css" />
  </head>
  <body>
    <div id="head">
		  <div id="title">
			<?= $site->display_name ?>		 
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
    </div>
    <div id="body_wrapper">
      <div id="body">
        <div id="left">
          <div class="top"></div>
          <div class="content">
			<?= get_top_banner() ?>
			<?= get_left_skyscraper('left') ?>
			<?= get_right_skyscraper('right') ?>
			<h1><?= $pageContent->page_title ?></h1>
			<?= get_square_1('right') ?>
			<?= get_square_2('right') ?>
            <?= $pageContent->content ?>
			<?= get_bottom_banner() ?>
          </div>
          <div class="bottom"></div>
        </div>
        <div id="right">
          <div class="top"></div>
          <div class="content">			
		  <?php if( sizeof( $files ) > 0 ): ?>
            <h4>Attachments</h4>
						<ul>
						<?php foreach( $files as $file ): ?>
							<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
						<?php endforeach; ?>
						</ul>
						<hr />
			<?php endif; ?>
			<?php if( sizeof( $links ) > 0 ): ?>
			  <h4>Links</h4>
				<ul>
					<?php foreach( $links as $link ): ?>
						<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
					<?php endforeach; ?>
				</ul>
				<hr />
			<?php endif; ?>

			<h4>Author Login</h4>
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse;" border="0">
					<tr>
						<td>
							<input name="site_name" style="width:125px;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" />
							<input id="password" name="password"  style="width:125px;" type="password" value=""/>
							<input class="button" type="submit" value="login" style="float:right;" />
							<div style="clear:both"></div>
						</td>
					</tr>
				</table>
            </form>
          </div>
          <div class="bottom"></div>
        </div>
        <div class="clearer"></div>
      </div>
      <div class="clearer"></div>
    </div>
    <div id="end_body"></div>
	<div id="footer">
			<div style="float:left;">&copy; 2009 <?= $this->config->item('company_name'); ?></div>
			<div style="float:right;"><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></div>
			<div style="clear:both;"></div>
	</div>
  </body>
</html>
