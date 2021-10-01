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
  padding: 10px;
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
  <div class="heading">View Guest Log
  </div>
  
  <div class="search">
  <!-- search guests -->
  <form action="index.php?tab=search_guest" method="post">  
	<table>
		<tr>
		<td><div class="col-md-12">
		<div class = "form-group col-md-12 ">
    <input type="text" name="valueToSearch" placeholder="Search guests here..">			
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
    <?php 
                          $projects = array();
                          $res=mysqli_query($conn,"SELECT * FROM Guest");
                          while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC))
                          {
                              $projects[] = $userRow;
                          }
                          foreach ($projects as $userRow)
                          {
                        ?>
			
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
                        ?>


    </tbody>
  </table>
</div>

</body>
</html>