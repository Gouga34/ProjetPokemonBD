<div class = "corp">

<h1> Ajout d'un fils à un concept </h1>

<form method="post" action="./index.php?page=ajoutFils">

	<select name="parent">
		<?php
			foreach($termes as $terme)
			{
				echo "<option>".$terme['NOMTERME']."</option>";
			}
		?>
	</select>

	<select name="fils">
		<?php
			foreach($termes as $terme)
			{
				echo "<option>".$terme['NOMTERME']."</option>";
			}
		?>
	</select>

	<input type='submit' name='create' value="Créer le fils" />
</form>

</div>