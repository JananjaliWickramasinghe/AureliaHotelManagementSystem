<?php
require_once('../../connection.php');
$today =  date("m/d/y");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$d1 =$_POST['d1'];
$d2 =$_POST['d2'];


  echo '<script language="javascript">';
  echo 'alert(message successfully sent)';  //not showing an alert box.
  echo '</script>';

  if($_POST['type'] == 'FRP'){
    echo "<script>window.open('reports/report.php?t=FRP&&d1=$d1&&d2=$d2','_parent').focus() </script>"; 
  } else if($_POST['type'] == 'FRN'){
    echo "<script>window.open('reports/report.php?t=FRN&&d1=$d1&&d2=$d2','_parent').focus() </script>"; 
  } else if($_POST['type'] == 'FRA'){
    echo "<script>window.open('reports/report.php?t=FRA&&d1=$d1&&d2=$d2','_parent').focus() </script>"; 
  } else if($_POST['type'] == 'MD'){
    echo "<script>window.open('reports/report.php?t=MD&&d1=$d1&&d2=$d2','_parent').focus() </script>"; 
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
<script>
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST", "reports/report.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

<div class="contentform">
  <h2 class="subtitle">Export Reports</h2>
  <hr>
      <form id="fupForm" name="form1" method = "post">
            <div class="row">
              <div class="col-25">
                <label for="fname"></label>
              </div>

              <div class="col-75">
              <div class="form-group col-md-8">   
                        <label for="type">Select report *</label>
                        <select id="type" name="type" class="form-control">
                          <option selected>Choose...</option>
                          <option value="FRP">Food Reviews (Positive) - Order By Menu</option>
                          <option value="FRN">Food Reviews (Negative)- Order By Menu</option>
                          <option value="FRA">Food Reviews (Both)- Order By Menu</option>
                          <option value="MD">Menu Details</option>
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
                        <input type="date" id="task" name="d1">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="priority">To</label>
                        <input type="date" id="task" name="d2">
                      </div>
              </div>
        </div>
        
        <div class="row">
            <div class="col-25">
              <label for="fname"></label>
            </div>
            <div class="col-75">
             <div class="form-group col-md-8">
               <br>
              <div class="center">
            
               <input name="submit" type="submit" value="Export Report (Excel)"  id="butsave">
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