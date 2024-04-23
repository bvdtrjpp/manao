const MIN_NAME_LENGHT = 2;
const MIN_LOGIN_LENGHT = 6;
const MIN_PASSWORD_LENGHT = 6;

$(document).ready(function () {
    


    $(".form_input").on('input', function (event) {
        


        let inputDataLabel = event.target.dataset.label;

        let errorMessage = $(this).siblings('p[data-label="symbol_error"]');
        let errorExist = $(this).siblings('p[data-label="exist_error"]');

  

        let inputValue = $(this).val();

        switch(inputDataLabel){

            case 'name_input':{    

                if(isCorrectInputLength(inputValue, MIN_NAME_LENGHT)){
                    changeMessageState(false, errorMessage);
                    validateInput(true, $(this));
                }
                else{
                    changeMessageState(true, errorMessage);
                    validateInput(false, $(this));
                }
                break;

            }
            case 'login_input':{
                
                if(isCorrectInputLength(inputValue, MIN_LOGIN_LENGHT)){
                    changeMessageState(false, errorMessage);
                    checkUniqueData(inputDataLabel ,inputValue, $(this), errorExist);
                }
                else{
                    changeMessageState(true, errorMessage);
                    changeMessageState(false, errorExist);
                    validateInput(false, $(this));
                }
                break;

            }
            case 'password_input':{
                let confirmPasswordInput = $('input[data-label="confirmPassword_input"]');
                if(isCorrectInputLength(inputValue, MIN_LOGIN_LENGHT)){
                    if(isCorrectRegexOfInputValue(inputValue, inputDataLabel)){
                        changeMessageState(false, errorMessage);
                        validateInput(true, $(this));
                        inputDisableState(false, confirmPasswordInput);
                    }
                    else{
                        changeMessageState(true, errorMessage);
                        validateInput(false, $(this));
                        inputDisableState(true, confirmPasswordInput, true);
                    }
                }
                else{
                    changeMessageState(true, errorMessage);
                    validateInput(false, $(this));
                    inputDisableState(true, confirmPasswordInput, true);
                }
                errorMessage = confirmPasswordInput.siblings('p[data-label="symbol_error"]');
                if(checkCorrectPasswords(confirmPasswordInput, inputValue)){
                    changeMessageState(false, errorMessage);
                    validateInput(true, confirmPasswordInput);
                }
                else{
                    changeMessageState(true, errorMessage);
                    validateInput(false, confirmPasswordInput);
                }

                break;

            }
            case 'confirmPassword_input':{
                let passwordInput = $('input[data-label="password_input"]').val();
                if(checkCorrectPasswords(inputValue, passwordInput)){
                    changeMessageState(false, errorMessage);
                    validateInput(true, $(this));
                }
                else{
                    changeMessageState(true, errorMessage);
                    validateInput(false, $(this));
                }
                break;
            }
            case 'email_input':{
                if(isCorrectRegexOfInputValue(inputValue, inputDataLabel)){
                    changeMessageState(false, errorMessage);
                    checkUniqueData(inputDataLabel ,inputValue, $(this), errorExist);
                }
                else{
                    changeMessageState(true, errorMessage);
                    changeMessageState(false, errorExist);
                    validateInput(false, $(this));
                }
            }

            case 'enter_login_input':{
                if(isCorrectInputLength(inputValue, 6)){
                    changeMessageState(false, errorMessage);
                    validateInput(true, $(this));
                    checkValidInputs(true);
                }
                else{
                    changeMessageState(true, errorMessage);
                    validateInput(false, $(this));
                    checkValidInputs(true);
                }
            }
            case 'enter_password_input':{
                if(isCorrectInputLength(inputValue, 6)){
                    changeMessageState(false, errorMessage);
                    validateInput(true, $(this));
                    checkValidInputs(true);
                }
                else{
                    changeMessageState(true, errorMessage);
                    validateInput(false, $(this));
                    checkValidInputs(true);
                }
            }

        }
        checkValidInputs();
    });


});

function isCorrectInputLength(inputValue, neededLength){
    return inputValue.length>=neededLength;
}

function validateInput(isValid, targetInput){

    targetInput.removeClass('valid invalid').addClass(isValid ? 'valid' : 'invalid');

}

function changeMessageState(isShowing, targetMessage){


    isShowing ? targetMessage.css('display', 'block') : targetMessage.css('display', 'none');

}

function isCorrectRegexOfInputValue(inputValue, inputDataLabel){

    let regex = '';
    switch(inputDataLabel){
        case 'email_input':{

            regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(inputValue);

        }
        case 'password_input':{

            regex = /^(?=.*[a-zA-Z])(?=.*\d)/;
            return regex.test(inputValue);

        }
    }
}

function inputDisableState(isDisabled, targetInput, isNeedToClear = false){

    isDisabled ? targetInput.prop('disabled', true) : targetInput.prop('disabled', false);
    isNeedToClear ? targetInput.val("") : true;

}

function checkCorrectPasswords(confirmPasswordInputValue, passwordInputValue){

    if(confirmPasswordInputValue === passwordInputValue){
        return true;
    }
    else{
        return false;
    }

}

function checkUniqueData(inputDataLabel, inputValue, targetInput, targetMessage, isLogin = false){
    let data = {};
    inputDataLabel === 'login_input' ? inputDataLabel = 'login' : inputDataLabel = 'email';
    data[inputDataLabel] = inputValue;
    $.ajax({
        url: '../backdoor/checkUniqueData.php',
        method: 'POST',
        data: data,
        success: function(response){
            if(response === inputDataLabel + " " + inputValue){
                if(isLogin == false){
                    validateInput(false, targetInput);
                    changeMessageState(true, targetMessage);
                    checkValidInputs();
                }
                else{
                    validateInput(true, targetInput);
                    changeMessageState(false, targetMessage);
                    checkValidInputs();
                }
            }
            else if(response === "false"){
                if(isLogin == false){
                    validateInput(true, targetInput);
                    changeMessageState(false, targetMessage);
                    checkValidInputs();
                }
                else{
                    validateInput(true, targetInput);
                    changeMessageState(false, targetMessage);
                    checkValidInputs();
                }
            }
            
        },
        error: function(){
            alert("error");
        }

    });
    
}



function checkValidInputs(isEnterButton = false){

    let inputs = $('.form_input');
    let needToCompleteMessage = $("#needToCompleteMessage");
    let button;
    isEnterButton ? button = $('#enterButton') : button = $('#sendButton');
    let allValid = true;

    for(let i = 0; i< inputs.length; i++){

        if($(inputs[i]).hasClass('valid') === false){
            allValid = false;
            break;
        }

    }

    if(allValid){
        console.log("all valid");
        inputDisableState(false, button);
        changeMessageState(false, needToCompleteMessage);
        return true;
    }
    else{
        console.log("smth invalid");
        inputDisableState(true, button);
        changeMessageState(true, needToCompleteMessage);
        return false;
    }

}