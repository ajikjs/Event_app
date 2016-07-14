<div class="headerbar">
	
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
	  		


      <div class="header-right">
	  

        <ul class="headermenu">
		
		<?php if(isset($user_name))
		{ ?>
          <li>
            <div class="btn-group">  
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="images/photos/loggeduser.png" alt="" />
                <?php echo $user_name; ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?=site_url();?>/profile/edit"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                <li><a href="<?=site_url();?>/event_app/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
		<?php } ?>
        </ul>

      </div><!-- header-right -->


    </div><!-- headerbar -->
