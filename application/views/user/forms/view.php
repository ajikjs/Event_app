<?php
        $this->load->view('user/common/header', $title);
?>

<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap-wysihtml5.css" />
<link href="<?=base_url();?>/assets/css/prettyPhoto.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url();?>/assets/css/jquery-ui-1.10.3.css" />
<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap-timepicker.min.css" />

<body>
<!-- Preloader test -->
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
<div class="alert alert-<?php echo isset($class)?$class:'success';?>" style="position:fixed;z-index:20;right:44%" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong id="cnt"><?php echo $msg; ?></strong>.
              </div>
</div>	
<?php } ?>
    <div class="pageheader">
      <h2><i class="fa fa-cogs"></i><?php echo $function_details->function_name; ?><span></span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
	
    <div class="contentpanel">
	<div class="col-md-12">
          <form id="basicForm" name="form" action="<?=site_url();?>/Form_manage/form_generate/" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"><?php echo $function_details->function_name; ?></h4>
                <p>Please provide values.</p>
              </div>
              <div class="panel-body">
			  <?php 
				if(!empty($op_fields))
				{	foreach ($op_fields as $op_field)
				{ ?>
                <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo $op_field['title']; ?><?php echo ( $op_field['required'] == 1)?'<span class="asterisk">*</span>':''; ?></label>
                  <div class="col-sm-9 bootstrap-timepicker">
                    <?php echo $op_field['field']; ?>
                  </div>
                </div>
			 <?php }  ?>
		   </div><!-- panel -->
		   <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
					<input type="hidden" name="function_allot_id" value="<?php echo $function_allot_id; ?>" />
                    <button class="btn btn-primary" type="submit">Submit</button>
                  </div>
                </div>
              </div>
		  <?php } 
			else
			{ ?>
			<h4 class="panel-title">No fields added</h4>
			<?php } ?> 
          </form>
          
          
        </div>

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

<script src="<?=base_url();?>/assets/js/select2.min.js"></script>
<script src="<?=base_url();?>/assets/js/ckeditor/ckeditor.js"></script>
<script src="<?=base_url();?>/assets/js/ckeditor/adapters/jquery.js"></script>
<script src="<?=base_url();?>/assets/js/jquery.prettyPhoto.js"></script>
<script src="<?=base_url();?>/assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?=base_url();?>/assets/js/bootstrap-timepicker.min.js"></script>

<script>
function extesion_check(id,extensions)
{
var ext = $('#'+id).val().split('.').pop().toLowerCase();
if($.inArray(ext, extensions) == -1) {
	$('#'+id).val('')
    alert('invalid extension!');
}
}
function formatdate(id,format)
{
$("#"+id).datepicker("destroy");
$("#"+id).datepicker({ dateFormat: format });
}
function settings()
{ 
	cnt=0;
	$(".fle" ).each(function() {
	$(this).attr('id','file'+cnt);
	cnt++;
	});
	cnt=0;
	$(".datepicker" ).each(function() {
	$(this).attr('id','file'+cnt);
	cnt++;
	});
}
</script>
<script>	
jQuery(document).ready(function(){
	settings();
  jQuery('.txtarea').ckeditor();
  // Select2
  /*jQuery(".select2").select2({
    width: '100%'
  });*/
   jQuery("#basicForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto();
	jQuery('.datepicker').datepicker();
	jQuery('.timepicker').timepicker({minuteStep: 1,showMeridian: false});
	
 });

</script>

</section>

</body>
<?php
        $this->load->view('user/common/footer');
?>
