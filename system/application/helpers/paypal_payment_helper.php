<?php

if ( ! function_exists('verify_and_retrieve_payment'))
{
	// return an array with a boolean result and dictionary of the request response

	function verify_and_retrieve_payment()
	{
		$email = $_GET['ipn_email']; 
		$header = ""; 
		$emailtext = "";  
		// Read the post from PayPal and add 'cmd' 
		$req = 'cmd=_notify-validate';

		if(function_exists('get_magic_quotes_gpc'))   
		{ 
			$get_magic_quotes_exits = true;
		}

		foreach ($_POST as $key => $value)
		// Handle escape characters, which depends on setting of magic quotes  
		{ 
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1)     
			{  
				$value = urlencode(stripslashes($value));   
			} 
			else 
			{     
				$value = urlencode($value);   
			}    
		 
			$req .= "&$key=$value";  
		} // Post back to PayPal to validate 
		 
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; 

		$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);  

		 // Process validation from PayPal
		if (!$fp) 
		{ // HTTP ERROR  
		} 
		else 
		{ // NO HTTP ERROR  
			fputs ($fp, $header . $req); 
		 
			while (!feof($fp)) 
			{   
				$res = fgets ($fp, 1024);   
				if (strcmp ($res, "VERIFIED") == 0) 
				{     
					// TODO:     // Check the payment_status is Completed     
					// Check that txn_id has not been previously processed    
					// Check that receiver_email is your Primary PayPal email    
					// Check that payment_amount/payment_currency are correct     
					// Process payment         
					// If 'VERIFIED', send an email of IPN variables and values to the     
					// specified email address     
		 
					$f_result = array( true, $_POST );
					
					//foreach ($_POST as $key => $value)
					//{       
						//$emailtext .= $key . " = " .$value ."\n\n";
					//}     
			 
					//mail($email, "Live-VERIFIED IPN", $emailtext . "\n\n" . $req);   
				} 
				else if (strcmp ($res, "INVALID") == 0) 
				{     // If 'INVALID', send an email. TODO: Log for manual investigation.     
					//foreach ($_POST as $key => $value)
					//{       
					//	$emailtext .= $key . " = " .$value ."\n\n";     
					//}     
					
					//mail($email, "Live-INVALID IPN", $emailtext . "\n\n" . $req);   
					$f_result = array( false, $_POST );
				} 
			}
		 
			fclose ($fp); 
		}
	
		return $f_result;
	}
	
if ( ! function_exists('generate_purchase_button'))
{
	function generate_purchase_button( $price, $site_name, $is_new = true, $item_title = false, $account_id = false)
	{
		$pay_to_email = config_item('pay_to_email');
		$item_number = create_item_number( $site_name, $is_new, $account_id );
		
		if ( ! $item_title ) $item_title = "<Site Name> 1 Year Subscription";
		
		return "
		<form action=\"http://www.paypal.com/cgi-bin/webscr\" method=\"post\"> 
			<!-- Identify your business so that you can collect the payments. --> 
			<input type=\"hidden\" name=\"business\" value=\"$pay_to_email\"> 
			<!-- Specify a Buy Now button. --> 
			<input type=\"hidden\" name=\"cmd\" value=\"_xclick\"> 
			<!-- Specify details about the item that buyers will purchase. --> 
			<input type=\"hidden\" name=\"item_name\" value=\"$item_title\"> 
			<input type=\"hidden\" name=\"item_number\" value=\"$item_number\"> 
			<input type=\"hidden\" name=\"amount\" value=\"$price\"> 
			<input type=\"hidden\" name=\"currency_code\" value=\"USD\"> 
			<!-- Display the payment button. --> 
			<input type=\"image\" name=\"submit\" border=\"0\" src=\"https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif\" alt=\"PayPal - The safer, easier way to pay online\"> 
			<img alt=\"\" border=\"0\" width=\"1\" height=\"1\" src=\"https://www.paypal.com/en_US/i/scr/pixel.gif\" > 
		</form>";
	}
}
	
if ( ! function_exists( 'create_item_number' ) )
{
	function create_item_number( $site_name, $is_new, $account_id = false )
	{
		if( $is_new )
			return "new:00:$site_name";
		else
			return "renew:$account_id:$site_name";
	}
}

if ( ! function_exists( 'info_from_item_number' ) )
{
	function info_from_item_number( $item_number )
	{
		$parts = explode(':', $item_number );
		return array( 'type' => $parts[0], 'account_id' => $parts[1], 'site_name' => $parts[2] );
	}
}

}
?>