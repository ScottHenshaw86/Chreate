<?php
// session_start();


require_once "./controller/controller.php";

try {

    $action = $_GET['action'] ?? "";
    switch ($action) {
        case "signin":
            showSignInForm();
            break;

        case "checkSignIn":
            $username = htmlspecialchars($_REQUEST['username']);
            $password = htmlspecialchars($_REQUEST['password']);

            if ($username and $password) {
                getSignIn($username, $password);
            } else {
                throw new Exception("Missing required parameters.");
            }
            break;

        case "feed":
            showFeed();
            break;

        case "newPostForm":
            newPostForm();
            break;

        case "createPost":
            $caption = htmlspecialchars($_REQUEST['caption']);
            $media_src = htmlspecialchars($_REQUEST['media']);
            createPost($caption, $media_src);
            break;

        case "newUser":
            getSignUpForm();
            break;

        case "signup":
            // VALIDATION

            $username = htmlspecialchars($_REQUEST['username']);
            $email = htmlspecialchars($_REQUEST['email']);
            $password = htmlspecialchars($_REQUEST['password']);
            $passwordConfirm = htmlspecialchars($_REQUEST['passwordConfirm']);

            $profileImg = htmlspecialchars($_REQUEST['profileImg']);
            $bio = htmlspecialchars($_REQUEST['bio']);

            $tandc = false;
            if (isset($_REQUEST['tandc']) and $_REQUEST['tandc'] == true) {
                $tandc = true;
            } else {
                throw new Exception("Please check our terms and conditions");
            }

            $ageConfirm = false;
            if (isset($_REQUEST['ageConfirm']) and $_REQUEST['ageConfirm'] == true) {
                $ageConfirm = true;
            } else {
                throw new Exception("Please check that you are above 18");
            }


            $usernameValid = false;
            if (preg_match("/^[a-z0-9_\-]{6,20}$/i", $username)) {
                $usernameValid = true;
            } else {
                throw new Exception("Invalid username format.");
            }

            $emailValid = false;
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailValid = true;
            } else {
                throw new Exception("Invalid email format.");
            }

            $passwordValid = false;
            if (preg_match("/^[a-z0-9!@#$%\^&*]{10,30}$/i", $password)) {
                $passwordValid = true;
            } else {
                throw new Exception("Invalid password format.");
            }

            $passwordConfirmValid = false;
            if ($passwordConfirm === $password) {
                $passwordConfirmValid = true;
            } else {
                throw new Exception("Password did not match.");
            }

            $bioValid = false;
            if (preg_match("/^[a-z0-9!@#$%\^&* ]{10,250}$/i", $bio)) {
                $bioValid = true;
            } else {
                throw new Exception("Invalid bio.");
            }

            $profileImgValid = false;
            if (preg_match("/^[a-z0-9!@#.$%\^&*]{10,250}$/i", $profileImg)) {
                $profileImgValid = true;
            } else {
                throw new Exception("Invalid profile image.");
            }
            if ($usernameValid and $emailValid and $passwordValid and $passwordConfirmValid and $profileImgValid and $bioValid and $tandc and $ageConfirm) {
                createNewUser($username, $email, $password, $profileImg, $bio);
            } else {
                throw new Exception("Missing required parameters.");
            }
            break;

        default:
            showHomePage();
            break;
    }
} catch (Exception $e) {
    showErrorPage($e);
}
