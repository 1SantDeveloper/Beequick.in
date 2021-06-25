<?php
session_start();
require("scn_library/scn_library.php");
require("admin/config.php");

if(!isset($_SESSION["client_id"])){
  header("Location: login.php");
}
if(isset($_POST["parcel_weight"],$_POST["parcel_length"],$_POST["parcel_width"],$_POST["parcel_height"],$_POST["parcel_content"],$_POST["sender_name"],$_POST["sender_address1"],$_POST["sender_state"],$_POST["sender_city"],$_POST["sender_pincode"],$_POST["sender_country"],$_POST["sender_mobile"],$_POST["sender_email"],$_POST["recepient_name"],$_POST["recepient_address1"],$_POST["recepient_state"],$_POST["recepient_city"],$_POST["recepient_pincode"],$_POST["recepient_country"],$_POST["recepient_mobile"],$_POST["recepient_email"])){
      
    $curl = curl_init(); 
     curl_setopt($curl, CURLOPT_URL, $PRICE_CALC_URL.$_POST["parcel_weight"]."&uid=".strrev($_SESSION["client_id"]));
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     if (curl_exec($curl) === FALSE) {
           die("Curl Failed: " . curl_error($curl));
        } else {
           $output =curl_exec($curl);
        }
     curl_close($curl);
     $output=json_decode($output);
     if(!isset($output->total)){
         exit("Parcel Charges Not Decided! Try Again! :(".$output);
     }
     $net_amount=(float)$output->total * $_POST["parcel_quantity"];
     $_SESSION["order_amount"]=$net_amount;
    $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
    $query_result=$connection->scn_insert_record('orders',
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
            "recepient_gst" : "'. $_POST["recepient_gst"].'",
            "order_by" : "'.$_SESSION["client_id"].'",
            "status" : "saved",
            "parcel_amount" : "'.$net_amount.'",
            "parcel_gst":"'.$output->gst*$_POST["parcel_quantity"].'",
            "parcel_price":"'.$output->price*$_POST["parcel_quantity"].'"
        }');
        
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
    $parcel_quantity = $_POST["parcel_quantity"];
    $parcel_weight = $_POST["parcel_weight"]; 
    $parcel_length = $_POST["parcel_length"]; 
    $parcel_width = $_POST["parcel_width"]; 
    $parcel_height = $_POST["parcel_height"]; 
    $parcel_content = $_POST["parcel_content"]; 
    $parcel_value = $_POST["parcel_value"];
    $sender_name = $_POST["sender_name"];
    $sender_company = $_POST["sender_company"];
    $sender_address1 = $_POST["sender_address1"]; 
    $sender_address2 = $_POST["sender_address2"]; 
    $sender_state = $_POST["sender_state"];
    $sender_city = $_POST["sender_city"];
    $sender_pincode = $_POST["sender_pincode"];
    $sender_country = $_POST["sender_country"];
    $sender_mobile = $_POST["sender_mobile"]; 
    $sender_alt_mobile = $_POST["sender_alt_mobile"]; 
    $sender_email = $_POST["sender_email"];
    $sender_gst = $_POST["sender_gst"];
    $recepient_name = $_POST["recepient_name"];
    $recepient_company = $_POST["recepient_company"];
    $recepient_address1 = $_POST["recepient_address1"];
    $recepient_address2 = $_POST["recepient_address2"];
    $recepient_state = $_POST["recepient_state"];
    $recepient_city = $_POST["recepient_city"];
    $recepient_pincode = $_POST["recepient_pincode"];
    $recepient_country = $_POST["recepient_country"];
    $recepient_mobile = $_POST["recepient_mobile"];
    $recepient_alt_mobile = $_POST["recepient_alt_mobile"];
    $recepient_email = $_POST["recepient_email"];
    $recepient_gst = $_POST["recepient_gst"];
}
else{
    echo "<div class='container card' style='margin-top:80px'><h2>Enter all mandatory fields</h2></div>";
    die("Enter All Mandatory Field");
}
?>
<?php include("header_desktop.php") ?>
<link href="admin/css/style.css" rel="stylesheet">
<div class="container" style=" margin-top:80px;">
  <h3 style="margin-bottom:8px; ">1. Order Details & Address Details >> 2. Order Summary >> <small> 3. Checkout</small></h3>
  
</div>
<div class="container card" style="background:#fff; padding: 40px;">
<h4 class="text-left" style="border-bottom: 5px solid teal">Order Summary</h4><br>
<table class="table table-responsive" style="font-size:18px;">
    <thead>
        <tr>
            <td>Shipment Details</td>
            <td>Sender Details</td>
            <td>Receiver Details</td>
            <td>Pricing (₹)</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p><b>Parcel Weight: </b> <?php echo $parcel_weight ?></p>
                <p><b>Parcel Dimension: L&times;B&times;H </b> <?php echo $parcel_length ." &times; ". $parcel_width ." &times; ".$parcel_height ?></p>
                <p><b>Parcel contents: </b> <?php echo $parcel_content ?></p>
                <p><b>Parcel Value(₹): </b> <?php echo $parcel_value ?></p>
                <p><b>Quantity: </b> <?php echo $parcel_quantity ?></p>
            </td>
            <td>
                <p><b><?php echo $sender_name." ".$sender_company ?></b></p>
                <p><?php echo $sender_address1." ".$sender_address2." ".$sender_city." ".$sender_state." ".$sender_country." ".$sender_pincode ?></p>
                <p><b>Contact: </b> <?php echo $sender_mobile." ".$sender_alt_mobile." ".$sender_email ?></p>
            </td>
            <td>
                <p><b><?php echo $recepient_name." ".$recepient_company ?></b></p>
                <p><?php echo $recepient_address1." ".$recepient_address2." ".$recepient_city." ".$recepient_state." ".$recepient_country." ".$recepient_pincode ?></p>
                <p><b>Contact: </b> <?php echo $recepient_mobile." ".$recepient_alt_mobile." ".$recepient_email ?></p>
            </td>
            <td>
<?php
//print_r($_SESSION);
if($_SESSION["is_partener"]=="true"){
    echo "<p>Your Invoice Will <br>be generated by admin.</p>";
}
else{
?>
            <p><b>Amount (₹) : </b> <?php echo (float)$output->price * $parcel_quantity ?>/-</p>
            <p><b>GST 18% (₹) : </b> <?php echo (float)$output->gst * $parcel_quantity ?>/-</p>
            <p><b>Total Amount (₹) : </b> <?php echo (float)$output->total * $parcel_quantity ?>/-</p>
<?php
}
?>            
            </td>
        </tr>
    </tbody>
</table>
<div style="width:80%; padding:12px;text-algin:right"><h2>  <?php
 if($_SESSION["is_partener"]=="true"){
    echo "";
}else{
 echo "Total charges:  (₹)".$_SESSION["order_amount"]." /-";
}
 ?></h2></div>
<hr>
<h4>Terms & Conditions Apply</h4><br>

<button class="btn btn-default" data-toggle="collapse" data-target="#tc">Read more...</button>
<br><br>

<ul id="tc" class="collapse">
	
<li>
		Parcel - Individual boxed item that has a single <?php echo $payment_gateway_company_name ?> carrier label.</li>	
<li>
	Consignment - A group of parcels sent through our service.</li>	
<li>
	Customer/Sender/User: The party who contracts with <?php echo $payment_gateway_company_name ?> to arrange collection and delivery of a parcel/consignment and who is responsible for payment of all Charges associated with delivery.</li>	
<li>
	Consignee/Receiver - The person who is receiving the parcel/consignment sent through <?php echo $payment_gateway_company_name ?>.</li>	
<li>
	Carrier/Third Party - Our carrier partners, including Blue Dart, DTDC, Overnight Express, Professional Couriers and others.</li>	
<li>
	The relevant collection point - means the address at which any Parcel/Consignment is to be collected by the carriers.</li>	
<li>
	The relevant delivery point - means the address to which any parcel/Consignment is to be delivered by our carriers.</li>	
<li>
	Driver release areas - means that the carrier deems this a 'safe' area and parcels can be left at the door without a signature. This only applies to certain services to certain areas.</li>	
<li>
	Shipping Label/AirWay Bill/Commercial Invoice - The documentation placed on/with the parcel.</li>	
<li>
	Working Day - Monday to Friday from 10am to 7pm within the INDIA, excluding public and bank holidays.</li>	
<li>
	Guarantee - Collection or delivery guarantee on applicable services or 'your money back'.</li>	
<li>
	Compensation Cover - This is Transit cover that provides cover against Loss and/or Damage. This cover does not apply to goods present on the Restricted and/or Prohibited list and any premium paid for cover on items which are on these lists is not refundable in the event of loss or damage.</li>	
<li>
	Charges: All charges payable by the Customer including but not limited to charges for the Carriage, surcharges (including but not limited to emergency, operational and fuel surcharges), storage charges, VAT, taxes, interest, fines, administration charges, duties, Customs duties, levies, Insurance premiums and any other amounts properly chargeable by <?php echo $payment_gateway_company_name ?> to the Customer in connection with the Carriage or imposed by regulatory bodies in relation to the Consignment(s) and any other amounts payable under these terms.</li>	
<li>
	Contract: The agreement between the Customer and <?php echo $payment_gateway_company_name ?> for provision of services.</li>	
<li>
	Member - means a person who has Registered on the site (and "Membership" means the status of being a Member);</li>	
</ul>

<hr>
<form action="checkout.php" method="POST">
    <input type="checkbox" value="<?php echo $query_result->result ?>" name="order_id_checkbox" required>  I Agree to above Terms and Conditions & I Declare the shipment contains no dangerous goods and restricted items.
    <br><br><button class="btn btn-primary">Agree & Proceed</button>
</form>

</div>
<br><br>
<?php include("footer.php");
 ?>