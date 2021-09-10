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
					
				echo $_SESSION['reset'];
				
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
body {
  margin: 0;
  padding: 0;
  background-color: #000;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
</Head>
<body>
    <div id="login">
      <BR>
      <BR>
        <div class="text-center">
            <a href="index.html">
                <img src="../img/logo.png" alt="">
            </a>
        </div>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="index.php" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password"  id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                             <br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Reset Password</a>
                            </div>
                        </form>
                    </div>
                    <div class="text-center text-white bg-danger "><?PHP echo $error;?></div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</body>
</html>