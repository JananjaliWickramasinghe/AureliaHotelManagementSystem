<?php
require_once('../../connection.php');



if(isset($_POST['search']) || ($_POST['search'] !=="")){
	$valueTosearch = $_POST['valueTosearch'];
	//echo '<script type="text/javascript">alert("'.$valueTosearch.'");</script>';
	$query = "select * from expenses where id =$valueTosearch";
	$search_result = filterTable($query);
	
}else{

	$query = "SELECT * FROM expenses";
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
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script> 
		function delete_data(id)
		{
			if(confirm("Are you sure to delete the record"))
			{
				window.location.href="dashboard/DeleteExpenses.php?id="+id;
			}
		}
	</script>
	
</head>
<body>

<div class="container">
  <h2>Expenses Details</h2>   
  
  <table class="table table-bordered">
                 <tr >
					<th>Expenses_ID</th>
					<th >Date</th>
					<th >Section</th>
					<th >Amount</th>
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
							 <td><?php echo "<p>".$row['date']."</p>";?></td>
							 <td><?php echo "<p>".$row['section']."</p>";?></td>
							 <td><?php echo "<p>".$row['amount']."</p>";?></td>
							 
							 <td>
							 <form method="post" action="index.php?tab=Editexpenses">
									<input type="hidden" name="expenses_id" value="<?php echo $row['id']; ?>"/>
									<input type="submit" class="btn btn-success" name="editExpenses" value="Edit"/>
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
