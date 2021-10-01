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
  <title>Report Summary</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  .heading {
  padding: 10px;
  text-align: left;
  color: black;
  font-size: 25px;
  font-weight: bold;
}

.tab-sub-heading{
	text-align:right;
	color: #231961;
	font-size: 15px;
	font-weight: bold;	
}

  </style>
</head>
<body>



  
  <div class="container">
  
<div class="container">

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">

        
            <div class="ibox-content forum-container">

                <div class="forum-title">
                    <div class="pull-right forum-desc">
                        <p class="tab-sub-heading">Total reservations:
						<?php
								$count =0;
								$sql = "SELECT booking_id From Booking";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo $count;
						?>
						</p>
                    </div>
					<div class="heading">Report Summary
					</div>
                </div>

                <div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-shield"></i>
                            </div>
                            <a href="forum_post.html" class="forum-item-title">Total Reservations</a>
                            <div class="forum-sub-title">confirmed, cancelled and awaited</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                              
							<?php
								$count =0;
								$sql = "SELECT booking_id From Booking WHERE book_status='confirmed'";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo $count;
							?>	
                            </span>
                            <div>
                                <p>Confirmed</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                
								<?php
								$count =0;
								$sql = "SELECT booking_id From Booking WHERE book_status='hold'";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo $count;
							?>
                            </span>
                            <div>
                                <p>Awaited</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                               
								<?php
								$count =0;
								$sql = "SELECT booking_id From Booking WHERE book_status='cancelled'";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo $count;
							?>
                            </span>
                            <div>
                                <p>Cancelled</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="forum-item">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-bolt"></i>
                            </div>
                            <a href="forum_post.html" class="forum-item-title">Reservations By Source</a>
                            <div class="forum-sub-title">type of reservations done</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                            <?php
								$count =0;
								$sql = "SELECT booking_id From Booking WHERE sourceType='website'";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo $count;
							?>
                            </span>
                            <div>
                                <p>Website</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                <?php
								$count =0;
								$sql = "SELECT booking_id From Booking WHERE sourceType='walk-in'";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo $count;
							?>
                            </span>
                            <div>
                                <p>Walk-in</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                <?php
								$count =0;
								$sql = "SELECT booking_id From Booking WHERE sourceType='by-call'";
								$result= mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($result))
								{	
								$count++;
								}
								echo $count;
							?>
                            </span>
                            <div>
                                <p>By call</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox-content m-b-sm border-bottom">
                <div class="p-xs">
                    
                    <h2>Generate Reports</h2>
					
                    <div class="pull-right m-r-md">
  
                    </div>

    
            <form method="POST" action="index.php?tab=view_report">
            <div class="row">
            <div class="col-25">
             
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
                <select  name="month" class = "form-control" required>
                    <option value="" selected="selected" disabled="">By month</option>
                    <option value='01'>January</option>
                    <option value='02'>February</option>
                    <option value='03'>March</option>
                    <option value='04'>April</option>
                    <option value='05'>May</option>
                    <option value='06'>June</option>
                    <option value='07'>July</option>
                    <option value='08'>August</option>
                    <option value='09'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
			    </select>
              </div>

              <div class="form-group col-md-4">
                <select  name="source" class = "form-control" required>
		            <option value="" selected="selected" disabled="">Type</option>
                    <option value="bySource">Monthly Reservation by Source Report</option>
                    <option value='byRoom'>Monthly Reservation Report</option>
			    </select>
              </div>
            </div>
			
			

            <div class="form-group col-md-4">
            <button class="btn btn-success" name="report"><i class="fa fa-file-text-o"></i> Generate Report</button>

            </div>


          </div>
            </form>    
                </div>
            </div>

            

            </div>
        </div>
    </div>
</div>
</div>

  



</body>
</html>