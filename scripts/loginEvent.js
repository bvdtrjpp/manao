$(document).ready(function () {
    
    let button = $("#enterButton");

    $(button).click(function (event) { 
        event.preventDefault();
        if(checkValidInputs()){ 
            sendForm(); 
        }      
        return false;
    });

});

function sendForm(){

    let formData = $("#enterForm").serialize();

    $.ajax({
        type: "POST",
        url: "../backdoor/loginUser.php",
        data: formData,
        success: function (response) {
            if(response === "allCorrect"){
                window.location.href = '../index.php';
            }
            else if(response === 'userNotFound'){
                $('#needToCompleteMessage').html('Логина не существует, <a href="../pages/register.php">зарегестрируйтесь</a>');
                changeMessageState(true, $('#needToCompleteMessage'));
            }
            else if(response === 'passwordIncorrect'){
                $('#needToCompleteMessage').html('неверный пароль');
                changeMessageState(true, $('#needToCompleteMessage'));
            }
        }
    });
}