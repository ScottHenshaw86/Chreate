const bioReg = /^[a-z0-9!@#$%\^&* ]{10,250}$/i;

const checkBio = () => {
    if (bio.value.length >= 6 && bio.value.length <= 255) {
        if (bioReg.test(bio.value)) {
            bio.classList.add('valid');
            bio.classList.remove('invalid');
        }
    } else {
        bio.classList.add('invalid');
        bio.classList.remove('valid');

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

bio.addEventListener('keyup', checkBio);
profileImg.addEventListener('keyup', checkProfileImg);
