<?php

if ( ! function_exists('generate_uploaded_file_url'))
{
	function generate_uploaded_file_url($base_url, $site_name, $file_object)
	{
		$file_name 	= $file_object->file_name;
		
		if( $file_object->is_stored_locally )
		{
			return ("{$base_url}public/uploads/$site_name/$file_name");
		}
		else
		{
			$base_url 	= config_item('aws_base_url');
			$folder 	= config_item('aws_uploads_folder');
			return ("{$base_url}{$folder}$site_name/$file_name");
		}
	}
}

if ( ! function_exists('handle_uploaded_file'))
{
	function handle_uploaded_file($site_name, $file_object)
	{
		$CI = &get_instance();
		$CI->load->plugin('s3');
		
		$file_name = $file_object->file_name;
		$file_root = config_item('uploads_local_storage_path');
		$full_path = "$file_root$site_name/$file_name";
		
		log_message('debug', "Sending $full_path to cloud");
		
		// Does this file exist?
		if( ! file_exists( $full_path ) ) return false;
		
		$uri_prefix = config_item('aws_uploads_folder') . "$site_name/";
		$sent 		= SendToAWS( $uri_prefix, $full_path );
		
		if( $sent )
		{
			$CI->load->model('file');
			
			/* Delete the file off of the local disk */
			if( config_item('aws_delete_local_copy') )
			{
				@unlink( $full_path );
				$CI->file->SetIsStoredLocally( $file_object->id, false );
			}
		}
		
		return  $sent;
	}
}

if ( ! function_exists('delete_uploaded_file'))
{
	function delete_uploaded_file($site_name, $file_object)
	{
		$CI 		= &get_instance();
		$file_name 	= $file_object->file_name;
		
		// Is there a local copy? Kill it!
		if( $file_object->is_stored_locally )
		{	
			$file_root = dirname(__FILE__) . '/../../../public/uploads';
			unlink( "$file_root/$site_name/$file_name" );
		}
		
		// Kill the cloud version
		$CI->load->plugin('s3');
		$uri_prefix = config_item('aws_uploads_folder') . "$site_name/";
		$deleted 	= DeleteFromAWS( $uri_prefix, $file_name ) ;
		
		return $deleted;
	}
}

?>