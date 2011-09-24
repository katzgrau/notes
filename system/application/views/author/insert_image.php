<?php $this->load->helper('url'); ?>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<script type="text/javascript">
			top.tinyMCE.activeEditor.focus();
			top.tinyMCE.activeEditor.selection.setContent('<?= $markup ?>');
			parent.parent.GB_hide();
		</script>
	</body>
</html>