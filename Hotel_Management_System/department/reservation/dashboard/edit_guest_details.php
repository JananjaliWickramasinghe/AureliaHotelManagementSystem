<?php
require_once('../../connection.php');
$today =  date("m/d/y");

//task infor
$taskid=rand(1000,9999);

$_SESSION['taskid']=$taskid;

//sql
$getclients = "SELECT projectid,ProjectName,client,project,type FROM projects_topl WHERE task_type='TOPL' ORDER BY client DESC";
$resultgetclients = $conn->query($getclients);
//GET types
$gettypes = "SELECT typeid,name,description FROM types_topl ORDER BY typeid DESC";
$resultgettypes = $conn->query($gettypes);
//GET Users
$getusers = "SELECT uid_topl,firstname_topl,lastname_topl FROM users ORDER BY uid_topl ASC";
$resultgetusers = $conn->query($getusers);

?>

<?php
if (isset($_POST['edit'])) {
  
    $i = $_POST['guest_id'];
    //$id= 1;
    $up=mysqli_query($conn,"SELECT * FROM Guest WHERE guest_id='$i'") ;  
	$updateRow=mysqli_fetch_array($up,MYSQLI_ASSOC);	
		
}	 
?>

<?php
if (isset($_POST['delete'])) {
    //$guest = $_POST['id'];
    $i = $_POST['guest_id'];
   
    $sql= "DELETE FROM Guest WHERE guest_id='$i'";
    
    if(mysqli_query($conn,$sql))
    {
      echo "<script> alert('Guest details deleted');</script>";
      echo "<script> location.replace('index.php?tab=guest_log');</script>";
    }
  else
    {
      echo "<script> alert('Error : ');</script>";
    }
  	
}	 
?>


<?php
if(isset($_POST['update'])){ 

        $guest = $_POST['id'];
        $id = $_POST['guest_id'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $address_1 = $_POST['address_1'];
        $address_2= $_POST['address_2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
   
		$sql= "UPDATE Guest SET first_name='$fName',
            last_name=' $lName',
            address_line_1='$address_1',
            address_line_2='$address_2',
            city='$city',
            `state`='$state',
            country='$country',
            zipcode=' $zipcode',
            phone='$phone',
            email='$email'
            WHERE guest_id='$guest'";
          
        if(mysqli_query($conn,$sql))
        {
            echo"<script>alert('Record updated successfully!')</script>";
            echo "<script> location.replace('index.php?tab=guest_log');</script>";
            
        }	
        else
        {
            echo"<script>alert('Error')</script>";
        }

	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Create new user</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/css_subpage.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/forms.css" />
<style>
.contentform {
  max-width: 60% auto;
  margin: auto;
}
</style>
</head>
<body>

<br>

<div class="contentform">
  <div class="containerform">

  <h2 class="subtitle">Edit Guest Details</h2>

  <hr>
      <form id="fupForm" name="form1" method = "post">
          <div class="row">
            <div class="col-25">
              <label for="guestDetails">Guest Details</label>

              <input type="hidden" id="id" name="id" value="<?php echo $i?>" />

              <input type="hidden" id="guest_id" name="guest_id" value="<?php echo $updateRow['guest_id'];?>" />
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="fName">First name</label>
                  <input type="text" id="fName" name="fName" value="<?php echo $updateRow['first_name'];?>"required>
              </div>

              <div class="form-group col-md-4">
                  <label for="fName">Last name</label>
                  <input type="text" id="lName" name="lName" value="<?php echo $updateRow['last_name'];?>"required>
              </div>  
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            <label for="location">Location</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="address_1">Address Line 1</label>
                  <input type="text" id="address_1" name="address_1"value="<?php echo $updateRow['address_line_1'];?>" required>
              </div>

              <div class="form-group col-md-4">
                  <label for="address_2">Address Line 2</label>
                  <input type="text" id="address_2" name="address_2"value="<?php echo $updateRow['address_line_2'];?>" required>
              </div> 
              
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                  <label for="city">City</label>
                  <input type="text" id="city" name="city"value="<?php echo $updateRow['city'];?>" required>
              </div>

              <div class="form-group col-md-4">
                  <label for="state">State</label>
                  <input type="text" id="state" name="state" value="<?php echo $updateRow['state'];?>"required>
              </div> 
              
              <div class="form-group col-md-2">
                  <label for="zipcode">Zip code</label>
                  <input type="text" id="zipcode" name="zipcode" value="<?php echo $updateRow['zipcode'];?>"required>
              </div> 

              <div class="form-group col-md-4">
                  <label for="country">Country</label>
                  <input type="text" id="country" name="country" value="<?php echo $updateRow['country'];?>" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
            <label for="contact">Contact Details</label>
            </div>
            <div class="col-75">
               
              <div class="form-group col-md-4">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" name="phone" value="<?php echo $updateRow['phone'];?>"required>
              </div>

              <div class="form-group col-md-4">
                  <label for="email">Email</label>
                  <input type="text" id="email" name="email"value="<?php echo $updateRow['email'];?>" required>
              </div> 
              
            </div>
          </div>
    
          <div class="row">
            <div class="form-group col-md-10">
              <input name = "update" type="submit" value = "Update" class = "btn btn-success" />
            </div> 
          </div>
       </form>

       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>



</body>
</html>