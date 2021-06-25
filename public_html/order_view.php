<?php
session_start();
require("scn_library/scn_library.php");
require("admin/config.php");

if(!isset($_SESSION["client_id"])){
    header("Location: login.php");
    die("Login First!");
}
$name = $_SESSION["client_fullname"];
$company = $_SESSION["client_company"];
$address = $_SESSION["client_address"];
?>

<?php include("header.php")?>
<!-- <script>
    $(document).ready(function() {
        $('#order').DataTable();
        $('#team').DataTable();
    } )
</script> -->

<br><br><hr>
<link href="admin/css/style.css" rel="stylesheet">
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
    	 <div class="well profile card" style="background: #fff">
            <div class="col-sm-12">
                <div class="col-xs-12 col-sm-8">
                    <h2><?php echo $name; ?></h2>
                    <p><strong>Company: </strong> <?php echo $company; ?> </p>
                    <p><strong>Address: </strong> <?php echo $address; ?> </p>
                    <p><strong>Email: </strong> <?php echo $_SESSION["client_email"]; ?> </p>
                    <p><strong>Mobile: </strong> <?php echo $_SESSION["client_mobile"]; ?> </p>
                    <p><strong>Authority: </strong>
                        <span class="tags">Client</span> 
                    </p>
                </div>    <br>         
                <div class="col-xs-12 col-sm-4 text-center">
                    <figure>
                        <img src="http://placehold.it/300x300" alt="" class="img-circle img-responsive">
                        <!-- <figcaption class="ratings">
                            <p>Ratings
                            <a href="#">
                                <span class="fa fa-star"></span>
                            </a>
                            <a href="#">
                                <span class="fa fa-star"></span>
                            </a>
                            <a href="#">
                                <span class="fa fa-star"></span>
                            </a>
                            <a href="#">
                                <span class="fa fa-star"></span>
                            </a>
                            <a href="#">
                                 <span class="fa fa-star-o"></span>
                            </a> 
                            </p>
                        </figcaption> -->
                    </figure>
                </div>
            </div>     
                   
            <div class="col-xs-12 divider text-center">
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong></strong></h2>                    
                    <p><small> ||||||||||</small></p>
                   <a href="new_order.php" class="btn-link"> <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> New Order </button></a>
                </div>
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong></strong></h2>                    
                    <p><small>|||||||||||</small></p>
                    <a href="#order" class="btn-link"><button class="btn btn-info btn-block"><span class="fa fa-user"></span> Order Detail </button></a>
                </div>
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong></strong></h2>                    
                    <p><small>|||||||||</small></p>
                    <div class="btn-group dropup btn-block">
                      <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu text-left" role="menu">
                      <li><a href="logout.php"><span class="fa fa-power-off pull-right"></span> Logout </a></li>
                        <li><a href="#"><span class="fa fa-envelope pull-right"></span> Send an email </a></li>
                        <li><a href="#"><span class="fa fa-list pull-right"></span> Add or remove from a list  </a></li>
                        <li class="divider"></li>
                        <li><a href="update_admin_details.php"><i class="glyphicon glyphicon-edit pull-right"></i>Edit Your Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="btn disabled" role="button"> Unfollow </a></li>
                      </ul>
                    </div>
                </div>
            </div>
    	 </div>                 
		</div>
	</div>
</div>

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
$order_by=$_SESSION["client_id"];
$order_id=$_GET["order-id"];
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
$query_result=$connection->scn_select_all("orders","id=".$order_id." AND order_by=".$order_by);//(table_name, where_expression,distinct,orderby)
   
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
           echo "<tr><td>".$value["id"]."</td><td>".date("d-m-Y",strtotime($value["time_stamp"]))."</td><td>".$value["status"]."</td><td>".$value["parcel_amount"]."</td><td><a href='customer_copy_bill.php?order-id=".$value["id"]."'><button class='btn btn-success btn-xs'>Print</button></a></td></tr>";
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