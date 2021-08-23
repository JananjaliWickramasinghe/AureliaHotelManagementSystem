<?php
require_once('../../connection.php');
$today =  date("m/d/y");
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
  <h2 class="subtitle">Export Reports</h2>
  <hr>
      <form id="fupForm" name="form1" action="./task_topl/upload.php" method = "post">
            <div class="row">
              <div class="col-25">
                <label for="fname"></label>
              </div>

              <div class="col-75">
              <div class="form-group col-md-8">
                      
                          <label for="type">Report name</label>
                        <select id="type" name="type" class="form-control">
                        
                          <option selected>Choose...</option>
                          <option value="AED">All Employee Details</option>
                          <option value="ML">Menu List</option>

                        </select>
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
                        <label for="client">From</label>
                        <input type="text" id="task" name="task" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="priority">To</label>
                        <input type="text" id="task" name="task" required>
                      </div>
              </div>
        </div>

        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
             <div class="form-group col-md-8">
              <div class="center">
               <input name="submit" type="submit" value="Export Report (PDF)"  id="butsave">
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