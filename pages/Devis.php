<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<div class="table-responsive">
	<div class="card-header text-center mb-3">
		<h2>Liste de tout les devis</h2>
	</div>
	<div class="mb-3">
		<a href="pages/AddNewDevis.php" class="btn btn-primary">Ajouter un devis</a>
	</div>
	<table id="example" class="table table-striped">
		<thead class="table-dark">
			<tr>
				<th style="width: 5%;">Nº</th>
				<th>Date de devis</th>
				<th>Nom de societé</th>
				<th>Total T.T.C</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			# SHOW DATA QUERY FROM DATABASE
			global $connectDB;
			$sql="SELECT * FROM lignecommandetb INNER JOIN commandetb ON lignecommandetb.ID_cmd=commandetb.ID_cmd 
			INNER JOIN produittb ON lignecommandetb.ref_produit=produittb.ref_produit
			INNER JOIN fournisseurtb ON commandetb.ID_f=fournisseurtb.ID_f
			";
			
			$stmtAffiche=$connectDB->query($sql);
			$compter=0;
			while ($dataRows = $stmtAffiche->fetch()) {
				$idcmd=$dataRows['ID_cmd'];
				$num_cmd=$dataRows['numero_cmd'];
				$datecmd=$dataRows['date_cmd'];
				$nomSoc=$dataRows['nomF'];
				$ttc=$dataRows['pu'] * $dataRows['qte']+5000;
				$compter++;				
			?>
			<tr>
				<td class="table-dark"><?php echo $num_cmd; ?></td>
				<td><?php echo $datecmd; ?></td>
				<td><?php echo $nomSoc; ?></td>
				<td><?php echo $ttc; ?></td>
				<td class="text-center">
					<a class="mr-4" href="pages/editeDevis.php?page=<?php echo $idcmd; ?>"><i class="fas fa-edit text-warning"></i></a>
					<a class="mr-4" href="pages/deleteDevis.php?page=<?php echo $idcmd; ?>"><i class="fas fa-trash-alt text-danger"></i></a>
					<a href="pages/printDevis.php?page=<?php echo $idcmd; ?>"><i class="fas fa-print text-primary"></i></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
					
	</table>

</div>
