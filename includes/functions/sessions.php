<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<?php
session_start();
function errorMessage() {
	if (isset($_SESSION["errorMessage"])) {
		$output="<div class='alert alert-danger' role='alert'>";
		$output.=htmlentities($_SESSION["errorMessage"])."! Fermer aprés 2 secondes";
		$output.="<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
		$_SESSION["errorMessage"]=null;
		return $output;
	}
}

function succesMessage() {
	if (isset($_SESSION["succesMessage"])) {
		$output="<div class='alert alert-success' role='alert'>";
		$output.=htmlentities($_SESSION["succesMessage"])."! Fermer aprés 2 secondes";
		$output.="<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
		$_SESSION["succesMessage"]=null;
		return $output;
	}
}

function errorLogin() {
	if (isset($_SESSION["errorLogin"])) {
		$output="<div class='info-message'>";
		$output.=htmlentities($_SESSION["errorLogin"]);
		$output.="</div>";
		$_SESSION["errorLogin"]=null;
		return $output;
	}
}
?>