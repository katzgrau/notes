<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= $site->display_name ?> - <?= $pageContent->page_title ?></title>

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
<link rel="stylesheet" href="<?= base_url() ?>public/themes/mighty/css/styles.css" media="all" type="text/css" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />

</head>

<body>
    <div id="header">
        <div class="subContainer">
            <div id="logo">
            <div id="box"></div>
            <p><?= $site->display_name ?></p>
            </div><!-- /logo -->
        </div><!-- /subContainer -->
    </div><!-- header -->
    
    <div id="navigation">
    <ul>
        <?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'id="active"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a></li>
		<?php endforeach; ?>
    </ul>
    </div><!-- /navigation -->
    
    <div id="container">            
        <div id="primaryContent">
    		<h2><?= $pageContent->page_title ?></h2>
			<?= get_top_banner() ?>
			<?= get_left_skyscraper('left') ?>
			<?= get_right_skyscraper('right') ?>
			<?= get_square_1('right') ?>
			<?= $pageContent->content ?>    		
			<?= get_bottom_banner() ?>
    	</div><!-- /primaryContent -->
    
		<div id="secondaryContent">       
			
			<?php if( sizeof( $files ) > 0 ): ?>
            <h3>Attachments:</h3>
            <ul>
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
            </ul>
			<?php endif; ?>
    		
			<?php if( sizeof( $links ) > 0 ): ?>
			<h3>Links</h3>
			<!-- 
            This part was designed to handle images
            -->
            <ul class="links">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
            </ul>
			<?php endif; ?>
			<?= get_square_2() ?>
            <h3>Login</h3>            
            <form action="<?= base_url() ?>home/login" method="post">
                <p><input name="site_name" value="" /></p>
                <p><input name="password" type="password" value="" /></p>
                <p><button>submit</button></p>
            </form>        
		</div><!-- /secondaryContent -->
        <br class="clear" />    
    </div><!-- container -->
    
    <div id="footer">
        <ul>
            <li id="copyright">&copy; 2009 <?= $this->config->item('company_name'); ?></li>
            <li id="links">
                <ul>
                    <li><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></li>
                </ul>
            </li>
        </ul>	
    </div><!-- /footer -->
<div style="font: 10px Arial, Sans-serif;">Last Update: <?= $site->modified ?></div>
</body>
</html>