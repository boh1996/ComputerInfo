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
   page = page.replace("http://","");
   page = page.replace("https://","");
   page = page.replace("//","");
   page = page.replace("www.","");
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


$(window).on('pageshow', function (event) {
	var organization = "1";
	var applicationSettings = new settings(organization);
	if (userInfo.getCookie("token") == undefined || userInfo.getCookie("token") == null) {
		window.location = root + "login";
		return;
	}
	userInfo.getInfo(root + "user/me",userInfo.getCookie("token"), function (data,status){ 
		if (status == "fail") {
			console.log("FAIL");
			return;
		}

		//Units
		var unitsGenerator = new tableGenerator({
			requestType : "device",
			container : $("#unit"),
			modal : $("#edit_unit"),
			columns : applicationSettings.unitColumns,
			responseNode : "Device",
			multipleResponseNode : "Devices",
			multipleRequestType : "devices",
			root : root,
			localStorageColumnsKey : "unit_columns",
			localStorageLengthKey : "unit_length_value",
			handlers : {
				location : applicationSettings.handlers.location,
				model_type : applicationSettings.handlers.device_type,
				model : applicationSettings.handlers.device_model
			}
		});
		unitsGenerator.getNodes(organization);

		//Computers
		var computerGenerator = new tableGenerator({
			requestType : "computer",
			container : $("#computer"),
			columns : applicationSettings.computerColumns,
			responseNode : "Computer",
			multipleResponseNode : "Computers",
			localStorageColumnsKey : "computer_columns",
			multipleRequestType : "computers",
			root : root,
			modal : $("#edit_computer"),
			localStorageLengthKey : "computer_length_value",
			handlers : {
				model_type : applicationSettings.handlers.device_type,
				model : applicationSettings.handlers.computer_model,
				screen_size : applicationSettings.handlers.screen_size,
				location : applicationSettings.handlers.location,
				manufacturer : applicationSettings.handlers.manufacturer
			}
		});
		computerGenerator.getNodes(organization);

		//Locations
		var locationGenerator = new tableGenerator({
			requestType : "location",
			modal : $("#edit_location"),
			container : $("#location"),
			localStorageLengthKey : "location_length_value",
			columns : applicationSettings.locationColumns,
			responseNode : "Location",
			multipleResponseNode : "Locations",
			multipleRequestType : "locations",
			localStorageColumnsKey : "location_columns",
			root : root,
			handlers : {
				floor : applicationSettings.handlers.floor,
				building : applicationSettings.handlers.building
			}
		});
		locationGenerator.getNodes(organization);

		//Printers
		var printerGenerator = new tableGenerator({
			modal : $("#edit_printer"),
			requestType : "printer",
			localStorageLengthKey : "printer_length_value",
			container : $("#printer"),
			columns : applicationSettings.printerColumns,
			responseNode : "Printer",
			multipleResponseNode : "Printers",
			localStorageColumnsKey : "printer_columns",
			multipleRequestType : "printers",
			root : root,
			handlers : {
				location : applicationSettings.handlers.location,
				model : applicationSettings.handlers.printer_model
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
			columns : applicationSettings.screenColumns,
			responseNode : "Screen",
			multipleResponseNode : "Screens",
			multipleRequestType : "screens",
			root : root,
			handlers : {
				location : applicationSettings.handlers.location,
			}
		});
		screenGenerator.getNodes(organization);
		$(".dataTables_filter").find("input").addClass("input-large");
	});
});