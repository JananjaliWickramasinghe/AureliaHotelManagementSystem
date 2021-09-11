<?php
require_once('../../connection.php');

if(isset($_POST['editsalary'])){
	$Rid = $_POST['salary_id'];
	$select = mysqli_query($conn,"select * from salary where id = '$Rid'");
	$row = mysqli_fetch_assoc($select);
}



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


if (isset($_POST['update'])){
	
	$id = $_POST['id'];
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
	
	$sql = "UPDATE salary SET e_id='$eid',basicsalary = $basicsalary,othrs=$othrs,otrate=$otrate,numOfworkDays=$numofworkday,numOfHalfDays=$numofhalfday,numOfLeaveDays=$numofleaveday,
	        date='$date',totsalary=$totsal where id = $id";
	        
	        
	
	if(mysqli_query($conn,$sql))
	{
		echo "<script> alert('Record Update successfully');</script>";
	}	
	else
	{
		echo "<script> alert('Error : Could not save the data');</script>";
		
	}
	
	
	header("location:../6index.php?tab=managesalary");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Employee Details</title>
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

  <h2 class="subtitle">Edit Employee Details</h2>

  <hr>
  
      <form id="fupForm" name="form1"  method = "post" enctype="multipart/form-data">
          
		    DB Salary ID: 
			<input type="text" name="id" value="<?=$row['id'];?>" required readonly>
		    <br><br>
		    Employee ID: 
			<input type="text" name="eid" value="<?=$row['e_id'];?>" required>
		    <br><br>
			Basic Salary:<br> 
			<input type="number_format" name="basicsalary" value="<?=$row['basicsalary'];?>" required>
		    <br><br>
			OT Hours: <br>
			<input type="number_format" name="othrs" value="<?=$row['othrs'];?>" required>
		    <br><br>
			OT Rate: <br>
			<input type="number_format" name="otrate" value="<?=$row['otrate'];?>" required>
		    <br><br>
			Number of Working Days: 
			<input type="text" name="numofworkday" value="<?=$row['numOfworkDays'];?>" required>
		    <br><br>
			
            Number of Half Days: 
			<input type="text" name="numofhalfday" value="<?=$row['numOfHalfDays'];?>" required>
		    <br><br>
			
			Number of Leave Days: 
			<input type="text" name="numofleaveday" value="<?=$row['numOfLeaveDays'];?>" required>
		    <br><br>
			
			Date: 
			<input type="date" name="date" value="<?=$row['date'];?>" required>
		    <br><br>
			
            <div class="row">
            <input name="update" type="submit" value="Update" >
            </div>
       </form>
  
       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>
</body>
</html>