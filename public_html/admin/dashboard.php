<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");

if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
$name = $_SESSION["firstname"]." ".$_SESSION["lastname"];
$company = $_SESSION["company"];
$address = $_SESSION["address"];
?>

<?php include("header.php")?>
<script>
    $(document).ready(function() {
        $('#order').DataTable();
        $('#team').DataTable();
        $('#partner').DataTable();
    } )
</script>





<br>
<div class="container">
<a href="update_admin_details.php"><button title="Change Your Password from here">Edit Admin Details</button></a>
<a href="logout.php"><button>LogOut</button></a>
</div>
<hr>





<div class="container card">
        <h3>Regular Clients</h3>
        <hr>
    <table id="partner" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Company</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
$query_result_users=$connection->scn_select_all("users","is_partener='true'");//(table_name, where_expression,distinct,orderby)
   
    if($query_result_users->error){
       $error_div ='<br><br><div class="container"><div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Alert!</strong> '.$query_result_users->message.'
      </div></div>';
          echo $error_div;
   }
   else{
       foreach($query_result_users->result as $value){
        $btn="";   
        if($value["is_partener"]=="true"){
                $btn="<a href='order_by_uid.php?user-id=".$value["id"]."&status=false'><button title='View Order of this user' class='btn btn-info btn-xs'>View</button></a>  <a href='add_partner.php?user-id=".$value["id"]."&status=false'><button title='Remove Client' style='float:right' class='btn btn-danger btn-xs'>&times;</button></a>";
            }
            else if($value["is_partener"]=="false"){
                $btn="<a href='order_by_uid.php?user-id=".$value["id"]."&status=false'><button title='View Order of this user' class='btn btn-info btn-xs'>View</button></a><a href='add_partner.php?user-id=".$value["id"]."&status=true'><button class='btn btn-success btn-xs'>Assign as Client</button></a>";
            }
           echo "<tr><td>".$value["Name"]."</td><td>".$value["Mobile"]."</td><td>".$value["Email"]."</td><td>".$value["Company"]."</td><td>".$value["Address"]."</td><td>".$btn."</td></tr>";
       }
        //var_dump($query_result_users);  
   }
 ?>
     <tfoot>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Company</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </tbody>


</table>
    </div>
    <hr>
<div class="container card">
        <h3>Individual Clients</h3>
        <hr>
    <table id="team" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Company</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
$query_result_users=$connection->scn_select_all("users","is_partener='false'");//(table_name, where_expression,distinct,orderby)
   
    if($query_result_users->error){
       $error_div ='<br><br><div class="container"><div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Alert!</strong> '.$query_result_users->message.'
      </div></div>';
          echo $error_div;
   }
   else{
       foreach($query_result_users->result as $value){
        $btn="";   
        if($value["is_partener"]=="true"){
                $btn="<a href='order_by_uid.php?user-id=".$value["id"]."&status=false'><button title='View Order of this user' class='btn btn-info btn-xs'>View</button></a> <a href='add_partner.php?user-id=".$value["id"]."&status=false'><button class='btn btn-danger btn-xs' style='float:right'>&times;</button></a>";
            }
            else if($value["is_partener"]=="false"){
                $btn="<a href='order_by_uid.php?user-id=".$value["id"]."&status=false'><button title='View Order of this user' class='btn btn-info btn-xs'>View</button></a> <a href='add_partner.php?user-id=".$value["id"]."&status=true'><button class='btn btn-success btn-xs'>Assign as Client</button></a>";
            }
           echo "<tr><td>".$value["Name"]."</td><td>".$value["Mobile"]."</td><td>".$value["Email"]."</td><td>".$value["Company"]."</td><td>".$value["Address"]."</td><td>".$btn."</td></tr>";
       }
        //var_dump($query_result_users);  
   }
 ?>
     <tfoot>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Company</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </tbody>


</table>
    </div>
    <hr>
<!-- Order table -->
<div class="container card" style="background:#fff;">
<h3>Recent Orders</h3>
<hr>
<table id="order" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Order Date</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Sender Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
$query_result=$connection->scn_select_all("orders");//(table_name, where_expression,distinct,orderby)
   
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
           echo "<tr><td>".date("d-m-Y",strtotime($value["time_stamp"]))."</td><td>".$value["id"]."</td><td>".$value["status"]."</td><td>".$value["parcel_amount"]."</td><td>".$value["sender_mobile"]."</td><td><a href='edit_order.php?order-id=".$value["id"]."'><button class='btn btn-info btn-xs'>Edit</button></a> <a href='order_view.php?order-id=".$value["id"]."'><button class='btn btn-info btn-xs'>View</button></a> <a href='original_copy_bill.php?order-id=".$value["id"]."'><button class='btn btn-success btn-xs'>Print</button></a></td></tr>";
       }
        //var_dump($query_result);  
   }
 ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Order Date</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- Order Table -->

    <hr>

<?php include("footer.php") ?>