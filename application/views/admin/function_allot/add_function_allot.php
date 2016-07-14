<?php
        $this->load->view('admin/common/header', $title);
?>
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
<?php if(isset($msg) && $msg != '')
	{ ?>
	<div class="col-md-12" style="margin:0 auto;">	
<div class="alert alert-<?php echo isset($class)?$class:'success';?>" style="position:fixed;z-index:20;right:44%" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong id="cnt"><?php echo $msg; ?></strong>.
              </div>
</div>	
<?php } ?>
    <div class="pageheader">
      <h2><i class="fa fa-cogs"></i>All functions<span></span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?=site_url();?>blog/home_admin/">Dashboard</a></li>
          <li class="active">All functions</li>
		  <li class="active"><a href="<?=site_url();?>/functions/add_function/"><button type="button" class="btn btn-info">Add New Function</button></a></li>
        </ol>
      </div>
    </div>
<?php if(!empty($functions))
{ ?>
    
	<div class="col-md-12">
          <form class="form-horizontal" method="post" action="<?=site_url();?>/functions_allot/new_allot/" id="basicForm" novalidate="novalidate">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Functions Allotments to User</h4>
                <p>Please select the functions</p>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">User <span class="asterisk">*</span></label>
                  <div class="col-sm-6">
                    <select name="user_id" id="type" class="select2" required data-placeholder="Choose One" required">
					 <option value="">Select User</option>		
					<?php foreach($users as $user)
						{ if(!in_array($user['user_id'],$alloted_users)) { ?> 			      
					  <option value="<?php echo $user['user_id']; ?>"><?php echo $user['user_name']; ?></option>   
						<?php } } ?>
                    </select>
                    <label class="error" for="user"></label>
              	</div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Functions <span class="asterisk">*</span></label>
				  <div class="col-sm-9">
				<input class="chk" type="checkbox" id="int_website_slt_all">
				<label for="int_website_slt_all">Select All</label>
				</div>
				<?php $i=0; foreach($functions as $function)
						{ ?> 
				  <div class="col-sm-3">
                  <div class="ckbox ckbox-primary">
                      <input class="chk" type="checkbox" name="functions[]" value="<?php echo $function['function_id']; ?>" id="int_website<?php echo $i; ?>">
                      <label for="int_website<?php echo $i; $i++; ?>"><?php echo $function['function_name']; ?></label>
                   </div>
                </div>
			   <?php } ?>
			  </div>
              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Submit</button>
                    <button class="btn btn-default" type="reset">Reset</button>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
          
        </div>

 <?php }
else
{ ?>
<div class="alert alert-info fade in">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>No Functions Added..!!</strong>
				<p><a  href="<?=site_url();?>/functions/add_function/"><button type="button" class="btn btn-info">Add Function</button></a></p>
              </div>
<?php } ?> 


</section>
<script src="<?=base_url();?>/assets/js/select2.min.js"></script>
<script>
jQuery(document).ready(function(){
  // Select2
  jQuery(".select2").select2({
    width: '100%'
  });
  jQuery("#basicForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
 $("#int_website_slt_all").click(function () {
    $(".chk").prop('checked', $(this).prop('checked'));
});
 });

</script>
</body>
<?php
        $this->load->view('admin/common/footer');
?>
