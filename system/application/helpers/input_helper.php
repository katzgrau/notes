<?php

if( ! function_exists('get_post') )
{
	function get_post( $field_name, $default = '' )
	{
		$CI = &get_instance();
		
		$val = $CI->input->post( $field_name );
		
		return ( $val ) ? $val : $default;
	}
}

?>