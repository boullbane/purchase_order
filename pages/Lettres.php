<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<div class="table-responsive">
	<div class="card-header text-center mb-3">
		<h2>Liste de tout les lettres</h2>
	</div>
	<div class="mb-3">
		<a href="pages/AddNewLettre.php" class="btn btn-primary">Ajouter une lettre</a>
	</div>
	<table id="example" class="table table-striped">
		<thead class="table-dark">
			<tr>
				<th style="width: 5%;">Nº</th>
				<th>Objet du marché</th>
				<th>Nom de societé</th>
				<th>Date Limite</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			global $connectDB;
			$sql="SELECT * FROM commandetb INNER JOIN fournisseurtb ON fournisseurtb.ID_f=commandetb.ID_f
			INNER JOIN marchetb ON marchetb.ID_marche=commandetb.ID_marche
			ORDER BY commandetb.numero_cmd ASC";

			$stmtAffiche=$connectDB->query($sql);
			$compter=0;
			while ($dataRows = $stmtAffiche->fetch()) {
				$idcmd=$dataRows['ID_cmd'];
				$num_cmd=$dataRows['numero_cmd'];
				$objet=$dataRows['objet_marche'];
				$nomSoc=$dataRows['nomF'];
				$dlimite=$dataRows['date_limite'];
				$compter++;
								
			?>
			<tr>
				<td class="table-dark"><?php echo $num_cmd; ?></td>
				<td><?php
					if (strlen($objet)>70) {$objet=substr($objet, 0, 70).'...';}
				 echo $objet; ?></td>
				<td><?php echo $nomSoc; ?></td>
				<td><?php echo $dlimite; ?></td>
				<td class="text-center"><a class="mr-4" href="pages/editeLettres.php?page=<?php echo $idcmd; ?>" ><i class="fas fa-edit text-warning"></i></a>
				<a class="mr-4" href="pages/deleteLettres.php?page=<?php echo $idcmd; ?>"><i class="fas fa-trash-alt text-danger"></i></a>
				<a href="pages/printLettres.php?page=<?php echo $idcmd; ?>"><i class="fas fa-print text-primary"></i></a></td>
			</tr>
			<?php } ?>
		</tbody>
					
	</table>

</div>
