<html>
	<head>
		<title>ComputerInfo - Home</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/dataTables.bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/jqtransform.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/chosen.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/form.css">
		<script type="text/javascript">var root = "<?php echo $base_url; ?>";</script>
		<script type="text/javascript">var method = "<?php echo $method; ?>";</script>
	</head>
	<body>

	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	 
		      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
	        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	      	</a>
	 
	      	<!-- Be sure to leave the brand out there if you want it shown -->
	      	<a class="brand" href="#">
	      		ComputerInfo
	      	</a>

		    <!-- Everything you want hidden at 940px or less, place within here -->
		    <div class="nav-collapse">
		     	<ul class="nav">
		     		<li class="active">
			    		<a data-target="computer" data-title="ComputerInfo - Computers" href="#">Computere</a>
			  		</li>
				  	<li>
				  		<a data-target="printer" data-title="ComputerInfo - Printere" href="#">Printere</a>
				  	</li>
					<li>
				    	<a data-target="units" data-title="ComputerInfo - Enheder" href="#">Enheder</a>
				  	</li>
				  	<li>
				  		<a data-target="locations" data-title="ComputerInfo - Rum" href="#">Rum</a>
				  	</li>
				  	<!--<li>
				  		<a data-target="organizations" data-title="ComputerInfo - Organizationer" href="#">Organizationer</a>
				  	</li>-->
				  	<li>
				  		<a data-target="screens" data-title="ComputerInfo - Skaerme" href="#">Screens</a>
				  	</li>
				  	<li>
				  		<a data-target="users" data-title="ComputerInfo - Brugere" href="#">Users</a>
				  	</li>
				</ul>
	      	</div>
	 
	    </div>
	  </div>
	</div>

	<div id="page">
		<div class="page-container">	

			<!-- Computers -->
			<div id="computers" class="active_page">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="computer">

					<thead>
					</thead>
					<tbody>
		
					</tbody>
				</table>
			</div>	

			<div id="printers" class="disabled_page">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="printer">

					<thead>
					</thead>
					<tbody>
		
					</tbody>
				</table>
			</div>	

			<div id="screens" class="disabled_page">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="screen">

					<thead>
					</thead>
					<tbody>
		
					</tbody>
				</table>
			</div>

			<div id="units" class="disabled_page">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="unit">

					<thead>
					</thead>
					<tbody>
		
					</tbody>
				</table>
			</div>

			<div id="users" class="disabled_page">

			</div>

			<div id="organizations" class="disabled_page">

			</div>

			<div id="locations" class="disabled_page">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="location">

					<thead>
					</thead>
					<tbody>
		
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal hide" id="edit_computer">
		<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal">&times;</button>
	    	<h3>Edit {identifier}</h3>
	 	</div>
	  	<div class="modal-body">
	  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
	  			<input type="hidden" name="id" value="{id}">
		  		<tr><td>Identifier</td><td><input type="text" class="input-large" value="{identifier}" name="model"></td></tr>
		    	<tr data-handler="model"><td>Model</td><td>
		    		<input name="model" type="text" data-provide="typeahead" data-name="model.name" class="typeahead" value="{model.name}">
		    	</td></tr>
		    	<tr data-handler="model_type"><td>Type</td><td>
		    		<form class="jqtransform"><select name="type" class="type_select" data-selected="{model.type.id}">
		    		</select></form>
		    		<!-- data-name="model.type" -->
		    	</td></tr>
		    	<tr data-handler="location"><td>Location</td><td>
		    		<form class="jqtransform"><select name="location" data-name="location" data-selected="{location.id}">
		    		</select></form>
		    	</td></tr>
		    	<tr><td>LAN Mac</td><td><input type="text" class="input-large" data-name="lan_mac" value="{lan_mac}" name="lan_mac"></td></tr>
		    	<tr><td>Wifi Mac</td><td><input type="text" class="input-large" value="{wifi_mac}" data-name="wifi_mac" name="wifi_mac"></td></tr>
		    	<tr><td>IP</td><td><input type="text" class="input-large" value="{ip}" name="ip" data-name="ip"></td></tr>
		    	<tr><td>Disk space</td><td><input type="text" class="input-large" value="{disk_space}" data-name="disk_space" name="disk_space"></td></tr>
		    	<tr><td>Ram size</td><td><input type="text" class="input-large" value="{ram_size}" data-name="ram_size" name="ram_size"></td></tr>
		    	<tr><td>Serial</td><td><input type="text" class="input-large" value="{serial}" data-name="serial" name="serial"></td></tr>
		    	<tr data-handler="screen_size"><td>Screen size</td><td>
		    		<form class="jqtransform"><select name="screen_size" data-name="screen_size" data-selected="{screen_size.id}">
		    		</select></form>
		    	</td></tr>
		    	<tr><td>Power usage</td><td><input type="text" class="input-large" value="{power_usage_per_hour}" name="power_usage_per_hour"></td></tr>
	    	</table>
	  	</div>
	  	<div class="modal-footer">
	    	<a href="#" class="btn" data-dismiss="modal">Close</a>
	    	<a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
	  	</div>
	</div>

	<div class="modal hide" id="edit_printer">
		<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal">&times;</button>
	    	<h3>Edit {identifier}</h3>
	 	</div>
	  	<div class="modal-body">
	  		<table cellpadding="0" cellspacing="10" border="0" class="table table-striped">
		  		<tr data-handler="location"><td>Location</td><td>
		    		<form class="jqtransform"><select name="location" data-selected="{location.id}">
		    		</select></form>
		    	</td></tr>
	    	</table>
	  	</div>
	  	<div class="modal-footer">
	    	<a href="#" class="btn" data-dismiss="modal">Close</a>
	    	<a href="#" class="btn btn-primary">Save changes</a>
	  	</div>
	</div>

	<!-- Include jquery,boostrap and script -->
	<script type="text/javascript" src="<?php echo $jquery_url; ?>"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.history.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/custom-form-elements.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.jqtransform.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/settings.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/objx.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/tableGenerator.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/script.js"></script>
	</body>
</html>