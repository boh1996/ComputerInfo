var computerGenerator = {
	
	/**
	 * The api url for requesting a computer
	 * @type {string}
	 */
	requestUrl : root + "computer/{id}",

	/**
	 * The computers container
	 * @type {string}
	 */
	container : $("#computer"),

	/**
	 * The property names for the respond
	 * and the row names for them
	 * @type {Object}
	 */
	columns : {	
		"identifier" : {"string" : "Identifier", "active" : true},
		"screen_size.detection_string" : {"string" : "Screen Size", "active" : true},
		"model.type.name" : {"string" : "Type", "active" : true},
		"model.name" : {"string" : "Model", "active" : true},
		"location.name" : {"string" : "Location", "active" : false},
		"lan_mac" : {"string" : "Lan Mac", "active" : false},
		"wifimac" : {"string" : "Wifi Mac", "active" : false},
		"ip" : {"string" : "Ip", "active" : false},
		"disk_space" : {"string" : "Disk", "active" : false},
		"ram_size" : {"string" : "Ram", "active" : false},
		"model.manufacturer.abbrevation" : {"string" : "Model Manufacturer", "active" : false},
		"serial" : {"string" : "Serial", "active" : false},
		//"operating_system.version" : {"string" : "OS Version", "active" : false},
		//"operating_system.family.manufacturer.name" : {"string" : "OS Manufacturer", "active" : false},
		//"screen_size.name" : {"string" : "Screen Size Name", "active" : false},
		"screen_size.aspect_ratio" : {"string" : "Screen Aspect Ratio", "active" : false},
		//"screen_size.abbrevation" : {"string" : "Screen Size Abbrevation", "active" : false},
		"cpu.name" : {"string" : "CPU", "active" : false},
		"cpu.cores" : {"string" : "CPU Cores", "active" : false},
		"cpu.clock_rate" : {"string" : "CPU Clock Rate", "active" : false},
		"cpu.manufacturer.name" : {"string" : "CPU Manufacturer", "active" : false},
		"location.room_number" : {"string" : "Room Number", "active" : false},
		"location.floor.name" : {"string" : "Floor Number", "active" : false},
		"location.building.name" : {"string" : "Building Number", "active" : false},
		"power_usage_per_hour" : {"string" : "Power", "active" : false},
	},

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
	length_menu : '<select class="length_select"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>',

	/**
	 * This function gets a computer from the api by the id
	 * @param  {integer} id The id of the computer to get
	 * @param {function} callback The function to call when the response are retrived
	 */
	getComputer : function(id,callback){
		$.ajax({
			url : this.requestUrl.replace("{id}",id),
			success : $.proxy(function (data){ 
				data = data.Computer;
				this.generateComputer(data);
				this.readyCallback();
			}, this)
		});
	},

	/**
	 * This function generates the computers row
	 * @param  {object} data The api response data
	 */
	generateComputer : function (data){
		var compuertElement = $('<tr></tr>');
		if(data != null && data != undefined){
			var i = 0;
			$.each(this.columns, $.proxy(function (index,element){ 
				i++;
				if(this.columns[index].active == true){
					var row = objx.get(data,index);
					if(row !== undefined && row !== null && row !== -1 && row !== false){
						compuertElement.append('<th>'+ row.toString() +'</th>');
					} else {
						compuertElement.append('<th></th>');
					}
				}
				if(i == this.countProperties(this.columns)) {
					this.container.find("tbody").append(compuertElement);
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
	getComputers : function(id){
		$.ajax({
			url : root+"get/computers/"+id,
			success : $.proxy(function (data){
				this.response = data.Computers; 
				data = this.response;
				$.each(data, $.proxy(function (index,element){ 
					this.generateComputer(element);
					if(index == data.length-1){
						this.readyCallback();
					}	
				}, this));	
			}, this)
		});
	},

	/**
	 * This function generates the field selector dropdoen
	 * @param  {string} text      The dropdown text
	 * @param  {object} container The container to append too
	 */
	generateFieldsDropdown : function ( text, container ) {
		var parentElement = $('<ul class="nav nav-pills"></ul>'), 
		dropdown = $('<li class="dropdown"></li>'),
		linkElement = $('<a class="dropdown-toggle" data-toggle="dropdown" data-target="#">'+text+'<b class="caret"></b></a>'),
		items = $('<ul class="dropdown-menu inputs-list"></ul>'),
		length = this.countProperties(this.columns),
		i = 0;

		$.each(this.columns,$.proxy(function (value,object) {
			i++;
			if(this.columns[value].active == true) {
				items.append(
					'<li>'+
						'<a href="#">'+
							'<input type="checkbox" name="' + value +'" value="'+ value +'" id="'+ value +'" checked/> '+
							'  <label for="'+ value +'">' + object.string +'</label>'+
						'</a>'+
					'</li>'
				);
			} else {
				items.append(
					'<li>'+
						'<a href="#">'+
							'<input type="checkbox" name="' + value +'" value="'+ value +'" "/> '+
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
				$(".dropdown-menu li a").click(function() {
					var select = $(this).find("input");
					if ( $(select).prop("checked") == true) {
						$(select).prop("checked",false);
					} else {
						$(select).prop("checked",true);
					}
					$(select).trigger("change");
				});
				$('.dropdown-menu input, .dropdown-menu label, .dropdown-menu li').click(function(event) {
    				event.stopPropagation();
				});
				$(".dropdown-menu input").change(function() {
					if ($(this).prop("checked") === true) {
						computerGenerator.columns[this.value].active = true;
					} else {
						computerGenerator.columns[this.value].active = false;
						
					}
					computerGenerator.refreshTable();
				});
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
		computerGenerator.container.find("thead").append(header);
	},

	/**
	 * This function initializes the jQuery datatables
	 * @param {boolean} first If it's the first run
	 */
	initializeDatatables : function (first){
		this.dataTable = $(this.container).dataTable( {
			"sDom": "<'row-fluid'<'span6'l<'fields'>><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": this.length_menu
			},
			"bScrollCollapse": true,
            "bAutoWidth": false,
             "sWrapper": "dataTables_wrapper form-inline"
		});
		computerGenerator.generateFieldsDropdown("Fields",$(".fields"));
		$(".length_select").change($.proxy(function (){ 
			this.filter_value = $(".length_select").val();
		}, this));
		$(".length_select").val(this.filter_value);
		$(".length_select").trigger("change");
	},

	/**
	 * This function is used to redraw the table
	 */
	refreshTable : function () {
		computerGenerator.container.find("thead").html("");
		computerGenerator.generateColumns();
		computerGenerator.container.find("tbody").html("");
		this.dataTable.fnClearTable();
		this.dataTable.fnDestroy();
		$.each(this.response, $.proxy(function (index,element){ 
			this.generateComputer(element);
			if(index == this.response.length-1){
				computerGenerator.initializeDatatables(false);
			}	
		}, this));
	}
}