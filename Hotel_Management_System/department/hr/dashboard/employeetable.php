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


if(isset($_POST['search'])){
	$valueTosearch = $_POST['valueTosearch'];
	echo '<script type="text/javascript">alert("'.$valueTosearch.'");</script>';
	$query = "select * from employeem where id ='$valueTosearch'";
	$search_result = filterTable($query);
}else{

	$query = "SELECT * FROM employeem";
	$search_result = filterTable($query);
}

?>	

<?php

function filterTable($query)
{
	$connection1 = mysqli_connect("localhost:3307","root","","aurelia_hotel_db");
	$filter_Result = mysqli_query($connection1,$query);
	return $filter_Result;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">	

   <script> 
		function delete_data(id)
		{
			if(confirm("Are you sure to delete the record"))
			{
				window.location.href="dashboard/DeleteEmployee.php?id="+id;
			}
		}
	</script>
	
</head>
<body>

<div class="container">
  <h2>Employee Details</h2>
   
<form id="fupForm" name="form1" action="index.php?tab=searchemployee" method = "post">

  Search 
  <input type = "text" name = "valueTosearch">
  
  <input name "search" type = "submit"  value = "Search" class="btn btn-dark"><br><br>
  
</form>  
  <table class="table table-bordered">
                  <tr >
					<th>Employee_DB_ID</th>
					<th>Employee_ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Address</th>
					<th>Phone</th>
					<th>Role</th>
					<th>Basic_Salary</th>
					<th>Working Hours</th>
					<th>Edit</th>
					<th>Delete</th>
				  </tr>
				  <?php

					  while($row = mysqli_fetch_array($search_result))
					  {
						  $id=$row["id"];
						  ?>
						  
						  <tr>
						     <td><?php echo "<p>".$row['id']."</p>";?></td>
							 <td><?php echo "<p>".$row['e_id']."</p>";?></td>
							 <td><?php echo "<p>".$row['fname']."</p>";?></td>
							 <td><?php echo "<p>".$row['lname']."</p>";?></td>
							 <td><?php echo "<p>".$row['address']."</p>";?></td>
							 <td><?php echo "<p>".$row['phone']."</p>";?></td>
							 <td><?php echo "<p>".$row['role']."</p>";?></td>
							 <td><?php echo "<p>".$row['basicsalary']."</p>";?></td>
							 <td><?php echo "<p>".$row['workhrs']."</p>";?></td>
							 
							 <td>
							 <form method="post" action="index.php?tab=EditEmployee">
									<input type="hidden" name="employee_id" value="<?php echo $row['id']; ?>"/>
									<input type="submit" class="btn btn-success" name="editEmployee" value="Edit"/>
							 </form>
							 </td>
							 <td><?php echo "<button type='submit' onclick='delete_data($id)' class='btn btn-danger' >delete</button>";?></td>
							 
						  </tr>
						  <?php
						  
					  }
				  
				  
                  ?>
  </table>
  
</div>

</body>
</html>
