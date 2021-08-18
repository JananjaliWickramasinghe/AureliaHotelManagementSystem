<?php


//main connection details
$head_hostname = "localhost";
$head_user = "root";//change
$head_password = "";//change
$head_database = "aurelia_hotel_db";//change

//connection for search
	/*
class DBController {
	public $host = "localhost";
	private $user = "root";//change
	private $password = "";//change
	private $database = "cadd_db";//change
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	
	
}
*/


//Connection3

	$dbConnection= $db = $bd = $con = $conn= mysqli_connect($head_hostname,$head_user,$head_password,$head_database);   //create connection

	
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to database".mysqli_connect_error();
	}
	

?>
