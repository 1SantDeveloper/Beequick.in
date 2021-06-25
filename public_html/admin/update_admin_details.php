<?php 
session_start();
require("../scn_library/scn_library.php");
require("config.php");
$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME); //Data base connection
$fname = $_SESSION["firstname"];
$lname = $_SESSION["lastname"];
$company = $_SESSION["company"];
$address = $_SESSION["address"];
$email = $_SESSION["email"];
$mobile = $_SESSION["mobile"];


if(isset($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["mobile"], $_POST["company"], $_POST["address"], $_POST["password"])){
    $new_fname = test_input($_POST["fname"]);
    $new_lname = test_input($_POST["lname"]);
    $new_email = test_input($_POST["email"]);
    $new_mobile = test_input($_POST["mobile"]);
    $new_company = test_input($_POST["company"]);
    $new_address = test_input($_POST["address"]);
    $new_password = password_hash(test_input($_POST["password"]),PASSWORD_DEFAULT);
    $temp_result = $connection->scn_update_record('admin','
    {
        "firstname":"'.$new_fname.'",
        "lastname":"'.$new_lname.'",
        "email":"'.$new_email.'",
        "mobile": "'.$new_mobile.'",
        "company":"'.$new_company.'",
        "address" : "'.$new_address.'",
        "password" : "'.$new_password.'"
    }','id='.$_SESSION["userid"]);
 if(!$temp_result->error){
  header("Location: logout.php");
    echo '<div class="container"><div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success! </strong> '.$temp_result->message.'
    </div></div>';
 }else{
    echo '<div class="container"><div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alert!</strong> '.$temp_result->message.'
    </div></div>';
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
<br>
<div class="container" style="background:#fff; padding: 40px">
<h2 class="text-center">Admin Details Update</h2><br>
<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label col-sm-4">First Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" value="<?php echo $fname?>" name="fname" required>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-4">Last Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" value="<?php echo $lname?>" name="lname" required>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label col-sm-4">Email ID</label>
      <div class="col-sm-8">
        <input type="email" class="form-control" value="<?php echo $email ?>" name="email" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4">Mobile</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" value="<?php echo $mobile ?>" name="mobile" required>
      </div>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="form-group">
      <label class="control-label col-sm-2">Office Address</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" rows="2" name="address" required><?php echo $address; ?></textarea>
      </div>
    </div>
  </div>


  <div class="col-sm-6">
    <div class="form-group">
      <label class="col-sm-4 control-label">Company Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control"value="<?php echo $company ?>" name="company" required >
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label class="col-sm-4 control-label">Password</label>
      <div class="col-sm-8">
        <input type="password" class="form-control" name="password" required >
      </div>
    </div>
  </div>
  <div class="text-center">
    <button class="btn btn-primary waves-effect waves-light " id="btn-submit">Save</button>
  </div>
  <input type="hidden" name="action" id="action" value="event_dialog_add_newpartnerdata" />
</form>
</div>
<br>
<?php include("footer.php") ?>