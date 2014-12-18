<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/

?>
<section>
	<div class="container-fluid">
		<div id = "myThesoPanel" class="panel panel-primary">
			<div class="panel-heading">
				<h3> Mes Pokésaurus :</h3>
			</div>
			<div class="panel-body"> 
				<div class="panel-group" id="myTheso" role="tablist" aria-multiselectable="true">
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="myThesoOne">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#myTheso" aria-expanded="true" href="#collapseMyThesoOne" aria-controls="collapseMyThesoOne">
									Pokésaurus : Pokemon <span class="glyphicon glyphicon-chevron-down"></span>
								</a>

							</h4>
						</div>
						<div id="collapseMyThesoOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="myThesoOne">
							<div class="panel-body">
								<p> Descriptif : Une petit thésaurus sur les pokémons </p>
								<a href="file:///home/jimmy/Bureau/Pokesaurus/thesaurus.html" class="btn btn-sm btn-success">Visualiser thesaurus</a>
							</div>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="myThesoTwo">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" data-parent="#myTheso" aria-expanded="false" href="#collapseMyThesoTwo" aria-controls="collapseMyThesoTwo">
									Pokésaurus : Animaux <span class="glyphicon glyphicon-chevron-down"></span>
								</a>
							</h4>
						</div>
						<div id="collapseMyThesoTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="myThesoTwo">
							<div class="panel-body">
								<p> Descriptif : non renseigné </p>
								<a href="#" class="btn btn-sm btn-success">Visualiser thesaurus</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container-fluid">
		<div id = "otherThesoPanel" class="panel panel-primary">
			<div class="panel-heading">
				<label><h3>Autres Pokésaurus :</h3></label>						

				<span id = "searchOtherTheso"><input type="text"></input></span>
				<span class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i> </span>
				
			</div>
			<div class="panel-body"> 
				<div class="panel-group" id="otherTheso" role="tablist" aria-multiselectable="true">
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="otherThesoOne">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" data-parent="#otherTheso" aria-expanded="false" href="#collapseOtherThesoOne" aria-controls="collapseOtherThesoOne">
									Pokésaurus : Femmes <span class="glyphicon glyphicon-chevron-down"></span>
								</a>
							</h4>
						</div>
						<div id="collapseOtherThesoOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="otherThesoThree">
							<div class="panel-body">
								<p> Auteur : Dumas Geoffrey </p>
								<p> Descriptif : non renseigné </p>
								<a href="#" class="btn btn-sm btn-success">Visualiser thesaurus</a>
							</div>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="otherThesoTwo">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" data-parent="#otherTheso" aria-expanded="false" href="#collapseOtherThesoTwo" aria-controls="collapseOtherThesoTwo">
									Pokésaurus : Hommes <span class="glyphicon glyphicon-chevron-down"></span>
								</a>
							</h4>
						</div>
						<div id="collapseOtherThesoTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="otherThesoTwo">
							<div class="panel-body">
								<p> Auteur : Vidal Morgane </p>
								<p> Descriptif : non renseigné </p>
								<a href="#" class="btn btn-sm btn-success">Visualiser thesaurus</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section>
	<div class = "container-fluid">
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newBoardModal" onclick="resetform('formBoard')"> Créer un nouveau thesaurus </button>

		<div class="modal fade" id="newBoardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Création d'un nouveau thesaurus</h4>
					</div> <!-- /.modal-header -->
					<div class="modal-body">
						<form id="formBoard" class="form-horizontal" method="POST" action="boardTC.html">
							<div class="form-group">
								<label for="titleUser" class="col-sm-4 control-label">Titre :</label> 
								<div id="contenerInputTitleUser" class = "col-sm-8">
									<input class="form-control" id="titleUser" type="text" name="titleBoard" required>
								</div>
							</div>   
							<div class="form-group">
								<label for="descriptifBoardUser" class="col-sm-4 control-label">Descriptif (optionnel)</label>
								<div id="contenerInputdescriptifBoardUser" class = "col-sm-8">
									<textarea class="form-control" rows="3"></textarea>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<p>
							<a class="form-control btn btn-success" href="javascript: submitform('formBoard')" >Créer</a>
						</p>
					</div> 
				</div>
			</div>
		</div>
	</div>
</section>