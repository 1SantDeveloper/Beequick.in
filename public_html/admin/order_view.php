<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");

if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
?>

<?php include("header.php")?>

<br><br>
<div class="container">
	<h2>Order Details</h2>
</div>
<hr>

<!-- Order table -->
<div class="container card" style="background:#fff;" id="order">
<br>
<table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Amount</th>
                <th>Bill</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_GET["order-id"])){
            $order_id=$_GET["order-id"];
        }
        else{
            echo "<script>alert('Order id not defined');</script>";
            die("order id not defined");
        }
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
$query_result=$connection->scn_select_all("orders","id=".$order_id);//(table_name, where_expression,distinct,orderby)
   
    if($query_result->error){
       $error_div ='<br><br><div class="container"><div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Alert!</strong> '.$query_result->message.'
      </div></div>';
          echo $error_div;
          die($error_div);
   }
   else{
       foreach($query_result->result as $value){
           echo "<tr><td>".$value["id"]."</td><td>".date("d-m-Y",strtotime($value["time_stamp"]))."</td><td>".$value["status"]."</td><td>".$value["parcel_amount"]."</td><td><a href='original_copy_bill.php?order-id=".$value["id"]."'><button class='btn btn-success btn-xs'>Print</button></a></td></tr>";
       }
        //var_dump($query_result);  
   }
 ?>
    </tbody>
</table>
</div>
<hr >
<div class="container card" style="background:#fff;" id="order">
<br>
<h3>Order Detail</h3>
<hr>

<table class="table table-striped table-bordered" style="width:100%">
<tbody>
<tr><td>Order Status</td><td><?php echo $query_result->result[0]["status"] ?></td></tr>
<tr><td>Order Id</td><td><?php echo $query_result->result[0]["id"] ?></td></tr>
<tr><td>Parcel Weight</td><td><?php echo $query_result->result[0]["parcel_weight"] ?></td></tr>
<tr><td>Dimension L &times; B &times; H </td><td><?php echo $query_result->result[0]["parcel_length"]." &times; ".$query_result->result[0]["parcel_width"]." &times; ".$query_result->result[0]["parcel_height"] ?></td></tr>
<tr><td>Parcel Content</td><td><?php echo $query_result->result[0]["parcel_content"] ?></td></tr>
<tr><td>Parcel Value</td><td><?php echo $query_result->result[0]["parcel_value"] ?></td></tr>
<tr><td>parcel Category</td><td><?php echo $query_result->result[0]["parcel_category"] ?></td></tr>
<tr><td>Parcel Quantity</td><td><?php echo $query_result->result[0]["parcel_quantity"] ?></td></tr>
<tr><td>Amount</td><td><?php echo $query_result->result[0]["parcel_amount"] ?></td></tr>
<tr><td>Order Date</td><td><?php echo date("d-m-Y",strtotime($value["time_stamp"])) ?></td></tr>
<tr><td></td></tr>
<tr><td><b>Sender details</b></td></tr>
<tr><td>Name</td><td><?php echo $query_result->result[0]["sender_name"] ?></td></tr>
<tr><td>Company Name</td><td><?php echo $query_result->result[0]["sender_company"] ?></td></tr>
<tr><td>Address 1</td><td><?php echo $query_result->result[0]["sender_address1"] ?></td></tr>
<tr><td>Address 2</td><td><?php echo $query_result->result[0]["sender_address2"] ?></td></tr>
<tr><td>State</td><td><?php echo $query_result->result[0]["sender_state"] ?></td></tr>
<tr><td>City</td><td><?php echo $query_result->result[0]["sender_city"] ?></td></tr>
<tr><td>Pincode</td><td><?php echo $query_result->result[0]["sender_pincode"] ?></td></tr>
<tr><td>Country</td><td><?php echo $query_result->result[0]["sender_country"] ?></td></tr>
<tr><td>Mobile</td><td><?php echo $query_result->result[0]["sender_mobile"] ?></td></tr>
<tr><td>Email</td><td><?php echo $query_result->result[0]["sender_email"] ?></td></tr>
<tr><td>GST</td><td><?php echo $query_result->result[0]["sender_gst"] ?></td></tr>
<tr><td></td></tr>
<tr><td><b>Receiver details</b></td></tr>
<tr><td>Name</td><td><?php echo $query_result->result[0]["recepient_name"] ?></td></tr>
<tr><td>Company Name</td><td><?php echo $query_result->result[0]["recepient_company"] ?></td></tr>
<tr><td>Address 1</td><td><?php echo $query_result->result[0]["recepient_address1"] ?></td></tr>
<tr><td>Address 2</td><td><?php echo $query_result->result[0]["recepient_address2"] ?></td></tr>
<tr><td>State</td><td><?php echo $query_result->result[0]["recepient_state"] ?></td></tr>
<tr><td>City</td><td><?php echo $query_result->result[0]["recepient_city"] ?></td></tr>
<tr><td>Pincode</td><td><?php echo $query_result->result[0]["recepient_pincode"] ?></td></tr>
<tr><td>Country</td><td><?php echo $query_result->result[0]["recepient_country"] ?></td></tr>
<tr><td>Mobile</td><td><?php echo $query_result->result[0]["recepient_mobile"] ?></td></tr>
<tr><td>Email</td><td><?php echo $query_result->result[0]["recepient_email"] ?></td></tr>
<tr><td>GST</td><td><?php echo $query_result->result[0]["recepient_gst"] ?></td></tr>

</tbody>
</table>
    </div>
    <hr>
<?php include("footer.php") ?>