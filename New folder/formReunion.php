	<!-- DEBUT FORM OF L'AJOUT D'UN PRODUIT -->
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<!-- Modal -->
			<div class="modal fade" id="AddNewReunion" tabindex="-1" role="dialog" aria-labelledby="ajoutCommission" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="ajoutCommission">Ajouter une nouvelle commission</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="presComm">Président <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control" id="presComm" name="presComm" placeholder="Enter le président de la commission..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="mem1Comm">Membre 1 <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="mem1Comm" name="mem1Comm" placeholder="Enter membre 1 de la commission..">
                        </div>
					</div>
					
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="mem2Comm">Membre 2 <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="mem2Comm" name="mem2Comm" placeholder="Enter membre 2 de la commission..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dateComm">Date <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="dateComm" name="dateComm" placeholder="Enter la date de la commission..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="heureComm">Heure <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="heureComm" name="heureComm" placeholder="Enter heure de la commission..">
                        </div>
					</div>
			
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
			        <button type="submit" name="ajoutCommission" class="btn btn-primary">Ajouter Commission</button>
			      </div>
			    </div>
			  </div>
			</div>
			</form>
			<!-- FIN FORM OF L'AJOUT D'UN PRODUIT -->
			
			<!-- DEBUT FORM OF L'AJOUT D'UN DEVIS -->
