<div class="container-fluid ">
	<div class="row-fluid">
		<div class="span3">

			{{#model.image_url}} 		
			<ul class="thumbnails">
	            <li class="span12">
	              <a href="{{model.url}}" class="thumbnail">
	                <div class="img-outer"><img src="{{model.image_url}}" class="img-rounded model-image"></div>
	              </a>
	            </li>
	        </ul>
	        {{/model.image_url}}
	        {{^model.image_url}}
	        	<ul class="thumbnails">
		            <li class="span12">
		              <a class="thumbnail">
		                <div class="img-outer"><img src="<?php echo $base_url; ?>assets/images/printer_model_icon.png" class="img-rounded model-image"></div>
		              </a>
		            </li>
	        	</ul>
	        {{/model.image_url}}

			<div class="well well-large description">

				{{#identifier}}
					<strong class="center title"><h3>{{identifier}}</h3></strong>
				{{/identifier}}

				{{#name}}
					<strong class="space-right"><?php echo $this->lang->line('computer_printer_name'); ?>:</strong>{{name}}<br>
				{{/name}}

				{{#year_of_purchase}}
					<strong class="space-right"><?php echo $this->lang->line('device_year_of_purchase'); ?>:</strong>{{year_of_purchase}}<br>
				{{/year_of_purchase}}

				{{#location.name.length}}
					<strong class="space-right"><?php echo $this->lang->line('device_location'); ?>:</strong><a href="<?php echo $base_url; ?>location/{{location.id}}">{{location.name}}</a><br>
				{{/location.name.length}}

				{{#mac}}
					<strong class="space-right"><?php echo $this->lang->line('computer_mac_address'); ?>:</strong>{{mac}}<br>
				{{/mac}}

				{{#ip}}
					<strong class="space-right"><?php echo $this->lang->line('computer_ip_addresses'); ?>:</strong>{{ip}}<br>
				{{/ip}}

			</div>

			<!-- Printer Model -->
			{{#model.name.length}}
			<div class="well well-large description">
				<strong class="center title object" href="{{model.url}}"><h3>{{model.name}}</h3></strong>

				{{#model.manufacturer.name.length}}
					{{#model.manufacturer.website}}
						<strong class="space-right"><?php echo $this->lang->line('device_manufacturer'); ?>:</strong><a href="{{model.manufacturer.website}}">{{model.manufacturer.name}}</a><br>
					{{/model.manufacturer.website}}
					{{^model.manufacturer.website}}
						<strong class="space-right"><?php echo $this->lang->line('device_manufacturer'); ?>:</strong><a>{{model.manufacturer.name}}</a><br>
					{{/model.manufacturer.website}}
				{{/model.manufacturer.name.length}}

				{{#model.type}}
					<strong class="space-right"><?php echo $this->lang->line('device_type'); ?>:</strong>{{model.type}}<br>
				{{/model.type}}

			</div>
			{{/model.name.length}}

    	</div>
	</div>
</div>