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
      <h2><i class="fa fa-cogs"></i>All Modules<span></span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?=site_url();?>blog/home_admin/">Dashboard</a></li>
          <li class="active">All Modules</li>
		  <li class="active"><a href="<?=site_url();?>/functions/add_function/"><button type="button" class="btn btn-info">Add New Module</button></a></li>
        </ol>
      </div>
    </div>
<?php if(!empty($functions))
{ ?>
    <div class="contentpanel">
	
      <div class="row">

        <div class="col-md-12" style="padding-left:0px; padding-right:0px;">
            <div class="table-responsive">
                <table class="table table-primary mb30">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Module Name</th>
						<th>Category</th>
						<th>Status</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
				<?php $sl=++$offset; foreach($functions as $function)
				{ ?>
                      <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $function['function_name']; ?></td>
						<td><?php echo ($function['category']==1)?'Yes':'No'; ?></td>
						<td><?php echo ($function['status']==1)?'Enabled':'Disabled'; ?></td>
						<td><a class="edit_list" href="<?=site_url();?>/functions/sfunction/<?php echo encrypt($function['function_id']); ?>"><span class="label label-success">Edit</span></a>
						<a class="del_list" onclick="if (confirm('Are you sure want to delete..?') == true) { window.location='<?=site_url();?>/functions/delete_function/<?php echo encrypt($function['function_id']); ?>';}"><span class="label label-danger">Delete</span></a><a href="<?=site_url();?>/module_field/add_fields/<?php echo encrypt($function['function_id']); ?>"> <span class="label label-warning">Edit Fields</span></a></td>
                      </tr>
				<?php $sl++; } ?>	                      
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
<?php echo $pagination; ?>
    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

 <?php }
else
{ ?>
<div class="alert alert-info fade in">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>No Modules Added..!!</strong>
				<p><a  href="<?=site_url();?>/functions/add_function/"><button type="button" class="btn btn-info">Add Function</button></a></p>
              </div>
<?php } ?> 


</section>

</body>
<?php
        $this->load->view('admin/common/footer');
?>
