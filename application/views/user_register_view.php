<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo (isset($title))? $title : $this->lang->line('ui_register'); ?></title>
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
		      		<?php echo $this->lang->line('ui_brand_name'); ?>
		      	</a>

			    <!-- Everything you want hidden at 940px or less, place within here -->
			    <div class="nav-collapse">
			     	<ul class="nav">
			     		<li class="active">
				    		<a data-target="login" data-title="<?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_register'); ?>" href="<?php echo $base_url.'/users/sign_up'; ?>"><?php echo $this->lang->line('ui_register'); ?></a>
				  		</li>
				  		<li>
							<a data-title="<?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_login'); ?>" href="<?php echo $base_url.'home/login'; ?>"><?php echo $this->lang->line('ui_login'); ?></a>
						</li>
		        		<li>
							<a data-target="back" data-title="<?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_back'); ?>" href="<?php echo $base_url.'home'; ?>"><?php echo $this->lang->line('ui_back'); ?></a>
						</li>
					</ul>
		      	</div>
		 
		    </div>
		  </div>
		</div>

		<div id="page">
			<div class="container" class="center page-box" style="width:550px; padding-top: 80px;">
				<form method="post" action="<?php echo $base_url; ?>user/register/check" method="post" class="form-horizontal well" id="register-form" accept-charset="UTF-8">
					<div id="messages">

					</div>
					<div class="control-group">
						<label class="control-label" for="username"><?php echo $this->lang->line('ui_register_username'); ?>:</label>
						<div class="controls">
							<input type="text" placeholder="<?php echo $this->lang->line('ui_register_username'); ?>" <?php if(isset($username)) echo 'value="'.$username.'"'; ?> required autofocus id="username" pattern="[a-zA-Z0-9]{<?php echo $this->config->item("username_length"); ?>,}" name="username" title="Minimum <?php echo $this->config->item("username_length"); ?> characters"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password"><?php echo $this->lang->line('ui_regsiter_password'); ?>:</label>
						<div class="controls">	
							<input type="password" placeholder="<?php echo $this->lang->line('ui_regsiter_password'); ?>" pattern=".{<?php echo $this->config->item("password_length"); ?>,}" title="Minimum <?php echo $this->config->item("password_length"); ?> characters" required id="password" name="password" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="re-password"><?php echo $this->lang->line('ui_register_repeat_password'); ?>:</label>
						<div class="controls">	
							<input type="password" placeholder="<?php echo $this->lang->line('ui_re_passowrd'); ?>" pattern=".{<?php echo $this->config->item("password_length"); ?>,}" title="Minimum <?php echo $this->config->item("password_length"); ?> characters" required id="re-password" name="re-password" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="email"><?php echo $this->lang->line('ui_register_email'); ?>:</label>
						<div class="controls">
							<input type="email" placeholder="<?php echo $this->lang->line('ui_register_email'); ?>" <?php if(isset($email)) echo 'value="'.$email.'"'; ?> id="email" required name="email" >
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="name"><?php echo $this->lang->line('ui_register_name'); ?>:</label>
						<div class="controls">
							<input type="text" placeholder="<?php echo $this->lang->line('ui_register_name'); ?>" <?php if(isset($name)) echo 'value="'.$name.'"'; ?> id="name" required name="name" >
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
							<label class="control-label"><?php echo $this->lang->line('captcha_recaptcha'); ?>:</label>
							<div class="controls">
						    	<a id="recaptcha_image" class="thumbnail"></a>
						    	<div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php echo $this->lang->line('captcha_error_incorrect'); ?></div>
							</div>
					    </div>

					   	<div class="control-group">
					   		<label class="recaptcha_only_if_image control-label"><?php echo $this->lang->line('captcha_enter_words_above'); ?></label>
					  		<label class="recaptcha_only_if_audio control-label"><?php echo $this->lang->line('captcha_enter_words_you_hear'); ?></label>

					  		<div class="controls">
					  			<div class="input-append">
					  				<input type="text" id="recaptcha_response_field" required class="input-recaptcha" placeholder="<?php echo $this->lang->line('capctha_enter_the_capctha'); ?>" name="recaptcha_response_field" />
					  				<a class="btn" href="javascript:Recaptcha.reload()"><i class="icon-refresh"></i></a>
					  				<a class="btn recaptcha_only_if_image" href="javascript:Recaptcha.switch_type('audio')"><i title="<?php echo $this->lang->line('captcha_get_audio'); ?>" class="icon-headphones"></i></a>
					  				<a class="btn recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type('image')"><i title="<?php echo $this->lang->line('captcha_get_image'); ?>" class="icon-picture"></i></a>
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
							<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="submit" id="register" value="<?php echo $this->lang->line('ui_register'); ?>" />
						 </div>
					</div>
					<div class="control-group">
						<label class="control-label" ><?php echo $this->lang->line('ui_or'); ?></label>
						<div class="controls">
							<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="button" id="register-google" value="<?php echo $this->lang->line('ui_register_using_google'); ?>" />
						</div>
					</div>
				</form>
			</div>
      	</div>

      	<div class="alert alert-error" id="alert" style="display:none;">
  			<button type="button" class="close" data-dismiss="alert">×</button>
  			<strong><?php echo $this->lang->line('ui_warning'); ?></strong><div id="alert-content"></div>
		</div>

		<div class="alert allert-error error" id="error" style="display:none;">
  			<button type="button" class="close" data-dismiss="alert">×</button>
  			<strong><?php echo $this->lang->line('ui_warning'); ?></strong><div class="error-content"></div>
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
				if (typeof errors != "undefined") {
					$.each(errors,function(index,element) {
						var object = $("#error").clone();
						object.attr("id","");
						object.css("display","");
						if (element == "incorrect-captcha-sol") {
							$(object).find(".error-content").append('<span class="label label-important"><?php echo $this->lang->line('ui_register_incorrect_captcha'); ?></span>');
						} else {
							$(object).find(".error-content").append('<span class="label label-important">'+element+'!</span>');
						}
						$("#messages").append(object);
					});
				}

				$("#username").focus();
				$("#register-google").click(function () {
					document.location = <?php echo '"'.$base_url.'login/google"' ?>;
				})
				$("#register-form").on("submit",function(e){
					e.stopPropagation();
					if ($("#password").val() == $("#re-password").val()) {
						$(this).submit();
					} else {
						e.preventDefault();
						$("#alert-content").html("Passwords are not matching");
						$("#alert").show();
						setTimeout(function(){
							$("#alert-content").html("");
							$("#alert").hide();
						},2000);
					}
				});
				$('input, label').click(function(e) {
					e.stopPropagation();
				});
			});
		</script>
	</body>
</html>