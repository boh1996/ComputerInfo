var application = {
	/**
	 * The units generator object
	 * @type {object}
	 */
	unitsGenerator : null,
	computerGenerator : null,
	locationGenerator : null,
	printerGenerator : null,
	screenGenerator : null,

	/**
	 * The current selected organization
	 * @type {integer}
	 */
	organization : null,

	/**
	 * The application settings object
	 * @type {object}
	 */
	settings : null,

	ready : 0,

	callback : null,

	/**
	 * This function initializes the computer info application
	 * @param  {integer} organization The current organization
	 * @param {function} callback An optional ready callback for the app
	 */
	initialize : function (organization,callback) {
		application.callback = callback;
		application.organization = organization;
		application.settings = new settings(organization);
		application.settings = application.settings;
		if (userInfo.getCookie("token") == undefined || userInfo.getCookie("token") == null) {
			window.location = root + "login";
			return;
		}
		userInfo.getInfo(root + "user/me",userInfo.getCookie("token"), function (data,status){ 
			if (status == "fail") {
				window.location = root + "login";
				return;
			}

			
			//Computers
			application.computerGenerator = new tableGenerator({
				requestType : "computer",
				container : $("#computer"),
				columns :application.settings.computerColumns,
				responseNode : "Computer",
				multipleResponseNode : "Computers",
				localStorageColumnsKey : "computer_columns",
				multipleRequestType : "computers",
				root : root,
				modal : $("#edit_computer"),
				localStorageLengthKey : "computer_length_value",
				handlers : {
					model_type :application.settings.handlers.device_type,
					model :application.settings.handlers.computer_model,
					screen_size :application.settings.handlers.screen_size,
					location :application.settings.handlers.location,
					manufacturer :application.settings.handlers.manufacturer
				},
				callback : application.readyCallback
			});
			application.computerGenerator.getNodes(organization);

			//Locations
			application.locationGenerator = new tableGenerator({
				requestType : "location",
				modal : $("#edit_location"),
				container : $("#location"),
				localStorageLengthKey : "location_length_value",
				columns :application.settings.locationColumns,
				responseNode : "Location",
				multipleResponseNode : "Locations",
				multipleRequestType : "locations",
				localStorageColumnsKey : "location_columns",
				root : root,
				handlers : {
					floor :application.settings.handlers.floor,
					building :application.settings.handlers.building
				},
				callback : application.readyCallback
			});
			application.locationGenerator.getNodes(organization);

			//Units
			application.unitsGenerator = new tableGenerator({
				requestType : "device",
				container : $("#unit"),
				modal : $("#edit_unit"),
				columns :application.settings.unitColumns,
				responseNode : "Device",
				multipleResponseNode : "Devices",
				multipleRequestType : "devices",
				root : root,
				localStorageColumnsKey : "unit_columns",
				localStorageLengthKey : "unit_length_value",
				handlers : {
					location :application.settings.handlers.location,
					model_type :application.settings.handlers.device_type,
					model :application.settings.handlers.device_model
				},
				callback : application.readyCallback
			});
			application.unitsGenerator.getNodes(organization);

			//Printers
			application.printerGenerator = new tableGenerator({
				modal : $("#edit_printer"),
				requestType : "printer",
				localStorageLengthKey : "printer_length_value",
				container : $("#printer"),
				columns :application.settings.printerColumns,
				responseNode : "Printer",
				multipleResponseNode : "Printers",
				localStorageColumnsKey : "printer_columns",
				multipleRequestType : "printers",
				root : root,
				handlers : {
					location :application.settings.handlers.location,
					model :application.settings.handlers.printer_model
				},
				callback : application.readyCallback
			});
			application.printerGenerator.getNodes(organization);

			//Screeens
			application.screenGenerator = new tableGenerator({
				requestType : "screen",
				modal : $("#edit_screen"),
				localStorageLengthKey : "screen_length_value",
				localStorageColumnsKey : "screen_columns",
				container : $("#screen"),
				columns :application.settings.screenColumns,
				responseNode : "Screen",
				multipleResponseNode : "Screens",
				multipleRequestType : "screens",
				root : root,
				handlers : {
					location :application.settings.handlers.location,
				},
				callback : application.readyCallback
			});
			application.screenGenerator.getNodes(organization);
			$(".dataTables_filter").find("input").addClass("input-large");
		});	 
	},

	readyCallback : function () {
		application.ready += 1;
		if (application.ready == 5) {
			if (typeof application.callback == "function") {
				application.callback();
			}
		}
	}
}