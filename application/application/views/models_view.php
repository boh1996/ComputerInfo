<!-- Computer Modal -->
<div class="modal hide" id="edit_computer">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">&times;</button>
    	<h3>Edit {identifier}</h3>
 	</div>
  	<div class="modal-body">
  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
  			<input type="hidden" name="id" value="{id}">
	  		<tr><td>Identifier</td><td><input type="text" data-name="identifier" class="input-large" value="{identifier}" name="model"></td></tr>
	    	<tr data-handler="model"><td>Model</td><td>
	    		<input name="model" placeholder="Model" type="text" data-provide="typeahead" data-name="model.name" class="typeahead" value="{model.name}"><i data-property="name" data-response-key="Computer_Model" data-add-model="add_computer_model" class="icon-plus spacing1"></i>
	    	</td></tr>
	    	<tr data-handler="model_type"><td>Type</td><td>
	    		<form class="jqtransform"><select name="type" class="type_select" data-selected="{model.type.id}">
	    		</select></form>
	    	</td></tr>
	    	<tr data-handler="location"><td>Location</td><td>
	    		<form class="jqtransform"><select name="location" data-name="location" data-selected="{location.id}">
	    		</select></form>
	    	</td></tr>
	    	<tr><td>LAN Mac</td><td><input placeholder="Lan mac" type="text" class="input-large" data-name="lan_mac" value="{lan_mac}" name="lan_mac"></td></tr>
	    	<tr><td>Wifi Mac</td><td><input type="text" placeholder="Wifi Mac" class="input-large" value="{wifi_mac}" data-name="wifi_mac" name="wifi_mac"></td></tr>
	    	<tr><td>IP</td><td><input type="text" placeholder="Ip" class="input-large" value="{ip}" name="ip" data-name="ip"></td></tr>
	    	<tr><td>Disk space</td><td><input type="text" placeholder="Disk size" class="input-large" value="{disk_space}" data-name="disk_space" name="disk_space"></td></tr>
	    	<tr><td>Ram size</td><td><input type="text" class="input-large" placeholder="Ram space" value="{ram_size}" data-name="ram_size" name="ram_size"></td></tr>
	    	<tr><td>Serial</td><td><input type="text" class="input-large" value="{serial}" placeholder="Serial" data-name="serial" name="serial"></td></tr>
	    	<tr data-handler="screen_size"><td>Screen size</td><td>
	    		<form class="jqtransform"><select name="screen_size" data-name="screen_size" data-selected="{screen_size.id}">
	    		</select></form>
	    	</td></tr>
	    	<tr><td>Power usage</td><td><input type="text" class="input-large" value="{power_usage_per_hour}" placeholder="Power usage" name="power_usage_per_hour"></td></tr>
    	</table>
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
    	<a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
  	</div>
</div>

<!-- Printer Modal -->
<div class="modal hide" id="edit_printer">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">&times;</button>
    	<h3>Edit {identifier}</h3>
 	</div>
  	<div class="modal-body">
  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
  			<input type="hidden" name="id" value="{id}">
	  		<tr data-handler="location"><td>Location</td><td>
	    		<form class="jqtransform"><select name="location" data-name="location" data-selected="{location.id}">
	    		</select></form>
	    	</td></tr>
	    	<tr data-handler="model"><td>Model</td><td>
	    		<input name="model" type="text" placeholder="Model" data-provide="typeahead" data-name="model.name" class="typeahead" value="{model.name}">
	    	</td></tr>
	    	<tr><td>Identifier</td><td><input type="text" placeholder="Identifier" class="input-large" value="{identifier}" data-name="identifier"></td></tr>
	    	<tr><td>Name</td><td><input type="text" class="input-large" placeholder="Name" value="{name}" data-name="name"></td></tr>
	    	<tr><td>Ip</td><td><input type="text" class="input-large" value="{ip}" placeholder="Ip" data-name="ip"></td></tr>
	    	<tr><td>MAC</td><td><input type="text" class="input-large" value="{mac}" placeholder="Mac" data-name="mac"></td></tr>
    	</table>
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
    	<a href="#" class="btn btn-primary">Save changes</a>
  	</div>
</div>

<!-- Unit Modal -->
<div class="modal hide" id="edit_unit">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">&times;</button>
    	<h3>Edit {identifier}</h3>
 	</div>
  	<div class="modal-body">
  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
  			<input type="hidden" name="id" value="{id}">
	  		<tr data-handler="location"><td>Location</td><td>
	    		<form class="jqtransform"><select name="location" data-name="location" data-selected="{location.id}">
	    		</select></form>
	    	</td></tr>
	    	<tr data-handler="model"><td>Model</td><td>
	    		<input name="model" placeholder="Model" type="text" data-provide="typeahead" data-name="model.name" class="typeahead" value="{model.name}">
	    	</td></tr>
	    	<tr data-handler="model_type"><td>Type</td><td>
	    		<form class="jqtransform"><select name="type" class="type_select" data-selected="{model.type.id}">
	    		</select></form>
	    	</td></tr>
	    	<tr><td>Description</td><td><textarea placeholder="Description" data-name="description"></textarea>{description}</td></tr>
	    	<tr><td>Identifier</td><td><input type="text" class="input-large" placeholder="Identifier" value="{identifier}" data-name="identifier"></td></tr>
	    	<tr><td>Serial</td><td><input type="text" class="input-large" value="{serial}" placeholder="Serial" data-name="serial"></td></tr>
	    	<tr><td>Year of purchase</td><td><input type="text" class="input-large" value="{year_of_purchase}" placeholder="Year of purchase" data-name="year_of_purchase"></td></tr>
    	</table>
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
    	<a href="#" class="btn btn-primary">Save changes</a>
  	</div>
</div>

<!-- Location modal -->
<div class="modal hide" id="edit_location">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">&times;</button>
    	<h3>Edit {name}</h3>
 	</div>
  	<div class="modal-body">
  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
  			<input type="hidden" name="id" value="{id}">
	    	<tr><td>Name</td><td><input type="text" placeholder="Name" class="input-large" value="{name}" data-name="name"></td></tr>
	    	<tr><td>Room number</td><td><input type="text" placeholder="Room number" class="input-large" value="{room_number}" data-name="room_number"></td></tr>
    		<!-- Building Select -->
    		<!-- Floor Select -->
    	</table>
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
    	<a href="#" class="btn btn-primary">Save changes</a>
  	</div>
</div>

<!-- Screen modal -->
<div class="modal hide" id="edit_screen">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">&times;</button>
    	<h3>Edit {identifier}</h3>
 	</div>
  	<div class="modal-body">
  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
  			<input type="hidden" name="id" value="{id}">
	    	<tr><td>Identifier</td><td><input type="text" class="input-large" value="{identifier}" data-name="identifier"></td></tr>
	    	<tr data-handler="location"><td>Location</td><td>
	    		<form class="jqtransform"><select name="location" data-name="location" data-selected="{location.id}">
	    		</select></form>
	    	</td></tr>
			<tr data-handler="model"><td>Model</td><td>
	    		<input name="model" placeholder="Model" type="text" data-provide="typeahead" data-name="model.name" class="typeahead" value="{model.name}">
	    	</td></tr>
	    	<tr data-handler="computer"><td>Connected to</td><td>
	    		<!--<form class="jqtransform"><select name="location" data-name="location" data-selected="{location.id}">
	    		</select></form>-->
	    	</td></tr>
    	</table>
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
    	<a href="#" class="btn btn-primary">Save changes</a>
  	</div>
</div>

<!-- Add computer model -->
<div class="modal hide" id="add_computer_model" data-save-endpoint="computer/model">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">&times;</button>
    	<h3>Add Computer Model</h3>
 	</div>
  	<div class="modal-body">
  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
  			<tr data-handler="manufacturer"><td>Manufacturer</td><td>
	    		<input name="manufacturer" type="text" data-provide="typeahead" class="typeahead" data-name="manufacturer.name" placeholder="Select manufacturer">
	    	</td></tr>
	    	<tr data-handler="model_type"><td>Type</td><td>
	    		<form class="jqtransform"><select name="type" class="type_select" data-name="type" data-selected="{type.id}">
	    		</select></form>
	    	</td></tr>
	    	<tr><td>Name</td><td><input placeholder="Model name" type="text" class="input-large" data-name="name"></td></tr>
	    	<!-- Computer Series -->
    	</table>
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
    	<a href="#" class="btn btn-primary">Save changes</a>
  	</div>
</div>