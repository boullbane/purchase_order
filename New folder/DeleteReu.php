<?php 
	require_once '../includes/database/db.php';
	require_once '../includes/functions/sessions.php';
	require_once '../includes/functions/redirect.php';
	require_once '../includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin('../');

	$searchQuery = $_GET['page'];
	if (isset($_POST['delete'])) {
		$sqlReu="DELETE FROM reuniontb WHERE ID_r='$searchQuery'";
		$stmtReu=$connectDB->query($sqlReu);
		$stmtReu->execute();
		if ($stmtReu->execute()) {
			redirect_to("../dashboard.php?pageName=fullReunion");
		}else {
			$_SESSION['errorMessage']='il ya un problem de supprission, verifiez svp!';
			redirect_to("DeleteReu.php?page=$searchQuery");
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/all.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/fiveicon.png">
	<title>Supprimer la commission</title>
</head>
<body>
	<div class="container col">
		<div class="left-side bg-dark">
			<div class="logo"><img src="../images/logo.png" alt="" class="mx-auto d-block"></div>
			<nav>
				<ul>
					<li><a href="../dashboard.php?pageName=fullLettres"><i class="far fa-file-alt fa-fw"></i><span>Lettre de demande de devis</span></a></li>
					<li><a href="../dashboard.php?pageName=fullDevis"><i class="fa fa-list-ul fa-fw"></i><span>Devis</span></a></li>
					<li><a href="../dashboard.php?pageName=fullDecision"><i class="fas fa-user-tie fa-fw"></i><span>Decision</span></a></li>
					<li><a href="../dashboard.php?pageName=fullPVO"><i class="fas fa-scroll fa-fw"></i><span>PV Ouverture</span></a></li>
					<li><a href="../dashboard.php?pageName=fullEC"><i class="fas fa-times fa-fw"></i><span>Etat comparatif</span></a></li>
					<li><a href="../dashboard.php?pageName=fullBdc"><i class="fa fa-envelope fa-fw"></i><span>Bon de Commande</span></a></li>
					<li><a href="../dashboard.php?pageName=fullPVR"><i class="fas fa-sticky-note fa-fw"></i><span>PV de reciption</span></a></li>
					<li><a href="../logout.php"><i class="fas fa-sign-out-alt fa-fw"></i><span>Log out</span></a></li>
				</ul>
			</nav>
		</div>

		<div class="right-side">
			<?php
				$sqlDelete="SELECT * FROM reuniontb WHERE ID_r='$searchQuery'";
				$stmtDelete=$connectDB->query($sqlDelete);
				while ($dataRows=$stmtDelete->fetch()) {
					$id=$dataRows['ID_r'];
					$president=$dataRows['presedent'];
					$membre1=$dataRows['membre1'];
					$membre2=$dataRows['membre2'];
					$dreu=$dataRows['date_reunion'];
					$hreu=$dataRows['heure_reunion'];
				}
			?>
			<form action="DeleteReu.php?page=<?php echo $searchQuery; ?>" method="POST">
				<div class="card-header">
					<h2 class="text-center">Supprimer la commission</h2>
				</div>
				<?php
					echo errorMessage();
				?>
				<div class="card-body">
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="nomPresident">Président <span class="text-danger">*</span></label>
						<div class="col">
                            <input disabled type="text" class="form-control" id="nomPresident" name="nomPresident" value="<?php echo $president; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="mem1">Membre 1<span class="text-danger">*</span></label>
						<div class="col">
                            <input disabled type="text" class="form-control" id="mem1" name="mem1" value="<?php echo $membre1; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="mem2">Membre 2<span class="text-danger">*</span></label>
						<div class="col">
                            <input disabled type="text" class="form-control" id="mem2" name="mem2" value="<?php echo $membre2; ?>">
                        </div>
					</div>
						<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dateRe">Date reunion<span class="text-danger">*</span></label>
						<div class="col">
                            <input disabled type="text" class="form-control" id="dateRe" name="dateRe" value="<?php echo $dreu; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureRe">Heure reunion<span class="text-danger">*</span></label>
						<div class="col">
                            <input disabled type="text" class="form-control" id="heureRe" name="heureRe" value="<?php echo $hreu; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<div class="col-lg-8 ml-auto">
                            <button type="submit" name='delete' class="btn btn-danger">Supprimer</button>
                        </div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>