<?php
        $this->load->view('user/common/header', $title);
?>
<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap-wysihtml5.css" />
<link href="<?=base_url();?>/assets/css/prettyPhoto.css" rel="stylesheet">
<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

   <?php 
		$this->load->view('user/common/menu');
    ?>

  <div class="mainpanel">
<div class="col-md-12" style="margin:0 auto;">	
<div class="alert alert-success" style="display:none; position:fixed;z-index:20;right:44%" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong id="cnt"></strong>.
              </div>
</div>	
    <?php 
	
		$this->load->view('user/common/header_bar');
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
          <form id="basicForm" name="form" action="<?=site_url();?>/User_functions/sfunction/" method="post" class="form-horizontal" onsubmit="return validate_form();" novalidate="novalidate" enctype="multipart/form-data">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                </div>
                <h4 class="panel-title">Edit New function</h4>
                <p>Please provide details.</p>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="title" value="<?php echo $function->title; ?>" class="form-control" placeholder="Type your name..." required="">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Image<span class="asterisk">*</span></label>
                  <div class="col-sm-3">
					<input type="file" name="image" class="form-control" placeholder="Type your name..." >
                  </div>
				  <div class="col-sm-3">
					<div class="thmb-prev">
		              <a data-rel="prettyPhoto" href="<?=base_url();?>uploads/function_images/<?php echo $function->image; ?>">
		                <img alt="" class="img-responsive" src="<?=base_url();?>uploads/function_images/<?php echo $function->image; ?>">
		              </a>
		            </div>
				  </div>
                </div>
				 <div class="form-group">
				  <label class="col-sm-3 control-label">Status<span class="asterisk">*</span></label>
				  <div class="col-sm-9">
                  <div class="rdio rdio-warning">
                      <input type="radio" name="status" value="0" <?php echo ($function->status == 0)? 'checked':''; ?> id="radioWarning" />
                        <label for="radioWarning">Disabled</label>
                      </div>
                      
                      <div class="rdio rdio-success">
                        <input type="radio" name="status" value="1" id="radioSuccess" <?php echo ($function->status == 1)? 'checked':''; ?>/>
                        <label for="radioSuccess">Enabled</label>
                      </div>
				</div>	
                </div>
				<input type="hidden" name="function_allot_id" value="<?php echo encrypt($function->function_allot_id); ?>" >
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
<script src="<?=base_url();?>/assets/js/jquery.prettyPhoto.js"></script>
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
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto();
 });
</script>
</section>

</body>
<?php
        $this->load->view('user/common/footer');
?>
