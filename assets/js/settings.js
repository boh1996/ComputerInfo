var settings = {

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
		"model.manufacturer.abbrevation" : {"string" : "Model Manufacturer", "active" : false},
		"serial" : {"string" : "Serial", "active" : false},
		"screen_size.aspect_ratio" : {"string" : "Screen Aspect Ratio", "active" : false},
		"cpu.name" : {"string" : "CPU", "active" : false},
		"cpu.cores" : {"string" : "CPU Cores", "active" : false},
		"cpu.clock_rate" : {"string" : "CPU Clock Rate", "active" : false},
		"cpu.manufacturer.name" : {"string" : "CPU Manufacturer", "active" : false},
		"location.room_number" : {"string" : "Room Number", "active" : false},
		"location.floor.name" : {"string" : "Floor Number", "active" : false},
		"location.building.name" : {"string" : "Building Number", "active" : false},
		"power_usage_per_hour" : {"string" : "Power", "active" : false},
		"created_time" : {"string" : "Time created", "active" : false},
		//"screen_size.abbrevation" : {"string" : "Screen Size Abbrevation", "active" : false},
		//"operating_system.version" : {"string" : "OS Version", "active" : false},
		//"operating_system.family.manufacturer.name" : {"string" : "OS Manufacturer", "active" : false},
		//"screen_size.name" : {"string" : "Screen Size Name", "active" : false},
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
	}
}