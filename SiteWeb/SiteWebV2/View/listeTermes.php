
<div class = "corp">
<h1>Afficher liste des termes Vedettes</h1>
<p> 
<table>
	<?php
		foreach ($termesV as $termeV) 
		{
			?>
				<tr>
					<td> <a href="#"> <?php echo $termeV['NOMTERME'] ?> </a> </td>
				</tr>
			<?php
		}
	?>
</table>
</p>

</div>