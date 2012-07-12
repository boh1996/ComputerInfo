/**
 * The table generators constructor
 * @param  {object} settings The settings json object
 */
function tableGenerator (settings) {
	this.requestType = settings.requestType;
	this.container = settings.container;
	this.localStorageColumnsKey = settings.localStorageColumnsKey || "columns";
	this.modal_id_name = settings.modal_id_name || this.randomString(10);
	this.localStorageLengthKey = settings.localStorageLengthKey || "length_value";
	this.filter_value = localStorage.getItem(this.localStorageLengthKey ) || 10;
	if ($.parseJSON(localStorage.getItem(this.localStorageColumnsKey)) && this.countProperties($.parseJSON(localStorage.getItem(this.localStorageColumnsKey))) == this.countProperties(settings.columns)) {
		this.columns =  $.parseJSON(localStorage.getItem(this.localStorageColumnsKey));
	} else{
		this.columns = settings.columns;
	}
	this.responseNode = settings.responseNode;
	//this.requestUrl = root + this.requestType +"/{id}";
	this.multipleResponseNode = settings.multipleResponseNode;
	this.multipleRequestType = settings.multipleRequestType;
	this.root = settings.root;

	if (typeof settings.callback != "undefined") {
		this.doneCallback = settings.callback;
	}

	if (typeof settings.modal != "undefined") {
		this.onCickModal = settings.modal;
	}

	if (typeof settings.handlers != "undefined") {
		this.handlers = settings.handlers;
	}

	if (typeof settings.organization != "undefined") {
		this.organization = settings.organization;
	}
}
	
/**
 * The table generator prototype
 * @type {Object}
 */
tableGenerator.prototype = {
	
	/**
	 * The api url for requesting a computer
	 * @type {string}
	 */
	requestUrl : null,

	/**
	 * The name of the key where to store the length select values
	 * @type {string}
	 */
	localStorageLengthKey : null,

	/**
	 * The key where to store the columns
	 * @type {string}
	 */
	localStorageColumnsKey : null,

	modal_id_name : null,

	/**
	 * The object request type
	 * @type {String}
	 */
	requestType : "computer",

	/**
	 * The server root
	 * @type {string}
	 */
	root : null,

	/**
	 * The url to look in when requesting more objects
	 * @type {String}
	 */
	multipleRequestType : "computers",

	/**
	 * This array/object will store the handlers for the different data fill operations
	 * @type {object}
	 */
	handlers : null,

	/**
	 * The computers container
	 * @type {string}
	 */
	container : $("#computer"),

	/**
	 * The node to look for in the response
	 * @type {String}
	 */
	responseNode : "Computer",

	/**
	 * If this is set then the specified modal is launched when a row is clicked
	 * @type {Object}
	 */
	onCickModal : null,

	/**
	 * This function is called when the opration is done
	 * @type {function}
	 */
	doneCallback : null,

	/**
	 * The node to look for when requesting more rows
	 * @type {String}
	 */
	multipleResponseNode : "Computers",

	/**
	 * The property names for the respond
	 * and the row names for them
	 * @type {Object}
	 */
	columns : null,

	/**
	 * The funciton to be called when a operaiton is done
	 * @return {function}
	 */
	readyCallback : function(){
		this.generateTable();
		if (this.doneCallback != null) {
			this.doneCallback();
		}
	},

	/**
	 * The last computers response sent from the server
	 * @type {object}
	 */
	response : null,

	/**
	 * The current organization id
	 * @type {integer}
	 */
	organization : null,

	/**
	 * The current filter value
	 * @type {Number}
	 */
	filter_value : 10,

	/**
	 * A variable to store datatables
	 * @type {object}
	 */
	dataTable : null,

	/**
	 * The code/object/string to use as length filtering
	 * @type {[type]}
	 */
	length_menu : '<form class="jqtransform"><select class="length_select"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></form>',

	/**
	 * This function generates the computers row
	 * @param  {object} data The api response data
	 * @param {integer} index The index in the response where to findthis node
	 */
	generateNode : function (data,index){
		var objectElement = $('<tr></tr>');
		if(data != null && data != undefined){
			objectElement.attr("data-index",index);
			var i = 0;
			$.each(this.columns, $.proxy(function (index,element){ 
				i++;
				if(this.columns[index].active == true){
					var row = objx.get(data,index);
					if(row !== undefined && row !== null && row !== -1 && row !== false){
						objectElement.append('<th>'+ row.toString() +'</th>');
					} else {
						objectElement.append('<th></th>');
					}
				}
				if(i == this.countProperties(this.columns)) {
					this.container.find("tbody").append(objectElement);
					this.ensureLayout();
				}	
			}, this));
		}
	},

	/**
	 * This function is used to generate random id values
	 * @param  {integer} string_length The length of the string
	 * @return {string}
	 */
	randomString : function ( string_length ) {
		var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
		var string_length = string_length || 8;
		var randomstring = '';
		for (var i=0; i<string_length; i++) {
			var rnum = Math.floor(Math.random() * chars.length);
			randomstring += chars.substring(rnum,rnum+1);
		}
		return randomstring;
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
	 * This function gets all the computers for a specific organization
	 * @param  {integer} id The organization id
	 */
	getNodes : function(id){
		var requestUrl = this.root + "get/" + this.multipleRequestType + "/{id}";
		requestUrl = requestUrl.replace("{id}",id);
		$.ajax({
			url : requestUrl,
			success : $.proxy(function (data, code, XMLHttpRequest){
				if (data != null) {
					this.response = objx.get(data,this.multipleResponseNode); 
					data = this.response;
						$.each(data, $.proxy(function (index,element){ 
							this.generateNode(element,index);
							if(data != null && index == data.length-1){
								this.readyCallback();
							} else if (data == null) {
								this.readyCallback();
							}
						}, this));
				}
			}, this)
		});
	},

	/**
	 * This function gets a computer from the api by the id
	 * @param  {integer} id The id of the computer to get
	 * @param {function} callback The function to call when the response are retrived
	 */
	getNode : function(id,callback){
		var requestUrl = this.root + this.requestType + "/{id}";
		$.ajax({
			url : requestUrl.replace("{id}",id),
			success : $.proxy(function (data){ 
				data = objx.get(data,this.responseNode);
				this.generateNode(data);
				this.readyCallback();
			}, this)
		});
	},

	/**
	 * This function generates the field selector dropdoen
	 * @param  {string} text      The dropdown text
	 * @param  {object} container The container to append too
	 */
	generateFieldsDropdown : function ( text, container ) {
		var parent = $(this.container).parent("div");
		var parentElement = $('<ul class="nav fields-select nav-pills"></ul>'), 
		dropdown = $('<li class="dropdown"></li>'),
		linkElement = $('<a class="dropdown-toggle" data-toggle="dropdown" data-target="#">'+text+'<b class="caret"></b></a>'),
		items = $('<ul class="dropdown-menu inputs-list"></ul>'),
		length = this.countProperties(this.columns),
		i = 0;
		$.each(this.columns,$.proxy(function (value,object) {
			if(value !== "" && typeof object === "object"){
				i++;
				if(this.columns[value].active == true) {
					items.append(
						'<li>'+
							'<a href="#">'+
								'<input type="checkbox" class="styled" name="' + value +'" value="'+ value +'" id="'+ value +'" checked/> '+
								'  <label for="'+ value +'">' + object.string +'</label>'+
							'</a>'+
						'</li>'
					);
				} else {
					items.append(
						'<li>'+
							'<a href="#">'+
								'<input type="checkbox" class="styled" name="' + value +'" value="'+ value +'" "/> '+
								'  <label for="'+ value +'">' + object.string +'</label>'+
							'</a>'+
						'</li>'
					);
				}

				//If it's the last run
				if (i == length) {
					dropdown.append(linkElement);
					dropdown.append(items);
					parentElement.append(dropdown);
					container.append(parentElement);
					Custom.init(parent);
					$(parent).find(".dropdown-menu li a").click(function(event) {
						$(event.target).find("span").parent().find('input[type="checkbox"]').prop("checked",true);
						$(event.target).find("span").trigger("click");
					});
					$(parent).find(".dropdown-menu li span").click($.proxy(function (event){ 
						var checkbox = $(event.target).parent().find('input[type="checkbox"]');
						if (checkbox.prop("checked") === true) {
							this.columns[checkbox.val()].active = true;
						} else {
							this.columns[checkbox.val()].active = false;
						}
						localStorage.setItem(this.localStorageColumnsKey,JSON.stringify(this.columns));
						this.refreshTable();
					}, this));
				}
			}
		},this));
	},

	/**
	 * This function ensures that the layout is correct,
	 * also after new rows are added
	 */
	ensureLayout : function (){
		$("tbody td:odd").addClass("odd");
		$("tbody td:even").addClass("even");
		$('.dataTables_empty').remove();
	},

	/**
	 * This function generates the computers table
	 */
	generateTable : function(){
		this.generateColumns();
		this.initializeDatatables(true);

		if (this.onCickModal != null) {
			this.createModal();
		}
	},

	/**
	 * This function generates the table headers
	 */
	generateColumns : function () {
		var header = $("<tr></tr>");
		$.each(this.columns, $.proxy(function (index,element){ 
			if(element.active === true){
				header.append('<th>'+element.string+'</th>');
			}
		}, this));
		this.container.find("thead").append(header);
	},

	/**
	 * This function initializes the jQuery datatables
	 * @param {boolean} first If it's the first run
	 */
	initializeDatatables : function (first){
		var parent = $("#" + $(this.container).parent("div").attr("id"));
		this.dataTable = $(this.container).dataTable( {
			"sDom": "<'row-fluid'<'span2'l><'span2 hidden-phone'<'fields'>><'span8 searh-field-row'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			//"sDom": "<'row-fluid'<'span4'l<'fields'>><'span4 offset4'f>r>t<'row-fluid'<'span6'i><'span6'p>>", Use this when bootstrap 2.1.0 comes out
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": this.length_menu
			},
			"bScrollCollapse": true,
            "bAutoWidth": false,
             "sWrapper": "dataTables_wrapper form-inline"
		});
		this.generateFieldsDropdown("Fields",$(parent).find(".fields"));
		var length_select = $(parent).find(".length_select");
		$(length_select).val(this.filter_value);
		$(length_select).change($.proxy(function (){ 
			this.filter_value = $(length_select).val();
			 localStorage.setItem(this.localStorageLengthKey,$(length_select).val());
		}, this));
		$(length_select).val(this.filter_value);
		$(length_select).trigger("change");
		$(parent).find(".jqtransform").jqTransform();
		$(parent).find(".jqtransform").find("select").css("display","none");
		$(parent).find("div.jqTransformSelectWrapper ul li a").click($.proxy(function (index,element){ 
			var value = $(parent).find("div.jqTransformSelectWrapper span").text();
			this.filter_value = value;
		    $(length_select).val(value);
			$(length_select).trigger("change");
		    return false;
		}, this));
	},

	/**
	 * This fuction creates the on click modal
	 */
	createModal : function () {
		var modal = $(this.onCickModal).clone();
		modal.attr("id",this.modal_id_name);
		$(this.onCickModal).after(modal);
		$("#" + this.modal_id_name).modal({
			keyboard: true,
			show : false
		});

		$(this.container).find("tbody tr").live("click",$.proxy(function(event){
			var html = $(this.onCickModal).html();
			var object = $(event.target).parent("tr");
			html = html.replace(/\{([a-zA-Z_\.]*)\}/g, $.proxy(function (match, contents, offset, s) {
				if (objx.get(this.response[object.attr("data-index")],contents) != null) {
					return objx.get(this.response[object.attr("data-index")],contents);
				} else {
					return "";
				}
			},this));
			$("#"+this.modal_id_name).html(html);
			this.runHandlers($(event.target));
			$("#"+this.modal_id_name).modal("show");
		},this));
		$("#" + this.modal_id_name).find(".modal-footer").find(".btn-primary").live("click",$.proxy(function(){
			var object = {};
			$("#"+this.modal_id_name).find("[data-name]").each(function (index, element) {
				objx.set(object,$(element).attr("data-name"),$(element).val());
			});
			var location = this.save_request_type || this.requestType || null;

			if (location != null) {
				var type = "POST";
				if ($("#"+this.modal_id_name).find('[name=id]') != null) {
					type = "PUT";
					var requestUrl = this.root + location + "/" + $("#"+this.modal_id_name).find('[name=id]').val();
				} else {
					var requestUrl = this.root + location;
				}
				console.log(JSON.stringify(requestUrl));
				$.ajax({
					url : requestUrl,
					data : JSON.stringify(object),
					type : type,
					success : function (data) {
						console.log(data);
					}
				});
			}
		},this));
	},

	/**
	 * This function builds the handler request ulr
	 * @param  {object} handler The handler to build the url from
	 * @return {string}
	 */
	buildHandlerUrl : function (handler) {
		var url = handler.url;
		if (objx.get(handler,"query_parameters") != null) {
			if (url.indexOf("?") == -1) {
				url += "?";
			}
			$.each(handler.query_parameters,function (index, current) {
				if (current.indexOf("#") != -1) {
					url += index + "=" + $(current).val() + "&";
				} else {
					url += index + "=" + current + "&";
				}
			});
		}
		if (objx.get(handler,"fill_values") != null) {
			if (url.indexOf("?") == -1) {
				url += "?";
			}
			var modal_name = "#"+this.modal_id_name;
			$.each(handler.fill_values,function (index, current) {
				current = $(modal_name).find(current);
				if ($(current).length > 0 && $(current).val() != null && $(current).val() != undefined) {
					url += index + "=" + $(current).val() + "&";
 				}
			});
		}
		return url;
	},

	/**
	 * This function runs the data processing handlers
	 * @param  {object} object The clicked object
	 */
	runHandlers : function ( object ) {
		if (this.handlers != null) {
			$.each(this.handlers,$.proxy(function(key, handler){
				if (typeof handler.type == "undefined" || handler.type == "select") {
					var url = this.buildHandlerUrl(handler);
					if (url.indexOf("&") != -1) {
						url = url.slice(0,url.length-1);
					}
					$.ajax({
						url : url,
						success : $.proxy(function (data){
							if (objx.get(handler,"response_key") != null) {
								data = data[handler.response_key];
								this.handlers[key].response = data;
							}
							//Beaware of this line
							$("#"+this.modal_id_name).find('[data-handler="'+ key +'"]').each(function (i, currentElement) {
								currentElement = $(currentElement).find("select");
								$(currentElement).html("");
								$.each(data,function (currentIndex, curElement){
									if ($(currentElement).attr("data-selected") == objx.get(curElement,"id")) {
										$(currentElement).append('<option selected value="' + objx.get(curElement,"id") + '">' + objx.get(curElement,handler.property) + '</option>');
									} else {
										$(currentElement).append('<option value="' + objx.get(curElement,"id") + '">' + objx.get(curElement,handler.property) + '</option>');
									}
								});
								if (currentElement.parent("form").length > 0) {
									currentElement.parent("form").jqTransform();
								}
							});
						}, this)
					});
				} else if (handler.type == "typeahead") {
					var tableCreator = this;
					$("#"+this.modal_id_name).find('[data-handler="'+ key +'"]').each(function (i, currentElement) {
						currentElement = $(currentElement).find(".typeahead");
						currentElement.typeahead({
						    source: function (typeahead, query) {
						    	var url = tableCreator.buildHandlerUrl(handler);
						    	if (typeof handler.query_key != "undefined" && query != null && query != "") {
						    		if (url.indexOf("?") != -1) {
						    			if (url.indexOf("&") != -1) {
											url += handler.query_key + "=" + query + "&";
										} else {
											url += handler.query_key + "=" + query + "&";
										}
									} else {
										url += "?" + handler.query_key + "=" + query;
									}
								}
								if (url.indexOf("&") != -1) {
									url = url.slice(0,url.length-1);
								}
						        return $.get(url,function (data) {
						        	if (objx.get(handler,"response_key") != null) {
										data = data[handler.response_key];
									}
						        	return typeahead.process(data);
						        });
						    },
						    property: handler.property,
						});
					});		
				}
			},this));
		}
	},

	/**
	 * This function is used to redraw the table
	 */
	refreshTable : function () {
		this.container.find("thead").html("");
		this.generateColumns();
		this.container.find("tbody").html("");
		this.dataTable.fnClearTable();
		this.dataTable.fnDestroy();
		$.each(this.response, $.proxy(function (index,element){ 
			this.generateNode(element,index);
			if(index == this.response.length-1){
				this.initializeDatatables(false);
			}	
		}, this));
	}
}