<?php

abstract class Controller {
    // brief case.... carry around template data
    var $state; 

    abstract public function error();

    // load the view and return its contents
    public function loadView($view){
        
        // dynamically include the view
        ob_start();
        include("views/".$view.".php");
        $content = ob_get_contents(); 
        ob_clean(); 


        // this method needs to return the html from the view
        return $content;
    }

}

?>