<?php
require_once('../../connection.php');
include('pagination_waiting.php');


if ((isset($_GET['newreviews'])) && (isset($_GET['rid'])) && (isset($_GET['action']))){

    $rid = $_GET['rid'];
    $action = $_GET['action'];

    if($action == 'reject'){
      $sql = "DELETE FROM foodmenus WHERE rid='".$rid."'";
      if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record deleted successfully!");</script>';
        echo '<script>location.replace("index.php?tab=managemenu");</script>';
      } else {
        echo "Error deleting record: " . $conn->error;
      }
    }else if($action == 'approve'){

      $sql = "UPDATE reviews SET approval='1' WHERE rid='".$rid."'";
      if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Review Approved!");</script>';
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
  <h2 class="subtitle">Waiting for approvals</h2>
  <hr>
        <div class="container">
            <div class="container">
            <div style="height: 20px;"></div>
            <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
            <table width="80%" class="table table-striped table-bordered table-hover">
                <thead>
                    <th>Menu ID</th>
                    <th>Name</th>
                    <th>Reviews</th>
                    <th>Added Date</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                <?php
                    while($crow = mysqli_fetch_array($nquery)){
                    ?>
                        <tr>
                            <td><?php echo $crow['menuId']; ?></td>
                            <td><?php echo $crow['name']; ?></td>
                            <td><?php echo $crow['review']; ?></td>
                            <td><?php echo $crow['addeddate']; ?></td>
                           
                            <td><a href="index.php?tab=newreviews&rid=<?php echo $crow['rid']; ?>&action=approve" ><input name="submit" type="submit" value="Approve"  id="butsave" class="approve"></a></td>
                            <td><a href="index.php?tab=newreviews&rid=<?php echo $crow['rid']; ?>&action=reject" ><input name="submit" type="submit" value="Reject"  id="butdelete" class="reject"></a></td>
                        </tr>
                    <?php
                    }		
                ?>
                </tbody>
            </table>
            <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
            </div>
            <div class="col-lg-2">
            </div>
            </div>
        </div>

        </div>
  </div>
</div>

</body>
</html>
