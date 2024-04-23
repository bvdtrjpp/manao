<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="scripts/sessionAbort.js"></script>
</head>
<body>
    <?php 

        if(session_start()){
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo "<p>Здравствуйте ".$_SESSION['name'] . "</p>";
            } else {
                session_destroy();
                header("Location: pages/login.php");
            }
            
        }
        else{
            header("Location: pages/login.php");
        }

    ?>
    <button type="button" id="leaveButton">выйти</button>
    <button type="button" id="deleteAccount">удалить аккаунт</button>
</body>
</html>