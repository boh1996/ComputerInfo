<?= $this->load->view("header_view",true); ?>

<?= $this->load->view("navbar_view",true); ?>

<script type="text/javascript">var root = "<?php echo $base_url; ?>";</script>
<script type="text/javascript">var method = "<?php echo $method; ?>";</script>
<script type="text/javascript">var language = "<?php echo $language; ?>";</script>
<script type="text/javascript">var front_translations = <?php echo $front_translations; ?>;</script>

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

<?php $this->load->view("models_view"); ?>

<?= $this->load->view("loading_view", true); ?>

<?= $this->load->template("count_select",true); ?>

<script type="text/javascript">
	<?= $this->load->view("settings",true); ?>
</script>

<script type="text/javascript">
	<?= $this->load->view("datatables",true); ?>
</script>

<script type="mustache/template" id="computerTemplate">
	<?= $this->load->template("computer",true); ?>
</script>
<script type="mustache/template" id="deviceTemplate">
	<?= $this->load->template("device",true); ?>
</script>
<script type="mustache/template" id="printerTemplate">
	<?= $this->load->template("printer",true); ?>
</script>
<script type="mustache/template" id="locationTemplate">
	<?= $this->load->template("location",true); ?>
</script>

<?= $this->load->view("footer_view",true); ?>