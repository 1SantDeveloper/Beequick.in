<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");

if(!isset($_SESSION["userid"])){
    header("Location: index.php");
    die("Login First!");
}
if(!isset($_GET["user-id"]) && empty($_GET["user-id"])){
    die("Something went wrong, may be user id not defined! :(");
}
else{
    if($_GET["status"]=="true" || $_GET["status"]=="false"){
        $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection 
        $query_result=$connection->scn_update_record('users','{"is_partener":"'.$_GET["status"].'"}','id='.$_GET['user-id']);
        
        if($query_result->error){
            $error_div ='<br><br><div class="container"><div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Alert!</strong> '.$query_result->message.'
           </div></div>';
               echo $error_div;
               exit($error_div);
        }
        else{
            header("Location: dashboard.php");       
            echo "<script>alert('updated successfully!')</script>";
        }
    }
    else{
        var_dump($_GET);
        echo "<script>alert('only true & false string are allowed in status!')</script>";
    }
}
?>