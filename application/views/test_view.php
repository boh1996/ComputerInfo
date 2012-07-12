<html>
	<head>
		<title>ComputerInfo - Home</title>
	<body>

	<!-- Include jquery,boostrap and script -->
	<script type="text/javascript" src="<?php echo $jquery_url; ?>"></script>
	</body>

	<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url : "http://192.168.0.195/ci/computer/95",
			data : '{"model":{"name":"nc6120"},"location":"15","lan_mac":"00-15-60-B9-9B-2E","wifi_mac":"","ip":"10.97.246.107","disk_space":"37","ram_size":"1015","serial":"HUB6160V9Y","screen_size":"3"}',
			type : "PUT",
			success : function (data) {
				console.log(data);
			}
		});
	});

	</script>
</html>