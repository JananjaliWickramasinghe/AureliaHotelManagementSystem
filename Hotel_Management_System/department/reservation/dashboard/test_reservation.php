<?php
require_once('../../connection.php');

$today =  date("m/d/y");

//task infor
$taskid=rand(1000,9999);

$_SESSION['taskid']=$taskid;

//sql
$getclients = "SELECT projectid,ProjectName,client,project,type FROM projects_topl WHERE task_type='TOPL' ORDER BY client DESC";
$resultgetclients = $conn->query($getclients);
//GET types
$gettypes = "SELECT typeid,name,description FROM types_topl ORDER BY typeid DESC";
$resultgettypes = $conn->query($gettypes);
//GET Users
$getusers = "SELECT uid_topl,firstname_topl,lastname_topl FROM users ORDER BY uid_topl ASC";
$resultgetusers = $conn->query($getusers);


?>

<?php
if(isset($_POST['addNewGuest'])){

  $fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$address_1 = $_POST['address_1'];
	$address_2= $_POST['address_2'];
	$city = $_POST['city'];
  $state = $_POST['state'];
  $zipcode = $_POST['zipcode'];
	$country = $_POST['country'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
 // $regDate = getdate();
  
  $sql ="INSERT INTO
	Guest(guest_id,
        first_name,
        last_name,
        address_line_1,
        address_line_2,
        city,
        state,
        country,
        zipcode,
        phone,
        email,
        reg_date)
	VALUES('',
        '$fName',
        '$lName',
        '$address_1',
        '$address_2',
        '$city',
        '$state',
        '$country',
        '$zipcode',
        '$phone',
        '$email',
        '$today')";

	if(mysqli_query($conn,$sql))
	{
		echo"<script>alert('Record inserted successfully!')</script>";
    
	}	
	else
	{
		echo"<script>alert('Error')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Create new user</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/css_subpage.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/forms.css" />
<style>
.contentform {
  max-width: 60% auto;
  margin: auto;
}
</style>
</head>
<body>

<br>

<div class="contentform">
  <div class="containerform">

  <h2 class="subtitle">Add new Reservation</h2>

  <hr>
      <form id="fupForm" name="form1" method = "post">

          <!-- Guest Details -->
          <div class="row">
            <div class="col-25">
              <label for="guestDetails">Guest Details</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="fName">First name</label>
                  <input type="text" id="fName" name="fName" required>
              </div>

              <div class="form-group col-md-4">
                  <label for="fName">Last name</label>
                  <input type="text" id="lName" name="lName" required>
              </div>  
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            <label for="location">Location</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="address_1">Address Line 1</label>
                  <input type="text" id="address_1" name="address_1" required>
              </div>

              <div class="form-group col-md-4">
                  <label for="address_2">Address Line 2</label>
                  <input type="text" id="address_2" name="address_2" required>
              </div> 
              
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="city">City</label>
                  <input type="text" id="city" name="city" required>
              </div>

              <div class="form-group col-md-4">
                  <label for="state">State</label>
                  <input type="text" id="state" name="state" required>
              </div> 
              
              <div class="form-group col-md-2">
                  <label for="zipcode">Zip code</label>
                  <input type="text" id="zipcode" name="zipcode" required>
              </div> 

              <div class="form-group col-md-4">
                  <label for="country">Country</label>
                  <input type="text" id="country" name="country" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            <label for="contact">Contact Details</label>
            </div>
            <div class="col-75">
               
              <div class="form-group col-md-4">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" name="phone" required>
              </div>

              <div class="form-group col-md-4">
                  <label for="email">Email</label>
                  <input type="text" id="email" name="email" required>
              </div> 
              
            </div>
          </div>
    
          <br>


          <!--Reservation Details-->


          <div class="row">
            <div class="col-25">
              <label for="RoomPref">Room preference</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                
                <select id="prefRoom" name="prefRoom" class="form-control">
                <option value="" selected="selected" disabled="">Select Room preference</option>
				<?php
				$sql = "SELECT room_id,room_name From Room";
				$result=mysqli_query($conn,$sql);
				while($row=mysqli_fetch_array($result))
				echo "<option value='" . $row['room_id'] . "'>".$row['room_id'] . $row['room_name'] . "</option>";
				?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="adults">No of Adults</label>
                  <input type="number" id="noAdults" name="noAdults" min="0" >
              </div>

              <div class="form-group col-md-4">
                  <label for="children">No of Children</label>
                  <input type="number" id="noChildren" name="noChildren" min="0">
              </div> 

              <div class="form-group col-md-4">
                  <label for="nights">No of Nights at the Hotel</label>
                  <input type="number" id="noNights" name="noNights" min="0">
              </div>
              
            </div>
          </div>


          <div class="row">
            <div class="col-25">
            <label for="checkin">Check-in</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="checkinDate">Checkin Date</label>
                  <input type="date" id="checkinDate" name="checkinDate" value="<?php echo date('Y-m-d');?>">
              </div>

              <div class="form-group col-md-4">
                  <label for="checkinTime">Checkin Time</label>
                  <input type="time" class="form-control" value="<?php $date = date("H:i", strtotime($row['time_d'])); echo "$date"; ?>" id="checkinTime" name="checkinTime"  />
              </div> 
              
            </div>
          </div>

          <div class="row">
            <div class="col-25">
                <label for="checkout">Check-out</label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-4">
                  <label for="checkoutDate">Checkout Date</label>
                  <input type="date" id="checkoutDate" name="checkoutDate" value="<?php echo date('Y-m-d');?>">
              </div>

              <div class="form-group col-md-4">
                  <label for="checkoutTime">Checkin Time</label>
                  <input type="time" class="form-control" value="<?php $date = date("H:i", strtotime($row['time_d'])); echo "$date"; ?>" id="checkoutTime" name="checkoutTime"  />
              </div> 
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            <label for="request">Special Requests</label>
            </div>
            <div class="col-75">
                <textarea id="requests" name="requests" placeholder="Description" style="height:70px"></textarea> 
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            <label for="source">Source Type</label>
            </div>
            <div class="col-75">
                <select id="source" name="source" class="form-control">
                <option value="" selected="selected" disabled="">Select Source type</option>
				<option value="website">Website</option>
                <option value="walk-in">Walk-in</option>
                <option value="by-call">By call</option>
                </select>
            </div>
          </div>
    
          <br>

          <div class="row">
            <div class="form-group col-md-10">
              <input name = "addNewGuest" type="submit" value = "Submit" class = "btn btn-success" />
            </div> 
          </div>
       </form>

       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>



</body>
</html>