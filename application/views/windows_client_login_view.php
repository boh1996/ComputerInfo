<?php
$dev_mode = false;
if(!isset($asset_url))
	$asset_url = "http://127.0.0.1/ci/assets/";
if(!isset($jquery_url))
	$jquery_url = "//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ComputerInfo - Home</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<style type="text/css">

		</style>
		<style type="text/css">
		body, html {
			height: 100%;
			background-color: #EEE;
		}
		html, body, #wrapper {
		   height:100%;
		   width: 100%;
		   margin: 0;
		   padding: 0;
		   border: 0;
		}
		#wrapper td {
		   vertical-align: middle;
		   text-align: center;
		}
		form {
			margin: 0;
		}
		</style>
	</head>

	<body>
   <table id="wrapper">
      <tr><td>
					<div class="container" style="width:220px;">
						<form method="post" action="https://ci.illution.dk/login/check" method="post" accept-charset="UTF-8">
							<label style="float:left" for="username">Username:</label>
							<input style="margin-bottom: 15px;" type="text" placeholder="Username" id="username" name="username"/>
							<label style="float:left" for="password">Password:</label>
							<input style="margin-bottom: 15px;" type="password" placeholder="Password" id="password" name="password" />
							<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="submit" id="sign-in" value="Sign In" />
							<label style="text-align:center;margin-top:5px">or</label>
							<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="button" id="sign-in-google" value="Sign In Using Google" />
						</form>
					</div>
	</td></tr>
</table>

	
		<?php 
			if ($dev_mode) {
				echo '<script type="text/javascript" src="'.$asset_url.'js/jquery.min.js"></script>';
			} else {
				echo '<script type="text/javascript" src="'.$jquery_url.'"></script>';
			}
		?>
		<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$("#sign-in-google").click(function () {
				document.location = "https://ci.illution.dk/login/google";
			})
			$('input, label').click(function(e) {
				e.stopPropagation();
			});
		});
		</script>
	</body>
</html>