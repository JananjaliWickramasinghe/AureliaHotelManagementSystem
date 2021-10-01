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
  width: 100%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding in columns */
.row {margin: 0 -5px;
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
  height:600px;
  color:black;
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
td{
	text-align:left;
}
.card-title{
	text-align:left;
	font-size:25px;
	color: #231961;
	font-weight: bold;
}
.card-text-subhead{
	text-align:left;
	font-size:18px;
	color:black;
}
.tab-heading{
	font-size:25px;
	color: #231961;
}
.tab-desc{
	text-align:left;
}
.tab-sub-heading{
	text-align:left;
	color: #231961;
	font-size: 15px;  
}
p{
	text-align:left;
	color: black;
}

</style>
</head>
<body>

<div class="row">
   
  <div class="column">
    <div class="card">
		<div class="card-body">
			<h5 class="card-title">Standard Room</h5>
				<p class="card-text-subhead">Suite Room Amenties</p>
				<table class="table table-borderless">
				<tbody>
					<tr>			
						<td><i class="fa fa-bed"></i>  1 Double or 2 Single Beds</td>
						<td> <i class="fa fa-caret-right"></i> Individually Controlled A/C & Heating</td>
						<td><i class="fa fa-television"></i> flat screen TV</td>
					</tr>
					<tr>			
						<td><i class="fa fa-coffee"></i>  Tea & Coffee Facilities</td>
						<td><i class="fa fa-caret-right"></i>  Hairdryer</td>
						<td><i class="fa fa-caret-right"></i>  Iron & Ironing Board </td>
					</tr>
					<tr>
						<td><i class="fa fa-phone"></i> Telephone</td>
						<td><i class='fa fa-wifi'></i> Wifi</td>
					</tr>
					<tr>
						<td><i class='fa fa-caret-right'></i> Mini Bar</td>
						<td><i class='fa fa-lock'></i>  Electronic Lock Key System</td>
					</tr>
				</tbody>
				</table>
   
	</div>
	 <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">Room Description</a></li>
    <li><a data-toggle="pill" href="#menu1">Room Policies</a></li>
    <li><a data-toggle="pill" href="#menu2">Special Offers</a></li>
	</ul>
	  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3 class="tab-heading">Room Description</h3>
      <p class="tab-desc">The Standard Room comprises of 1 Double Bed or 2 Twin Beds,
	  2 Bedside Tables, a Desk & Chair. The room is furnished with wall to wall carpeting,
	  trendy furnishings and a balcony. Our ultramodern glass bathroom is equipped with hairdryer,
	  magnifying shaving and make up mirror as well as all the amenities you could possible need during your stay.
	A Complimentary Bottle of Wine, Fresh Fruit and Mineral Water, are provided on arrival. Electric current: 220 Volts. 
	Smoking rooms & inter-connecting rooms are also available.</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3 class="tab-heading">Room Policies</h3>
      <p class="tab-sub-heading">Meals</p>
			<p>Breakfast is included in the room rate<p>
		<p class="tab-sub-heading">Cancellation</p>
			<p>If cancelled 48 hours before date of arrival, no fee will be charged.
				If cancelled later the equivalent of 1 night’s stay will be charged. 
				In case of no-show, the total price of the reservation will be charged.</p>
		<p class="tab-sub-heading">Prepayment</p>
			<p>No deposit will be charged, however in order to validate your Credit Card,
				the amount equivalent to 1 Night Stay will be blocked in your account for approximately 1 week.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3 class="tab-heading">Special Offers</h3>
      <p>No offers yet</p>
    </div>
  </div>
	</div>
  </div>

</div>


</body>
</html>