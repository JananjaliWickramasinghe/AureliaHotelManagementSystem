<?php
	include("../../../connection.php");
        $id=$_GET['id'];
        $confirm ='confirmed';

	    $sql2 = "UPDATE Booking SET book_status='$confirm'' WHERE booking_id = '$id'";

            if(mysqli_query($conn,$sql2))
            {
                echo "<script> alert('booking confirmed');</script>";
            
               header("Location:../index.php");
            }
            else
            {
                echo "<script> alert('Error : Could not confirm');</script>";
            }
	
?>

