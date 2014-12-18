<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/

class indexController{
    
    public function __construct(){
        
    }
    
    public function defautAction(){
        require_once('./View/home.php');
    }

    public function getAction() {
    	if($_GET['page'] === 'index') {
    		indexController::defautAction();
    	}
    }
}
?>