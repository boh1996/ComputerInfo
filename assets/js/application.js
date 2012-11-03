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

	generators : {},

	/**
	 * The application settings object
	 * @type {object}
	 */
	settings : null,

	ready : 0,

	initializeCallback : null,

	/**
	 * Loaded callback
	 * @type {function}
	 */
	doneCallback : null,

	current : null,

	language : null,

	/**
	 * If the callback should be fired when the first element is done
	 * @type {Boolean}
	 */
	callbackOnFirst : false,

	/**
	 * This function adds a active geneerator to the list of generators
	 * @param {object} object The tableGenerator object
	 * @param {string} name   The name of the generator
	 */
	addGenerator : function (object, name) {
		this.generators[name] = object;
	},



	/**
	 * This function initializes the computer info application
	 * @param  {integer} organization The current organization
	 * @param {function} initializeCallback An optional initializeCallback for the app
	 * @param {function} doneCallback The function to call when all things have been loaded
	 * @param {string} language The users language
	 */
	initialize : function (organization,initializeCallback,doneCallback,language) {
		application.initializeCallback = initializeCallback;
		application.doneCallback = doneCallback;
		application.organization = organization;
		application.settings = new settings(organization);
		application.language = language;
		application.settings = application.settings;
		if (userInfo.getCookie("token") == undefined || userInfo.getCookie("token") == null) {
			window.location = root + "home/login";
			return;
		}
		userInfo.getInfo(root + "user/me",userInfo.getCookie("token"), function (data,status){ 
			if (status == "fail") {
				window.location = root + "logout/reset";
				return;
			}
			
			//Computers
			application.computerGenerator = new tableGenerator({
				requestType : "computer",
				container : $("#computer"),
				addModalId : "add_computer",
				columns :application.settings.computerColumns,
				responseNode : "Computer",
				multipleResponseNode : "Computers",
				localStorageColumnsKey : "computer_columns",
				multipleRequestType : "computers",
				root : root,
				translations : settings.tableGeneratorTranslations,
				languageFile : datatables_translations,
				modal : $("#edit_computer"),
				localStorageLengthKey : "computer_length_value",
				handlers : {
					model_type :application.settings.handlers.device_type,
					model :application.settings.handlers.computer_model,
					screen_size :application.settings.handlers.screen_size,
					location :application.settings.handlers.location,
					manufacturer :application.settings.handlers.manufacturer
				},
				callback : function () {
					application.readyCallback("computerGenerator");
				}
			});
			//application.addGenerator(application.computerGenerator,"computerGenerator");

			//Locations
			application.locationGenerator = new tableGenerator({
				requestType : "location",
				modal : $("#edit_location"),
				container : $("#location"),
				addModalId : "add_location",
				localStorageLengthKey : "location_length_value",
				columns :application.settings.locationColumns,
				languageFile : datatables_translations,
				responseNode : "Location",
				multipleResponseNode : "Locations",
				multipleRequestType : "locations",
				localStorageColumnsKey : "location_columns",
				root : root,
				translations : settings.tableGeneratorTranslations,
				handlers : {
					floor :application.settings.handlers.floor,
					building :application.settings.handlers.building
				},
				callback : function () {
					application.readyCallback("locationGenerator");
				}
			});
			//application.addGenerator(application.locationGenerator,"locationGenerator");

			//Units
			application.unitsGenerator = new tableGenerator({
				requestType : "device",
				container : $("#unit"),
				modal : $("#edit_unit"),
				columns :application.settings.unitColumns,
				responseNode : "Device",
				multipleResponseNode : "Devices",
				translations : settings.tableGeneratorTranslations,
				multipleRequestType : "devices",
				root : root,
				localStorageColumnsKey : "unit_columns",
				languageFile : datatables_translations,
				localStorageLengthKey : "unit_length_value",
				addModalId : "add_unit",
				handlers : {
					location :application.settings.handlers.location,
					model_type :application.settings.handlers.device_type,
					model :application.settings.handlers.device_model
				},
				callback : function () {
					application.readyCallback("unitsGenerator");
				}
			});
			application.addGenerator(application.unitsGenerator,"unitsGenerator");

			//Printers
			application.printerGenerator = new tableGenerator({
				modal : $("#edit_printer"),
				requestType : "printer",
				localStorageLengthKey : "printer_length_value",
				translations : settings.tableGeneratorTranslations,
				container : $("#printer"),
				columns :application.settings.printerColumns,
				responseNode : "Printer",
				multipleResponseNode : "Printers",
				localStorageColumnsKey : "printer_columns",
				multipleRequestType : "printers",
				root : root,
				languageFile : datatables_translations,
				handlers : {
					location :application.settings.handlers.location,
					model :application.settings.handlers.printer_model
				},
				callback : function () {
					application.readyCallback("printerGenerator");
				}
			});
			//application.addGenerator(application.printerGenerator,"printerGenerator");

			//Screeens
			application.screenGenerator = new tableGenerator({
				requestType : "screen",
				modal : $("#edit_screen"),
				localStorageLengthKey : "screen_length_value",
				translations : settings.tableGeneratorTranslations,
				localStorageColumnsKey : "screen_columns",
				container : $("#screen"),
				columns :application.settings.screenColumns,
				responseNode : "Screen",
				multipleResponseNode : "Screens",
				multipleRequestType : "screens",
				languageFile : datatables_translations,
				root : root,
				handlers : {
					location :application.settings.handlers.location,
				},
				callback : function () {
					application.readyCallback("screenGenerator");
				}
			});
			application.addGenerator(application.screenGenerator,"screenGenerator");
			if (typeof initializeCallback == "function") {
				application.initializeCallback();
			}
		});	 
	},

	/**
	 * This function launches the app
	 * @param  {string current The current generator
	 */
	launch : function (current,callbackOnFirst) {
		this.callbackOnFirst = callbackOnFirst || false;
		var generators = application.generators;
		if (typeof current != "undefined" && typeof generators[current] != "undefined") {
			var currentGenerator = generators[current];
			var generators = application.remoevArrayKey(current,generators);
			var currentArray = Array();
			this.current = current;
			currentArray[current] = currentGenerator;
			var generators = application.merge_options(currentArray,generators)
		}
		$.each(generators,function(index,element){
			element.getNodes(application.organization);
		});
	},

	/**
	 * This function counts object properties in a object
	 * @param  {object|array} obj The object to count the number of properties ib
	 * @return {integer}
	 */
	countProperties :function (obj) {
		  var prop;
		  var propCount = 0;

		  for (prop in obj) {
		    propCount++;
		  }
		return propCount;
	},

	/**
	 * This function unsets an array element
	 * @param  {string|integer} search The element to unset
	 * @param {Array} array The array to unset the element in
	 */
	remoevArrayKey : function (search,array) {
		for (var key in array) {
		    if (array[key] == search) {
		        array.splice(key, 1);
		    }
		}
		return array;
	},

	/**
	 * Overwrites obj1's values with obj2's and adds obj2's if non existent in obj1
	 * @param obj1
	 * @param obj2
	 * @returns obj3 a new object based on obj1 and obj2
	 */
	merge_options : function (obj1,obj2){
	    var obj3 = {};
	    for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
	    for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
	    return obj3;
	},

	/**
	 * This function is called by the tableGenerator each time a table is readys
	 */
	readyCallback : function (caller) {
		if (this.callbackOnFirst == true && caller == this.current) {
			if (typeof application.doneCallback == "function") {
				application.doneCallback();
				return;
			}
		}
		application.ready += 1;
		if (application.ready == application.countProperties(application.generators)-1) {
			if (typeof application.doneCallback == "function") {
				application.doneCallback();
				return;
			}
		}
	}
}