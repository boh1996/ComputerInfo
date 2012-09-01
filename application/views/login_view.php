<html>
	<head>
	</head>

	<body>
		<a href="<?php echo (strpos(site_url('login/username'),'http') !== false) ? site_url('login/username') : 'http://'.site_url('login/username'); ?>">Username & Password</a><br>
		<a href="<?php echo (strpos(site_url('login/google'),'http') !== false) ? site_url('login/google') : 'http://'.site_url('login/google'); ?>">Google</a>
	</body>
</html>