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


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>


/* Float four columns side by side */
.column {
  float: left;
  width: 32%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding in columns */
.row {margin: 0 -5px;
background: linear-gradient(45deg, #49a09d, #5f2c82)
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
  height:450px;
}

/* Responsive columns - one column layout (vertical) on small screens */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
	
    display: block;
    margin-bottom: 20px;
  }
}



.container {
    padding-top: 20px;
    padding-bottom: 340px;
	height: 70%

}

datePick{
	padding-top: 20px;
    padding-bottom: 340px;
	padding-left: 50px;
	height: 50%;
	background: linear-gradient(45deg, #49a09d, #5f2c82)
}


.info{
	margin-top:20px;
	margin-bottom:10px;
}

.heading {
  padding: 10px;
  text-align: left;
  color: black;
  font-size: 25px;
  font-weight: bold;
}

.card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}

.card-title{
  color: #231961;
  font-size: 20px;
  font-weight: bold;
}

.card-text-desc{
	text-align:left;
	color:black;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container {
  padding: 2px 16px;
}
.price {
  color: grey;
  font-size: 22px;
}

</style>
</head>
<body>


  <div class="heading">View Room Details
  </div>

<div class="row">
  <div class="column">
    <div class="card">
	 <img class="card-img-top" src="./img/room_3.jpg" alt="Card image cap" height="180px" width="290px">
    <div class="card-body">
      <h5 class="card-title">Standard Room</h5>
	  <p class="price">7500 LKR</p>
      <p class="card-text-desc">
	  The Standard Room comprises of 1 Double Bed or 2 Twin Beds.
	  furnished with wall to wall carpeting, trendy furnishings and a balcony.
	  </p>
      <p class="card-text"><small class="text-muted">
	   Max person:
	  <i class='fa fa-male' style='font-size:26px'></i>
	  <i class='fa fa-male' style='font-size:26px'></i>
	  <i class='fa fa-child' style='font-size:16px'></i>
	  </small></p>
	  <div class="info">
	<a href="index.php?tab=standard_room"> <input type="button" value="See more >>" class="btn btn-info"></a>
	</div>
    </div>
	</div>
  </div>
  <div class="column">
    <div class="card">
	<img class="card-img-top" src="./img/room_1.jpg" alt="Card image cap" height="180px" width="290px">
    <div class="card-body">
      <h5 class="card-title">Deluxe Room</h5>
	  <p class="price">10500 LKR</p>
      <p class="card-text-desc">
	  The Delux Room comprises of 1 Double Bed or 2 Twin Beds. 
	  The room is furnished with wall to wall carpeting, trendy furnishings and a balcony
	  </p>
      <p class="card-text"><small class="text-muted">
	   Max person:
	  <i class='fa fa-male' style='font-size:26px'></i>
	  <i class='fa fa-male' style='font-size:26px'></i>
	  <i class='fa fa-child' style='font-size:16px'></i>
	  </small></p>
		<div class="info">
		<a href="index.php?tab=delux_room"> <input type="button" value="See more >>" class="btn btn-info"></a>
		</div>
    </div>
	</div>
  </div>
  <div class="column">
    <div class="card">
	<img class="card-img-top" src="./img/room_2.jpg" alt="Card image cap" height="180px" width="290px">
    <div class="card-body">
      <h5 class="card-title">Suite Room</h5>
	  <p class="price">25500 LKR</p>
      <p class="card-text-desc">
	  The Suite Room comprises of 1 Double Bed.
	  The room is furnished with wall to wall carpeting, trendy furnishings and a private patio.
	  </p>
	  <p class="card-text"><small class="text-muted" align="left">
	  Max person:
	  <i class='fa fa-male' style='font-size:26px'></i>
	  <i class='fa fa-male' style='font-size:26px'></i>
	  <i class='fa fa-male' style='font-size:26px'></i>
	  <i class='fa fa-child' style='font-size:16px'></i>
	  </small></p>
	  
	<div class="info">
	 <a href="index.php?tab=suite_room"> <input type="button" value="See more >>" class="btn btn-info"></a>
	</div>
    </div>
	
	</div>
  </div>

</div>


</body>
</html>