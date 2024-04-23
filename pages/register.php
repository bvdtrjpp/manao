<?php

session_start();
if(isset($_SESSION['logged_in'])){
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
</head>
<body>
    <div class="conteiner">

        <div class="text_block">
            <h1 class="body_title">Добро пожаловать!</h1>
            <p class="body_subtitle">пожалуйста, зарегестрируйтесь</p>
        </div>
        <form action="../backdoor/registerUser.php" method="post" id="registerForm">
            <div class="form_block">
                <input type="text" name="userName" class="form_input" placeholder="Имя" data-label="name_input">
                <p class="form_message" data-label="symbol_error">имя должно состоять минимум из 2 символов</p>
            </div>
            <div class="form_block">
                <input type="text" name="userLogin" class="form_input" placeholder="Логин" data-label="login_input">
                <p class="form_message" data-label="symbol_error">логин должен состоять минимум из 6 символов</p>
                <p class="form_message" data-label="exist_error" style="display: none;">логин уже существует, <a href="login.php">войдите</a></p>
            </div>
            <div class="form_block">
                <input type="password" name="userPassword" class="form_input" placeholder="Пароль" data-label="password_input">
                <p class="form_message" data-label="symbol_error">пароль должен состоять минимум из 6 символов, и содержать в себе цифры и буквы</p>
            </div>
            <div class="form_block">
                <input type="password" class="form_input" placeholder="Повторите пароль" data-label="confirmPassword_input" disabled>
                <p class="form_message" data-label="symbol_error">пароли не совпадают</p>
            </div>
            <div class="form_block">
                <input type="email" name="userEmail" class="form_input" placeholder="Почта" data-label="email_input">
                <p class="form_message" data-label="symbol_error">почта введена неверно</p>
                <p class="form_message" data-label="exist_error" style="display: none;">почта уже существует, <a href="login.php">войдите</a></p>
            </div>
            <p id="needToCompleteMessage">нужно заполнить все поля</p>
            <button type="submit" id="sendButton" disabled>Log in</button>
        </form>

    </div>
</body>
</html>