<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<html>
	<head>
		<title>Upload And Image</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/author/css/style.css" >
	</head>
	<body style="margin:10px; background-color:#647678;">
	<form id="upload_form" method="post" action="<?= base_url() ?>author/upload_image/<?= $page_id ?>" enctype="multipart/form-data">
		<p style="color: #ffffff;">Browse for a picture file on your computer, then click "Insert Image"</p>
		<div style="padding:10px; background-color:#C4E7EB;">
				<input type="file" name="userfile" />
				<input type="hidden" name="step" value="upload" />
				
				<div class="clear"></div>
				<div style="border-bottom:1px dotted #647678; margin-top:5px; margin-bottom:5px;"></div>
				Do you want the image resized to fit the page if it is too large?
				<input type="checkbox" name="resize" checked="true" />
				<div style="border-bottom:1px dotted #647678; margin-top:5px; margin-bottom:5px;"></div>
				Picture Positioning: <br/>
				<table style="width:100%;">
					<tr>
						<td><input type="radio" name="position" value="left" checked="true"/> Left</td>
						<td><input type="radio" name="position" value="center" /> Center</td>
						<td><input type="radio" name="position" value="right" /> Right</td>
					</tr>
				</table>
			
		</div>
		<div style="padding:10px;">
			<input type="submit" value="Insert Image" style="float:right;"/>
		</div>
	</form>
	</body>
</html>