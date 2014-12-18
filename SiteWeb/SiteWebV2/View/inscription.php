<?php

    /**
    *
    * @author Lopez jimmy
    *
    */
?>

<div class = "inscription">


        <form action="index.php" method="post">
       
            <table>
           
            <tr>
           
            <td><label for="login"><strong>Nom de compte :</strong></label></td>
            <td><input type="text" name="login" id="login"/></td>
           
            </tr>
           
            <tr>
           
            <td><label for="password"><strong>Mot de passe :</strong></label></td>
            <td><input type="password" name="password" id="password"/></td>
           
           	
            </tr>
           	<tr>
           	<td><label for="ConfirmPassword"><strong>Confirmer mot de passe :</strong></label></td>
            <td><input type="ConfirmPassword" name="ConfirmPassword" id="ConfirmPassword"/></td>
           </td>
       		<tr>
             <td><label for="email"><strong>Email:</strong></label></td>
            <td><input type="email" name="email" id="email"/></td>
       		</tr>
       		       		<tr>
             <td><label for="ConfirmEmail"><strong>Confirmer email:</strong></label></td>
            <td><input type="ConfirmEmail" name="ConfirmEmail" id="ConfirmEmail"/></td>
       		</tr>
            
            </table>
       
        <input type="submit" name="register" value="S'inscrire"/>
       
        </form>


</div>