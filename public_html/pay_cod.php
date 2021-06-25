<?php 
session_start();
require("admin/emailf.php");
error_reporting(E_ALL ^ E_WARNING);
if(!isset($_SESSION["client_id"])){
  header("Location: login.php");
}


if(!isset($_GET["order_id"])){
  die("Order Failed ! :( \n Something went Wrong");
}
else{
  $courier_order_id=$_GET["order_id"];
}
require_once("scn_library/scn_library.php");
require_once("admin/config.php");
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
$query_result = $connection->scn_update_record('orders','{"status":"pending","payment_status":"COD"}','id='.$courier_order_id);

if($query_result->error){
    $error_div ='<br><br><div class="container"><div class="alert alert-danger">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong>Alert!</strong> '.$query_result->message.'
   </div></div>';
       echo $error_div;
       die($error_div);
}else{
  $_SESSION["cod"]=true;
  $msg= "Hello ".$_SESSION["client_fullname"]."\n This is to inform you that your order has been successfully Placed Your order id is: ".$courier_order_id.".\n Our Team will soon Pick your parcel from you address.<br>-regards BeeQuick Team";
  $altmsg = "Hello ".$_SESSION["client_fullname"]."\n This is to inform you that your order has been successfully Placed Your order id is: ".$courier_order_id.".\n Our Team will soon Pick your parcel from you address.\n --Regards BeeQuick Team";
  // send email
  if(emailf($_SESSION["client_email"],$_SESSION["client_fullname"],"Order Confirmation",$msg,$altmsg)){
    emailf("support@beequick.in","Support@beequick.in","New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id,"New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id);
    emailf("visheshswami007@gmail.com","Vishesh Swami","New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id,"New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id); 
    header("Location: customer_copy_bill.php?order-id=".$_GET["order_id"]);
  }
}
// Code for SMS and Email
?>