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
		  <li class="active"><a href="<?=site_url();?>/functions_allot/add_functions_allot/"><button type="button" class="btn btn-info">New Functions Allot</button></a></li>
        </ol>
      </div>
    </div>
<?php if(!empty($alloted_functions))
{ ?>
    <div class="contentpanel">
	
      <div class="row">

        <div class="col-md-12" style="padding-left:0px; padding-right:0px;">
            <div class="table-responsive">
                <table class="table table-primary mb30">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>User Name</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
				<?php $sl=1; foreach($alloted_functions as $function)
				{ ?>
                      <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php 
							foreach($users as $user)
							{ if($user['user_id'] == $function['user_id'])
								echo $user['user_name'];
							} ?></td>
						<td><a class="edit_list" href="<?=site_url();?>/functions_allot/function_allot/<?php echo encrypt($function['alloted_function_id']); ?>"><span class="label label-warning">Edit</span></a>
						<a class="del_list" onclick="if (confirm('Are you sure want to delete..?') == true) { window.location='<?=site_url();?>/functions_allot/delete_function/<?php echo encrypt($function['alloted_function_id']); ?>';}"><span class="label label-danger">Delete</span></a></td>
                      </tr>
				<?php $sl++; } ?>	                      
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

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

</body>
<?php
        $this->load->view('admin/common/footer');
?>
