<?php

if( ! function_exists('get_super_instance') )
{
	function &get_super_instance()
	{
		return get_instance();
	}
}

if( ! function_exists('initialize_plugin_helper') )
{
	function initialize_plugin_helper()
	{
		$CI = &get_instance();
		$CI->load->library('plugin_tools');
		$CI->load->helper('file');
		
		$GLOBALS['pi_hooks'] = array();
		
		$pi_root 		= config_item('plugins_root');
		$plugin_files 	= get_filenames( $pi_root );
		
		foreach( $plugin_files as $file )
		{
			require_once( $pi_root . $file );
			
			$class_name = str_replace( '.php', '', $file );
			
			if( class_exists( $class_name ) )
			{
				$o = new $class_name;
				
				if( method_exists( $o, 'Initialize' ) )
				{
					// Give the plugin the power!
					$o->Initialize( $CI->plugin_tools );
				}
			}	
		}
	}
}

if( ! function_exists('register_hook') )
{
	function register_hook( $hook_name, &$object, $callback )
	{	
		if( ! is_array( $GLOBALS['pi_hooks'][$hook_name] ) )
			$GLOBALS['pi_hooks'][$hook_name] = array();
			
		$GLOBALS['pi_hooks'][$hook_name][] = array( 'object' => &$object, 'callback' => $callback );
	}
}

if( ! function_exists('call_plugin_hook') )
{
	function call_plugin_hook( $hook_name, &$args = array() )
	{
		$handlers = &$GLOBALS['pi_hooks'][$hook_name];
		
		if( is_array( $handlers ) )
		{
			foreach( $handlers as $handler )
			{
				$o = &$handler['object'];
				$c =  $handler['callback'];
				
				if( method_exists( $o, $c ) )
				{
					$o->$c( $args );
				}
			}
		}
	}
}

?>