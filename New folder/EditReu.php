<?php 
	require_once '../includes/database/db.php';
	require_once '../includes/functions/sessions.php';
	require_once '../includes/functions/redirect.php';
	require_once '../includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin('../');

	$searchQuery = $_GET['page'];
	if (isset($_POST['update'])) {
		$president=$_POST['nomPresident'];
		$membre1=$_POST['membre1'];
		$membre2=$_POST['membre2'];
		$dateRe=$_POST['dateRe'];
		$heureRe=$_POST['heureRe'];

		if (empty($president) || empty($membre1) || empty($membre2) || empty($dateRe) || empty($heureRe)) {
			$_SESSION['errorMessage']='Remplir tout les champs';
			redirect_to("EditReu.php?page=$searchQuery");
		}
		elseif (strlen($president)<3 || strlen($membre1)<3 || strlen($membre2)<3 || strlen($dateRe)<3 || strlen($heureRe)<3) {
			$_SESSION['errorMessage']='Tout les champs doit etre grand de 3 characters';
			redirect_to("EditReu.php?page=$searchQuery");
		}
		elseif (strlen($president)>24 || strlen($membre1)>24 || strlen($membre2)>24 || strlen($dateRe)>24 || strlen($heureRe)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 24 characters';
			redirect_to("EditReu.php?page=$searchQuery");
		}
		else {
			$sql="UPDATE reuniontb SET presedent='$president', membre1='$membre1', membre2='$membre2', date_reunion='$dateRe', heure_reunion='$heureRe' WHERE ID_r='$searchQuery'";
			$stmt=$connectDB->query($sql);
			$exec=$stmt->execute();
			if ($exec) {
				$_SESSION['succesMessage']='La commission a été modifié avec succes';
				redirect_to("EditReu.php?page=$searchQuery");
			}else {
				$_SESSION['errorMessage']='il ya un problem de modifié, verifiez svp!';
				redirect_to("EditReu.php?page=$searchQuery");
			}
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
	<title>Modifier une societe</title>
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
				$sqlUpdate="SELECT * FROM reuniontb WHERE ID_r='$searchQuery'";
				$stmtUpdate=$connectDB->query($sqlUpdate);
				while ($dataRows=$stmtUpdate->fetch()) {
					$id=$dataRows['ID_r'];
					$nomPresident=$dataRows['presedent'];
					$mem1=$dataRows['membre1'];
					$mem2=$dataRows['membre2'];
					$dreu=$dataRows['date_reunion'];
					$hreu=$dataRows['heure_reunion'];
				}
			?>
			<form action="EditReu.php?page=<?php echo $searchQuery; ?>" method="POST">
				<div class="card-header">
					<h2 class="text-center">Modifier la commission</h2>
				</div>
				<?php
					echo errorMessage();
					echo succesMessage();
				?>
				<div class="card-body">
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="nomPresident">President<span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="nomPresident" name="nomPresident" value="<?php echo $nomPresident; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="membre1">Membre 1<span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="membre1" name="membre1" value="<?php echo $mem1; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="membre2">Membre 2<span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="membre2" name="membre2" value="<?php echo $mem2; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dateRe">Date reunion<span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="dateRe" name="dateRe" value="<?php echo $dreu; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureRe">Heure reunion<span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureRe" name="heureRe" value="<?php echo $hreu; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<div class="col-lg-8 ml-auto">
                            <button type="submit" name="update" class="btn btn-warning">Modifier</button>
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