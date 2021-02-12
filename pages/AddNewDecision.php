<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<?php
	require_once '../includes/database/db.php';
	require_once '../includes/functions/sessions.php';
	require_once '../includes/functions/redirect.php';
	require_once '../includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin('../');

	// include 'traitment_decision.php';

		if (isset($_POST['ajouterDecision'])) {
		
			# GET DATA FROM THE INPUTS OF THE FORM
			$nBoncmd=$_POST['nBoncmd'];
			$objetM=$_POST['objetM'];
			$president=$_POST['president'];
			$mem1=$_POST['membre1'];
			$mem2=$_POST['membre2'];
			$dreunion=$_POST['dateComm'];
			$hreunion=$_POST['heureComm'];
			
			# VALIDATION FORM INPUTS
		if ($nBoncmd==0 ||$objetM==0 ||empty($president) || empty($mem1) || empty($mem2) || empty($dreunion) || empty($hreunion) ) {
			$_SESSION['errorMessage']='Remplir tout les champs';
			redirect_to("AddNewDecision.php");
		}
		elseif (strlen($president)>24 || strlen($mem1)>24 || strlen($mem2)>24 || strlen($dreunion)>24 || strlen($hreunion)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 24 characters';
			redirect_to("AddNewDecision.php");
		}
		else
		{
			# QUERY FOR INSERTING DATA TO DATABASE
			$sql="INSERT INTO `reuniontb`(`presedent`, `membre1`, `membre2`, `date_reunion`, `heure_reunion`,`ID_marcher`) VALUES(:zpresedent,:zmembre1,:zmembre2,:zdate_reunion,:zheure_reunion,:zobjet_marche)";
			$stmt=$connectDB->prepare($sql);
			$exec=$stmt->execute(array(
				'zpresedent'=> $president,
				'zmembre1' => $mem1,
				'zmembre2'=>$mem2,
				'zdate_reunion'=>$dreunion,
				'zheure_reunion'=>$hreunion,
				'zobjet_marche'=>$objetM
			));
			# CHECK IF QUERY HAS BEEN SUCCESSFULLY INSERTED
			if ($exec) {
				$_SESSION['succesMessage']='La decision a été ajouté avec succes';
				redirect_to("AddNewDecision.php");
			}
			else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
				redirect_to("AddNewDecision.php");
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
	<title>Ajouter la decision</title>
</head>
<body>
	<div class="container col">
		<!-- START LEFT THE NAVBAR -->
		<div class="left-side bg-dark">
			<div class="logo"><img src="../images/logo.png" alt="" class="mx-auto d-block"></div>
			<nav>
				<ul>
					<li><a href="../dashboard.php?pageName=Lettres"><i class="far fa-file-alt fa-fw"></i><span>Lettre de demande de devis</span></a></li>
					<li><a href="../dashboard.php?pageName=Devis"><i class="fa fa-list-ul fa-fw"></i><span>Devis</span></a></li>
					<li><a href="../dashboard.php?pageName=Decision"><i class="fas fa-user-tie fa-fw"></i><span>Decision</span></a></li>
					<li><a href="../dashboard.php?pageName=PVO"><i class="fas fa-scroll fa-fw"></i><span>PV Ouverture</span></a></li>
					<li><a href="../dashboard.php?pageName=EC"><i class="fas fa-times fa-fw"></i><span>Etat comparatif</span></a></li>
					<li><a href="../dashboard.php?pageName=Bdc"><i class="fa fa-envelope fa-fw"></i><span>Bon de Commande</span></a></li>
					<li><a href="../dashboard.php?pageName=PVR"><i class="fas fa-sticky-note fa-fw"></i><span>PV de reciption</span></a></li>
					<li><a href="../logout.php"><i class="fas fa-sign-out-alt fa-fw"></i><span>Log out</span></a></li>
				</ul>
			</nav>
		</div>
		<!-- END LEFT THE NAVBAR -->
		<div class="right-side">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="card-header">
					<h2 class="text-center">Ajouter une nouvelle decision</h2>
				</div>
				<?php
					echo errorMessage();
					echo succesMessage();
				?>
				<div class="card-body">
					<div class="form-group row">
							<label class="col-lg-4 col-form-label" for="nBoncmd">Nº du bon de commande <span class="text-danger">*</span></label>
							<div class="col-lg-8 input-group">
								<select  class="form-control" name="nBoncmd" id="nBoncmd">
									<option value="0" disabled selected>...</option>
									<?php
									$stmtAffiche=$connectDB->prepare("SELECT  * FROM commandetb");
									$stmtAffiche->execute();
									$bdcs=$stmtAffiche->fetchAll();
									foreach ($bdcs as $numbdc) {
										echo "<option value='".$numbdc['ID_cmd']."'>".$numbdc['numero_cmd']."</option>";
									}?>
								</select>
	                    	</div>
	               	</div>
	               	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="objetM">Objet du marché <span class="text-danger">*</span></label>
						<div class="col-lg-8 input-group">							
							<select  class="form-control" name="objetM" id="objetM">
								<option value="0" disabled selected>...</option>
								<?php
								$stmtAffiche=$connectDB->prepare("SELECT * FROM marchetb");
								$stmtAffiche->execute();
								$marchers=$stmtAffiche->fetchAll();
								foreach ($marchers as $marcher) {
									echo "<option value='".$marcher['ID_marche']."'>".$marcher['objet_marche']."</option>";
								}?>
							</select>
                    	</div>
               		</div>
               		<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="president">President <span class="text-danger">*</span></label>
						
						<div class="col-lg-8">
                        	<input type="text" class="form-control" id="president" name="president" placeholder="Enter le president de la commission..">
                        </div>
                    
               		</div>
               		<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="membre1">Membre 1 <span class="text-danger">*</span></label>
						
						<div class="col-lg-8">
                        	<input type="text" class="form-control" id="membre1" name="membre1" placeholder="Enter le membre 1 de la commission..">
                        </div>
                    
               		</div>
               		<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="membre2">Membre 2 <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                       		<input type="text" class="form-control" id="membre2" name="membre2" placeholder="Enter le membre 2 de la commission..">
                        </div>
               		</div>
               		<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dateComm">Date <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="dateComm" name="dateComm" placeholder="Enter la date de la commission..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureComm">Heure <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="heureComm" name="heureComm" placeholder="Enter heure de la commission..">
                        </div>
					</div>
					<div class="form-group row">
							<div class="col-lg-8 ml-auto">
	                            <button type="submit" name="ajouterDecision" class="btn btn-primary">Ajouter la decision</button>
	                        </div>
					</div>
				</div>
			</form>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>