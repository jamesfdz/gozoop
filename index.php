<?php
	session_start();
	// error_reporting(0);

	include ("database/config.php");

?>
<html>
	<head>
		<title>Login | Gozoop</title>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/login.css">

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="main">
			<div class="container">
				<center>
					<div class="middle">
						<div id="login">
							<form action="" method="post">
								<fieldset>
									<p><span class="fa fa-user"></span><input type="text"  placeholder="Username" name="username" required></p>
									<p><span class="fa fa-lock"></span><input type="password"  placeholder="Password" name="password" required></p>
									<div>
										<span><input type="submit" name="submit" value="Sign In"></span>
									</div>
								</fieldset>
							</form>
						</div>
						<div class="logo">
							GOZOOP
						</div>
					</div>
				</center>
			</div>
		</div>
	</body>
</html>
<?php
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		header('location: welcome.php');
		exit;
	}

	if(isset($_POST['submit'])){
		$username = $password = "";
		$user_err = $pass_err = "";

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			if(empty(trim($_POST['username']))){
				$user_err = "Please enter username";
			}else{
				$username = trim($_POST['username']);
			}

			if(empty(trim($_POST['password']))){
				$pass_err = "Please enter password";
			}else{
				$password = trim($_POST['password']);
			}

			if(empty($user_err) && empty($pass_err)){
				$sql = "SELECT * FROM users WHERE username = '".$username."' && password = '".$password."' && active = 1";
				$data = mysqli_query($link, $sql);
				$rownum = mysqli_num_rows($data);
				if($rownum == 1){
					$_SESSION['loggedin_user'] = $username;
					$_SESSION['loggedin'] = true;
					header("location: welcome.php");
				}else{
					$_SESSION['loggedin'] = false;
					echo "User could not be found in database";
				}
			}
		}
	}

	
?>