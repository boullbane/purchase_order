<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<?php
	require_once 'sessions.php';
	require_once 'redirect.php';


 	function login_attempt($useremail,$password)
 	{
 		global $connectDB;
 		$sql="SELECT * FROM users WHERE userEmail=:zuseremail AND password=:zpassword";
		$stmt=$connectDB->prepare($sql);
		$stmt->bindValue(':zuseremail',$useremail);
		$stmt->bindValue(':zpassword',$password);
		$stmt->execute();
		$result=$stmt->rowcount();
		if($result==1)
		{
			return $foundAccount=$stmt->fetch();
		}
		else
		{
			return null;
		}
 	}
 	function confirmLogin($path)
 	{
 		if (isset($_SESSION['userID'])) {
 			return true;
 		}
 		else
 		{
 			$_SESSION['errorLogin']='Login required!';
 			
 			redirect_to($path."login.php");
 		}
 	}

?>