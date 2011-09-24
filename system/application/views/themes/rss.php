<?php $this->load->helper('url'); ?>
<?php $this->load->helper('xml'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<?php echo '<'.'?'; ?>xml version="1.0" encoding="utf-8"<?php echo '?'.'>' ?>
<rss version="2.0">
   <channel>
      <title><?= $site->display_name ?></title>
      <link><?= base_url() . $site->site_name ?></link>
      <description><?= xml_convert("Website entitled \"{$site->display_name}\" built with " . config_item('company_name'). "."); ?></description>
      <language>en-us</language>
      <pubDate><?= date(DATE_RSS, time()); ?></pubDate>
      <lastBuildDate><?= date(DATE_RSS, time()); ?></lastBuildDate>
      <generator><?= config_item('company_name') ?> RSS API</generator>
      <?php foreach( $sitePageMeta as $page ): ?>
		<item>
			 <title><?= xml_convert( $page->page_title ) ?></title>
			 <link><?= base_url() . $site->site_name . '/' . $page->page_slug ?></link>
			 <description><![CDATA[
				<?= xml_convert( htmlspecialchars_decode( strip_tags( $page->content) ) ) ?>
			 ]]></description>
			 <pubDate><?= date(DATE_RSS, strtotime( $page->modified )); ?></pubDate>
			 <?php foreach( $files as $file ): ?>
				<?php if( $file->page_slug == $page->page_slug ): ?>
					<enclosure url="<?= generate_uploaded_file_url( base_url(), $site_name, $file ) ?>" length="<?= $file->file_size * 8 ?>" type="<?= $file->file_type ?>" />
				<?php endif; ?>
			 <?php endforeach ?>
		</item>
	  <?php endforeach; ?>
   </channel>
</rss>