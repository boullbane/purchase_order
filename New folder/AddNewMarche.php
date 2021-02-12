<?php
	require_once '../includes/database/db.php';
	require_once '../includes/functions/sessions.php';
	require_once '../includes/functions/redirect.php';
	require_once '../includes/functions/loginfunc.php';
	$_SESSION['trackingURL']=$_SERVER['PHP_SELF'];
	confirmLogin('../');

	if (isset($_POST['ajoutMarche'])) {
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
		}
		elseif (strlen($objet)<3 || strlen($dlance)<3 || strlen($hlance)<3 || strlen($dLimite)<3 || strlen($hLimite)<3 || strlen($dOuver)<3 || strlen($hOuver)<3 || strlen($dDepo)<3 || strlen($hDepo)<3 || strlen($modeLance)<3 || strlen($dReception)<3 || strlen($hReception)<3) {
			$_SESSION['errorMessage']='Tout les champs doit etre grand de 3 characters';
		}
		elseif (strlen($objet)>499 || strlen($dlance)>24 || strlen($hlance)>24 || strlen($dLimite)>24 || strlen($hLimite)>24 || strlen($dOuver)>24 || strlen($hOuver)>24 || strlen($dDepo)>24 || strlen($hDepo)>24 || strlen($modeLance)>24 || strlen($dReception)>24 || strlen($hReception)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 49,254,24 characters';
		}
		else {
			$sql="INSERT INTO `datetb`(`date_lancement`, `heure_lancement`, `date_limite`, `heure_limite`, `date_ouverture`, `heure_ouverture`, `date_depot`, `heure_depot`, `date_reciption`, `heure_reciption`) VALUES (:zdate_lancement,:zheure_lancement,:zdate_limite,:zheure_limite,:zdate_ouverture,:zheure_ouverture,:zdate_depot,:zheure_depot,:zdate_reciption,:zheure_reciption)";
			$stmt=$connectDB->prepare($sql);
			
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
			if ($exec) {
				$sql2="INSERT INTO `marchetb`(`objet_marche`, `mode_lancement`, `id_date`) VALUES (:zobjet,:zmodeLance,LAST_INSERT_ID())";
				$stmt=$connectDB->prepare($sql2);
				$stmt->bindValue(':zobjet',$objet);
				$stmt->bindValue(':zmodeLance',$modeLance);
				$exec2=$stmt->execute();
				if ($exec2) {
					$_SESSION['succesMessage']='Le marché a été ajouté avec succes';
					redirect_to("AddNewLettre.php");
				}
				
			}else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
			}
		}


	}

?>
