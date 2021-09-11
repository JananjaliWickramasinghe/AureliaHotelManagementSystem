<?php

	include("../../../connection.php");
        $id=$_GET['id'];
        
	    $sql2 = "UPDATE Booking SET book_status='Cancelled' WHERE booking_id = '$id'";

            if(mysqli_query($conn,$sql2))
            {
                echo "<script> alert('booking cancelled');</script>";
               // header("Location:../view_guest_log.php");
               header("Location:../index.php");
            }
            else
            {
                echo "<script> alert('Error : Could not cancel');</script>";
            }
	
?>