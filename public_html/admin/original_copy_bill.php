<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");
if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
if(isset($_GET["order-id"])){
    $order_id = $_GET["order-id"];
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
             //var_dump($query_result);  
        } 

 }
else{
    echo "<div class='container card' style='margin-top:80px'><h2>Enter all mandatory fields</h2></div>";
    die("Order Id Not Provided");
}
?>
<?php include("header.php") ?>
<link href="admin/css/style.css" rel="stylesheet">
<div class="container" style=" margin-top:80px;">
  <h3 style="margin-bottom:8px; ">Order Invoice <small> Original Copy</small></h3>
  <div class="text-center"><button class="btn btn-default" onclick="window.print()">Print Invoice</button>
  <a href="dashboard.php"><button class="btn btn-link">Go to Dashboard</button></a>
  </div>
  <br>
</div>
<div class="container card" id="print-area" style="background:#fff; padding: 40px;">
    <img src="images/logo.png" style="width:150px; height:40; position:absolute;">
<p style="float:right"><b>Original Copy</b></p>
<span class="text-center"><?php echo "<h2><b>".$company_name."</b></h2>"; ?></span>
    <hr>
<table width="100%">
<tr>
<td>
        <?php
        $query_result_users=$connection->scn_select_all("users","id=".$query_result->result[0]["order_by"]);//(table_name, where_expression,distinct,orderby)
        
        if($query_result_users->error){
           $error_div ='<br><br><div class="container"><div class="alert alert-danger">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Alert!</strong> '.$query_result_users->message.'
          </div></div>';
              echo $error_div;
       }
       else{
            //var_dump($query_result_users);  
            echo '<b>Billed to : </b><p> <b>Name: </b>'.$query_result_users->result[0]["Name"].'</p> <p><b>Mobile No. </b>'.$query_result_users->result[0]["Mobile"].'</p> <p><b>Email: </b>'.$query_result_users->result[0]["Email"].'</p>';
       }
        ?>
    </td>
    <td>
        <p><b>Invoice No.</b> <?php echo date("Y/m/",strtotime($query_result->result[0]["time_stamp"])).$query_result->result[0]["id"]?></p>
        <p><b>Date of Invoice.</b> <?php echo date("d-m-Y"); ?></p>
        
        </td>
        </tr>
        </table>
<hr>
<h4 class="text-left" style="border-bottom: 5px solid teal">Order Details</h4><br>
<table class="table table-responsive" style="font-size:18px;">
    <thead>
        <tr>
            <td>Shipment Details</td>
            <td>Sender Details</td>
            <td>Receiver Details</td>
            <td>Barcode</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p><b>Parcel Weight: </b> <?php echo $query_result->result[0]["parcel_weight"] ?></p>
                <p><b>Parcel Dimension: L&times;B&times;H </b> <?php echo $query_result->result[0]["parcel_length"] ." &times; ". $query_result->result[0]["parcel_width"] ." &times; ".$query_result->result[0]["parcel_height"] ?></p>
                <p><b>Parcel contents: </b> <?php echo $query_result->result[0]["parcel_content"] ?></p>
                <p><b>Parcel Value(₹): </b> <?php echo $query_result->result[0]["parcel_value"] ?></p>
                <p><b>Quantity: </b> <?php echo $query_result->result[0]["parcel_quantity"] ?></p>
            </td>
            <td>
                <p><b><?php echo $query_result->result[0]["sender_name"]." ".$query_result->result[0]["sender_company"] ?></b></p>
                <p><?php echo $query_result->result[0]["sender_address1"]." ".$query_result->result[0]["sender_address2"]." ".$query_result->result[0]["sender_city"]." ".$query_result->result[0]["sender_state"]." ".$query_result->result[0]["sender_country"]." ".$query_result->result[0]["sender_pincode"] ?></p>
                <p><b>Contact: </b> <?php echo $query_result->result[0]["sender_mobile"]." ".$query_result->result[0]["sender_alt_mobile"]." ".$query_result->result[0]["sender_email"] ?></p>
            </td>
            <td>
                <p><b><?php echo $query_result->result[0]["recepient_name"]." ".$query_result->result[0]["recepient_company"] ?></b></p>
                <p><?php echo $query_result->result[0]["recepient_address1"]." ".$query_result->result[0]["recepient_address2"]." ".$query_result->result[0]["recepient_city"]." ".$query_result->result[0]["recepient_state"]." ".$query_result->result[0]["recepient_country"]." ".$query_result->result[0]["recepient_pincode"] ?></p>
                <p><b>Contact: </b> <?php echo $query_result->result[0]["recepient_mobile"]." ".$query_result->result[0]["recepient_alt_mobile"]." ".$query_result->result[0]["recepient_email"] ?></p>
            </td>
            <td>
            <img alt="<?php echo $query_result->result[0]["id"] ?>" src="barcode/barcode.php?codetype=Code39&size=40&text=<?php echo $query_result->result[0]["id"] ?>&print=false&orientation=vertical" style="float:right;  width: 90px;height:200px;" />
            </td>
        </tr>
    </tbody>
</table>

<div class="row">
    <div class="col-sm-6">
        <p>Terms & Condition Apply</p>
    </div>
    <div class="col-sm-6">
    <p><b>Receiver's Signature:</b></p>
    </div>
</div>
</div>
<style>
@media print {
  body * {
    visibility: hidden;
  }
  #print-area, #print-area * {
    visibility: visible;
  }
  #print-area {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
<?php include("footer.php") ?>