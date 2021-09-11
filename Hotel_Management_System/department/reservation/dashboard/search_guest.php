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
                          
	$res=mysqli_query($conn,"SELECT * FROM `Guest` WHERE CONCAT(`guest_id`, `first_name`, `last_name`, `country`,`email`,`phone`) LIKE '%".$valueToSearch."%'");
	while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC)){
                          {
                              $projects[] = $userRow;
                          }
                          foreach ($projects as $userRow)
                          { 
                             
							//echo $userRow['guest_id'];
							//echo $userRow['first_name'];
                            ?>
                            <table class="table table-bordered">
    <thead>
      <tr>
        <th>Guest ID</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Address line 1</th>
      <th>Address line 2</th>
	  <th>City</th>
	  <th>State</th>
      <th>Country</th>
	  <th>Zip code</th>
      <th>phone</th>
      <th>email</th>
      <th>Action</th>
      <th>New Booking</th>
      </tr>
    </thead>
    <tbody>
                            <tr>
                        
                        <form method="post" action="index.php?tab=edit_guest_details">
          
                                    <td><?php echo $userRow['guest_id']; ?></th>
                                    <td><?php echo $userRow['first_name']; ?></td>
                                    <td><?php echo $userRow['last_name']; ?></td>
                                    <td><?php echo $userRow['address_line_1']; ?></td>
                                    <td><?php echo $userRow['address_line_2']; ?></td>
                                    <td><?php echo $userRow['city']; ?></td>
                                    <td><?php echo $userRow['state']; ?></td>
                                  <td><?php echo $userRow['country']; ?></td>
                                    <td><?php echo $userRow['zipcode']; ?></td>
                                    <td><?php echo $userRow['phone']; ?></td>
                                    <td><?php echo $userRow['email']; ?></td>
                                    <td>
          
                                              <input type="hidden" name="guest_id" value="<?php echo $userRow['guest_id']; ?>"/>
                                              <input type="submit" class="btn btn-success" name="edit" value="Edit"/>
                                              <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                          </form>
                                    </td>
          
                        <td>
                        <form method="post" action="index.php?tab=guest_reservation"> 
                                      <input type="hidden" name="guest" value="<?php echo $userRow['guest_id']; ?>"/>
                                      <input type="submit" class="btn btn-primary" name="newBooking" value="New Booking"/>
                        </form>
                        </td>
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