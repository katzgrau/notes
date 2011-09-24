<?php $this->load->helper('url'); ?>
<?php $this->load->helper('control'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>
			<?php echo config_item('company_name'); ?> Author :: <?php echo $site_name; ?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/author/css/round-button.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/author/css/style.css" >
		<?php if( $are_tooltips_enabled ): ?>
			<link href="<?php echo base_url(); ?>public/common/tooltips/tooltip.css" rel="stylesheet" type="text/css" >
		<?php endif; ?>
		<?php if( $include_modal ): ?>
			<link href="<?php echo base_url(); ?>public/common/greybox/gb_styles.css" rel="stylesheet" type="text/css" >
		<?php endif; ?>
<!-- Javascript Time! -->
		<?php if( $include_scriptaculous ): ?>
			<script src="<?php echo base_url(); ?>public/common/js/prototype.js" type="text/javascript"></script>
			<script src="<?php echo base_url(); ?>public/common/js/window.js" type="text/javascript"></script>
			<script src="<?php echo base_url(); ?>public/common/js/scriptaculous.js?load=effects,dragdrop" type="text/javascript"></script>
		<?php endif; ?>
		<?php if( $include_rich_text_box_js ): ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>public/author/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
			// O2k7 skin
			tinyMCE.init({
				// General options
				mode : "exact",
				elements : "content",
				theme : "advanced",
				convert_urls : false,
				skin : "o2k7",
				plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
				//,imagemanager,filemanager 
				// Theme options
				theme_advanced_buttons1 : "save,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : false,

				// Example content CSS (should be your site CSS)
				//content_css : "<?php echo base_url(); ?>public/author/tiny_mce/themes/advanced/skins/o2k7/content.css",

				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "js/template_list.js",
				external_link_list_url : "js/link_list.js",
				external_image_list_url : "js/image_list.js",
				media_external_list_url : "js/media_list.js"
			});
			
			</script>
		<?php endif; ?>
		<?php if( $include_modal ): ?>
			<script type="text/javascript">
				var GB_ROOT_DIR = "<?php echo base_url(); ?>public/common/greybox/";
			</script>
			<script type="text/javascript" src="<?php echo base_url(); ?>public/common/greybox/AJS.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>public/common/greybox/AJS_fx.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>public/common/greybox/gb_scripts.js"></script>
			
		<?php endif; ?>
<!-- Scripts Over -->
		</head>
	<body> 
		<div id="top"><?php echo config_item('company_name'); ?> Author &#8594; <?php echo $site_name; ?></div>
		<div id="nav">
				<div><a class="navLink <?php if( $author_page == "desktop" ) echo "navLinkActive"; ?>" href="<?php echo base_url() ."author/" ?>"><?php echo generate_tooltip('Desktop', 'This is the landing page after you log in.', $are_tooltips_enabled) ?></a></div>
				<div><a class="navLink <?php if( $author_page == "edit" ) echo "navLinkActive"; ?>" href="<?php echo base_url() ."author/edit" ?>"><?php echo generate_tooltip('Edit Pages', 'This is where you can create pages on your website, edit them, unpublish them, and more.', $are_tooltips_enabled) ?></a></div>
				<div><a class="navLink <?php if( $author_page == "settings" ) echo "navLinkActive"; ?>" href="<?php echo base_url() ."author/settings" ?>"><?php echo generate_tooltip('Site Settings', 'This is where you can change your website\'s design, add links, and rearrange your page listing order.', $are_tooltips_enabled) ?></a></div>
				<div><a class="navLink <?php if( $author_page == "account" ) echo "navLinkActive"; ?>" href="<?php echo base_url() ."author/account" ?>"><?php echo generate_tooltip('Edit Account', 'This is where you can edit your account information like your email address, contact information, and password.', $are_tooltips_enabled) ?></a></div>
				<div><a class="navLink" href="<?php echo base_url() . $site_name; ?>" target="_blank"><?php echo generate_tooltip('View Website', 'Click here to view your website.', $are_tooltips_enabled) ?><img src="<?php echo base_url(); ?>/public/author/img/external.gif" alt="external" /></a></div>
				<div><a class="navLink" href="<?php echo base_url() ."home/logout" ?>"><?php echo generate_tooltip('Logout', 'Click here to logout, and return to the login page.', $are_tooltips_enabled) ?></a></div>
				<div><a class="navLink" href="<?php echo base_url() ."help" ?>" target="_blank"><?php echo generate_tooltip('Help', 'The Help section is where you can find tutorials on how to use the tools available to you.', $are_tooltips_enabled) ?></a></div>
				<?php if( $are_tooltips_enabled ): ?>
					<div>
						<a class="navLink" href="<?php echo base_url() ."author/tooltips_off/$author_page" ?>">
							<?php echo generate_tooltip('Turn Off ToolTips', 'Clicking this will keep these little hint bubbles from popping up. You can renable them any time you want.', $are_tooltips_enabled) ?>
						</a>
					</div>
				<?php else: ?>
					<div><a class="navLink" href="<?php echo base_url() ."author/tooltips_on/$author_page" ?>">Turn On ToolTips</a></div>
				<?php endif; ?>
				<div class="clear"></div>
		</div>
		<div id="sub"></div>
		<p />
		<div id="main">