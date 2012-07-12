var data = {
	"computer" : "computers",
	"printer" : "printers",
	"units" : "units",
	"screens" : "screens",
	"users" : "users",
	//"organizations" : "organizations",
	"locations" : "locations",
} 

if (typeof history.pushState === 'undefined') {
  var History = window.History; // Note: We are using a capital H instead of a lower h
}

$(".nav li a").live('click', function (event) {
  	var title,url,object;
  
  	event.preventDefault();
  	if (event.target.nodeName == 'A') {
	   	url = event.target.getAttribute('data-target');
	    title = event.target.getAttribute('data-title');
	    History.pushState(data[url],title, data[url]);
	}
});

$(window).ready(function(){
	History.Adapter.bind(window,'statechange',function(){
		showPage();
    });
    showPage();
});

function showPage () {
   var state = History.getState();
   page = state.cleanUrl.replace(root,"");
   if ($("#"+page).length > 0) {
   		$(".active_page").addClass("disabled_page").removeClass("active_page");
   		$("#"+page).removeClass("disabled_page").addClass("active_page");
   		if ($('a[data-target="'+findPageString(page)+'"]').length > 0 && !$('a[data-target="'+findPageString(page)+'"]').parent("li").hasClass("active")) {
   			$(".active").removeClass("active");
   			$('a[data-target="'+findPageString(page)+'"]').parent("li").addClass("active");
   		}
   }
}

function findPageString (str) {
	var returnValue = "";
	$.each(data,function(index,element){
		if (element == str) {
			returnValue = index;
		}
	});
	return returnValue;
}

/*$(window).on('hashchange', function (event) {
	showPage();
});*/

$(window).on('pageshow', function (event) {
	var organization = "1";

	//Units
	var unitsGenerator = new tableGenerator({
		requestType : "device",
		container : $("#unit"),
		modal : $("#edit_unit"),
		columns : settings.unitColumns,
		responseNode : "Device",
		multipleResponseNode : "Devices",
		multipleRequestType : "devices",
		root : root,
		localStorageColumnsKey : "unit_columns",
		localStorageLengthKey : "unit_length_value",
		handlers : {
			location : {
				url : root + "options/location?organization="+organization,
				property : "name",
				response_key : "Locations"
			},
			model_type : {
				url : root + "options/device_type",
				property : "name",
				query_parameters : {
					"category" : "Other"
				},
				response_key : "Device_Types"
			},
			model : {
				url : root + "options/device_model",
				property : "name",
				query_key : "name",
				fill_values : {
					"type" : ".type_select"
				},
				type : "typeahead",
				response_key : "Device_Models"
			},
		}
	});
	unitsGenerator.getNodes(organization);

	//Computers
	var computerGenerator = new tableGenerator({
		requestType : "computer",
		container : $("#computer"),
		columns : settings.computerColumns,
		responseNode : "Computer",
		multipleResponseNode : "Computers",
		localStorageColumnsKey : "computer_columns",
		multipleRequestType : "computers",
		root : root,
		modal : $("#edit_computer"),
		localStorageLengthKey : "computer_length_value",
		handlers : {
			model_type : {
				url : root + "options/device_type",
				property : "name",
				response_key : "Device_Types"
			},
			model : {
				url : root + "options/computer_model",
				property : "name",
				query_key : "name",
				fill_values : {
					"type" : ".type_select"
				},
				type : "typeahead",
				response_key : "Computer_Models"
			},
			screen_size : {
				url : root + "options/screen_size",
				property : "detection_string",
				response_key : "Screen_Sizes"
			},
			location : {
				url : root + "options/location?organization="+organization,
				property : "name",
				response_key : "Locations"
			}
		}
	});
	computerGenerator.getNodes(organization);

	//Locations
	var locationGenerator = new tableGenerator({
		requestType : "location",
		modal : $("#edit_location"),
		container : $("#location"),
		localStorageLengthKey : "location_length_value",
		columns : settings.locationColumns,
		responseNode : "Location",
		multipleResponseNode : "Locations",
		multipleRequestType : "locations",
		localStorageColumnsKey : "location_columns",
		root : root,
		handlers : {
			floor : {
				fill_values : {
					"building" : ".building_select"
				},
				url : root + "options/floor",
				query_parameters : {
					"organization" : organization
				},
				property : "name",
				query_key : "name",
				type : "typeahead",
				response_key : "Floors"
			},
			building : {
				url : root + "options/building?organization="+organization,
				property : "name",
				response_key : "Buildings"
			}
		}
	});
	locationGenerator.getNodes(organization);

	//Printers
	var printerGenerator = new tableGenerator({
		modal : $("#edit_printer"),
		requestType : "printer",
		localStorageLengthKey : "printer_length_value",
		container : $("#printer"),
		columns : settings.printerColumns,
		responseNode : "Printer",
		multipleResponseNode : "Printers",
		localStorageColumnsKey : "printer_columns",
		multipleRequestType : "printers",
		root : root,
		handlers : {
			location : {
				url : root + "options/location?organization="+organization,
				property : "name",
				response_key : "Locations"
			},
			model : {
				url : root + "options/printer_model",
				property : "name",
				query_key : "name",
				type : "typeahead",
				response_key : "Printer_Models"
			}
		}
	});
	printerGenerator.getNodes(organization);

	//Screeens
	var screenGenerator = new tableGenerator({
		requestType : "screen",
		modal : $("#edit_screen"),
		localStorageLengthKey : "screen_length_value",
		localStorageColumnsKey : "screen_columns",
		container : $("#screen"),
		columns : settings.screenColumns,
		responseNode : "Screen",
		multipleResponseNode : "Screens",
		multipleRequestType : "screens",
		root : root,
		handlers : {
			location : {
				url : root + "options/location?organization="+organization,
				property : "name",
				response_key : "Locations"
			},
			/*model : {
				url : root + "options/printer_model",
				property : "name",
				query_key : "name",
				type : "typeahead",
				response_key : "Printer_Models"
			}*/
		}
	});
	screenGenerator.getNodes(organization);
	$(".dataTables_filter").find("input").addClass("input-large");
});