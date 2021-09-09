<?php

	include("../connection.php");
	
//the SQL query to be executed
/*
$my_query = mysqli_query($con, "SELECT DISTINCT pr_date as maD FROM payment_receipt ") or die(mysqli_error($con));

while( $row22 = $my_query->fetch_assoc() ){
extract($row22);
$gotD = $row['maD'];


$paidAm = $paidAm + $payment;

}
*/

//$query = "SELECT * from payment_receipt where pr_date='2017-08-01' ";
$query = "SELECT distinct regDate as ddate, count(std_id) as cst from student group by ddate";


//storing the result of the executed query
$result = $con->query($query);

//initialize the array to store the processed data
$jsonArray = array();

//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row['ddate'];
    $jsonArrayItem['value'] = $row['cst'];
    //append the above created object into the main array.
    array_push($jsonArray, $jsonArrayItem);
  }
}

//Closing the connection to DB
$con->close();

//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);

?>
