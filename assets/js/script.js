var generators = {
		"computers" : "computerGenerator",
		"printers" : "printerGenerator",
		"units" : "unitsGenerator",
		"locations" : "locationGenerator",
		"screens" : "screenGenerator"
};

var History = window.History;

$(".nav li a[data-target],ul li a[data-target]").live('click', function (event) {
  	var url = "";

  	event.preventDefault();
  	if (event.target.nodeName == 'A') {
	   	url = event.target.getAttribute('data-target');
	    History.pushState(null,null, root+url);
	}
});

/**
 * This function replaces the template variables with the correct data
 * @param  {string} string The template
 * @param  {object} data   The template variables and values
 * @param {boolean} propagate If the childs should be templated too
 * @return {string}
 */
function template (string,data, propagate) {
	for(var variable in data)
	{	
		var replacement = data[variable];
		if (variable.indexOf("{") !== -1 && variable.indexOf("}") !== -1 && propagate !== false) {
			variable = template(variable,data,false);
		}
		if (replacement.indexOf("{") !== -1 && replacement.indexOf("}") !== -1 && propagate !== false) {
			replacement = template(replacement,data,false);
		}
		
	    string = string.replace("{"+variable+"}",replacement);
	}
	return string;
}

/**
 * This function sets the document title
 * @param {object} data Template data
 */
function setTitle (data) {
	var variables = {
		"brand" : front_translations.brand_title,
	}
	document.title = template(front_translations.page_template,application.merge_options(data,variables),true);
}

function computersPage () {
    setTitle({
			"page" : front_translations.computers_page
	});
	showPage("computers");
}

$(window).ready(function(){
	var organization = 1;
	$(".logout").live("click",function(){
		window.location = root + "logout";
	});

	crossroads.addRoute("computers",function () {
		$("#loading-background").show();
		$("#loading").show();
    	application.launchGenerator("computerGenerator",function () {
    		computersPage();
    	});
    });

    crossroads.addRoute("",function () {
    	$("#loading-background").show();
		$("#loading").show();
    	application.launchGenerator("computerGenerator",function () {
    		computersPage();
    	})
    });

    crossroads.addRoute("settings",function () {
    	setTitle({
    		"page" : front_translations.settings_page
    	});
    	showPage("settings");
    });

    crossroads.addRoute("computer/{id}",function (id) {
    	$("#loading-background").show();
		$("#loading").show();
		$.ajax({
			url : root+"computer/"+id+"?token="+userInfo.getCookie("token"),
			success: function (data) {
				$("#computer_id").html(Mustache.render($("#computerTemplate").html(), data.Computer));
				$("div.accordion-body").each(function(index,element){
					$(element).find("div.object:last").next("hr").remove();
				});
				setTitle({
					"page" : front_translations.computer_page,
					"id"   : data.Computer.identifier
				});
				showPage("computer_id");
			}, error : function () {
				setTitle({
					"page" : front_translations.computer_not_found
				});
				showPage("error");
			}
		});
    });

	crossroads.bypassed.add(function(request){
		$("#loading-background").show();
		$("#loading").show();
	   	showPage("errorPage");
	});

	application.initialize(organization,function () {
		crossroads.parse(getPage());
		crossroads.resetState();
	},null,language);

	History.Adapter.bind(window,'statechange',function(){
		crossroads.parse(getPage());
		crossroads.resetState();
    });
});

function showPage (newPage) {
	$("#loading-background").hide();
	$("#loading").hide();
	var currentPage = $(".active_page");
	if (objx.get(generators,currentPage.attr("id")) != null) {
		var id = objx.get(generators,currentPage.attr("id"));
		objx.get(application,id).hide();
	}
	$(".active").removeClass("active");
   	if ($("#"+newPage).length > 0) {
   		$(".active_page").addClass("disabled_page").removeClass("active_page");
   		$("#"+newPage).removeClass("disabled_page").addClass("active_page");
   		if ($('a[data-target="'+newPage+'"]').length > 0 && !$('a[data-target="'+newPage+'"]').parent("li").hasClass("active")) {
   			if ($('a[data-target="'+newPage+'"]').attr("data-no-active") != "true") {
   				$('a[data-target="'+newPage+'"]').parent("li").addClass("active");
   			}
   		}
   	}
	var newPage = $("#"+newPage);
	if (newPage.length == 0) {
		newPage = currentPage;
	}
	if (objx.get(generators,newPage.attr("id")) != null) {
		var id = objx.get(generators,newPage.attr("id"));
		if (objx.get(application,id) != null) {
			objx.get(application,id).show();
		}
	}
}

/**
 * This function returns the current "page",
 * ready to use with the URL Routing system
 * @return {string}
 */
function getPage () {
	return History.getState().url.replace(root,"");
}

/*function initialize () {
	page = getPage();
   	if ($("#"+page).length > 0) {
		$(".active_page").addClass("disabled_page").removeClass("active_page");
		$("#"+page).removeClass("disabled_page").addClass("active_page");
		if ($('a[data-target="'+findPageString(page,"computers")+'"]').length > 0 && !$('a[data-target="'+findPageString(page,"computers")+'"]').parent("li").hasClass("active")) {
			$(".active").removeClass("active");
			if ($('a[data-target="'+findPageString(page,"computers")+'"]').attr("data-no-active") != "true") {
   				$('a[data-target="'+findPageString(page,"computers")+'"]').parent("li").addClass("active");
   			}
		}
	}
}*/

/*function showPage () {
	var currentPage = $(".active_page");
	if (objx.get(generators,currentPage.attr("id")) != null) {
		var id = objx.get(generators,currentPage.attr("id"));
		objx.get(application,id).hide();
	}
	page = getPage();
	if (page == "") {
		page == "computers";
	}
   	if ($("#"+page).length > 0) {
   		$(".active_page").addClass("disabled_page").removeClass("active_page");
   		$("#"+page).removeClass("disabled_page").addClass("active_page");
   		if ($('a[data-target="'+findPageString(page,"computers")+'"]').length > 0 && !$('a[data-target="'+findPageString(page,"computers")+'"]').parent("li").hasClass("active")) {
   			$(".active").removeClass("active");
   			if ($('a[data-target="'+findPageString(page,"computers")+'"]').attr("data-no-active") != "true") {
   				$('a[data-target="'+findPageString(page,"computers")+'"]').parent("li").addClass("active");
   			}
   		}
   	}
	var newPage = $("#"+page);
	if (newPage.length == 0) {
		newPage = currentPage;
	}
	if (objx.get(generators,newPage.attr("id")) != null) {
		var id = objx.get(generators,newPage.attr("id"));
		if (objx.get(application,id) != null) {
			objx.get(application,id).show();
		}
	}
}

function findPageString (str,std) {
	var returnValue = std || "";
	$.each(data,function(index,element){
		if (element == str) {
			returnValue = index;
		}
	});
	return returnValue;
}/*/
