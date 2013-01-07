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
		                <div class="img-outer"><img src="<?php echo $base_url; ?>assets/images/device_model_image.png" class="img-rounded model-image"></div>
		              </a>
		            </li>
	        	</ul>
	        {{/model.image_url}}

			<div class="well well-large description">

				{{#identifier}}
					<strong class="center title"><h3>{{identifier}}</h3></strong>
				{{/identifier}}

				{{#description}}
					<strong class="space-right"><?php echo $this->lang->line('device_description'); ?>:</strong>{{description}}<br>
				{{/description}}

				{{#serial}}
					<strong class="space-right"><?php echo $this->lang->line('device_serial'); ?>:</strong>{{serial}}<br>
				{{/serial}}

				{{#year_of_purchase}}
					<strong class="space-right"><?php echo $this->lang->line('device_year_of_purchase'); ?>:</strong>{{year_of_purchase}}<br>
				{{/year_of_purchase}}

				{{#location.name.length}}
					<strong class="space-right"><?php echo $this->lang->line('device_location'); ?>:</strong><a href="<?php echo $base_url; ?>location/{{location.id}}">{{location.name}}</a><br>
				{{/location.name.length}}

			</div>

			<!-- Device Model -->
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
				<strong class="space-right"><?php echo $this->lang->line('device_type'); ?>:</strong>{{model.type.name}}<br>
				{{/model.type}}
			</div>
			{{/model.name.length}}

    	</div>

    	<div class="span9">
    		<div class="accordion">

    			<!-- Connected Devices -->
    			<!--{{#processors.length}}
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
				{{/processors.length}}-->

			</div>
    	</div>
	</div>
</div>