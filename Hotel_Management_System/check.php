<?php
include('../../connection.php');
session_start();

if(!isset($_SESSION['username'])){
	header('Location: ../../index.php');
	$user_check=NULL;

}else{
$user_check=$_SESSION['username'];


}



$ses_sql = mysqli_query($db,"SELECT username,firstname,lastname,department,Adminaccess,password FROM users WHERE username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['username'];
$login_name=$row['firstname'];
$login_lastname=$row['lastname'];
$adminaccess=$row['Adminaccess'];//admin access 
$bid=$row['Adminaccess'];
$thisuserpass=$row['password'];



//session variables
//$_SESSION['profileimg']=$row['profile'];



if(!isset($user_check))
{
    $sql = "SELECT department, firstname, lastname FROM users WHERE username='$username'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					
					$_SESSION['username'] = $username; // Initializing Session
					$_SESSION['department'] = $row["department"];//Department

					if ($row["department"] == "hotel") {
						header("location: department/hotel/index.php"); // Redirecting To user's page
					} else if ($row["department"] == "hr") {
						header("location: department/hr/index.php"); // Redirecting To user's page
					}else if ($row["department"] == "reservation") {
						header("location: department/reservation/index.php"); // Redirecting To user's page
					}else if ($row["department"] == "restaurant") {
						header("location: department/restaurant/index.php"); // Redirecting To user's page
					}else if ($row["department"] == "admin") {
						header("location: department/admin/index.php"); // Redirecting To user's page
					}else{
						header("location: 404.php"); // 404 page
					}

				}
				} else {
				echo "0 results";
				}
				$conn->close();

}
?>