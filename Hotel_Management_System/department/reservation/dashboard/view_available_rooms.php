<link rel="stylesheet" type="text/css" href="css/forms.css" />
<style>
.contentform {
  max-width: 60% auto;
  margin: auto;
}

body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-repeat: no-repeat;
    padding: 0 !important
}

.container {
    padding-top: 20px;
    padding-bottom: 340px;
	height: 70%

}

.datePick{
	padding-top: 20px;
    padding-bottom: 340px;
	padding-left: 50px;
	padding-right: 50px;
	height: 70%;
	background-color: #C5CAE9
}

th {
  background-color:#3b3f69;
  color: white;
}	

tr:hover {background-color: white;}

table{
	width;80%;
}
</style>
</head>
<body>
	<div class="container">
		<div class="datePick">
			<h2>Available Rooms</h2>
			
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Room_id</th>
					<th>Room_type</th>
					<th>checkin</th>
					<th>checkout</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
			<?php
			if (isset($_POST['checkRooms'])) {	
			
			$cin = $_POST['checkin'];
			$cout = $_POST['checkout'];
				//echo $cin.$cout;
			?>
			
			<?php 
                $projects = array();
                $res=mysqli_query($conn,"SELECT * FROM Room_booking,Room
				WHERE Room_booking.room_type=Room.room_id AND
				c_in IS NULL AND c_out IS NULL
				OR (c_out >= '$cin' AND c_in >= '$cout')
				OR (c_out <= '$cin' AND c_out <= '$cout')");
				
				
				
                while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC))
                {
                    $projects[] = $userRow;
                }
                foreach ($projects as $userRow)
                {
            ?>
			
			<tr>
                        
              <form method="post" action="index.php?tab=block_room">
							<input type="hidden" name="cin" value="<?php echo $cin; ?>"/>
							<input type="hidden" name="cout" value="<?php echo $cout; ?>"/>
                          <td><?php echo $userRow['r_id']; ?></th>
                          <td><?php echo $userRow['room_name']; ?></td>
                          <td><?php echo $userRow['c_in']; ?></td>
                          <td><?php echo $userRow['c_out']; ?></td>
                          
                          <td>
							<input type="hidden" name="room_id" value="<?php echo $userRow['r_id']; ?>"/>
							<button class="btn btn-success" name="blockRoom">Block Room <i class='fa fa-lock'></i></button>
							</td>
              </form>
						 
            </tr>
			
			
            <?php
			//for each closes
               }
             ?>
			
			<?php
			//if closes	here		
			}
            ?>


			</tbody>
		</table>
		
		
		</div>	
	</div>	
</body>
</html>