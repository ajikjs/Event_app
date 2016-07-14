<nav class="navbar navbar-default" role="navigation">
	  	<div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			    	<span class="sr-only">Toggle navigation</span>
			    	<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			    </button>
			    <a class="navbar-brand"><i class="flaticon-music170"></i>Event App</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		    	

				<!-- Navigation links -->
		      	<ul class="nav navbar-nav">
		      		<!-- Home -->
		      		<li >
		          		<a class="selected dropdown-toggle"  href="<?php echo site_url();?>/event_app/home/">HOME <i class="icon-down-open"></i></a>
			          
		        	</li>
		        		        	
					<li >
					<?php if(isset($_SESSION['userid']))
					{ ?>
						<?php /*	<a class="dropdown-toggle"  href="<?php echo site_url?>blog/home_admin/">MY PAGE <i class="icon-down-open"></i></a>*/ ?>
						<li>	
							<a   href="<?php echo site_url();?>/login/logout/">LOGOUT <i class="icon-down-open"></i></a>
						</li>	
						<li>	
							<a   href="<?php echo site_url();?>/event_app/my_home/">MY PAGE <i class="icon-down-open"></i></a>
						</li>
			          <?php } else { ?>
							<a class="dropdown-toggle"  href="<?php echo site_url();?>/login/login_new/">LOGIN <i class="icon-down-open"></i></a>
						<li>
						<a   href="<?php echo site_url();?>registration/registration_new/">REGISTRATION <i class="icon-down-open"></i></a>
						</li>
					  <?php } ?>
		        	</li>
		      	</ul>
	    	</div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
