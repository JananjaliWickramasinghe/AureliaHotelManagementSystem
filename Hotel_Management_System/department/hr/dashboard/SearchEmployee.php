<?php
require_once('../../connection.php');



if(isset($_POST['search']) || ($_POST['search'] !=="")){
	$valueTosearch = $_POST['valueTosearch'];
	echo '<script type="text/javascript">alert("'.$valueTosearch.'");</script>';
	$query = "select * from employeem where id =$valueTosearch";
	$search_result = filterTable($query);
	
}else{

	$query = "SELECT * FROM employeem";
	$search_result = filterTable($query);
}


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
  <title>Salary Details</title>
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
  <h2>Salary Details</h2>   
  
  <table class="table table-bordered">
                 <tr >
					<th>DB_ID</th>
					<th>Employee_ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Address</th>
					<th>Phone</th>
					<th>Role</th>
					<th>Basic Salary</th>
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
							 <td><?php echo "<button type='submit' onclick='delete_data($id)' class='btn btn-danger'>delete</button>";?></td>
						  </tr>
						  <?php
						  
					  }
				  
				  
                  ?>
  </table>
</div>

</body>
</html>
