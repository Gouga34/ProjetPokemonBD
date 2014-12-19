
<div class = "corp">
<h1> Liste des Concepts </h1>

<table>
	<?php
		

		for($i = 0; $i < count($concepts); $i++) 
		{
		
			?>
				<tr>
					<td> <a href="./index.php?page=arbre&nConcept=<?php echo $concepts[$i]->getNomConcept(); ?>"> <?php echo $concepts[$i]->getNomConcept(); ?> </a> </td>
				</tr>
			<?php
		}
	?>
</table>

</div>
