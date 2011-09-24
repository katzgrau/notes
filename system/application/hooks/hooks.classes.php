<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PluginStarter
{
	function StartPlugins()
	{
		if( config_item('plugins_enabled') )
		{
			$CI = &get_instance();
			$CI->load->helper('plugin');
			initialize_plugin_helper();
		}
		else
		{
			/* Load a dummy function for the generic plugin call, so calls won't break the application */
			eval("function call_plugin_hook() {}");
		}
	}
}

class ProfilerEnabler
{
	function EnableProfiler()
	{
		$CI = &get_instance();
		$CI->output->enable_profiler( config_item('enable_profiling') );
	}
}

?>