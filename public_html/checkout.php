<?php 
session_start();
if(!isset($_SESSION["client_id"])){
  header("Location: login.php");
}
require_once("razorPay/Razorpay.php");
require_once("admin/config.php");
use Razorpay\Api\Api;

if(!isset($_POST["order_id_checkbox"])){
  die("Order Failed ! :( \n Something went Wrong");
}
else{
  $courier_order_id=$_POST["order_id_checkbox"];
}
$amount=$_SESSION["order_amount"];
$amount=(float)$amount;
$amount=$amount*100;
$amount=(int)$amount;
$api = new Api($api_key, $api_secret);

$order  = $api->order->create([  
    'receipt'         => $courier_order_id,  
    'amount'          => $amount, // amount in the smallest currency unit  
    'currency'        => 'INR',// <a href="/docs/payment-gateway/payments/international-payments/#supported-currencies" target="_blank">See the list of supported currencies</a>.)
    ]);
    //print_r($order);
    $_SESSION["razorpay_order_id"]= $order["id"];


if($_SESSION["is_partener"]=="true"){ //if order is from regular customer (partner) this will redirect him to next page 
  header("Location: pay_cod.php?order_id=".$courier_order_id);
  }

?>

<?php include("header.php") ?>
<link href="admin/css/style.css" rel="stylesheet">
<div class="container" style=" margin-top:80px;">
  <h3 style="margin-bottom:8px; ">1. Order Details & Address Details >> 2. Order Summary >> 3. Checkout<small></small></h3>
  
</div>

<div class="container card" style="background:#fff; padding: 40px;">
<h4 class="text-left" style="border-bottom: 5px solid teal">Payment Options</h4><br>
<form action="payment_success.php?order_id=<?php echo $courier_order_id ?>" method="POST">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $api_key ?>"
    data-amount="<?php echo $amount ?>"
    data-currency="<?php echo $payment_gateway_currency ?>"
    data-order_id="<?php echo $order['id'] ?>"
    data-buttontext="Pay with Razorpay"
    data-name="<?php echo $payment_gateway_company_name ?>"
    data-description="<?php echo $payment_gateway_company_description ?>"
    data-image="<?php echo $payment_gateway_company_image ?>"
    data-prefill.name="<?php echo $_SESSION["client_fullname"] ?>"
    data-prefill.email="<?php echo $_SESSION["client_email"] ?>"
    data-theme.color="<?php echo $payment_gateway_company_color ?>"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>
<br> OR <br><br>
<?php
if($_SESSION["is_partener"]=="true"){
  
    echo '<a href="pay_cod.php?order_id='.$courier_order_id.'"><button class="btn btn-default">Skip Payment</button></a>';
}else{
 echo '<a href="pay_cod.php?order_id='.$courier_order_id.'"><button class="btn btn-default">Cash On Delevery (COD)</button></a>';
}
?>

</div>
<br>
<?php include("footer.php") ?>