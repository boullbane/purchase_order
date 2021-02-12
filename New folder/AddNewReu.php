<?php
	require_once '../includes/database/db.php';
	require_once '../includes/functions/sessions.php';
	require_once '../includes/functions/redirect.php';
	require_once '../includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin('../');

	if (isset($_POST['submit'])) {
		$president=$_POST['nomPresident'];
		$mem1=$_POST['mem1'];
		$mem2=$_POST['mem2'];
		$dateRe=$_POST['dateReu'];
		$heureRe=$_POST['heureReu'];

		if (empty($president) || empty($mem1) || empty($mem2) || empty($dateRe) || empty($heureRe)) {
			$_SESSION['errorMessage']='Remplir tout les champs';
			redirect_to("AddNewReu.php");
		}
		elseif (strlen($president)<3 || strlen($mem1)<3 || strlen($mem2)<3 || strlen($dateRe)<3 || strlen($heureRe)<3) {
			$_SESSION['errorMessage']='Tout les champs doit etre grand de 3 characters';
			redirect_to("AddNewReu.php");
		}
		elseif (strlen($president)>24 || strlen($mem1)>24 || strlen($mem2)>24 || strlen($dateRe)>24 || strlen($heureRe)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 24 characters';
			redirect_to("AddNewReu.php");
		}
		else {
			$sql="INSERT INTO reuniontb(presedent,membre1,membre2,date_reunion,heure_reunion)";
			$sql.="VALUES (:zpresedent,:zmembre1,:zmembre2,:zdate_reunion,:zheure_reunion)";
			$stmt=$connectDB->prepare($sql);
			$stmt->bindValue(':zpresedent',$president);
			$stmt->bindValue(':zmembre1',$mem1);
			$stmt->bindValue(':zmembre2',$mem2);
			$stmt->bindValue(':zdate_reunion',$dateRe);
			$stmt->bindValue(':zheure_reunion',$heureRe);
			$exec=$stmt->execute();
			if ($exec) {
				$_SESSION['succesMessage']='La commission a été ajouté avec succes';
				redirect_to("AddNewReu.php");
			}else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
				redirect_to("AddNewReu.php");
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
	<title>Ajouter la commission</title>
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
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="card-header">
					<h2 class="text-center">Ajouter une nouvelle commission</h2>
				</div>
				<?php
				echo errorMessage();
				echo succesMessage();
				?>
				<div class="card-body">
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="nomPresident">Nom de Président <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="nomPresident" name="nomPresident" placeholder="Enter le nom du président..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="mem1">Member 1 <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="mem1" name="mem1" placeholder="Enter le membre 1..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="mem2">Member 2 <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="mem2" name="mem2" placeholder="Enter le membre 2..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dateReu">Date Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="dateReu" name="dateReu" placeholder="Enter la date de reunion..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureReu">Heure Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureReu" name="heureReu" placeholder="Enter l'heure de reunion'..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureReu">Heure Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureReu" name="heureReu" placeholder="Enter l'heure de reunion'..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureReu">Heure Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureReu" name="heureReu" placeholder="Enter l'heure de reunion'..">
                        </div>
					</div>
					
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureReu">Heure Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureReu" name="heureReu" placeholder="Enter l'heure de reunion'..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureReu">Heure Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureReu" name="heureReu" placeholder="Enter l'heure de reunion'..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureReu">Heure Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureReu" name="heureReu" placeholder="Enter l'heure de reunion'..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureReu">Heure Reunion <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="heureReu" name="heureReu" placeholder="Enter l'heure de reunion'..">
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