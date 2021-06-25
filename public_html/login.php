<?php
session_start();
require("scn_library/scn_library.php");
require("admin/config.php");
if(isset($_SESSION["client_id"])){
    header("Location: index.php");
}
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection
$email; 
$pass ; 
$user_pass; //store email password from sql in 2d array 
if(isset($_POST["email"],$_POST["pass"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
    $email = test_input($_POST["email"]);
    $pass = test_input($_POST["pass"]);
    //echo $email." ".password_hash($pass,PASSWORD_DEFAULT);
    //echo var_dump($pass);
    $user_pass=$connection->scn_select_all("users","Email='".$email."'");//(table_name, where_expression,distinct,orderby)

    if(!$user_pass->error && $email == $user_pass->result[0]["Email"]){
        if(password_verify($pass, $user_pass->result[0]["Password"])){
            $_SESSION["client_id"] = $user_pass->result[0]["id"];
            $_SESSION["client_fullname"] = $user_pass->result[0]["Name"];
            $_SESSION["client_email"] = $user_pass->result[0]["Email"];
            $_SESSION["client_address"] = $user_pass->result[0]["Address"];
            $_SESSION["client_mobile"] = $user_pass->result[0]["Mobile"];
            $_SESSION["client_company"] = $user_pass->result[0]["Company"];
            $_SESSION["is_partener"] = $user_pass->result[0]["is_partener"];
            //print_r($_SESSION);
            header("Location: user_dashboard.php");
        }
        else{
            $_SESSION["error_msg"] = "Wrong Password for ".$email;
        }
    }
    else{
        $_SESSION["error_msg"] = "Wrong User Name ";
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
                session_destroy();
            }
            ?>
    </div>
</section>
<div class="limiter">
        <div class="container-login100">
        <div class="wrap-login100">
        <div class="login100-form-title" style="background-image: url(images/work12.jpg);">
        <span class="login100-form-title-1">
        Sign In
        </span>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"class="login100-form validate-form" method="post">
        <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
        <span class="label-input100">Email*</span>
        <input class="input100" type="email" name="email" placeholder="Enter Email" required>
        <span class="focus-input100"></span>
        </div>
        <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
        <span class="label-input100">Password*</span>
        <input class="input100" type="password" name="pass" placeholder="Enter password" required>
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
        Login
        </button>
        </div>
        </form>

        <div class="text-center">
        <a href="user_register.php" style>
            <button class="btn-link" style="padding: 12px 5px !important">Don't have an Account? Register</button>
        </a>
        |
        <a href="password_reset.php" style>
            <button class="btn-link" style="padding: 12px 5px !important">Forget Password? Reset</button>
        </a>
</div>
<br>
        </div>
        </div>
        </div>
        <?php include("footer.php") ?>