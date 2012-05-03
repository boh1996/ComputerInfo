<html>
	<head>
		<title>ComputerInfo - Home</title>
		<link rel="stylesheet" type="text/css" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/dataTables.bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
		<script type="text/javascript">var root = "<?php echo $base_url; ?>";</script>
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
	      	<a class="brand pull-left" href="#">ComputerInfo</a>

		    <!-- Everything you want hidden at 940px or less, place within here -->
		    <div class="nav-collapse">
		     	<ul class="nav">
		     		<li class="active">
			    		<a data-target="computer" data-title="ComputerInfo - Computers" href="#">Computere</a>
			  		</li>
				  	<li>
				  		<a data-target="printer" href="#">Printere</a>
				  	</li>
					<li>
				    	<a data-target="units" href="#">Enheder</a>
				  	</li>
				  	<li>
				  		<a data-target="organizations" href="#">Organizationer</a>
				  	</li>
				</ul>
	      	</div>
	 
	    </div>
	  </div>
	</div>

	<div id="page">
		<div class="container" style="margin-top: 10px">		
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="computer">
				<thead>
					<!--<tr>
						<th>Id</th>
						<th>Identifier</th>
						<th>LAN MAC</th>
						<th>Wifi MAC</th>
						<th>Ip</th>
						<th>Disk</th>
						<th>RAM</th>
						<th>Serial</th>
						<th>OS</th>
						<th>Screen size</th>
						<th>Location</th>
						<th>Power usage</th>
					</tr>-->
				</thead>
				<tbody>
	
				</tbody>
			</table>	
		</div>
	</div>

	<!-- Include jquery,boostrap and script -->
	<script type="text/javascript" src="<?php echo $jquery_url; ?>"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.history.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/computerGenerator.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/script.js"></script>
	</body>
</html>