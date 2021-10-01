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
<title>Booking Calendar</title>
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
	height: 70%;
	background-color: #C5CAE9
}
	
}

</style>
</head>
<body>
	<div class="container">
		<div class="datePick">
			<h2>Available rooms</h2>
			
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Room_id</th>
					<th>Room_type</th>
					<th>checkin</th>
					<th>checkout</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
			if (isset($_POST['checkRooms'])) {	
			?>
			
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
                          
                          <td>
							<input type="hidden" name="guest_id" value="<?php echo $userRow['guest_id']; ?>"/>
							<input type="submit" class="btn btn-success" name="edit" value="Edit"/>
                     
              </form>
						 
            </tr>
			
			
            <?php
			//for each closes
               }
             ?>
			
			<?php
			//if closes	here		
			}
            ?>


			</tbody>
		</table>
		
		
		</div>	
	</div>	
</body>
</html>