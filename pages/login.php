<?php

session_start();
if(isset($_SESSION['logged_in'])){
    if($_SESSION['logged_in'] === true)
    header('Location: ../index.php');

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>

    <link rel="stylesheet" href="../style.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="../scripts/registerEvent.js"></script>
    <script src="../scripts/registerCheckForm.js"></script>
    <script src="../scripts/loginEvent.js"></script>
</head>
<body>
    <div class="conteiner">

        <div class="text_block">
            <h1 class="body_title">Добро пожаловать!</h1>
            <p class="body_subtitle">пожалуйста, войдите в аккаунт</p>
        </div>
        <form action="../backdoor/loginUser.php" method="post" id="enterForm">

            <div class="form_block">
                <input type="text" name="userLogin" class="form_input" placeholder="Логин" data-label="enter_login_input" >
                <p class="form_message" data-label="symbol_error">логин введен неверно</p>
                
            </div>
            <div class="form_block">
                <input type="password" name="userPassword" class="form_input" placeholder="Пароль" data-label="enter_password_input">
                <p class="form_message" data-label="symbol_error">пароль введен неверно</p>
            </div>
            <p id="needToCompleteMessage">нужно заполнить все поля или <a href="register.php">зарегестрируйтесь</a></p>
            <button type="submit" id="enterButton" disabled>Log in</button>
        </form>

    </div>
</body>
</html>