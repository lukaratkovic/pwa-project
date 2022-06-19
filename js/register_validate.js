let submitButton = document.getElementById('submit');

let usernameError = document.getElementById('username_error_message');
let nameError = document.getElementById('name_error_message');
let surnameError = document.getElementById('surname_error_message');
let passwordError = document.getElementById('password_error_message');
let confirmError = document.getElementById('confirm_password_error_message');

submitButton.onclick = (event) => {
    let username = document.getElementById('username');
    let name = document.getElementById('name');
    let surname = document.getElementById('surname');
    let password = document.getElementById('password');
    let confirmPassword = document.getElementById('confirmPassword');

    let valid = true;

    if(username.value.length < 4 || username.value.length > 15) {
        usernameError.style.display = 'block';
        username.style.borderColor = 'red';
        valid = false;
    } else {
        usernameError.style.display = 'none';
        username.style.borderColor = 'black';
    }

    if(!name.value) {
        nameError.style.display = 'block';
        name.style.borderColor = 'red';
        valid = false;
    } else {
        nameError.style.display = 'none';
        name.style.borderColor = 'black';
    }

    if(!surname.value) {
        surnameError.style.display = 'block';
        surname.style.borderColor = 'red';
        valid = false;
    } else {
        surnameError.style.display = 'none';
        surname.style.borderColor = 'black';
    }

    if(password.value.length < 5){
        passwordError.style.display = 'block';
        password.style.borderColor = 'red';
        valid=false;
    } else {
        passwordError.style.display = 'none';
        password.style.borderColor = 'black';
    }

    if(confirmPassword.value != password.value){
        confirmError.style.display = 'block';
        confirmPassword.style.borderColor = 'red';
        valid=false;
    }
    else{
        confirmError.style.display = 'none';
        confirmPassword.style.borderColor = 'black';
    }

    if(!valid) event.preventDefault();
}