<?php
	include('login.php'); // Include Login Script

	if ((isset($_SESSION['username']) != '')) 
	{
		header('Location: department/'.$_SESSION['department'].'/index.php');

	}if ((isset($_SESSION['reset']))&&(!isset($_SESSION['successstatus']))){
	
		header('Location: reset.php?t='.$_SESSION['reset'].'');
		
	}else if ((isset($_SESSION['reset']))&&(isset($_SESSION['successstatus']))){
		
		unset($_SESSION['reset']);
		
	}

	if ((isset($_POST['req']))) 
	{
			if (!isset($_SESSION['catRandNum'])) {
				
                $str = 'caddcentresriCADDlankathis_KR_v_4555!XCV!!_2_';
                $sesstoken = str_shuffle($str);
                $_SESSION['reset'] = $sesstoken;
	            echo '<script>self.location="reset.php?t='.$_SESSION['reset'].'";</script>';
	
			}else{
					
				
				
				echo '<script>self.location="reset.php?t='.$_SESSION['reset'].'";</script>';
			}
			
	}
	
?>	
	
<?php 
    function GeraHash($qtd){ 
    //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
    $QuantidadeCaracteres = strlen($Caracteres); 
    $QuantidadeCaracteres--; 

    $Hash=NULL; 
        for($x=1;$x<=$qtd;$x++){ 
            $Posicao = rand(0,$QuantidadeCaracteres); 
            $Hash .= substr($Caracteres,$Posicao,1); 
        } 
    return $Hash; 
    } 

?>

<!DOCTYPE html>
<html>
<Head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>
body, html {
  height: 100%;
  margin: 0;
  font-family:font-family: Times, "Times New Roman", Georgia, serif;
}
#login .container #login-row #login-column #login-box {
  margin-top: 20px;
  max-width: 700px;
  height: 290px;
  border:none;
  background-color: none;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}


* {
  box-sizing: border-box;
}

.bg-image {
  /* The image used */
  background-image: url("photographer.jpg");
  
  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 0.5px solid #f1f1f1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
  width: 50%;
  padding: 10px;
  
}
.centerimg {
  display: block;
  margin-left: auto;
  margin-right: auto;

}
</style>
</Head>
<body>

 <div class="bg-image"></div>
    <div class="bg-text">
   
    <div id="login">
        
        <div class="container">
            <img src="img/logo.png" alt=""  class="centerimg">
           
            <div id="login-row" class="row justify-content-center align-items-center">
                
                <div id="login-column" class="col-md-6">
                <h3 style="text-align: center;">System Login</h3>
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="index.php" method="post">
                          
                            <div class="form-group">
                                <label for="username" class="text-light">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-light">Password:</label><br>
                                <input type="password" name="password"  id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                             <br>
                                <input type="submit" name="submit" class="btn btn-secondary btn-md" value="Login">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-light">Reset Password</a>
                            </div>
                        </form>
                    </div>
                    <div class="text-center text-white bg-danger "><?PHP echo $error;?></div>
                </div>
                
            </div>
            
        </div>
        
    </div>

    </div>
    
</body>
</html>