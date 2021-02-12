<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<?php
#Ajoute du Unité
	if (isset($_POST['ajoutPro'])) {
		# GET DATA FROM THE INPUTS OF THE FORM
		$unite=$_POST['unite'];
		$designation=$_POST['desgProd'];
		$pu=$_POST['puProd'];


		# VALIDATION FORM INPUTS
		if (empty($unite) || empty($designation)) {
			$_SESSION['errorMessage']='Remplir tout les champs';
		}
		elseif (strlen($unite)>24 || strlen($designation)>499) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 24, 499 characters';
		}
		else {
			# QUERY FOR INSERTING DATA TO DATABASE
			$sql="INSERT INTO `unitetb`(`unite`) VALUES (:zuite)";
			$stmt=$connectDB->prepare($sql);
			
			$stmt->bindValue(':zuite',$unite);

			$exec=$stmt->execute();
			# CHECK IF QUERY HAS BEEN SUCCESSFULLY INSERTED
			if ($exec) {
				$sql2="INSERT INTO `produittb`(`designation_produit`, `pu`, `ID_u`) VALUES (:zdesignation_produit,:zpu,LAST_INSERT_ID())";
				$stmt2=$connectDB->prepare($sql2);
				$stmt2->bindValue(':zdesignation_produit',$designation);
				$stmt2->bindValue(':zpu',$pu);
				$exec2=$stmt2->execute();
				if ($exec2) {
					$_SESSION['succesMessage']='Le produit a été ajouté avec succes';
					redirect_to("AddNewDevis.php");
				}
				
			}else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
			}
		}
	}

?>