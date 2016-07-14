<?php
        $this->load->view('home/header', $title);
?>

<body style="background:url('<?=base_url();?>/assets1/img/slider/11.jpg');background-size: cover;">


<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> Event App <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Welcome to Event App</strong></h5>
                   
                    <div class="mb20"></div>
                    <strong>Not a member? <a href="<?=base_url();?>/index.php/registration/registration_new">Sign Up</a></strong>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <form method="post" action="<?=site_url();?>/login/authenticate/<?php echo $page; ?>">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                
                    <input type="text" name="username" class="form-control uname" placeholder="Username" />
                    <input type="password" name="password" class="form-control pword" placeholder="Password" />
					<?php if(isset($error) && $error !='')
					{ ?>
                    <small style="color:#ce1400;"><?php echo $error; ?> </small>
					<?php } ?>
                    <button class="btn btn-success btn-block">Sign In</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved. 
            </div>
            
        </div>
        
    </div><!-- signin -->
  
</section>

<?php
        $this->load->view('home/footer_home');
?>
