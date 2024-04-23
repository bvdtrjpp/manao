$(document).ready(function () {
    
    $('#leaveButton').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "backdoor/logout.php",
            success: function (response) {
                if(response === 'ok'){
                    window.location.href = 'pages/login.php'
                }
                else{
                    window.location.href = 'pages/login.php'
                }
            }
        });
    });

    $('#deleteAccount').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "backdoor/delete.php",
            success: function (response) {
                if(response === 'ok'){
                    window.location.href = 'pages/login.php'
                }
                else{
                    window.location.href = 'pages/login.php'
                }
            }
        });
    });

});