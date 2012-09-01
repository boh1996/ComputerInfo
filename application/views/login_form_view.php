<html>
	<head>
	</head>

	<body>
		<form method="post" action="<?php echo (strpos(site_url('login/check'),'http') !== false) ? site_url('login/check') : 'http://'.site_url('login/check'); ?>">
			<p>
				<label for="username">Username</label>
				<input type="text" id="username" name="username">
			</p>
			<p>
				<label for="password">Password</label>
				<input type="password" id="password" name="password">
			</p>
			<input type="submit">
		</form>
	</body>
</html>