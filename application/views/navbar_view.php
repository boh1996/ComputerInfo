<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
 
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
      	</a>
 
      	<a class="brand" href="#">
      		<?php echo $this->lang->line('ui_brand_name'); ?>
      	</a>

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