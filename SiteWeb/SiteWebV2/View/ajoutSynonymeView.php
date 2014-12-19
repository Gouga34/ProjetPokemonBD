<div class="body">
<h1> Creation d'un synonyme </h1>

<form method="post" action="./index.php?page=synonymeAjoute">
	<table>
		<tr>
			<td> <label>Terme associé : </label> </td>
			<td>
				<select name="terme">
					<?php
						for($i=0;$i<count($termes);$i++){
							echo "<option>".$termes[$i]->getNomTerme()."</option>";
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

</div>
