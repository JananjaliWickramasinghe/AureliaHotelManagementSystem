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


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
  <h2>View Bookings</h2>
  
  <!-- search reservations -->
  <form action="index.php?tab=search_reservation" method="post">  
	<table>
		<tr>
		<td><div class="col-md-12">
		<div class = "form-group col-md-12 ">
    <input type="text" name="valueToSearch" placeholder="Search bookings here..">			
        </div>
		</div></td>
		<td><div class="col-md-12">
		<div class = "form-group col-md-12 ">
      <button class="btn btn-dark" name="search"><i class="fa fa-search"></i> Search</button>
		</div>		 
		</div></td>
		</tr>
		</table>
	</form> 

<?php
if (isset($_POST['term'])) {

	$term = $_POST['term'];  
	$projects = array();
                          
	$res=mysqli_query($conn," SELECT * FROM Booking,Room,Guest
    WHERE Booking.guest_id=Guest.guest_id AND Booking.room_id=Room.room_id AND first_name LIKE '%".$term."%'");
	while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC)){
                          {
                              $projects[] = $userRow;
                          }
                          foreach ($projects as $userRow)
                          { 
                        		
                            echo $userRow['booking_id'];
                            echo $userRow['first_name'];
                            echo $userRow['last_name'];
                            echo $userRow['room_name'];
                            echo $userRow['checkin']; 
                            echo $userRow['checkout'];
                            echo $userRow['book_status'];
                                                   
						              }
	}
}
?>

  <table class="table table-bordered">
    <thead>
      <tr>
      <th>Booking ID</th>
      <th>Guest first name</th>
      <th>Guest last name</th>
      <th>Room type</th>
      <th>Checkin</th>
	  <th>Checkout</th>
	  <th>Status</th>
      <th>Action</th>
	  <th>Edit</th>
      </tr>
    </thead>
    <tbody>
    <?php 
                          $projects = array();
                          $res=mysqli_query($conn,"SELECT * FROM Booking,Room,Guest
                          WHERE Booking.guest_id=Guest.guest_id AND Booking.room_id=Room.room_id");
                          while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC))
                          {
                              $projects[] = $userRow;
                          }
                          foreach ($projects as $userRow)
                          {
                        ?>
			                
                        <tr>
                        <form method="post" action="index.php?tab=edit_reservation">
                          <?php $id=$userRow['booking_id'];?>
                          <td><?php echo $userRow['booking_id']; ?></th>
                          <td><?php echo $userRow['first_name']; ?></td>
                          <td><?php echo $userRow['last_name']; ?></td>
                          <td><?php echo $userRow['room_name']; ?></td>
                          <td><?php echo $userRow['checkin']; ?></td>
                          <td><?php echo $userRow['checkout']; ?></td>
                          <td><?php echo $userRow['book_status']; ?></td>
                          <input type="hidden" name="id" value="<?php echo $userRow['booking_id']; ?>"/>
                        <td>	 
							               <input type="submit" class="btn btn-primary" name="confirm" value="Confirm"/>
                             <input type="submit" class="btn btn-danger" name="cancel" value="Cancel"/>
                        </td>

                        <td>
							              <input type="submit" class="btn btn-success" name="edit" value="Edit"/>
                            <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                        </td>
                        </form>
                        </tr>
					
                          <?php
                          }
                        ?>


    </tbody>
  </table>
</div>

</body>
</html>