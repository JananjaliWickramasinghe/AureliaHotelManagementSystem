<?php
	include("../../../connection.php");
        $id=$_GET['id'];

	    $sql2 = "DELETE FROM Guest WHERE guest_id = '$id'";

            if(mysqli_query($conn,$sql2))
            {
                echo "<script> alert('Record Deleted successfully');</script>";
               // header("Location:../view_guest_log.php");
               header("Location:../index.php");
            }
            else
            {
                echo "<script> alert('Error : Could not delete the data');</script>";
            }
	
?>


