<?php
require_once('../../connection.php');

if(isset($_POST['editInfrastructure'])){
	$Rid = $_POST['infrastructure_id'];
	$select = mysqli_query($conn,"select * from infrastructure where id = '$Rid'");
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
	$i_id = $_POST['iid'];
	$des = $_POST['des'];
	$oldimage = $_POST['oldimage'];
	$newimage = $_FILES['newimage']['name'];
	
	if(($oldimage == $newimage)||($newimage == "")){
		echo "<script> alert('Same Image');</script>";
		
		$sql = "UPDATE infrastructure SET i_id='$i_id',description='$des',image='$oldimage' where id = '$id'";
	        
	      
			if(mysqli_query($conn,$sql))
			{
				echo "<script> alert('Record Update successfully');</script>";
				echo '<script> location.replace("index.php?tab=manageinfrastructure");</script>';
			}
			else
			{
				echo "<script> alert('Error : Could not save the data');</script>";
				echo '<script> location.replace("index.php?tab=manageinfrastructure");</script>';
			}
	
	}
	else if($oldimage !== $newimage){
		
		$sql1 = "SELECT * FROM infrastructure where '$id'";
	    
		$result = mysqli_query($conn,$sql1);
				  
			while($row = mysqli_fetch_array($result))
				{
					$deleteimage=$row["image"];
					echo '<script type="text/javascript">alert("'.$deleteimage.'");</script>';
						  
			    }
					  
			if(file_exists('dashboard/UploadInfrastructureImage/'.$deleteimage)){

			//delete the image
					unlink('dashboard/UploadInfrastructureImage/'.$deleteimage);
					echo "<script> alert('Old Image Deleted successfully');</script>";
					
			}else{
				
				echo "<script> alert('Error 404: Image Not Found');</script>";
			}
			
		$target_dir = __DIR__."/UploadInfrastructureImage/";
		$target = $target_dir.basename($_FILES['newimage']['name']);
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));
		
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
					if(move_uploaded_file($_FILES['newimage']['tmp_name'], $target)){
				
						
						$sql = "UPDATE infrastructure SET i_id='$i_id',description='$des',image='$newimage' where id = '$id'";
	
							if(mysqli_query($conn,$sql))
								{
									echo "<script> alert('Record & Image Update successfully');</script>";
									echo '<script> location.replace("index.php?tab=manageinfrastructure");</script>';
		
								}
							else
								{
									echo "<script> alert('Error : Could not Update the data');</script>";
									echo '<script> location.replace("index.php?tab=manageinfrastructure");</script>';
								}
					}else{
				
							echo "<script> alert('There was a problem Update image!!!');</script>";
							echo '<script> location.replace("index.php?tab=manageinfrastructure");</script>';
					}
				}else{
					
					echo "<script> alert('Not Permission to update image!!!');</script>";
					echo '<script> location.replace("index.php?tab=manageinfrastructure");</script>';
				}
			}else{
				
				echo "<script> alert('Check Your image and Try Again!!!');</script>";
				echo '<script> location.replace("index.php?tab=manageinfrastructure");</script>';
			}	

	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Infrastructure</title>
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


<br>

<div class="contentform">
  <div class="containerform">

  <h2 class="subtitle">Edit Infrastructure</h2>

  <hr>
      <form id="fupForm" name="form1"  method = "post" enctype="multipart/form-data">
          
		     DB_ID: 
			<input type="text" name="id" value="<?=$row['id'];?>" required readonly>
		    <br><br>
			
		    Infrastructure ID: 
			<input type="text" name="iid" value="<?=$row['i_id'];?>" required>
		    <br><br>
			
            Description: 
			<input type="text" name="des" value="<?=$row['description'];?>" required>
		    <br><br>
			
			Image:
			<img src = "dashboard/UploadInfrastructureImage/<?php echo $row['image']; ?>" style = " width:100px;height:100px">
			<input  hidden type="text" name="oldimage" value="<?=$row['image'];?>">
			<br><br>
			
			Select image to upload:
            <input type="file" name="newimage">
			
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