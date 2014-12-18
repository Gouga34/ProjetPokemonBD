<?php

    /**
    *
    * @author Lopez jimmy
    *
    */
?>

<div class = "connexion">
        <form action="./index.php?page=connexionUser" method="post">
       
            <table>
           
            <tr>
           
            <td><label for="login"><strong>Nom du compte :</strong></label></td>
            <td><input type="text" name="login" id="login"/></td>
           
            </tr>
           
            <tr>
           
            <td><label for="password"><strong>Mot de passe :</strong></label></td>
            <td><input type="password" name="password" id="password"/></td>
           
            </tr>
           
       
            
            </table>
       
        <input type="submit" name="connect" value="Se connecter"/>
       
        </form>
</div>