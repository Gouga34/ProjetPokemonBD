
<div class = "corp">
<h1>liste des termes Vedettes</h1>
<p> 
<table>
	<?php
		for($i = 0; $i < count($termesV); $i++) 
		{	
			?>
				<tr>
					<td> <a href="#"> <?php echo $termesV[$i]->getNomTerme(); ?> </a> </td>
				</tr>
			<?php
		}
	?>
</table>
</p>

</div>
