<?php
require_once('../../connection.php');
$result = mysqli_query($conn,"SELECT * FROM foodmenus");

if (isset($_GET['action'])){
  if (($_GET['tab']=='managemenu') AND($_GET['action']=='delete')) {
    $menu = $_GET['menu'];
    $sql = "DELETE FROM foodmenus WHERE menuId='".$menu."'";
    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Record deleted successfully!");</script>';
      echo '<script>location.replace("index.php?tab=managemenu");</script>';
    } else {
      echo "Error deleting record: " . $conn->error;
    }

  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/css_subpage.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/forms.css" />
<style>
.contentform {
  max-width: 60% auto;
 
}
.center {
  margin: auto;
  width: 80%;
  border: 1px solid #73AD21;
  padding: 10px;
  
}
</style>

</head>
<body>
<div class="contentform">
  <h2 class="subtitle">Manage Menu</h2>
  <hr>
    <div class="container center">
   
      <?php
      if (mysqli_num_rows($result) > 0) {
      ?>
        <table class="table table-hover table-responsive">
        <thead>
        <tr>
       
          <td><b>Menu ID</b></td>
          <td><b>Menu</b></td>
          <td><b>Category</b></td>
          <td><b>Description</b></td>
          
          <td></td>
          <td></td>

        </tr>
        </thead>
        <tbody>
      <?php
      $i=0;
      while($row = mysqli_fetch_array($result)) {
      ?>
      <tr>
          <td><a href="../Hotel%20Website/menu_details.php?menu=<?php echo $row["menuId"]; ?>" target="_parent"><?php echo $row["menuId"]; ?></a></td>
          <td><?php echo $row["name"]; ?></td>
          <td><?php echo $row["category"]; ?></td>
          <td><?php echo $row["shortdescription"]; ?></td>
          <td><a href="index.php?tab=editmenu&menu=<?php echo $row["menuId"]; ?>&action=edit"><input name="submit" type="submit" value="Edit"  id="butsave" class="approve"></a></td>
          <td><a href="index.php?tab=managemenu&menu=<?php echo $row["menuId"]; ?>&action=delete" ><input name="submit" type="submit" value="Delete"  id="butdelete" class="reject"></a></td>
          <td><a href="http://localhost:8081/HotelManagementSystem/Hotel%20Website/menu_details.php?menu=<?php echo $row["menuId"]; ?>" target="_blank"><input name="submit" type="submit" value="View on web"  id="view" class="yellow"></a></td>
          
      </tr>
      <?php
      $i++;
      }
      ?>
      </table>
      <?php
      }
      else{
          echo "No result found";
      }
      ?>

    </div>
  </div>
</div>

</body>
</html>
