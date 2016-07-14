<?php
        $this->load->view('admin/common/header', $title);
?>
<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap-wysihtml5.css" />
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
	<?php if($msg != '')
	{ ?>
	<div class="col-md-12" style="margin:0 auto;">	
<div class="alert alert-<?php echo isset($class)?$class:'success'; ?>" style="position:fixed;z-index:20;right:44%" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong id="cnt"><?php echo $msg; ?></strong>.
              </div>
</div>	
<?php } ?>
    <div class="pageheader">
      <h2><i class="fa fa-cogs"></i>Edit function <span></span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
	
    <div class="contentpanel">
	<div class="col-md-12">
          <form id="basicForm" name="form" action="<?=site_url();?>/functions_allot/function_allot/" method="post" class="form-horizontal" novalidate="novalidate">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                </div>
                <h4 class="panel-title">Edit Existing user functions</h4>
                <p>Please provide details.</p>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">User <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="name" readonly value="<?php echo $alloted_function->user_name; ?>" class="form-control" placeholder="Type your name..." required="">
					<input type="hidden" name="user_id" value="<?php echo $alloted_function->user_id; ?>" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Functions <span class="asterisk">*</span></label>
				<div class="col-sm-9">
				<input class="chk" type="checkbox" id="int_website_slt_all">
				<label for="int_website_slt_all">Select All</label>
				</div>
                  <?php $i=0; 
					$id_array = explode(',',$alloted_function->function_ids);
					foreach($functions as $function)
						{ ?> 
				  <div class="col-sm-3">
                  <div class="ckbox ckbox-primary">
                      <input class="chk" type="checkbox" name="functions[]" <?php if(in_array($function['function_id'],$id_array)){ echo 'checked';} ?> value="<?php echo $function['function_id']; ?>" id="int_website<?php echo $i; ?>">
                      <label for="int_website<?php echo $i; $i++; ?>"><?php echo $function['function_name']; ?></label>
                   </div>
                </div>
			   <?php } ?>
                </div>
				<input type="hidden" name="alloted_function_id" value="<?php echo $alloted_function->alloted_function_id; ?>" >
              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary" type="submit">Submit</button>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
          
        </div>

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

<script src="<?=base_url();?>/assets/js/select2.min.js"></script>
<script>
	
jQuery(document).ready(function(){

  $("#int_website_slt_all").click(function () {
    $(".chk").prop('checked', $(this).prop('checked'));
});

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
 });
</script>
</section>

</body>
<?php
        $this->load->view('admin/common/footer');
?>
