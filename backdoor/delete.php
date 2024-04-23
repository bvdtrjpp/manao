<?php 

    require 'functions/dataCRUD.php';
    session_start();

    if($_SESSION['logged_in'] === true){


        deleteUser($_SESSION['login']);
        session_unset();
        session_destroy();



        echo 'ok';
    }
    else{
        echo 'noSession';
    }