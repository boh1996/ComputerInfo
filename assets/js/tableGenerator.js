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
	this.multipleResponseNode = settings.multipleResponseNode;
	this.multipleRequestType = settings.multipleRequestType;
	this.root = (settings.root.indexOf("http") == -1)? window.location.protocol + "://" + settings.root : settings.root;

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
	if (typeof this.getCookie("token") != undefined) {
		this.token = this.getCookie("token");
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
	 * This property can store the toke used with the API
	 * @type {string}
	 */
	token : null,

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

	/**
	 * The dessired name of the standard modal
	 * @type {string}
	 */
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
	 * A container for different functions to store data
	 * @type {Object}
	 */
	storedVariables : {},

	/**
	 * The datatables fixed header
	 * @type {object}
	 */
	fixedHeader : null,

	/**
	 * The datatable fixedheader html element
	 * @type {object}
	 */
	fixedHeaderElement : null,

	/**
	 * If the class is initializing
	 * @type {Boolean}
	 */
	initialize : true,

	/**
	 * The funciton to be called when a operaiton is done
	 * @return {function}
	 */
	readyCallback : function(){
		this.generateTable();
		if (this.doneCallback != null) {
			this.doneCallback();
		}
		this.hide();
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
	length_menu : '<form class="jqtransform"><select class="length_select"><option selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></form>',

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
	 * This function reads a cookie by name
	 * @param  {string} c_name The name of the cookie to read
	 * @return {string}
	 */
	getCookie : function (c_name) {
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++) {
		  	x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		  	y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		  	x=x.replace(/^\s+|\s+$/g,"");
		  	if (x==c_name) {
		    	return unescape(y);
		  	}
		}
	},

	/**
	 * This function sets a cookie by name
	 * @param {string} c_name The name of the cookie to set
	 * @param {string} value  The value to set
	 * @param {integer} exdays The expirering day
	 */
	setCookie : function (c_name,value,exdays) {
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
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
	 * This function adds the token parameter to the url
	 * @since 1.1
	 * @param  {string} url The current url to append the token too
	 * @param {string} token The user token0
	 * @return {string}
	 */
	createAutherizedUrl : function (url,token) {
		token = token || this.token;
		if (token != null) {
			if (url.indexOf("token=" + token) == -1) {
				if (url.indexOf("?") == -1) {
					url += "?";
				} else {
					url += "&";
				}
				url += "token=" + token;
			}
		}
		return url;
	},

	/**
	 * This function can be called when the table is hidded
	 */
	hide : function () {
		$(this.fixedHeaderElement).hide();
	},

	/**
	 * This function can be called when the table is shown
	 */
	show : function () {
		if (this.fixedHeader == null) {
			this.fixedHeader = new FixedHeader( this.dataTable, {
				 "offsetTop": 40
			} );
			this.fixedHeaderElement = this.fixedHeader.fnGetSettings().aoCache[0].nWrapper;
		} else {
			$(this.fixedHeaderElement).show();
			this.fixedHeader.fnUpdate();
		}
		this.fixedHeader.fnFix();
		this.fixedHeader.fnPosition();
	},

	/**
	 * This function gets all the computers for a specific organization
	 * @param  {integer} id The organization id
	 */
	getNodes : function(id){
		var requestUrl = this.root + "get/" + this.multipleRequestType + "/{id}";
		requestUrl = requestUrl.replace("{id}",id);
		requestUrl = this.createAutherizedUrl(requestUrl);
		$.ajax({
			url : this.createAutherizedUrl(requestUrl),
			success : $.proxy(function (data, code, XMLHttpRequest){
				if (data != null) {
					this.response = objx.get(data,this.multipleResponseNode); 
					data = this.response;
					if (data != null && data != undefined) {
						$.each(data, $.proxy(function (index,element){ 
							this.generateNode(element,index);
							if(data != null && index == data.length-1){
								this.readyCallback();
							} else if (data == null) {
								this.readyCallback();
							}
						}, this));
					}
				}
			}, this),
			error : $.proxy(function (){
				this.readyCallback();
				this.showError("No ressource could be found or an error occured!",$("#error_container"));
			}, this),
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
			url : this.createAutherizedUrl(requestUrl.replace("{id}",id)),
			success : $.proxy(function (data){ 
				data = objx.get(data,this.responseNode);
				this.generateNode(data);
				this.readyCallback();
			}, this)
		});
	},

	/**
	 * This function gets info from a url
	 * @param  {string} url   The url to get data from
	 * @param  {string} token An optional user token
	 * @return {object}
	 */
	getInfo : function ( url, token) {
		token = token || this.token || null;
		info = null;
		$.ajax({
			url : this.createAutherizedUrl(url,token),
			success : $.proxy(function (data){ 
				info = data;
			}, this)
		});
		return info;
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
						this.findSortedColumns();
						localStorage.setItem(this.localStorageColumnsKey,JSON.stringify(this.columns));
						this.refreshTable();
					}, this));
				}
			}
		},this));
	},

	/**
	 * This function adds all the sorted columns to the localstorage
	 */
	findSortedColumns : function () {
		if ($(this.fixedHeaderElement).length > 0) {
			var sort = $(this.fixedHeaderElement).find('thead th[aria-sort]');
			var current = this.getSortColumn();
			if (typeof current != undefined && current != null && sort.length > 0 && current.column != sort.attr("data-column")) {
				delete this.columns[current.column].sort;
			}
			if (this.initialize != true) {
				$.each(this.columns,$.proxy(function(column,settings){
					if (column == $(sort).attr("data-column")) {
						this.columns[column].sort = sort.attr("aria-sort");
					}
				},this));
				localStorage.setItem(this.localStorageColumnsKey,JSON.stringify(this.columns));
			}
		}
	},

	/**
	 * This function ensures that the layout is correct,
	 * also after new rows are added
	 */
	ensureLayout : function (){
		$("tbody td:odd").addClass("odd");
		$("tbody td:even").addClass("even");
		if (this.response != undefined) {
			$(this.container).find("table").find('.dataTables_empty').remove();
		}
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
				header.append('<th data-column="'+index+'">'+element.string+'</th>');
			}
		}, this));
		this.container.find("thead").append(header);
	},

	/**
	 * This function returns a JSON object containing the current sorting column
	 * @return {object}
	 */
	getSortColumn : function () {
		var sort = null;
		var sortOption = null;
		var data = null;
		$.each(this.columns, $.proxy(function (index,element){ 
			if(element.active === true){
				if (typeof element.sort != "undefined") {
					sortOption = (element.sort == "descending")? "desc" : "asc";
					var sort = $(this.container).find('thead tr th[data-column="' + index + '"]').index();
					data = {"element" : sort,"option" : sortOption,"column" : index,"columnOptions" : element};
				}
			}
		}, this));
		return data;
	},

	/**
	 * This function initializes the jQuery datatables
	 * @param {boolean} first If it's the first run
	 */
	initializeDatatables : function (first){
		this.redraw = true;
		var parent = $("#" + $(this.container).parent("div").attr("id"));
		var sort = this.getSortColumn();
		var sortSetting = (sort != undefined) ? [[sort.element,sort.option ]] : null;
		var settings = {
			"sDom": "<'row-fluid'<'span4'l<'fields'>><'span4 offset4'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": this.length_menu
			},
			"bScrollCollapse": true,
            "bAutoWidth": false,
            "iDisplayLength" : this.filter_value,
             "sWrapper": "dataTables_wrapper form-inline",
             "fnDrawCallback": $.proxy(function (){ 
             	if (this.dataTable != null) {
             		this.show();
					this.findSortedColumns();
				}	
			}, this)
		};
		if (sortSetting != null) {
			settings.aaSorting = sortSetting;
		}
		if (typeof this.searchTerm != "undefined" && this.searchTerm != null) {
			settings.oSearch = {"sSearch": this.searchTerm};
			this.searchTerm = null;
		}
		this.dataTable = $(this.container).dataTable( settings );
		$(window).trigger("resize");
		$(this.container).next(".row-fluid").find(".span6:last").append('<a class="btn btn-large-custom pull-right spacing-right"><i class="icon-plus" id="' + $(this.container).attr("id") + "-add-new" +'"></i></a>');
		this.generateFieldsDropdown("Fields",$(parent).find(".fields"));
		
		//Length Select
		var length_select = $(parent).find(".length_select");
		$(length_select).change($.proxy(function (){ 
			this.filter_value = $(length_select).val();
			 localStorage.setItem(this.localStorageLengthKey,$(length_select).val());
		}, this));

		$(parent).find(".jqtransform").jqTransform();
		$(parent).find(".jqtransform").find("select").css("display","none");

		$(parent).find("div.jqTransformSelectWrapper ul li a").click($.proxy(function (index,element){ 
			var value = $(parent).find("div.jqTransformSelectWrapper span").text();
			this.filter_value = value;
		    $(length_select).val(value);
			$(length_select).trigger("change");
			$(window).trigger("resize");
		    return false;
		}, this));

		//Redraw Done
		this.initialize = false;
		this.redraw = false;
		this.handleAdd();
	},

	handleAdd : function () {
		$("#" + $(this.container).attr("id") + "-add-new").live("click",$.proxy(function(){
		},this));
	},

	/**
	 * This function creates and handles all the events for a modal
	 * @param  {Object} modalTemplate The modal template jQuery object
	 * @param  {Object} settings      A later used settings object
	 * @param  {string} id            An optional id name of the modal
	 * @return {string}
	 */
	createModalFromObject : function (modalTemplate, settings, id) {
		modalTemplate = $(modalTemplate);
		if (id == undefined) {
			if (objx.get(this.storedVariables,"modals." + modalTemplate.attr("id")) == null || objx.get(this.storedVariables,"modals." + modalTemplate.attr("id") + ".id") == undefined) {
				var id = this.randomString(6);
			} else {
				var id = objx.get(this.storedVariables,"modals." + modalTemplate.attr("id") + ".id");
			}
		} else {
			objx.set(this.storedVariables,"modals." + modalTemplate.attr("id") + ".id",id);
		}

		if ($("#" + id).length < 0 || $("#" + id).length == 0) {
			var modal = $(modalTemplate).clone();
			objx.set(this.storedVariables,"modals." + modalTemplate.attr("id") + ".id",id);
			objx.set(this.storedVariables,"modals." + modalTemplate.attr("id") + ".type","normal");

			//Set th different attributes and show the modal
			modal.attr("id",id);
			modal.attr("data-template",modalTemplate.attr("id"));
			modalTemplate.after(modal);
			modal.modal({
				keyboard: true,
				show : false
			});
		} else {
			var modal = $("#" + id);
		}
		this.clearModal(modal);

		//Request type
		if (modalTemplate.attr("data-save-endpoint")) {
			objx.set(this.storedVariables,"modals." + modalTemplate.attr("id") + ".request_type",modalTemplate.attr("data-save-endpoint"));
		}

		//Create the corresponding events
		$("#" + id).find(".modal-footer").find(".btn-primary").live("click",$.proxy(function(event){
			var requestType = objx.get(this.storedVariables,"modals." + modalTemplate.attr("id") + ".request_type") || this.save_request_type || this.requestType || null;
			this.saveModal(modal, requestType);
		},this));

		modal.find('[data-add-model]').live("click",$.proxy(function(){
			var currentElement = $(event.target);
			var inputElement = currentElement.prev("input,select")[0];
			if (currentElement.attr("data-add-model") != "") {
				if (objx.get(this.storedVariables.modals,currentElement.attr("data-add-model")  + ".id") == null)  {
					var id = this.createModalFromObject($("#" + currentElement.attr("data-add-model")), null);
					if (id != null && id != undefined) {
						objx.set(this.storedVariables.modals,currentElement.attr("data-add-model")  + ".id",id);
					}
				} else {
					$("#" + objx.get(this.storedVariables.modals,currentElement.attr("data-add-model") + ".id")).modal("show");
				}
				this.clearModal($("#" + objx.get(this.storedVariables.modals,currentElement.attr("data-add-model") + ".id")));
				this.runHandler(currentElement,$("#" + objx.get(this.storedVariables.modals,currentElement.attr("data-add-model") + ".id")));

				//Store the corresponding values for the add modal
				objx.set(this.storedVariables.modals,currentElement.attr("data-add-model")  + ".type","add");
				objx.set(this.storedVariables.modals,currentElement.attr("data-add-model")  + ".parent_modal",modal.attr("id"));
				objx.set(this.storedVariables.modals,currentElement.attr("data-add-model")  + ".input_element",inputElement);
				objx.set(this.storedVariables.modals,currentElement.attr("data-add-model")  + ".property",currentElement.attr("data-property"));
				objx.set(this.storedVariables.modals,currentElement.attr("data-add-model")  + ".response_key",currentElement.attr("data-response-key"));
			}
		},this));

		modal.modal("show");

		return id;
	},

	/**
	 * This function clears all the modal inputs
	 * @param  {Object} modal The modal object
	 */
	clearModal : function ( modal ) {
		var modal = $(modal);
		modal.find("input").each(function (index, element) {
			$(element).val("");
		});
		modal.find("select").each(function (index, element) {
			$(element).find("option:eq(0)").attr("selected","selected");
			$(element).trigger("change");
		});
	},

	/**
	 * This function save's a modal's data
	 * @param  {Object} modal       The modal to save the data for
	 * @param  {string} requestType The save API endpoint for that modal
	 */
	saveModal : function (modal, requestType) {
		var object = {};
		modal = $(modal[0]);
		modal.find("[data-name]").each(function (index, element) {
			objx.set(object,$(element).attr("data-name"),$(element).val());
		});
		var location = requestType || this.save_request_type || this.requestType || null;

		var idInput = $(modal.find("table").find('[name="id"]'));

		if (location != null && this.countProperties(object) !== 0 && object != undefined) {
			var type = "POST";
			if (idInput.length > 0 && idInput != null && idInput.val() != "") {
				type = "PUT";
				var requestUrl = this.root + location + "/" + idInput.val();
			} else {
				var requestUrl = this.root + location;
			}

			if (requestUrl.indexOf("http") == -1) {
				requestUrl = window.location.protocol + "://" + requestUrl; //Add HTTPS options
			}
			$.ajax({
				url : this.createAutherizedUrl(requestUrl),
				data : JSON.stringify(object),
				type : type,
				success : $.proxy(function (data){ 
					modal.modal("hide");
					if (objx.get(this.storedVariables.modals,modal.attr("data-template") + ".type") == "add") {
						this.processAdd( modal, data);
					} else {
						this.processSave( modal, data);
					}
				}, this),
				error : $.proxy(function(){
					this.showError("Sorry an error encountered! Try again!",modal.find(".modal-body"));
				},this)
			});
		}
	},

	/**
	 * This function processes the recieved data from the add modal,
	 * and updates the data
	 * @param  {Object} modal The modal that just have been saved
	 * @param  {Object} data  The data sent by the server
	 */
	processAdd : function ( modal, data) {
		var modalData = objx.get(this.storedVariables.modals,modal.attr("data-template"));
		if ($(modalData.input_element).is("input")) {
			$(modalData.input_element).val(objx.get(data,modalData.response_key + "." + modalData.property));
		} else {
			var option = new Option(objx.get(data,modalData.property), objx.get(data,"id"));
			$(option).html(objx.get(data,modalData.property));
			$(modalData.input_element).append(option);
			$(modalData.input_element).val(objx.get(data,"id"));
		}
	},

	/**
	 * This function searches in a collection where a property equals a value
	 * @param  {string|Number} property The property to search in
	 * @param  {string|Number} value    The value to search for
	 * @param  {object} search   The object to search in
	 * @return {[type]}
	 */
	findByProperty : function (property, value, search) {
		for (var i = this.countProperties(search) - 1; i >= 0; i--) {
			if (objx.get(search[i],property) == value) return i;
		};
	},

	processSave : function ( modal, data) {
		var launchElement = objx.get(this.storedVariables.modals,modal.attr("id") + ".launch_element");
		var index = this.findByProperty("id",$(launchElement).attr("data-index"),this.response);
		console.log(this.response[index]);
		this.response[index] = data[this.responseNode];
		this.refreshTable();
		console.log(this.response);
	},

	/**
	 * This function shows an error
	 * @param  {string} text The error message to show
	 * @param {object} container An optional container for the message
	 */
	showError : function (text,container) {
		container = container || $("body");
		container = $(container);
		if ($(container).find(".request_error").length <= 0) {
			$(container).prepend('<div class="request_error alert fade in"></div>');
		}
		$(container).find(".request_error").css("display","block");
		$(container).find(".request_error").html("");
		$(container).find(".request_error").append('<button type="button" class="close" data-dismiss="alert">&times;</button><strong>' + text + '</strong>');
		$(container).find(".request_error").alert();

		$(container).find('.request_error').bind('closed', function () {
		 	$(".request_error").css("display","none");
		})
	},

	/**
	 * This fuction creates the on click modal
	 */
	createModal : function () {
		$(this.container).find("tbody tr").live("click",$.proxy(function(event){
			var object = $(event.target).parent("tr");
			if (object.find("td").hasClass("dataTables_empty") != true && object.find("td").hasClass("dataTables_empty") != "true") {
				var id = this.createModalFromObject($(this.onCickModal),null,this.modal_id_name);
				var html = $(this.onCickModal).html();
				html = html.replace(/\{([a-zA-Z_\.]*)\}/g, $.proxy(function (match, contents, offset, s) {
					if (this.response != undefined && objx.get(this.response[object.attr("data-index")],contents) != null) {
						return objx.get(this.response[object.attr("data-index")],contents);
					} else {
						return "";
					}
				},this));
				$("#"+id).html(html);
				if (event != undefined) {
					this.runHandler($(event.target), $("#"+id));
				}
				objx.set(this.storedVariables.modals,id + ".launch_element",object);
				;
				$("#"+id).modal("show");
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
		if (url.indexOf("http") == -1) {
			url = window.location.protocol + "://" + url; //Add option for https here
		}
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
	 * This function requests the handler data for a specific object/modal
	 * @param  {Object} object  The object that has been clicked
	 * @param  {Object} handler The handler data to use
	 * @param  {Object} modal   The modal to search insight
	 * @param  {string} key     The name of the handler in this.handlers
	 */
	runObjectHandlers : function ( object, handler, modal, key ) {
		if (handler != null) {
			if (typeof handler.type == "undefined" || handler.type == "select") {
				var url = this.buildHandlerUrl(handler);
				if (url.indexOf("&") != -1) {
					url = url.slice(0,url.length-1);
				}
				$.ajax({
					url : this.createAutherizedUrl(url),
					success : $.proxy(function (data){
						if (objx.get(handler,"response_key") != null) {
							data = data[handler.response_key];
							handler.response = data;
							this.handlers[key].response = data;
						}
						//Beaware of this line
						$(modal).find('[data-handler="'+ key +'"]').each(function (i, currentElement) {
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
								currentElement.parent("form").find("div ul").css("height","70px");
								currentElement.parent("form").jqTransform();
							}
						});
					}, this)
				});
			} else if (handler.type == "typeahead") {
				var tableCreator = this;
				modal.find('[data-handler="'+ key +'"]').each(function (i, currentElement) {
					currentElement = $(currentElement).find(".typeahead");
					currentElement.typeahead({
					    source: function (typeahead,query) {
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
							if (url != null && url.indexOf("&") != -1) {
								url = url.slice(0,url.length-1);
							}
							url = tableCreator.createAutherizedUrl(url);
							if (url != null && url != undefined) {
						        return $.get(tableCreator.createAutherizedUrl(url),function (data) {
						        	if (objx.get(handler,"response_key") != null) {
										data = data[handler.response_key];
										return typeahead.process(data);
									}
						        });
					    	}
					    },
					    property: handler.property,
					});
				});		
			}
		}
	},

	/**
	 * This function runs the data processing handlers on all modals
	 * @param  {object} object The clicked object
	 */
	runHandlers : function ( object ) {
		if (this.modals != undefined && this.handlers != undefined) {
			$.each(this.modals,$.proxy(function(name, modal){
				$.each(this.handlers,$.proxy(function(key, handler){
					this.runObjectHandlers( object, handler, modal.id, key );
				},this));
			},this));
		}
	},

	/**
	 * This function runs the handler on a single modal box
	 * @param  {object} object The object the triggered the handler event
	 * @param  {object} modal  The modal box to run the handlers for
	 */
	runHandler : function ( object, modal ) {
		$.each(this.handlers,$.proxy(function(key, handler){
			this.runObjectHandlers( object, handler, $(modal), key );
		},this));
	},

	/**
	 * This function is used to redraw the table
	 */
	refreshTable : function () {
		if (this.response != null && this.countProperties(this.response) > 0) {
			this.searchTerm = $(this.container).parent("div").find(".row-fluid:first .span4:last").find(".dataTables_filter label input").val();
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
		} else {
			this.container.find("thead").html("");
			this.generateColumns();
			this.noValuesFill();
		}
		this.fixedHeader.fnPosition();
		$(window).trigger("scroll");
		$(window).trigger("resize");
	},

	/**
	 * This function ensures that the no values line expands all the columns
	 */
	noValuesFill : function () {
		if ($(this.container).find("tbody tr:first").find('.dataTables_empty').length > 0) {
			$(this.container).find("tbody tr:first").find('.dataTables_empty').attr("colspan",$(this.container).find("thead tr th").size());
		}
	}
}