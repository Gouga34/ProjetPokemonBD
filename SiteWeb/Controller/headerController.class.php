<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/

class headerController{

    public function __construct(){
        
    }
    
    public function defautAction(){

        require_once('./View/headerHome.php');
    }

    public function headerAction() {
    	require_once('./View/header.php');
    }

    public function getAction() {
    	if($_GET['page'] === 'index') {
    		headerController::defautAction();
    	}
    	else {
    		headerController::headerAction();
    	}
    }
}
?>