<!DOCTYPE html>
<html lang="en">
  <head>

  <script src="report_gen/js/jquery-1.12.4.js"></script>
  <script src="report_gen/js/jquery-ui.js"></script>

  	<link rel="stylesheet" href="report_gen/css/datepicker.css">
	<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#item').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });

			 $(document).ready(function () {
                
                $('#item22').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });	
			
			$(document).ready(function () {
                
                $('#item23').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
			
			$(document).ready(function () {
                
                $('#item24').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
			
			$(document).ready(function () {
                
                $('#item85').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
			
			$(document).ready(function () {
                
                $('#item86').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });

			
	</script>

	<script src="report_gen/js/bootstrap-datepicker.js"></script>

  
  </head>

  <body class="nav-md">



            <div class="clearfix"></div>

			
			<!--
			<p> magics</p>
			-->
                       
 <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Students</span>
              <div class="count"> 
<?php 


$query3="select count(std_id) as sys from student";
$result = mysqli_query($con, $query3);
while($rows=mysqli_fetch_array($result))
{
$mag=$rows['sys'];
}
echo "$mag";
?>
</div>
              <span class="count_bottom"><i class="green">
			  <?php 
$todayis = date("Y-m-d");
$lastweek = date ("Y-m-d", strtotime ($todayis ."-7 days"));

$query3="select count(std_id) as sys from student where regDate>='$lastweek' ";
$result = mysqli_query($con, $query3);
while($rows=mysqli_fetch_array($result))
{
$mag=$rows['sys'];
}
echo "$mag";
?>

</i> From last Week</span>
</div>
			
			   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Courses</span>
              <div class="count">
			  <?php 
$query3="select count(course_id) as sys from course where state='T'";
$result = mysqli_query($con, $query3);
while($rows=mysqli_fetch_array($result))
{
$mag=$rows['sys'];
}
echo "$mag";
?>
			  
			  </div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> 
			  			  <?php 
$query3="select count(course_id) as sys from course where state='F'";
$result = mysqli_query($con, $query3);
while($rows=mysqli_fetch_array($result))
{
$mag=$rows['sys'];
}
echo "$mag";
?>
			  
			  </i>Updated courses </span>
            </div>
			
			
			
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Payments Handled Today</span>
              <div class="count">
				  <?php 
$todayis = date("Y-m-d");
$lastweek = date ("Y-m-d", strtotime ($todayis ."-7 days"));

$query3="select count(pay_id) as sys from payment where pay_date='$todayis' ";
$result = mysqli_query($con, $query3);
while($rows=mysqli_fetch_array($result))
{
$mag=$rows['sys'];
}
echo "$mag";
?>		  
			  
			  
			  </div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"> </i>
			  <?php 
$todayis = date("Y-m-d");
$lastweek = date ("Y-m-d", strtotime ($todayis ."-7 days"));

$query3="select count(pay_id) as sys from payment where pay_date>='$lastweek' ";
$result = mysqli_query($con, $query3);
while($rows=mysqli_fetch_array($result))
{
$mag=$rows['sys'];
}
echo "$mag";
?>
			  </i>
From last week
			  </span>
            </div>
			
			
			
			
			</div>
					

 
 
 <nav class="navbar navbar-default">
 <h2>Export Report For The Selected Time Period By Any</h2>
 
<ul class="nav nav-pills">
 			 
	  <form class="navbar-form navbar-left" method="post" action="report_gen/report_gen_excel_selec_timeP_bybranch_bycourse.php" id="myForm91" name="myForm91">
        <div class="form-group">
<?php 
//select menu_section course
$sql22="SELECT course_id, c_name from course where state='T'";
$sql = mysqli_query($con, $sql22);		
if(mysqli_num_rows($sql)){
$select= '<select name="item88" id="item88" class="select2_single form-control" tabindex="-1" form="myForm91">';
$select.='<option value="%">ALL COURSES</option>';
while($rs=mysqli_fetch_array($sql)){
      $select.='<option value="'.$rs['course_id'].'">'.$rs['c_name'].'</option>';
  }
}
$select.='</select>';
echo $select;		
?>
		
<?php 
//select menu_section branch
$sql22="SELECT branch_id, name from branch";
$sql = mysqli_query($con, $sql22);
if(mysqli_num_rows($sql)){
$select= '<select name="item83" id="item83" class="select2_single form-control" tabindex="-1" form="myForm91">';
$select.='<option value="%">ALL BRANCHES</option>';
while($rs=mysqli_fetch_array($sql)){
      $select.='<option value="'.$rs['branch_id'].'">'.$rs['name'].'</option>';
  }
}
$select.='</select>';
echo $select;		
?>
<br><br>	
		
		
		</div><div>
		
         <input type="text" class="form-control" name="item23" id="item23" placeholder="Choose From..." form="myForm91"  \>
		 <input type="text" class="form-control" name="item24" id="item24" placeholder="Choose To..." form="myForm91"  value="<?php echo date("Y-m-d"); ?>"  \>
        </div>
		<br>
					
						   <input type="submit" name="export_complete" class="btn btn-success" value="Export Complete" form="myForm91"/>
						   <input type="submit" name="export_viewhalfPay" class="btn btn-primary" value="Export Installment" form="myForm91"/>
						   <input type="submit" name="export_viewfullPay" class="btn btn-primary" value="Export Fullpaid" form="myForm91"/>
						   <input type="submit" name="export_SPCPay" class="btn btn-primary" value="Export SpecialPayments " form="myForm91"/>
						   <input type="submit" name="export_viewsummary" class="btn btn-primary" value="Export Summary" form="myForm91"/>

      </form>
	  
</ul>
</nav>



	  <br>
<br/>
<!--del2-->
			


    <!-- jQuery
    <script src="../vendors/jquery/dist/jquery.min.js"></script> -->

  </body>
</html>
