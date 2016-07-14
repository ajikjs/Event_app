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
	  <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
			<a href="<?php echo site_url();?>/functions/list_functions/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-8">
                    <h2>Functions</h2>
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

		
		<div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">
			<a href="<?php echo site_url();?>vaccins/list_vaccins/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-8">
                    <h2>Agenda</h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
		<div class="col-sm-6 col-md-3">
          <div class="panel btn-pink panel-stat">
            <div class="panel-heading" style="background:#5bc0de;">
			<a href="<?php echo site_url();?>notification/view_notification_child/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-8">
                    <h2>Speakers</h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
		<div class="col-sm-6 col-md-3">
          <div class="panel panel-warning panel-stat">
            <div class="panel-heading" style="background:#ecc46b;">
			<a href="<?php echo site_url();?>users/list_users/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-12">
                    <h2>Sponsers</h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">
			<a href="<?php echo site_url();?>child/list_all_child/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-12">
                    <h2>Web Links</h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

		<div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">
			<a href="<?php echo site_url();?>child/list_all_child/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-12">
                    <h2 style="font-size:18px;">Photo Gallery Category Type</h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

		<div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading" style="background:#de7504;">
			<a href="<?php echo site_url();?>child/list_all_child/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-12">
                    <h2>Picture Gallery</h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

		<div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading" style="background:#583f26;">
			<a href="<?php echo site_url();?>child/list_all_child/">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-12">
                    <h2>Video</h2>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                
                </div><!-- row -->
              </div><!-- stat -->
			</a>
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
 
      </div><!-- row -->
      


      

    </div><!-- contentpanel -->
      


      

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->

  


</section>

</body>
<?php
        $this->load->view('admin/common/footer');
?>
