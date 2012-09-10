/**
 * Generators
 */
var unitsGenerator,computerGenerator,locationGenerator,printerGenerator,screenGenerator = null;

/**
 * End of generators
 */

var data = {
	"computer" : "computers",
	"printer" : "printers",
	"units" : "units",
	"screens" : "screens",
	"users" : "users",
	//"organizations" : "organizations",
	"locations" : "locations",
}

var generators = {
		"computers" : "computerGenerator",
		"printers" : "printerGenerator",
		"units" : "unitsGenerator",
		"locations" : "locationGenerator",
		"screens" : "screenGenerator"
};

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
	$(".logout").live("click",function(){
		window.location = root + "logout";
	});
	initialize();
	History.Adapter.bind(window,'statechange',function(){
		showPage();
    });

	application.initialize(1,function () {
	    showPage();
	});	
});

function getPage () {
	var state = History.getState();
   	page = state.cleanUrl.replace(root,"");
	page = page.replace("http://","");
   	page = page.replace("https://","");
   	page = page.replace("//","");
   	page = page.replace("www.","");
   	return page;
}

function initialize () {
	page = getPage();
   	if ($("#"+page).length > 0) {
		$(".active_page").addClass("disabled_page").removeClass("active_page");
		$("#"+page).removeClass("disabled_page").addClass("active_page");
		if ($('a[data-target="'+findPageString(page)+'"]').length > 0 && !$('a[data-target="'+findPageString(page)+'"]').parent("li").hasClass("active")) {
			$(".active").removeClass("active");
			$('a[data-target="'+findPageString(page)+'"]').parent("li").addClass("active");
		}
	}
}

function showPage () {
 	page = getPage();
   if ($("#"+page).length > 0) {
   		var currentPage = $(".active_page");
   		var newPage = $("#"+page);
   		if (objx.get(generators,currentPage.attr("id")) != null) {
   			var id = objx.get(generators,currentPage.attr("id"));
   			objx.get(application,id).hide();
   		}
   		if (objx.get(generators,newPage.attr("id")) != null) {
   			var id = objx.get(generators,newPage.attr("id"));
   			if (objx.get(application,id) != null) {
   				objx.get(application,id).show();
   			}
   		}
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
