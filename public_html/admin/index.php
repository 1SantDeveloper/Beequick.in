<?php
session_start();
require("../scn_library/scn_library.php");
require("config.php");
if(isset($_SESSION["userid"])){
    header("Location: dashboard.php");
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
    $user_pass=$connection->scn_select_all("admin","email='".$email."'");//(table_name, where_expression,distinct,orderby)

    if(!$user_pass->error && $email == $user_pass->result[0]["email"]){
        if(password_verify($pass, $user_pass->result[0]["password"])){
            $_SESSION["userid"] = $user_pass->result[0]["id"];
            $_SESSION["firstname"] = $user_pass->result[0]["firstname"];
            $_SESSION["lastname"] = $user_pass->result[0]["lastname"];
            $_SESSION["email"] = $user_pass->result[0]["email"];
            $_SESSION["address"] = $user_pass->result[0]["address"];
            $_SESSION["mobile"] = $user_pass->result[0]["mobile"];
            $_SESSION["company"] = $user_pass->result[0]["company"];
            header("Location: dashboard.php");
            echo "login success";
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
        <div class="login100-form-title" style="background-image: url(../images/work12.jpg);">
        <span class="login100-form-title-1">
        Sign In
        </span>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"class="login100-form validate-form" method="post">
        <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
        <span class="label-input100">Email</span>
        <input class="input100" type="email" name="email" placeholder="Enter Email" required>
        <span class="focus-input100"></span>
        </div>
        <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
        <span class="label-input100">Password</span>
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
        </div>
        </div>
        </div>
        <?php include("footer.php") ?>