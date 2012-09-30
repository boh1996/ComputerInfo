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
		<!-- charset -->
		<meta charset="utf-8">
		<!-- viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<!-- styles -->
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<style type="text/css">
			body {
				padding-top: 45px;
				padding-bottom: 40px;
			}
			.dropdown-menu label {
				display: block !important;
			}
		</style>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">ComputerInfo</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#about">About</a></li>
						</ul>
						<ul class="nav pull-right">
							<li><a href="/users/sign_up">Sign Up</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
								<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
									<form method="post" action="<?php echo $base_url; ?>login/check" method="post" accept-charset="UTF-8">
										<input style="margin-bottom: 15px;" type="text" placeholder="Username" id="username" name="username"/>
										<input style="margin-bottom: 15px;" type="password" placeholder="Password" id="password" name="password" />
										<input style="float: left; margin-right: 10px;" type="checkbox" name="remember-me" id="remember-me" value="1" />
										<label class="string optional" for="user_remember_me"> Remember me</label>
										<input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" id="sign-in" value="Sign In" />
										<label style="text-align:center;margin-top:5px">or</label>
										<input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="button" id="sign-in-google" value="Sign In Using Google" />
									</form>
								</div>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="span12"><h1>ComputerInfo - The source of information </h1></div>
				<div class="span12">
					<h4>With CoumputerInfo you've got all the information you need at your fingertips, right when you need them most.</h4>
				</div>
				<div class="span12">

				</div>
				<div class="span5">
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
				</div>
				<div class="span7">
					<div id="myCarousel" class="carousel slide">
						<div class="carousel-inner">
							<div class="active item">
								<img src="<?php echo $asset_url; ?>images/Home.png"/>
								<div class="carousel-caption">
									<h4>Modern easy to use control panel</h4>
									<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								</div>
							</div>
							<div class="item">
								<img src="<?php echo $asset_url; ?>images/Android.png"/>
								<div class="carousel-caption">
									<h4>All new fresh Android app</h4>
									<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								</div>
							</div>
						</div>
						<!-- Carousel nav -->
						<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
					</div>
				</div>
			</div>
		</div>
		<?php 
			if ($dev_mode) {
				echo '<script type="text/javascript" src="'.$asset_url.'js/jquery.min.js"></script>';
			} else {
				echo '<script type="text/javascript" src="'.$jquery_url.'"></script>';
			}
		?>
		<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.history.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var url = document.location.toString();
				var baseUrl =  <?php echo '"'.$base_url.'"'; ?>;
				if (url.indexOf("home/login") != -1) {
					$('.dropdown-toggle').dropdown("toggle");
					$("#username").focus();
				}
				$("#sign-in-google").click(function () {
					document.location = <?php echo '"'.$base_url.'login/google"' ?>;
				})
			});
		</script>
	</body>
</html>