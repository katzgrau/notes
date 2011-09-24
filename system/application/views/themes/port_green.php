<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='cs' lang='cs'>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />

 
  <link rel="stylesheet" href="<?= base_url() ?>public/themes/port_green/style.css" type="text/css" />
 
  <title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>

 </head>
 <body>

     <div id="header">
         <h2><a href="#" title="home"><?= $site->display_name ?></a></h2>

         <ul id="menu-top">
		<?php foreach( $sitePageMeta as $page ): ?>
          <li>
            <a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>">
				<?= $page->page_title ?>
			</a>
          </li>
		<?php endforeach; ?>  
         </ul>

     </div>

     <div id="contain">

         <div id="left">

           <h1><?= $pageContent->page_title ?></h1>
			<?= get_top_banner() ?>
			<?= get_left_skyscraper('left') ?>
			<?= get_left_skyscraper('right') ?>
			<?= get_square_1('right'); ?>
			<?= get_square_2('right'); ?>
		    <?= $pageContent->content ?>
		    <?= get_bottom_banner() ?>
           
         </div>

         <div id="right">

             <div class="gray">

			 <h3>Attachments</h3>

			 <?php if( sizeof( $files ) > 0 ): ?>
             <ul class="links">
					<?php foreach( $files as $file ): ?>
						<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
					<?php endforeach; ?>
             </ul>
			 <?php endif; ?>
			 
			 <h3>Links</h3>

			 <?php if( sizeof( $links ) > 0 ): ?>
             <ul class="links">
					<?php foreach( $links as $link ): ?>
						<li><a href="<?= $link->url ?>" target="_blank"><?= $link->title ?></a></li>
					<?php endforeach; ?>
             </ul>
			 <?php endif; ?>
			 
			 
                 <h3>Author Login</h3>

			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse; width:100%;" border="0">
					<tr>
						<td>

							Site Name: <br/><input name="site_name" />
							
							Password: <br /><input id="password" name="password"  type="password" value=""/><p/>
							<p> <input class="button" type="submit" value="Login" style="float:right;" class="submit" /> </p>
							<div style="clear:both;"></div>
						</td>
					</tr>
				</table>
            </form>

             </div>

         </div>

         <div class="cleaner"></div>
     </div>

      <p id="footer">
             &copy; 2009 <?= $this->config->item('company_name'); ?> | <a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a>
      </p>

 </body>
</html>
