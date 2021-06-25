<?php 
session_start();
require_once("razorPay/Razorpay.php");
require_once("admin/config.php");
require_once("scn_library/scn_library.php");
require_once("admin/config.php");
use Razorpay\Api\Api;
require("admin/emailf.php");
error_reporting(E_ALL ^ E_WARNING);
$api = new Api($api_key, $api_secret);
$success = false;
if ( ! empty( $_POST['razorpay_payment_id'] ) ) {
    try
    {
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
        $success = true;
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}
    if ($success === true)
    {
        $pay_msg = "Payment success/ Signature Verified\n Your Order Has been placed successfully \n Our team will pick the package from given address.";
        //code for SMS and Email
    }
    else
    {
        $pay_msg = "<p>Your payment failed</p>
                 <p>{$error}</p>";
    }

    //writing payments details in my payments table
    if($success && !empty($_GET["order_id"])){
        $courier_order_id=$_GET["order_id"];
        $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
    $query_result=$connection->scn_insert_record('payments',
     '{
         "razorpay_payment_id":"'.$_POST['razorpay_payment_id'].'",
         "razorpay_order_id":"'.$_SESSION["razorpay_order_id"].'",
         "razorpay_signature":"'.$_POST['razorpay_signature'].'",
         "signature_verified":"'.$success.'",
         "courier_order_id":"'.$_GET["order_id"].'",
         "user_id":"'.$_SESSION["client_id"].'"
     }');
        
        if($query_result->error){
            $error_div ='<br><br><div class="container"><div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Alert!</strong> '.$query_result->message.'
           </div></div>';
               echo $error_div;
        }
        else{
               
        } 

    $query_update_result = $connection->scn_update_record('orders','{"status":"pending","payment_status":"paid online"}','id='.$_GET["order_id"]);

        if($query_update_result->error){
            $error_div ='<br><br><div class="container"><div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Alert!</strong> '.$query_update_result->message.'
        </div></div>';
            echo $error_div;
        }else{
            $msg= "Hello ".$_SESSION["client_fullname"]."\n This is to inform you that your order has been successfully Placed Your order id is: ".$courier_order_id.".\n Our Team will soon Pick your parcel from you address.<br>-regards BeeQuick Team";
            $altmsg = "Hello ".$_SESSION["client_fullname"]."\n This is to inform you that your order has been successfully Placed Your order id is: ".$courier_order_id.".\n Our Team will soon Pick your parcel from you address.\n --Regards BeeQuick Team";
            // send email
            if(emailf($_SESSION["client_email"],$_SESSION["client_fullname"],"Order Confirmation",$msg,$altmsg)){
                emailf("support@beequick.in","support@beequick.in","New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id,"New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id);
                emailf("visheshswami007@gmail.com","Vishesh Swami","New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id,"New Order Confirmed","New Order has been placed on your Site with order id:".$courier_order_id); 
                header("Location: customer_copy_bill.php?order-id=".$_GET["order_id"]);
            }
        } 

    }
?>


<link href="admin/css/style.css" rel="stylesheet">

<div class="container card" style="background:#fff; padding: 40px;">
<h4 class="text-left" style="border-bottom: 5px solid teal">Message</h4><br>
<h2><?php echo $pay_msg; ?></h2>
</div>
<br>