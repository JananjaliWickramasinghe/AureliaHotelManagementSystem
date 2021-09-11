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


  <h2>Booking Calendar</h2>
  

  <table>
		<tr>
		<td>
      <div class="col-md-12">
		      <div class = "form-group col-md-12 ">
              <input type="date" id="checkoutDate" name="checkoutDate" value="<?php echo date('Y-m-d');?>">
          </div>
		  </div>
    </td>

		</tr>

    <tr>
		<td>
      <div class="col-md-12">
		      <div class = "form-group col-md-12 ">
          <div class="flex-row d-flex justify-content-center">
              <button class="buttonCalendar">Check Available Rooms</button>	
              </div>
          </div>
		  </div>
    </td>

		
		</tr>
		</table>





</body>
</html>