<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<?php
	require_once 'includes/database/db.php';
	require_once 'includes/functions/sessions.php';
	require_once 'includes/functions/redirect.php';
	require_once 'includes/functions/loginfunc.php';

	if (isset($_POST['submit'])) {
		$useremail=$_POST['email'];
		$password=$_POST['password'];
		if (empty($useremail) || empty($password)) {
			$_SESSION['errorLogin']='Remplir tout les champs';
			redirect_to("login.php");
		}
		else {
			$foundAccount=login_attempt($useremail,$password);
			if ($foundAccount) {
				$_SESSION['userID']=$foundAccount['userID'];
				if(isset($_SESSION['trackingURL'])){
					redirect_to($_SESSION['trackingURL']);
				}
				else {
					redirect_to("dashboard.php?pageName=Lettres");
				}
			}
			else{
			 $_SESSION['errorLogin']='Incorrect Email/password';
			 redirect_to("login.php");
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BDC app | Log in</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="icon" href="images/fiveicon.png">
</head>
<body>
	<div class="container">
			<section class="left-side">
				<img src="images/logo.png" alt="">
			</section>
			<section class="right-side">
					<?php
				echo errorLogin();
				echo succesMessage();
				?>
				<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
					<h2>Log in to the application</h2>
					<label for="email">Type in your email</label>
					<input id="email" type="text" placeholder="example@abhdon.com" name="email">
					<label for="password">Type in your password</label>
					<input id="password" type="password" placeholder="******" name="password">
					<button type="submit" name="submit">Log in</button>
				</form>
			</section>
			
	</div>
	<script src="JS/jquery-3.5.1.min.js"></script>
	<script src="JS/login.js"></script>
</body>
</html>