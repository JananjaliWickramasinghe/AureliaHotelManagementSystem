<?php
require_once('../../connection.php');
$result = mysqli_query($conn,"SELECT * FROM users WHERE  Adminaccess=0 AND NOT Adminaccess=1");


$today =  date("m/d/y");

  //title
  if (isset($_GET['action'])){
    if (($_GET['tab']=='manageusers') AND($_GET['action']=='delete')) {
      $uid = $_GET['user'];
      $sql = "DELETE FROM users WHERE uid=$uid";
      if ($conn->query($sql) === TRUE) {
        
        echo '<script>alert("Record deleted successfully!");</script>';
        echo '<script>location.replace("index.php?tab=manageusers");</script>';
      } else {
        echo "Error deleting record: " . $conn->error;
      }

    }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Users</title>
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
  <h2 class="subtitle">Manage Users</h2>
  <hr>
    <div class="container center">
   
      <?php
      if (mysqli_num_rows($result) > 0) {
      ?>
        <table class="table table-hover table-responsive">
        <thead>
        <tr>
          <td><b>Employee No</b></td>
          <td><b>First Name</b></td>
          <td><b>Last Name</b></td>
          <td><b>Department</b></td>
          <td><b>Designation</b></td>
          <td><b>Email</b></td>
          <td><b>Username</b></td>
          <td><b>Mobile 1</b></td>
          <td><b>Mobile 2</b></td>
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
          <td><?php echo $row["EmployeeNo"]; ?></td>
          <td><?php echo $row["firstname"]; ?></td>
          <td><?php echo $row["lastname"]; ?></td>
          <td><?php echo $row["department"]; ?></td>
          <td><?php echo $row["designation"]; ?></td>
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["username"]; ?></td>
          <td><?php echo $row["mobile1"]; ?></td>
          <td><?php echo $row["mobile2"]; ?></td>
          <td><a href="index.php?tab=edituser&user=<?php echo $row["uid"]; ?>&action=edit" ><input name="submit" type="submit" value="Edit"  id="butsave"></a></td>
          <td><a href="index.php?tab=manageusers&user=<?php echo $row["uid"]; ?>&action=delete" ><input name="submit" type="submit" value="Delete"  id="butdelete"></a></td>
        
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
