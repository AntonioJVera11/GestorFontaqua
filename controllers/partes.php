<?php

    class Partes Extends Controller {

        function __construct() {

            parent ::__construct();
            
        }

        function render() {

            $this->view->render('partes/index');
        }
    }
?>