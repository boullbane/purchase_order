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

	include 'traitment_devis.php';

		if (isset($_POST['ajouterDevis'])) {
			
			# GET DATA FROM THE INPUTS OF THE FORM
			$nBoncmd=$_POST['nBoncmd'];			
			$desgProd=$_POST['desgProd'];
			$qte=$_POST['qte'];

			# VALIDATION FORM INPUTS
		if ($nBoncmd==0 ||$desgProd==0 || $qte==0 ) {
			$_SESSION['errorMessage']='Remplir tout les champs';
			redirect_to("AddNewDevis.php");
		}
		else
		{
			# QUERY FOR INSERTING DATA TO DATABASE
			$sql="INSERT INTO `lignecommandetb`(`ID_cmd`,`ref_produit`,`qte`) VALUES(:zidcmd,:zref_produit,:zqte)";
			$stmt=$connectDB->prepare($sql);
			$exec=$stmt->execute(array(
				'zidcmd'=> $nBoncmd,
				'zref_produit' => $desgProd,
				'zqte'=>$qte
			));

			# CHECK IF QUERY HAS BEEN SUCCESSFULLY INSERTED
			if ($exec) {
				$_SESSION['succesMessage']='Le devis a été ajouté avec succes';
				redirect_to("AddNewDevis.php");
			}
			else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
				redirect_to("AddNewDevis.php");
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
	<link rel="stylesheet" href="../tail.select-master/css/bootstrap4/tail.select-default.css">
	<link rel="stylesheet" href="../css/all.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/fiveicon.png">
	<title>Ajouter le devis</title>
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
			<?php include 'formProdUnite.php';?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="desgProd_form" method="POST">
				<div class="card-header">
					<h2 class="text-center">Ajouter un nouveau devis</h2>
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
								$stmtAffiche=$connectDB->prepare("SELECT * FROM commandetb ORDER BY numero_cmd ASC");
								$stmtAffiche->execute();
								$bdcs=$stmtAffiche->fetchAll();
								foreach ($bdcs as $numbdc) {
									echo "<option value='".$numbdc['ID_cmd']."'>".$numbdc['numero_cmd']."</option>";
								}?>
							</select>
	                    	</div>
	               	</div>
	               	
	               	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="desgProd">Désignation <span class="text-danger">*</span></label>
						<div class="col-lg-8 input-group">							
							<select id="select" name="desgProd">
								<option value="0" disabled selected>...</option>
								<?php
								$stmtAffiche=$connectDB->prepare("SELECT * FROM produittb");
								$stmtAffiche->execute();
								$produits=$stmtAffiche->fetchAll();
								foreach ($produits as $produit) {
									echo "<option value='".$produit['ref_produit']."'>".$produit['designation_produit']."</option>";
								}?>
							</select>
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddNewProduit">
							 <i class="fas fa-plus"></i>
							</button>
                    	</div>
               		</div>
               		<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="qte">Qte <span class="text-danger">*</span></label>
						
							<div class="col-lg-8 input-group">
							 <input type="text" class="form-control" name="qte" id="qte" placeholder="Enter la quantité du produit..">
	                    	</div>
                    	
               		</div>
					<div class="form-group row">
							<div class="col-lg-8 ml-auto">
	                            <button type="submit" name="ajouterDevis" class="btn btn-primary">Ajouter le devis</button>
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
<script src="../tail.select-master/js/tail.select.js"></script>
<script src="../js/main.js"></script>
</body>
</html>