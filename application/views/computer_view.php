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
	        	<!--<ul class="thumbnails">
		            <li class="span12">
		              <a class="thumbnail">
		                <div class="img-outer"><img src="https://placehold.it/360x360" class="img-rounded model-image"></div>
		              </a>
		            </li>
	        	</ul>-->
	        {{/model.image_url}}

			<div class="well well-large description">
				<strong class="center title"><h3>{{identifier}}</h3></strong>
				<strong class="space-right"><?php echo $this->lang->line('computer_serial'); ?>:</strong>{{serial}}<br>

				{{#date_of_purchase}}
				<strong class="space-right"><?php echo $this->lang->line('computer_date_of_purchase'); ?>:</strong>{{date_of_purchase}}<br>
				{{/date_of_purchase}}

				<strong class="space-right"><?php echo $this->lang->line('computer_screen_size'); ?>:</strong>{{screen_size.detection_string}}<br>

				{{#location.name.length}}
				<strong class="space-right"><?php echo $this->lang->line('computer_location'); ?>:</strong>{{location.name}}<br>
				{{/location.name.length}}

				{{#operating_system.core.name.length}}
				<strong class="space-right"><?php echo $this->lang->line('computer_operating_system'); ?>:</strong>{{operating_system.core.name}} {{operating_system.edition.name}}<br>
				{{/operating_system.core.name.length}}

					{{#operating_system.service_pack.length}}
					<strong><?php echo $this->lang->line('computer_service_pack'); ?></strong> {{operating_system.service_pack}}<br>
					{{/operating_system.service_pack.length}}

			</div>

			<!-- Computer Model -->
			{{#model.name.length}}
			<div class="well well-large description">
				<strong class="center title object" href="{{model.url}}"><h3>{{model.name}}</h3></strong>

				{{#model.manufacturer}}
				<strong class="space-right"><?php echo $this->lang->line('computer_manufacturer'); ?>:</strong><a href="{{model.manufacturer.website}}">{{model.manufacturer.name}}</a><br>
				{{/model.manufacturer}}

				{{#model.type}}
				<strong class="space-right"><?php echo $this->lang->line('computer_type'); ?>:</strong>{{model.type.name}}<br>
				{{/model.type}}

				{{#model.series.name}}
				<strong class="space-right"><?php echo $this->lang->line('computer_series'); ?>:</strong>{{model.series.name}}<br>
				{{/model.series.name}}
			</div>
			{{/model.name.length}}

    	</div>

    	<div class="span9">
    		<div class="accordion">

    			<!-- Processors -->
    			{{#processors.length}}
			  	<div class="accordion-group">
				    <div class="accordion-heading">
				      	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#processors">
				        	<?php echo $this->lang->line('computer_processors'); ?>
				      	</a>
				    </div>
				    <div id="processors" class="accordion-body collapse">
				      	<div class="accordion-inner">

				      		{{#processors}}
				      		<div class="object" href="processor/{{id}}">

				      			{{#model.name.length}}
						        	<strong class="space-right"><?php echo $this->lang->line('computer_model'); ?>:</strong><a href="{{model.url}}">{{model.name}}</a><br>
						        	
						        	{{#model.manufacturer.name.length}}
						        	<strong class="space-right"><?php echo $this->lang->line('computer_manufacturer'); ?>:</strong><a href="{{model.manufacturer.website}}">{{model.manufacturer.name}}</a><br>
						      		{{/model.manufacturer.name.length}}
						        {{/model.name.length}}

						        {{#architecture.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_architecture'); ?>:</strong>{{architecture}}<br>
						        {{/architecture.length}}

						        {{#data_width.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_instruction_set'); ?>:</strong>{{data_width}}<br>
						        {{/data_width.length}}

						        {{#model.cores.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_cores'); ?>:</strong>{{model.cores}}<br>
						        {{/model.cores.length}}

						        {{#model.threads.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_threads'); ?>:</strong>{{model.threads}}<br>
						        {{/model.threads.length}}
				   			</div>
					   		<hr>
					   		{{/processors}}

				      	</div>
				    </div>
				</div>
				{{/processors.length}}

				<!-- Graphics Cards -->
				{{#graphics_cards.length}}
				<div class="accordion-group">
				    <div class="accordion-heading">
					    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#graphics-cards">
					    	<?php echo $this->lang->line('computer_graphics_cards'); ?>
					    </a>
				    </div>
				    <div id="graphics-cards" class="accordion-body collapse">
				      	<div class="accordion-inner">

				      		{{#graphics_cards}}
					        <div class="object" href="graphics_card/{{id}}">

					        	{{#model.name.length}}
						       		<strong class="space-right"><?php echo $this->lang->line('computer_model'); ?>:</strong><a href="{{model.url}}">{{model.name}}</a><br>
						        	{{#model.manufacturer.name.length}}
						        	<strong class="space-right"><?php echo $this->lang->line('computer_manufacturer'); ?>:</strong><a href="{{model.manufacturer.webiste}}">{{model.manufacturer.name}}</a><br>
						       		{{/model.manufacturer.name.length}}
						        {{/model.name.length}}

						        {{#ram_size.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_memory_size'); ?>:</strong>{{ram_size}}<br>
						        {{/ram_size.length}}

						        {{#driver_version}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_driver_version'); ?>:</strong>{{driver_version}}<br>
						        {{/driver_version}}

					   		</div>
					   		<hr>
					   		{{/graphics_cards}}

				    	</div>
				    </div>
				</div>
				{{/graphics_cards.length}}

				<!-- Network Cards -->
				{{#network_cards.length}}
				<div class="accordion-group">
				    <div class="accordion-heading">
					    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#network-cards">
					    	<?php echo $this->lang->line('computer_network_cards'); ?>
					    </a>
				    </div>
				    <div id="network-cards" class="accordion-body collapse">
				      	<div class="accordion-inner">

				      		{{#network_cards}}
					        <div class="object" href="network_card/{{id}}">
						        <strong class="space-right"><?php echo $this->lang->line('computer_model'); ?>:</strong><a href="{{model.url}}">{{model.name}}</a><br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_manufacturer'); ?>:</strong><a href="{{model.manufacturer.website}}">{{model.manufacturer.name}}</a><br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_mac_address'); ?>:</strong>{{mac_address}}<br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_ip_addresses'); ?></strong><br>
						        <div class="pull-in-left well well-small">
						       		{{#ip_addresses}}
						       			{{.}}<br>
						       		{{/ip_addresses}}
						       </div>
					   		</div>
					   		<hr>
					   		{{/network_cards}}

				      	</div>
				    </div>
				</div>
				{{/network_cards.length}}

				<!-- Logical Drives -->
				{{#logical_drives.length}}
				<div class="accordion-group">
				    <div class="accordion-heading">
					     <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#logical-drives">
					        <?php echo $this->lang->line('computer_logical_drives'); ?>
					     </a>
				    </div>
				    <div id="logical-drives" class="accordion-body collapse">
				      	<div class="accordion-inner">

				      		{{#logical_drives}}
					        <div class="object" href="logical_drive/{{id}}">

						        <strong class="space-right"><?php echo $this->lang->line('computer_disk_space'); ?>:</strong>{{free_space}}/{{disk_size}} <?php echo $this->lang->line('gigabytes'); ?><br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_drive_name'); ?>:</strong>{{volume_name}}<br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_drive_letter'); ?>:</strong>{{name}}<br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_file_system'); ?>:</strong>{{file_system}}<br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_drive_type'); ?>:</strong>{{drive_type.name}}<br>
					   		</div>
					   		<hr>
					   		{{/logical_drives}}

				      	</div>
				    </div>
				</div>
				{{/logical_drives.length}}

				<!-- Physical Drives -->
				{{#physical_drives.length}}
				<div class="accordion-group">
				    <div class="accordion-heading">
					    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion5" href="#physical-drives">
					        <?php echo $this->lang->line('computer_physical_drives'); ?>
					    </a>
				    </div>
				    <div id="physical-drives" class="accordion-body collapse">
				      	<div class="accordion-inner">

				      		{{#physical_drives}}
					        <div class="object" href="physical_drive/{{id}}">
					        	<strong class="space-right"><?php echo $this->lang->line('computer_model'); ?>:</strong><a href="{{model.url}}">{{model.name}}</a><br>
					        	<strong class="space-right"><?php echo $this->lang->line('computer_manufacturer'); ?>:</strong><a href="{{model.manufacturer.website}}">{{manufacturer.name}}</a><br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_disk_size'); ?>:</strong>{{disk_size}}<br>
					   		</div>
					   		<hr>
					   		{{/physical_drives}}

				      	</div>
				    </div>
			 	</div>
			 	{{/physical_drives.length}}

			 	<!-- Printers -->
			 	{{#printers.length}}
			 	<div class="accordion-group">
				    <div class="accordion-heading">
					    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion6" href="#printers">
					        <?php echo $this->lang->line('computer_printers'); ?>
					    </a>
				    </div>
				    <div id="printers" class="accordion-body collapse">
				      	<div class="accordion-inner">

				      		{{#printers}}
					        <div class="object" href="printer/{{id}}">

					        	{{#model.length}}
						    	<strong class="space-right"><?php echo $this->lang->line('computer_model'); ?>:</strong><a href="{{model.url}}">{{model.name}}</a><br>
						        <strong class="space-right"><?php echo $this->lang->line('computer_manufacturer'); ?>:</strong><a href="{{model.manufacturer.website}}">{{model.manufacturer.name}}</a><br>
						        {{/model.length}}

						        {{#name.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_printer_name'); ?>:</strong>{{name}}<br>
						        {{/name.length}}

						        {{#identifier.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_identifier'); ?>:</strong>{{identifier}}<br>
						        {{/identifier.length}}

						        {{#color.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_color_printer'); ?>:</strong>{{color}}<br>
						        {{/color.length}}
						        
						        {{#ip.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_ip'); ?>:</strong>{{ip}}<br>
						        {{/ip.length}}

						        {{#location.name.length}}
						        <strong class="space-right"><?php echo $this->lang->line('computer_location'); ?>:</strong>{{location.name}}<br>
						        {{/location.name.length}}

					   		</div>
					   		<hr>
					   		{{/printers}}

				      	</div>
			    	</div>
				</div>
				{{/printers.length}}

				<!-- Memory -->
				{{#memory}}
				<div class="accordion-group">
				    <div class="accordion-heading">
					    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion7" href="#memory">
					        <?php echo $this->lang->line('computer_memory'); ?>
					    </a>
				    </div>
				    <div id="memory" class="accordion-body collapse">
				      	<div class="accordion-inner">
					        {{#memory.total_physical_memory}}
					        <strong class="space-right"><?php echo $this->lang->line('computer_total_memory'); ?>:</strong>{{memory.total_physical_memory}}<br>
					        {{/memory.total_physical_memory}}

					        {{#memory.slots.length}}
					        <h4><?php echo $this->lang->line('computer_memory_slots'); ?> <?php echo $this->lang->line('megabytes'); ?></h4>
					        {{/memory.slots.length}}

					        {{#memory.slots}}
					        	<div class="object">					        
					   				<strong class="space-right"><?php echo $this->lang->line('computer_is_empty'); ?>:</strong>{{empty}}<br>
					   				<strong class="space-right"><?php echo $this->lang->line('computer_serial'); ?>:</strong>{{serial}}<br>
					   				<strong class="space-right"><?php echo $this->lang->line('computer_manufacturer'); ?>:</strong><a href="{{manufacturer.website}}">{{manufacturer.name}}</a><br>
					   				<strong class="space-right"><?php echo $this->lang->line('computer_capacity'); ?>:</strong>{{capacity}}<br>
					   			</div>
					   			<hr>
					   		{{/memory.slots}}

				      	</div>
			    	</div>
				</div>
				{{/memory}}

			</div>
    	</div>
	</div>
</div>