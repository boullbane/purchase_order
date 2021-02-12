<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<?php  
	require_once 'includes/database/db.php';
	require_once 'includes/functions/redirect.php';
	require_once 'includes/functions/sessions.php';
	require_once 'includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin(null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/fiveicon.png">
	<title>Dashboard  <?php $pageDirectory='pages';
							if (!empty($_GET['pageName'])) {
								$pageFolder = scandir($pageDirectory);
								$pageName=$_GET['pageName'];
								echo '| '.$pageName;
							}
						?>	
	</title>
</head>
<body>
	<div class="container col">
		<div class="left-side bg-dark">
			<div class="logo"><img src="images/logo.png" class="mx-auto d-block"></div>
			<nav>
				<ul>
					<li><a href="dashboard.php?pageName=Lettres"><i class="far fa-file-alt fa-fw"></i><span>Lettre de demande de devis</span></a></li>
					<li><a href="dashboard.php?pageName=Devis"><i class="fa fa-list-ul fa-fw"></i><span>Devis</span></a></li>
					<li><a href="dashboard.php?pageName=Decision"><i class="fas fa-user-tie fa-fw"></i><span>Decision</span></a></li>
					<li><a href="dashboard.php?pageName=PVO"><i class="fas fa-scroll fa-fw"></i><span>PV Ouverture</span></a></li>
					<li><a href="dashboard.php?pageName=EC"><i class="fas fa-times fa-fw"></i><span>Etat comparatif</span></a></li>
					<li><a href="dashboard.php?pageName=Bdc"><i class="fa fa-envelope fa-fw"></i><span>Bon de Commande</span></a></li>
					<li><a href="dashboard.php?pageName=PVR"><i class="fas fa-sticky-note fa-fw"></i><span>PV de reciption</span></a></li>
					<li><a href="logout.php"><i class="fas fa-sign-out-alt fa-fw"></i><span>Log out</span></a></li>
				</ul>
			</nav>
		</div>

		<div class="right-side">
			<?php
				$pageDirectory='pages';
				if (!empty($_GET['pageName'])) {
					$pageFolder = scandir($pageDirectory);
					$pageName=$_GET['pageName'];
					if(in_array($pageName.'.php',$pageFolder)){
						include ($pageDirectory.'/'.$pageName.'.php');
					}
					else {
						echo "404 error";
					}
				}
				else {
					header('Location:dashboard.php?pageName=Lettres');
				}
				
			?>
        </div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>