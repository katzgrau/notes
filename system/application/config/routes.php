<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

/* Reserved Routes */
$route['default_controller'] = "home";
$route['scaffolding_trigger'] = "";

/* These map to controllers that actually exist */
$route['users/(:any)$'] = "users/$1";
$route['sales/(:any)$'] = "sales/$1";
$route['api/(:any)$'] 	= "api/$1";
$route['admin/(:any)$'] = "admin/$1";
$route['home/(:any)$'] 	= "home/$1";
$route['ajax/(:any)$'] 	= "ajax/$1";
$route['author/(:any)$']= "author/$1";
$route['install/(:any)$']= "install/$1";
$route['help/(:any)$']	= "help/$1";

/* If we didn't hit a controller that really exists, we default to viewing a teacher's page */
$route['^(?!users|api|sales|help|install|admin|home|ajax|author).*'] = "view/site/$0";
#$route['(:any)$'] 			= "view/site/$1"; // This wasn't working so well.

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */