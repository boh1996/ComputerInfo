<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_reset_password_page'); ?></title>
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
				    		<a data-target="reset" data-title="<?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_reset_password_page'); ?>" href="#">Forgot Password</a>
				  		</li>
			     		<li>
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
				<form method="post" action="<?php echo $base_url; ?>user/password/new/check" method="post" class="form-horizontal well" id="register-form" accept-charset="UTF-8">

					<input type="hidden" name="token" <?php if(isset($token))echo 'value="'.$token.'"'; ?> />

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
					 	 <div class="controls">
							<input class="btn btn-primary" tabindex="3"  style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="submit" id="reset" value="<?php echo $this->lang->line('ui_reset_password'); ?>" />
						 </div>
					</div>
				</form>
			</div>
      	</div>

      	<div class="alert allert-error error" id="error" style="display:none;">
  			<button type="button" class="close" data-dismiss="alert">×</button>
  			<strong>Warning!</strong><div class="error-content"></div>
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

				$("#password").focus();
				$('input, label').click(function(e) {
					e.stopPropagation();
				});
			});
		</script>
	</body>
</html>