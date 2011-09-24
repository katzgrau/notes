<?php

if ( ! function_exists('send_formatted_email'))
{
	function send_formatted_email( $view_name, $title, $to )
	{
		$ci = &get_instance();
		
		$ci->load->library('email');
		
		$data['username'] = 'username';
		$data['password'] = 'password';
		
		$body = $ci->load->view( $view_name, $data, true );
		
		/* Send the email */
	}
}
?>