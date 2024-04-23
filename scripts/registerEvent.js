$(document).ready(function () {
    
    let button = $("#sendButton");

    $(button).click(function (event) { 
        event.preventDefault();
        if(checkValidInputs()){ 
            sendForm(); 
        }      
    });

});

function sendForm(){

    let formData = $("#registerForm").serialize();

    $.ajax({
        type: "POST",
        url: "../backdoor/registerUser.php",
        data: formData,
        success: function (response) {
            if(response === "user registered"){
                window.location.href = '../index.php';
            }
        }
    });
}