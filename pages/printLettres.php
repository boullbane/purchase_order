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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BDC app | Lettre</title>
	<link rel="stylesheet" href="../css/Prtints_style/lettre_style.css">
	<link rel="icon" href="../IMAGES/fiveicon.png">
</head>
<body onload="myFunction()">
	<?php 
	global $connectDB;
			$sql="SELECT * FROM commandetb INNER JOIN fournisseurtb ON fournisseurtb.ID_f=commandetb.ID_f
			INNER JOIN marchetb ON marchetb.ID_marche=commandetb.ID_marche
			
			WHERE ID_cmd='$searchQuery' ORDER BY commandetb.numero_cmd ASC";

			$stmt=$connectDB->query($sql);

			$row= $stmt->fetch();
?>
	<div class="container" >
		<div class="preview">
			<div class="header">
				<div class="title">
					Royaume du Maroc<br/>
					<img src="../images/logo_small.png" alt="">
				</div>
				<span class="numero">Nº&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2020</span>
				<span class="date">GUELMIM, LE</span>
				<p>le directeur de l'agence du bassin hydraulique de draa oued noun <br> guelmim</p>
			</div>
			<div class="main">
				<p>monsieur le directeur de la societe <strong><?php  echo $row['nomF']; ?></strong><br>addresse <strong> <?php  echo $row['adrF']; ?></strong></p>
				<p>tel/fax: <strong><?php  echo $row['telF']; ?></strong></p>
				<p><strong>objet</strong>: demande de devis pour <span><?php  echo $row['objet_marche']; ?></span></p>
				<p><strong>P.J:</strong> - Modèle de devis</p>
				<p>&nbsp; &nbsp; &nbsp; &nbsp;j'ai l'honneur de vous demander de bien vouloir établir, selon le modèle ci-joint, et m'envoyer sous plis cacheté un devis pour <span><?php  echo $row['objet_marche']; ?></span></p>
				<p>&nbsp; &nbsp; &nbsp; &nbsp;la date limite de dépôt des offres est fixée le <strong><?php  echo $row['date_limite']; ?></strong>&nbsp;à&nbsp;&nbsp;<strong><?php  echo $row['heure_limite'];  ?></strong></p>
			</div>
			<div class="footer">
				<strong>Agence du Bassin Hydraulique de Draa Oued Noun</strong>
				Avenue Mohmed VI. BP: 1351 Guelmim
				<br>Tél: 0528772641/ Fax: 0528772642
			</div>
		</div>
	</div>

<script>
window.onafterprint = function(e){
    closePrintView();
};

function myFunction(){
    window.print();
}

function closePrintView() {
    window.location.href = '../dashboard.php?pageName=Lettres';   
}
</script>
	
</body>
</html>