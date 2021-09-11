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
                        <samll>Total reservations: 167</samll>
                    </div>
                    <h3>Report Summary</h3>
                </div>

                <div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-shield"></i>
                            </div>
                            <a href="forum_post.html" class="forum-item-title">Total Reservation</a>
                            <div class="forum-sub-title">Upto</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                1216
                            </span>
                            <div>
                                <p>Confirmed</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                368
                            </span>
                            <div>
                                <p>Awaited</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                140
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
                                890
                            </span>
                            <div>
                                <p>Website</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                120
                            </span>
                            <div>
                                <p>Walk-in</p>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                154
                            </span>
                            <div>
                                <p>On call</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox-content m-b-sm border-bottom">
                <div class="p-xs">
                    
                    <h2>Generate Reports</h2>
                    <div class="pull-right m-r-md">
  
                    </div>

    
            <form>
            <div class="row">
            <div class="col-25">
             
            </div>
            <div class="col-75">
              <div class="form-group col-md-4">
 
                <select  name="month" class = "form-control" required>
                    <option value="" selected="selected" disabled="">By month</option>
                    <option value='1'>January</option>
                    <option value='2'>February</option>
                    <option value='3'>March</option>
                    <option value='4'>April</option>
                    <option value='5'>May</option>
                    <option value='6'>June</option>
                    <option value='7'>July</option>
                    <option value='8'>August</option>
                    <option value='9'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
			    </select>
              </div>

              <div class="form-group col-md-4">
 
                <select  name="source" class = "form-control" required>
		            <option value="" selected="selected" disabled="">By source</option>
                    <option value='10'>cancelled</option>
                    <option value='10'>confirmed</option>
                    <option value='10'>On-call</option>
			    </select>
              </div>
            </div>

            <div class="form-group col-md-4">
            <button class="btn btn-success"><i class="fa fa-file-text-o"></i> Generate Report</button>

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