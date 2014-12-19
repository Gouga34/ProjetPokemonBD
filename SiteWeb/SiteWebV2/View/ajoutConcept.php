<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/

?>

<div class = "corp">
	<h1> Creation d'un concept </h1>

	<form method="post" action="./index.php?page=conceptAjoute">
		<table>
			<tr>
				<td> <label>Nom terme vedette: </label> </td>
				<td> <input type='text' name='nomTerme' value="<?php if(isset($_POST['nomConcept'])) echo $_POST['nomConcept']; ?>" required/> </td>
			</tr>

			<tr>
				<td> <label>Description terme vedette : </label> </td>
				<td> <textarea type="text" name="descriptionTerme"> </textarea>
			</tr>
			<tr>
				<td> <label>Parent : </label> </td>
				<td>
					<select name="parents">
						<option>Aucun</option>
						<?php
							for($i=0;$i<count($concepts);$i++){
								echo"<option>".$concepts[$i]->getNomConcept()."</option>";
							}
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td> <label>Description Concept: </label> </td>
				<td> <textarea type="text" name="descriptionConcept"> </textarea></td> 
			</tr>
		</table>
		<input type='submit' name='create' value="Créer le concept" />
	</form>
</div>
