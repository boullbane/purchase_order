<?php
	require_once '../includes/database/db.php';
	require_once '../includes/functions/sessions.php';
	require_once '../includes/functions/redirect.php';
	require_once '../includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin('../');

	if (isset($_POST['submit'])) {
		$nameSociete=$_POST['nomSoc'];
		$adrSociete=$_POST['adrSoc'];
		$telSociete=$_POST['telSoc'];

		if (empty($nameSociete) || empty($adrSociete) || empty($telSociete)) {
			$_SESSION['errorMessage']='Remplir tout les champs';
			redirect_to("AddNewSoc.php");
		}
		elseif (strlen($nameSociete)<3 || strlen($adrSociete)<3 || strlen($telSociete)<3) {
			$_SESSION['errorMessage']='Tout les champs doit etre grand de 3 characters';
			redirect_to("AddNewSoc.php");
		}
		elseif (strlen($nameSociete)>49 || strlen($adrSociete)>254 || strlen($telSociete)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 49,254,24 characters';
			redirect_to("AddNewSoc.php");
		}
		else {
			$sql="INSERT INTO fournisseurtb(nomF,adrF,telF)";
			$sql.="VALUES (:znomF,:zadrF,:ztelF)";
			$stmt=$connectDB->prepare($sql);
			$stmt->bindValue(':znomF',$nameSociete);
			$stmt->bindValue(':zadrF',$adrSociete);
			$stmt->bindValue(':ztelF',$telSociete);
			$exec=$stmt->execute();
			if ($exec) {
				$_SESSION['succesMessage']='La societe est ajouté avec succes';
				redirect_to("AddNewSoc.php");
			}else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
				redirect_to("AddNewSoc.php");
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
	<title>Ajouter la societe</title>
</head>
<body>
	<div class="container col">
		<div class="left-side bg-dark">
			<div class="logo"><img src="../images/logo.png" alt="" class="mx-auto d-block"></div>
			<nav>
				<ul>
					<li><a href="../dashboard.php?pageName=fullMarche"><i class="fas fa-store"></i></i><span>Marché</span></a></li>
					<li><a href="../dashboard.php?pageName=fullSoc"><i class="fas fa-university fa-fw"></i><span>Societé</span></a></li>
					<li><a href="../dashboard.php?pageName=fullReunion"><i class="fas fa-comments fa-fw"></i><span>Réunion</span></a></li>
					<hr class="mb-2">
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
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="card-header">
					<h2 class="text-center">Ajouter une nouvelle societé</h2>
				</div>
				<?php
				echo errorMessage();
				echo succesMessage();
				?>
				<div class="card-body">
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="nomSoc">Nom de Societé <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="nomSoc" name="nomSoc" placeholder="Enter a nom de societé..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="adrSoc">Addresse de Societé <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="adrSoc" name="adrSoc" placeholder="Enter l'addresse de societé..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="telSoc">Telephone de Societé <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="telSoc" name="telSoc" placeholder="Enter telephone de societé..">
                        </div>
					</div>
					<div class="form-group row">
						<div class="col-lg-8 ml-auto">
                            <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
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