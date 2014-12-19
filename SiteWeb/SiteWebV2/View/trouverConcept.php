<div class = "corp">

<h1> Rechercher un concept </h1>

<p>  <?php 

	foreach($concept as $c){
		echo "<br/><a href=\"./index.php?page=arbre&nConcept=".$c->getNomConcept()."\">".$c->getNomConcept()."</a>";
	}
	 ?>  </p>

</div>
