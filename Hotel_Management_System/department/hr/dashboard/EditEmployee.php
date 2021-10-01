<?php
require_once('../../connection.php');

if(isset($_POST['editEmployee'])){
	$Rid = $_POST['employee_id'];
	$select = mysqli_query($conn,"select * from employeem where id = '$Rid'");
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
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$role = $_POST['role'];
	$basicsalary = $_POST['basicsalary'];
	$workhrs = $_POST['workhrs'];
	
	$num_length = strlen((String)$phone);
	
	if($num_length == 10)
	{
		if($workhrs<300)
		{
	
	$sql = "UPDATE employeem SET e_id='$eid',fname='$fname',lname='$lname',address='$address',phone='$phone',role='$role',basicsalary=$basicsalary,
	        workhrs='$workhrs' where id = $id";
	        
	        
	
	if(mysqli_query($conn,$sql))
	{
		echo "<script> alert('Record Update successfully');</script>";
		echo '<script> location.replace("index.php?tab=manageemployee");</script>';
		//header ("Location:./index.php?tab=manageemployee");
	}
	else
	{
		echo "<script> alert('Error : Could not save the data');</script>";
		echo '<script> location.replace("index.php?tab=manageemployee");</script>';
	}
		}
		else{
			echo "<script> alert('Working hours must be less than 300H..');</script>";
			echo '<script> location.replace("index.php?tab=manageemployee");</script>';
		}
		
	}
	else{
		echo "<script> alert('Invalid phone number');</script>";
		echo '<script> location.replace("index.php?tab=manageemployee");</script>';
	}
	
	//mysqli_close($conn);
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

select {
        width: 100%;
		height:40px;
        margin: 8px;
    }
    select:focus {
        min-width: 100%;
		height:40px;
        width: auto;
    }
</style>
</head>
<body>


<br>

<div class="contentform">
  <div class="containerform">

  <h2 class="subtitle">Edit Employee Details</h2>

  <hr>
  
      <form id="fupForm" name="form1"  method = "post" enctype="multipart/form-data">
          
		    DB_Employee ID: 
			<input type="text" name="id" value="<?=$row['id'];?>" required>
		    <br><br>
		    Employee ID: 
			<input type="text" name="eid" value="<?=$row['e_id'];?>" required>
		    <br><br>
			First Name: 
			<input type="text" name="fname" value="<?=$row['fname'];?>" required>
		    <br><br>
			Last Name: 
			<input type="text" name="lname" value="<?=$row['lname'];?>" required>
		    <br><br>
			Address: 
			<input type="text" name="address" value="<?=$row['address'];?>" required>
		    <br><br>
			Phone: 
			<input type="text" name="phone" value="<?=$row['phone'];?>" required>
		    <br><br>
		    Role:
			<select  name = "role" required>
				<option id="" value=""><?=$row['role'];?></option>
				<option>Cashier</option>
				<option>Waiter</option>
				<option>Chef</option>
				<option>Cleaner</option>
			</select>
			<br><br>
            Basic Salary: 
			<input type="text" name="basicsalary" value="<?=$row['basicsalary'];?>" required></textarea>
		    <br><br>
			
			 Working Hours: 
			<input type="text" name="workhrs" value="<?=$row['workhrs'];?>" required></textarea>
		    <br><br>
			
            <div class="row">
            <input name="update" type="submit" value="Update"  id="butsave">
            </div>
       </form>
  
       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>
</body>
</html>