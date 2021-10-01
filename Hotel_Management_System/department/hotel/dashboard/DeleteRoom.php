<?php
    require_once('../../../connection.php');
	
    $id=$_GET['id'];
	$image = "";
	$sql1 = "SELECT * FROM rooms where '$id'";
				  $result = mysqli_query($conn,$sql1);
				  
					  while($row = mysqli_fetch_array($result))
					  {
						  $image=$row["image"];
						  echo '<script type="text/javascript">alert("'.$image.'");</script>';
						  
					  }
					  
	
	if(file_exists(__DIR__.'/UploadRoomImage/'.$image)){

    //delete the image
			unlink(__DIR__.'/UploadRoomImage/'.$image);
            $sql2 = "DELETE FROM rooms WHERE id = '$id'";
			//after deleting image you can delete the record
			if(mysqli_query($conn,$sql2))
			{
				echo "<script> alert('Record Deleted successfully');</script>";
				header("Location:../index.php?tab=manageinfrastructure");
			}
			else
			{
				echo "<script> alert('Error : Could not delete the data');</script>";
			}
    }else{
		echo "<script> alert('Error 404: Image Not Found');</script>";
	}

?>