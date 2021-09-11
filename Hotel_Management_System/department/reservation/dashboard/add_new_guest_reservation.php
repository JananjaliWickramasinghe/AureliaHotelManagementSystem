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
if (isset($_POST['newBooking'])) {
    $id = $_POST['guest']; 
    //echo 'Guests ID: '.$id;  
}	 
?>

<?php
if (isset($_POST['addNewBooking'])) {
    $i= $_POST['guestID'];
    
    $prefRoom = $_POST['pref'];
	  $noAdults = $_POST['noAdults'];
	  $noChildren = $_POST['noChildren'];
	  $noNights= $_POST['noNights'];
    $checkinDate = date('Y-m-d', strtotime($_POST['checkinDate']));
    $checkoutDate = date('Y-m-d', strtotime($_POST['checkoutDate']));
    $checkinTime = $_POST['checkinTime'];
    $checkoutTime = $_POST['checkoutTime'];
    $requests =$_POST['requests'];
    $source= $_POST['source'];
    $status= 'hold';
    
    echo $prefRoom ;
    echo $noAdults;
    echo $noChildren;
    echo $noNights;
    echo $checkinDate;
    echo $checkinTime;
    echo $checkoutDate;
    echo $checkoutTime;
    echo $requests;
    echo $source;
    echo $status;

    $sql ="INSERT INTO
    Booking(booking_id,guest_id,room_id,no_ofNights,no_ofAdults,no_ofChildren,checkin,checkout,
    checkin_time,checkout_time,requests,sourceType,book_status)
    VALUES('',(SELECT guest_id FROM Guest WHERE guest_id='$i'),(SELECT room_id FROM Room WHERE room_id='$prefRoom'),
    '$noNights','$noAdults','$noChildren','$checkinDate','$checkoutDate','$checkinTime','$checkoutTime','$requests',
    '$source','$status')";
    
    if(mysqli_query($conn,$sql))
    {
      echo"<script>alert('Booking successfull!')</script>";
      echo "<script> location.replace('index.php?tab=view_reservations');</script>";
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


<div class="contentform">
  <div class="containerform">

  <h2 >Add New Booking</h2>
  <h5>for guest ID : <?php echo ' '.$id;?> </h2>
  <hr>
      <form id="fupForm" name="form1" method = "post">     
         <div class="row">
            <div class="col-25">
              <label for="RoomPref">Room preference</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
 
                <input type="hidden" id="id" name="guestID" value="<?php echo $id?>" /> 
                <input type="hidden" id="id" name="id" value="<?php echo $id?>" />
                

                <select  name="pref" class = "form-control" required>
		            <option value="" selected="selected" disabled="">Select Room preference</option>
			        	<?php
				          $sql2 = "SELECT room_id,room_name From Room";
				          $result=mysqli_query($conn,$sql2);
				          while($row=mysqli_fetch_array($result))
				          echo "<option value='" . $row['room_id'] . "'>". $row['room_name'] . "</option>";
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
                  <input type="number" id="noAdults" name="noAdults" min="0" placeholder="0">
              </div>

              <div class="form-group col-md-4">
                  <label for="children">No of Children</label>
                  <input type="number" id="noChildren" name="noChildren" min="0" placeholder="0">
              </div> 

              <div class="form-group col-md-4">
                  <label for="nights">No of Nights at the Hotel</label>
                  <input type="number" id="noNights" name="noNights" min="0"  placeholder="0"> 
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
                  <label for="checkoutTime">Checkout Time</label>
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
            <label for="source">Reservation by</label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-4">
                <label for="source">Source</label>
                <select id="source" name="source" class="form-control">
                <option value="" selected="selected" disabled="">Select Source type</option>
				        <option value="website">Website</option>
                <option value="walk-in">Walk-in</option>
                <option value="by-call">By call</option>
              </select>
            </div>
            </div>
          </div>
              
          <div class="row">
          <div class="col-25">
            <label for="">    </label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-10">
              <input name = "addNewBooking" type="submit" value = "Add New Booking" class = "btn btn-success" />
            </div> 
          </div>   
       </form>


       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>



</body>
</html>