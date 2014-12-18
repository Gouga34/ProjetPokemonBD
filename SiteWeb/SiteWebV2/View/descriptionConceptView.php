<h1>Concept<?php echo $concept->getNomConcept();?></h1>

<p> 
	<?php
		echo $concept->getDescription();
	?>
</p>

<h2>Terme Vedette<?php echo $vedette->getNomTerme();?></h2>
<p> 
	<?php
		echo $vedette->getDescription();
	?>
</p>
<h3>Synonymes</h3>
<ul>
	<?php
		foreach($synonymes as $syno) {
			echo "<li>".$syno['DEREF(VALUE(LISTESYNONYMES)).NOMSYNONYME']."</li>";
		}
	 ?>
</ul>
