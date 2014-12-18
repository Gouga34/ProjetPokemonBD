<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/

	class boardController{

    public function __construct(){
        
    }
    
    public function defautAction(){

        require_once('./View/board.php');
    }

    public function getAction() {
    	if($_GET['page'] === 'board') {
    		boardController::defautAction();
    	}
    }
}
?>