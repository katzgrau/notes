<?php

	$s3 = null;

	function SendToAWS( $uri_prefix, $full_file_path )
	{
		$s3 = GetS3();
		$bucket_name = config_item('aws_bucket_name');
		
		return $s3->putObjectFile(	$full_file_path, 
									$bucket_name, 
									$uri_prefix . baseName($full_file_path), 
									S3::ACL_PUBLIC_READ
								  );
	}
	
	function DeleteFromAWS( $uri_prefix, $file_name )
	{
		$s3 = GetS3();
		$bucket_name = config_item('aws_bucket_name');
		
		return $s3->deleteObject($bucket_name, $uri_prefix . $file_name);
	}
	
	function &GetS3()
	{
		global $s3;
		
		if( $s3 == null )
		{
			require_once 's3/S3.php';
			
			$access_key 	= config_item('aws_access_key');
			$secret_key 	= config_item('aws_secret_key');
			$use_ssl		= config_item('aws_use_ssl');
			$s3 = new S3( $access_key, $secret_key, $use_ssl );
		}
		
		return $s3;
	}

?>