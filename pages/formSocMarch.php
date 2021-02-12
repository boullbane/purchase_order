<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
	<!-- DEBUT FORM OF L'AJOUT D'UNE SOCIETE -->
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<!-- Modal -->
			<div class="modal fade" id="AddNewSoc" tabindex="-1" role="dialog" aria-labelledby="ajoutSoc" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="ajoutSoc">Ajouter une nouvelle societé</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="nomSoc">Nom de Societé <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control" id="nomSoc" name="nomSoc" placeholder="Enter a nom de societé..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="adrSoc">Adresse de Societé <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="adrSoc" name="adrSoc" placeholder="Enter l'adresse de societé..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="telSoc">Telephone de Societé <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="telSoc" name="telSoc" placeholder="Enter le telephone de societé..">
                        </div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
			        <button type="submit" name="ajoutSoc" class="btn btn-primary">Ajouter Societé</button>
			      </div>
			    </div>
			  </div>
			</div>
			</form>
			<!-- FIN FORM OF L'AJOUT D'UNE SOCIETE -->
			<!-- DEBUT FORM OF L'AJOUT D'UN MARCHE -->
			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
			<!-- Modal -->
			<div class="modal fade" id="AddNewMarche" tabindex="-1" role="dialog" aria-labelledby="ajoutMarche" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="ajoutMarche">Ajouter un nouveau marché</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="objet">Objet du marché <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="objet" name="objetma" placeholder="Enter l'objet du marché..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dlance">La date de lancement <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="dlance" name="dlance" placeholder="Enter la date de lancement..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hlance">L'heure de lancement <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="hlance" name="hlance" placeholder="Enter l'heure de lancement..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dLimite">La date limite <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="dLimite" name="dLimite" placeholder="Enter la date limite..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hLimite">L'heure limite <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="hLimite" name="hLimite" placeholder="Enter l'heure de limite'..">
                        </div>
					</div>
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dOuver">La date d'ouverture <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="dOuver" name="dOuver" placeholder="Enter la date d'ouverture'..">
                        </div>
					</div>
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hOuver">L'heure d'ouverture <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="hOuver" name="hOuver" placeholder="Enter l'heure d'ouverture..">
                        </div>
					</div>
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dDepo">La date de depot <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="dDepo" name="dDepo" placeholder="Enter la date de depot..">
                        </div>
					</div>
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hDepo">L'heure de depot <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="hDepo" name="hDepo" placeholder="Enter l'heure de depot..">
                        </div>
					</div>
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="modeLance">Mode de lancement <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="modeLance" name="mLance" placeholder="Enter Mode de lancement..">
                        </div>
					</div>
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="dReception">La date de réciption <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="dReception" name="dReception" placeholder="Enter la date de réciption..">
                        </div>
					</div>
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="hReception">L'heure de réciption <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="hReception" name="hReception" placeholder="Enter l'heure de réciption..">
                        </div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
			        <button type="submit" name="ajoutMarche" class="btn btn-primary">Ajouter Marché</button>
			      </div>
			 	 </div>
				</div>
			   </div>
			</form>
			<!-- FIN FORM OF L'AJOUT D'UN MARCHE -->
			<!-- DEBUT FORM OF L'AJOUT D'UNE LETTRE -->
