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
if (isset($_POST['edit'])) {
  
    $i = $_POST['id'];
    echo 'reservation id:'.$i;
    $up=mysqli_query($conn,"SELECT * FROM Booking WHERE booking_id=".$i) ;  
  
    $room=mysqli_query($conn,"SELECT room_name FROM Room,Booking
    WHERE Booking.room_id =Room.room_id and booking_id=".$i) ;

    $updateRow=mysqli_fetch_array($up,MYSQLI_ASSOC);
    $updateRoom=mysqli_fetch_array($room,MYSQLI_ASSOC);



  echo $updateRoom['room_name'];
  echo $updateRow['sourceType'];
	
}	 
?>

<?php
if (isset($_POST['confirm'])) {
  
    $i = $_POST['id'];
    echo "confirm".$i;

    $sql= "UPDATE Booking SET book_status='confirmed'          
            WHERE booking_id='$i'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script> alert('Booking confirmed');</script>";
        //$tab_2 = 'goto_view_reservation'; 
       echo "<script> location.replace('index.php?tab=view_reservations');</script>";
     
    }
    else
    {
        echo "<script> alert('Error : ');</script>";
    }
	
}	 
?>


<?php
if (isset($_POST['cancel'])) {
  
    $i = $_POST['id'];
    echo "cancel".$i;
    
    $sql= "UPDATE Booking SET book_status='cancelled'          
    WHERE booking_id='$i'";

    if(mysqli_query($conn,$sql))
    {
      echo "<script> alert('Booking cancelled');</script>";
      echo "<script> location.replace('index.php?tab=view_reservations');</script>";

    }
  else
    {
      echo "<script> alert('Error : ');</script>";
    }
	
}	 
?>

<?php
if (isset($_POST['delete'])) {
  
    $i = $_POST['id'];
    echo "cancel".$i;
    
    $sql= "DELETE FROM Booking WHERE booking_id='$i'";


    if(mysqli_query($conn,$sql))
    {
      echo "<script> alert('Booking Deleted');</script>";
      echo "<script> location.replace('index.php?tab=view_reservations');</script>";

    }
  else
    {
      echo "<script> alert('Error : ');</script>";
    }
	
}	 
?>

<?php
if(isset($_POST['update'])){ 
        $i = $_POST['id'];
       // echo "update".$i;
     
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

        // echo $prefRoom;
        // echo  $noAdults;
        // echo $noChildren;
        // echo $noNights;
        // echo $checkinDate;
        // echo '-------------';
        // echo $checkoutDate;
        // echo $checkinTime;
        // echo $checkoutTime;
        // echo $requests;
        // echo  $source;
        // echo '-------------';
        // echo $i;
   
		$sql= "UPDATE Booking SET
            room_id='(SELECT room_id FROM Room WHERE room_id='$prefRoom')',
            no_ofNights='$noNights',
            no_ofAdults=' $noAdults',
            no_ofChildren='$noChildren',
            checkin='$checkinDate',
            checkout='$checkoutDate',
            checkin_time='$checkinTime',
            checkout_time='$checkoutTime',
            requests='$requests',
            sourceType='$source'
            WHERE booking_id='$i'";

        if(mysqli_query($conn,$sql))
        {
            echo"<script>alert('Record updated successfully!')</script>";
            echo "<script> location.replace('index.php?tab=view_reservations');</script>";
            //header ("Location:dashboard/view_guest_log.php");
            
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

  <h2 class="subtitle">Edit Guest Booking</h2>

  <hr>
      <form id="fupForm" name="form1" method = "post">

      
         <div class="row">
            <div class="col-25">

            <input type="hidden" id="id" name="id" value="<?php echo $i?>" />
            <input type="hidden" id="booking_id" name="booking_id" value="<?php echo $updateRow['booking_id'];?>" />
              <label for="RoomPref">Room preference</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  
            
                <select  name="pref" class = "form-control" required>
		            <option value="" selected="selected" disabled=""><?php echo $updateRoom['room_name'];?></option>
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
                  <input type="number" id="noAdults" name="noAdults" min="0" value="<?php echo $updateRow['no_ofAdults'];?>" >
              </div>

              <div class="form-group col-md-4">
                  <label for="children">No of Children</label>
                  <input type="number" id="noChildren" name="noChildren" min="0" value="<?php echo $updateRow['no_ofChildren'];?>">
              </div> 

              <div class="form-group col-md-4">
                  <label for="nights">No of Nights at the Hotel</label>
                  <input type="number" id="noNights" name="noNights" min="0" value="<?php echo $updateRow['no_ofNights'];?>">
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
                  <input type="date" id="checkinDate" name="checkinDate" value="<?php echo date($updateRow['checkin']);?>">
              </div>

              <div class="form-group col-md-4">
                  <label for="checkinTime">Checkin Time</label>
                  <input type="time" class="form-control" value="<?php $date = date("H:i", strtotime($row['time_d'])); echo $updateRow['checkin_time']; ?>" id="checkinTime" name="checkinTime"  />
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
                  <input type="date" id="checkoutDate" name="checkoutDate" value="<?php echo date($updateRow['checkout']);?>">
              </div>

              <div class="form-group col-md-4">
                  <label for="checkoutTime">Checkout Time</label>
                  <input type="time" class="form-control" value="<?php $date = date("H:i", strtotime($row['time_d'])); echo $updateRow['checkout_time']; ?>" id="checkoutTime" name="checkoutTime"  />
                 
              </div> 
            </div>
          </div>

        
          <div class="row">
            <div class="col-25">
            <label for="request">Special Requests</label>
            </div>
            <div class="col-75">
                <textarea id="requests" name="requests" placeholder="<?php echo $updateRow['requests'];?>" style="height:70px"></textarea> 
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            <label for="source">Reservation by</label>
            </div>
            
            <div class="form-group col-md-4">
                <label for="source">Source</label>
                <select id="source" name="source" class="form-control">
                <option value="<?php echo $updateRow['sourceType'];?>" selected="selected"><?php echo $updateRow['sourceType'];?></option>
				        <option value="website">Website</option>
                <option value="walk-in">Walk-in</option>
                <option value="by-call">By call</option>
                </select>
            </div>
          </div>
    
          <br>

          <div class="row">
            <div class="form-group col-md-10">
              <input name = "update" type="submit" value = "Update Reservation" class = "btn btn-success" />
            </div> 
          </div>

         
       </form>


       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>



</body>
</html>
