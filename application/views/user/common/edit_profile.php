<?php
        $this->load->view('admin/common/header', $title);
?>

<script type="text/javascript">
	/*$(document).ready(function()
    {
      //  $('.calfocus').datepick({dateFormat: 'dd-mm-yyyy'});
		$('#dob').datepicker({
		
                    format: "dd/mm/yyyy"
                });
  
     
    });*/ 
    function validate_form()
                {
						var p = document.forms["my_form"]["password"].value;
						var q = document.forms["my_form"]["re_password"].value;
						var m = document.forms["my_form"]["phone_no"].value;
							
							if (q != p)
							{
								$('#repsw_msg').show();
								return false;
							}
							if(m !='')
							{
							if (/^\d{10}$/.test(m)) 
							{
								// value is ok, use it
							} else {
								$('#mob_msg').show();
								$('#mob_msg').html("Must be a ten digit number");
								return false
									}
							}		
				}					
	function check_msg() 
				{
				 var p = document.forms["my_form"]["password"].value;
                 var q = document.forms["my_form"]["re_password"].value;
				 var m = document.forms["my_form"]["phone_no"].value;
				 
		
                    if (q != "")
                    {
					
                        $("#repsw_msg").fadeOut(2000, 0);

                    }
					if(m !='')
					{
					if ((/^\d{10}$/.test(m)))
					{
                    $("#mob_msg").fadeOut(2000, 0); 
					}
					}
				}
             
</script>
<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

   <?php 
		$this->load->view('admin/common/menu');
    ?>

<div class="mainpanel">
<div class="col-md-12" style="margin:0 auto;">	
<div class="alert alert-success" style="display:none; position:fixed;z-index:20;right:44%" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong id="cnt"></strong>.
              </div>
</div>	
    <?php 
	
		$this->load->view('admin/common/header_bar');
    ?>
	
<div class="col-md-12" style="margin:0 auto;">	
<div class="alert alert-success" style="display:none; position:fixed;z-index:20;right:44%" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong id="cnt"></strong>.
              </div>
</div>
	
<?php if(!empty($user))
{ ?>
    <div class="pageheader">
      <h2><i class="fa fa-home"></i>My Profile <span>edit your profile from here...</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li class="active">My Profile</li>
        </ol>
      </div>
    </div>
	
    <div class="contentpanel">
	<div class="col-md-12">
          <form id="my_form" action="<?= site_url(); ?>/profile/edit" method="post" onsubmit="return validate_form();">
          <div class="panel panel-default">
              <div class="panel-heading">
                
                <h4 class="panel-title">Edit Profile</h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Name <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" value="<?php echo $user->name; ?>"  placeholder="Type Your Name..." class="form-control" name="name" required>
					
				  </div>
                </div>
				
				 <div class="form-group">
                  <label class="col-sm-3 control-label">Email <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="email" value="<?php echo $user->email; ?>"  placeholder="Type Your Email..." class="form-control" name="email" required>
                  
				  </div>
                </div>
				
				 <div class="form-group">
                  <label class="col-sm-3 control-label">Username<span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" value="<?php echo $user->user_name; ?>"  placeholder="Type Your Username..." class="form-control" name="user_name" required>
                  
				  </div>
                </div>
				
				 <div class="form-group">
                  <label class="col-sm-3 control-label">Password<span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="password"   placeholder="Type Your Password..." class="form-control" name="password">
					
				  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Retype Password<span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="password"   placeholder="Re Type Password..."  name="re_password" class="form-control" name="password">
                  <small>
						<div  class="validate_msg" style="display:none;color:#b94a48;font-size: 14px;margin-top:2px;margin-bottom:5px;" id="repsw_msg"> Password Mismatches</div>
				</small>
				  </div>
                </div>
				
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Phone Number</label>
                  <div class="col-sm-9">
                    <input type="text" value="<?php echo $user->phone; ?>"  placeholder="Type your Phone Number..." class="form-control" name="phone_no" >
					<small>
						<div  class="validate_msg" style="display:none;color:#b94a48;font-size: 14px;" id="mob_msg"></div>
						</small>
				  </div>
                </div>
                
                
                
               
              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
          
        </div>
    </div><!-- contentpanel -->
<?php } 
else
{ ?>
<div class="pageheader">
      <h2>No User Exist</h2>
     
    </div>
<?php }
?>
 </div><!-- mainpanel -->

 


<script>
function showans(id)
{
$("."+id).prop( "checked", true );	
}

jQuery(document).ready(function(){
    
    "use strict";

  
    jQuery("#my_form").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
 });
</script>

</section>

</body>
<?php
        $this->load->view('admin/common/footer');
?>
