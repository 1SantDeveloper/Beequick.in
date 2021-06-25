<?php 
error_reporting(E_ALL ^ E_NOTICE); 
error_reporting(E_ERROR);
session_start();
require("scn_library/scn_library.php");
require("admin/config.php");
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');
if(!isset($_GET["uid"]) && empty($_GET["uid"])){
    die(json_encode(Array("error"=>"Userid not Provided")));
}
$user_id=$_GET["uid"];
$user_id=strrev($user_id);
if(isset($_GET["wt"]) && !empty($_GET["wt"])){
    $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection
    $partner_bool=$connection->scn_select_column("users",Array("is_partener"),"id=".$user_id);
    if($partner_bool->error){
        echo json_encode(Array("error"=>$partner_bool->message));
    }else{
        $status=$partner_bool->result[0]["is_partener"];
        price_calc($status, $_GET["wt"]);
        }
}

function price_calc($partner, $weight){
    $weight=(float)$weight;
    if($partner=="true"){
        if($weight>0 && $weight<= 0.5){
            echo json_encode(Array("price"=>50,"gst"=>gst(50),"total"=>50+gst(50)));
        }
        else if($weight>0.5 && $weight<= 5){
            echo json_encode(Array("price"=>55,"gst"=>gst(55),"total"=>55+gst(55)));
        }
        else if($weight>5 && $weight<= 10){
            echo json_encode(Array("price"=>60,"gst"=>gst(60),"total"=>60+gst(60)));
        }
        else{
            echo json_encode(Array("error"=>"You can send only 10 kg parcels Contact company"));
        }
    }
    else if($partner=="false"){
        if($weight>0 && $weight<= 0.5){
            echo json_encode(Array("price"=>80,"gst"=>gst(80),"total"=>80+gst(80)));
        }
        else if($weight>0.5 && $weight<= 5){
            echo json_encode(Array("price"=>80,"gst"=>gst(80),"total"=>80+gst(80)));
        }
        else if($weight>5 && $weight<= 10){
            echo json_encode(Array("price"=>100,"gst"=>gst(100),"total"=>100+gst(100)));
        }
        else{
            echo json_encode(Array("error"=>"You can send only 10 kg parcels Contact company"));
        }
    }
    else{
        echo "Critical error in Data base. Cofused whether he is partner or not";
    }
}
function gst($amt){
    return ($amt*18)/100;
}
?>