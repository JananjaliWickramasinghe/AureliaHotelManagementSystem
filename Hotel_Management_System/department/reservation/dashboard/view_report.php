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
	padding-right: 50px;
	height: 70%;
	background-color:white;
}

th {
  background-color:#3b3f69;
  color: white;
}	

tr:hover {background-color: #bcc7e3;}

table{
	width:120px;
}

.heading {
  padding: 20px;
  text-align: center;
  background: white;
  color: black;
  font-size: 15px;
  font-weight: bold;
}

.tab-sub-heading{
	text-align:left;
	color: #231961;
	font-size: 15px;  
}
</style>


</head>
<body>

<div class="container">
<div class="datePick">
  
  
 
			<?php
			if (isset($_POST['report'])) {	
			
			$month = $_POST['month'];
			$source = $_POST['source'];
			
			if($source=='bySource'){
			?>
			<div class="heading">Reservation By Source Report -
			<?php			
				$month_num = $month;
				echo date("F", mktime(0, 0, 0, $month_num, 10));
			?>
			 </div>
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Source</th>
					<th>Total bookings</th>
				</tr>
			</thead>
			<tbody>
			
			<?php 
                $projects = array();
                $res=mysqli_query($conn,"SELECT count(booking_id),sourceType
				FROM Booking
				WHERE
				EXTRACT(Month FROM checkin)='$month'
				group by (sourceType);");
			
                while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC))
                {
                    $projects[] = $userRow;
                }
                foreach ($projects as $userRow)
                {
            ?>
			<tr>
                        
              <form method="post">
            
                          <td><?php echo $userRow['sourceType']; ?></th>
                          <td><?php echo $userRow['count(booking_id)']; ?></td>
                          
              </form>
						 
       
            <?php
			//for each closes
               }
             ?>
			
			</tr>
			</tbody>
			</table>
			
			<?php
			}else{
				
			?>
			
			<div class="heading">Monthly Reservation Report -
			<?php			
				$month_num = $month;
				echo date("F", mktime(0, 0, 0, $month_num, 10));
			?>
			 </div>
			 
			 <p class="tab-sub-heading">
			 <?php
								$count =0;
								$sql = "SELECT booking_id From Booking";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo "Total Reservation Count: ".$count;
						?>
			</p> 
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>type</th>
					<th>Total Reservations</th>
				</tr>
			</thead>
			<tbody>
			
			<?php 
                $projects = array();
                $res=mysqli_query($conn,"SELECT count(booking_id),book_status
				FROM Booking
				WHERE
				EXTRACT(Month FROM checkin)='$month'
				group by (book_status);");
			
                while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC))
                {
                    $projects[] = $userRow;
                }
                foreach ($projects as $userRow)
                {
            ?>
			
			<tr>
                        
              <form method="post">
            
                          <td><?php echo $userRow['book_status']; ?></th>
                          <td><?php echo $userRow['count(booking_id)']; ?></td>
                          
              </form>
			  
			   <?php
			//for each closes
               }
             ?>
			
			</tr>
			</tbody>
			</table>
			<?php	
				
			}
			
			}
			
			?>
			


			</tbody>
		</table>
</div>
</div>

</body>
</html>