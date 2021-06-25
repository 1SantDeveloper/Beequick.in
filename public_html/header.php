
<!DOCTYPE html>
<html>
<head>
<title>BeeQuick | Fastest Courier Service in Delhi NCR</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="BeeQuick, Bee Quick, Courier Store,Courier service in Delhi NCR, Courier service in Gurugram, Courier service in Faridabad, 
Courier service in Noida, DLF Courier Service, Same Day Delivery, Bee quick company " />
<!--<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>-->
<!-- css files -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- /css files -->
<!-- font files -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700italic,700,800,800italic' rel='stylesheet' type='text/css'>
<link href="//fonts.googleapis.com/css?family=Exo+2:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<!-- /font files -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YW6WM1Z8VS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YW6WM1Z8VS');
</script>

</head>
<body>

 <!--Start of Tawk.to Script-->
 <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f872da6a2eb1124c0bcf5f4/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href=<?php echo dirname($_SERVER["REQUEST_URI"]); ?>><img src="images/logo.png" alt="BeeQuick" height="40px"width="130"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">Home</a></li>
				<!-- <li><a href="about.php">About</a></li> -->
				<li><a href="new_order.php">E-Ordering</a></li>
				<li><a href="service.php">Services</a></li>
				<!-- <li><a href="tracking.php">Tracking</a></li> -->
				<!-- <li><a href="typo.html">Typography</a></li> -->
				<li><a href="contact.php">Contact</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-truck" aria-hidden="true"></i> Track Order<b class="caret"></b></a>
					<div class="dropdown-menu">
						<div class="track-w3ls">
							<h3>Enter Your Order ID</h3>
							<form action="tracking.php" method="get">
								<input type="text" name="order_id" placeholder="Enter Tracking Code" required />
								<button type="submit" class="btn btn-primary">Track</button>
							</form>
							<p class="track-p1">Contact Us :</p>
							<p class="track-p2"><a href="mailto:visheshswami007@gmail.com">visheshswami007@gmail.com</a></p>
						</div>
					</div>
				</li>
				
<?php if(!isset($_SESSION["client_id"])):?>
				<li class="dropdown">
					<a href="login.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-lock" aria-hidden="true"></i> Login<b class="caret"></b></a>
					<div class="dropdown-menu">
						<div class="login-w3ls">
							<h3>Login To Your Account</h3>
							<form action="login.php" method="post">
								<input type="text" name="email" placeholder="Email" required />
								<input type="password" name='pass' placeholder="Password" required> 
								<input type="submit" name="submit" value="Continue">
							</form>
						</div>
					</div>
				</li>	
<?php else : ?>
				<li><a href="user_dashboard.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
				<li><a href="user_logout.php"><i class="fa fa-power-off" aria-hidden="true"></i></a></li>
				
<?php endif; ?>
			</ul>
        </div><!--/.nav-collapse -->
	</div>
</nav>

<!-- navigation -->