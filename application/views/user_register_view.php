<!DOCTYPE html>
<html>
	<head>
		<title>ComputerInfo - Register</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/form.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/user.css">
	</head>

	<body>
		<?php
			if (isset($missing) && $missing != "") {
				echo '<script type="text/javascript">var errors = ',$missing,';</script>';
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
							<a data-target="back" data-title="ComputerInfo - Back" href="<?php echo $base_url.'home'; ?>">Back</a>
						</li>
					</ul>
		      	</div>
		 
		    </div>
		  </div>
		</div>

		<div id="page">
			<div class="page-container">
				   <table id="wrapper">
     				 <tr>
     				 	<td>
							<div class="container" style="width:220px;">
								<form method="post" action="<?php echo $base_url; ?>user/register/check" method="post" accept-charset="UTF-8">
									<label style="float:left" for="username">Username:</label>
									<input style="margin-bottom: 15px;" type="text" placeholder="Username" id="username" name="username"/>

									<label style="float:left" for="password">Password:</label>
									<input style="margin-bottom: 15px;" type="password" placeholder="Password" id="password" name="password" />

									<label style="float:left" for="email">Email:</label>
									<input style="margin-bottom: 15px;" type="email" placeholder="Email" id="email" name="email" >

									<label style="float:left" for="name">Name:</label>
									<input style="margin-bottom: 15px;" type="text" placeholder="Name" id="name" name="name" >

									<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="submit" id="register" value="Register" />
									<label style="text-align:center;margin-top:5px">or</label>
									<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="button" id="register-google" value="Register Using Google" />
								</form>
							</div>
						</td>
					</tr>
				</table>
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
		<script type="text/javascript" src="<?php echo $asset_url; ?>js/html5shiv.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#username").focus();
				$("#register-google").click(function () {
					document.location = <?php echo '"'.$base_url.'login/google"' ?>;
				})
				$('input, label').click(function(e) {
					e.stopPropagation();
				});
			});
		</script>
	</body>
</html>