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

	########## Computer Model ####
		$route["computer/model/(:num)"] = "api/api_computer_model/index/$1";
		$route["computer/model"] = "api/api_computer_model/index";

	########## Printer ###########
		$route["printer"] = "api/api_printer/index";
		$route["printer/(:num)"] = "api/api_printer/index/$1";

	########## Device  ###########
		$route["device"] = "api/api_device/index";
		$route["device/(:num)"] = "api/api_device/index/$1";

	########## Decice Type #######
		$route["device/type"] = "api/api_device_type/index";
		$route["device/type/(:num)"] = "api/api_device_type/index/$1";

	########## Location ##########
		$route["location"] = "api/api_location/index";
		$route["location/(:num)"] = "api/api_location/index/$1";

	########## User     ##########
		$route["user/me"] = "api/api_user/me";
		$route["user"] = "api/api_user/index";
		$route["user/(:num)"] = "api/api_user/index/$1";

	########## Screen   ##########
		$route["screen"] = "api/api_screen/index";
		$route["screen/(:num)"] = "api/api_screen/index/$1";

	########## Computers #########
		$route["computers/(:num)"] = "api/api_organization/computers/$1";

	########## Devices   #########
		$route["devices/(:num)"] = "api/api_organization/devices/$1";

	########## Printers  #########
		$route["printers/(:num)"] = "api//api_organization/printers/$1";

	########## Screens   #########
		$route["screens/(:num)"] = "api/api_organization/screens/$1";

	########## Locations #########
		$route["locations/(:num)"] = "api/api_organization/locations/$1";

	########## Floors ############
		$route["floors/(:num)"] = "api/api_organization/floors/$1";

	########## Buildings #########
		$route["buildings/(:num)"] = "api/api_organization/buildings/$1";

	########## Data Endpoint #####
		$route["manufacturers"] = "api/api_lists/data_endpoint/manufacturers";
		$route["printer/models"] = "api/api_lists/data_endpoint/printer_models";
		$route["computer/models"] = "api/api_lists/data_endpoint/computer_models";
		$route["device/models"] = "api/api_lists/data_endpoint/device_models";
		$route["screen/models"] = "api/api_lists/data_endpoint/screen_models";
		$route["device/categories"] = "api/api_lists/data_endpoint/device_categories";
		$route["processor/models"] = "api/api_lists/data_endpoint/processor_models";
		$route["screen/sizes"] = "api/api_lists/data_endpoint/screen_sizes";
		$route["graphics/card/model"] = "api/api_lists/data_endpoint/graphics_card_models";
		$route["physical/drive/models"] = "api/api_lists/data_endpoint/physical_drive_models";
		$route["operating/system/editions"] = "api/api_lists/data_endpoint/operating_system_editions";
		$route["operating/system/versions"] = "api/api_lists/data_endpoint/operating_system_versions";
		$route["computer/series"] = "api/api_lists/data_endpoint/computer_series";
		$route["operating/systems"] = "api/api_lists/data_endpoint/operating_systems";
		$route["operating/systen/families"] = "api/api_lists/data_endpoint/operating_system_families";
		$route["operating/system/cores"] = "api/api_lists/data_endpoint/operating_system_cores";
		$route["screen/series"] = "api/api_lists/data_endpoint/screen_series";
		$route["processor/families"] = "api/api_lists/data_endpoint/processor_families";
		$route["processor/architectures"] = "api/api_lists/data_endpoint/processor_architectures";
		$route["drive/types"] = "api/api_lists/data_endpoint/drive_types";
		$route["network/card/adapters"] = "api/api_lists/data_endpoint/network_card_adapters";
		$route["video/architectures"] = "api/api_lists/data_endpoint/video_architectures";
		$route["screen/pixel/types"] = "api/api_lists/data_endpoint/screen_pixel_types";
		$route["printer/capabilities"] = "api/api_lists/data_endpoint/printer_capabilities";

	### Old ###
  	$route["options/(:any)"] = "api_old/options/$1";
	$route["manufaturer/(:any)"] = "api_old/manufaturer/$1";
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
	$route["user/settings"] = "user_management/update_user_settings";
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