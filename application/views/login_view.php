<!DOCTYPE html>
<html>
	<head>
		<title>ComputerInfo - Login</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/form.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
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
				    		<a data-target="login" data-title="ComputerInfo - Login" href="#">Login</a>
				  		</li>
						<li>
							<a data-target="back" data-title="ComputerInfo - Back" href="<?php echo $base_url.'home/login'; ?>">Back</a>
						</li>		          
					</ul>
		      	</div>
		 
		    </div>
		  </div>
		</div>

		<div id="page">
			<div class="page-container">
				<a class="btn" href="<?php echo $this->computerinfo_security->CheckHTTPS(site_url('login/username')); ?>">Username & Password</a><br><br>
				<a class="btn" href="<?php echo $this->computerinfo_security->CheckHTTPS(site_url('login/google')); ?>">Google</a>
      		</div>
      	</div>

		<!-- Include jquery,boostrap and script -->
		<?php 
			if ($dev_mode) {
				echo '<script type="text/javascript" src="'.$asset_url.'js/jquery.min.js"></script>';
			} else {
				echo '<script type="text/javascript" src="'.$jquery_url.'"></script>';
			}
		?>
		<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.history.js"></script>
	</body>
</html>