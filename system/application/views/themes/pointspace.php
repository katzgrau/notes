<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/pointspace/css/default.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/pointspace/css/print.css" media="print" />
</head>
<body>

<div id="view">
  <!-- 
    #hlavicka vcetne loga a listy s hlavni nabidkou
      - h1 hlavní nadpis a absolutni pozadi v logu
      - ul seznam - hlavní menu (span odpovida cervene odrazce)
      - aktivni zalozka oznacena v elementu li tridou "active"
  -->
  <div id="head">
    <div id="logo">
      <a href="" class="block">&nbsp;</a>
      <h1><a href="#"><?= $site->display_name ?></a></h1>
      <h2><a href="#"><?= $pageContent->page_title ?></a></h2>
    </div>
    <hr class="hidden" />
    <div id="mainMenu">
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
    <hr class="hidden" />
  </div>
  <!-- /#hlavicka vcetne loga a listy s hlavni nabidkou -->
  
  <div id="content">
    <div id="contentBlock">
      <div class="item last">
        <h2><?= $pageContent->page_title ?></h2>
		<?= get_top_banner() ?>
		<?= get_left_skyscraper( 'left' ) ?>
		<?= get_left_skyscraper( 'right' ) ?>	
		<?= get_square_1('right') ?>
        <?= $pageContent->content ?>
		<?= get_bottom_banner() ?>
      </div>
	  
      <div class="col2 right">
        <a href="index.html"><img src="img/image.gif" width="123" height="81" alt="" class="left" /></a>
        <a href="index.html"><img src="img/image.gif" width="123" height="81" alt="" class="right" /></a>
        <a href="index.html"><img src="img/image.gif" width="123" height="81" alt="" class="left" /></a>
        <a href="index.html"><img src="img/image.gif" width="123" height="81" alt="" class="right" /></a>
      </div>
      <!-- /#cols 50:50 -->
    </div>
    <!-- /#obsahovy blok -->
    
    <hr class="hidden" />
    
    <!-- #pravy blok - nabidka submenu a dalsi prvky -->
    <div id="menuBlock">
      <!--
        #zachovani shodneho odsazeni boxu v prave casti obsahu
          - uzavreni do konstrukce s tridou "box" zpusobi odsazeni nasledujiciho elementu
          
        #moznosti boxu prave nabidky
          - prvni element praveho sloupce musi byt definovan i tridou "firstBox" - vykresleni stinu
          - element obsahujici submenu musi obsahovat tridu "subMenu"
          - element obsahujici ostatni obsahove prvky (seznamy, formulare, obrazky) musi byt zalozen na tride "boxText"
          
        #aktivni zalozka oznacena v elementu li tridou "active"
      -->
      <div class="box subMenu">
	  <?= get_square_2() ?>
        <?php if( sizeof( $files ) > 0 ): ?>
		<h3>Attachments:</h3>
        <ul>
			<?php foreach( $files as $file ): ?>
				<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
			<?php endforeach; ?>
        </ul>
		<?php endif; ?>
      </div>
      <div class="box subMenu">
        <?php if( sizeof( $links ) > 0 ): ?>
		<h3>Links:</h3>
        <ul>
			<?php foreach( $links as $link ): ?>
				<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
			<?php endforeach; ?>
        </ul>
		<?php endif; ?>
      </div>
      <div class="box boxText">
        <h3>Author Login:</h3>
        <form action="<?= base_url() ?>home/login" method="post" style="padding:0; padding-left: 15px;">
				<table style="border-collapse:collapse;" border="0">
					<tr>
						<td>
							Site Name: <br/><input name="site_name" style="width:165px;" onclick="if(this.value=='Site Name') { this.value=''; }" value="Site Name" />
							<br/>
							Password: <br /><input id="password" name="password"  style="width:165px;" type="password" value=""/><br /><br />
							<input class="button" type="submit" value="Login" style="width:165px;" />
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
        </form>
      </div>
    </div>
    <!-- /#pravy blok -->
  </div>
  
  <!-- #pristupne prvky stranky - neodstranovat !!! -->
  <hr class="hidden" />
  <ul class="hidden">
    <li><a href="#view">Nahoru</a></li>
    <li><a href="#content">Zpět na obsah</a></li>
  </ul>
  <hr class="hidden" />
  <!-- /#pristupne prvky stranky - neodstranovat !!! -->
  
  <div id="foot">
    <p class="fl">&copy; 2009 <?= $this->config->item('company_name'); ?> | Design by <a href="http://www.breezy.cz" class="ico ico-breezy">Breezy New Media</a></p>
    
    
    
    <!-- /#   LINKS AND AUTHOR-SIGNATURE CANNOT BE REMOVED !!! -->
    <p class="fr"><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></p>
  </div>
</div>

</body>
</html>
