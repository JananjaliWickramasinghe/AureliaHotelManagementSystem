<?php

include('connection.php'); 
	include('login.php'); // Include Login Script

if(isset($_POST['sessiondestroy'])){

session_destroy();	
	header('Location: index.php?sess=stop');
	exit;
		
}

	if ((isset($_SESSION['username']) != '')) 
	{
		header('Location: inside/index.php?tab=home');
		exit;
	}
	
	if ($_GET['t']!=$_SESSION['reset']) 
	{
		session_destroy(); 
		header('Location: index.php');
		exit;
	}
	
	$fmsg="";
	
	$_SESSION['FINAL']="false";
	
	if (!isset($_SESSION['FINALisok']))
	{
					if ((!isset($_SESSION['reqUSERNAME'])) &&(!isset($_SESSION['token']))&&$_SESSION['FINAL']=="false")
					{
						
						
						
						$frm='<form method="post" action="" style="padding:10px;">
					  <br>
					
					
					<p style="color:white;">Enter your username first.</p>
						<input type="text"  name="Eusername" placeholder="Enter Username" required />
						<br>
					 
					   
						
					  <button type="submit" name="usn"  class="btn btn-primary btn-block btn-large">Send reset code</button>
						
					  
						<h3><div align="center" style="color:white; font-size:16px; "><?php echo $error;?></div></h3>
					  
					</form>';
						
						
						
					}else if ((isset($_SESSION['token']))&& ($_SESSION['FINAL']=="false"))
					{
						
						$frm='<h3 style="color:white; font-size:15px;">Your confirmation code is sent your email</h3><br>    <form method="post" action="" style="padding:10px;">
						<input type="text"  name="tkn" placeholder="Enter confirmation code" required />
						<br>
					 
					   
						
					  <button type="submit" name="tokensub"  class="btn btn-primary btn-block btn-large">Submit</button>
						
					  
						<h3><div align="center" style="color:white; font-size:16px; "><?php echo $error;?></div></h3>
					  
					</form>';
						
					}

	}else if (isset($_SESSION['FINALisok']))
	{
		
		
					$frm='<h3 style="color:white; font-size:15px;">Reset your password..</h3><form method="post" action="" style="padding:10px;">
				  <br>
				
					<input type="password"  name="Npassword" placeholder="New password"  required />
					<br>
				 
					<input type="password" name="RNpassword"  placeholder="Re-enter New password"  value="" required />
					
				  <button type="submit" name="finalize"  class="btn btn-primary btn-block btn-large">Change password</button>
					
				  
					<h3><div align="center" style="color:white; font-size:16px; "><?php echo $error;?></div></h3>
				  
				</form>';
		
	}
	
	
	if(isset($_POST['usn'])){

		$sqlu = "SELECT admin_id,email,name,profile,username FROM admin WHERE username='".$_POST['Eusername']."'";
			$resultS = $con->query($sqlu);
			
			if ($resultS->num_rows > 0) {
				
				while($row = $resultS->fetch_assoc()) {
					
					//user name tynawa 
					
					$_SESSION['token']=rand(100,10000);
					
					
					$_SESSION['resetuser']=$row["username"];
					
					
					$_SESSION['PIMG']='<div class="container">
       <img src="inside/Admin/M_ADMIN/users_profile_images/'.$row["profile"].'" class="img-circle" alt="Profile image not available" width="80" style=" 
    height:90px;
    border-radius:50%;
    overflow:hidden;" > 
	
	<p style="color:white;">Hello '.$row["name"].' </p>
	
</div>';


$sendto=$row["email"];
$senn=$row["name"];

require 'Emails/smtp/class.phpmailer.php';

$mail = new PHPMailer;
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'gator4081.hostgator.com'; 
$mail->Host = 'mail.caddcentre.lk'; 

// Specify main and backup server
$mail->Port = 25;                                // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'noreply@caddcentre.lk';                // SMTP username
$mail->Password = 'asdf1234';                  // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'noreply@caddcentre.lk';
$mail->FromName = 'SYSTEM : CADD CENTRE LANKA';

$mail->AddAddress($sendto, $senn);  // Add a recipient

//$mail->AddAddress('chinthakavishwa99@gmail.com');               // Name is optional
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Confirmation code for password recovery : CADD CENTRE INTERNAL MANAGEMENT SYSTEM';


$mail->Body    = '
<html>
<body>
<div  style="border-radius: 25px;
    border: 2px solid red;
    padding: 20px; 
    width: auto;
    height: 600px;">
    
    
    
<div style="text-align: left">
  <p><img src="http://www.caddcentre.lk/sys1/images/N.png" width="226" height="90" /></p>
 
</div>
   <hr> 
    
<p> Hi '.$row["name"].' ,</p>
<P>
We received a request to reset your cadd centre system password. <br />
 You can enter the following password reset code:</P>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="10">
  <tr>
    <td height="42" bgcolor="#FAF7EB"><div align="center" style="font-size:18px;"><b>'.$_SESSION['token'].' </b></td>
  </tr>
</table>


</P>
    
    <p>&nbsp;</p>
	<hr>
	www.caddcentre.lk <br>
	'.date("Y-m-d").'

</div>
</body>
</html>';


/*
$mail->Body    = '<html>
<head>
<style type="text/css">
body table tr {
	font-family: Arial, Helvetica, sans-serif;
}
body table tr {
	font-family: Georgia, "Times New Roman", Times, serif;
}
</style>
</head>
<body>
<center><img src="http://www.caddcentre.lk/sys1/systest/images/nss.png" width="100" alt="logo"><center>
<br>
<table width="657" height="78" align="center" cellpadding="10">
<tr>
  <td width="649" height="72" bgcolor="#00BFFF"><div align="" style="width: 100%; padding:5px; font-family: Georgia, "Times New Roman", Times, serif; font-size: 24px; color: #000;">
<p style="color: #F00; font-size: 25px;" align="center">CADD CENTRE SRILANKA</p>

<HR>
<p>Hello '.$row["name"].' , </p>
<p >You recently reqested to reset your password for cadd centre srilanka system. Use folowing confirmation code and reset.</p>
<p style="color: #F00; font-size: 19px;">Your confirmation code is : '.$_SESSION['token'].' </p>
<p>&nbsp;</p>
<p>Thank you.</p>
<p>System,</p>
<p>www.caddcentre.lk</p>
<P>'.date("Y-m-d").'</p>
<p>&nbsp;</p>
</div></td>
  </tr>
</table>

</body>
</html>';


*/



$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   $fmsg= 'Confirmation could not be sent.';
   $fmsg.='Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

//$fmsg= 'Message has been sent';

















					//-----------------mail
					
					
		/*		
$to = $row["email"];
$subject = "HTML email";

$message = '<html>
<head>
<style type="text/css">
body table tr {
	font-family: Arial, Helvetica, sans-serif;
}
body table tr {
	font-family: Georgia, "Times New Roman", Times, serif;
}
</style>
</head>
<body>

<table width="657" height="78" align="center" cellpadding="10">
<tr>
  <td width="649" height="72" bgcolor="#FFCC00"><div align="" style="width: 100%; padding:5px; font-family: Georgia, "Times New Roman", Times, serif; font-size: 24px; color: #000;">
<p style="color: #F00; font-size: 25px;" align="center">CADD CENTRE SRILANKA</p>

<HR>
<p>Hello '.$row["name"].' , </p>
<p >You recently reqested to reset your password for cadd centre srilanka system. Use folowing confirmation code and reset.</p>
<p style="color: #F00; font-size: 19px;">Your confirmation code is : '.$_SESSION['token'].' </p>
<p>&nbsp;</p>
<p>Thank you.</p>
<p>System,</p>
<p>www.caddcentre.lk</p>
<p>&nbsp;</p>
</div></td>
  </tr>
</table>

</body>
</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);

					
		*/			
					
					//////////////////
					
					
					
					$frm='<h3 style="color:white; font-size:15px;">Your confirmation code is sent your email .</h3><br><form method="post" action="" style="padding:10px;">
     <input type="text"  name="tkn" placeholder="Enter confirmation code" required  autocomplete="off"/>
      <br>
     
       
        
      <button type="submit" name="tokensub"  class="btn btn-primary btn-block btn-large">Submit</button>
        
      
        <h3><div align="center" style="color:white; font-size:16px; "><?php echo $error;?></div></h3>
      
    </form>';
					
					//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
					
					
					
				}
			} 
			
			
			
			else {
				$fmsg= "Username not found! click here to re enter";
			}
		
		
		
		
		
		
		
	}
	
	if(isset($_POST['tokensub'])){
		
		
		
		
		if($_SESSION['token']==$_POST['tkn']){
		
		
		
		
		$_SESSION['FINAL']="true";
		$_SESSION['FINALisok']="true";
		
		
					$frm='<h3 style="color:white; font-size:15px;">Reset your password..</h3><form method="post" action="" style="padding:10px;">
				  <br>
				
					<input type="password"  name="Npassword" placeholder="New password" required />
					<br>
				 
					<input type="password" name="RNpassword"  placeholder="Re-enter New password"   required />
					
				  <button type="submit" name="finalize"  class="btn btn-primary btn-block btn-large">Change password</button>
					
				  
					<h3><div align="center" style="color:white; font-size:16px; "><?php echo $error;?></div></h3>
				  
				</form>';
		
	
		
		
		
		
		
		
		
		
		
		
		
		
		}else{
			
			echo "<script>alert('Confirmation code wrong!');</script>";
			
		}
		
		
		
	}
	
	
	if(isset($_POST['finalize'])){
		
		

		
						$npass=trim($_POST['Npassword']);
		
						$rpass=trim($_POST['RNpassword']);
						
						
						
					if($npass==$rpass){	
						$npass = stripslashes($npass);
		
						$npass = mysqli_real_escape_string($db, $npass);
						$npass= md5($npass);
		
					$sqlxc = "UPDATE admin SET password='$npass' WHERE username='admin'";

					if ($con->query($sqlxc) === TRUE) {
						
						
						 echo "<script> window.location.href = 'index.php?reset=success'; </script>";
					
						session_destroy();
						 
						
					} else {
					
						$fmsg="Error updating record.Please contact system administator.";
						session_destroy();
					}
					
					$con->close();
		
		  			}else{
					
					
					
					$fmsg="Your new passwords do not match";
					
					
					
					
					}
		
	}
	
	
	
	
	
?>	
	
	

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="inside/favicon.jpg">
  <title>Welcome! : CADD CENTRE SYSTEM</title>
  
  
  
  
  
  
  

  
  <style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);
.btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
.btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
.btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
.btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
.btn-primary.active { color: rgba(255, 255, 255, 0.75); }
.btn-primary { background-color: #4a77d4; background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4); background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4)); background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4); background-image: -o-linear-gradient(top, #6eb6de, #4a77d4); background-image: linear-gradient(top, #6eb6de, #4a77d4); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);  border: 1px solid #3762bc; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #4a77d4; }
.btn-block { width: 100%; display:block; }

* { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

html { width: 100%; height:100%; overflow:hidden; }

body { 
	width: 100%;
	height:100%;
	background-color: #036;
	font-family: 'Open Sans', sans-serif;
	
}
.login { 
	position: absolute;
	top: 30%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:310px;
	height:auto;
background: #2b5876;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #4e4376, #2b5876);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4e4376, #2b5876); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

border-radius: 15px;
}
.login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:3px; text-align:center; }

input { 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }

  </style>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  </head>



<body>
 <nav class="navbar" id="top"></nav><center>
  
  <header class="container">
   
    <section class="content">

<br>
    <div class="login">
      <form action="" method="post">
    
    <input type="submit"  name="sessiondestroy" value="Cancel session" >
    
    
    </form>
 <br>
<center><img src="images/nss.png" width="306"></center>
<h1 align="center">Reset password</h1>
<center> <?php if(isset($_SESSION['PIMG'])){ echo $_SESSION['PIMG'];}?></center>
<p style="color:#FFFFFF;"><?php echo $fmsg;?></p>
<?php echo $frm;?>

</div>
      <!-- Some content to demonstrate viewport scrolling behavior -->
  
  





</body>
</html>
