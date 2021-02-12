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

	session_unset();
	session_destroy();
	header('Location: login.php');
	exit();
?>