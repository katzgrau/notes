<?php $this->load->helper('url'); ?>
<p><i>Click on a design to see a larger picture.</i></p>
	<?php foreach( $themes as $theme ):  ?>
	<div style="float:left; margin: 4px;">
			<a href="#" onclick="return GB_showCenter('Theme Preview: <?= $theme->display_name ?>', '<?= base_url(); ?>ajax/get_theme_preview/<?= $theme->id ?>', 600, 1000)">
				<img title="&quot;<?= $theme->display_name ?>&quot; - <?= str_replace ( '"', '&quot;', $theme->description ) ?> Click to preview." alt="<?= $theme->display_name ?>" src="<?= base_url() ?>public/themes/<?= $theme->theme_name ?>/thumbnail.png" border="0" />
			</a>
	</div>
	<?php endforeach; ?>
	<?php if( $is_first_page ): ?>
		<!-- FP -->
	<?php endif; ?>
	<?php if( $is_last_page ): ?>
		<!-- LP -->
	<?php endif; ?>
	
	<div class="clear"></div>