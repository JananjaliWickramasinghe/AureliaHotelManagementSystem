<?php
	include '../connection.php';
	
$mydate2 = $_POST['item86'];
$mydate1 = $_POST['item86'];
$mydate3 = $_POST['item86'];
$branch22 = $_POST['item83'];
$course22 = $_POST['item88'];

//and sc.course_id like '$course22' and sb.branch_id like '$branch22'

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
  </head>

  <body class="nav-md">
    
			
			<!-- new new new -->
			 <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>CADD CENTER - REPORT<small>Student Payment Information</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
               
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
					
<?php

if(isset($_POST["viewhalfPay"]))   
{
	

					
                echo "    <div class='clearfix'></div>";
               echo "   </div>";
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'> Report $mydate2 to $mydate1 - Installment Plans </p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                     echo "   <tr>";
                     echo "     <th>Student ID</th>";
                     echo "     <th>Student Name</th>";
                     echo "     <th>NIC</th>";
                      echo "    <th>Course Name</th>";
                      echo "    <th>Discount</th>";
                      echo "    <th>Total Amount to be Paid</th>";
					echo "	  <th>Registration Date</th>";
					echo " <th>Branch</th>";
					echo "	  <th>Last Pay Date</th>";
					echo "	  <th>Installment 1</th>";
						echo "  <th>Installment 2</th>";
						echo "  <th>Installment 3</th>";
						  echo " <th>Remaining Balance</th>";
                        echo "</tr>";
                      echo "</thead>";
					  
					
					 echo "<tbody>";




//and pi.l_pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "'
	//fixx
// 
//student_branch sb, branch b,
//s.std_id = sb.std_id and sb.branch_id=b.branch_id
//  echo " <th>Branch</th>";
//echo "<td>{$name}</td>";





		$query = "SELECT * FROM student s, payment p, payment_installment pi,course c,student_course sc, student_branch sb, branch b, course_installment ci where s.std_id = sb.std_id and sb.branch_id=b.branch_id and sc.course_id=p.course_id and s.std_id=p.std_id and s.std_id=sc.std_id and sc.course_id=c.course_id and s.std_id=pi.std_id and sc.course_id=pi.course_id and sc.course_id=ci.course_id and p.type='HalfPay' and pi.l_pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' and sc.course_id like '$course22' and sb.branch_id like '$branch22' order by b.name asc , p.course_id  ";


//fix brn
//and sc.course_id like '$course22' and sb.branch_id like '$branch22'
$result = $con->query( $query );

//get number of rows returned

$num_results = $result->num_rows;
$remainingBal=0;
$totIns1 = 0;
$totIns2 = 0;
$totIns3 = 0;

//stylesheet to display colors accordingly
echo "<style>
		.lowerthan100{
 background-color:red;
 color:white;   
}
.higherthan100{
 background-color:white;   
 color:red;
}
 .lowert{
 background-color:blue;
 color:white;   
 }
 .fullcomplete{
 background-color:LimeGreen;
 color:black;   
 }
 .instnotstarted{
 background-color:GreenYellow;
 color:black;   
 }
 .needattention{
 background-color:OrangeRed;
 color:black;   
 }
 .pastdue{
 background-color:red;
 color:white;   
 }
 .stillpaying{
 background-color:Yellow;
 color:black;   
 }
 .installmentcomplete{
 background-color:LightGreen;
 color:black;   
 }
 
</style>";

if( $num_results > 0)
{ //it means there's already a database record


//loop to show each records

		
while( $row = $result->fetch_assoc() ){

//extract row



extract($row);

//creating new table row per record

echo "<tr>";

echo "<td>{$std_id}</td>";

echo "<td>{$fname}  {$lname}</td>";

echo "<td>{$nic}</td>";

echo "<td>{$c_name}</td>";

echo "<td>{$discount}</td>";

echo "<td>{$tot_amount}</td>";

echo "<td>{$regDate}</td>";

echo "<td>{$name}</td>";

echo "<td>{$l_pay_date}</td>";

//



$remainingBal=$tot_amount - ($installment_1+$installment_2+$installment_3);
$totIns1 = $totIns1 + $installment_1;
$totIns2 = $totIns2 + $installment_2;
$totIns3 = $totIns3 + $installment_3;

//should check course duration /3 + regdate not exceed 
//course duration in months -> convert to days
//calculate the installment due dates
//$month = 6;
//$month = $duration;
$month = $course_dur; //changed to adapt to special durations
$days = $month * 30;               //CHANGEEEE  150;//

$daysPerInstallment = (int)($days/3);;
$daysPerInstallment2 = $daysPerInstallment * 2;
$daysPerInstallment3 = $daysPerInstallment * 3;
//echo $daysPerInstallment3;

$dbdate = $sc_date; //$today = date ("Y-m-d");
$duedateIns1 = date ("Y-m-d", strtotime ($dbdate ."+$daysPerInstallment days"));
$duedateIns2 = date ("Y-m-d", strtotime ($dbdate ."+$daysPerInstallment2 days"));
$duedateIns3 = date ("Y-m-d", strtotime ($dbdate ."+$daysPerInstallment3 days"));
$todayis = date("Y-m-d"); //current date


	if(strtotime($todayis) < strtotime($duedateIns1))
{
	//in time period of 1st installment
	/*
	echo $month;
	echo "<br/>";
	echo " $dbdate";
	echo "<br/>";
	echo " $duedateIns2";*/
	
	if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='stillpaying'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

echo "<td class='instnotstarted'>{$installment_2}</td>";
echo "<td class='instnotstarted'>{$installment_3}</td>";

echo "<td class='stillpaying'>{$remainingBal}</td>";

}

if(((strtotime($todayis) > strtotime($duedateIns1)) && strtotime($todayis) <= strtotime($duedateIns2)) && (strtotime($todayis) < strtotime($duedateIns3)))
{
	//in the time period of 2nd installment
	
if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

if($installment_2<$installment_02) //installement studentpaid< installment set to that course
{
	echo "<td class='stillpaying'>{$installment_2}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_2}</td>";
}


echo "<td class='instnotstarted'>{$installment_3}</td>";	
	
echo "<td class='stillpaying'>{$remainingBal}</td>";	
}

if(((strtotime($todayis) > strtotime($duedateIns1)) && strtotime($todayis) > strtotime($duedateIns2)) && (strtotime($todayis) <= strtotime($duedateIns3)))
{
	//in the time period of final installment
	
	if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

if($installment_2<$installment_02) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_2}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_2}</td>";
}
	
	
if($installment_3<($tot_amount -($installment_1+$installment_2))) //installement studentpaid< installment set to that course
{
	echo "<td class='stillpaying'>{$installment_3}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_3}</td>";
}

//check balance finally
if($remainingBal<=0)
{
echo "<td class='fullcomplete'>{$remainingBal}</td>";	
}
else
{
echo "<td class='stillpaying'>{$remainingBal}</td>";
}	
}


if((strtotime($todayis) > strtotime($duedateIns3)))
{
	//need attention course over
	if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

if($installment_2<$installment_02) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_2}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_2}</td>";
}
	
	
//if($installment_3<$installment_03) //installement studentpaid< installment set to that course

if($installment_3<($tot_amount -($installment_1+$installment_2)))

{
	echo "<td class='needattention'>{$installment_3}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_3}</td>";
}

//check balance finally
if($remainingBal<=0)
{
echo "<td class='fullcomplete'>{$remainingBal}</td>";	
}
else
{
echo "<td class='pastdue'>{$remainingBal}</td>";
}

}

echo "</tr>";



}
//end of while

       echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
		    echo " </div>";

echo "<br/> <br/>";
//color information

             echo "<div class='clearfix'></div>";
             echo "</div>";
             echo "<div class='x_content'>";
           //  echo "<p class='text-muted font-13 m-b-30'> Color Information</p>";
             echo "<table id='datatable' class='table table-striped table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>COLOR INFORMATION</th>";
echo "</tr>";

echo "</thead>";
echo "<tbody>";


echo "<tr>";
echo "<td class='instnotstarted'>Installment not Started</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='stillpaying'>Still Paying</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='installmentcomplete'>Installment Complete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='fullcomplete'>Full Complete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='needattention'>Need Attention</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='pastdue'>Payment Past Due</td>";
echo "</tr>";

echo "</thead>";
echo "</table>";
}

else
{
 //echo "NO RECORDS FOUND FOR SELECTED DATE";	
 echo "<script>alert('NO RECORDS FOUND FOR SELECTED TIME PERIOD'); window.location.href = 'index.php?tab=report_gen_daily'; </script>";
}
 


/*
//
echo "</table>";

echo "<br/> <br/>";

//
$perday = 0;



echo "<table>";
//

//new query to get payments received per that day
$query22 = "SELECT * FROM student s, course c, student_course sc, payment_receipt pr where s.std_id=sc.std_id and sc.course_id=c.course_id  and s.std_id=pr.pr_std_id and pr.pr_date='".$mydate2."'  ";

		//and pi.l_pay_date=pr.pr_date   , payment_receipt pr

$result22 = $con->query( $query22 );
$num_results22 = $result22->num_rows;

if( $num_results22 > 0)
{ 
		
//
echo "CADD CENTER - REPORT PER DAY";
echo "CADD CENTER - DAILY INCOME FROM ALL COURSES";

echo "<tr>";

echo "<th>NIC</th>";
echo "<th>Course Name</th>";
echo "<th>Payment</th>";

echo "<th>Date</th>";

echo "</tr>";

//loop to show each records

while( $row2 = $result22->fetch_assoc() ){

//extract row



extract($row2);

//creating new table row per record

echo "<tr>";

echo "<td>{$nic}</td>";
echo "<td>{$c_name}</td>";
echo "<td>{$payment}</td>";
echo "<td>{$pr_date}</td>";
$perday = $perday + $payment;

echo "</tr>";

}


}



echo "</table>";

echo "<br/> <br/>";
echo "TOTAL SUMMARY - $pr_date ";
echo "<br/> <br/>";
echo "Income for the day from all the courses for $pr_date   : $perday";


echo "<table>";




echo "<br/> <br/>";
//color information
//
echo "$totIns1";
echo "$totIns2";
echo "$totIns3";
echo "<br/> <br/>";
echo "Color Information";
echo "<br/> <br/>";
echo "<tr>";
echo "<td class='stillpaying'>still paying</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='installmentcomplete'>installmentcomplete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='fullcomplete'>fullcomplete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='instnotstarted'>instnotstarted</td>";
echo "</tr>";


echo "<tr>";
echo "<td class='needattention'>needattention</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='pastdue'>pastdue</td>";
echo "</tr>";


      }	*/

}


if(isset($_POST["viewfullPay"]))   
{
					
                echo "    <div class='clearfix'></div>";
               echo "   </div>";
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'> Report $mydate2 to $mydate1 - Full Payment Plans</p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                     echo "   <tr>";
                     echo "     <th>Student ID</th>";
                     echo "     <th>Student Name</th>";
                     echo "     <th>NIC</th>";
                      echo "    <th>Course Name</th>";
                      echo "    <th>Discount</th>";
                      echo "    <th>Course Fee excludes Discount</th>";
					echo "	  <th>Registration Date</th>";
					echo " <th>Branch</th>";
					echo "	  <th>Pay Date</th>";
					echo "	  <th>Paid Amount</th>";
						  echo " <th>Remaining Balance</th>";
                        echo "</tr>";
                      echo "</thead>";
					  
					
					 echo "<tbody>";
				
					   

//fix
//
//
//
//  
//


		$query = "SELECT * FROM student s, payment p, student_branch sb, branch b, course c,student_course sc, course_installment ci,payment_receipt pr where sc.course_id=p.course_id and  s.std_id = sb.std_id and sb.branch_id=b.branch_id and s.std_id=p.std_id and s.std_id=sc.std_id and sc.course_id=c.course_id and s.std_id=pr.pr_std_id and sc.course_id=pr.pr_course_id and sc.course_id=ci.course_id and p.type='FullPay' and p.pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "'  and sc.course_id like '$course22' and sb.branch_id like '$branch22' order by b.name asc , p.course_id ";



$result = $con->query( $query );

//get number of rows returned

$num_results = $result->num_rows;
$remainingBal=0;
$paidAm = 0;


//stylesheet to display colors accordingly
echo "<style>
		.lowerthan100{
 background-color:red;
 color:white;   
}
.higherthan100{
 background-color:white;   
 color:red;
}
 .lowert{
 background-color:blue;
 color:white;   
 }
 .fullcomplete{
 background-color:LimeGreen;
 color:black;   
 }
 .instnotstarted{
 background-color:GreenYellow;
 color:black;   
 }
 .needattention{
 background-color:OrangeRed;
 color:black;   
 }
 .pastdue{
 background-color:red;
 color:white;   
 }
 .stillpaying{
 background-color:Yellow;
 color:black;   
 }
 .installmentcomplete{
 background-color:LightGreen;
 color:black;   
 }
 
</style>";

if( $num_results > 0)
{ //it means there's already a database record


//loop to show each records

		
while( $row = $result->fetch_assoc() ){
$paidAm = 0;

//extract row

extract($row);

//creating new table row per record

echo "<tr>";

echo "<td>{$std_id}</td>";

echo "<td>{$fname}  {$lname}</td>";

echo "<td>{$nic}</td>";

echo "<td>{$c_name}</td>";

echo "<td>{$discount}</td>";

echo "<td>{$course_fee}</td>";

echo "<td>{$regDate}</td>";

echo "<td>{$name}</td>";

echo "<td>{$pay_date}</td>";

//magic

$my_query = mysqli_query($con, "SELECT * FROM payment_receipt where pr_std_id='$std_id' and pr_course_id='$course_id'") or die(mysqli_error($con));

/*
$query22 = "SELECT * FROM payment_receipt where pr_std_id='$std_id' and pr_course_id='$course_id' ";
$result22 = $con->query( $query22 );
$num_results22 = $result22->num_rows;
if( $num_results22 > 0)
{
	*/
while( $row22 = $my_query->fetch_assoc() ){
extract($row22);
$paidAm = $paidAm + $payment;

}

//}

//
//$paidAm = $payment;
$remainingBal=$tot_amount - ($paidAm);

//should check course duration /3 + regdate not exceed 
//course duration in months -> convert to days
//calculate the installment due dates
//$month = 6;
//$month = $duration;
$month = $course_dur; //changed to adapt to special durations
$days = $month * 30;               //CHANGEEEE  150;//

$daysuntilEnd  = (int)($days);


$dbdate = $sc_date; //$today = date ("Y-m-d");
$duedateFinal = date ("Y-m-d", strtotime ($dbdate ."+$daysuntilEnd days"));

$todayis = date("Y-m-d"); //current date


	if(strtotime($todayis) < strtotime($duedateFinal))
{
	if($paidAm<$tot_amount)
{
	echo "<td class='stillpaying'>{$paidAm}</td>";
	echo "<td class='stillpaying'>{$remainingBal}</td>";
}
else
{
	echo "<td class='fullcomplete'>{$paidAm}</td>";
	echo "<td class='fullcomplete'>{$remainingBal}</td>";
}
}

	else
{
	if($paidAm<$tot_amount)
{
	echo "<td class='needattention'>{$paidAm}</td>";
	echo "<td class='needattention'>{$remainingBal}</td>";
}
else
{
	echo "<td class='fullcomplete'>{$paidAm}</td>";
	echo "<td class='fullcomplete'>{$remainingBal}</td>";
}
}
echo "</tr>";

}
//end of while

       echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
		    echo " </div>";

echo "<br/> <br/>";
//color information

             echo "<div class='clearfix'></div>";
             echo "</div>";
             echo "<div class='x_content'>";
           //  echo "<p class='text-muted font-13 m-b-30'> Color Information</p>";
             echo "<table id='datatable' class='table table-striped table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>COLOR INFORMATION</th>";
echo "</tr>";

echo "</thead>";
echo "<tbody>";

echo "<tr>";
echo "<td class='instnotstarted'>Installment not Started</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='stillpaying'>Still Paying</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='installmentcomplete'>Installment Complete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='fullcomplete'>Full Complete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='needattention'>Need Attention</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='pastdue'>Payment Past Due</td>";
echo "</tr>";

echo "</thead>";
echo "</table>";
}

else
{
 //echo "NO RECORDS FOUND FOR SELECTED DATE";	
 echo "<script>alert('NO RECORDS FOUND FOR SELECTED TIME PERIOD'); window.location.href = 'index.php?tab=report_gen_daily'; </script>";
}
 
}


if(isset($_POST["viewsummary"]))   
{
					
                			
                echo "    <div class='clearfix'></div>";
               echo "   </div>";
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'> INCOME FROM ALL ACTIVE COURSES - SUMMARY</p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                    
                     
					  
					echo "<tr>";


echo "<th>Course Name</th>";
echo "<th>Received Amount</th>";

echo "<th>Last Payment Received Date</th>";

echo "</tr>";
 echo "</thead>";
					 echo "<tbody>";



//and pi.l_pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "'

//get number of rows returned


$remainingBal=0;
$totIns1 = 0;
$totIns2 = 0;
$totIns3 = 0;

$perday = 0;


//new query to get payments received per that day
/*
$query22 = "SELECT * FROM course c, payment_receipt pr where c.state='T' and c.course_id=pr.pr_course_id and pr.pr_date <= '$mydate2'  ";
*/

$query22 = "SELECT * FROM course c where c.state='T' ";

/*
$query22 = "SELECT * FROM student s, course c, student_course sc, payment_receipt pr where s.std_id=sc.std_id and sc.course_id=c.course_id  and s.std_id=pr.pr_std_id and c.state='T' and pr.pr_date <= '$mydate2'  ";
*/



$result22 = $con->query( $query22 );
$num_results22 = $result22->num_rows;

if( $num_results22 > 0)
{ 
		

//loop to show each records

while( $row2 = $result22->fetch_assoc() ){

//extract row


extract($row2);

//creating new table row per record

echo "<tr>";


echo "<td>{$c_name}</td>";
//echo "<td>{$payment}</td>";

//$perday = $perday + $payment;

$paidAm=0;

//and sc.course_id like '$course22' and sb.branch_id like '$branch22'

$my_query = mysqli_query($con, "SELECT * FROM payment_receipt pr,student s, student_branch sb where s.std_id =pr.pr_std_id and pr.pr_std_id=sb.std_id and sb.branch_id like '$branch22' and pr.pr_course_id='$course_id' and pr.pr_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' ") or die(mysqli_error($con));

while( $row22 = $my_query->fetch_assoc() ){
extract($row22);

$paidAm = $paidAm + $payment;

}

echo "<td>{$paidAm}</td>";
echo "<td>{$mydate3}</td>";



//
echo "</tr>";

}

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
		    echo " </div>";


/*
echo "<br/> <br/>";
echo "TOTAL SUMMARY - $pr_date ";
echo "<br/> <br/>";
echo "Income for the day from all the courses : $perday";

*/

}
else
{ //echo "NO RECORDS FOUND FOR SELECTED TIME PERIOD";	
 echo "<script>alert('NO RECORDS FOUND FOR SELECTED DATE'); window.location.href = 'index.php?tab=report_gen_daily'; </script>";
}
}

//view summary final
if(isset($_POST["viewby"]))   
{
				


//and pi.l_pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "'

echo "<style>
		.lowerthan100{
 background-color:red;
 color:white;   
}
.higherthan100{
 background-color:white;   
 color:red;
}
 .lowert{
 background-color:blue;
 color:white;   
 }
 .fullcomplete{
 background-color:LimeGreen;
 color:black;   
 }
 .instnotstarted{
 background-color:GreenYellow;
 color:black;   
 }
 .needattention{
 background-color:OrangeRed;
 color:black;   
 }
 .pastdue{
 background-color:red;
 color:white;   
 }
 .stillpaying{
 background-color:Yellow;
 color:black;   
 }
 .installmentcomplete{
 background-color:LightGreen;
 color:black;   
 }
 
</style>";



//$mydate2 = '2017-08-04';


//get number of rows returned


$remainingBal=0;
$totIns1 = 0;
$totIns2 = 0;
$totIns3 = 0;

$perday = 0;


//new query to get payments received per that day
/*
$query22 = "SELECT * FROM course c, payment_receipt pr where c.state='T' and c.course_id=pr.pr_course_id and pr.pr_date <= '$mydate2'  ";
*/

$query22 = "SELECT * FROM course c where c.state='T' and course_id like '$course22' ";

/*
$query22 = "SELECT * FROM student s, course c, student_course sc, payment_receipt pr where s.std_id=sc.std_id and sc.course_id=c.course_id  and s.std_id=pr.pr_std_id and c.state='T' and pr.pr_date <= '$mydate2'  ";
*/



$result22 = $con->query( $query22 );
$num_results22 = $result22->num_rows;

if( $num_results22 > 0)
{ 
      echo "    <div class='clearfix'></div>";
               echo "   </div>";
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'>SUMMARY FOR SELECTED MONTH</p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                    
                     
					  
					echo "<tr>";


echo "<th>Course Name</th>";
echo "<th>Received Amount</th>";

echo "<th>As of Date</th>";

echo "</tr>";
 echo "</thead>";
					 echo "<tbody>";		

//loop to show each records

$totalF = 0;

while( $row2 = $result22->fetch_assoc() ){

//extract row


extract($row2);

//creating new table row per record

echo "<tr>";


echo "<td>{$c_name}</td>";
//echo "<td>{$payment}</td>";

//$perday = $perday + $payment;

$paidAm=0;

//
/*
$my_query = mysqli_query($con, "SELECT * FROM payment_receipt where pr_course_id='$course_id' and pr_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' ") or die(mysqli_error($con));
*/
$my_query = mysqli_query($con, "SELECT * FROM payment_receipt pr,student s, student_branch sb where s.std_id =pr.pr_std_id and pr.pr_std_id=sb.std_id and sb.branch_id like '$branch22'and pr.pr_course_id='$course_id' and pr.pr_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' ") or die(mysqli_error($con));


while( $row22 = $my_query->fetch_assoc() ){
extract($row22);

$paidAm = $paidAm + $payment;

}

echo "<td>{$paidAm}</td>";
echo "<td>{$mydate3}</td>";

$totalF = $totalF + $paidAm;

//
echo "</tr>";

}
echo "<tr>";
echo "<td class='instnotstarted'>TOTAL</td>";
echo "<td class='instnotstarted'>{$totalF}</td>";
echo "<td class='instnotstarted'>{$mydate3}</td>";
echo "</tr>";


            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
		    echo " </div>";


/*
echo "<br/> <br/>";
echo "TOTAL SUMMARY - $pr_date ";
echo "<br/> <br/>";
echo "Income for the day from all the courses : $perday";

*/

}
else
{ //echo "NO RECORDS FOUND FOR SELECTED DATE";	
 echo "<script>alert('NO RECORDS FOUND FOR SELECTED DATE'); window.location.href = 'index.php?tab=report_gen_daily'; </script>";
}
}

if(isset($_POST["viewSPC"]))   
{	


echo "<style>
		.lowerthan100{
 background-color:red;
 color:white;   
}
.higherthan100{
 background-color:white;   
 color:red;
}
 .lowert{
 background-color:blue;
 color:white;   
 }
 .fullcomplete{
 background-color:LimeGreen;
 color:black;   
 }
 .instnotstarted{
 background-color:GreenYellow;
 color:black;   
 }
 .needattention{
 background-color:OrangeRed;
 color:black;   
 }
 .pastdue{
 background-color:red;
 color:white;   
 }
 .stillpaying{
 background-color:Yellow;
 color:black;   
 }
 .installmentcomplete{
 background-color:LightGreen;
 color:black;   
 }
 
</style>";

//fixx
//REPORT FOR THE SELECTED TIME PERIOD -- $mydate2 to $mydate1
//student_branch sb, branch b,
//s.std_id = sb.std_id and sb.branch_id=b.branch_id and sc.course_id=p.course_id and 
//  echo " <th>Branch</th>";
//echo "<td>{$name}</td>";
//order by b.name asc , p.course_id 	
//and sc.course_id like '$course22' and sb.branch_id like '$branch22'
$query = "SELECT * FROM student s, payment p, course c, student_branch sb, branch b, student_course sc where s.std_id = sb.std_id and sb.branch_id=b.branch_id and sc.course_id=p.course_id and s.std_id=p.std_id and p.type='SPC' and s.std_id=sc.std_id and sc.course_id=c.course_id and p.pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' and sc.course_id like '$course22' and sb.branch_id like '$branch22' order by b.name asc , p.course_id  ";

//and p.pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' 

$result = $con->query( $query );

//get number of rows returned

$num_results = $result->num_rows;
$remainingBal=0;
$paidAm = 0;


if( $num_results > 0)
	{ //it means there's already a database record
echo "    <div class='clearfix'></div>";
	echo "</div>";
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'> CADD CENTER - REPORT FOR THE SELECTED TIME PERIOD $mydate2 to $mydate1 SPECIAL PLANS</p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                     echo "   <tr>";
                     echo "     <th>Student ID</th>";
                     echo "     <th>Student Name</th>";
                     echo "     <th>NIC</th>";
                      echo "    <th>Course Name</th>";
                      echo "    <th>Discount</th>";
                      echo "    <th>Course Fee NEW</th>";
					echo "	  <th>Registration Date</th>";
					echo " <th>Branch</th>";
					echo "	  <th>Pay Date</th>";
					echo "	  <th>Paid Amount</th>";
						  echo " <th>Remaining Balance</th>";
                        echo "</tr>";
                      echo "</thead>";
					  
					
					 echo "<tbody>";


		
while( $row = $result->fetch_assoc() ){


//extract row

extract($row);

//creating new table row per record

echo "<tr>";

echo "<td>{$std_id}</td>";

echo "<td>{$fname}  {$lname}</td>";

echo "<td>{$nic}</td>";

echo "<td>{$c_name}</td>";

echo "<td>{$discount}</td>";

echo "<td>{$tot_amount}</td>";

echo "<td>{$regDate}</td>";

echo "<td>{$name}</td>";

echo "<td>{$pay_date}</td>";

//magic

	


//loop to show each records
$paidAm = 0;
$my_query = mysqli_query($con, "SELECT * FROM payment_receipt where pr_std_id='$std_id' and pr_course_id='$course_id'") or die(mysqli_error($con));
while( $row22 = $my_query->fetch_assoc() ){
extract($row22);
$paidAm = $paidAm + $payment;
}
$newam = $tot_amount - $paidAm;
echo "<td>{$paidAm}</td>";
if($newam==0)
echo "<td class='fullcomplete'>{$newam}</td>";
else
echo "<td class='stillpaying'>{$newam}</td>";



echo "</tr>";

}
//end of while

       echo "</tbody>";
            echo "</table>";
            echo "</div>";
}


if(!(( $num_results > 0)))
{
 //echo "NO RECORDS FOUND FOR SELECTED DATE";	
 echo "<script>alert('NO RECORDS FOUND FOR SELECTED TIME PERIOD'); window.location.href = 'index.php?tab=report_gen_daily'; </script>";
}					
}

if(isset($_POST["viewcomplete"]))   
{	

//and pi.l_pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "'
	
//stylesheet to display colors accordingly
echo "<style>
		.lowerthan100{
 background-color:red;
 color:white;   
}
.higherthan100{
 background-color:white;   
 color:red;
}
 .lowert{
 background-color:blue;
 color:white;   
 }
 .fullcomplete{
 background-color:LimeGreen;
 color:black;   
 }
 .instnotstarted{
 background-color:GreenYellow;
 color:black;   
 }
 .needattention{
 background-color:OrangeRed;
 color:black;   
 }
 .pastdue{
 background-color:red;
 color:white;   
 }
 .stillpaying{
 background-color:Yellow;
 color:black;   
 }
 .installmentcomplete{
 background-color:LightGreen;
 color:black;   
 }
 
</style>";
//fixx
//sc.course_id=p.course_id and 
//student_branch sb, branch b,
//s.std_id = sb.std_id and sb.branch_id=b.branch_id
//  echo " <th>Branch</th>";
//echo "<td>{$name}</td>";
//order by b.name asc , p.course_id 

		$query = "SELECT * FROM student s, payment p, course c, student_branch sb, branch b, student_course sc, course_installment ci,payment_receipt pr where s.std_id = sb.std_id and sb.branch_id=b.branch_id and s.std_id=p.std_id and s.std_id=sc.std_id and sc.course_id=p.course_id and sc.course_id=c.course_id and s.std_id=pr.pr_std_id and sc.course_id=pr.pr_course_id and sc.course_id=ci.course_id and p.pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' and p.type='FullPay' and sc.course_id like '$course22' and sb.branch_id like '$branch22' order by b.name asc , p.course_id  ";


$result = $con->query( $query );

//get number of rows returned

$num_results = $result->num_rows;
$remainingBal=0;
$paidAm = 0;


if( $num_results > 0)
	
{ //it means there's already a database record
echo "    <div class='clearfix'></div>";
              
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'>Report $mydate2 to $mydate1 - Full Payment Plans</p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                     echo "   <tr>";
                     echo "     <th>Student ID</th>";
                     echo "     <th>Student Name</th>";
                     echo "     <th>NIC</th>";
                      echo "    <th>Course Name</th>";
                      echo "    <th>Discount</th>";
                      echo "    <th>Course Fee excludes Discount</th>";
					echo "	  <th>Registration Date</th>";
					  echo " <th>Branch</th>";
					echo "	  <th>Pay Date</th>";
					echo "	  <th>Paid Amount</th>";
						  echo " <th>Remaining Balance</th>";
						
                        echo "</tr>";
                      echo "</thead>";
					  
					
					 echo "<tbody>";






//loop to show each records

		
while( $row = $result->fetch_assoc() ){
$paidAm = 0;

//extract row

extract($row);

//creating new table row per record

echo "<tr>";

echo "<td>{$std_id}</td>";

echo "<td>{$fname}  {$lname}</td>";

echo "<td>{$nic}</td>";

echo "<td>{$c_name}</td>";

echo "<td>{$discount}</td>";

echo "<td>{$course_fee}</td>";

echo "<td>{$regDate}</td>";

echo "<td>{$name}</td>";

echo "<td>{$pay_date}</td>";

//magic

$my_query = mysqli_query($con, "SELECT * FROM payment_receipt where pr_std_id='$std_id' and pr_course_id='$course_id'") or die(mysqli_error($con));

/*
$query22 = "SELECT * FROM payment_receipt where pr_std_id='$std_id' and pr_course_id='$course_id' ";
$result22 = $con->query( $query22 );
$num_results22 = $result22->num_rows;
if( $num_results22 > 0)
{
	*/
while( $row22 = $my_query->fetch_assoc() ){
extract($row22);
$paidAm = $paidAm + $payment;

}

//}

//
//$paidAm = $payment;
$remainingBal=$tot_amount - ($paidAm);

//should check course duration /3 + regdate not exceed 
//course duration in months -> convert to days
//calculate the installment due dates
//$month = 6;
//$month = $duration;
$month = $course_dur; //changed to adapt to special durations
$days = $month * 30;               //CHANGEEEE  150;//

$daysuntilEnd  = (int)($days);


$dbdate = $sc_date; //$today = date ("Y-m-d");
$duedateFinal = date ("Y-m-d", strtotime ($dbdate ."+$daysuntilEnd days"));

$todayis = date("Y-m-d"); //current date


	if(strtotime($todayis) < strtotime($duedateFinal))
{
	if($paidAm<$tot_amount)
{
	echo "<td class='stillpaying'>{$paidAm}</td>";
	echo "<td class='stillpaying'>{$remainingBal}</td>";
}
else
{
	echo "<td class='fullcomplete'>{$paidAm}</td>";
	echo "<td class='fullcomplete'>{$remainingBal}</td>";
}
}

	else
{
	if($paidAm<$tot_amount)
{
	echo "<td class='needattention'>{$paidAm}</td>";
	echo "<td class='needattention'>{$remainingBal}</td>";
}
else
{
	echo "<td class='fullcomplete'>{$paidAm}</td>";
	echo "<td class='fullcomplete'>{$remainingBal}</td>";
}
}
echo "</tr>";

}
//end of while

       echo "</tbody>";
            echo "</table>";
            echo "</div>";
       
        

echo "<br/> <br/>";
	
	
}
	

	
	
	////////////////////////////////////////////////////////////////////////////////
					
     //
//
//  
//  

					 
					 

$query99 = "SELECT * FROM student s, payment p, student_branch sb, branch b, payment_installment pi,course c,student_course sc, course_installment ci where s.std_id = sb.std_id and sb.branch_id=b.branch_id and s.std_id=p.std_id and s.std_id=sc.std_id and sc.course_id=c.course_id and sc.course_id=p.course_id and s.std_id=pi.std_id and sc.course_id=pi.course_id and sc.course_id=ci.course_id and pi.l_pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' and p.type='HalfPay' and sc.course_id like '$course22' and sb.branch_id like '$branch22' order by b.name asc , p.course_id  ";



$result99 = $con->query( $query99 );

//get number of rows returned

$num_results99 = $result99->num_rows;
$remainingBal=0;
$totIns1 = 0;
$totIns2 = 0;
$totIns3 = 0;


if( $num_results99 > 0)
	{ //it means there's already a database record
         echo "    <div class='clearfix'></div>";
               echo "   </div>";
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'> Report $mydate2 to $mydate1 - Installment Plans</p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                     echo "   <tr>";
                     echo "     <th>Student ID</th>";
                     echo "     <th>Student Name</th>";
                     echo "     <th>NIC</th>";
                      echo "    <th>Course Name</th>";
                      echo "    <th>Discount</th>";
                      echo "    <th>Total Amount to be Paid</th>";
					echo "	  <th>Registration Date</th>";
					echo " <th>Branch</th>";
					echo "	  <th>Last Pay Date</th>";
					echo "	  <th>Installment 1</th>";
						echo "  <th>Installment 2</th>";
						echo "  <th>Installment 3</th>";
						  echo " <th>Remaining Balance</th>";
                        echo "</tr>";
                      echo "</thead>";
					  
					
					 echo "<tbody>";



//loop to show each records

		
while( $row99 = $result99->fetch_assoc() ){

//extract row



extract($row99);

//creating new table row per record

echo "<tr>";

echo "<td>{$std_id}</td>";

echo "<td>{$fname}  {$lname}</td>";

echo "<td>{$nic}</td>";

echo "<td>{$c_name}</td>";

echo "<td>{$discount}</td>";

echo "<td>{$tot_amount}</td>";

echo "<td>{$regDate}</td>";

echo "<td>{$name}</td>";

echo "<td>{$l_pay_date}</td>";

//



$remainingBal=$tot_amount - ($installment_1+$installment_2+$installment_3);
$totIns1 = $totIns1 + $installment_1;
$totIns2 = $totIns2 + $installment_2;
$totIns3 = $totIns3 + $installment_3;

//should check course duration /3 + regdate not exceed 
//course duration in months -> convert to days
//calculate the installment due dates
//$month = 6;
//$month = $duration;
$month = $course_dur; //changed to adapt to special durations
$days = $month * 30;               //CHANGEEEE  150;//

$daysPerInstallment = (int)($days/3);;
$daysPerInstallment2 = $daysPerInstallment * 2;
$daysPerInstallment3 = $daysPerInstallment * 3;
//echo $daysPerInstallment3;

$dbdate = $sc_date; //$today = date ("Y-m-d");
$duedateIns1 = date ("Y-m-d", strtotime ($dbdate ."+$daysPerInstallment days"));
$duedateIns2 = date ("Y-m-d", strtotime ($dbdate ."+$daysPerInstallment2 days"));
$duedateIns3 = date ("Y-m-d", strtotime ($dbdate ."+$daysPerInstallment3 days"));
$todayis = date("Y-m-d"); //current date


	if(strtotime($todayis) < strtotime($duedateIns1))
{
	//in time period of 1st installment
	/*
	echo $month;
	echo "<br/>";
	echo " $dbdate";
	echo "<br/>";
	echo " $duedateIns2";*/
	
	if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='stillpaying'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

echo "<td class='instnotstarted'>{$installment_2}</td>";
echo "<td class='instnotstarted'>{$installment_3}</td>";

echo "<td class='stillpaying'>{$remainingBal}</td>";

}

if(((strtotime($todayis) > strtotime($duedateIns1)) && strtotime($todayis) <= strtotime($duedateIns2)) && (strtotime($todayis) < strtotime($duedateIns3)))
{
	//in the time period of 2nd installment
	
if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

if($installment_2<$installment_02) //installement studentpaid< installment set to that course
{
	echo "<td class='stillpaying'>{$installment_2}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_2}</td>";
}


echo "<td class='instnotstarted'>{$installment_3}</td>";	
	
echo "<td class='stillpaying'>{$remainingBal}</td>";	
}

if(((strtotime($todayis) > strtotime($duedateIns1)) && strtotime($todayis) > strtotime($duedateIns2)) && (strtotime($todayis) <= strtotime($duedateIns3)))
{
	//in the time period of final installment
	
	if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

if($installment_2<$installment_02) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_2}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_2}</td>";
}
	
	
if($installment_3<($tot_amount -($installment_1+$installment_2))) //installement studentpaid< installment set to that course
{
	echo "<td class='stillpaying'>{$installment_3}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_3}</td>";
}

//check balance finally
if($remainingBal<=0)
{
echo "<td class='fullcomplete'>{$remainingBal}</td>";	
}
else
{
echo "<td class='stillpaying'>{$remainingBal}</td>";
}	
}


if((strtotime($todayis) > strtotime($duedateIns3)))
{
	//need attention course over
	if($installment_1<$installment_01) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_1}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_1}</td>";
}

if($installment_2<$installment_02) //installement studentpaid< installment set to that course
{
	echo "<td class='needattention'>{$installment_2}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_2}</td>";
}
	
	
//if($installment_3<$installment_03) //installement studentpaid< installment set to that course

if($installment_3<($tot_amount -($installment_1+$installment_2)))

{
	echo "<td class='needattention'>{$installment_3}</td>";
}
else
{
	echo "<td class='installmentcomplete'>{$installment_3}</td>";
}

//check balance finally
if($remainingBal<=0)
{
echo "<td class='fullcomplete'>{$remainingBal}</td>";	
}
else
{
echo "<td class='pastdue'>{$remainingBal}</td>";
}

}

echo "</tr>";



}
//end of while

       echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
		    echo " </div>";


}

//special student
$query20 = "SELECT * FROM student s, payment p, course c, student_branch sb, branch b, student_course sc where s.std_id = sb.std_id and sb.branch_id=b.branch_id and sc.course_id=p.course_id and s.std_id=p.std_id and p.type='SPC' and s.std_id=sc.std_id and sc.course_id=c.course_id and p.pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' and sc.course_id like '$course22' and sb.branch_id like '$branch22'  order by b.name asc , p.course_id  ";

//and p.pay_date BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' 

$result20 = $con->query( $query20 );

//get number of rows returned

$num_results20 = $result20->num_rows;
$remainingBal=0;
$paidAm = 0;


if( $num_results20 > 0)
	{ //it means there's already a database record
echo "    <div class='clearfix'></div>";
	echo "</div>";
             echo "     <div class='x_content'>";
            echo "<p class='text-muted font-13 m-b-30'> CADD CENTER - REPORT FOR THE SELECTED TIME PERIOD $mydate2 to $mydate1 SPECIAL PLANS</p>";
               echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                     echo "   <tr>";
                     echo "     <th>Student ID</th>";
                     echo "     <th>Student Name</th>";
                     echo "     <th>NIC</th>";
                      echo "    <th>Course Name</th>";
                      echo "    <th>Discount</th>";
                      echo "    <th>Course Fee NEW</th>";
					echo "	  <th>Registration Date</th>";
					echo " <th>Branch</th>";
					echo "	  <th>Pay Date</th>";
					echo "	  <th>Paid Amount</th>";
						  echo " <th>Remaining Balance</th>";
                        echo "</tr>";
                      echo "</thead>";
					  
					
					 echo "<tbody>";


		
while( $row = $result20->fetch_assoc() ){


//extract row

extract($row);

//creating new table row per record

echo "<tr>";

echo "<td>{$std_id}</td>";

echo "<td>{$fname}  {$lname}</td>";

echo "<td>{$nic}</td>";

echo "<td>{$c_name}</td>";

echo "<td>{$discount}</td>";

echo "<td>{$tot_amount}</td>";

echo "<td>{$regDate}</td>";

echo "<td>{$name}</td>";

echo "<td>{$pay_date}</td>";

//magic

	


//loop to show each records
$paidAm = 0;
$my_query = mysqli_query($con, "SELECT * FROM payment_receipt where pr_std_id='$std_id' and pr_course_id='$course_id'") or die(mysqli_error($con));
while( $row22 = $my_query->fetch_assoc() ){
extract($row22);
$paidAm = $paidAm + $payment;
}
$newam = $tot_amount - $paidAm;
echo "<td>{$paidAm}</td>";
if($newam==0)
echo "<td class='fullcomplete'>{$newam}</td>";
else
echo "<td class='stillpaying'>{$newam}</td>";



echo "</tr>";

}
//end of while

       echo "</tbody>";
            echo "</table>";
            echo "</div>";
	}
//del spc 

if((( $num_results > 0) || ( $num_results99 > 0)))
{
	
echo "<br/> <br/>";
//color information

             echo "<div class='clearfix'></div>";
            
             echo "<div class='x_content'>";
           //  echo "<p class='text-muted font-13 m-b-30'> Color Information</p>";
             echo "<table id='datatable' class='table table-striped table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>COLOR INFORMATION</th>";
echo "</tr>";

echo "</thead>";
echo "<tbody>";


echo "<tr>";
echo "<td class='instnotstarted'>Installment not Started</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='stillpaying'>Still Paying</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='installmentcomplete'>Installment Complete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='fullcomplete'>Full Complete</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='needattention'>Need Attention</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='pastdue'>Payment Past Due</td>";
echo "</tr>";



echo "</tbody>";
echo "</table>";
echo "</div>";

}


if(!(( $num_results > 0) || ( $num_results99 > 0)))
//else
{
 //echo "NO RECORDS FOUND FOR SELECTED DATE";	
 echo "<script>alert('NO RECORDS FOUND FOR SELECTED TIME PERIOD'); window.location.href = 'index.php?tab=report_gen_daily'; </script>";
}
						
}	
?>
						
						

  </body>
</html>