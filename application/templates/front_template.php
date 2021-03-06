<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_home_page'); ?></title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>bootstrap/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/dataTables.bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/form.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/loading.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $asset_url; ?>css/scrollbar.css">

		<script type="text/javascript">var root = "<?php echo $base_url; ?>";</script>
		<script type="text/javascript">var method = "<?php echo $method; ?>";</script>
		<script type="text/javascript">var language = "<?php echo $language; ?>";</script>
		<script type="text/javascript">var front_translations = <?php echo $front_translations; ?>;</script>

		<script>if (location.hostname == "127.0.0.1") { document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=2"></' + 'script>') }</script>
	</head>
	<body>

	<script type="text/javascript">
		<?= $this->load->view("settings",true); ?>
	</script>

	<script type="text/javascript">
		<?= $this->load->view("datatables",true); ?>
	</script>

	<!--<div class="navbar navbar-fixed-top navbar-inverse">-->
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
	      	<a class="brand" href="#">
	      		<?php echo $this->lang->line('ui_brand_name'); ?>
	      	</a>

		    <!-- Everything you want hidden at 940px or less, place within here -->
		    <div class="nav-collapse">
		     	<ul class="nav">
		     		<li>
			    		<a data-target="computers" href="#"><?php echo $this->lang->line('ui_computers_page'); ?></a>
			  		</li>
				  	<li>
				  		<a data-target="printers" href="#"><?php echo $this->lang->line('ui_printers_page'); ?></a>
				  	</li>
					<li>
				    	<a data-target="units" href="#"><?php echo $this->lang->line('ui_units_page'); ?></a>
				  	</li>
				  	<li>
				  		<a data-target="locations" href="#"><?php echo $this->lang->line('ui_rooms_page'); ?></a>
				  	</li>
				  	<li>
				  		<a data-target="screens" href="#"><?php echo $this->lang->line('ui_screens_page'); ?></a>
				  	</li>
				  	<li>
				  		<a data-target="users" href="#"><?php echo $this->lang->line('ui_users_page'); ?></a>
				  	</li>
				</ul>
				<ul class="nav pull-right">
				  	<li class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown"><?php echo (!is_null($this->user_control->user))? $this->user_control->user->name :$this->lang->line('ui_user') ; ?>&nbsp;<strong class="caret"></strong></a>
						<ul class="dropdown-menu" role="menu">
			  				<li><a data-no-active="true" data-target="settings" data-title="<?php echo $this->lang->line('ui_title_brand'); ?> - <?php echo $this->lang->line('ui_settings_page'); ?>" tabindex="-1" href="#"><?php echo $this->lang->line('ui_settings'); ?></a></li>
						    <li class="divider"></li>
						    <li><a href="<?php echo $base_url; ?>logout"><?php echo $this->lang->line('ui_logout'); ?></a></li>
			  			</ul>
					</li>
				</ul>
	      	</div>
	 
	    </div>
	  </div>
	</div>

	<!--<div id="error_container"></div>-->
	<div class="wrapper">
		<div id="page">
			<div class="page-container">	

				<!-- Computers -->
				<div id="computers" class="disabled_page">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="computer"><thead></thead><tbody></tbody></table>
				</div>	

				<div id="computer_id" class="disabled_page"></div>	

				<div id="device_id" class="disabled_page"></div>

				<div id="printer_id" class="disabled_page"></div>	

				<div id="location_id" class="disabled_page"></div>	

				<div id="printers" class="disabled_page">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="printer"><thead></thead><tbody></tbody></table>
				</div>	

				<div id="screens" class="disabled_page">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="screen"><thead></thead><tbody></tbody></table>
				</div>

				<div id="units" class="disabled_page">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="unit"><thead></thead><tbody></tbody></table>
				</div>

				<div id="users" class="disabled_page">

				</div>

				<div id="errorPage" class="disabled_page">
					<h1 class="center center-text">
						<?php echo $this->lang->line('error_sorry_no_object_found'); ?>
					</h1>
				</div>

				<div id="settings" class="settings disabled_page">
					<form class="form-horizontal well settings-form" id="settings-form">
						<div class="control-group">
							<label class="control-label" for="save-selection"><?php echo $this->lang->line('ui_user_settings_save_selection'); ?>:</label>
							<div class="controls">
								<div id="save-selections">
									<input type="checkbox" name="save-selection" id="save-selection" <?php echo ($save_selections === "true")?'checked="checked"': ""; ?>>
								</div>
							</div>
						</div>

						<hr>

						<div class="control-group">
							<label class="control-label" for="user-language"><?php echo $this->lang->line('ui_user_settings_language'); ?>:</label>
							<div class="controls">
									<input type="text" name="user-language" id="user-language" value="<?php echo $languageString; ?>" data-provide="typeahead" autocomplete="off">
							</div>
						</div>

						<hr>
						<?php
							if ($this->user_control->user->password != "") {
						?>
								<div class="control-group">
									<label class="control-label" for="user-email"><?php echo $this->lang->line('ui_user_settings_email'); ?>:</label>
									<div class="controls">
											<input type="text" name="user-email" id="user-email" value="<?php echo (!is_null($this->user_control->user->email))? $this->user_control->user->email: ""; ?>" data-provide="typeahead" autocomplete="off">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="user-name"><?php echo $this->lang->line('ui_user_settings_name'); ?>:</label>
									<div class="controls">
											<input type="text" name="user-name" id="user-name" value="<?php echo (!is_null($this->user_control->user->name))? $this->user_control->user->name: ""; ?>" data-provide="typeahead" autocomplete="off">
									</div>
								</div>

								<hr>

								
								<!--<div class="control-group">
									<label class="control-label" for="user-new-password"><?php echo $this->lang->line('ui_user_settings_new_password'); ?>:</label>
									<div class="controls">
											<input type="password" id="user-new-password" data-provide="typeahead" autocomplete="off">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="user-new-repassword"><?php echo $this->lang->line('ui_user_settings_re_new_password'); ?>:</label>
									<div class="controls">
											<input type="password" id="user-new-repassword" data-provide="typeahead" autocomplete="off">
									</div>
								</div>

								<hr>-->

								<div class="control-group">
									<label class="control-label" for="user-password"><?php echo $this->lang->line('ui_user_settings_confirm_with_password'); ?>:</label>
									<div class="controls">
											<input type="password" name="user-password" id="user-password" data-provide="typeahead" autocomplete="off">
									</div>
								</div>
								
								<hr>
						<?php 
							}
						?>

						<div class="control-group">
							<label class="control-label" for="save-settings"><?php echo $this->lang->line('ui_user_settings_save_changes'); ?>:</label>
							<div class="controls">
									<input type="submit" class="btn btn-primary span2" id="save-settings" value="<?php echo $this->lang->line('ui_user_settings_save'); ?>">
							</div>
						</div>

						<?php
							if ($this->user_control->user->password == "" && !empty($this->user_control->user->google)) {
						?>
								<hr>

								<div class="control-group">
									<label class="control-label" for="unlink"><?php echo $this->lang->line('ui_user_settings_unlink_google'); ?>:</label>
									<div class="controls">
										<input class="btn btn-primary span2" type="button" id="unlink" value="<?php echo $this->lang->line('ui_user_settings_unlink'); ?>">
									</div>
								</div>
						<?php
							}
						?>

						<!-- Change password and Unlink/Link google -->
					</form>
				</div>

				<div id="organizations" class="disabled_page">

				</div>

				<div id="locations" class="disabled_page">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="location"><thead></thead><tbody></tbody></table>
				</div>
			</div>
		</div>
	</div>

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

	<?php $this->load->view("models_view"); ?>

	<div id="length_select_template" style="display:none;">
		<form>
			<div class="input-append dropdown combobox" style="float:left;">
				<input class="span8" type="text">
				<button class="btn" data-toggle="dropdown" style="outline-color: transparent;">
				<i class="caret"></i></button>
				<ul class="dropdown-menu">
					<li><a href="#">10</a></li>
					<li><a href="#">25</a></li>
					<li><a href="#">50</a></li>
					<li><a href="#">100</a></li>
				</ul>
			</div>
		</form>
	</div>

	<div id="loading">
		<div id="floatingCirclesG">
			<div class="f_circleG" id="frotateG_01"></div>
			<div class="f_circleG" id="frotateG_02"></div>
			<div class="f_circleG" id="frotateG_03"></div>
			<div class="f_circleG" id="frotateG_04"></div>
			<div class="f_circleG" id="frotateG_05"></div>
			<div class="f_circleG" id="frotateG_06"></div>
			<div class="f_circleG" id="frotateG_07"></div>
			<div class="f_circleG" id="frotateG_08"></div>
		</div>
	</div>

	<div class="modal-backdrop in" id="loading-background"></div>

	<!-- Include jquery,boostrap and script -->
	<?php 
		if ($dev_mode) {
			echo '<script type="text/javascript" src="'.$asset_url.'js/jquery.min.js"></script>';
		} else {
			echo '<script type="text/javascript" src="'.$jquery_url.'"></script>';
		}
	?>
	<script type="text/javascript" src="<?php echo $asset_url; ?>bootstrap/js/bootstrap.js"></script>
	<script src="<?php echo $asset_url;?>js/mustache.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.history.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/signals.min.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/crossroads.min.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/custom-form-elements.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/FixedHeader.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/objx.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/userInfo.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/tableGenerator.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/application.js"></script>
	<script type="text/javascript" src="<?php echo $asset_url; ?>js/script.js"></script>
	<script type="mustache/template" id="computerTemplate">
		<?php $this->load->view("computer_view"); ?>
	</script>
	<script type="mustache/template" id="deviceTemplate">
		<?php $this->load->view("device_view"); ?>
	</script>
	<script type="mustache/template" id="printerTemplate">
		<?php $this->load->view("printer_view"); ?>
	</script>
	<script type="mustache/template" id="locationTemplate">
		<?php /*$this->load->view("location_view");*/ ?>

		<?= $this->load->template("location_view",true); ?>
	</script>
	<script type="mustache/template" id="editablePropertyTemplate">

	</script>
	<script type="text/javascript">
		$('#save-selections').toggleButtons({
		    style: {
		        enabled: "success",
		        disabled: "danger"
		    }
		});
		$("#user-language").typeahead({
			<?php
				$string = 'source : [';
				if (is_array($this->config->item("languages"))) {
					foreach ($this->config->item("languages") as $folder => $language) {
						$string .= '"'.$language.'",';
					}
					$string = rtrim($string,",");
				}
				$string .="]";
				echo $string;
			?>
		});
	</script>
	<script type="text/javascript">
		$(".object[href]").live('click',function(){
			window.location = root + $(this).attr("href");
		});
	</script>
	</body>
</html>