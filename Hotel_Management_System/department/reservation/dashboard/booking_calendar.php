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
	height: 50%

}

.datePick{
	padding-top: 20px;
    padding-bottom: 340px;
	padding-left: 50px;
	height:350px;
	background: linear-gradient(45deg, #49a09d, #5f2c82)
}
	
.heading {
  padding: 20px;
  text-align: left;
  background: white;
  color: black;
  font-size: 20px;
  font-weight: bold;
}

table{
	margin-top:50px;
	margin-left:100px;
	width:80%;
}
</style>
</head>
<body>
	<div class="container">
		<div class="heading">Booking Calendar</div>
			<div class="datePick">
				<form method="post" action="index.php?tab=get_available_rooms">
					<table>
						<tr>
							<td>
								<div class="form-group col-md-4">
									<label for="cin">Checkin Date</label>
									<input type="date" id="checkin" name="checkin" value="<?php echo date('Y-m-d');?>">
								</div>

								<div class="form-group col-md-4">
									<label for="cout">Checkout Date</label>
									<input type="date" id="checkout" name="checkout" value="<?php echo date('Y-m-d');?>">
								</div>  
							</td>
						</tr>
						<tr>
							<td>
								<div class="col-md-12">
									<div class = "form-group col-md-6 ">
										<div class="flex-row d-flex justify-content-center">
										<button class="buttonCalendar" name="checkRooms">Check Available Rooms</button>	
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>	
		</div>	
</body>
</html>