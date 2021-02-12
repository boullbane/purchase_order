<div class="table-responsive">
	<div class="card-header text-center mb-3">
		<h2>Liste de tout les membres des commission</h2>
	</div>
	<div class="mb-3 offsetR">
		<a href="pages/AddNewReu.php" class="btn btn-primary">Ajouter une commission</a>
	</div>
	<table class="table table-hover">
		<thead class="table-dark">
			<tr>
				<th>#</th>
				<th>Président</th>
				<th>Membre 1</th>
				<th>Membre 2</th>
				<th>Date reunion</th>
				<th>Heure reunion</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$sql="SELECT * FROM reuniontb";
		$stmt=$connectDB->query($sql);
		$compter=0;
		while ($dataRows = $stmt->fetch()) {
			$id=$dataRows['ID_r'];
			$president=$dataRows['presedent'];
			$mem1=$dataRows['membre1'];
			$mem2=$dataRows['membre2'];
			$dreu=$dataRows['date_reunion'];
			$hreu=$dataRows['heure_reunion'];
			$compter++;
			?>
			<tr>
				<td><?php echo $compter; ?></td>
				<td><?php echo $president; ?></td>
				<td><?php echo $mem1; ?></td>
				<td><?php echo $mem2; ?></td>
				<td><?php echo $dreu; ?></td>
				<td><?php echo $hreu; ?></td>
				<td><a href="pages/EditReu.php?page=<?php echo $id; ?>"><i class="fas fa-edit text-warning"></i></a></td>
				<td><a href="pages/DeleteReu.php?page=<?php echo $id; ?>"><i class="fas fa-trash-alt text-danger"></i></a></td>
			</tr>
		<?php } ?>
		</tbody>				
	</table>
</div>


