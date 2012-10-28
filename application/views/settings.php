function settings (organization) {
	this.organization = organization;
	this.handlers = {
		screen_size : {
			url : root + "options/screen_size",
			property : "detection_string",
			response_key : "Screen_Sizes"
		},
		floor : {
			fill_values : {
				"building" : ".building_select"
			},
			url : root + "options/floor",
			query_parameters : {
				"organization" : this.organization
			},
			property : "name",
			query_key : "name",
			type : "typeahead",
			response_key : "Floors"
		},
		location : {
			url : root + "options/location?organization=" + this.organization,
			property : "name",
			response_key : "Locations"
		},
		manufacturer : {	
			url : root + "options/manufacturer",
			query_key : "name",
			property : "name",
			type : "typeahead",
			response_key : "Manufacturers"
		},
		device_type : {
			url : root + "options/device_type",
			property : "name",
			response_key : "Device_Types"
		},
		computer_model : {
			url : root + "options/computer_model",
			property : "name",
			query_key : "name",
			fill_values : {
				"type" : ".type_select"
			},
			type : "typeahead",
			response_key : "Computer_Models"
		},
		device_model : {
			url : root + "options/device_model",
			property : "name",
			query_key : "name",
			fill_values : {
				"type" : ".type_select"
			},
			type : "typeahead",
			response_key : "Device_Models"
		},
		printer_model : {
			url : root + "options/printer_model",
			property : "name",
			query_key : "name",
			type : "typeahead",
			response_key : "Printer_Models"
		},
		building : {
			url : root + "options/building?organization="+this.organization,
			property : "name",
			response_key : "Buildings"
		}
	}
}
settings.prototype = {

	/**
	 * The current organization
	 * @type {Number}
	 */
	organization : null,

	/**
	 * The available columns for the computers
	 * @type {Object}
	 */
	computerColumns : {	
		"identifier" : {"string" : "<?php echo $this->lang->line("ui_table_identifier");  ?>", "active" : true},
		"screen_size.detection_string" : {"string" : "<?php echo $this->lang->line("ui_table_screen_size_detection_string");  ?>", "active" : true},
		"model.type.name" : {"string" : "<?php echo $this->lang->line("ui_table_model_type_name");  ?>", "active" : true},
		"model.name" : {"string" : "<?php echo $this->lang->line("ui_table_model_name");  ?>", "active" : true},
		"location.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_name");  ?>", "active" : false},
		"lan_mac" : {"string" : "<?php echo $this->lang->line("ui_table_lan_mac");  ?>", "active" : false},
		"wifimac" : {"string" : "<?php echo $this->lang->line("ui_table_wifi_mac");  ?>", "active" : false},
		"ip" : {"string" : "<?php echo $this->lang->line("ui_table_ip");  ?>", "active" : false},
		"disk_space" : {"string" : "<?php echo $this->lang->line("ui_table_disk_space");  ?>", "active" : false},
		"memory.total_physical_memory" : {"string" : "<?php echo $this->lang->line("ui_table_total_memory");  ?>", "active" : true},
		"model.manufacturer.abbrevation" : {"string" : "<?php echo $this->lang->line("ui_table_manufacturer_abbrevation");  ?>", "active" : false},
		"serial" : {"string" : "<?php echo $this->lang->line("ui_table_serial");  ?>", "active" : false},
		//"screen_size.aspect_ratio" : {"string" : "<?php echo $this->lang->line("ui_table_screen_size_aspect_ration");  ?>", "active" : false},
		//"processors.name" : {"string" : "<?php echo $this->lang->line("ui_table_processor_name");  ?>", "active" : false},
		//"cpu.cores" : {"string" : "<?php echo $this->lang->line("ui_table_cpu_cores");  ?>", "active" : false},
		//"cpu.clock_rate" : {"string" : "<?php echo $this->lang->line("ui_table_cpu_clock_rate");  ?>", "active" : false},
		//"cpu.manufacturer.name" : {"string" : "<?php echo $this->lang->line("ui_table_cpu_manufacturer_name");  ?>", "active" : false},
		//"location.room_number" : {"string" : "<?php echo $this->lang->line("ui_table_location_room_number");  ?>", "active" : false},
		//"location.floor.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_floor_name");  ?>", "active" : false},
		//"location.building.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_building_name");  ?>", "active" : false},
		"power_usage_per_hour" : {"string" : "<?php echo $this->lang->line("ui_table_power_usage");  ?>", "active" : false},
		"created_time" : {"string" : "<?php echo $this->lang->line("ui_table_created_time");  ?>", "active" : true},
		"last_updated" : {"string" : "<?php echo $this->lang->line("ui_table_last_updated");  ?>", "active" : false},
		"creator_user.name" : {"string" : "<?php echo $this->lang->line("ui_table_creator_user_name");  ?>", "active" : false},
		"last_updated_user.name" : {"string" : "<?php echo $this->lang->line("ui_table_last_updated_user_name");  ?>", "active" : false},
	},

	/**
	 * The available columns for the unit object
	 * @type {Object}
	 */
	unitColumns : {
		"identifier" : {"string" : "<?php echo $this->lang->line("ui_table_identifier");  ?>", "active" : true},
		"description" : {"string" : "<?php echo $this->lang->line("ui_table_description");  ?>", "active" : true},
		"model.name" : {"string" : "<?php echo $this->lang->line("ui_table_model_name");  ?>", "active" : true},
		"model.manufacturer.name" : {"string" : "<?php echo $this->lang->line("ui_table_manufacturer_name");  ?>", "active" : false},
		"model.type.name" : {"string" : "<?php echo $this->lang->line("ui_table_model_type_name");  ?>", "active" : false},
		"location.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_name");  ?>", "active" : false},
		"created_time" : {"string" : "<?php echo $this->lang->line("ui_table_created_time");  ?>", "active" : false},
		"serial" : {"string" : "<?php echo $this->lang->line("ui_table_serial");  ?>", "active" : false},
	},

	/**
	 * The available columns for the location object
	 * @type {Object}
	 */
	locationColumns : {
		"name" : {"string" : "<?php echo $this->lang->line("ui_table_name");  ?>", "active" : true},
		"room_number" : {"string" : "<?php echo $this->lang->line("ui_table_location_room_number");  ?>", "active" : true},
		"floor.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_floor_name");  ?>", "active" : false},
		"building.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_building_name");  ?>", "active" : false}
	},

	/**
	 * The available columns for the printer object
	 * @type {Object}
	 */
	printerColumns : {
		"identifier" : {"string" : "<?php echo $this->lang->line("ui_table_identifier");  ?>", "active" : true},
		"name" : {"string" : "<?php echo $this->lang->line("ui_table_name");  ?>", "active" : true},
		"model.name" : {"string" : "<?php echo $this->lang->line("ui_table_model_name");  ?>", "active" : true},
		"model.manufacturer.name" : {"string" : "<?php echo $this->lang->line("ui_table_manufacturer_name");  ?>", "active" : false},
		"location.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_name");  ?>", "active" : true},
		"location.room_number" : {"string" : "<?php echo $this->lang->line("ui_table_location_room_number");  ?>", "active" : false},
	},

	/**
	 * The available columns for the screen object
	 * @type {Object}
	 */
	screenColumns : {
		"identifier" : {"string" : "<?php echo $this->lang->line("ui_table_identifier");  ?>", "active" : true},
		"location.name" : {"string" : "<?php echo $this->lang->line("ui_table_location_name");  ?>", "active" : true},
		"model.name" : {"string" : "<?php echo $this->lang->line("ui_table_model_name");  ?>", "active" : false},
		"model.manufacturer.name" : {"string" : "<?php echo $this->lang->line("ui_table_manufacturer_name");  ?>", "active" : false},
		"scren_size.detection_string" : {"string" : "<?php echo $this->lang->line("ui_table_screen_size_detection_string");  ?>", "active" : false},
		"screen_size.aspect_ratio" : {"string" : "<?php echo $this->lang->line("ui_table_screen_size_aspect_ratio");  ?>", "active" : false},
	},

	tableGeneratorTranslations : {
		"error_encountered" : "<?php echo $this->lang->line("ui_table_error_encountered");  ?>",
		"no_ressource_found" : "<?php echo $this->lang->line("ui_table_no_ressource_found");  ?>",
		"are_you_sure" : "<?php echo $this->lang->line("ui_table_are_you_sure");  ?>",
		"cancel" : "<?php echo $this->lang->line("ui_table_cancel");  ?>",
		"yes" : "<?php echo $this->lang->line("ui_table_yes");  ?>",
		"confirm_delete_object" : "<?php echo $this->lang->line("ui_table_confirm_delete_object");  ?>",
		"edit" : "<?php echo $this->lang->line("ui_table_edit");  ?>",
		"delete" : "<?php echo $this->lang->line("ui_table_delete");  ?>",
		"fields" : "<?php echo $this->lang->line("ui_table_fields");  ?>"
	},

	/**
	 * Some optional handlers to use
	 * @type {Object}
	 */
	handlers : {}
}