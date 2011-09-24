<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
	<meta name="robots"      content="index, follow" />
	<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />


  <!-- **** layout stylesheet **** -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/bluespring/style/style.css" />

  <!-- **** colour scheme stylesheet **** -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/bluespring/style/colour.css" />

</head>

<body>
  <div id="main">
    <div id="links">
      <!-- **** INSERT LINKS HERE **** -->
    </div>
    <div id="logo"><h1><?= $site->display_name ?></h1></div>
    <div id="content">
      <div id="menu">
        <ul>
		<?php foreach( $sitePageMeta as $page ): ?>
          <li >
            <a <?php if($page->page_title == $pageContent->page_title) echo 'id="selected"'; ?> href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
          </li>
		<?php endforeach; ?>  
        </ul>
      </div>
      <div id="column1">
		<?php if( sizeof( $files ) > 0 ): ?>
        <div class="sidebaritem">
          <div class="sbihead">
            <h1>Attachments</h1>
          </div>
          <div class="sbilinks">
            <!-- **** INSERT ADDITIONAL LINKS HERE **** -->
			<ul>
				<?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
			</ul>
          </div>
        </div>
		<?php endif; ?>		
		<?php if( sizeof( $links ) > 0 ): ?>
        <div class="sidebaritem">
          <div class="sbihead">
            <h1>Links</h1>
          </div>
          <div class="sbilinks">
            <!-- **** INSERT ADDITIONAL LINKS HERE **** -->
			<ul>
				<?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
				<?php endforeach; ?>
			</ul>
          </div>
        </div>
		<?php endif; ?>
		<?= get_square_2() ?>
		<div class="sidebaritem">
          <div class="sbihead">
            <h1>Author Login</h1>
          </div>
          <div class="sbicontent">
            <form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse;" border="0">
					<tr>
						<td>
							<input name="site_name" style="width:165px;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" />
							<input id="password" name="password"  style="width:165px;" type="password" value=""/>
							<input class="button" type="submit" value="login" style="width:165px;" />
						</td>
					</tr>
				</table>
            </form>
          </div>
        </div>
      </div>
      <div id="column2">
        <h1><?= $pageContent->page_title ?></h1>
		<?= get_top_banner() ?>
		<?= get_left_skyscraper('left') ?>
		<?= get_right_skyscraper('right') ?>
		<?= get_square_1('right') ?>
        <!-- **** INSERT PAGE CONTENT HERE **** -->
        <?= $pageContent->content ?>
		<?= get_bottom_banner() ?>
      </div>
    </div>
	<div id="footer">
			<div style="float:left;">&copy; 2009 <?= $this->config->item('company_name'); ?> | <a href="http://www.dcarter.co.uk">design by dcarter</a></div>
			<div style="float:right;"><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></div>
			<div style="clear:both;"></div>
	</div>
  </div>
</body>
</html>
