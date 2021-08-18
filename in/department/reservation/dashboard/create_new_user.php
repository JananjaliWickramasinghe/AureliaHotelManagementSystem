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

<div class="topnav">
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#">Link</a>
</div>
<br>

<div class="contentform">
  <div class="containerform">

  <h2 class="subtitle">Create new User</h2>

  <hr>
      <form id="fupForm" name="form1" action="./task_topl/upload.php" method = "post">
          <div class="row">
            <div class="col-25">
              <label for="fname">Project</label>
            </div>

            <div class="col-75">
            <div class="form-group col-md-4">
                        <label for="client">Client</label>
                        <select id="client" name="client" class="form-control">
                        <option selected>Choose...</option> 
                        <?PHP
                       
                        if ($resultgetclients->num_rows > 0) {
                          // output data of each row
                          while($row = $resultgetclients->fetch_assoc()) {

                            echo "<option value=". $row["projectid"].">". $row["ProjectName"]. "  [ ". $row["client"]. " > ". $row["project"]. " ] </option>";
                          }
                        } else {
                          echo "<option selected>Nothing to show...</option>";
                        }
                        $conn->close();

                        ?>
                     
                        </select>
                      </div>

                      <div class="form-group col-md-4">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="form-control">
                        
                          <option selected>Choose...</option>
                          <?PHP
                          if ($resultgettypes->num_rows > 0) {
                            // output data of each row
                            while($row = $resultgettypes->fetch_assoc()) {

                              echo "<option value=". $row["typeid"].">". $row["name"]. " : ". $row["description"]. "</option>";
                            }
                          } else {
                            echo "<option selected>Nothing to show...</option>";
                          }
                          $conn->close();

                          ?>
                        </select>
                      </div>

                      <div class="form-group col-md-4">
                        <label for="priority">Priority</label>
                        <select id="priority" name="priority" class="form-control">
                        <option value="3" selected>Low Priority - 03</option>
                          <option value="2">Medium Priority- 02</option>
                          <option value="1">High Priority - 01</option>
                        </select>
                      </div>
           
              </div>
    
        </div>
   
      

          <!-- 1 -->
          <div class="row">
            <div class="col-25">
              <label for="fname">Task Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="task" name="task" required>
            </div>
          </div>
          
           <!-- 5 -->
           <div class="row">
            <div class="col-25">
              <label for="des"></label>
            </div>
            <div class="col-75">
              <textarea id="des" name="des" placeholder="Description" style="height:160px"></textarea>
            </div>
          </div>
          <!-- 5 end -->
          
          <div class="row">
            <div class="col-25">
              <label for="att">Attachments (pdf/word/jpeg/zip)</label>
            </div>
            <div class="col-75">
          <div class="form-group">
          <label for="attachmentfile">Example file input</label>
            <input type="file" class="form-control-file" id="attachmentfile">
          </div>
        </div>




          <div class="row">
            <div class="col-25">
              <label for="PD">Project Date</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                        
              <label for="project">Recieved date</label>
              <input type="date" id="Rdate" name="Rdate" value="<?php echo date('Y-m-d');?>">
                </div>

                <div class="form-group col-md-4">
                          <label for="project">Assigned date</label>
                          <input type="date" id="Adate" name="Adate" value="<?php echo date('Y-m-d');?>">
                </div>
                <div class="form-group col-md-4">
                          <label for="project">Target date</label>
                          <input type="date" id="Tdate" name="Tdate" value="<?php echo date('Y-m-d');?>">
                </div>
            </div>
          </div>
          <!-- 1 end -->


          
          <div class="row">
            <div class="col-25">
              <label for="fname">Assign to</label>
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
   
              <label for="project">Assign to</label>
              <select id="assign" name="assign" class="form-control">
                        <option selected>Choose...</option>
                        <?PHP
                          if ($resultgetusers->num_rows > 0) {
                            // output data of each row
                            while($row = $resultgetusers->fetch_assoc()) {
                           
                              echo "<option value=". $row["uid_topl"].">". $row["firstname_topl"]. " ". $row["lastname_topl"]. "</option>";
                            }
                          } else {
                            echo "<option selected>Nothing to show...</option>";
                          }
                          $conn->close();

                          ?>
                        </select>
                    
                </div>

                <div class="form-group col-md-4">
                          <label for="ahours">Assiged hours</label>
                          <input type="number" step="any" id="ahours" name="ahours" >
                </div>
                <div class="form-group col-md-4">
                          <label for="project">Status</label>
                          <input type="text" id="status_p" name="status_p" value="Not started" disabled>
                </div>
            </div>
          </div>
        
         
          <br>

            <div class="row">
            <input name="submit" type="submit" value="Submit"  id="butsave">
            </div>
       </form>

       <div id="loader-icon" style="display: none;">
          <img src="../img/loader.gif" />
      </div>
   </div>



</body>
</html>