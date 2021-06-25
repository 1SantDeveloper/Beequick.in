
<?php 
//Currently not in use
include("header.php");
die("Please Log in as Client and then Apply for New Order");
 ?>

<br>
<div class="container card" style="background:#fff; padding: 40px">
<form class="form-horizontal" action="order_summary.php">
<h4 class="text-left" style="border-bottom: 5px solid teal">Order Details</h4><br>
  <div class="form-group">
    <label>Weight:</label>
    <input type="number" step="0.001" min="0" max="10000"  class="inline-form-control" placeholder="0.5" required> kg
  </div>
  <div class="form-group">
    <label>Dimension: </label>
    <input type="number" step="0.001" min="0" max="10000" class="inline-form-control" placeholder="Length" required > &times;
    <input type="number" step="0.001" min="0" max="10000" class="inline-form-control" placeholder="Width" required > &times;
    <input type="number" step="0.001" min="0" max="10000" class="inline-form-control" placeholder="Height" required > INCH
  </div>
    <div class="form-group">
      <label class="col-sm-1">Parcel Contents: </label>
      <div class="col-sm-10">
        <textarea type="text" class="inline-form-control" rows="3" cols="30" placeholder="Parcel contents* (eg. Shoes, Dress, Books etc)" required ></textarea>
      </div>
    </div>
    <div class="form-group">
    <label>Parcel Value:</label>
    <input type="text" class="inline-form-control" placeholder="Parcel value"> ₹
  </div>
  <br><br>
  <h4 class="text-left" style="border-bottom: 5px solid teal">Address Details </h4><br>
  <div class="col-sm-6">
  <h4 class="text-center">Sender Details</h4>
  <hr>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Address 1*" required  required>
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Email*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>

  <div class="col-sm-6" style="border-left:1px solid grey;">
  <h4 class="text-center">Recepient Details</h4>
  <hr>
  <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Contact Name*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Company name">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Address 1*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Address 2">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="State*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="City*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Pin code*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Country*" required >
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Mobile No*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Alternate No">
      </div>
    </div>
    <div class="form-group">
     <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Email*" required >
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="GST No:">
      </div>
    </div>
  </div>
<br><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br><br>
</div>
<?php include("footer.php") ?>