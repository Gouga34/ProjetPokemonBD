<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/

?>

<section>
	<div class="container-fluid">
		<p>Pokesaurus est gratuit, flexible et permet de visualiser la création de thésaurus avec n'importe qui. </p>
	</div>
</section>

<section>
	<div class="container-fluid">
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#signUpTCModal" onclick="resetform('formRegister')"> Inscription - c'est gratuit </button>
		<p id = "orIndexTC"> ou </p>
		<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#logInTCModal" onclick="resetform('formLog')"> Connexion </button>

		<div class="modal fade" id="logInTCModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Connexion à Pokésaurus</h4>
					</div> 
					<div class="modal-body">
						<form id="formLog" method="POST" action="index.php?page=board">
							<div class="form-group">
								<div class="input-group">
									<label for="uLogin" class="input-group-addon primary glyphicon glyphicon-user"></label>
									<input type="text" class="form-control" id="uLogin" name="login" placeholder="Email">
								</div>
							</div> 
							<div class="form-group">
								<div class="input-group">
									<label for="uPassword" class="input-group-addon primary glyphicon glyphicon-lock"></label>
									<input type="password" class="form-control" id="uPassword" name="password" placeholder="Mot de passe">
								</div> 
							</div> 
							<div class="checkbox">
								<label>
									<input type="checkbox"> Se souvenir de moi
								</label>
							</div> 
							<div id="forgotPassword"><a href="#">Mot de passe oublié ?</a></div>
						</form>
					</div> 
					<div class="modal-footer">
						<p>
							<a class="form-control btn btn-primary" href="javascript: submitform('formLog')">Connexion</a>
						</p>
					</div> 
				</div>
			</div>
		</div>

		<div class="modal fade" id="signUpTCModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Inscription à Pokésaurus</h4>
					</div> <!-- /.modal-header -->
					<div class="modal-body">
						<form id="formRegister" class="form-horizontal" method="POST" action="board">
							<div class="form-group">
								<label for="prenomUser" class="col-sm-4 control-label">Prénom :</label> 
								<div id="contenerInputPrenomUser" class = "col-sm-8 has-error has-feedback">
									<input class="form-control" id="prenomUser" type="text" name="firstName" required>
									<span id="SpanPrenomUser"class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>

							<div class="form-group">
								<label for="nomUser" class="col-sm-4 control-label">Nom:</label> 
								<div id="contenerInputNomUser" class = "col-sm-8 has-error has-feedback"> 
									<input class="form-control" id="nomUser" type="text" name="lastName" required>
									<span id="SpanNomUser"class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>

							<div class="form-group">
								<label for="emailUser" class="col-sm-4 control-label">Email :</label> 
								<div id="contenerInputEmailUser" class = "col-sm-8 has-error has-feedback">
									<input class="form-control" id="emailUser" type="email" name="email" required>
									<span id="SpanEmailUser"class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>

							<div class="form-group">
								<label for="confirmEmailUser" class="col-sm-4 control-label">Confirmer email :</label> 
								<div id="contenerInputConfirmEmailUser" class = "col-sm-8 has-error has-feedback">
									<input class="form-control" id="confirmEmailUser" type="email" name="email2" required> 
									<span id="SpanConfirmEmailUser"class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>

							<div class="form-group">
								<label for="passwordUser" class="col-sm-4 control-label">Mot de passe :</label> 
								<div id="contenerInputPasswordUser" class = "col-sm-8 has-error has-feedback">
									<input class="form-control" id="passwordUser" type="password" name="password" required> 
									<span id="SpanPasswordUser"class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>

							<div class="form-group">
								<label for="confirmPasswordUser" class="col-sm-4 control-label">Conformer mot de passe:</label> 
								<div id="contenerInputConfirmPasswordUser" class = "col-sm-8 has-error has-feedback">
									<input class="form-control" id="confirmPasswordUser" type="password" name="password2" required> 
									<span id="SpanConfirmPasswordUser"class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>    
						</form>
					</div>
					<div class="modal-footer">
						<p>
							<a class="form-control btn btn-primary" href="javascript: submitform('formRegister')" >Inscription</a>
						</p>
					</div> 
				</div>
			</div>
		</div>
	</div> 
</section>