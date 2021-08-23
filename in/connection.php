<?php
//main connection details
$head_hostname = "localhost";
$head_user = "root";//change
$head_password = "";//change
$head_database = "auralia_hotel_db";//change


	$dbConnection= $db = $bd = $con = $conn= mysqli_connect($head_hostname,$head_user,$head_password,$head_database);   //create connection

	
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to database".mysqli_connect_error();
	}
	

?>
