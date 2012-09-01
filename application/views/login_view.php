<html>
	<head>
		<title>ComputerInfo - Login</title>
		<link rel="stylesheet" type="text/css" href="//<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="//<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="//<?php echo $asset_url; ?>css/dataTables.bootstrap.css">
		<link rel="stylesheet" type="text/css" href="//<?php echo $asset_url; ?>css/jqtransform.css">
		<link rel="stylesheet" type="text/css" href="//<?php echo $asset_url; ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="//<?php echo $asset_url; ?>css/form.css">
		<link rel="stylesheet" type="text/css" href="//<?php echo $asset_url; ?>css/style.css">
	</head>

	<body>

		<?php $this->load->view("login_topbar_view"); ?>

		<div id="page">
			<div class="page-container">
				<a class="btn" href="<?php echo (strpos(site_url('login/username'),'http') !== false) ? site_url('login/username') : 'http://'.site_url('login/username'); ?>">Username & Password</a><br><br>
				<a class="btn" href="<?php echo (strpos(site_url('login/google'),'http') !== false) ? site_url('login/google') : 'http://'.site_url('login/google'); ?>">Google</a>
      		</div>
      	</div>

		<!-- Include jquery,boostrap and script -->
		<script type="text/javascript" src="<?php echo $jquery_url; ?>"></script>
		<script type="text/javascript" src="//<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="//<?php echo $asset_url; ?>js/jquery.history.js"></script>
	</body>
</html>