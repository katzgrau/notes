
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
<link rel="stylesheet" href="<?= base_url() ?>public/themes/zenlike/default.css" type="text/css" />

<!-- RSS -->
<link rel="alternate" href="" title="RSS Feed" type="application/rss+xml" />

</head>
<body>

<div id="upbg"></div>

<div id="outer">


	<div id="header">
		<div id="headercontent">
			<h1><?= $site->display_name ?></h1>
			<h2><?= $user->email ?></h2>
		</div>
	</div>


	<form method="post" action="">
		<div id="search">
			Last Update: <?= $site->modified ?>
		</div>
	</form>


	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<?php foreach( $sitePageMeta as $page ): ?>
			<li <?php if($page->page_title == $pageContent->page_title) echo 'class="active"'; ?>><a href="<?= base_url() ?><?= $site->site_name ?>/<?= $page->page_slug ?>"><?= $page->page_title ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
	
		<div class="divider1"></div>


		<!-- Primary content: Stuff that goes in the primary content column (by default, the left column) -->
		<div id="primarycontainer">
			<div id="primarycontent">
				<!-- Primary content area start -->
		
				<div class="post">
								<?= get_left_skyscraper( 'left' ) ?>
			<?= get_left_skyscraper( 'right' ) ?>
			<?= get_top_banner() ?>
					<h4><?= $pageContent->page_title ?></h4>
					<div class="contentarea">
						<?= get_square_1('right') ?>
						<?= $pageContent->content ?>
						
					</div>
				</div>

				<!-- Primary content area end -->
			</div>
		</div>

		
		<!-- Secondary content: Stuff that goes in the secondary content column (by default, the narrower right column) -->
		<div id="secondarycontent">
			<!-- Secondary content area start -->
			
			<!-- HINT: Set any div's class to "box" to encapsulate it in (you guessed it) a box -->
<?php if( sizeof( $files ) > 0 ): ?>
					<div>
						<?= get_square_2() ?>
						<h4>Attachments</h4><div class="contentarea">
						<ul class="linklist">
                <?php foreach( $files as $file ): ?>
					<li><a href="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>"><?= $file->orig_name ?></a></li>
				<?php endforeach; ?>
						</ul></div></div><br>
<?php endif; ?>			
		
		<?php if( sizeof( $links ) > 0 ): ?><div>
						<h4>Links</h4><div class="contentarea">
						<ul class="linklist">
                <?php foreach( $links as $link ): ?>
					<li><a href="<?= $link->url ?>"><?= $link->title ?></a></li>
				<?php endforeach; ?>
						</ul></div></div><br>
				<?php endif; ?>


<div>
			<h4>Login</h4>	<div class="contentarea">
			<form action="<?= base_url() ?>home/login" method="post">
				<table style="border-collapse:collapse;" border="0"><tr><td>
                <input name="site_name" value="" /><input name="password" type="password" value="" /></td><td valign="middle">
				<input class="button" type="submit" value="login"/></td></tr></table>
            </form> </div> </div>

			<!-- Secondary content area end -->
		</div>


	</div>

	<div id="footer">
			<div class="left">&copy; 2009 <?= $this->config->item('company_name'); ?></div>
			<div class="right"><a href="<?= $this->config->item('base_url'); ?>"><?= $this->config->item('company_name'); ?> Main Page</a></div>
	</div>
	
</div>

</body>
</html>