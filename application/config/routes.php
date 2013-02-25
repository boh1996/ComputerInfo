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
$whitelist = array("localhost","127.0.0.1","176.34.227.131");
if (in_array(trim($_SERVER["REMOTE_ADDR"]),$whitelist)) {
	$route["update/codeigniter/check"] = "api/codeigniter_version_check"; //Returns true if CodeIgniter should be updated
	$route["update/codeigniter/version"] = "api/ci/version"; //The Ser CodeIgniter version
	$route["update/codeigniter/remote"] = "api/ci_version_remote"; //The newest CodeIgnitor Version
}

/**
 * Api Routes
 */
$route["login/windows"] = "login/desktop/windows";
$route["windows/logout"] = "login/token/logout/windows";
$route["login/windows/google"] = "login/google/auth/windows";
$route["windows/login"] = "windows_login";
$route["login/device"] = "login/device";
$route["device/logout"] = "login/token/logout";
$route["login/device/google"] = "login/device/google";

if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || (isset($_GET["dev"]) && $_GET["dev"] == "true") || (isset($_SERVER["HTTP_USER_AGENT"]) && $_SERVER["HTTP_USER_AGENT"] == "CI/Windows")) {
  	header("CI-API: true");
  	$route["computer"] = "api/computer";
  	$route["options/(:any)"] = "api/options/$1";
	$route["printer/model"] = "api/printer_model";
	$route["printer/model/(:num)"] = "api/printer_model/$1";
	$route["printer/model/search"] = "api/printer/model/search";
	$route["printer/(:num)"] = "api/printer/$1";
	$route["printer"] = "api/printer";
	$route["printer/search"] = "api/printer/search";
	$route["computers/timestamps/(:num)"] = "api/computers/timestamps/$1";
	$route["screen/(:num)"] = "api/screen/$1";
	$route["computer/(:num)"] = "api/computer/$1";
	$route["computer/model/(:num)"] = "api/computer/model/$1";
	$route["computer/search"] = "api/computer/search";
	$route["device/(:num)"] = "api/device/$1";
	$route["device"] = "api/device";
	$route["location/(:num)"] = "api/location/$1";
	$route["computer/model"] = "api/computer_model";
	$route["device/model"] = "api/device_model";
	$route["device/model/search"] = "api/device/model/search";
	$route["token"] = "api/generate_token";
	$route["token/(:any)"] = "api/token/$1";
	$route["manufaturer/(:any)"] = "api/manufaturer/$1";
	$route["manufaturer/search"] = "api/manufaturer/search";
	$route["cpu/(:any)"] = "api/cpu/$1";
	$route["logout"] = "login/logout";
	$route["user/settings"] = "api/user_settings";
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
	$route["home"] = "home";
	$route["logout/reset"] = "login/reset";
	$route["home/login"] = "home";
	$route["translate/(:any)"] = "translations/file/$1";
	$route["users/sign_up"] = "user_management/register";
	$route["user/register/check"] = "user_management/check";
	$route["user/register/delete/(:any)"] = "user_management/delete/$1";
	$route["user/activate/resend/(:any)"] = "user_management/resend/$1";
	$route["user/activate/(:any)"] = "user_management/activate/$1";
	$route["user/password/new/check"] = "user_management/reset_password_check";
	$route["user/reset/password"] = "user_management/forgot_password";
	$route["user/remove/new/password/(:any)"] = "user_management/remove_new_password/$1";
	$route["user/reset/password/resend/(:any)"] = "user_management/password_resend/$1";
	$route["user/reset/password/check"] = "user_management/reset_password";
	$route["user/reset/password/new/(:any)"] = "user_management/create_new_password/$1";
	if (!empty($_POST["username"])) {
		$route["login/check"] = "login/enter";
	} else {
		$route["logout"] = "login/logout";
		$route["login/enter"] = "ui";
		$route["login/check"] = "login/redirect";
		$route["login/(:any)"] = "login/$1";
		$route["login"] = "login";
	}
	$route["(:any)"] = "ui/$1";
	$route["(:any)/(:any)"] = "ui/$1/$2";
}
/**
 * Standard routes
 */
$route['default_controller'] = "ui";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */