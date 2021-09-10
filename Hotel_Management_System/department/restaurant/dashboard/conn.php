<?php
 
//MySQLi Procedural
$conn = mysqli_connect("localhost","root","","auralia_hotel_db");
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}
 
?>