

const usernameReg = /^[a-z0-9_\-]{6,20}$/i;
const passwordReg = /^[a-z0-9!@#$%\^&*]{10,30}$/i;

const checkUsername = () => {
    if (usernameReg.test(username.value)) {
        username.classList.add('valid');
        username.classList.remove('invalid');
        return true;
    } else {
        username.classList.add('invalid');
        username.classList.remove('valid');
        return false;
    }

}

const checkEmail = () => {
    if (email.value.length != "") {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            email.classList.add('valid');
            email.classList.remove('invalid');
        }
    } else {
        email.classList.add('invalid');
        email.classList.remove('valid');
    }
}



const checkPassword = () => {
    if (password.value.length >= 10 && password.value.length <= 30) {
        if (passwordReg.test(password.value)) {

            password.classList.add('valid');
            password.classList.remove('invalid');
        }
    } else {
        password.classList.add('invalid');
        password.classList.remove('valid');

    }
}


username.addEventListener('keyup', checkUsername);

email.addEventListener('keyup', checkEmail);

password.addEventListener('keyup', checkPassword);




