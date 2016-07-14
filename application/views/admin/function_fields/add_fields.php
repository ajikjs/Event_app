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
      <h2><i class="fa fa-cogs"></i>New Function <span></span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
	
    <div class="contentpanel">
	<div class="col-md-12">
          <form id="basicForm" name="form" action="<?=site_url();?>/module_field/add_fields/" method="post" class="form-horizontal"  novalidate="novalidate" enctype="multipart/form-data">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">Add Function Fields</h4>
                <p>Please provide details.</p>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Function Name <span class="asterisk">*</span></label>
                  <div class="col-sm-4">
                    <input type="text" name="name" readonly class="form-control" value="<?php echo ($function['function_name']); ?>" placeholder="Type your name..." required="">
                  </div>
                </div>
				<div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary mb30">
                    <thead>
                      <tr>
                        <th>Field Name</th>
						<th>Type</th>
						<th>Order</th>
						<th>Required</th>
						<th>Status</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
				<?php $sl=0; 
				if(!empty($function_fields))
				{					
					foreach($function_fields as $function)
					{
 ?>
                      <tr class="t_rw" id="t_rw<?php echo $sl; ?>">
                        <td><input type="text" name="name[<?php echo $sl; ?>]" class="form-control nm" value="<?php echo $function['name']; ?>"  placeholder="Type name..." required=""></td> 
						<td><select name="function_fields[<?php echo $sl; ?>]" id="type<?php echo $sl; ?>" class="select2 sl" placeholder="Choose One" required onchange="get_options(this.id)"/>
					 <option value="">Select Field</option>		
					 <?php foreach($fields as $field)
						{ ?>		      
					  <option <?php echo ($field['field_type_id']== $function['field_type_id'])?'selected':''; ?> value="<?php echo $field['field_type_id'];?> "><?php echo $field['field_name']; ?></option>';   
						<?php } ?>
                    </select>
					<input type="text" id="type<?php echo $sl; ?>_opt" name="options[<?php echo $sl; ?>]" class="form-control opt" placeholder="Type options by coma seperated..." value="<?php echo $function['options']; ?>" <?php echo ($function['options']!='')?'style="display:block"':''; ?> required="">
					</td>
						<td><input type="text" name="order[]" value="<?php echo $function['field_order']; ?>" class="form-control" placeholder="Type Order..." required=""></td>
						<td><div class="ckbox ckbox-primary">
                      <input type="checkbox" <?php echo (1== $function['required'])?'checked':''; ?> name="required[<?php echo $sl; ?>]" value="1" class="t_chkk" id="t_chkk<?php echo $sl; ?>">
                      <label class="t_chk_lbl" for="t_chkk<?php echo $sl; ?>"></label>
                   </div></td>
						<td><div class="ckbox ckbox-success">
                      <input type="checkbox" <?php echo (1== $function['status'])?'checked':''; ?> name="status[<?php echo $sl; ?>]" value="1" class="t_chkk1" id="t_chkk1<?php echo $sl; ?>">
                      <label class="t_chk1_lbl<?php echo $sl; ?>" for="t_chkk1<?php echo $sl; ?>"></label>
                   </div></td>
					<td>
					<input type="hidden" class="fid" name="function_field_id[<?php echo $sl; ?>]" value="<?php echo $function['function_field_id']; ?>">
					<button type="button" id="<?php echo $sl; ?>" class="btn btn-danger rw_rmv" onclick="remove_rw(this.id)">Delete</button></td>
                      </tr>
				<?php $sl++; }
				}
				else
				{ ?>
					<tr>
					<td>No fields added...</td>
					</tr>
				<?php } ?>	
				   <tr id="rw_div">
					</tr>         
                    </tbody>
                </table>
				<table class="table table-primary mb30">
					<tr>
						<td colspan="5">
							<button style="float:right" type="button" id="add_rw" id="add_rw" class="btn btn-info">Add</button>
						</td>
					</tr>
				</table>
            </div><!-- table-responsive -->
        </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-5">
					<input type="hidden" name="function_id" value="<?php echo encrypt($function['function_id']); ?>">
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

/**add new ajax**/
jQuery('#add_rw').click(function() { 
$('#add_rw').attr('disabled','true');
jQuery.ajax({
           type: "POST",
           url: '<?=site_url();?>/module_field/add_row',
           success: function(data)
           {
			  jQuery('#add_rw').removeAttr('disabled');
			  $('#rw_div').before(data);
			  settings();			  
           }
     });
 });

/****/
 });
function settings()
{
	cnt=0;
			  jQuery(".t_rw" ).each(function() {
			  $(this).attr('id','t_rw'+cnt);
			  cnt++;
			  });
			  cnt=0;
			  jQuery(".t_chkk" ).each(function() {
			  $(this).attr('id','t_chkk'+cnt);
			  $(this).attr('name','required['+cnt+']');
			  cnt++;
			  });
			  cnt=0;
			  jQuery(".t_chk_lbl" ).each(function() {
			  $(this).attr('for','t_chkk'+cnt);
			  cnt++;
			  });
			   cnt=0;
			  jQuery(".t_chkk1" ).each(function() {
			  $(this).attr('id','t_chkk1'+cnt);
			  $(this).attr('name','status['+cnt+']');
			  cnt++;
			  });
			   cnt=0;
			  jQuery(".t_chk1_lbl" ).each(function() {
			  $(this).attr('for','t_chkk1'+cnt);
			  cnt++;
			  });
			  cnt=0;
			  jQuery(".rw_rmv" ).each(function() {
			  $(this).attr('id',cnt);
			  cnt++;
			  });
			  cnt=0;
			  jQuery(".nm" ).each(function() {
			  $(this).attr('name','name['+cnt+']');
			  cnt++;
			  });
			  cnt=0;
			  jQuery(".sl" ).each(function() {
			  $(this).attr('name','function_fields['+cnt+']');
			  $(this).attr('id','type'+cnt);
			  cnt++;
			  });
			  cnt=0;
			  jQuery(".opt" ).each(function() {
			  $(this).attr('name','options['+cnt+']');
			  $(this).attr('id','type'+cnt+'_opt');
			  cnt++;
			  });
			  cnt=0;
			  jQuery(".fid" ).each(function() {
			  $(this).attr('name','function_field_id['+cnt+']');
			  cnt++;
			  });
}
function remove_rw(id)
{
	$('#t_rw'+id).remove();
	settings();
}
function get_options(id)
{
	val = $('#'+id+' option:selected').text();
	if(val == 'radio' || val == 'checkbox'|| val == 'dropdown' || val == 'multiselect')
		$('#'+id+'_opt').show();
	else if(val == 'file')
	{
		$('#'+id+'_opt').attr('placeholder','Type allowed file types');
		$('#'+id+'_opt').removeAttr('required');
		$('#'+id+'_opt').show();
	}
	else if(val == 'date')
	{
		$('#'+id+'_opt').attr('placeholder','Type date format');
		$('#'+id+'_opt').removeAttr('required');
		$('#'+id+'_opt').show();
	}
	else
		$('#'+id+'_opt').hide();
}
</script>
</section>

</body>
<?php
        $this->load->view('admin/common/footer');
?>
