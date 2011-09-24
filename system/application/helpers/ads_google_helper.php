<?php

if ( ! function_exists('get_left_skyscraper'))
{
	function get_left_skyscraper( $position = 'center' )
	{
		if( config_item('ads_enabled') && get_ad_config( 'left_skyscraper' ) )
			return generate_ad( '<img src="https://www.google.com/adsense/static/en_US/images/skyscraper.gif" />', $position );
		else
			return '';
	}
}

if ( ! function_exists('get_right_skyscraper'))
{
	function get_right_skyscraper( $position = 'center' )
	{
		if( config_item('ads_enabled') && get_ad_config ( 'right_skyscraper' ) )
			return generate_ad( '<img src="https://www.google.com/adsense/static/en_US/images/skyscraper.gif" />', $position );
		else
			return '';
	}
}

if ( ! function_exists('get_top_banner') )
{
	function get_top_banner( $position = 'center' )
	{
		if( config_item('ads_enabled') && get_ad_config('top_banner') )
			return generate_ad( '<img src="https://www.google.com/adsense/static/en_US/images/banner.gif" />', $position );
		else
			return '';
	}
}

if ( ! function_exists('get_bottom_banner'))
{
	function get_bottom_banner( $position = 'center' )
	{
		if( config_item('ads_enabled') && get_ad_config('bottom_banner') )
			return generate_ad( '<img src="https://www.google.com/adsense/static/en_US/images/banner.gif" />', $position );
		else
			return '';
	}
}

if ( ! function_exists('get_square_1'))
{
	function get_square_1( $position = 'center' )
	{
		if( config_item('ads_enabled') && get_ad_config('square_1') )
			return generate_ad( '<img src="https://www.google.com/adsense/static/en_US/images/200x200_text.gif" />', $position );
		else
			return '';
	}
}

if ( ! function_exists('get_square_2'))
{
	function get_square_2( $position = 'center' )
	{
		if( config_item('ads_enabled') && get_ad_config('square_2') )
			return generate_ad( '<img src="https://www.google.com/adsense/static/en_US/images/200x200_text.gif" />', $position );
		else
			return '';
	}
}


if ( ! function_exists('generate_ad'))
{
	function generate_ad( $markup, $position )
	{
		switch( $position )
		{
			case 'center':
				return "<center>$markup</center>";
				break;
			case 'left':
				return "<div style=\"float:left\">$markup</div>";
				break;
			case 'right':
				return "<div style=\"float:right\">$markup</div>";
				break;
			default:
				return '';
				break;
		}
	}
}

if( ! function_exists('get_ad_config') )
{
	function get_ad_config( $key )
	{
		$conf = config_item('ads_config');
		return $conf[$key];
	}
}


?>