<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");
require("emailf.php");
error_reporting(E_ALL ^ E_WARNING);

if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
if(isset($_POST["order_status"]) || isset($_POST["order_amount"])){
    if(!empty($_POST["order_status"])){
        $check_work=true;
        $key="status";
        $value=$_POST["order_status"];
    }
    if(!empty($_POST["order_amount"])){
        $check_work=true;
        $key="parcel_amount";
        $value=$_POST["order_amount"];
    }
}

//backend upadate function start
 if(isset($_POST["order-id"]) && $check_work){
     $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
     $query_result=$connection->scn_update_record('orders',
      '{
            "'.$key.'" : "'.$value.'"
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
             $user_id=$connection->scn_select_column("orders",Array("order_by"),"id=".$_POST["order-id"]);//(table_name, where_expression,
             $user_email=$connection->scn_select_column("users",Array("Email","Name"),"id=".$user_id->result[0]["order_by"]);
             emailf($user_email->result[0]["Email"],$user_email->result[0]["Name"],"Status Updated","<h2>Your Order ".$key." is Updated.<br>".$key.": ".$value."</h2><p>--BeeQuick.in</p>",'Your Order '.$key.': '.$value.' is updated --BeeQuick.in');
             echo "<script>alert('Successfully updated! ".$key."');window.history.back();</script>";
               
         }
    }
//Edit order backend function end
?>