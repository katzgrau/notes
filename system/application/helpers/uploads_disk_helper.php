<?php

if ( ! function_exists('generate_uploaded_file_url'))
{
	function generate_uploaded_file_url($base_url, $site_name, $file_object)
	{
		$file_name 	= $file_object->file_name;
		return ("{$base_url}public/uploads/$site_name/$file_name");
	}
}

if ( ! function_exists('handle_uploaded_file'))
{
	function handle_uploaded_file($site_name, $file_object)
	{
		return true;
	}
}

if ( ! function_exists('delete_uploaded_file'))
{
	function delete_uploaded_file($site_name, $file_object)
	{
		$file_name = $file_object->file_name;
		$file_root = config_item('uploads_local_storage_path');
		log_message('debug', "DELETING $file_root$site_name/$file_name");
		return unlink( "$file_root/$site_name/$file_name" );
	}
}

?>