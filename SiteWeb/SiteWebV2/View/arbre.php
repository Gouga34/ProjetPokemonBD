<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/
?>

<div class = "corp">

// ARBRE


<ul>



					<?php
						for($i=0;$i<count($concepts);$i++){
							echo"<li>".$concepts[$i]->getNomConcept()."</li>";
						}
					?>

		</ul>

</div>



