<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo (isset($title))? $title : $this->lang->line('ui_register'); ?></title>
		<meta charset="utf-8">
		<!-- viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/form.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/user.css">
	</head>

	<body>
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
				<div class="well">
					<p style="text-align:center;">
						<?php
						if (isset($message)) {
							echo "<strong>".$message."</strong";
						} else {
							echo "<strong>".$this->lang->line('error_encountered')."</strong";
						}
						?>
					</p>
				</div>
			</div>
      	</div>

		<?php 
			if ($dev_mode) {
				echo '<script type="text/javascript" src="'.$asset_url.'js/jquery.min.js"></script>';
			} else {
				echo '<script type="text/javascript" src="'.$jquery_url.'"></script>';
			}
		?>
		<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
	</body>