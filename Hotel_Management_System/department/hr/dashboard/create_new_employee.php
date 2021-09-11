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
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$role = $_POST['role'];
	$basicsalary = $_POST['basicsalary'];
	$workhrs = $_POST['workhrs'];
	
	
		
				$sql = "INSERT INTO employeem(e_id,fname,lname,address,phone,role,basicsalary,workhrs) VALUES('$eid','$fname','$lname','$address','$phone','$role','$basicsalary','$workhrs')";
	
				if(mysqli_query($conn,$sql))
					{
						echo "<script> alert('Record  Upload successfully');</script>";
		
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
<title>Create new Employee</title>
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

  <h2 class="subtitle">Create new Employee</h2>

  <hr>
  
      <form id="fupForm" name="form1"  method = "post" enctype="multipart/form-data">
          
		    Employee ID: 
			<input type="text" name="eid" required>
		    <br><br>
			First Name: 
			<input type="text" name="fname" required>
		    <br><br>
			Last Name: 
			<input type="text" name="lname" required>
		    <br><br>
			Address: 
			<input type="text" name="address" required>
		    <br><br>
			Phone: 
			<input type="text" name="phone" required>
		    <br><br>
		    Role:<br>
			<select  name = "role" required>
				<option id="" value="">select....</option>
				<option>Cashier</option>
				<option>Waiter</option>
				<option>Chef</option>
				<option>Cleaner</option>
			</select>
			<br><br>
            Basic Salary: 
			<input type="text" name="basicsalary" required></textarea>
		    <br><br>
			
			 Working Hours: 
			<input type="text" name="workhrs" required></textarea>
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