<?php  
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "auralia_hotel_db"; 
 
// Create database connection 
$db=$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
  } 

 // Excel file name for download 
  $fileName = "members-data_" . date('Y-m-d') . ".xls"; 

  $gettype = $_GET['t'];
  $d1 = $_GET['d1'];
  $d2 = $_GET['d2'];
  

  if($gettype=='FRP'){
    // Column names 
    $fields = array('Menu ID', 'NAME', 'REVIEW', 'EMAIL', 'DATE', 'STATUS'); 

    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 

    if((empty($d1)) && (empty($d2))){
     
      $query = $conn->query("SELECT * FROM reviews WHERE approval=1 ORDER BY menuId DESC"); 
    }else {
     
      $query = $conn->query("SELECT * FROM reviews WHERE approval=1 AND addeddate BETWEEN '$d1' AND '$d2' ORDER BY menuId DESC"); 
    }

    if($query->num_rows > 0){ 
      // Output each row of the data 
      while($row = $query->fetch_assoc()){ 
          $status = ($row['approval'] == 1)?'Approved':'Not Approved'; 
          $lineData = array($row['menuId'], $row['name'], $row['review'], $row['email'], $row['addeddate'], $status); 
          array_walk($lineData, 'filterData'); 
          $excelData .= implode("\t", array_values($lineData)) . "\n"; 
      } 
    }else{ 
      $excelData .= 'No records found...'. "\n"; 
    } 

    // Headers for download 
    ob_start();
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 

    // Render excel data 
    echo $excelData; 

    exit;

  }else if($gettype=='FRN'){
   // Column names 
   $fields = array('Menu ID', 'NAME', 'REVIEW', 'EMAIL', 'DATE', 'STATUS'); 

   // Display column names as first row 
   $excelData = implode("\t", array_values($fields)) . "\n"; 

   if((empty($d1)) && (empty($d2))){
    
     $query = $conn->query("SELECT * FROM reviews WHERE approval=0 ORDER BY menuId DESC"); 
   }else {
    
     $query = $conn->query("SELECT * FROM reviews WHERE approval=0 AND addeddate BETWEEN '$d1' AND '$d2' ORDER BY menuId DESC"); 
   }

   if($query->num_rows > 0){ 
     // Output each row of the data 
     while($row = $query->fetch_assoc()){ 
         $status = ($row['approval'] == 1)?'Approved':'Not Approved'; 
         $lineData = array($row['menuId'], $row['name'], $row['review'], $row['email'], $row['addeddate'], $status); 
         array_walk($lineData, 'filterData'); 
         $excelData .= implode("\t", array_values($lineData)) . "\n"; 
     } 
   }else{ 
     $excelData .= 'No records found...'. "\n"; 
   } 

   // Headers for download 
   ob_start();
   header("Content-Type: application/vnd.ms-excel"); 
   header("Content-Disposition: attachment; filename=\"$fileName\""); 

   // Render excel data 
   echo $excelData; 

   exit;

  }else if($gettype=='FRA'){
    // Column names 
    $fields = array('Menu ID', 'NAME', 'REVIEW', 'EMAIL', 'DATE', 'STATUS'); 

    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
 
    if((empty($d1)) && (empty($d2))){
     
      $query = $conn->query("SELECT * FROM reviews  ORDER BY menuId DESC"); 
    }else {
     
      $query = $conn->query("SELECT * FROM reviews WHERE addeddate BETWEEN '$d1' AND '$d2' ORDER BY menuId DESC"); 
    }
 
    if($query->num_rows > 0){ 
      // Output each row of the data 
      while($row = $query->fetch_assoc()){ 
          $status = ($row['approval'] == 1)?'Approved':'Not Approved'; 
          $lineData = array($row['menuId'], $row['name'], $row['review'], $row['email'], $row['addeddate'], $status); 
          array_walk($lineData, 'filterData'); 
          $excelData .= implode("\t", array_values($lineData)) . "\n"; 
      } 
    }else{ 
      $excelData .= 'No records found...'. "\n"; 
    } 
 
    // Headers for download 
    ob_start();
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
    // Render excel data 
    echo $excelData; 
 
    exit;
    
  }else if($gettype=='MD'){
     // Column names 
     $fields = array('Menu ID', 'NAME', 'CATEGORY', 'PRICE', 'DATE', 'DESCRIPTION'); 

    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 

    // Fetch records from database 
    $query = $conn->query("SELECT * FROM foodmenus ORDER BY menuId ASC"); 
    if($query->num_rows > 0){ 
      // Output each row of the data 
      while($row = $query->fetch_assoc()){ 
          //$status = ($row['approval'] == 1)?'Active':'Inactive'; 
          $lineData = array($row['rid'], $row['name'], $row['review'], $row['email'], $row['menuId']); 
          array_walk($lineData, 'filterData'); 
          $excelData .= implode("\t", array_values($lineData)) . "\n"; 
      } 
    }else{ 
      $excelData .= 'No records found...'. "\n"; 
    } 

    // Headers for download 
    ob_start();
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 

    // Render excel data 
    echo $excelData; 

    exit;
    
  }


 ?> 
 