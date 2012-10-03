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
				    		<a data-target="reset" data-title="ComputerInfo - Reset Password" href="#">Forgot Password</a>
				  		</li>
			     		<li>
				    		<a data-target="register" data-title="ComputerInfo - Login" href="<?php echo $base_url.'home/users/sign_up'; ?>">Register</a>
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

		<div id="page">
			<div class="container" class="center page-box" style="width:550px; padding-top: 80px;">
				<form method="post" action="<?php echo $base_url; ?>user/reset/password/check" method="post" class="form-horizontal well" id="register-form" accept-charset="UTF-8">

					<div class="control-group">
						<label class="control-label" for="email">Email:</label>
						<div class="controls">
							<input type="email" placeholder="Email" <?php if(isset($email)) echo 'value="'.$email.'"'; ?> id="email" required name="email" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Password:</label>
						<div class="controls">	
							<input type="password" placeholder="Password" pattern=".{<?php echo $this->config->item("password_length"); ?>,}" title="Minimum <?php echo $this->config->item("password_length"); ?> characters" required id="password" name="password" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="re-password">Repeat password:</label>
						<div class="controls">	
							<input type="password" placeholder="Re-Password" pattern=".{<?php echo $this->config->item("password_length"); ?>,}" title="Minimum <?php echo $this->config->item("password_length"); ?> characters" required id="re-password" name="re-password" />
						</div>
					</div>

					<script type="text/javascript">
						 var RecaptchaOptions = {
						    theme : 'custom',
						    custom_theme_widget: 'recaptcha_widget'
						 };
					</script>
					<div id="recaptcha_widget" style="display:none">

						<div class="control-group">
							<label class="control-label">reCAPTCHA</label>
							<div class="controls">
						    	<a id="recaptcha_image" class="thumbnail"></a>
						    	<div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>
							</div>
					    </div>

					   	<div class="control-group">
					   		<label class="recaptcha_only_if_image control-label">Enter the words above:</label>
					  		<label class="recaptcha_only_if_audio control-label">Enter the numbers you hear:</label>

					  		<div class="controls">
					  			<div class="input-append">
					  				<input type="text" id="recaptcha_response_field" required class="input-recaptcha" name="recaptcha_response_field" />
					  				<a class="btn" href="javascript:Recaptcha.reload()"><i class="icon-refresh"></i></a>
					  				<a class="btn recaptcha_only_if_image" href="javascript:Recaptcha.switch_type('audio')"><i title="Get an audio CAPTCHA" class="icon-headphones"></i></a>
					  				<a class="btn recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type('image')"><i title="Get an image CAPTCHA" class="icon-picture"></i></a>
							    	<a class="btn" href="javascript:Recaptcha.showhelp()"><i class="icon-question-sign"></i></a>
					  			</div>
					  		</div>
						</div>

					</div>

					<script type="text/javascript"
					   src="<?php echo $recaptcha_url; ?>">
					</script>

					<noscript>
					    <iframe src="<?php echo $recaptcha_noscript_url; ?>"
					       height="300" width="500" frameborder="0"></iframe><br>
					    <textarea name="recaptcha_challenge_field" rows="3" cols="40">
					    </textarea>
					    <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
					  </noscript>

					  <div class="control-group">
					 	 <div class="controls">
							<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="submit" id="change" value="Change Password" />
						 </div>
					</div>
				</form>
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
		<script type="text/javascript" src="<?php echo $asset_url; ?>js/html5shiv.js"></script>

	</body>
</html>