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

    <div class="pageheader">
      <h2><i class="fa fa-home"></i> Dashboard <span>Select from here...</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </div>

    <div class="contentpanel">

      <div class="row">
	  <?php
	if(!empty($functions))	
	{	
	 foreach($functions as $function)
		{ ?> 
	  <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
			<a href="<?php echo site_url();?>/functions/list_functions_user/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-8">
                    <h2><?php echo $function['function_name']; ?></h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                 

                  
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div>
		  </div>
<?php } } ?>
		 
      </div><!-- row -->
      


      

    </div><!-- contentpanel -->
      


      

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

  


</section>

</body>
<?php
        $this->load->view('admin/common/footer');
?>
