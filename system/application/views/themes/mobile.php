<?php $this->load->helper('url'); ?>
<?php $this->load->helper('html'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<?= doctype('xhtml1-trans') ?>
<html>
  <head> 
    <title><?= $site->display_name ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/mobile/style.css" media="screen" />
  </head>
  <body>
  <h1 id="header"><?= $site->display_name ?></h1>
  <h2 id="sub-heading"><?= $pageContent->page_title ?></h2>
        <h2>Pages</h2>
    <div id="navigation_bar">
      <ul>
        <?php foreach( $sitePageMeta as $page ): ?>
          <li>
            <a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
              <?= $page->page_title ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
	<?php if( sizeof( $links ) > 0 ): ?>
	<h2>Links</h2>
    <div id="links_list"> 
     <ul>
      <?php foreach( $links as $link ): ?> 
        <li><a href="<?= $link->url ?>"><?= $link->title ?></a></li> 
      <?php endforeach; ?>
     </ul> 
    </div>
	<?php endif; ?>
    <div id="main"> 
      <h1 id="page_title"> <?= $pageContent->page_title ?></h1> 
	  <?= get_top_banner('left') ?>
	<div style="clear:both;"></div>
	  <?= get_left_skyscraper('left') ?>
	  <?= get_right_skyscraper('right') ?>
	  <?= get_square_1('right') ?>
      <?= $pageContent->content ?> 
	  <?= get_square_2('right') ?>
    </div>
	<?= get_bottom_banner('left') ?>
	<div style="clear:both;"></div>
	
	<?php if( sizeof( $files ) > 0 ): ?>
	<h2>File Attachments</h2>
    <div id="files_list">
     <ul>
      <?php foreach( $files as $file ): ?> 
        <li> 
          <a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"> 
            <?= $file->orig_name ?> 
          </a> 
        </li> 
      <?php endforeach; ?>
     </ul>
    </div>
	<?php endif; ?>
  </body>
  </html>
