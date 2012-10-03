<!DOCTYPE html>
<html>
	<head>
		<title>ComputerInfo - Reset Password</title>
		<meta charset="utf-8">
		<!-- viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/form.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/user.css">
	</head>

	<style type="text/css">
		a#recaptcha_image {
  			height: auto;
		}
		a#recaptcha_image img {
		    width:100%;
		    height: auto;
		}
​
	</style>

	<body>
		<?php
			if (isset($errors) && $errors != "") {
				echo '<script type="text/javascript">var errors = ',$errors,';</script>';
			}
		?>

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
		      	<a class="brand" href="<?php echo $base_url; ?>">
		      		ComputerInfo
		      	</a>

			    <!-- Everything you want hidden at 940px or less, place within here -->
			    <div class="nav-collapse">
			     	<ul class="nav">
			     		<li class="active">
				    		<a data-target="login" data-title="ComputerInfo - Login" href="<?php echo $base_url.'home/users/sign_up'; ?>">Register</a>
				  		</li>
				  		<li>
							<a data-title="ComputerInfo - Login" href="<?php echo $base_url.'home/login'; ?>">Login</a>
						</li>
		        		<li>
							<a data-target="back" data-title="ComputerInfo - Back" href="<?php echo $base_url.'home'; ?>">Back</a>
						</li>
					</ul>
		      	</div>
		 
		    </div>
		  </div>
		</div>