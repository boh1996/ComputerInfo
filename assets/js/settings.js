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
		"identifier" : {"string" : "Identifier", "active" : true},
		"screen_size.detection_string" : {"string" : "Screen Size", "active" : true},
		"model.type.name" : {"string" : "Type", "active" : true},
		"model.name" : {"string" : "Model", "active" : true},
		"location.name" : {"string" : "Location", "active" : false},
		"lan_mac" : {"string" : "Lan Mac", "active" : false},
		"wifimac" : {"string" : "Wifi Mac", "active" : false},
		"ip" : {"string" : "Ip", "active" : false},
		"disk_space" : {"string" : "Disk", "active" : false},
		"ram_size" : {"string" : "Ram", "active" : false},
		"model.manufacturer.abbrevation" : {"string" : "Manufacturer", "active" : false},
		"serial" : {"string" : "Serial", "active" : false},
		//"screen_size.aspect_ratio" : {"string" : "Screen Aspect Ratio", "active" : false},
		//"processors.name" : {"string" : "CPU", "active" : false},
		//"cpu.cores" : {"string" : "CPU Cores", "active" : false},
		//"cpu.clock_rate" : {"string" : "CPU Clock Rate", "active" : false},
		//"cpu.manufacturer.name" : {"string" : "CPU Manufacturer", "active" : false},
		//"location.room_number" : {"string" : "Room Number", "active" : false},
		//"location.floor.name" : {"string" : "Floor Number", "active" : false},
		//"location.building.name" : {"string" : "Building Number", "active" : false},
		"power_usage_per_hour" : {"string" : "Power", "active" : false},
		"created_time" : {"string" : "Time created", "active" : false},
		"last_updated" : {"string" : "Last updated", "active" : false},
		"creator_user.name" : {"string" : "Creator", "active" : false},
		"last_updated_user.name" : {"string" : "Last updated by", "active" : false},
	},

	/**
	 * The available columns for the unit object
	 * @type {Object}
	 */
	unitColumns : {
		"identifier" : {"string" : "Identifier", "active" : true},
		"description" : {"string" : "Description", "active" : true},
		"model.name" : {"string" : "Model", "active" : true},
		"model.manufacturer.name" : {"string" : "Manufacturer", "active" : false},
		"model.type.name" : {"string" : "Type", "active" : false},
		"location.name" : {"string" : "Location", "active" : false},
		"created_time" : {"string" : "Time created", "active" : false},
		"serial" : {"string" : "Serial", "active" : false},
	},

	/**
	 * The available columns for the location object
	 * @type {Object}
	 */
	locationColumns : {
		"name" : {"string" : "Name", "active" : true},
		"room_number" : {"string" : "Room Number", "active" : true},
		"floor.name" : {"string" : "Floor", "active" : false},
		"building.name" : {"string" : "Building", "active" : false}
	},

	/**
	 * The available columns for the printer object
	 * @type {Object}
	 */
	printerColumns : {
		"identifier" : {"string" : "Identifier", "active" : true},
		"name" : {"string" : "Name", "active" : true},
		"model.name" : {"string" : "Model", "active" : true},
		"model.manufacturer.name" : {"string" : "Manufacturer", "active" : false},
		"location.name" : {"string" : "Location", "active" : true},
		"location.room_number" : {"string" : "Room Number", "active" : false},
	},

	/**
	 * The available columns for the screen object
	 * @type {Object}
	 */
	screenColumns : {
		"identifier" : {"string" : "Identifier", "active" : true},
		"location.name" : {"string" : "Location", "active" : true},
		"model.name" : {"string" : "Model", "active" : false},
		"model.manufacturer" : {"string" : "Manufacturer", "active" : false},
		"scren_size.detection_string" : {"string" : "Screen Size", "active" : false},
		"screen_size.aspect_ratio" : {"string" : "Aspect ratio", "active" : false},
	},

	/**
	 * Some optional handlers to use
	 * @type {Object}
	 */
	handlers : {}
}