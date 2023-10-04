/*
username - valid/invalid
email - valid/invalid
text - valid/invalid
password confirm - valid/invalid
bio - valid/invalid
tandc - valid/invalid
ageConfirm - valid/invalid

*/

//TODO: REVIEW ALL VALIDATIONS

const checkUsername = () => {
    if (username.value.length >= 6 && username.value.length <= 30) {
        username.classList.add('valid');
        username.classList.remove('invalid')
        return true;
    } else {
        username.classList.add('invalid');
        username.classList.remove('valid');
        return false;
    }

}


const checkEmail = () => {
    if (email.value.length != "") {
        email.classList.add('valid');
        email.classList.remove('invalid');
    } else {
        email.classList.add('invalid');
        email.classList.remove('valid');

    }
}

const checkBio = () => {
    if (bio.value.length >= 6 && bio.value.length <= 255) {
        bio.classList.add('valid');
        bio.classList.remove('invalid');
    } else {
        bio.classList.add('invalid');
        bio.classList.remove('valid');

    }
}



const checkPassword = () => {
    if (password.value.length >= 10 && password.value.length <= 30) {
        password.classList.add('valid');
        password.classList.remove('invalid');
    } else {
        password.classList.add('invalid');
        password.classList.remove('valid');

    }
}

const checkProfileImg = () => {
    if (profileImg.value.length >= 10 && profileImg.value.length <= 255) {
        profileImg.classList.add('valid');
        profileImg.classList.remove('invalid');
    } else {
        profileImg.classList.add('invalid');
        profileImg.classList.remove('valid');

    }
}

username.addEventListener('keyup', checkUsername);

email.addEventListener('keyup', checkEmail);

bio.addEventListener('keyup', checkBio);

profileImg.addEventListener('keyup', checkProfileImg);

password.addEventListener('keyup', checkPassword);




