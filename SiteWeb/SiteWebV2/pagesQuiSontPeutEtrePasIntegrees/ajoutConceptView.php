<h1> Creation d'un concept </h1>

<form method="post" action="./conceptAjouteController.php">
	<table>
		<tr>
			<td> <label>Nom : </label> </td>
			<td> <input type='text' name='nomTerme' value="<?php if(isset($_POST['nomTerme'])) echo $_POST['nomTerme']; ?>" required/> </td>
		</tr>
		
		<tr>
			<td> <label>Description : </label> </td>
		 	<td> <input type="text" name="description"> </td>
		</tr>

		<tr>
			<td> <label>Parent : </label> </td>
			<td>
				<select name="parents">
					<?php
						foreach($termes as $terme)
						{
							echo"<option>".$terme['NOMTERME']."</option>";
						}
					?>
				</select>
			</td>
		</tr>
	</table>
	<input type='submit' name='create' value="Créer le concept" />
</form>
