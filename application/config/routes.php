<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH."helpers/ci_helper.php");

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

########### New Api Routes ###################

$route["update/codeigniter/check"] = "api/api_codeigniter/version_check";
$route["update/codeigniter/version"] = "api/api_codeigniter/version";
$route["update/codeigniter/remote"] = "api/api_codeigniter/remote_version";

##############################################

$route["logout"] = "login/logout";
$route["login/windows"] = "login/desktop/windows";
$route["windows/logout"] = "login/token/logout/windows";
$route["login/windows/google"] = "login/google/auth/windows";
$route["windows/login"] = "windows_login";
$route["login/device"] = "login/device";
$route["device/logout"] = "login/token/logout";
$route["login/device/google"] = "login/device/google";

if ( is_ajax() || (isset($_GET["dev"]) && $_GET["dev"] == "true") || is_application() ) {
	############ Computer ##############
		if ( is_windows() ) {
			$route["computer"] = "api/api_computer_client/index";
		} else {
			$route["computer"] = "api/api_computer/index";
		}

		$route["computer/(:num)"] = "api/api_computer/index/$1";

	########## Token #############
		$route["token/(:any)"] = "api/api_token/token/$1";

	########## Printer ###########
		$route["printer"] = "api/api_printer/index";
		$route["printer/(:num)"] = "api/api_printer/index/$1";

	########## Device  ###########
		$route["device"] = "api/api_device/index";
		$route["device/(:num)"] = "api/api_device/index/$1";

	### Old ###
  	$route["options/(:any)"] = "api_old/options/$1";
	$route["printer/model"] = "api_old/printer_model";
	$route["printer/model/(:num)"] = "api_old/printer_model/$1";
	$route["printer/model/search"] = "api_old/printer/model/search";
	$route["printer/search"] = "api_old/printer/search";
	$route["computers/timestamps/(:num)"] = "api_old/computers/timestamps/$1";
	$route["screen/(:num)"] = "api_old/screen/$1";
	$route["computer/model/(:num)"] = "api_old/computer/model/$1";
	$route["computer/search"] = "api_old/computer/search";
	$route["location/(:num)"] = "api_old/location/$1";
	$route["computers/select"] = "api_old/computers_select";
	$route["computer/model"] = "api_old/computer_model";
	$route["device/model"] = "api_old/device_model";
	$route["device/model/search"] = "api_old/device/model/search";
	$route["manufaturer/(:any)"] = "api_old/manufaturer/$1";
	$route["manufaturer/search"] = "api_old/manufaturer/search";
	$route["cpu/(:any)"] = "api_old/cpu/$1";
	$route["user/settings"] = "api_old/user_settings";
	$route["user/(:any)"] = "api_old/user/$1";
	$route["computers/(:num)"] = "api_old/get/computers/$1";
	$route["devices/(:num)"] = "api_old/get/devices/$1";
	$route["printers/(:num)"] = "api_old/get/printers/$1";
	$route["screens/(:num)"] = "api_old/get/screens/$1";
	$route["locations/(:num)"] = "api_old/get/locations/$1";
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
	if ( ! empty($_POST["username"]) ) {
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