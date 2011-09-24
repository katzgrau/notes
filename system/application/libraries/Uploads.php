<?php

	class Uploads
	{
		var $CI;
		
		function Uploads()
		{
			$this->CI = &get_instance();
		}
		
		function ProcessUploads()
		{
			if( ! config_item('uploads_enable_processing') ) return false;
			
			/* Get comfortable.. */
			set_time_limit ( 0 );
			
			$this->CI->load->model('file');
			$this->CI->load->helper( config_item('uploads_strategy_helper') );
			
			$files = $this->CI->file->GetFilesToBeProcessed();
			
			$success_count = 0;
			
			foreach( $files as $file )
			{
				$success = handle_uploaded_file( $file->owner_site_name, $file ); //  a function in the helper
				
				if( $success ) 
				{
					$success_count++;
					$this->CI->file->SetToBeProcessed( $file->id, false );
				}
			}
			
			return array( 'successes' => $success_count, 'failures' => sizeof( $files ) - $success_count );
		}
	}

?>