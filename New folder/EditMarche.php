<?php 
	require_once '../includes/database/db.php';
	require_once '../includes/functions/sessions.php';
	require_once '../includes/functions/redirect.php';
	require_once '../includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin('../');

	$searchQuery = $_GET['page'];
	if (isset($_POST['update'])) {
		$objet=$_POST['objet'];
		$dlance=$_POST['dlance'];
		$hlance=$_POST['hlance'];
		$dLimite=$_POST['dLimite'];
		$hLimite=$_POST['hLimite'];
		$dOuver=$_POST['dOuver'];
		$hOuver=$_POST['hOuver'];
		$dDepo=$_POST['dDepo'];
		$hDepo=$_POST['hDepo'];
		$modeLance=$_POST['modeLance'];
		$dReception=$_POST['dReception'];
		$hReception=$_POST['hReception'];

		if (empty($objet) || empty($dlance) || empty($hlance) || empty($dLimite) || empty($hLimite) || empty($dOuver) || empty($hOuver) || empty($dDepo) || empty($hDepo) || empty($modeLance) || empty($dReception) || empty($hReception)) {
			$_SESSION['errorMessage']='Remplir tout les champs';
			redirect_to("EditMarche.php?page=$searchQuery");
		}
		elseif (strlen($objet)<3 || strlen($dlance)<3 || strlen($hlance)<3 || strlen($dLimite)<3 || strlen($hLimite)<3 || strlen($dOuver)<3 || strlen($hOuver)<3 || strlen($dDepo)<3 || strlen($hDepo)<3 || strlen($modeLance)<3 || strlen($dReception)<3 || strlen($hReception)<3) {
			$_SESSION['errorMessage']='Tout les champs doit etre grand de 3 characters';
			redirect_to("EditMarche.php?page=$searchQuery");
		}
		elseif (strlen($objet)>499 || strlen($dlance)>24 || strlen($hlance)>24 || strlen($dLimite)>24 || strlen($hLimite)>24 || strlen($dOuver)>24 || strlen($hOuver)>24 || strlen($dDepo)>24 || strlen($hDepo)>24 || strlen($modeLance)>24 || strlen($dReception)>24 || strlen($hReception)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 49,254,24 characters';
			redirect_to("EditMarche.php?page=$searchQuery");
		}
		else {

			$sql="UPDATE `marchetb` SET `objet_marche`='$objet',`mode_lancement`='$modeLance' WHERE `ID_marche`='$searchQuery'";
			$stmt=$connectDB->prepare($sql);
			$exec=$stmt->execute();
			if ($exec) {

				$sql2="UPDATE `datetb` SET `date_lancement`='$dlance',`heure_lancement`='$hlance',`date_limite`='$dLimite',`heure_limite`='$hLimite',`date_ouverture`='$dOuver',`heure_ouverture`='$hOuver',`date_depot`='$dDepo',`heure_depot`='$hDepo',`date_reciption`='$dReception',`heure_reciption`='$hReception' WHERE `ID_date`='$searchQuery'";

				$stmt=$connectDB->prepare($sql2);
				$exec2=$stmt->execute();
				if ($exec2) {
					$_SESSION['succesMessage']='Le marché a été ajouté avec succes';
					redirect_to("EditMarche.php?page=$searchQuery");
				}
			}else {
				$_SESSION['errorMessage']='il ya un problem de modifié, verifiez svp!';
				redirect_to("EditMarche.php?page=$searchQuery");
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
	<title>Modifier un marché</title>
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
		$sqlUpdate="SELECT marchetb.*, datetb.* FROM marchetb INNER JOIN datetb WHERE marchetb.ID_marche=datetb.ID_date AND marchetb.ID_marche='$searchQuery'";
		$stmt=$connectDB->query($sqlUpdate);
		$compter=0;
		while ($dataRows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$idM=$dataRows['ID_marche'];
			$objetM=$dataRows['objet_marche'];
			$dlanceM=$dataRows['date_lancement'];
			$hlanceM=$dataRows['heure_lancement'];
			$dLimiteM=$dataRows['date_limite'];
			$hLimiteM=$dataRows['heure_limite'];
			$dOuverM=$dataRows['date_ouverture'];
			$hOuverM=$dataRows['heure_ouverture'];
			$dDepoM=$dataRows['date_depot'];
			$hDepoM=$dataRows['heure_depot'];
			$modeLanceM=$dataRows['mode_lancement'];
			$dReceptionM=$dataRows['date_reciption'];
			$hReceptionM=$dataRows['heure_reciption'];
			}?>
			<form action="EditMarche.php?page=<?php echo $searchQuery; ?>" method="POST">
				<div class="card-header">
					<h2 class="text-center">Modifier le marché</h2>
				</div>
				<?php
					echo errorMessage();
					echo succesMessage();
				?>
				<div class="card-body">
						<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="objet">Objet du marché <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="objet" name="objet" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dlance">La date de lancement <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="dlance" name="dlance" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hlance">L'heure de lancement <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="hlance" name="hlance" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dLimite">La date limite <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="dLimite" name="dLimite" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hLimite">L'heure limite <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="hLimite" name="hLimite" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dOuver">La date d'ouverture <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="dOuver" name="dOuver" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hOuver">L'heure d'ouverture <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="hOuver" name="hOuver" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dDepo">La date de depot <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="dDepo" name="dDepo" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hDepo">L'heure de depot <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="hDepo" name="hDepo" value="<?php echo $objetM; ?>">
                        </div>
					</div>
						<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="modeLance">Mode de lancement <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="modeLance" name="modeLance" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dReception">La date de réciption <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="dReception" name="dReception" value="<?php echo $objetM; ?>">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hReception">L'heure de réciption <span class="text-danger">*</span></label>
						<div class="col">
                            <input type="text" class="form-control" id="hReception" name="hReception" value="<?php echo $objetM; ?>">
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