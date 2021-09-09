<?php
include "../connection.php";
$gotmonth=$_GET['selmonth'];

//$gotmonth = date("Y-m");
$gotmonth1 = "$gotmonth-01";
$gotmonth2 = "$gotmonth-31";

//$course_id = '5'; //del
$totalnewreg = 0;
$countx = 0;
//my queries
$menu = array();
$regisar = array();
$my_query54 = mysqli_query($con, "SELECT * FROM course where state='T' ") or die(mysqli_error($con));
while( $row54 = $my_query54->fetch_assoc() ){
extract($row54);
$menu[] = $row54['c_name'];

$course_idx = $course_id;
$course_namex = $c_name;
$countx = $countx +1;
//get new registrations
$newregis=0;
$my_query55 = mysqli_query($con, "SELECT * FROM student_course sc, student s, student_branch sb where s.std_id =sc.std_id and s.std_id=sb.std_id  and sc.course_id='$course_idx' and sc.sc_date BETWEEN '" . $gotmonth1 . "' AND  '" . $gotmonth2 . "' ") or die(mysqli_error($con));
while( $row55 = $my_query55->fetch_assoc() ){
extract($row55);
$newregis = $newregis + 1;
}
$regisar[] = $newregis;

$totalnewreg = $totalnewreg + $newregis;
//end new registrations

//echo "$course_namex";
//echo "$newregis";

}
//echo $menu;
//var_dump($menu);
//echo($countx);



//bar chart query
$branchnames = array();
//$mycourses = array();
//$incomepercourse = array();
//$incomepercb = array();
$totalperbranch = array();
$totalregisperbranch = array();
$bybranchtotal = array();
$my_query53 = mysqli_query($con, "SELECT * FROM branch") or die(mysqli_error($con));
while( $row53 = $my_query53->fetch_assoc() ){
extract($row53);
$branchnames[] = $row53['name'];

$branch_idx = $branch_id; //
//echo "$branch_idx";

/*
//get all courses

$my_query49 = mysqli_query($con, "SELECT * FROM course where state='T' ") or die(mysqli_error($con));
while( $row49 = $my_query49->fetch_assoc() ){
extract($row49);
$mycourses[] = $row49['c_name'];

$course_ida = $course_id;


//
$mypayment = 0;
$thatcourseinbranch = 0;
$totpaypercourseperbranch = 0;
$my_query52 = mysqli_query($con, "SELECT * FROM student s, student_course sc, branch b, student_branch sb where s.std_id=sb.std_id and s.std_id=sc.std_id and  b.branch_id=sb.branch_id and b.branch_id='$branch_idx' and sc.course_id = '$course_ida' ") or die(mysqli_error($con));
while( $row52 = $my_query52->fetch_assoc() ){
extract($row52);
//$course_idy = $course_id;
$std_idbranch = $std_id;
//$branch_idx = $branch_id;



$query99 = "SELECT * from payment_receipt where pr_std_id='$std_idbranch' and pr_course_id='$course_ida' and pr_date BETWEEN '" . $gotmonth1 . "' AND  '" . $gotmonth2 . "' "; //mnxx
$result99 = $con->query( $query99 );
$num_results99 = $result99->num_rows;
if( $num_results99 > 0)
{
while( $row99 = $result99->fetch_assoc() ){
extract($row99);
$mypayment = $mypayment+$payment;
}
}
$thatcourseinbranch = $thatcourseinbranch + $mypayment;

}
$totpaypercourseperbranch = $totpaypercourseperbranch + $thatcourseinbranch;

$incomepercourse[] = $totpaypercourseperbranch;

}
//echo "$totpaypercourseperbranch";
$incomepercb[] = $incomepercourse;
*/



//get all payments per branch
$paidAmx = 0;
$regTot = 0;
$my_query = mysqli_query($con, "SELECT * FROM payment_receipt pr,student s, student_branch sb where s.std_id =pr.pr_std_id and pr.pr_std_id=sb.std_id and sb.branch_id like '$branch_idx' and pr.pr_date BETWEEN '" . $gotmonth1 . "' AND  '" . $gotmonth2 . "' ") or die(mysqli_error($con));
while( $row22 = $my_query->fetch_assoc() ){
extract($row22);
$paidAmx = $paidAmx + $payment;
}
$totalperbranch[] = $paidAmx;
//$bybranchtotal [] = $totalperbranch;


$my_query21 = mysqli_query($con, "SELECT s.regFee FROM student s, student_branch sb,student_course sc where s.std_id=sb.std_id and s.std_id=sc.std_id and sb.branch_id like '$branch_idx'and  s.regDate BETWEEN '" . $gotmonth1 . "' AND  '" . $gotmonth2 . "' ") or die(mysqli_error($con));
while( $row21 = $my_query21->fetch_assoc() ){
extract($row21);
$regTot = $regTot + $regFee;
}
$totalregisperbranch[] = $regTot;
}
//$bybranchtotal [] = $totalregisperbranch;
//$resulttwo = array_merge($totalperbranch, $totalregisperbranch);
$bybranchtotalx = array($totalperbranch, $totalregisperbranch);

//var_dump($bybranchtotalx);
//var_dump($totalregisperbranch);
//var_dump($mycourses);

?>

<?php
require 'report_gen/chart_polar/ChartJS.php';
require 'report_gen/chart_polar/ChartJS_PolarArea.php';
require 'report_gen/chart_polar/ChartJS_Bar.php';

ChartJS::addDefaultColor(array('fill' => '#f2b21a', 'stroke' => '#e5801d', 'point' => '#e5801d', 'pointStroke' => '#e5801d'));
ChartJS::addDefaultColor(array('fill' => 'rgba(28,116,190,.8)', 'stroke' => '#1c74be', 'point' => '#1c74be', 'pointStroke' => '#1c74be'));
ChartJS::addDefaultColor(array('fill' => 'rgba(212,41,31,.7)', 'stroke' => '#d4291f', 'point' => '#d4291f', 'pointStroke' => '#d4291f'));
ChartJS::addDefaultColor(array('fill' => '#dc693c', 'stroke' => '#ff0000', 'point' => '#ff0000', 'pointStroke' => '#ff0000'));
ChartJS::addDefaultColor(array('fill' => 'rgba(46,204,113,.8)', 'stroke' => '#2ecc71', 'point' => '#2ecc71', 'pointStroke' => '#2ecc71'));
ChartJS::addDefaultColor(array('fill' => '#f2b21a', 'stroke' => '#e5801d', 'point' => '#e5801d', 'pointStroke' => '#e5801d'));
ChartJS::addDefaultColor(array('fill' => 'rgba(28,116,190,.8)', 'stroke' => '#1c74be', 'point' => '#1c74be', 'pointStroke' => '#1c74be'));
ChartJS::addDefaultColor(array('fill' => 'rgba(212,41,31,.7)', 'stroke' => '#d4291f', 'point' => '#d4291f', 'pointStroke' => '#d4291f'));
ChartJS::addDefaultColor(array('fill' => '#dc693c', 'stroke' => '#ff0000', 'point' => '#ff0000', 'pointStroke' => '#ff0000'));
ChartJS::addDefaultColor(array('fill' => 'rgba(46,204,113,.8)', 'stroke' => '#2ecc71', 'point' => '#2ecc71', 'pointStroke' => '#2ecc71'));

//$array_values = array(array(65, 59, 80, 81, 56, 55, 40), array(28, 48, 40, 19, 86, 27, 90));
//$array_labels = array("January", "February", "March", "April", "May", "June", "July","August","Sep");

//$array_myval = array("65", "59", "80", "81", "56", "55", "40", "20");

$PolarArea = new ChartJS_PolarArea('example_polararea', 500, 500);
/*
$PolarArea->addSegment(65);
$PolarArea->addSegment(59);
$PolarArea->addSegment(95);
$PolarArea->addSegment(81);
$PolarArea->addSegment(56);
$PolarArea->addSegment(15);
$PolarArea->addSegment(40);
$PolarArea->addSegment(20);
*/


for ($x = 0; $x < $countx; $x++) {
	ChartJS::addDefaultColor(array('fill' => 'rgba(46,204,113,.8)', 'stroke' => '#2ecc71', 'point' => '#2ecc71', 'pointStroke' => '#2ecc71'));
    //echo "The number is: $regisar[$x] <br>";
	$PolarArea->addSegment($regisar[$x]);
}


$PolarArea->addLabels($menu);


//end polar chart

//bar chart branch wise course fee 's
//del
//$array_values = array(array(65, 59, 80, 81, 56, 55, 40, 23), array(28, 48, 40, 19, 86, 27, 90,23), array(128, 48, 40, 19, 86, 27, 90,43));
//$array_labels = array("January", "February", "March", "April", "May", "June", "July","Aug");

$Bar = new ChartJS_Bar('example_bar', 500, 500);
//$Bar->addBars($array_values[0]);
//$Bar->addBars($array_values[1]);
//$Bar->addBars($bybranchtotalx[0]);
$Bar->addBars($bybranchtotalx[0]);
$Bar->addBars($bybranchtotalx[1]);
//$Bar->addBars($totalregisperbranch[0]);

$Bar->addLabels($branchnames);

?>
<!DOCTYPE html>
<html lang="en">
  <head>

  </head>

  <body class="nav-md">
<br><br>
<button type="button" class="btn btn-info" onClick="document.location.href='index.php?tab=report_gen_monthly'">Go Back</button>

<div class="clearfix"></div>

<div class="x_content">
<h1>Branches Income from Courses and Registration</h1>
<?php
echo $Bar

?>
<p>Yellow -> Course Fee Total</p>
<p>Blue -> Registration Fee Total</p>
</div>

<div class="x_content">
<h1>Course vs Total Registrations Per Month</h1>
<?php
echo $PolarArea
?>
</div>



<script src="report_gen/chart_polar/Chart.js"></script>
<script src="report_gen/chart_polar/chart.js-php.js"></script>
<script>
    (function () {
        loadChartJsPhp();
    })();
</script>

  </body>
</html>