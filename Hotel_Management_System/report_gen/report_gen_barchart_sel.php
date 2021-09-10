<?php

	include("../connection.php");
	 	
?>

<html>
<head>

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap-3.3.6.css">
	   <link rel="stylesheet" href="css/bootstrap-theme.min.css">
	   <link rel="stylesheet" href="css/bootstrap-theme.css">
	    <script src="js/bootstrap.min.js"></script>
	   <script src="js/npm.js"></script>

	   <script src="js/jquery-1.11.3.min.js"></script>

    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/bootstrap.min.js"></script>
	  <link href="css/bootstrap.min.css" rel="stylesheet">
	   <link rel="stylesheet" href="css/datepicker.css">
	   	<script src="js/chosen.jquery.js"></script>
	<script src="js/chosen.jquery.min.js"></script>
	<script src="js/chosen.proto.min.js"></script>
	<link href="css/chosen.min.css" rel="stylesheet">
	<link href="css/chosen.css" rel="stylesheet">
	
	
	

	<script src="js/bootstrap-datepicker.js"></script>
	   <link href="css/bootstrap.min.css" rel="stylesheet">
  
<title>Bar Chart</title>


<style>
body{
     background-repeat:no-repeat;
	 background-size:100%;
background:#5F9EA0; font: 16px Georgia, serif;}
.deleteLink
{
	text-decoration:underline;
	color:blue;
}
.deleteLink:hover
{
	cursor:pointer;
	text-decoration:none;
}
 /* Remove the navbar's default margin-bottom and rounded borders */
 .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    

    
 ul li { 
         margin-left : 100%;
         text-align: left;
       list-style-type : none;
       margin : 0 0 0 0;
      

       }
	 
.tab { margin :5% 0 0 5%; }
     
	       
 footer {          position : absolute;
			       width : 100%;
			      padding: 25px;
			       background-color:#202121;
				   margin : 40% 0 0 0;
		   }
#side-menu {
	          height : 150%;
			 width : 12%;
	           margin : 0 0 0 -15px;
			   background-color:#202121;
		 }
	#side-menu li {
		              
		              color : white;
	}	 
	table.db-table 		{ border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center; }
table.db-table th	{ background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; text-align:center;}
table.db-table td	{ padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc;  text-align:center;}

	
</style>

</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../index.php?tab=report_gen_home">Bar Chart Student Registration Count / Date</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../index.php?tab=report_gen_home">Home</a></li>
       
      </ul>
   
    </div>
  </div>
</nav>

	  
<div class = "tab">
<h2>Bar Chart</h2>
  <div id="chart-container">Bar Chart will render here</div>
  <script src="js/jquery-2.1.4.js"></script>
  <script src="js/fusioncharts.js"></script>
  <script src="js/fusioncharts.charts.js"></script>
  <script src="themes/fusioncharts.theme.zune.js"></script>
  <script type="text/javascript">
  $(function() {
    $.ajax({

        url: 'report_gen_barchart_sel_chartdata.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Max Registered Students ",
                "xAxisName": "Date",
                "yAxisName": "Number of Students Registered",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '1200',
                height: '400',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
});
</script>
  

</div>
</body>
</html>