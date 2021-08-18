<!DOCTYPE html>
<html lang="en">
  <head>
   
  
  </head>

  <body class="nav-md">
  <div class="clearfix"></div>
			<!--
			<p> magics</p>
			-->
			<?php 
  $D = exec('date /T');
  $T = exec('time /T');
  $DT = strtotime(str_replace("/","-",$D." ".$T));
  //echo(date("H:i:s",$DT));
?>
			

       
<div>

 <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Report Generation</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Payment</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Registration</a>
                          </li>
						   <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Branch/Course Management</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
								<br>
								   <div>
								<p>&nbsp;</p>
								<p align="center" style="font-size:20px">Report Generate (Daily,Monthly,Selected Time Period)/ Get Summary / Get Charts </p>
							   </div>
								
								
							<h2><b>About Report Generate</b></h2>
							
							<p style="color:black;font-size:15px">
							1) Choose From is the Start date you need to see your reports from.
							<br><br>
							2) Choose To is the Final date of the reports you want to see.
							<br><br>
							3) All Branches means you will get all the students doing the selected course in all the branches and their payment activity on the selected time period.
							<br><br>
							4) All Courses means you will get students doing all the courses on the selected branch and their payment activity on the selected time period.
							<br><br>
							5) You can view complete (which includes all 3 payment types), full payment plans , installment plans, and special installment plans can be viewed as required.
							<br><br>
							6) Generate Report Monthly Includes special featuers such as a complete summary overview of the month.
							<br><br>
							7) In this you will get the complete income for the selected month both from courses and registration and from each branch the appropriate percentage that will take. (optionally can select course/branch) 
							<br><br>
							8) Summary Chart will show the courses and their new registration for the selected month and income (from registrations/courses) from each branch as a chart.
							<br><br>
							9) Get by student enables to search for a student either by the name or nic and it will show a detailed view of student's payment information and all the detailed receipts of student payments issued.
							<br><br>
							
							
							</p>
							
							
							
							
							
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                               <div>
								<p>&nbsp;</p>
								<p align="center" style="font-size:20px">Payment/ Alter Discounts/ Approve-Reject Discounts</p>
							   </div>
							   
							   <h2><b>About Payment</b></h2>
							
							<p style="color:black;font-size:15px">
							1) Just after a new registration to a course
						On the Payment Tab, type the student's nic and get the previous details of the students. this includes number of courses student has done earliyer and if the student is registered under a group which will help determing the discount he is going to get.
						<br>
						*Do use the latest updated documents to see the eligible amount of discount percentage that student should get.
						<br><br>
						2) If the given discount is higher than 20% of the course fee, manager level permission will be required to make the payment go through.
						Manager can either approve or reject using View Approvals interface. (give no discount/give the maximum discount possible according to the given reason)
							<br><br>
							
							3) For some reason, if the given discount needed to be changed,this can be done using the alter discount page. This excludes students who have already completed their payment.
							
								<br><br>
								
								4) First time after student is registered, search using the nic on the payment interface and you can add them to the desired payment plan.
									<br><br>
								Option 1)
								Full Payment -> The student must complete the payment at once.
									<br><br>
								Option 2)
								Installment Payment -> Student can pay a installment first and pay as the course goes on. 
								There are certain amounts of payments to be completed as the installments go on.
								(if course duration is 6 months, by 2 months students should have completed the first installment which is usually around 1/3rd of the total fee) 
									<br><br>
								Option 3)
								Special Plan -> By default this will output a course fee doubled as ordinary due to the special reasons. Normally this option will not be taken unless in special cases like student want to complete a 6 month course in 2 months due to personal reasons.
									<br><br>
								5) Once Started Paying using above methods, your options will be changed to pay a installment to pay the remaining payments.
										<br><br>

						
							<br><br>
				
							<br><br>
							
							
							</p>
							   
							   

							
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
						   
						   <div>
								<p>&nbsp;</p>
								<p align="center" style="font-size:20px">New Registrations/ Edit Student Details/ Add to new courses/Create a group</p>
							   </div>
							   
						<h2><b>About Registration</b></h2>
							
							<p style="color:black;font-size:15px">
							1) If the student has done courses with cadd center previously, use menu Registered Student under Registration and add the student to the new course.
							<br>
							*No need of a registration fee again.
						    <br><br>
							2) If a new student comes to register to a course, proceed with Individual tab under registration. NIC is the primary key of the system so make sure that it is correct before submiting. Fill all the required details and add the branch and registering course from the select menu and add the registration fee also. Registration date is automatically set to the current date and can be changed if needed.
						    <br><br>
							3) If needed to update student details use Update Student tab. from this window, you can see a list of students on your branch and also can search by nic of a student to update by the search box.
						    <br><br>
							4) To create a new group of students, first students must be registered as individuals. After that create the group from the Group tab. You will get a group id and after selecting the course and branch you can create the group. Then add the members to that group as required.
						    <br><br>
						
				
							<br><br>
							
							
							</p>
						   
							  
                          </div>
						  
						  <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                          	 		   <div>
								<p>&nbsp;</p>
								<p align="center" style="font-size:20px">Course Management / Branch Management/ User Management</p>
							   </div>
							   
						<h2><b>About Management of the system</b></h2>
							
							<p style="color:black;font-size:15px">
							1) Course details like duration, fee and installments can be edited using this page and also can add a new course to the system.
						    <br><br>
							2) Manage branch offers the ability to add a new branch or edit branch details such as the percentage of income taken by the cadd center.
						    <br><br>
							3) Manage Admin can be used to add a new user to the system as well as to edit and remove existing user.
						    <br> <br>
								A new user can be added with 3 different levels.<br>
							     a) Basic (Level 3) - Only can perform basic tasks like registering a student/ handling payment.<br>
								 b) Branch Manager (Level 2) - Can do tasks of basic and can approve/reject discounts and alter discounts of the students.<br>
								 c) Top Level (Level 1) - Can generate reports as required and can see the overall income from the branches in a detailed manner and can add new users delete users and manage branche details and course details.<br>
						
				
							<br><br>
							
							
							</p>

							  
                          </div>
						  
                        </div>
						 </div>
						 
						 
						  </div>
                   


	   
	   

  </body>
</html>