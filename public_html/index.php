<?php 
session_start();
include("header.php") ?>
<!-- banner section -->
<section class="banner-w3ls">
	<div class='header'>
		<div class="banner-w3layouts">
		<div class="container">
					<div class="search__container">
						<p class="search__title">
						Track Your Order!<br><br>
						</p>
						<form action="tracking.php" method="get">
						<input class="search__input" name="order_id" type="text" placeholder="Order Id">
						<br><br><button class="btn btn-primary" style="width:100%; border-radius:30px;">Track</button>
						</form>
						<hr>
						<div class="text-center">
						<a href="user_register.php"><button class="btn btn-info">Register</button></a>
						<a href="login.php"><button class="btn btn-success">Client Login</button></a>
						</div>
					</div>
			</div>

<style>
	.search__container {
		padding: 20px;
		max-width: 500px;
		margin:auto;
		margin-top:15%;
		background: #fff;
		box-shadow: 0px 0px 20px 1px rgba(0, 0, 1, 0.5);
		border-radius: 3px;
    }

.search__title {
        font-size: 22px;
        font-weight: 900;
        text-align: center;
        color: #ff8b88;
    }

.search__input {
        width: 100%;
        padding: 12px 24px;

        background-color: transparent;
        transition: transform 250ms ease-in-out;
        font-size: 14px;
        line-height: 18px;
        
        color: #575756;
        background-color: transparent;
/*         background-image: url(http://mihaeltomic.com/codepen/input-search/ic_search_black_24px.svg); */
 
      /*background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");*/
        background-repeat: no-repeat;
        background-size: 18px 18px;
        background-position: 95% center;
        border-radius: 50px;
        border: 1px solid #575756;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }

.search__input::placeholder {
            color: rgba(87, 87, 86, 0.8);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

.search__input:hover,
        .search__input:focus {
            padding: 12px 0;
            outline: 0;
            border: 1px solid transparent;
            border-bottom: 1px solid #575756;
            border-radius: 0;
            background-position: 100% center;
        }
</style>

		</div>
	</div>
</section>
<!-- /banner section -->
<!-- specialization section -->
<section class="special-w3layouts">
	<div class="container">
		<h3 class="text-center wthree w3-agileits">Our Specialities</h3>
		<p class="text-center wthree w3-agileits"></p>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<img src="images/cash.png" alt="Cash on Delivery" class="img-responsive">
			<h4 class="text-center">Cash On Delivery</h4>
			<p class="special-p1">Cash On Delivery Available</p>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<img src="images/package.png" alt="" class="img-responsive">
			<h4 class="text-center">Package Delivery</h4>
			<p class="special-p1">The safest, most reliable pick-up and delivery of products.</p>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<img src="images/support.png" alt="" class="img-responsive">
			<h4 class="text-center">24&times;7 Support</h4>
			<p class="special-p1">24&times;7 Support, Feel Free to Contact Us</p>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<img src="images/delivery_boy.png" alt="" class="img-responsive">
			<h4 class="text-center">Delivered On Time</h4>
			<p class="special-p1">Order will be always availabe there at time.</p>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<!-- /specialization section -->
<!-- 2nd banner section -->
<section class="banner-w3ls2">
	<div class="container">
	<div class="search__container">
						<p class="search__title">
						Price Calculator<br><br>
						</p>
						<input class="search__input" onchange="newOrderPriceCalculation()" id="wt"type="text" placeholder="Parcel Weight" style="width:45%;">
						<input class="search__input" id="qty" type="text" placeholder="Parcel Quantity" onchange="newOrderPriceCalculation()" style="width:45%; margin-left:15px"><br><br>
						<span onclick="alert('Your Amount will be decided by Company. Please Contact to Company')"> <input class="text-center btn btn-default" type="button" height="5px" onclick="alert('Your Amount will be decided by Company. Please Contact to Company')"> Are you Regular Client?</span>
						<br><br><button class="btn btn-primary" style="width:100%; border-radius:30px;" onclick="newOrderPriceCalculation()">Calculate</button><br><br>
						<h4 class="text-center"><span id="price"></span><span id="gst"></span><span id="total" class="text-danger"></span> </h4>
					</div>
	</div>
</section>
<script>
    function newOrderPriceCalculation(){
      let wt=document.getElementById("wt").value;
      //let partner=document.getElementById("partner").checked;
      let qty=document.getElementById("qty").value;
      //console.log(wt+partner+qty);
      let price_result=calcPrice(wt,false,qty);
      console.log(price_result);
      if(typeof price_result.price == 'undefined'){
        document.getElementById("total").innerHTML="Something Went wrong! Please Confirm you not entered more than 10 kg weight";
      }
      else{
        document.getElementById("price").innerHTML="Amount: "+price_result.price+"₹ | ";
        document.getElementById("gst").innerHTML="GST 18%: "+price_result.gst+"₹ | ";
        document.getElementById("total").innerHTML="Total: "+price_result.total+"₹";
      }
    }
    </script>
	<script src="js/calc_rate.js"></script>
<!-- /2nd banner section -->
<!-- 2nd info section -->
<section class="info-w3ls2">
	<div class="container">
		<i class="fa fa-trophy" aria-hidden="true"></i>
		<h3 class="text-center">Fastest Courier Service in Delhi NCR</h3>
		<p class="text-center">Bee Quick., is an indian copmany, offers secure and reliable delivery of consignments to over locations in delhi NCR.</p>
	</div>
</section>
<!-- /2nd info section -->
<!-- 3rd banner section -->
<section class="banner-w3ls3">
	<div class="container">
	<h3 class="text-center agileits-w3layouts agile w3-agile">DELIVERY IN JUST 24 Hour's IN DELHI NCR</h3>
	</div>
</section>
<!-- /3rd banner section -->
<!-- 3rd info section -->
<section class="info-w3ls3">
	<div class="container">
		<i class="fa fa-smile-o" aria-hidden="true"></i>
		<h3 class="text-center">Making Our Customers Happy</h3>
		<p class="text-center" style="text-align:left">“Bee Quick services are consistent and their team is easy to work with. Their service is professional and they quickly respond to our needs and our end-customers’ needs. It has been a good experience with Bee Quick having demonstrated timely delivery performance and in a reliable manner. We rely on dependable service from partners like Bee Quick to help us satisfy our customers.</p>
	</div>
</section>
<!-- /3rd info section -->
<?php include("footer.php")?>
<script>
var myBgFader = $('.header').bgfader([
  'images/banner1-1.jpg',
  'images/banner1-2.jpg',
  'images/banner1-3.jpg',
  'images/banner1-4.jpg',
], {
  'timeout': 2000,
  'speed': 3000,
  'opacity': 0.4
})

myBgFader.start()
</script>