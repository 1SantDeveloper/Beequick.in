<?php 
session_start();
require("scn_library/scn_library.php");
require("admin/config.php");
if(!isset($_SESSION["client_id"])){
  header("Location: login.php");
}
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
    $query_result=$connection->scn_select_all("orders","order_by=".$_SESSION["client_id"],true,"id DESC");//(table_name, where_expression,distinct,orderby)
?>
<?php include("header.php") ?>
<link href="admin/css/style.css" rel="stylesheet">
<div class="container" style=" margin-top:80px;">
  <h3 style="margin-bottom:8px; ">1. Order Details & Address Details >> <small>2. Order Summary >> 3. Checkout</small></h3>  
</div>




<?php 
if(!$query_result->error && !empty($query_result->result[0])){
?>

<div class="container card" style="background:#fff; padding: 40px;">
<p class="text-danger">** The Input Fields are autofilled with your recent Order Details, Please Edit as you requirments.</p>
<br><form class="form-horizontal" action="order_summary.php" method="POST">
<h4 class="text-left" style="border-bottom: 5px solid teal">Order Details</h4><br>
<div class="row">
<div class="col-sm-7">
<div class="form-group">
      <label class="col-sm-4">Parcel Category: </label>
      <div class="col-sm-8">
        <input type="text" value="<?php echo $query_result->result[0]["parcel_category"] ?>" name="parcel_category" class="inline-form-control"  placeholder="Category (eg. Gift, Grossary, furniture etc.)" required>
      </div>
    </div>
  <div class="form-group">
    <label class="col-sm-4">Weight:</label>
    <div class="col-sm-8">
    <input name="parcel_weight" type="number" value="<?php echo $query_result->result[0]["parcel_weight"] ?>" step="0.001" min="0" max="10" id="wt" class="inline-form-control" placeholder="0.5" onchange="newOrderPriceCalculation()" onkeyup="newOrderPriceCalculation()" required> kg
  </div>
</div>
  <div class="form-group">
    <label class="col-sm-2">Dimension: </label>
    <div class="col-sm-10">
    <input name="parcel_length" value="<?php echo $query_result->result[0]["parcel_length"] ?>" type="number" step="0.001" min="0" max="100" class="inline-form-control" placeholder="Length" required > &times;
    <input name="parcel_width" value="<?php echo $query_result->result[0]["parcel_width"] ?>" type="number" step="0.001" min="0" max="100" class="inline-form-control" placeholder="Width" required > &times;
    <input name="parcel_height" value="<?php echo $query_result->result[0]["parcel_height"] ?>" type="number" step="0.001" min="0" max="100" class="inline-form-control" placeholder="Height" required > INCH
  </div>
</div>
  <div class="form-group">
      <label class="col-sm-4">Parcel Quantity: </label>
      <div class="col-sm-8">
        <input type="number" min="1" value="<?php echo $query_result->result[0]["parcel_quantity"] ?>" name="parcel_quantity" id="qty" class="inline-form-control"  placeholder="Quantity" required onchange="newOrderPriceCalculation()" onkeyup="newOrderPriceCalculation()">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4">Parcel Contents: </label>
      <div class="col-sm-8">
        <textarea type="text" name="parcel_content" class="inline-form-control" rows="3" cols="30" placeholder="Parcel contents* (eg. Shoes, Dress, Books etc)" required ><?php echo $query_result->result[0]["parcel_content"] ?></textarea>
      </div>
    </div>
    <div class="form-group">
    <label class="col-sm-4">Parcel Value:</label>
    <div class="col-sm-8">
    <input name="parcel_value" type="text" class="inline-form-control" placeholder="Parcel value" required > ₹
  </div>
</div>
</div>
  <div class="col-sm-5">
    <div class="well">
      <h2 class="text-primary"><span id="price"></span></h2><br>
      <h3 class="text-primary"><span id="gst"></span></h3><br>
      <h1 class="text-success"><span id="total"></span></h1><br>
      <p class="text-center text-danger">To calulate Amount Please Enter Weight & Quantity.</p><p class="text-warning text-center">This Calculator is only for Individual Clients</p>
    </div>
</div>
</div>

<script>
    function newOrderPriceCalculation(){
      let wt=document.getElementById("wt").value;
      let qty=document.getElementById("qty").value;
      //console.log(wt+partner+qty);
      let price_result=calcPrice(wt,false,qty);
      console.log(price_result);
      if(typeof price_result.price == 'undefined'){
        document.getElementById("total").innerHTML="Something Went wrong! Please Confirm you not entered more than 10 kg weight";
      }
      else{
        document.getElementById("price").innerHTML="Amount: "+price_result.price+"₹";
        document.getElementById("gst").innerHTML="GST 18%: "+price_result.gst+"₹";
        document.getElementById("total").innerHTML="Total: "+price_result.total+"₹";
      }
    }
    </script>
  <br><br>
  <h4 class="text-left" style="border-bottom: 5px solid teal">Address Details </h4><br>
  <div class="col-sm-6">
  <h4 class="text-center">Sender Details</h4>
  <hr>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_name" value="<?php echo $query_result->result[0]["sender_name"] ?>" type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_company" value="<?php echo $query_result->result[0]["sender_company"] ?>" type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_address1" value="<?php echo $query_result->result[0]["sender_address1"] ?>" type="text" class="form-control" placeholder="Address 1*" required  required>
      </div>
      <div class="col-sm-6">
        <input name="sender_address2" value="<?php echo $query_result->result[0]["sender_address2"] ?>" type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_state" value="<?php echo $query_result->result[0]["sender_state"] ?>" type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_city" value="<?php echo $query_result->result[0]["sender_city"] ?>" type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_pincode" value="<?php echo $query_result->result[0]["sender_pincode"] ?>" type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_country" value="India" type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_mobile" value="<?php echo $query_result->result[0]["sender_mobile"] ?>" type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_alt_mobile" value="<?php echo $query_result->result[0]["sender_alt_mobile"] ?>" type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_email" value="<?php echo $query_result->result[0]["sender_email"] ?>" type="email" class="form-control" placeholder="Email*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_gst" value="<?php echo $query_result->result[0]["sender_gst"] ?>" type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>

  <div class="col-sm-6" style="border-left:1px solid grey;">
  <h4 class="text-center">Recepient Details</h4>
  <hr>
  <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_name" value="<?php echo $query_result->result[0]["recepient_name"] ?>" type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_company" value="<?php echo $query_result->result[0]["recepient_company"] ?>" type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_address1" value="<?php echo $query_result->result[0]["recepient_address1"] ?>" type="text" class="form-control" placeholder="Address 1*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_address2" value="<?php echo $query_result->result[0]["recepient_address2"] ?>" type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_state" value="<?php echo $query_result->result[0]["recepient_state"] ?>" type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_city" value="<?php echo $query_result->result[0]["recepient_city"] ?>" type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_pincode" value="<?php echo $query_result->result[0]["recepient_pincode"] ?>" type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_country" value="India" type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_mobile" value="<?php echo $query_result->result[0]["recepient_mobile"] ?>" type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_alt_mobile" value="<?php echo $query_result->result[0]["recepient_alt_mobile"] ?>" type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_email" value="<?php echo $query_result->result[0]["recepient_email"] ?>" type="email" class="form-control" placeholder="Email">
      </div>
      <div class="col-sm-6">
        <input name="recepient_gst" value="<?php echo $query_result->result[0]["recepient_gst"] ?>" type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>
<br><br>
  <button type="submit" class="btn btn-primary">Proceed</button>
</form>
<br><br>
</div>
<br>




<?php
}
else{
?>

<div class="container card" style="background:#fff; padding: 40px;">
<form class="form-horizontal" action="order_summary.php" method="POST">
<h4 class="text-left" style="border-bottom: 5px solid teal">Order Details</h4><br>
<div class="row">
<div class="col-sm-7">
<div class="form-group">
      <label class="col-sm-4">Parcel Category: </label>
      <div class="col-sm-8">
        <input type="text" name="parcel_category" class="inline-form-control"  placeholder="Category (eg. Gift, Grossary, furniture etc.)" required>
      </div>
    </div>
    <div class="form-group">
    <label class="col-sm-4">Weight:</label>
    <div class="col-sm-8">
    <input name="parcel_weight" type="number" step="0.001" min="0" max="10" id="wt" class="inline-form-control" placeholder="0.5" onchange="newOrderPriceCalculation()" onkeyup="newOrderPriceCalculation()" required> kg
  </div>
</div>
  <div class="form-group">
    <label class="col-sm-2">Dimension: </label>
    <div class="col-sm-10">
    <input name="parcel_length" type="number" step="0.001" min="0" max="100" class="inline-form-control" placeholder="Length" required > &times;
    <input name="parcel_width" type="number" step="0.001" min="0" max="100" class="inline-form-control" placeholder="Width" required > &times;
    <input name="parcel_height" type="number" step="0.001" min="0" max="100" class="inline-form-control" placeholder="Height" required > INCH
  </div>
</div>
  <div class="form-group">
      <label class="col-sm-4">Parcel Quantity: </label>
      <div class="col-sm-8">
        <input type="number" value="1" min="1" name="parcel_quantity" id="qty" class="inline-form-control"  placeholder="Quantity" required onchange="newOrderPriceCalculation()" onkeyup="newOrderPriceCalculation()">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4">Parcel Contents: </label>
      <div class="col-sm-8">
        <textarea type="text" name="parcel_content" class="inline-form-control" rows="3" cols="30" placeholder="Parcel contents* (eg. Shoes, Dress, Books etc)" required ></textarea>
      </div>
    </div>
    <div class="form-group">
    <label class="col-sm-4">Parcel Value:</label>
    <div class="col-sm-8">
    <input name="parcel_value" type="text" class="inline-form-control" placeholder="Parcel value" required > ₹
  </div>
</div>
</div>
  <div class="col-sm-5">
    <div class="well">
      <h2 class="text-primary"><span id="price"></span></h2><br>
      <h3 class="text-primary"><span id="gst"></span></h3><br>
      <h1 class="text-success"><span id="total"></span></h1><br>
      <p class="text-center text-danger">To calulate Amount Please Enter Weight & Quantity.</p><p class="text-warning text-center">This Calculator is only for Individual Clients</p>
    </div>
</div>
</div>

<script>
    function newOrderPriceCalculation(){
      let wt=document.getElementById("wt").value;
      let qty=document.getElementById("qty").value;
      //console.log(wt+partner+qty);
      let price_result=calcPrice(wt,"false",qty);
      console.log(price_result);
      if(typeof price_result.price == 'undefined'){
        document.getElementById("total").innerHTML="Something Went wrong! Please Confirm you not entered more than 10 kg weight";
      }
      else{
        document.getElementById("price").innerHTML="Amount: "+price_result.price+"₹";
        document.getElementById("gst").innerHTML="GST 18%: "+price_result.gst+"₹";
        document.getElementById("total").innerHTML="Total: "+price_result.total+"₹";
      }
    }
    </script>
  <br><br>
  <h4 class="text-left" style="border-bottom: 5px solid teal">Address Details </h4><br>
  <div class="col-sm-6">
  <h4 class="text-center">Sender Details</h4>
  <hr>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_name" type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_company" type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_address1" type="text" class="form-control" placeholder="Address 1*" required  required>
      </div>
      <div class="col-sm-6">
        <input name="sender_address2" type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_state" type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_city" type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_pincode" type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_country" type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_mobile" type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_alt_mobile" type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="sender_email" type="email" class="form-control" placeholder="Email*" required >
      </div>
      <div class="col-sm-6">
        <input name="sender_gst" type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>

  <div class="col-sm-6" style="border-left:1px solid grey;">
  <h4 class="text-center">Recepient Details</h4>
  <hr>
  <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_name" type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_company" type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_address1" type="text" class="form-control" placeholder="Address 1*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_address2" type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_state" type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_city" type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_pincode" type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_country" type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_mobile" type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input name="recepient_alt_mobile" type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input name="recepient_email" type="email" class="form-control" placeholder="Email">
      </div>
      <div class="col-sm-6">
        <input name="recepient_gst" type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>
<br><br>
  <button type="submit" class="btn btn-primary">Proceed</button>
</form>
<br><br>
</div>
<br>
<?php
} ?>
<script src="js/calc_rate.js"></script>
<?php
include("footer.php");
$_SESSION["order_amount"]="";
?>