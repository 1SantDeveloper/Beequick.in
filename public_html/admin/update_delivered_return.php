<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");

if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
if(isset($_POST["order_delivered"],$_POST["order_returned"])){
        $check_work=true;
        $key="order_delivered";
        $value=$_POST["order_delivered"];
        $key1="order_returned";
        $value1=$_POST["order_returned"];
}

//backend upadate function start
 if(isset($_POST["order-id"]) && $check_work){
     $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
     $query_result=$connection->scn_update_record('orders',
      '{
            "'.$key.'" : "'.$value.'",
            "'.$key1.'" : "'.$value1.'"
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
             echo "<script>alert('Successfully updated! ".$key."');window.history.back();</script>";
               
         }
    }
//Edit order backend function end
?>