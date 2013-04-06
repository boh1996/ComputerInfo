<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo ( isset($page) ) ? $page : ""; ?></title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

		<script>if (location.hostname == "127.0.0.1") { document.write('<script src="' + location.protocol + '//'  + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=2"></' + 'script>') }</script>
	
		<?php
			if ( isset($style_includes) ) {
				foreach ($style_includes as $include) {
					echo '<link rel="stylesheet" type="text/css" href="' . $asset_url . "/" . $include.'">';
				}
			}
		?>

	</head>
	<body>