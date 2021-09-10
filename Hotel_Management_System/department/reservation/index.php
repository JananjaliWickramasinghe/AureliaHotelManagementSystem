<?php
	include("../../check.php");	
	include("../../connection.php");

	if(isset($_SESSION['profileimg'])){
		
		$profileimg="<img src='Admin/M_ADMIN/users_profile_images/".$_SESSION['profileimg']."' alt='profile pic'>";	
		
	}else {
		
	  $profileimg='<img src="img/adminn.png" alt="profile pic">';	
		
	}
	
?>
<?php
if (empty($_GET)) {
  $t='';
}else{
	if($_GET['tab']!=''){
		$t= $_GET['tab'];
	}else if($_GET['tab']=NULL){
		$t='';		
  }
}
$msg="";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <link rel="icon" type="image/png" href="favicon.jpg">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | <?php echo $_SESSION['username'];?> </title>
    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
	  <script src="../../report_gen/js/jquery-1.12.4.js"></script>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php?tab=home" class="site_title"></i> <span><center><img src="logo/logo5.png" width="138"  class="md md-album"/> </center></span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="index.php?tab=home"><i class="fa fa-home"></i> Main <span class=""></span></a>
				          </li>
                   <li><a><i class="fa fa-edit"></i>Users<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?tab=manageusers">Manage Users</a></li>
                      <li><a href="index.php?tab=createnewuser">Create New User</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i>Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					            <li><a href="index.php?tab=report_gen_monthly">Get Full Report</a></li>
                      <li><a href="index.php?tab=report_gen_home">Report Generate Main</a></li>
                      <li><a href="index.php?tab=report_gen_daily">Get per Day Report</a></li>
                      <li><a href="index.php?tab=report_gen_search_std">Get by Student</a></li>
                      <li><a href="report_gen/report_gen_barchart_sel.php">View Chart</a></li>
                    </ul>
                  </li>
				          <li><a href="index.php?tab=payment_home"><i class="fa fa-table"></i> Settings <span class=""></span></a></li>    
                </ul>
              </div>
            </div>

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   <?php echo $profileimg;?>  <?php echo $login_name;?> (<?php echo $login_user;?>)
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="index.php?tab=profile"> Profile</a></li>
                    <li><a href="index.php?tab=helpdesk"> Help</a></li>
                    <li><a href="../../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="clearfix">
                   <?php  
                    if ((empty($_GET)) or ($t=='home')) {
                        include "dashboard/index.php";
                      }else if ($t=='manageusers'){
                        include "dashboard/table.php";
                      } else if ($t=='createnewuser'){
                        include "dashboard/create_new_user.php";                  
                      } 
                      
                    ?>
                    </div>
                    <br>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            AURALIA HOTELS (PVT) LTD. 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery 
    <script src="vendors/jquery/dist/jquery.min.js"></script>-->
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
 
    
  </body>
</html>