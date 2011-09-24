<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
                                'class'    => 'PluginStarter',
                                'function' => 'StartPlugins',
                                'filename' => 'hooks.classes.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );
								
$hook['post_controller_constructor'][] = array(
                                'class'    => 'ProfilerEnabler',
                                'function' => 'EnableProfiler',
                                'filename' => 'hooks.classes.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

?>