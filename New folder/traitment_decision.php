<?php
#Ajoute du commission
	if (isset($_POST['ajoutCommission'])) {
		# get info from formReunion.php
		$president=$_POST['presComm'];
		$mem1=$_POST['mem1Comm'];
		$mem2=$_POST['mem2Comm'];
		$dreunion=$_POST['dateComm'];
		$hreunion=$_POST['heureComm'];

		if (empty($president) || empty($mem1) || empty($mem2) || empty($dreunion) || empty($hreunion) ) {
			$_SESSION['errorMessage']='Remplir tout les champs';
		}
		elseif (strlen($president)>24 || strlen($mem1)>24 || strlen($mem2)>24 || strlen($dreunion)>24 || strlen($hreunion)>24) {
			$_SESSION['errorMessage']='Tout les champs doit etre petit de 24 characters';
		}
		else {
			global $connectDB;
			$sql="INSERT INTO `reuniontb`(`presedent`, `membre1`, `membre2`, `date_reunion`, `heure_reunion`) VALUES(:zpresedent,:zmembre1,:zmembre2,:zdate_reunion,:zheure_reunion)";
			$stmt=$connectDB->prepare($sql);
			
			$stmt->bindValue('zpresedent',$president);
			$stmt->bindValue('zmembre1',$mem1);
			$stmt->bindValue('zmembre2',$mem2);
			$stmt->bindValue('zdate_reunion',$dreunion);
			$stmt->bindValue('zheure_reunion',$hreunion);


			$exec=$stmt->execute();
			if ($exec) {
				// $sql2="UPDATE `commandetb` SET `ID_r`= LAST_INSERT_ID()";
				// $stmt2=$connectDB->prepare($sql2);
				// $exec2=$stmt2->execute();
					$_SESSION['succesMessage']='La commission a été ajouté avec succes';
					redirect_to("AddNewDecision.php");
				// if ($exec2) {
				// 	$_SESSION['succesMessage']='La commission a été ajouté avec succes';
				// 	redirect_to("AddNewDecision.php");
				// }
				
			}else {
				$_SESSION['errorMessage']='il ya un problem d\'ajout, verifiez svp!';
			}
		}
	}

?>