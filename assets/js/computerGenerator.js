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
		"identifier" : "Identifier",
		"operating_system" : "OS",
		"model.type.name" : "Type",
		"model.name" : "Model",
		"location.name" : "Location"
	},

	/**
	 * The funciton to be called when a operaiton is done
	 * @return {function}
	 */
	readyCallback : function(){
		this.generateTable()
	},

	dataTable : null,

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
		$.each(this.columns, $.proxy(function (index,element){ 
			if(objx.get(data,index) !== undefined && objx.get(data,index) != null && objx.get(data,index) != -1 && objx.get(data,index) != false){
				compuertElement.append('<th>'+objx.get(data,index)+'</th>');
			} else {
				compuertElement.append('<th></th>');
			}
		}, this));
		this.container.find("tbody").append(compuertElement);
		this.ensureLayout();
	},

	/**
	 * This function gets all the computers for a specific organization
	 * @param  {integer} id The organization id
	 */
	getComputers : function(id){
		$.ajax({
			url : root+"get/computers/"+id,
			success : $.proxy(function (data){ 
				data = data.Computers;
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
		var header = $("<tr></tr>");
		$.each(this.columns, $.proxy(function (index,element){ 
			header.append('<th>'+element+'</th>');
		}, this));
		this.container.find("thead").append(header);
		this.initializeDatatables();
	},

	/**
	 * This function initializes the jQuery datatables
	 */
	initializeDatatables : function (){
		this.dataTable = $(this.container).dataTable( {
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			}
		});
	}
}