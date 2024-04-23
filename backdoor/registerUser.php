<?php

require 'functions/dataCRUD.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $user = createUser($_POST['userLogin'], $_POST['userName'], $_POST['userEmail'], $_POST['userPassword']);

    if($user){

        session_start();
        $_SESSION['name'] = $user->getName();
        $_SESSION['login'] = $user->getLogin();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['password'] = $user->getPassword();

        $_SESSION['logged_in'] = true;

        echo 'user registered';

    }else{
        echo 'userCreateFaild';
    }


}