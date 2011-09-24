
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>

<?php #print_r( $sitePageMeta ); ?>
<?php #print_r( $pageContent ); ?>
<?php #print_r( $site ); exit;?>
<?php #print_r( $links ); exit;?>

<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php $this->load->helper( config_item('ads_strategy_helper') ); ?>

<!-- Meta Tags -->
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<meta name="robots"      content="index, follow" />
<meta name="keywords"    content="<?= str_replace(' ',',', $site->display_name) ?>,<?= str_replace(' ',',', $pageContent->page_title) ?>" />


<!-- Favicon -->
<link rel="shortcut icon" href="" />

<!-- CSS -->
 <link rel="stylesheet" media="screen,projection" type="text/css" href="<?= base_url() ?>public/themes/liquid-01/css/reset.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?= base_url() ?>public/themes/liquid-01/css/main.css" />
<!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/themes/liquid-01/css/main-msie.css" /><![endif]-->
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?= base_url() ?>public/themes/liquid-01/css/style.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?= base_url() ?>public/themes/liquid-01/css/print.css" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />
	
</head>
<body>

<div id="main">

    <!-- Header -->
    <div id="header">
    
        <p id="logo"><?= $site->display_name ?></p>
        
        <div id="slogan">Contact me: <?= $user->email ?></div>
    
    </div> <!-- /header -->
    
    <hr class="noscreen" />
    
    <!-- Navigation -->
    <div id="nav" class="box">
	  <ul>
		<?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'id="active"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a></li>
		<?php endforeach; ?>
    </ul>
       
    
    </div> <!-- /nav -->
    
    <hr class="noscreen" />
    
    <!-- Columns -->
    <div id="cols">
        <div id="cols-in" class="box">
    
            <!-- Content -->
            <div id="content">
           
                <h2 class="title-01"><?= $pageContent->page_title ?></h2>
                
                <div class="in">
                
                    <!-- Topstory -->
                    <div class="box">
                        <div id="topstory-txt">
							<?= get_top_banner() ?>
							<?= get_left_skyscraper('left') ?>
							<?= get_right_skyscraper('right') ?>
							<?= get_square_1('right') ?>
                            <?= $pageContent->content ?>    
							<?= get_bottom_banner() ?>
                        </div> <!-- /topstory-txt -->
                        
                    </div> <!-- /box -->                  

                
                </div> <!-- /in -->
                
            </div> <!-- /content -->

            <hr class="noscreen" />

            <!-- Aside -->
            <div id="aside">
			
<?php if( sizeof( $files ) > 0 ): ?>
                <h4 class="title-03">Attachments</h4>
                
                <div class="in">
           
			<!-- 
            This part was designed to handle images
            -->
            <ul class="links" id="subnav">
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
            </ul>
                </div> <!-- /in -->
<?php endif; ?>				

<?php if( sizeof( $links ) > 0 ): ?>
                <h4 class="title-03">Links</h4>
                <div class="in">
                
			<!-- 
            This part was designed to handle images
            -->
            <ul class="links" id="subnav">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
            </ul>
			<?= get_square_2() ?>
                </div> <!-- /in -->
				<?php endif; ?>
				

     <h4 class="title-03">Login</h4>
                
                <div class="in">			
            <form action="<?= base_url() ?>home/login" method="post">
			
				<div align="center" style="margin-bottom: 12px;">
				<input name="site_name" value="" /></div>
				
				<div align="center" style="margin-bottom: 12px; margin-left:42px;">
				<input name="password" type="password" value="" />
				<input class="button" type="submit" value="login" /></div>
			
            </form>  
			</div>


            </div> <!-- /aside -->
            
        </div> <!-- /cols-in -->
    </div> <!-- /cols -->
    
    <!-- Photogallery -->
    <!-- <div id="gallery"> 
    
        <h4 class="title-03 gallery"><a href="#">Photogallery</a></h4>
        
        <div id="gallery-in">

            <p class="t-center nom box">
                <a href="#"><img src="tmp/95x71.gif" alt="" /></a>
                <a href="#"><img src="tmp/95x71.gif" alt="" /></a>
                <a href="#"><img src="tmp/95x71.gif" alt="" /></a>
                <a href="#"><img src="tmp/95x71.gif" alt="" /></a>
                <a href="#"><img src="tmp/95x71.gif" alt="" /></a>
                <a href="#"><img src="tmp/95x71.gif" alt="" /></a>
                <a href="#"><img src="tmp/95x71.gif" alt="" /></a>
                <a href="#" class="last"><img src="tmp/95x71.gif" alt="" /></a>
            </p>

            <div class="separator"></div>

            <div class="box">

                <p class="f-right nom"><a href="#" class="ico-rss">RSS Feed</a></p>

                <p class="f-left nom">Tags: <a href="#">Cars</a>, <a href="#">Football</a>, <a href="#">Baseball</a>, <a href="#">New York</a>, <a href="#">Weddings</a>, <a href="#">Family</a> &hellip;</p>
                
            </div> <!-- /box -->
			

        </div> <!-- /gallery-in -->
    
    <!-- </div> <!-- /gallery -->
    <hr class="noscreen" />
    
    <!-- Footer -->
    <div id="footer" class="box">
    
        <p class="f-right">
				&copy; 2009 <?= $this->config->item('company_name'); ?>
        </p>
        
        <p class="f-left"><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></p>

    </div> <!-- /box -->

</div> <!-- /main -->
<div align="center" style="font: 10px Arial, Sans-serif; margin-top:9px;">Last Update: <?= $site->modified ?></div>
</body>
</html>
