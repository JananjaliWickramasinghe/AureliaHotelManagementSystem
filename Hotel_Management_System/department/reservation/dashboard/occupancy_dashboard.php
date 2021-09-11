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
  <title>Occupancy Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
</head>
<body>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total checkins</h6>
                    <h2 class="text-right"><i class="fa fa-sign-in f-left"></i><span>486</span></h2>
                    <p class="m-b-0">Check-ins<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Checkouts</h6>
                    <h2 class="text-right"><i class="fa fa-sign-out f-left"></i><span>486</span></h2>
                    <p class="m-b-0">Check-outs<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total In-house guest count</h6>
                    <h2 class="text-right"><i class="fa fa-suitcase f-left"></i><span>486</span></h2>
                    <p class="m-b-0">In-house<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Rooms available</h6>
                    <h2 class="text-right"><i class="fa fa-hotel f-left"></i><span>486</span></h2>
                    <p class="m-b-0">Rooms<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
	</div>
</div>



</body>
</html>