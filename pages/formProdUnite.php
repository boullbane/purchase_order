<?php

    ######################################
    # - Coded by @boullabne -| ABDHON |- #
	######################################
     
?>
	<!-- DEBUT FORM OF L'AJOUT D'UN PRODUIT -->
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<!-- Modal -->
			<div class="modal fade" id="AddNewProduit" tabindex="-1" role="dialog" aria-labelledby="ajoutPro" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="ajoutPro">Ajouter un nouveau produit</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="desgProd">Designation du produit <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control" id="desgProd" name="desgProd" placeholder="Enter la designation du produit..">
                        </div>
					</div>
					<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="puProd">P.U <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="puProd" name="puProd" placeholder="Enter prix unitaire du produit..">
                        </div>
					</div>
					
			      	<div class="form-group row">
						<label class="col-lg-4 col-form-label" for="unite">Unité <span class="text-danger">*</span></label>
						<div class="col-lg-8">
                            <input type="text" class="form-control" id="unite" name="unite" placeholder="Enter unité du produit..">
                        </div>
					</div>
			
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
			        <button type="submit" name="ajoutPro" class="btn btn-primary">Ajouter Produit</button>
			      </div>
			    </div>
			  </div>
			</div>
			</form>
			<!-- FIN FORM OF L'AJOUT D'UN PRODUIT -->
			
			<!-- DEBUT FORM OF L'AJOUT D'UN DEVIS -->
