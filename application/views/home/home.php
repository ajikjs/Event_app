<!DOCTYPE html>
<html lang="en">
<?php
        $this->load->view('home/header_home');
?>
<body>
	<!-- Preloader -->
	<div id="preloader">
		<div id="loadanimation"></div>
	</div>
		

<?php
        $this->load->view('home/menu_home');
?>

	<!-- Slider -->
	<div class="tp-banner-container">
		<div class="tp-banner" >
			<ul>
				<!-- SLIDE 1 -->
				<li data-transition="fade" data-masterspeed="1500" data-slotamount="7">
					<!-- MAIN IMAGE -->
					<img src="<?php echo base_url();?>assets1/img/slider/222.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
				<div class="caption sfb" data-start="1000" data-x="1100" data-y="bottom" data-voffset="150" data-speed="700" data-easing="">
						<?php /*<img src="<?php echo base_url();?>/assets1/img/slider/dj.png" alt="dj">
						*/ ?></div>
					<!-- cap 1 -->
				   	<div class="caption lfb custom-cap cap-1-1" data-start="1400" data-x="center" data-y="220" data-speed="700" data-easing="">The big <span class="colored">music event</span> of the year</div>
					<!-- cap 2 -->
				   	<div class="caption lfb custom-cap cap-2" data-start="1600" data-x="center" data-y="300" data-speed="700" data-easing="">Register now! Grab a seat</div>
					<!-- cap 3 -->
					<div class="caption lfb custom-cap cap-2" data-start="1800" data-x="center" data-y="355" data-speed="700" data-easing="">Coming soon on 30 september</div>

							</li>
				<!-- SLIDE 2 -->
				<li data-transition="fade"  data-masterspeed="1500" data-slotamount="7">
					<!-- MAIN IMAGE -->
					<img src="<?php echo base_url();?>assets1/img/slider/1.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- cap 1 -->
				   	<div class="caption lfl custom-cap cap-1 hidden-xs" data-start="800" data-x="390" data-y="190" data-speed="700" data-easing="">What can you do with MusicBeat?</div>
					<!-- cap 2 -->
				   	<div class="caption lfl custom-cap cap-2 hidden-xs" data-start="1000" data-x="390" data-y="270" data-speed="700" data-easing="">You can make events and write on blog</div>
					<!-- cap 3 -->
					<div class="caption lfl custom-cap cap-2 hidden-xs" data-start="1200" data-x="390" data-y="325" data-speed="700" data-easing="">You can sell albums and songs</div>
					<!-- cap 4 -->
					<div class="caption lfl custom-cap cap-2 hidden-xs" data-start="1400" data-x="390" data-y="380" data-speed="700" data-easing="">You can sell tickets</div>
					
					<!-- Album -->
					<?php /*<div class="caption sfb" data-start="1000" data-x="50" data-y="-180" data-voffset="150" data-speed="700" data-easing="">
						<img src="<?php echo base_url();?>/assets1/img/slider/album-1.png" alt="dj">
					</div>	*/ ?>
					<!-- cap 5 -->
					<div class="caption lfr custom-cap cap-3 hidden-xs" data-start="1200" data-x="1070" data-y="405" data-speed="700" data-easing="">ALBUM</div>
					<!-- cap 6 -->
					<div class="caption lfr custom-cap cap-4 hidden-xs" data-start="1300" data-x="1070" data-y="435" data-speed="700" data-easing="">SING WITH ME BABY!
					<br>
					<span class="artist">AVICII</span>
					</div>
				</li>

				
			</ul>
		</div>
	</div>

	<?php
        $this->load->view('home/footer_home');
	?>
	<!-- jQuery -->
	<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets1/js/google.map.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url();?>assets1/js/smooth-scroll.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets1/js/respond.min.js"></script>
	<!-- <script type="text/javascript" src="<?php echo base_url();?>/assets1/js/jquery.inview.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url();?>assets1/js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets1/js/masonry.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets1/js/lightbox.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets1/js/js.js"></script>

	<!-- jQuery REVOLUTION Slider  -->
	<script type="text/javascript" src="<?php echo base_url();?>assets1/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets1/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript"> 
		jQuery(document).ready(function($) {
			"use strict";

			jQuery('.tp-banner').show().revolution(
			{
				delay:4000,
				startwidth:1920,
				startheight:783,
				hideThumbs:100,
				fullWidth:"off",
				fullScreen:"on",
				fullScreenOffsetContainer: ".navbar-default, .player",
				navigationStyle: "off",
				shadow: 0,
				autoHeight:"off",						
				forceFullWidth:"off",						
			});
		});
	</script>
	
</body>
</html>
