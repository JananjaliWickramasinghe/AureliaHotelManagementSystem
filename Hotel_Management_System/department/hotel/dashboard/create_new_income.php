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
	
	
	
	$date = $_POST['date'];
	$section = $_POST['section'];
	$amount = $_POST['amount'];
	
	
				$sql = "INSERT INTO income(date,section,amount) VALUES('$date','$section','$amount')";
	
				if(mysqli_query($conn,$sql))
					{
						echo "<script> alert('Record Add successfully');</script>";
						
		
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
<title>Create new Income</title>
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

  <h2 class="subtitle">Create new Income</h2>

  <hr>
  
      <form id="fupForm" name="form1"  method = "post">
          
		    
			Date: 
			<input type="date" cols="40" rows="5" name="date" required>
		    <br><br>
		    Section:<br>
			<select  name = "section" required>
				<option>choose..</option>
				<option>Resturent</option>
				<option>Reservation</option>
			</select>
			<br><br>
            Amount: 
			<input type="number" name="amount" required>
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