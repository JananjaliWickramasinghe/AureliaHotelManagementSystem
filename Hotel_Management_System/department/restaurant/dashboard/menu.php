<?php
require_once('../../connection.php');
$today =  date("m/d/y");

  //title
  if ($_GET['tab']=='createmenu'){
    $title = "Create Menu";
    $properties = 'required'; // text box
    $button ='Insert Menu';

    $menuId= "M".rand(100,999);
    $name= "";
    $category="";
    $description= "";
    $price="";
    $addedby= "";
    $addeddate="";
    $shortdescription= "";

  }else if ($_GET['tab']=='editmenu'){
    $menuid = $_GET['menu'];
    
    //Retrive Data from DB
    $sql = "SELECT * FROM foodmenus WHERE menuId = '".$menuid."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $menuId= $row["menuId"];
        $name= $row["name"];
        $category=$row["category"];
        $description= $row["description"];
        $price=$row["price"];
        $addedby= $row["addedby"];
        $addeddate=$row["addeddate"];
        $shortdescription= $row["shortdescription"];
       
      }
    } else {
      echo "0 results";
    }
    
    $title = "Edit Menu > $menuid ";
    $properties = 'disabled';//password change disable in update form
    $button ='Update Menu';

   
  }

//Insert Data to DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if($_GET['tab']=='createmenu'){
   
    $mc = $menuId;
    $mn = $_POST['mn'];
    $Category = $_POST['Category'];
    $sdes= $_POST['sdes'];
    $des = $_POST['des'];
    $price = $_POST['price'];
    $TODAY = date("Y-m-d");

    if((isset($mc)) AND (isset($mn)) AND (isset($Category)) AND (isset($sdes)) AND (isset($des)) AND (isset($price))){
      
      $sqlin = "INSERT INTO foodmenus (menuId,name,category,description,shortdescription,price,addedby,addeddate)
      VALUES ('".$mc."', '".$mn."', '".$Category."','".$des."', '".$sdes."','".$price."', '".$_SESSION['username']."','".$TODAY."')";

        if ($conn->query($sqlin) === TRUE) {
          echo '<script>alert("Menu successfully inserted!");</script>';
          echo '<script>location.replace("index.php?tab=managemenu");</script>';
        } else {
          echo "Error: " . $sqlin . "<br>" . $conn->error;
        }
            
    }else {
      echo '<script>alert("Menu creation failed.! Please fill all the fields");</script>';
    }

    $extension=array('jpeg','jpg','png','gif');
    foreach ($_FILES['image']['tmp_name'] as $key => $value) {
      $filename=$_FILES['image']['name'][$key];
      $filename_tmp=$_FILES['image']['tmp_name'][$key];
      echo '<br>';
      $ext=pathinfo($filename,PATHINFO_EXTENSION);

      $finalimg='';
      if(in_array($ext,$extension))
      {
        if(!file_exists('images/'.$filename))
        {
        move_uploaded_file($filename_tmp, 'images/'.$filename);
        $finalimg=$filename;
        }else
        {
          $filename=str_replace('.','-',basename($filename,$ext));
          $newfilename=$filename.time().".".$ext;
          move_uploaded_file($filename_tmp, 'images/'.$newfilename);
          $finalimg=$newfilename;
        }
        $creattime=date('Y-m-d h:i:s');
        //insert
        $insertqry="INSERT INTO `menuimg`(`menuid`,`image_name`, `image_createtime`) VALUES ('$mc','$finalimg','$creattime')";
        mysqli_query($con,$insertqry);


      }else
      {
        echo '<script>alert("Menu Image upload failed!");</script>';
      }
    }

  }else if($_GET['tab']=='editmenu'){

    $mc = $_GET['menu'];
    $mn = $_POST['mn'];
    $Category = $_POST['Category'];
    $sdes= $_POST['sdes'];
    $des = $_POST['des'];
    $price = $_POST['price'];

    if((isset($mc)) AND (isset($mn)) AND (isset($Category)) AND (isset($sdes)) AND (isset($des)) AND (isset($price))){
    
        $sqlupdate = "UPDATE foodmenus SET  name='".$mn."',name='".$mn."',category='".$Category."',description='".$des."',shortdescription='".$sdes."', price='".$price."' WHERE menuId='".$mc."'";
        if (mysqli_query($conn, $sqlupdate)) {
          
          echo '<script>alert("Menu Updated successfully!");</script>';
          echo '<script>location.replace("index.php?tab=managemenu");</script>';
        } else {
          echo "Error updating record: " . $conn->error;
         
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
      <form id="fupForm" name="form1" method = "post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-25">
                <label for="fname"></label>
              </div>
              <div class="col-75">
              <div class="form-group col-md-8">
                          <label for="client">Menu Code</label>
                          <input type="text" id="mc" name="mc" value="<?php echo $menuId;?>" disabled required>
                        </div>
                        
                </div>
           
            </div>

            <div class="row">
              <div class="col-25">
                <label for="fname"></label>
              </div>
              <div class="col-75">
              <div class="form-group col-md-8">
                          <label for="client">Menu Name</label>
                          <input type="text" id="mn" name="mn" value="<?php echo $name;?>" required>
                        </div>
                        
                </div>
         
            </div>

        <div class="row">
           <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-8">
                        <label for="Category">Category</label>
                        <select id="Category" name="Category" class="form-control">
                        <option value="breakfast"  selected>Breakfast</option>
                          <option value="lunch">Lunch</option>
                          <option value="dinner">Dinner</option>
                        </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
            <div class="form-group col-md-4">
                        <label for="client">Short Description</label>
                        <textarea id="sdes" name="sdes" rows="4" cols="50"  required>
                        <?php echo $shortdescription;?>
                        </textarea>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="client">Description</label>
                        <textarea id="des" name="des" rows="4" cols="50" required>
                        <?php echo $description;?>
                        </textarea>
                        </div>
              </div>
        </div>
          <div class="row">
              <div class="col-25">
                <label for="fname"></label>
              </div>
              <div class="col-75">
              <div class="form-group col-md-8">
                          <label for="client">Price</label>
                          <input type="text" id="price" name="price" value="<?php echo $price;?>" required>
                        </div>
                </div>
          </div>

            <hr>
            <div class="row">
              <div class="col-25">
                <label for="fname"></label>
              </div>
              <div class="col-75">
              <div class="form-group col-md-8">
            <label>Images</label>
            <input type="file" name="image[]" class="form-control" multiple />
            </div>
            </div>
              <hr>
          </div>
        
            <hr>
        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
             <div class="form-group col-md-8">
              <div class="center">
               <input name="submit" type="submit" value="<?php echo $button;?>"  id="butsave" class="blue">
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