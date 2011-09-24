<?php

if( ! function_exists('get_news_items_array') )
{
	function get_news_items_array()
	{
		$CI = &get_instance();
		$CI->load->model('dictionary');
		
		$key_name 			= config_item('news_strategy_dictionary_entry');
		$cache_expiration 	= config_item('news_strategy_cache_expiration_minutes');
		$news 				= $CI->dictionary->GetByMinutesOld( $key_name, $cache_expiration );
		
		if( $news ) return unserialize( $news );
		
		$CI->load->helper('utilities');
		
		$twitter_name 	= config_item('news_strategy_service_user');
		$fetch_count 	= config_item('news_strategy_fetch_count');
		$twitter_url = "http://twitter.com/statuses/user_timeline.json?screen_name=$twitter_name&count=$fetch_count";

		/* Get the news from twitter */
		$news = json_decode( fetch_page_curl( $twitter_url ) );
		
		/* A bad result was retreived from twitter. Abort. */
		if( ! is_array( $news ) ) return array();
		
		/* Store the news object for easy retrieval later */
		$CI->dictionary->Set( $key_name, serialize( $news ) );
		
		return $news;
	}
}

if( ! function_exists('get_news_item_url') )
{
	function get_news_item_url($item_id)
	{
		$twitter_name 	= config_item('news_strategy_service_user');
		return "http://twitter.com/$twitter_name/statuses/$item_id";
	}
}

?>