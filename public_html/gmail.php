<?php
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
try{
    if(mail("sachinarayans@gmail.com","My subject",$msg)){
     echo "Successfully Sent";   
    }
}catch(Exception $e){
    echo "failed".$e;
}

?>