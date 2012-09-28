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
|	example.com/class/method/id/
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/**
 * Api Routes
 */
if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || (isset($_GET["dev"]) && $_GET["dev"] == "true")) {
  	$route["computer"] = "api/computer";
  	$route["options/(:any)"] = "api/options/$1";
	$route["printer/model"] = "api/printer_model";
	$route["printer/model/(:num)"] = "api/printer_model/$1";
	$route["printer/model/search"] = "api/printer/model/search";
	$route["printer/(:num)"] = "api/printer/$1";
	$route["printer"] = "api/printer";
	$route["printer/search"] = "api/printer/search";
	$route["computer/(:num)"] = "api/computer/$1";
	$route["computer"] = "api/computer";
	$route["computer/model/(:num)"] = "api/computer/model/$1";
	$route["computer/search"] = "api/computer/search";
	$route["device/(:num)"] = "api/device/$1";
	$route["device"] = "api/device";
	$route["computer/model"] = "api/computer_model";
	$route["device/model"] = "api/device_model";
	$route["device/model/search"] = "api/device/model/search";
	$route["token"] = "api/generate_token";
	$route["token/(:any)"] = "api/token/$1";
	$route["manufaturer/(:any)"] = "api/manufaturer/$1";
	$route["manufaturer/search"] = "api/manufaturer/search";
	$route["cpu/(:any)"] = "api/cpu/$1";
	$route["logout"] = "login/logout";
	$route["user/(:any)"] = "api/user/$1";
	$route["get/computers/(:num)"] = "api/get/computers/$1";
	$route["get/devices/(:num)"] = "api/get/devices/$1";
	$route["get/printers/(:num)"] = "api/get/printers/$1";
	$route["get/screens/(:num)"] = "api/get/screens/$1";
	$route["get/locations/(:num)"] = "api/get/locations/$1";
	$route["client/computer"] = "api/computer_client";
	$route["token/$1"] = "api/token/$1";
} 
/**
 * User Routes
 */
else {
	if(isset($_GET["normal"]) && $_GET["normal"] == "true"){
		//Normal Routes
	} else {
		$route["home"] = "home";
		var_dump(!empty($_POST["username"]));
		die();
		if (!empty($_POST["username"])) {
			$route["login/check"] = "login/enter";
			$route["login/device"] = "login/device";
		} else {
			$route["logout"] = "login/logout";
			$route["login/device"] = "ui";
			$route["login/enter"] = "ui";
			$route["login/check"] = "login";
			$route["login/(:any)"] = "login/$1";
			$route["login"] = "login";
		}
		$route["(:any)"] = "ui/$1";
	}
	
}
/**
 * Standard routes
 */
$route['default_controller'] = "ui";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */