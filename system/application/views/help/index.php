<?php include config_item('application_root') . 'views/help/includes/header.php'; ?>
<?php $this->load->helper('control'); ?>

<div id="left">

<?= rounded_box_open() ?>

<div class="help_title" >Getting Started With the Authoring Panel</div>
<ul>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/introduction/learning-the-authoring-panel">An Introduction To The Authoring Panel</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/introduction/tooltips">Turning Tooltips (Help Bubbles) On or Off</a></li>
</ul>

<div class="help_title" >Page Editing</div>
<ul>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/adding-a-page">Adding A Page</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/editing-a-page">Editing A Page</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/saving-a-draft">Saving A Page Draft</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/publishing-a-page">Publishing A Page</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/deleting-a-page">Deleting A Page</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/unpublishing-a-page">Unpublishing</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/reverting-a-page">Reverting A Page (Draft Undo)</a><br /></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/changing-the-font">Changing the font style</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/uploading-a-picture">Inserting a picture from your computer (upload) into the page</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/creating-a-table">Creating a table</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/creating-a-link">Creating a link</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/inserting-a-youtube-video">Inserting a video from YouTube</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/inserting-a-html-snippet">Inserting an HTML snippet from another website (like YouTube or Flickr)</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/inserting-a-template">Inserting a pre-designed page template (like contact information, calendars, etc.)?</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/edit/attaching-a-file">Attaching A File To A Page</a></li>
</ul>

<div class="help_title" >Site Editing</div>
<ul>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/site/changing-site-design">Changing the design of your website</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/site/changing-site-title">Changing the title of your website</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/site/editing-page-order">Rearranging the page link order on your website</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/site/inserting-a-link">Inserting a link into your website</a></li>	
	<li><a class="hover_highlight" href="<?= base_url() ?>help/site/editing-link-order">Rearranging the link order on your website</a></li>	
</ul>

<div class="help_title" >Account Editing</div>
<ul>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/account/editing-account-information">Editing your account information</a></li>
	<li><a class="hover_highlight" href="<?= base_url() ?>help/account/changing-password">Changing your password</a></li>
</ul>

<?= rounded_box_close() ?>

</div>

<div id="right">
	<div>
	<?php echo rounded_box_open(); ?>
		<div class="help_title">Video Tutorials</div><p/>
		<div><a  class="pageLink" href="<?= config_item('base_url') ?>help/video/introduction">Introduction</a></div>
		<div><a  class="pageLink" href="<?= config_item('base_url') ?>help/video/insert-youtube-video">Inserting A YouTube Clip</a></div>
		<div><a  class="pageLink" href="<?= config_item('base_url') ?>help/video/insert-an-image">Inserting An Image</a></div>
		<div><a  class="pageLink" href="<?= config_item('base_url') ?>help/video/attach-a-file">Attaching A File</a></div>
	<?php echo rounded_box_close(); ?>
	</div>
</div>

<?php include config_item('application_root') . 'views/help/includes/footer.php'; ?>