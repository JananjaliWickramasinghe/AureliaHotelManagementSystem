

<html>
 <head>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
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
 
    <div class="row">
     <form method="post" action="export.php">
      <div class="input-daterange">
       <div class="col-md-4">
        <input type="text" name="start_date" class="form-control" readonly />
        
       </div>
       <div class="col-md-4">
        <input type="text" name="end_date" class="form-control" readonly />
       
       </div>
      </div>
      <div class="col-md-2">
       <input type="submit" name="export" value="Export" class="btn btn-info" />
      </div>
     </form>
    </div>
    <br />
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Booking ID</th>
       <th>Guest Name</th>
       <th>Room type</th>
       <th>Check in</th>
       <th>Check out</th>
      </tr>
     </thead>
     <tbody>
    	  
	  <?php 
                $projects = array();
                $res=mysqli_query($conn,"SELECT * FROM Booking ");
				
                while ($userRow=mysqli_fetch_array($res,MYSQLI_ASSOC))
                {
                    $projects[] = $userRow;
                }
                foreach ($projects as $userRow)
                {
            ?>
			
			<tr>
            
                          <td><?php echo $userRow['booking_id']; ?></th>
                          <td><?php echo $userRow['guest_id']; ?></td>
                          <td><?php echo $userRow['room_id']; ?></td>
                          <td><?php echo $userRow['checkin']; ?></td>
                          <td><?php echo $userRow['checkout']; ?></td>
            
						 
            </tr>
			
			
            <?php
			//for each closes
               }
             ?>
     </tbody>
    </table>
    <br />
    <br />
   </div>
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });
});

</script>