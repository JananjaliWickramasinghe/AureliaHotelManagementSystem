<?php
require_once('../../connection.php');

if(isset($_POST['editIncome'])){
	$iid = $_POST['income_id'];
	$select = mysqli_query($conn,"select * from income where id = '$iid'");
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


if (isset($_POST['submit'])){
	
	$id = $_POST['id'];
	$date = $_POST['date'];
	$section = $_POST['section'];
	$amount = $_POST['amount'];
	
	
		
		$sql = "UPDATE income SET date='$date',section='$section',amount='$amount' where id = '$id'";
	        
	      
			if(mysqli_query($conn,$sql))
			{
				echo "<script> alert('Record Update successfully');</script>";
				echo '<script> location.replace("index.php?tab=manageincome");</script>';
			}
			else
			{
				echo "<script> alert('Error : Could not save the data');</script>";
				echo '<script> location.replace("index.php?tab=manageincome");</script>';
			}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Income</title>
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

  <h2 class="subtitle">Edit Income</h2>

  <hr>
      <form id="fupForm" name="form1"  method = "post" >
          
		    ID: 
			<input type="text" name="id" value="<?=$row['id'];?>" required readonly>
		    <br><br>
			
			
            date: 
			<input type="date" name="date" value="<?=$row['date'];?>" required>
		    <br><br>
			
			Section:<br>
			<select  name = "section" value="<?=$row['section'];?>" required>
				<option value="<?=$row['section'];?>"><?=$row['section'];?></option>
				<option>Resturent</option>
				<option>Reservation</option>
			</select>
			<br><br>
            Amount: 
			<input type="number"  name="amount" value="<?=$row['amount'];?>" required>
		    <br><br>
			
            <div class="row">
            <input name="submit" type="submit" value="Update"  id="butsave">
            </div>
       </form>

       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>
</body>
</html>