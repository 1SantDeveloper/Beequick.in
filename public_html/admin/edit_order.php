<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");

if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
if(!isset($_GET["order-id"])){
    echo "<script>alert('order id not identified');</script>";
    exit("order id not identified");
}


//backend upadate function start
 if(isset($_POST["order-id"],$_POST["parcel_weight"],$_POST["parcel_length"],$_POST["parcel_width"],$_POST["parcel_height"],$_POST["parcel_content"],$_POST["sender_name"],$_POST["sender_address1"],$_POST["sender_state"],$_POST["sender_city"],$_POST["sender_pincode"],$_POST["sender_country"],$_POST["sender_mobile"],$_POST["sender_email"],$_POST["recepient_name"],$_POST["recepient_address1"],$_POST["recepient_state"],$_POST["recepient_city"],$_POST["recepient_pincode"],$_POST["recepient_country"],$_POST["recepient_mobile"],$_POST["recepient_email"])){
     $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
     $query_result=$connection->scn_update_record('orders',
      '{
            "parcel_category" : "'. $_POST["parcel_category"].'",
            "parcel_quantity" : "'. $_POST["parcel_quantity"].'",
            "parcel_weight" : "'. $_POST["parcel_weight"].'", 
            "parcel_length" : "'. $_POST["parcel_length"].'", 
            "parcel_width" : "'. $_POST["parcel_width"].'", 
            "parcel_height" : "'. $_POST["parcel_height"].'", 
            "parcel_content" : "'. $_POST["parcel_content"].'", 
            "parcel_value" : "'. $_POST["parcel_value"].'",
            "sender_name" : "'. $_POST["sender_name"].'",
            "sender_company" : "'. $_POST["sender_company"].'",
            "sender_address1" : "'. $_POST["sender_address1"].'", 
            "sender_address2" : "'. $_POST["sender_address2"].'", 
            "sender_state" : "'. $_POST["sender_state"].'",
            "sender_city" : "'. $_POST["sender_city"].'",
            "sender_pincode" : "'. $_POST["sender_pincode"].'",
            "sender_country" : "'. $_POST["sender_country"].'",
            "sender_mobile" : "'. $_POST["sender_mobile"].'", 
            "sender_alt_mobile" : "'. $_POST["sender_alt_mobile"].'", 
            "sender_email" : "'. $_POST["sender_email"].'",
            "sender_gst" : "'. $_POST["sender_gst"].'",
            "recepient_name" : "'. $_POST["recepient_name"].'",
            "recepient_company" : "'. $_POST["recepient_company"].'",
            "recepient_address1" : "'. $_POST["recepient_address1"].'",
            "recepient_address2" : "'. $_POST["recepient_address2"].'",
            "recepient_state" : "'. $_POST["recepient_state"].'",
            "recepient_city" : "'. $_POST["recepient_city"].'",
            "recepient_pincode" : "'. $_POST["recepient_pincode"].'",
            "recepient_country" : "'. $_POST["recepient_country"].'",
            "recepient_mobile" : "'. $_POST["recepient_mobile"].'",
            "recepient_alt_mobile" : "'. $_POST["recepient_alt_mobile"].'",
            "recepient_email" : "'. $_POST["recepient_email"].'",
            "recepient_gst" : "'. $_POST["recepient_gst"].'"
        }',"id=".$_POST["order-id"]);
    
        
         if($query_result->error){
             $error_div ='<br><br><div class="container"><div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Alert!</strong> '.$query_result->message.'
            </div></div>';
                echo $error_div;
                die($error_div);
         }
         else{
               
         }
    }
//Edit order backend function end



?>

<?php include("header.php")?>

<br>
<div class="container">
<h2>Edit Order Details</h2>
</div>
<hr>
<?php 
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
$query_result_orders=$connection->scn_select_all("orders","id=".$_GET["order-id"]);//(table_name, where_expression,distinct,orderby)
   
    if($query_result_orders->error){
       $error_div ='<br><br><div class="container"><div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Alert!</strong> '.$query_result_orders->message.'
      </div></div>';
          echo $error_div;
          exit($error_div);
   }
else{
 ?>
 <div class="container card" style="background:#fff; padding: 40px;">
<div class="row">
<div class="col-sm-6">
<form class="form-inline" action="save_order_edit.php" method="POST">
<h4 class="text-left" style="border-bottom: 5px solid teal">Update Order Status</h4><br>
<div class="form-group">
     <div class="col-sm-6">
     <select name="order_status" required class="form-control">
         <option disabled selected value> -- select an option -- </option>
        <option value="saved">Saved</option>
        <option value="pending">Pending</option>
        <option value="picked">Picked</option>
        <option value="in transit">In Transit</option>
        <option value="dispatched">Dispatched</option>
        <option value="delivered">Delivered</option>
        <option value="cancelled">Cancelled</option>
        <option value="refused">Refused</option>
     </select>
      </div>
    </div>

<input type="hidden" name="order-id" value="<?php echo $_GET["order-id"] ?>">
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
<div class="col-sm-6">
<h4 class="text-left" style="border-bottom: 5px solid teal">Order Current Status</h4><br>
      <h5><?php echo strtoupper($query_result_orders->result[0]["status"]); ?></h5>
      </div>
      </div>
<br><br>
</div>
<br>
 <div class="container card" style="background:#fff; padding: 40px;">
<form class="form-inline" action="save_order_edit.php" method="POST">
<h4 class="text-left" style="border-bottom: 5px solid teal">Update Order Amount Details</h4><br>
<div class="form-group">
     <div class="col-sm-6">
        <input name="order_amount" value="<?php echo $query_result_orders->result[0]["parcel_amount"] ?>" type="text" class="form-control" placeholder="Order Amount" required >
      </div>
    </div>

<input type="hidden" name="order-id" value="<?php echo $_GET["order-id"] ?>">
  <button type="submit" class="btn btn-primary">Update</button>
</form>
<br><br>
</div>
<br>

<!-- Delevered Item and Returned Item Updation section-->
<div class="container card" style="background:#fff; padding: 40px;">
<form class="form-inline" action="update_delivered_return.php" method="POST">
<h4 class="text-left" style="border-bottom: 5px solid teal">Returned and Delivered Status</h4>
<p>Only Update when some itme returned</p>
<br>
<div class="form-group">
     <div class="col-sm-5">
        Delivered: <input name="order_delivered" value="<?php echo $query_result_orders->result[0]["order_delivered"] ?>" type="number" class="form-control" required >
      </div>
      <div class="col-sm-5">
        Returned: <input name="order_returned" value="<?php echo $query_result_orders->result[0]["order_returned"] ?>" type="number" class="form-control" required >
      </div>
    </div>

<input type="hidden" name="order-id" value="<?php echo $_GET["order-id"] ?>">
  <button type="submit" class="btn btn-primary">Update</button>
</form>
<br><P class="text-danger">Please Update Amount Manually in Case of Any item Returned</P>
<br><br>
</div>
<br>


<div class="container card" style="background:#fff; padding: 40px;">
<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?order-id=<?php echo $_GET["order-id"] ?>" method="POST">
<h4 class="text-left" style="border-bottom: 5px solid teal">Update Order Details</h4><br>
    <div class="form-group">
      <label class="col-sm-1">Parcel Category: </label>
      <div class="col-sm-10">
        <input type="text" value="<?php echo $query_result_orders->result[0]["parcel_category"] ?>" name="parcel_category" class="inline-form-control"  placeholder="Category (eg. Gift, Grossary, furniture etc.)" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-1">Parcel Quantity: </label>
      <div class="col-sm-10">
        <input type="number" min="1" name="parcel_quantity" value="<?php echo $query_result_orders->result[0]["parcel_quantity"] ?>" class="inline-form-control"  placeholder="Quantity" required >
      </div>
    </div>

  <div class="form-group">
    <label>Weight:</label>
    <input name="parcel_weight" value="<?php echo $query_result_orders->result[0]["parcel_weight"] ?>" type="number" step="0.001" min="0" max="10000"  class="inline-form-control" placeholder="0.5" required> kg
  </div>
  <div class="form-group">
    <label>Dimension: </label>
    <input name="parcel_length" value="<?php echo $query_result_orders->result[0]["parcel_length"] ?>" type="number" step="0.001" min="0" max="10000" class="inline-form-control" placeholder="Length" required > &times;
    <input name="parcel_width" value="<?php echo $query_result_orders->result[0]["parcel_width"] ?>" type="number" step="0.001" min="0" max="10000" class="inline-form-control" placeholder="Width" required > &times;
    <input name="parcel_height" value="<?php echo $query_result_orders->result[0]["parcel_height"] ?>" type="number" step="0.001" min="0" max="10000" class="inline-form-control" placeholder="Height" required > INCH
  </div>
    <div class="form-group">
      <label class="col-sm-1">Parcel Contents: </label>
      <div class="col-sm-10">
        <textarea type="text" name="parcel_content" class="inline-form-control" rows="3" cols="30" placeholder="Parcel contents* (eg. Shoes, Dress, Books etc)" required ><?php echo $query_result_orders->result[0]["parcel_category"] ?></textarea>
      </div>
    </div>
    <div class="form-group">
    <label>Parcel Value:</label>
    <input name="parcel_value" value="<?php echo $query_result_orders->result[0]["parcel_value"] ?>" type="text" class="inline-form-control" placeholder="Parcel value"> ₹
  </div>
  <br><br>
  <h4 class="text-left" style="border-bottom: 5px solid teal">Address Details </h4><br>
  <div class="col-sm-6">
  <h4 class="text-center">Sender Details</h4>
  <hr>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_name" value="<?php echo $query_result_orders->result[0]["sender_name"] ?>" type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_company" value="<?php echo $query_result_orders->result[0]["sender_company"] ?>" type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_address1" value="<?php echo $query_result_orders->result[0]["sender_address1"] ?>" type="text" class="form-control" placeholder="Address 1*" required  required>
      </div>
      <div class="col-sm-6">
        <input name="sender_address2" value="<?php echo $query_result_orders->result[0]["sender_address2"] ?>" type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_state" value="<?php echo $query_result_orders->result[0]["sender_state"] ?>" type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_city" value="<?php echo $query_result_orders->result[0]["sender_city"] ?>" type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_pincode" value="<?php echo $query_result_orders->result[0]["sender_pincode"] ?>" type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_country" value="<?php echo $query_result_orders->result[0]["sender_country"] ?>" type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_mobile" value="<?php echo $query_result_orders->result[0]["sender_mobile"] ?>" type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_alt_mobile" value="<?php echo $query_result_orders->result[0]["sender_alt_mobile"] ?>" type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_email" value="<?php echo $query_result_orders->result[0]["sender_email"] ?>" type="email" class="form-control" placeholder="Email*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_gst" value="<?php echo $query_result_orders->result[0]["sender_gst"] ?>" type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>

  <div class="col-sm-6" style="border-left:1px solid grey;">
  <h4 class="text-center">Recepient Details</h4>
  <hr>
  <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_name" value="<?php echo $query_result_orders->result[0]["recepient_name"] ?>" type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_company" value="<?php echo $query_result_orders->result[0]["recepient_company"] ?>" type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_address1" value="<?php echo $query_result_orders->result[0]["recepient_address1"] ?>" type="text" class="form-control" placeholder="Address 1*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_address2" value="<?php echo $query_result_orders->result[0]["recepient_address2"] ?>" type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_state" value="<?php echo $query_result_orders->result[0]["recepient_state"] ?>" type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_city" value="<?php echo $query_result_orders->result[0]["recepient_city"] ?>" type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_pincode" value="<?php echo $query_result_orders->result[0]["recepient_pincode"] ?>" type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_country" value="<?php echo $query_result_orders->result[0]["recepient_country"] ?>" type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_mobile" value="<?php echo $query_result_orders->result[0]["recepient_mobile"] ?>" type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_alt_mobile" value="<?php echo $query_result_orders->result[0]["recepient_alt_mobile"] ?>" type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_email" value="<?php echo $query_result_orders->result[0]["recepient_email"] ?>" type="email" class="form-control" placeholder="Email*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_gst" value="<?php echo $query_result_orders->result[0]["recepient_gst"] ?>" type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>
<br><br>
<input type="hidden" name="order-id" value="<?php echo $_GET["order-id"] ?>">
  <button type="submit" class="btn btn-primary">Update</button>
</form>
<br><br>
</div>
<?php } ?>
<br>
<?php include("footer.php") ?>