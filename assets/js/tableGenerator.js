/**
 * The table generators constructor
 * @param  {object} settings The settings json object
 */
function tableGenerator (settings) {
	this.requestType = settings.requestType;
	this.container = settings.container;
	this.columns = settings.columns;
	this.responseNode = settings.responseNode;
	//this.requestUrl = root + this.requestType +"/{id}";
	this.multipleResponseNode = settings.multipleResponseNode;
	this.multipleRequestType = settings.multipleRequestType;
	this.root = settings.root;
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
		this.generateTable()
	},

	/**
	 * The last computers response sent from the server
	 * @type {object}
	 */
	response : null,

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
	 */
	generateNode : function (data){
		var objectElement = $('<tr></tr>');
		if(data != null && data != undefined){
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
			success : $.proxy(function (data){
				this.response = objx.get(data,this.multipleResponseNode); 
				data = this.response;
				$.each(data, $.proxy(function (index,element){ 
					this.generateNode(element);
					if(index == data.length-1){
						this.readyCallback();
					}
				}, this));
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
		var parentElement = $('<ul class="nav nav-pills"></ul>'), 
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
			"sDom": "<'row-fluid'<'span4'l<'fields'>><'span8'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
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
		$(length_select).change($.proxy(function (){ 
			this.filter_value = $(length_select).val();
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
	 * This function is used to redraw the table
	 */
	refreshTable : function () {
		this.container.find("thead").html("");
		this.generateColumns();
		this.container.find("tbody").html("");
		this.dataTable.fnClearTable();
		this.dataTable.fnDestroy();
		$.each(this.response, $.proxy(function (index,element){ 
			this.generateNode(element);
			if(index == this.response.length-1){
				this.initializeDatatables(false);
			}	
		}, this));
	}
}