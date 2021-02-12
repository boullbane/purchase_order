<div class="table-responsive">
	<div class="card-header text-center mb-3">
		<h2>Liste de tout les marchers</h2>
	</div>
	<div class="mb-3 offset-10 ">
		<a href="pages/AddNewMarche.php" class="btn btn-primary">Ajouter un Marché</a>
	</div>
	<table class="table table-striped">
		<thead class="table-dark">
			<tr>
				<th>#</th>
				<th>Objet du marché</th>
				<th>Date de lancement</th>
				<th>Date depot</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$sql="SELECT marchetb.ID_marche, marchetb.objet_marche, datetb.date_lancement, datetb.date_depot FROM marchetb INNER JOIN datetb WHERE marchetb.ID_marche=datetb.ID_date ";
		$stmt=$connectDB->query($sql);
		$compter=0;
		while ($dataRows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$id=$dataRows['ID_marche'];
			$objet=$dataRows['objet_marche'];
			$dlance=$dataRows['date_lancement'];
			$ddpot=$dataRows['date_depot'];
			$compter++;
			?>
			<tr>
				<td><?php echo $compter; ?></td>
				<td><?php
				 if (strlen($objet)>70) {
				 	$objet=substr($objet, 0, 70).'...';
				 }
				 echo $objet; 
				 ?></td>
				<td><?php echo $dlance; ?></td>
				<td><?php echo $ddpot; ?></td>
				<td><a href="pages/EditMarche.php?page=<?php echo $id; ?>"><i class="fas fa-edit text-warning"></i></a></td>
				<td><a href="pages/DeleteMarche.php?page=<?php echo $id; ?>"><i class="fas fa-trash-alt text-danger"></i></a></td>
			</tr>
			<?php } ?>	
		</tbody>
					
	</table>
</div>