<?php 
session_start();
require("admin/config.php");
include("header.php") ?>
<!-- banner section -->
<section class="inner-w3ls">
	<div class="container">
		<h2 class="text-center w3 w3l agileinfo wthree">Be In Touch With Us</h2>
		<p class="text-center w3 w3l agileinfo wthree">FEEL FREE TO CONTACT US ANYTIME WITH YOUR REQUIREMENTS.</p>
	</div>
</section>
<!-- /banner section -->
<!-- contact address -->
<section class="contact-us" id="contact">
	<div class="container">
		<i class="fa fa-globe" aria-hidden="true"></i>
		<h3 class="text-center slideanim w3-agileits agileits-w3layouts agile w3-agile">Contact Us</h3>
		<p class="text-center slideanim w3-agileits agileits-w3layouts agile w3-agile">FEEL FREE TO CONTACT US ANYTIME WITH YOUR REQUIREMENTS.</p>
            <div class="col-md-8 slideanim">
                  <iframe class="googlemaps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3505.457320481975!2d77.08222391508018!3d28.525970782459954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1be6bd69e995%3A0xfd11f9db8f2f1fa7!2sOcean%20Commercial%20Complex!5e0!3m2!1sen!2sin!4v1602156308251!5m2!1sen!2sin" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-md-4 slideanim">
				<h4>Our Contacts :</h4>
                <p><b>Phone</b> : +91 9891301145 or +91 7011752119</p>
                <p><b>Email</b> : <a href="mailto:support@beequick.in">support@beequick.in</a></p>
                <p><b>Address</b> : Shop no.21 oshian commercial complex kapashera pincode 110037.</p>
            </div>
            <div class="clearfix"></div>
    </div>
</section>	
<!-- contact address -->
<!-- contact section -->
<section class="contact-w3ls">
	<div class="container">
		<i class="fa fa-compass" aria-hidden="true"></i>
		<h3 class="text-center">Write To Us</h3>
		<p class="text-center">FEEL FREE TO CONTACT US ANYTIME WITH YOUR REQUIREMENTS.</p>	
		<iframe src="<?php echo $google_form_contact_link ?>" width="100%" height="800" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
	</div>	
</section>			
<!-- /contact section -->
<?php include("footer.php")?>	 
