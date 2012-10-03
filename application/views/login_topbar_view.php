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
      		ComputerInfo
      	</a>

	    <!-- Everything you want hidden at 940px or less, place within here -->
	    <div class="nav-collapse">
	     	<ul class="nav">
	     		<li class="active">
		    		<a data-target="login" data-title="ComputerInfo - Login" href="#">Login</a>
		  		</li>
          <?php 
          if (isset($back)) {
              echo '<li>
                <a data-target="back" data-title="ComputerInfo - Back" href="'.$back.'">Back</a>
              </li>';
            }
          ?>
			</ul>
      	</div>
 
    </div>
  </div>
</div>