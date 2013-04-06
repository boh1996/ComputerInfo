		<div id="footer">
			<div class="navbar navbar-fixed-bottom">
			  <div class="navbar-inner">
			    <div class="container">
			 
			      	<!-- Be sure to leave the brand out there if you want it shown -->
			      	<a class="brand">
			      		<?php echo $this->lang->line('ui_copyright_line'); ?>
			      	</a>
			    </div>
			  </div>
			</div>
		</div>

		<?php
			if ( isset($script_includes) ) {
				foreach ($script_includes as $script) {
					echo '<script src="' . $asset_url . $script. '"></script>';
				}
			}
		?>

		<?php
			if ( isset($templates) ) {
				foreach ( $templates as $name => $file ) {
					echo '<script type="mustache/template" id="' . $name . '" />';
					$this->load->template($file,true);
					echo "</script>";
				}
			}
		?>

	</body>
</html>