<?php
    require_once('../../../connection.php');
	
    $id=$_GET['id'];
	
            $sql2 = "DELETE FROM expenses WHERE id = '$id'";
			
			if(mysqli_query($conn,$sql2))
			{
				echo "<script> alert('Record Deleted successfully');</script>";
				header("Location:../index.php?tab=manageexpenses");
			}
			else
			{
				echo "<script> alert('Error : Could not delete the data');</script>";
				header("Location:../index.php?tab=manageexpenses");
			}
    
?>