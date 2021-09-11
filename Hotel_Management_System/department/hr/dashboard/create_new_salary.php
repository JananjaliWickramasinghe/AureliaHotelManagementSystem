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


if (isset($_POST['submit'])){
	
	
	$eid = $_POST['eid'];
	$basicsalary = $_POST['basicsalary'];
	$othrs = $_POST['othrs'];
	$otrate = $_POST['otrate'];
	$numofworkday = $_POST['numofworkday'];
	$numofhalfday = $_POST['numofhalfday'];
	$numofleaveday = $_POST['numofleaveday'];
	$date = $_POST['date'];
	
	if(($numofhalfday < 3)&&($numofleaveday <6 )){
		$totsal = $basicsalary + ($othrs*$otrate) + 2000;
		echo '<script type="text/javascript">alert("'.$totsal.'");</script>';
	}else{
		$totsal = $basicsalary + ($othrs*$otrate);	
		echo '<script type="text/javascript">alert("'.$totsal.'");</script>';
	}
	
	
	
				$sql = "INSERT INTO salary(e_id,basicsalary,othrs,otrate,numOfworkDays,numOfHalfDays,numOfLeaveDays,date,totsalary) VALUES('$eid',$basicsalary,$othrs,$otrate,$numofworkday,$numofhalfday,$numofleaveday,'$date',$totsal)";
	
				if(mysqli_query($conn,$sql))
					{
						echo "<script> alert('Record Upload successfully');</script>";
		
					}
				else
					{
						echo "<script> alert('Error : Could not save the data');</script>";
						
					}
			
		
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Create new Salary</title>
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

<div class="topnav">
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#">Link</a>
</div>
<br>

<div class="contentform">
  <div class="containerform">

  <h2 class="subtitle">Create new Salary</h2>

  <hr>
  
      <form id="fupForm" name="form1"  method = "post" enctype="multipart/form-data">
          
		    Employee ID: 
			<input type="text" name="eid" required>
		    <br><br>
			Basic Salary:<br> 
			<input type="number" name="basicsalary" required>
		    <br><br>
			OT Hours: <br>
			<input type="number" name="othrs" required>
		    <br><br>
			OT Rate: <br>
			<input type="number" name="otrate" required>
		    <br><br>
			Number of Working Days: 
			<input type="number" name="numofworkday" required>
		    <br><br>
			
            Number of Half Days: 
			<input type="number" name="numofhalfday" required>
		    <br><br>
			
			Number of Leave Days: 
			<input type="number" name="numofleaveday" required>
		    <br><br>
			
			Date: 
			<input type="date" name="date" required>
		    <br><br>
			
            <div class="row">
            <input name="submit" type="submit" value="Submit"  id="butsave">
            </div>
       </form>
  
       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>
</body>
</html>