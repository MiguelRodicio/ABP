<?php

    class Index{

        function __construct(){
            $this->render();
        }

        function render(){
            include_once '../Views/Header_View.php';
            include_once '..Functions/Authentication.php';
        }


    }




?>