<html>
	<head>
		<title>ComputerInfo - Login</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/dataTables.bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/jqtransform.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/form.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
	</head>

	<body>

		<?php $this->load->view("login_topbar_view"); ?>

		<div id="page">
			<div class="page-container">
				<form class="form-horizontal" method="post" action="<?php echo (strpos(site_url('login/check'),'http') !== false) ? site_url('login/check') : 'http://'.site_url('login/check'); ?>">
					<div class="control-group">
						<input placeholder="Username" class="input-large" type="text" id="username" name="username">
					</div>
					<div class="control-group">
						<input placeholder="Password" class="input-large" type="password" id="password" name="password">
					</div>
					<div class="control-group">
						<input class="btn" type="submit" value="Sign in">
					</div>
				</form>
      		</div>
      	</div>

		<!-- Include jquery,boostrap and script -->
		<script type="text/javascript" src="<?php echo $jquery_url; ?>"></script>
		<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.history.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#username").focus();
			});
		</script>
	</body>
</html>