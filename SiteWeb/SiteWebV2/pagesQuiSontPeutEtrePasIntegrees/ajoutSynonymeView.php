<h1> Creation d'un synonyme </h1>

<form method="post" action="./synonymeAjouteController.php">
	<table>
		<tr>
			<td> <label>Terme associé : </label> </td>
			<td>
				<select name="terme">
					<?php
						foreach($termes as $terme)
						{
							echo "<option>".$terme['NOMTERME']."</option>";
						}
					?>
				</select>
			</td>
		</tr>

		<tr>
			<td> <label>Nom : </label> </td>
			<td> <input type='text' name='nomSynonyme' value="<?php if(isset($_POST['nomSynonyme'])) echo $_POST['nomSynonyme']; ?>" required/> </td>
		</tr>
	</table>
	<input type='submit' name='create' value="Créer le synonyme" />
</form>
