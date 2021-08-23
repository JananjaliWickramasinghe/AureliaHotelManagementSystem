<?php
require_once('../../connection.php');
$today =  date("m/d/y");

  //title
  if ($_GET['tab']=='createnewuser'){
    $title = "Create New User";
    $properties = 'required'; // text box
    $button ='Insert New User';


    $firstname= '';
    $lastname='';
    $department= '';
    $designation='';
    $EmployeeNo= "EMP".rand(100,999);
    $email='';
    $password= '';
    $m1='';
    $m2='';
    $username = '';

  }else if ($_GET['tab']=='edituser'){
    $uid = $_GET['user'];
    
    //Retrive Data from DB
    $sql = "SELECT * FROM users WHERE uid = $uid";
    $result = $conn->query($sql);

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
      }
    } else {
      echo "0 results";
    }
    
    $title = "Edit User > $EmployeeNo ";
    $properties = 'disabled';//password change disable in update form
    $button ='Update User';

  }

//Insert Data to DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if($_GET['tab']=='createnewuser'){
    $empno = $EmployeeNo;
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $dep = $_POST['dep'];
    $des = $_POST['des'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $usern = $_POST['un'];
    $TODAY = date("Y-m-d");

    if((isset($empno)) AND (isset($fn)) AND (isset($ln)) AND (isset($dep)) AND (isset($des)) AND (isset($p1)) AND (isset($p2)) AND (isset($email)) AND (isset($pass1)) AND (isset($pass2)) AND (isset($usern))){
      
      $sqlin = "INSERT INTO users (EmployeeNo,firstname,lastname,email,password,addeddate,department,designation,mobile1,mobile2,username)
      VALUES ('".$EmployeeNo."', '".$fn."', '".$ln."','".$email."', '".$pass1."', '".$TODAY."','".$dep."', '".$des."', '".$p1."','".$p2."', '".$usern."')";

      if($pass1===$pass2){
        if ($conn->query($sqlin) === TRUE) {
          echo '<script>alert("Insert success");</script>';
        } else {
          echo "Error: " . $sqlin . "<br>" . $conn->error;
        }
        
        $conn->close();
      }else{
        echo '<script>alert("Passwords didnt match.!");</script>';
      }
    }else {
      echo '<script>alert("User creation failed.! Please fill all the fields");</script>';
    }

  }else if($_GET['tab']=='edituser'){

    $empno = $EmployeeNo;
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $dep = $_POST['dep'];
    $des = $_POST['des'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $email = $_POST['email'];
    $usern = $_POST['un'];

    if((isset($empno)) AND (isset($fn)) AND (isset($ln)) AND (isset($dep)) AND (isset($des)) AND (isset($p1)) AND (isset($p2)) AND (isset($email)) AND (isset($usern))){
    
        $sqlupdate = "UPDATE users SET firstname='".$fn."',lastname='".$ln."',username='".$usern."',department='".$dep."',designation='".$des."',email='".$email."', mobile1='".$p1."', mobile2='".$p2."' WHERE uid='".$uidno."'";
        if (mysqli_query($conn, $sqlupdate)) {
          echo '<script>alert("Updated successfully");</script>';
        } else {

         header("location: ../../6index.php?tab=manageusers");
        }
        $conn->close();
     
    }else {
      echo '<script>alert("Update Failed.! Please fill all the fields");</script>';
    }

  }

}
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
  <h2 class="subtitle"><?php echo $title;?></h2>
  <hr>
      <form id="fupForm" name="form1" method = "post">
            <div class="row">
              <div class="col-25">
                <label for="fname"></label>
              </div>
              <div class="col-75">
              <div class="form-group col-md-8">
                          <label for="client">Employee Number</label>
                          <input type="text" id="empno" name="empno" value="<?php echo $EmployeeNo;?>" disabled required>
                        </div>
                        
                </div>
              <hr>
            </div>
        <div class="row">
           <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-4">
                        <label for="client">First Name</label>
                        <input type="text" id="fn" name="fn" value="<?php echo $firstname;?>" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="priority">Last Name</label>
                        <input type="text" id="ln" name="ln" value="<?php echo $lastname;?>" required>
                      </div>
              </div>
        </div>

        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-4">
                        <label for="client">Department</label>
                        <input type="text" id="dep" name="dep" value="<?php echo $department;?>" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="priority">Designation</label>
                        <input type="text" id="des" name="des" value="<?php echo $designation;?>" required>
                      </div>
              </div>
        </div>

        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>

            <div class="col-75">
            <div class="form-group col-md-4">
                        <label for="client">Phone 1</label>
                        <input type="text" id="p1" name="p1" value="<?php echo $m1;?>" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="priority">Phone 2</label>
                        <input type="text" id="p2" name="p2" value="<?php echo $m2;?>" required>
                      </div>
              </div>
        </div>
        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>

            <div class="col-75">
            <div class="form-group col-md-8">
                        <label for="client">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $email;?>" required>
                      </div>
                             
              </div>
              <hr>
        </div>
        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-8">
                        <label for="client">Username</label>
                        <input type="text" id="un" name="un" value="<?php echo $username;?>" required > 
                      </div>
              </div>
              <hr>
        </div>
        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>

            <div class="col-75">
            <div class="form-group col-md-8">
                        <label for="client">Password</label>
                        <input type="text" id="pass1" name="pass1" <?php echo $properties?> >
                      </div>
                      
           
              </div>
              <hr>
        </div>
        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>

            <div class="col-75">
            <div class="form-group col-md-8">
                        <label for="client">Re-Enter Pasword</label>
                        <input type="text" id="pass2" name="pass2" <?php echo $properties?>>
                      </div>
              </div>
              <hr>
        </div>        
        <div class="row">
            <div class="col-25">
            </div>
            <div class="col-75">
          <div class="form-group">
          <label for="attachmentfile">Employee Photo</label>
            <input type="file" class="form-control-file" id="attachmentfile">
          </div>
        </div>
        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
             <div class="form-group col-md-8">
              <div class="center">
               <input name="submit" type="submit" value="<?php echo $button;?>"  id="butsave">
              </div>
             </div>
            </div> 
        </div>

       </form>
       <br>
       <br>
       <br>
        <div id="loader-icon" style="display: none;">
            <img src="../img/loader.gif" />
        </div>
    </div>
</body>
</html>