<?php

    class Categorias Extends Controller {

        function __construct() {

            parent ::__construct();
            
            
        }

        function render() {

            $this->view->render('categorias/index');
        }
    }

?>