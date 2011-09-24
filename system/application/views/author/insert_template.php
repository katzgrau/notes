<?php $this->load->helper('url'); ?>
<?php $this->load->helper( config_item('uploads_strategy_helper') ); ?>
<html>
	<head>
		<title>Insert A Page Template</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/author/css/style.css" >
		<script src="<?php echo base_url(); ?>public/common/js/prototype.js" type="text/javascript"></script>
	</head>
	<body style="margin:10px; background-color:#647678;">
	<p style="color: #ffffff;">Choose a template, click insert.</p>
		<table style="width:100%; background-color:#C4E7EB;">

			<tr>
				<td class="template_listing_row">Calendar</td>
				<td class="template_listing_row">
					Add a monthly calendar for (mm/yyyy): 
					<input type="text" value="<?= date('m') ?>" id="txt_month" maxlength="2" size="2" />/
					<input type="text" value="<?= date('Y') ?>" id="txt_year" maxlength="4" size="4" />
				</td>
				<td class="template_listing_row">
					<span class="template_insert_link" id="insert_calendar">
						Insert
					</span>
				</td>
			</tr>
			<tr>
				<td class="template_listing_row">Contact Information</td>
				<td class="template_listing_row">
					Auto-insert a table of contact information based on your account
				</td>
				<td class="template_listing_row">
					<span class="template_insert_link" id="insert_contact_information">
						Insert
					</span>
				</td>
			</tr>
			<tr>
				<td class="template_listing_row">5 Day Calendar</td>
				<td class="template_listing_row">
					A table with entries for Monday through Friday
				</td>
				<td class="template_listing_row">
					<span class="template_insert_link" id="insert_5_day_calendar">
						Insert
					</span>
				</td>
			</tr>
			<tr>
				<td class="template_listing_row">7 Day Calendar</td>
				<td class="template_listing_row">
					A table with entries for Sunday through Saturday
				</td>
				<td class="template_listing_row">
					<span class="template_insert_link" id="insert_7_day_calendar">
						Insert
					</span>
				</td>
			</tr>
			<tr>
				<td class="template_listing_row">Office Hours/Extra Help</td>
				<td class="template_listing_row">
					A table for listing office hours
				</td>
				<td class="template_listing_row">
					<span class="template_insert_link" id="insert_office_hours">
						Insert
					</span>
				</td>
			</tr>

		</table>
		<script type="text/javascript">
			
			Event.observe('insert_calendar', 'click', function(){
				m = $('txt_month').value;
				y = $('txt_year').value;
				
				if( m > 12 || m < 1 || y > 9999 || y < 0 )
				{
					alert('Please enter a valid month and year.');
					return;
				}
			
				insert_template('monthly-calendar', {month : m, year : y} );
			});
			
			Event.observe('insert_contact_information', 'click', function(){
				insert_template('contact-information', {} );
			});
			
			Event.observe('insert_5_day_calendar', 'click', function(){
				insert_template('5-day-weekly-calendar', {} );
			});
			
			Event.observe('insert_7_day_calendar', 'click', function(){
				insert_template('7-day-weekly-calendar', {} );
			});
			
			Event.observe('insert_office_hours', 'click', function(){
				insert_template('office-hours', {} );
			});
		
			function insert_template( name, params )
			{
				new Ajax.Request('<?= base_url(); ?>author/get_template/' + name,
					{
						method:'post',
						parameters: params,
						onSuccess: function(transport){
							top.tinyMCE.activeEditor.focus();
							top.tinyMCE.activeEditor.selection.setContent( transport.responseText );
							parent.parent.GB_hide();
						}
					});
			}
		</script>
	</body>
</html>