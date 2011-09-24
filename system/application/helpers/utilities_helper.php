<?php 

if ( ! function_exists('fe_resource_base') )
{
    function fe_resource_base()
    {
        return base_url().'front-end/static/';
    }
}

if ( ! function_exists('fe_view_path') )
{
    function fe_view_path()
    {
        return config_item('web_root').'front-end/views/';
    }
}



if ( ! function_exists( 'is_valid_sitename' ) )
{
	function is_valid_sitename( $name )
	{
		$inv_names = config_item('invalid_sitenames');
		
		return preg_match( "/^~?[a-zA-Z0-9]+([\._\\-~][a-zA-Z0-9]+)*$/", $name ) == 1 &&
			   ! $inv_names[$name] &&
			   strlen( $name ) <= config_item('max_sitename_length'); 
	}
}

if ( ! function_exists( 'is_logged_in' ) )
{
	function is_logged_in()
	{
		$CI = get_instance();
		
		return ($CI->session->userdata('user_id') ? true : false);
	}
}

if( ! function_exists( 'is_valid_phpdate' ) )
{
	function is_valid_phpdate( $date )
	{
		return preg_match( "/^[0-9][0-9][0-9][0-9]\-[0-1][0-9]\-[0-1][0-9]$/", $date ) == 1;
	}
}

if( ! function_exists( 'get_current_date_plus_years' ) )
{
	function get_current_date_plus_years( $years )
	{
		$date = date('Y-m-d H:i:s');	
		return date( 'Y-m-d', strtotime( "$date +$years years" ));
	}
}

if( ! function_exists('parse_into_mysql_datetime') )
{
	function parse_into_mysql_datetime( $string )
	{
		return date( 'Y-m-d', strtotime( $string ));		
	}
}

if( ! function_exists('format_date') )
{
	function format_date( $format, $date )
	{
		return date( $format, strtotime( $date ) );
	}
}

if( !function_exists('fetch_page') )
{
	function fetch_page($url)
	{
		/* get hostname and path */
		$host = parse_url($url, PHP_URL_HOST);
		$path = parse_url($url, PHP_URL_PATH);

		if (empty($path)) {
			$path = "/";
		}

		/* Build HTTP 1.0 request header. Defined in RFC 1945 */
		$headers = "GET $path HTTP/1.0\r\n"
				 . "User-Agent: myHttpTool/1.0\r\n\r\n";
	  
		/* open socket connection to remote host on port 80 */
		$fp = fsockopen($host, 80, $errno, $errmsg, 30);

		if (!$fp) {
			/* ...some error handling... */
			return false;
		}

		/* send request headers */
		fwrite($fp, $headers);
		/* read response */

		while(!feof($fp)) {
			$resp .= fgets($fp, 4096);
		}

		fclose($fp);
		
		/* separate header and body */
		$neck = strpos($resp, "\r\n\r\n");
		$head = substr($resp, 0, $neck);
		$body = substr($resp, $neck+4);

		/* omit parsing response headers */
		/* return page contents */

		return($body);
	}
}

if( !function_exists('fetch_page_curl') )
{
	function fetch_page_curl( $url )
	{
		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );

		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $content;
	}
}

?>