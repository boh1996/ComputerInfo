var data = {
	"computer" : "computers",
	"printer" : "printers",
	"units" : "units",
	"screens" : "screens",
	"users" : "users",
	"organizations" : "organizations",
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
	var organization = 1;
	var unitsGenerator = new tableGenerator({
		requestType : "device",
		container : $("#unit"),
		columns : settings.unitColumns,
		responseNode : "Device",
		multipleResponseNode : "Devices",
		multipleRequestType : "devices",
		root : root
	});
	unitsGenerator.getNodes(organization);
	var computerGenerator = new tableGenerator({
		requestType : "computer",
		container : $("#computer"),
		columns : settings.computerColumns,
		responseNode : "Computer",
		multipleResponseNode : "Computers",
		multipleRequestType : "computers",
		root : root
	});
	computerGenerator.getNodes(organization);
	var locationGenerator = new tableGenerator({
		requestType : "location",
		container : $("#location"),
		columns : settings.locationColumns,
		responseNode : "Location",
		multipleResponseNode : "Locations",
		multipleRequestType : "locations",
		root : root
	});
	locationGenerator.getNodes(organization);
	var printerGenerator = new tableGenerator({
		requestType : "prnter",
		container : $("#printer"),
		columns : settings.printerColumns,
		responseNode : "Printer",
		multipleResponseNode : "Printers",
		multipleRequestType : "printers",
		root : root
	});
	printerGenerator.getNodes(organization);
	$(".dataTables_filter").find("input").addClass("input-large");
});