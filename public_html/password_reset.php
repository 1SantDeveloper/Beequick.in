<?php
session_start();
require("scn_library/scn_library.php");
require("admin/config.php");
require("admin/emailf.php");
error_reporting(E_ALL ^ E_WARNING); 
if(isset($_SESSION["client_id"])){
    header("Location: index.php");
}
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection
$email;  
$user_pass; //store email password from sql in 2d array 
if(isset($_POST["email"]) && !empty($_POST["email"])){
    $email = test_input($_POST["email"]);
    $user_pass=$connection->scn_select_all("users","Email='".$email."'");//(table_name, where_expression,distinct,orderby)

    if(!$user_pass->error && $email == $user_pass->result[0]["Email"]){
        $otp=rand(1000,9999);
        $_SESSION["reset_otp"]=$otp;
        $_SESSION["reset_email"]=$email;
        if(emailf($email,$user_pass->result[0]["Name"],"Password Reset","<h2>Your OTP is ".$otp."</h2><p>Enter this OTP to Reset your password in BeeQuick.in </br> Must Update your Password</p>",'Your OTP is '.$otp.'. Must Update Your password')){
            header("Location: reset_otp.php");
        }
        
    }
    else{
        $_SESSION["error_msg"] = "No User Exists with this email! Create New Account";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<?php include("header.php")?>
<link href="admin/css/style.css" rel="stylesheet">
<br><br>
<section style="background:#ebeeef">
    <div class="container">
            <?php 
            if(isset($_SESSION["error_msg"])){
                $error_div ='<br><div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Alert!</strong> '.$_SESSION["error_msg"].'
            </div>';
                echo $error_div;
            }
            ?>
    </div>
</section>
<div class="limiter">
        <div class="container-login100">
        <div class="wrap-login100">
        <div class="login100-form-title" style="background-image: url(images/work12.jpg);">
        <span class="login100-form-title-1">
        Password Reset
        </span>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"class="login100-form validate-form" method="post">
        <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
        <span class="label-input100">Email*</span>
        <input class="input100" type="email" name="email" placeholder="Enter Email" required>
        <span class="focus-input100"></span>
        </div>
        <div class="flex-sb-m w-full p-b-30">
        <div class="contact100-form-checkbox">
        </div>
        <div>
        </div>
        </div>
        <div class="container-login100-form-btn">
        <button class="login100-form-btn">
        Send Email
        </button>
        </div>
        </form>

        <div class="text-center">
        <a href="user_register.php" style>
            <button class="btn-link" style="padding: 12px 5px !important">Don't have an Account? Register</button>
        </a>
        |
        <a href="login.php" style>
            <button class="btn-link" style="padding: 12px 5px !important">Login</button>
        </a>
</div>
<br>
        </div>
        </div>
        </div>
        <?php include("footer.php") ?>