
<div class="table-responsive">
	<div class="card-header text-center mb-3">
		<h2>Liste de tout les societes</h2>
	</div>
	<div class="mb-3 offsetDyali">
		<a href="pages/AddNewSoc.php" class="btn btn-primary">Ajouter une societe</a>
	</div>
	<table class="table table-hover table-striped">
		<thead class="table-dark">
			<tr>
				<th>#</th>
				<th>Nom de societe</th>
				<th>Addresse de societe</th>
				<th>Telephone de societe</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$sql="SELECT * FROM fournisseurtb";
		$stmt=$connectDB->query($sql);
		$compter=0;
		while ($dataRows = $stmt->fetch()) {
			$id=$dataRows['ID_f'];
			$nomSoc=$dataRows['nomF'];
			$adrSoc=$dataRows['adrF'];
			$telSoc=$dataRows['telF'];
			$compter++;
			?>
			<tr>
				<td><?php echo $compter; ?></td>
				<td><?php if (strlen($nomSoc)>20){
					$nomSoc=substr($nomSoc, 0, 20).' ...';
					}
					echo $nomSoc; ?></td>
				<td><?php if (strlen($adrSoc)>25){
					$adrSoc=substr($adrSoc, 0, 25).' ...';
					}echo $adrSoc; ?></td>
				<td><?php echo $telSoc; ?></td>
				<td><a href="pages/EditSoc.php?page=<?php echo $id; ?>"><i class="fas fa-edit text-warning"></i></a></td>
				<td><a href="pages/DeleteSoc.php?page=<?php echo $id; ?>"><i class="fas fa-trash-alt text-danger"></i></a></td>
			</tr>
		<?php } ?>
		</tbody>				
	</table>
</div>


