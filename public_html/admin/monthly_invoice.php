<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");
if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
if(isset($_GET["user-id"],$_GET["month"])){
    $client_id = $_GET["user-id"];
     $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
     $query_result=$connection->scn_select_all("orders","order_by=".$client_id);//(table_name, where_expression,distinct,orderby)
        
         if($query_result->error){
            $error_div ='<br><br><div class="container"><div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Alert!</strong> '.$query_result->message.'
           </div></div>';
               echo $error_div;
        }
        else{
             //var_dump($query_result);  
        } 

 }
else{
    echo "<div class='container card' style='margin-top:80px'><h2>Enter all mandatory fields</h2></div>";
    die("User Id Not Provided");
}
?>
<?php include("header.php") ?>
<div class="container" style=" margin-top:80px;">
  <h3 style="margin-bottom:8px; ">Monthly Invoice <small> Original Copy</small></h3>
  <div class="text-center"><button class="btn btn-default" onclick="window.print()">Print Invoice</button>
  <a href="dashboard.php"><button class="btn btn-link">Go to Dashboard</button></a>
  </div>
  <br>
</div>
<div class="container card" id="print-area" style="background:#fff; padding: 40px;">
    <img src="images/logo.png" style="width:150px; height:40; position:absolute;">
<p style="float:right"><b>Original Copy</b></p>
<div class="row">
    <div class="col-sm-12 text-center">
        <p><u>Monthly Invoice</u></p>
        <?php echo "<h2><b>".$company_name."</b></h2>"; ?>
    </div>
    </div>
    <hr>
<div class="row">
    <div class="col-sm-12">
        <p><b>Invoice of Month</b> <?php echo date("m-Y",strtotime($query_result->result[0]["time_stamp"]))?></p>
        <p><b>Date of Invoice.</b> <?php echo date("d-m-Y"); ?></p>
        <hr>
        <?php
        $query_result_users=$connection->scn_select_all("users","id=".$_GET["user-id"]);//(table_name, where_expression,distinct,orderby)
        
        if($query_result_users->error){
           $error_div ='<br><br><div class="container"><div class="alert alert-danger">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Alert!</strong> '.$query_result_users->message.'
          </div></div>';
              echo $error_div;
       }
       else{
            //var_dump($query_result_users);  
            echo '<b>Billed to : </b><p> <b>Name: </b>'.$query_result_users->result[0]["Name"].'</p>  <p><b>Mobile No. </b>'.$query_result_users->result[0]["Mobile"].'</p> <p><b>Email: </b>'.$query_result_users->result[0]["Email"].'</p>';
       }
        ?>
    </div>
</div>
<hr>
<h4 class="text-left" style="border-bottom: 5px solid teal">Order Summary</h4><br>
<table class="table table-responsive" style="font-size:18px;">
    <thead>
        <tr>
            <td>Order Id</td>
            <td>Description of Parcel</td>
            <td>Qty.</td>
            <td>Order Date</td>
            <td>GST</td>
            <td>Amount</td>         
        </tr>
    </thead>
    <tbody>
    <?php
    $gt=0;
    foreach($query_result->result as $value){ 
        if(date("m",strtotime($value["time_stamp"]))==date("m",strtotime($_GET["month"]))){
            $gt+=(float)$value["parcel_amount"];
    ?>
        <tr>
            <td><?php echo $value["id"] ?></td>
            <td><?php echo $value["parcel_content"] ?></td>
            <td><?php echo $value["parcel_quantity"] ?></td>
            <td><?php echo date("d/m/Y",strtotime($value["time_stamp"])); ?></td>
            <td><?php echo "18%" ?></td>
            <td><?php echo $value["parcel_amount"]." ₹" ?></td>
        </tr>
    <?php }} ?>
    </tbody>
    <thead>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo "Grand Total" ?></td>
            <td><?php echo $gt." ₹" ?></td>
        </tr>
    </thead>
</table>
<hr>
<div class="row">
    <div class="col-sm-6">
        <p>Terms & Conditions Apply</p>
    </div>
    <div class="col-sm-6">
    <p><b>Receiver's Signature:</b></p>
    </div>
</div>
</div><br><br>
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