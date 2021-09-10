<?php
require_once('../../connection.php');

$today =  date("m/d/y");


$adminstatus ='';



$user = $_SESSION['username'];

    //Retrive Data from DB
    $sqlview = "SELECT * FROM users WHERE username = '".$user."'";
    $result = $conn->query($sqlview);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $uidno= $row["uid"];
        $firstname= $row["firstname"];
        $lastname=$row["lastname"];
        $department= $row["department"];
        $designation=$row["designation"];
        $EmployeeNo= $row["EmployeeNo"];
        $email=$row["email"];
        $password= $row["password"];
        $m1=$row["mobile1"];
        $m2=$row["mobile2"];
        $username = $row["username"];
        $Adminaccess = $row["Adminaccess"];
      }

      if ($Adminaccess ==1){
        $adminstatus = 'Administrator';
      }else{
        $adminstatus = 'Employee';
      }

    } else {
      echo "0 results";
    }

    
    



$msg="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title;?></title>
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
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
 
  border: 1px solid green; 
  border-style: hidden;
}

</style>
</head>
<body>

<div class="contentform">
  
  <?php echo $adminstatus;?>
  <h3 class="subtitle">Welcome  <?php echo $login_name;?> <?php echo $login_lastname;?> !</h3>
  <hr>

  <br>

  <div class="row">
      <div class="col-sm-2">
      <h2>Your Account</h2>
        <hr>
      </div>

      <div class="col-sm-8">
        <table class="table table-condensed">
       
          <tr>
            <th><?php echo $firstname;?> <?php echo $lastname;?></th>
          </tr>
          <tr>
            <td>Department - <?php echo $department;?> > Designation - <?php echo $designation;?> </td>
          </tr>
          <tr>
            <td>Username - <?php echo $username;?></td>
          </tr>
          <tr>
            <td>Email - <?php echo $email;?></td>
          </tr>
          <tr>
            <td>Mobile - <?php echo $m1;?> / <?php echo $m2;?></td>
          </tr>
          
      </table>
        
      </div>
    </div>

  </div>
  
</body>
</html>