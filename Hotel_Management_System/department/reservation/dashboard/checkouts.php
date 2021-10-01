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
if (isset($_POST['checkedOut'])) {
  
    $i = $_POST['id'];
    //echo "checked In".$i;
	$sql= "UPDATE Booking SET checkedOut ='Checked Out' WHERE booking_id='$i'";
    //echo "<script> location.replace('index.php?tab=get_checkin_report');</script>";
	
	if(mysqli_query($conn,$sql))
    {
		echo "<script> alert('Guest Checked Out successfully');</script>";
    }
	else
    {
      echo "<script> alert('Error : ');</script>";
    }
    	
}	 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>

body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-repeat: no-repeat;
    padding: 0 !important
}

.container {
    padding-top: 20px;
    padding-bottom: 340px;
	height: 70%

}

.datePick{
	padding-top: 20px;
    padding-bottom: 340px;
	padding-left: 50px;
	padding-right: 50px;
	height: 70%;
	background-color: #C5CAE9
}

th {
  background-color:#3b3f69;
  color: white;
}	

tr:hover {background-color: white;}

table{
	width;80%;
}

.heading {
  padding: 5px;
  text-align: left;
  color: black;
  font-size: 25px;
  font-weight: bold;
}

.search{
	padding:10px;
  text-align: left;
  color: black;
}
</style>
</head>
<body>

<div class="container">

  <h2><?php
// Return date/time info of a timestamp; then format the output
	$mydate=getdate(date("U"));
	echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	echo"<br>";
	
?></h2>

	<div class="heading">Check-outs
	</div>
	<?php
	
	//$current_date = date('Y-m-d');
	$current_datetime = '2021-08-05';
	//echo "Today is : ".$current_date;
	?>
	
	<div class="search">
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

	</div>
  
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
      <th>Guest Name</th>
      <th>Room type</th>
      <th>Checkout time</th>
	  <th>Checkout State</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
                          $projects = array();
                          $res=mysqli_query($conn,"SELECT * FROM Booking,Room,Guest
                          WHERE Booking.guest_id=Guest.guest_id AND Booking.room_id=Room.room_id AND checkout='2021-08-09'");
                          while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC))
                          {
                              $projects[] = $userRow;
                          }
                          foreach ($projects as $userRow)
                          {
							  /*$send_date = date("Y-m-d", strtotime($userRow['checkin'])); 
								if(strtotime($current_datetime) == strtotime($send_date)){
									$dateResult = "dates are same";
								}else{
									$dateResult = "dates are not same";
								}*/
                        ?>
			                
                        <tr>
                        <form method="post">
                          <?php $id=$userRow['booking_id'];?>
                          <td><?php echo $userRow['booking_id']; ?></th>
                          <td><?php echo $userRow['first_name']." ".$userRow['last_name']; ?></td>
                          <td><?php echo $userRow['room_name']; ?></td>
                          <td><?php echo $userRow['checkout_time']; ?></td>
						  <td><?php echo $userRow['checkedOut']; ?></td>
                          <input type="hidden" name="id" value="<?php echo $userRow['booking_id']; ?>"/>
							<td>
							<button name="checkedOut" class="btn btn-success btn-lg"><i class="fa fa-check"></i></button>						
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