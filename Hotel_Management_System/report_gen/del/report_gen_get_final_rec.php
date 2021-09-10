<?php

 $totalreg = $_POST['totalreg'];
 $totalam = $_POST['totalam'];
 $fromallregcourse = $_POST['fromallregcourse'];
 $fromcourseper = $_POST['fromcourseper'];
 $fromregper = $_POST['fromregper'];
 $remaingafterper = $_POST['remaingafterper'];
 
 $todayis = date("Y-m-d");
 $today = date("Y-m-d h:i:sa");  
 
 $realTot =  $totalreg + $totalam;
 
 $invoiceNum = date("dm");
// echo $remaingafterper;
?>
<!DOCTYPE html>
<html lang="en">
  <head>

	  	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
      <link rel="stylesheet" href="css/bootstrap-3.3.6.css">
  
  
	   <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap-theme.min.css">

	   <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap-theme.css">
	    <script src="js/bootstrap.min.js"></script>
	   <script src="js/npm.js"></script>
	  

<!--	  <script src="js/in.js"></script>-->

    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
   
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	
	<title>CADD - SUMMARY MONTHLY</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />

	<script type='text/javascript' src='js/example.js'></script>
    <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	
	  
  </head>

  <body class="nav-md">

            <div class="clearfix"></div>

			<!--
			<p> magics</p>
			-->
                       
 <div id="page-wrap">

		<textarea id="header">CADD - MONTHLY INVOICE</textarea>
		
		<div id="identity">
		
            <textarea id="address">
CADD CENTRE
Methodist Central Building, 
02nd Floor,252, Galle Road, 
Colombo 03.
Phone : +94-11-5338500
Fax   : +94-11-5338501
</textarea>

            <div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="../../images/caddcentrepng.png" alt="logo"  width="540px" height="100px" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title">CADD Center Monthly from branches.</textarea>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea><?php echo $invoiceNum; ?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date">December 15, 2009</textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due"><?php echo $fromallregcourse; ?></div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		     <th>No</th>
		      <th>Type</th>
		      <th>Description</th>
			     <th>Total Amount</th>
		      <th>Percentage Calculated</th>
		  </tr>
		  
		  <tr class="item-row">
		   <td><textarea class="qty">1</textarea></td>
		      <td class="item-name"><div class="delete-wpr"><textarea>Registration</textarea>
			  <!--<a class="delete" href="javascript:;" title="Remove row">X</a>-->
			  </div></td>
		      <td class="description"><textarea>Monthly from Registrations </textarea></td>
			  <td><textarea class="cost"><?php echo $totalreg; ?></textarea></td>
		      <td><span class="price"><?php echo $fromregper; ?></span></td>
		  </tr>
		  
		  <tr class="item-row">
		     <td><textarea class="qty">2</textarea></td>
		      <td class="item-name"><div class="delete-wpr"><textarea>Course Fee</textarea>
			  <!--<a class="delete" href="javascript:;" title="Remove row">X</a>-->
			  </div></td>
		      <td class="description"><textarea>Monthly from Course Fee</textarea></td>
              <td><textarea class="cost"><?php echo $totalam; ?></textarea></td>
		      <td><span class="price"><?php echo $fromcourseper; ?></span></td>
		  </tr>
		  
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total LKR</td>
		      <td class="total-value"><div id="total"><?php echo $realTot; ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Kept LKR</td>

		      <td class="total-value"><textarea id="paid"><?php echo $remaingafterper; ?></textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due LKR</td>
		      <td class="total-value balance"><div class="due"><?php echo $fromallregcourse; ?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>NOTICE</h5>
		  <textarea>This is a computer generated payment summary on <?php echo $todayis; ?></textarea>
		</div>
	
	</div>
	
	<div>
	
    <button type="button" class="btn btn-info" onclick="window.print();">
    Print Form
    </button>
 
	</div>
			
  </body>
</html>