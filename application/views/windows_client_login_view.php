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
	</head>

	<body>
		Hey!

	
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
		});
		</script>
	</body>
</html>