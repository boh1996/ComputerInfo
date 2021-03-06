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

$(document).on(".object[href]",'click',function(){
	window.location = root + $(this).attr("href");
});

$("#user-language").typeahead({
	source : function(typeahead, query) {
	    $.ajax({
	    	url : root + "languages?token" + userInfo.getCookie("token") + "&name="+query,
	    	contentType : "application/json",
	    	success : function (data) {
	    		var languages = new Array();
	    		for ( var i in data.result) {
	    			languages.push(i);
	    		};

	    		console.log(languages);

	    		typeahead.process(languages);
	    	}
	    });
	}
});

function countProperties (obj) {
		  var prop;
		  var propCount = 0;

		  for (prop in obj) {
		    propCount++;
		  }
		return propCount;
	}

$('#save-selections').toggleButtons({
    style: {
        enabled: "success",
        disabled: "danger"
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
		if (typeof replacement != "undefined" && replacement != null && replacement.indexOf("{") !== -1 && replacement.indexOf("}") !== -1 && propagate !== false) {
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
	var organization = 2;
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

    crossroads.addRoute("units",function () {
		$("#loading-background").show();
		$("#loading").show();
    	application.launchGenerator("unitsGenerator",function () {
    		showPage("units");
    		setTitle({
	    		"page" : front_translations.units_page
	    	});
    	});
    });

    crossroads.addRoute("screens",function () {
		$("#loading-background").show();
		$("#loading").show();
    	application.launchGenerator("screenGenerator",function () {
    		showPage("screens");
    		setTitle({
	    		"page" : front_translations.screens_page
	    	});
    	});
    });

    crossroads.addRoute("locations",function () {
		$("#loading-background").show();
		$("#loading").show();
    	application.launchGenerator("locationGenerator",function () {
    		showPage("locations");
    		setTitle({
	    		"page" : front_translations.roomts_page
	    	});
    	});
    });

    crossroads.addRoute("printers",function () {
		$("#loading-background").show();
		$("#loading").show();
    	application.launchGenerator("printerGenerator",function () {
    		showPage("printers");
    		setTitle({
	    		"page" : front_translations.printers_page
	    	});
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
				data.result.base_url = root;
				data.result.computer_id = data.result.id;
				data.result.calculate_progress = function () {
					return {
						"used" : parseInt(this.free_space) / parseInt(this.disk_size) * 100,
						"left" : 100 - (parseInt(this.free_space) / parseInt(this.disk_size) * 100)
					};
				}
				data.result.serial_is_set = function () {
					return typeof this.serial != "undefined" && this.serial != null;
				}
				data.result.disk_space_available = function () {
					return (typeof this.free_space != "undefined" && this.free_space != null && typeof this.disk_size != "undefined" && this.disk_size != null ) ? true : false;
				}
				$("#computer_id").html(Mustache.render($("#computerTemplate").html(), data.result));
				$("div.accordion-body").each(function(index,element){
					$(element).find("div.object:last").next("hr").remove();
				});
				setTitle({
					"page" : front_translations.computer_page,
					"identifier"   : data.result.identifier
				});
				showPage("computer_id");
			}, error : function () {
				setTitle({
					"page" : front_translations.computer_not_found,
				});
				showPage("error");
			}
		});
    });

    crossroads.addRoute("location/{id}",function (id) {
    	$("#loading-background").show();
		$("#loading").show();
		$.ajax({
			url : root+"location/"+id+"?token="+userInfo.getCookie("token"),
			success: function (data) {
				$("#location_id").html(Mustache.render($("#locationTemplate").html(),data.result));
				$("div.accordion-body").each(function(index,element){
					$(element).find("div.object:last").next("hr").remove();
				});
				setTitle({
					"page" : front_translations.location_page,
					"name" :data.result.name
				});
				showPage("location_id");
			}, error : function () {
				setTitle({
					"page" : front_translations.element_not_found
				});
				showPage("error");
			}
		});
    });

    crossroads.addRoute("device/{id}",function (id) {
    	$("#loading-background").show();
		$("#loading").show();
		$.ajax({
			url : root+"device/"+id+"?token="+userInfo.getCookie("token"),
			success: function (data) {
				$("#device_id").html(Mustache.render($("#deviceTemplate").html(), data.result));
				$("div.accordion-body").each(function(index,element){
					$(element).find("div.object:last").next("hr").remove();
				});
				setTitle({
					"page" : front_translations.device_page,
					"identifier"   : data.result.identifier
				});
				showPage("device_id");
			}, error : function () {
				setTitle({
					"page" : front_translations.element_not_found
				});
				showPage("error");
			}
		});
    });

    crossroads.addRoute("printer/{id}",function (id) {
    	$("#loading-background").show();
		$("#loading").show();
		$.ajax({
			url : root+"printer/"+id+"?token="+userInfo.getCookie("token"),
			success: function (data) {
				var printer = data.result;
				printer.model.type = (printer.model.color == 1) ? front_translations.color_printer : front_translations.black_white_printer;
				$("#printer_id").html(Mustache.render($("#printerTemplate").html(), printer));
				$("div.accordion-body").each(function(index,element){
					$(element).find("div.object:last").next("hr").remove();
				});
				setTitle({
					"page" : front_translations.printer_page,
					"name"   : data.result.name || data.result.identifier
				});
				showPage("printer_id");
			}, error : function () {
				setTitle({
					"page" : front_translations.element_not_found
				});
				showPage("error");
			}
		});
    });

	crossroads.bypassed.add(function(request){
		$("#loading-background").show();
		$("#loading").show();
	   	showPage("errorPage");
	   	setTitle({
			"page" : front_translations.page_not_found
		});
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

/**
 * This function shows a page and change the navbar link properly
 * @param  {string} newPage The name of the page to change too
 */
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



$(document).on("click",'.editable[data-editable-type="text"]', function (event) {
	var that = this;
	event.stopPropagation();
	if ( $(this).find('[data-editable]') .length == 0) {
		var value = $(this).html();
		var input = $(
			'<div class="input-append">'+
				'<input data-editable="true" data-original="'+value+'" type="text" value="'+value+'" />'+
				'<i class="btn add-on icon-ok"></i>'+
				'<i class="btn add-on icon-remove"></i>'+
			'</div>'
		);
		$(this).html(input);
		$(input).find(".icon-ok").click(function () {
			var value = $(this).prev("input").val();
			var object = $(that);
			var data = {};
			objx.set(data, $(object).attr("data-property-name"), value);
			saveObject(object, data, function () {
				crossroads.parse(getPage());
				crossroads.resetState();
			}, function () {
				setTitle({
					"page" : front_translations.error_an_error_occured,
				});
				showPage("error");
			});
		});
	}
});

$(document).on("click", 'body', function () {
	$('input[data-editable="true"]').each(function (index, element) {
		$(element).parent("div").replaceWith($(element).attr("data-original"));
	});
});

function saveObject ( settingsObject, object, success, error ) {
	var endpoint = root + $(settingsObject).attr("data-endpoint") + "?token=" + userInfo.getCookie("token");
	var settings = {
		"type" : ( $(settingsObject).attr("data-method") != undefined ) ? $(settingsObject).attr("data-method") : "POST",
		"url" : endpoint.replace("{id}", $(settingsObject).attr("data-index")),
		"success" : success,
		"error" : error,
		"data" : JSON.stringify(object),
		"contentType" : "application/json" 
	}
	$.ajax(settings);
}