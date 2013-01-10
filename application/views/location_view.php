<div class="container-fluid ">
	<div class="row-fluid">
		<div class="span3">

			<div class="well well-large description">

				{{#name}}
					<strong class="space-right"><?php echo $this->lang->line('computer_printer_name'); ?>:</strong>{{name}}<br>
				{{/name}}

				<!-- Floor, Building -->
				{{#floor.name.length}}
					<strong class="space-right"><?php echo $this->lang->line('location_floor'); ?>:</strong>{{floor.name}}<br>
				{{/floor.name.length}}

				{{#building.name.length}}
					<strong class="space-right"><?php echo $this->lang->line('location_building'); ?>:</strong>{{building.name}}<br>
				{{/building.name.length}}

				<!-- Room number -->
				{{#room_number}}
					<strong class="space-right"><?php echo $this->lang->line('location_room_number'); ?>:</strong>{{room_number}}<br>
				{{/room_number}}

			</div>

    	</div>
	</div>
</div>