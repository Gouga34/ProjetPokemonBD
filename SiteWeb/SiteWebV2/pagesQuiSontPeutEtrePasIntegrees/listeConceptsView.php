<h1> Liste des Concepts </h1>


<table>
	<?php
		foreach ($termes as $terme) 
		{
			?>
				<tr>
					<td> <a href="#"> <?php echo $terme['NOMTERME'] ?> </a> </td>
				</tr>
			<?php
		}
	?>
</table>