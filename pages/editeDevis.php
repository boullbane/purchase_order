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

	$searchQuery=$_GET['page'];

	include 'traitment_devis.php';

		if (isset($_POST['updateDevis'])) {

			# GET DATA FROM THE INPUTS OF THE FORM
			$designation=$_POST['desgProd'];
			$qte=$_POST['qte'];

			# QUERY FOR UPDATING DATA TO DATABASE
			$sql="UPDATE lignecommandetb SET ref_produit='$designation', qte='$qte' WHERE ID_cmd='$searchQuery'";
			$stmt=$connectDB->query($sql);
			$exec=$stmt->execute();

			# CHECK IF QUERY HAS BEEN SUCCESSFULLY UPDATED
			if ($exec) {
				$_SESSION['succesMessage']='La lettre a été modifié avec succes';
				redirect_to("editeDevis.php?page=$searchQuery");
			}
			else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
				redirect_to("editeDevis.php?page=$searchQuery");
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
	<title>Modifier la lettre</title>
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
		<?php 
			$sqlUpdate="SELECT * FROM lignecommandetb INNER JOIN commandetb ON lignecommandetb.ID_cmd=commandetb.ID_cmd 
			INNER JOIN produittb ON lignecommandetb.ref_produit=produittb.ref_produit
			INNER JOIN fournisseurtb ON commandetb.ID_f=fournisseurtb.ID_f
			WHERE lignecommandetb.ID_cmd='$searchQuery'";
			$stmtUpdate=$connectDB->query($sqlUpdate);
			while ($dataRows=$stmtUpdate->fetch()) {
				$id_cmd=$dataRows['ID_cmd'];
				$num_cmd=$dataRows['numero_cmd'];
				$refProd=$dataRows['ref_produit'];
				$desgProd=$dataRows['designation_produit'];							
				$qteLc=$dataRows['qte'];							
			}?>
		<div class="right-side">
			<?php include 'formProdUnite.php';?>
			<form action="editeDevis.php?page=<?php echo $searchQuery; ?>" method="POST">
				<div class="card-header">
					<h2 class="text-center">Modifier le devis</h2>
				</div>
				<?php
				echo errorMessage();
				echo succesMessage();
				?>
				<div class="card-body">
					<div class="form-group row">
							<label class="col-lg-4 col-form-label" for="nBoncmd">Nº du bon de commande <span class="text-danger">*</span></label>
							<div class="col-lg-8 input-group">
								<input disabled type="text" class="form-control" name="nBoncmd" id="nBoncmd" value="<?php echo $num_cmd; ?>">
	                    	</div>
	               	</div>
	               	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="desgProd">Designation <span class="text-danger">*</span></label>
						<div class="col-lg-8 input-group">							
							<select  class="form-control mr-3" name="desgProd" id="desgProd">
								<option value="0" disabled>...</option>
								<?php
								$stmtAffiche=$connectDB->prepare("SELECT * FROM produittb");
								$stmtAffiche->execute();
								$produits=$stmtAffiche->fetchAll();
								foreach ($produits as $produit) {
									echo "<option value='".$produit['ref_produit']."'";
									if ($produit['ref_produit']==$refProd) {echo "selected";}
									echo">".$produit['designation_produit']."</option>";
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
							<select  class="form-control mr-3" name="qte" id="qte">
								<option value="0" disabled>...</option>
								<?php
								$stmtAffiche=$connectDB->prepare("SELECT * FROM ligne_commandetb");
								$stmtAffiche->execute();
								$quantities=$stmtAffiche->fetchAll();
								foreach ($quantities as $quantite) {
									echo "<option value='".$quantite['ID_cmd']."'";
									if ($quantite['ID_cmd']==$id_cmd) {echo "selected";}
									echo">".$quantite['qte']."</option>";
								}?>
							</select>
                    	</div>
               		</div>
					<div class="form-group row">
							<div class="col-lg-8 ml-auto">
	                            <button type="submit" name="updateDevis" class="btn btn-warning">Modifier le devis</button>
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