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
	
	$target_dir = __DIR__."/UploadRoomImage/";
	$target = $target_dir.basename($_FILES['image']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));

	$image = $_FILES['image']['name'];
	$id = $_POST['rid'];
	$acNac = $_POST['rac'];
	$des = $_POST['des'];
	
	
	if (file_exists($target)) {
           echo "<script> alert('Sorry, file already exists.');</script>";
           $uploadOk = 0;
    }
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
           echo "<script> alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
           $uploadOk = 0;
    }
	
	if($uploadOk == 1){
		if(is_writable(dirname($target))){
			if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
				
				$sql = "INSERT INTO rooms(r_id,ac_nac,description,image) VALUES('$id','$acNac','$des','$image')";
	
				if(mysqli_query($conn,$sql))
					{
						echo "<script> alert('Record & Image Upload successfully');</script>";
						
		
					}
				else
					{
						echo "<script> alert('Error : Could not save the data');</script>";
					}
			}else{
		
					echo "<script> alert('There was a problem uploading image!!!');</script>";
			}
		}else{
			
			echo "<script> alert('Not Permission to uploading image!!!');</script>";
		}
	}else{
		
		echo "<script> alert('Check Your File and Try Again!!!');</script>";
	}	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Create new Room</title>
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

  <h2 class="subtitle">Create new Room</h2>

  <hr>
  
      <form id="fupForm" name="form1"  method = "post" enctype="multipart/form-data">
          
		    Room ID: 
			<input type="text" name="rid" required>
		    <br><br>
		    Room (AC/NAC):<br>
			<select  name = "rac"  required>
				<option>select...</option>
				<option>Ac</option>
				<option>NAc</option>
			</select>
			<br><br>
            Description: 
			<textarea type="text" cols="40" rows="5" name="des" required></textarea>
		    <br><br>
			
			Select image to upload:
            <input type="file" name="image" id ="image" required>
			
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