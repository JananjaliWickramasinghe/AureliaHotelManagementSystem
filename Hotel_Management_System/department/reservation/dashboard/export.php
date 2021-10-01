<?php

$connect = new PDO("mysql:host=localhost;dbname=aurelia_hotel_db", "root", "");

$start_date_error = '';
$end_date_error = '';

if(isset($_POST["export"]))
{
 if(empty($_POST["start_date"]))
 {
  $start_date_error = '<label class="text-danger">Start Date is required</label>';
 }
 else if(empty($_POST["end_date"]))
 {
  $end_date_error = '<label class="text-danger">End Date is required</label>';
 }
 else
 {
  $file_name = 'Booking Data.csv';
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$file_name");
  header("Content-Type: application/csv;");

  $file = fopen('php://output', 'w');

  $header = array("Booking ID", "Guest Name", "Room type", "check in", "check out");

  fputcsv($file, $header);

  $query = "
  SELECT * FROM Booking 
  WHERE checkout >= '".$_POST["start_date"]."' 
  AND checkout <= '".$_POST["end_date"]."' 
  ORDER BY checkout DESC
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $data = array();
   $data[] = $row["booking_id"];
   $data[] = $row["guest_id"];
   $data[] = $row["room_id"];
   $data[] = $row["checkin"];
   $data[] = $row["checkout"];
   fputcsv($file, $data);
  }
  fclose($file);
  exit;
 }
}

$query = "
SELECT * FROM Booking 
ORDER BY checkout DESC;
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

?>
