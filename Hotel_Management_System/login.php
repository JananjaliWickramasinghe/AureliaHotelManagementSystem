<?php
	session_start();
	include("connection.php"); //Establishing connection with our database
	
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			$error = "Both fields are required.";
		}else
		{
			$error = "Both fields are required.";
			// Define $username and $password
			$username=$_POST['username'];
			$password=$_POST['password'];

			// To protect from MySQL injection
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($db, $username);
			$password = mysqli_real_escape_string($db, $password);
			$password = md5($password);
			
			//Check username and password from database
			$sql="SELECT uid FROM users WHERE username='$username' and password ='$password'";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

			//If username and password exist in our database then create a session.
			//Otherwise echo error.
			if(mysqli_num_rows($result) == 1)
			{
				$sql = "SELECT department, firstname, lastname FROM users WHERE username='$username'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					
					$_SESSION['username'] = $username; // Initializing Session
					$_SESSION['department'] = $row["department"];//Department

					if ($row["department"] == "hotel") {
						header("location: department/hotel/index.php"); // Redirecting To user's page
					} else if ($row["department"] == "hr") {
						header("location: department/hr/index.php"); // Redirecting To user's page
					}else if ($row["department"] == "reservation") {
						header("location: department/reservation/index.php"); // Redirecting To user's page
					}else if ($row["department"] == "restaurant") {
						header("location: department/restaurant/index.php"); // Redirecting To user's page
					}else if ($row["department"] == "admin") {
						header("location: department/admin/index.php"); // Redirecting To user's page
					}else{
						header("location: department/404.php"); // 404 page
					}

				}
				} else {
				echo "0 results";
				}
				$conn->close();
				
				
				
			}else
			{
				$tokenlength=20;
				$resetToken = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($tokenlength/strlen($x)) )),1,$tokenlength);
				$_SESSION['resetToken']=$resetToken;
				echo $resetToken;
				$error = "Incorrect username or password. Click <a href='password.php?reset=".$resetToken."&uname=".md5($username)."'>here</a> to reset password.";
			}

		}
	}

?>