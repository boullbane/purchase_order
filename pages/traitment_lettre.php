<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<?php
#Ajoute du Marché
	if (isset($_POST['ajoutMarche'])) {
		# GET DATA FROM THE INPUTS OF THE FORM
		$objet=$_POST['objetma'];
		$dlance=$_POST['dlance'];
		$hlance=$_POST['hlance'];
		$dLimite=$_POST['dLimite'];
		$hLimite=$_POST['hLimite'];
		$dOuver=$_POST['dOuver'];
		$hOuver=$_POST['hOuver'];
		$dDepo=$_POST['dDepo'];
		$hDepo=$_POST['hDepo'];
		$mLance=$_POST['mLance'];
		$dReception=$_POST['dReception'];
		$hReception=$_POST['hReception'];


		# VALIDATION FORM INPUTS
		if (empty($objet) || empty($dlance) || empty($hlance) || empty($dLimite) || empty($hLimite) || empty($dOuver) || empty($hOuver) || empty($dDepo) || empty($hDepo) || empty($mLance) || empty($dReception) || empty($hReception)) {
			$_SESSION['errorMessage']='Remplir tout les champs';
		}
		elseif (strlen($objet)<3 || strlen($dlance)<3 || strlen($hlance)<3 || strlen($dLimite)<3 || strlen($hLimite)<3 || strlen($dOuver)<3 || strlen($hOuver)<3 || strlen($dDepo)<3 || strlen($hDepo)<3 || strlen($mLance)<3 || strlen($dReception)<3 || strlen($hReception)<3) {
			$_SESSION['errorMessage']='Tout les champs doit etre grand de 3 characters';
		}
		elseif (strlen($objet)>499 || strlen($dlance)>24 || strlen($hlance)>24 || strlen($dLimite)>24 || strlen($hLimite)>24 || strlen($dOuver)>24 || strlen($hOuver)>24 || strlen($dDepo)>24 || strlen($hDepo)>24 || strlen($mLance)>24 || strlen($dReception)>24 || strlen($hReception)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 499,24 characters';
		}
		else {
			# QUERY FOR INSERTING DATA TO DATABASE
			global $connectDB;
			$sql="INSERT INTO `marchetb` (`objet_marche`, `mode_lancement`,`date_lancement`, `heure_lancement`, `date_limite`, `heure_limite`, `date_ouverture`, `heure_ouverture`, `date_depot`, `heure_depot`, `date_reciption`, `heure_reciption`)";
			$sql .=" VALUES (:z_objet, :z_mLance,:zdate_lancement,:zheure_lancement,:zdate_limite,:zheure_limite,:zdate_ouverture,:zheure_ouverture,:zdate_depot,:zheure_depot,:zdate_reciption,:zheure_reciption)";
			$stmt=$connectDB->prepare($sql);
			$stmt->bindValue(':z_objet',$objet);
			$stmt->bindValue(':z_mLance',$mLance);
			$stmt->bindValue(':zdate_lancement',$dlance);
			$stmt->bindValue(':zheure_lancement',$hlance);
			$stmt->bindValue(':zdate_limite',$dLimite);
			$stmt->bindValue(':zheure_limite',$hLimite);
			$stmt->bindValue(':zdate_ouverture',$dOuver);
			$stmt->bindValue(':zheure_ouverture',$hOuver);
			$stmt->bindValue(':zdate_depot',$dDepo);
			$stmt->bindValue(':zheure_depot',$hDepo);		
			$stmt->bindValue(':zdate_reciption',$dReception);
			$stmt->bindValue(':zheure_reciption',$hReception);
			$exec=$stmt->execute();
			
			# CHECK IF QUERY HAS BEEN SUCCESSFULLY INSERTED
			if ($exec) {
				
				$_SESSION['succesMessage']='Le marché a été ajouté avec succes';
				redirect_to("AddNewLettre.php");
			
				
			}else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
			}
		}
	}

	#Ajoute du Societe
	if (isset($_POST['ajoutSoc'])) {
		# GET DATA FROM THE INPUTS OF THE FORM
		$nameSociete=$_POST['nomSoc'];
		$adrSociete=$_POST['adrSoc'];
		$telSociete=$_POST['telSoc'];


		# VALIDATION FORM INPUTS
		if (empty($nameSociete) || empty($adrSociete) || empty($telSociete)) {
			$_SESSION['errorMessage']='Remplir tout les champs';

		}
		elseif (strlen($nameSociete)<3 || strlen($adrSociete)<3 || strlen($telSociete)<3) {
			$_SESSION['errorMessage']='Tout les champs doit etre grand de 3 characters';

		}
		elseif (strlen($nameSociete)>49 || strlen($adrSociete)>254 || strlen($telSociete)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 49,254,24 characters';

		}
		else {
			# QUERY FOR UPDATING DATA TO DATABASE
			$sql="INSERT INTO fournisseurtb(nomF,adrF,telF)";
			$sql.="VALUES (:znomF,:zadrF,:ztelF)";
			$stmt=$connectDB->prepare($sql);
			$stmt->bindValue(':znomF',$nameSociete);
			$stmt->bindValue(':zadrF',$adrSociete);
			$stmt->bindValue(':ztelF',$telSociete);
			$exec=$stmt->execute();

			# CHECK IF QUERY HAS BEEN SUCCESSFULLY INSERTED
			if ($exec) {
				$_SESSION['succesMessage']='La societe est ajouté avec succes';
				redirect_to("AddNewLettre.php");
			}else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';

			}
		}


	}
?>