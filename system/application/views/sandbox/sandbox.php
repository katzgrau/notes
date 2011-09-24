<?php $this->load->helper('url') ?>
<html>
	<head>
		<title>Sandbox</title>
		<!-- <script src="<?= base_url(); ?>public/common/swfupload/swfupload.js" type="text/javascript"></script>
		<script src="<?= base_url(); ?>public/common/swfupload/swfupload.queue.js" type="text/javascript"></script>
		<script src="<?= base_url(); ?>public/common/swfupload/fileprogress.js" type="text/javascript"></script>
		<script src="<?= base_url(); ?>public/common/swfupload/handlers.js" type="text/javascript"></script> -->
		<script type="text/javascript">
			var GB_ROOT_DIR = "<?= base_url(); ?>public/common/greybox/";
		</script>
		<script src="<?= base_url(); ?>public/common/js/prototype.js" type="text/javascript"></script>
		<script src="<?= base_url(); ?>public/common/js/scriptaculous.js" type="text/javascript"></script>
<!--		
<script type="text/javascript"> 
		var swfu;
 
		window.onload = function() {
			var settings = {
				flash_url : "<?= base_url(); ?>public/common/swfupload/swfupload.swf",
				upload_url: "<?= base_url() ?>author/upload/38",
				post_params: {"session_id" : "<?= $session_id ?>"},
				file_post_name : "userfile",
				file_size_limit : "100 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,
 
				// Button settings
				button_image_url: "<?= base_url(); ?>public/common/swfupload/TestImageNoText_65x29.png",
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Hello</span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};
 
			swfu = new SWFUpload(settings);
	     };
	</script>  -->
	</head>
	<body>
	<!--<h1><?= $data ?></h1>
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data"> 
		<p>This page demonstrates a simple usage of SWFUpload.  It uses the Queue Plugin to simplify uploading or cancelling all queued files.</p> 
 
			<div class="fieldset flash" id="fsUploadProgress"> 
			<span class="legend">Upload Queue</span> 
			</div> 
		<div id="divStatus">0 Files Uploaded</div> 
			<div> 
				<span id="spanButtonPlaceHolder"></span> 
				<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" /> 
			</div> 

	</form> -->
	<p/>
	<h1><?= $title ?></h1>
	<p>
		<?= $content ?>
	</p>
	
	 
	
	</body>
</html>