<?php

require 'functions/dataCRUD.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $userPassInfo = readUserLogin($_POST['userLogin']);
    


    if($userPassInfo !== false){

        $currentPassword = md5($_POST['userPassword'].$userPassInfo['salt']);
        if($currentPassword === $userPassInfo['password']){

            $user = readUser($_POST['userLogin']);
            session_start();
            
            $_SESSION['name'] = $user->getName();
            $_SESSION['login'] = $user->getLogin();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['password'] = $user->getPassword();

            $_SESSION['logged_in'] = true;
            echo 'allCorrect';
        }
        else{
            echo 'passwordIncorrect';
        }

    }
    else{
        echo 'userNotFound';
    }
 
}
else{
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: ".$previousPage);
    } else {
        header("Location: ../index.php");
    }
}