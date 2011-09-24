<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="en" />
    <meta name="robots" content="all,follow" />

    <meta name="author" lang="en" content="" />
    <meta name="copyright" lang="en" content="" />

    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo fe_resource_base(); ?>css/reset.css" />
    <!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="<?php echo fe_resource_base(); ?>home/css/main-msie.css" /><![endif]-->
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo fe_resource_base(); ?>css/main.css" />
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo fe_resource_base(); ?>css/style.css" />
    <link rel="stylesheet" media="print" type="text/css" href="<?php echo fe_resource_base(); ?>css/print.css" />
	
	<script type="text/javascript" src="<?php echo base_url(); ?>public/common/js/prototype.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/common/js/scriptaculous.js"></script>
	<?php if( $include_modal ): ?>
		<script type="text/javascript">
			var GB_ROOT_DIR = "<?php echo base_url(); ?>public/common/greybox/";
		</script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/common/greybox/AJS.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/common/greybox/AJS_fx.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/common/greybox/gb_scripts.js"></script>
		<link href="<?php echo base_url(); ?>public/common/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<?php endif; ?>
</head>
    <title>A site building tool</title>
	
</head>

<body id="body">

<div id="main">

    <!-- Header -->
    <div id="header">
		
        <h1 id="logo"><a href="./" title="[Go to homepage]"><img src="<?php echo fe_resource_base(); ?>tmp/logo.gif" alt="" /></a></h1>
        <hr class="noscreen" />

        <!-- Navigation -->
        <div id="nav">
            <a id="nav-active">Homepage</a> <span>|</span>
            <a href="<?php echo base_url(); ?>help/support">Support</a> <span>|</span>
            <a href="mailto:<?php echo config_item('customer_service_email'); ?>">Contact Us</a>
        </div> <!-- /nav -->

    </div> <!-- /header -->
    
    <!-- Tray -->
    <div id="tray">

        <ul>
            <li <?php if( $page == "home" ) echo 'id="tray-active"'; ?>><a href="<?php echo  base_url(); ?>home/">Homepage</a></li> <!-- Active page -->
            <?php if( config_item('individual_accounts_enabled') ): ?>
            <li <?php if( $page == "how_it_works" ) echo 'id="tray-active"'; ?>><a href="<?php echo  base_url(); ?>home/how_it_works">Take A Tour</a></li>
            <li <?php if( $page == "pricing" ) echo 'id="tray-active"'; ?>><a href="<?php echo  base_url(); ?>home/pricing">Pricing</a></li>
			<li <?php if( $page == "trial" ) echo 'id="tray-active"'; ?>><a href="<?php echo  base_url(); ?>home/trial">Try It Free</a></li>
			<li <?php if( $page == "register" ) echo 'id="tray-active"'; ?>><a href="<?php echo  base_url(); ?>home/register">Sign Up</a></li>
			<?php endif; ?>
			<?php if( is_logged_in() ): ?>
            <li><a href="<?php echo base_url(); ?>author">Author</a></li>
			<?php endif; ?>
			<?php if( ! is_logged_in() ): ?>
            <li <?php if( $page == "login" ) echo 'id="tray-active"'; ?>><a href="<?php echo  base_url(); ?>home/login">Login</a></li>
			<?php else: ?>
			<li><a href="<?php echo  base_url(); ?>home/logout">Logout</a></li>
			<?php endif; ?>
        </ul>
		
        <!-- Search -->
		<?php if( ! config_item('individual_accounts_enabled') ): ?>
        <div id="search" class="box">
            <form method="post" action="<?php echo base_url(); ?>home/search">
                <div class="box">
                    <div id="search-input"><span class="noscreen">Search:</span><input type="text" value="Search" name="search" onclick="this.value='';" /></div>
                    <div id="search-submit"><input type="image" src="<?php echo fe_resource_base(); ?>home/design/search-submit.gif" value="OK" /></div>
                </div>
            </form>
        </div> <!-- /search -->
		<?php endif; ?>
    <hr class="noscreen" />
    </div> <!-- /tray -->