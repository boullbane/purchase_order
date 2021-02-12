<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
<div class="table-responsive">
	<div class="card-header text-center mb-3">
		<h2>Liste de tout les decisions</h2>
	</div>
	<div class="mb-3">
		<a href="pages/AddNewDecision.php" class="btn btn-primary">Ajouter une decision</a>
	</div>
	<table id="example" class="table table-striped">
		<thead class="table-dark">
			<tr>
				<th style="width: 5%;">Nº</th>
				<th>Objet du marché</th>
				<th>Président</th>
				<th>Membre 1</th>
				<th>Membre 2</th>
				<th>Date</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			# QUERY FOR INSERTING DATA TO DATABASE
			global $connectDB;
			$sql="SELECT * FROM reuniontb INNER JOIN marchetb ON reuniontb.ID_marcher=marchetb.ID_marche
			INNER JOIN commandetb ON commandetb.ID_marche=marchetb.ID_marche
            GROUP BY reuniontb.ID_r
			ORDER BY commandetb.numero_cmd ASC";

			$stmtAffiche=$connectDB->query($sql);
			while ($dataRows = $stmtAffiche->fetch()) {
				$idcmd=$dataRows['ID_cmd'];
				$num_cmd=$dataRows['numero_cmd'];
				$president=$dataRows['presedent'];
				$mem1=$dataRows['membre1'];
				$mem2=$dataRows['membre2'];
				$dateDecision=$dataRows['date_reunion'];
				$objetM=$dataRows['objet_marche'];			
			?>
			<tr>
				<td class="table-dark"><?php echo $num_cmd; ?></td>
				<td><?php if (strlen($objetM)>50) {$objetM=substr($objetM, 0, 50).'...';} echo $objetM; ?></td>
				<td><?php if (strlen($president)>7) {$president=substr($president, 0, 7).'...';} echo $president ?></td>
				<td><?php if (strlen($mem1)>7) {$mem1=substr($mem1, 0, 7).'...';} echo $mem1; ?></td>
				<td><?php if (strlen($mem2)>7) {$mem2=substr($mem2, 0, 7).'...';} echo $mem2; ?></td>
				<td><?php if (strlen($dateDecision)>7) {$dateDecision=substr($dateDecision, 0, 7).'...';} echo $dateDecision; ?></td>
				<td class="text-center">
					<a class="mr-4" href="pages/editeDecision.php?page=<?php echo $idcmd; ?>"><i class="fas fa-edit text-warning"></i></a>
					<a class="mr-4" href="pages/deleteDecision.php?page=<?php echo $idcmd; ?>"><i class="fas fa-trash-alt text-danger"></i></a>
					<a href="pages/printDecision.php?page=<?php echo $idcmd; ?>"><i class="fas fa-print text-primary"></i></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
					
	</table>

</div>
