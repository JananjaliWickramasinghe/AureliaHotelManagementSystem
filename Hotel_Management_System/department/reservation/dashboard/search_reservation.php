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
  <h2>Search Result</h2>
 

  <?php
if (isset($_POST['search'])) {

	$valueToSearch = $_POST['valueToSearch'];  
	$projects = array();
                          
	$res=mysqli_query($conn,"SELECT * FROM Booking,Room,Guest
                WHERE Booking.guest_id=Guest.guest_id AND
                Booking.room_id=Room.room_id AND 
                booking_id LIKE '%".$valueToSearch."%'");

	while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC)){
                          {
                              $projects[] = $userRow;
                          }
                          foreach ($projects as $userRow)
                          { 
 
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
                            <input type="submit" class="btn btn-dark" name="delete" value="Delete"/>
                        </td>
                        </form>
            </tr>

                            
                          <?php
						            }
	}
}
?>

</tbody>
  </table>


 
</div>

</body>
</html>