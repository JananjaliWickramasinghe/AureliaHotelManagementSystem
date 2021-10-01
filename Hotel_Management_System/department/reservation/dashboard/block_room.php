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
if (isset($_POST['blockRoom'])) {
  
    $id = $_POST['room_id'];
	$cin = $_POST['cin'];
	$cout = $_POST['cout'];
    //echo "confirm".$id."in".$cin."cout".$cout;

   $sql= "UPDATE Room_booking SET c_in='$cin',c_out='$cout'        
            WHERE r_id='$id'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script> alert('Room blocked');</script>";
       echo "<script> location.replace('index.php?tab=booking_calendar');</script>";
     
    }
    else
    {
        echo "<script> alert('Error : ');</script>";
    }
	
}	 
?>
