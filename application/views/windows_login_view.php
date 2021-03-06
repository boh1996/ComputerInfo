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
		<title><?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_login_page'); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/user.css">
	</head>

	<body>
   <table id="wrapper">
      	<tr>
      		<td>
				<div class="container" style="width:220px;">
					<form method="post" action="<?= $this->computerinfo_security->Proxy('login/windows'); ?>" method="post" accept-charset="UTF-8">
						<label style="float:left" for="username"><?php echo $this->lang->line('ui_login_username_or_email'); ?>:</label>
						<input style="margin-bottom: 15px;" type="text" placeholder="<?php echo $this->lang->line('ui_login_username_or_email'); ?>" id="username" name="username"/>
						<label style="float:left" for="password"><?php echo $this->lang->line('ui_login_password'); ?>:</label>
						<input style="margin-bottom: 15px;" type="password" placeholder="<?php echo $this->lang->line('ui_login_password'); ?>" id="password" name="password" />
						<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="submit" id="sign-in" value="<?php echo $this->lang->line('ui_sign_in'); ?>" />
						<label style="text-align:center;margin-top:5px"><?php echo $this->lang->line('ui_or'); ?></label>
						<input class="btn btn-primary" style="clear: left; width: 220px; height: 32px; font-size: 13px;" type="button" id="sign-in-google" value="<?php echo $this->lang->line('ui_google_login'); ?>" />
					</form>
				</div>
			</td>
		</tr>
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
			$("#username").focus();
			$("#sign-in-google").click(function () {
				document.location = "<?= $this->computerinfo_security->Proxy('login/windows/google');?>";
			})
			$('input, label').click(function(e) {
				e.stopPropagation();
			});
		});
		</script>
	</body>
</html>