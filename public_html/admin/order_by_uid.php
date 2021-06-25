<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");

if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
if(!isset($_GET["user-id"]) or empty($_GET["user-id"])){
    echo "<script>
    alert('Please Enter User Id');
    </script>";
}
?>

<?php include("header.php")?>
<script>
    $(document).ready(function() {
        $('#order').DataTable();
    } )
</script>

<br><br><hr>
<div class="container card" style="background:#fff;">
<br>
<h3>Monthly Invoice</h3>
<hr>
<form action="monthly_invoice.php" method="GET">
<input onchange="ab()" type="month" name="month" class="form-group" id="dat" required>
<input type="hidden" name="user-id" value="<?php echo $_GET["user-id"] ?>">
<input type="submit" value="Generate Invoice" title="Generate Monthly Invoice" class="btn">
</form>
<h2 id="d"></h2>
<script>
function ab(){
var a=document.getElementById("dat").value;
document.getElementById("d").innerHTML=a;
}
</script>
</div>
<!-- Order table -->
<hr >
<div class="container card" style="background:#fff;">
<br>
<h3>All Orders</h3>
<hr>
<table id="order" class="table">
        <thead>
            <tr>
                <th>Order Date</th>
                <th>Order Id</th>
                <th>Order Status</th>
                <th>Amount</th>
                <th>Edit</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
        <?php
$order_by=$_GET["user-id"];
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
$query_result=$connection->scn_select_all("orders","order_by=".$order_by);//(table_name, where_expression,distinct,orderby)
   
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
           echo "<tr><td>".date("d-m-Y",strtotime($value["time_stamp"]))."</td><td>".$value["id"]."</td><td>".$value["status"]."</td><td>".$value["parcel_amount"]."</td><td><a href='edit_order.php?order-id=".$value["id"]."'><button class='btn btn-info btn-xs'>Edit</button></a></td><td><a href='original_copy_bill.php?order-id=".$value["id"]."'><button class='btn btn-info btn-xs'>Print</button></a> <a href='order_view.php?order-id=".$value["id"]."'><button class='btn btn-info btn-xs'>View</button></a></td></tr>";
       }
        //var_dump($query_result);  
   }
 ?>
    </tbody>
</table>
    </div>
    <hr>
<?php include("footer.php") ?>