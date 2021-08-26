<?php include('pagination.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
					<td><a href="index.php?tab=menu&id=<?php echo $crow['menuId']; ?>">Go to Menu</a></td>
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
</body>
</html>