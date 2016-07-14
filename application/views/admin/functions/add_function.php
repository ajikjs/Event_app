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
<div class="alert alert-<?php echo isset($class)?$class:'success';?>" style="position:fixed;z-index:20;right:44%" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong id="cnt"><?php echo $msg; ?></strong>.
              </div>
</div>	
<?php } ?>
    <div class="pageheader">
      <h2><i class="fa fa-cogs"></i>New Module <span></span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
	
    <div class="contentpanel">
	<div class="col-md-12">
          <form id="basicForm" name="form" action="<?=site_url();?>/functions/add_function/" method="post" class="form-horizontal" onsubmit="return validate_form();" novalidate="novalidate" enctype="multipart/form-data">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">Add New Module</h4>
                <p>Please provide details.</p>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Module Name <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" placeholder="Type your name..." required="">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
					<textarea rows="5" name="description" placeholder="Type your description..." class="form-control"></textarea>
                  </div>
                </div>
				 <div class="form-group">
				  <label class="col-sm-3 control-label">Status<span class="asterisk">*</span></label>
				  <div class="col-sm-9">
                  <div class="rdio rdio-warning">
                        <input type="radio" name="status" value="0" id="radioWarning" />
                        <label for="radioWarning">Disabled</label>
                      </div>
                      
                      <div class="rdio rdio-success">
                        <input type="radio" name="status" value="1" id="radioSuccess" checked/>
                        <label for="radioSuccess">Enabled</label>
                      </div>
				</div>	
                </div>
				<div class="form-group">
				  <label class="col-sm-3 control-label">Category needed..?<span class="asterisk">*</span></label>
				  <div class="col-sm-9">
                  <div class="rdio rdio-warning">
                        <input type="radio" name="category" value="0" id="radioWarning1" />
                        <label for="radioWarning1">No</label>
                      </div>
                      
                      <div class="rdio rdio-success">
                        <input type="radio" name="category" value="1" id="radioSuccess1" checked/>
                        <label for="radioSuccess1">Yes</label>
                      </div>
				</div>	
                </div>
              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
          
        </div>

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

<script src="<?=base_url();?>/assets/js/select2.min.js"></script>
<script src="<?=base_url();?>/assets/js/wysihtml5-0.3.0.min.js"></script>
<script src="<?=base_url();?>/assets/js/bootstrap-wysihtml5.js"></script>
<script>
	
jQuery(document).ready(function(){

  jQuery('#wysiwyg').wysihtml5({color: false,html:true});
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
