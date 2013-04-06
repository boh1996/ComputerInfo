<?php
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
		$route["languages"] = "api/api_lists/languages";

	### Old ###
  	$route["options/(:any)"] = "api_old/options/$1";
	$route["manufaturer/(:any)"] = "api_old/manufaturer/$1";
?>