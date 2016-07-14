<div class="leftpanel">

    <div class="logopanel">
        <h1><span></span>Event App<span></span></h1>
    </div><!-- logopanel -->

    <div class="leftpanelinner">

        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
          

            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="<?php echo site_url();?>/event_app/my_profile_edit"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>

      <h5 class="sidebartitle">Navigation11</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
	  <?php if($_SESSION['user_type'] == 1)
	  { ?>
        <li class="active"><a href="<?php echo site_url();?>/event_app/home_admin"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
       <?php } else if($_SESSION['user_type'] == 2){ ?> 
	   <li class="active"><a href="<?php echo site_url();?>/event_app/home_user"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
       
	   <?php } ?>
	  <?php foreach($myfunctions as $myfunction)
		{ ?>
		<li><a href="<?php echo site_url();?>/user_functions/list_functions/<?php echo encrypt($myfunction['function_id']); ?>"><i class="fa fa-cogs"></i> <span><?php echo $myfunction['function_name']; ?></span></a></li>
	  <?php } ?>
      </ul>

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
