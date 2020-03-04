<?php

    class Partes Extends Controller {

        function __construct() {

            parent ::__construct();
            
        }

        function render() {
            session_start();
            $this->view->render('partes/index');
        }
    }
?>