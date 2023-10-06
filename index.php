<?php
session_start();

require_once "./controller/controller.php";

try {

    $action = $_GET['action'] ?? "";
    switch ($action) {
        case "signin":
            showSignInForm();
            break;

        case "checkSignIn":
            $usernameOrEmail = $_REQUEST['usernameOrEmail'];
            $password = $_REQUEST['password'];

            if ($usernameOrEmail and $password) {
                getSignIn($usernameOrEmail, $password);
            } else {
                throw new Exception("Missing required parameters.");
            }
            break;

        case "feed":
            showFeed();
            break;

        case "newPostForm":
            if (isset($_SESSION['id'])) {
                newPostForm();
            } else {
                showSignInForm();
            }
            break;

        case "createPost":
            $caption = $_REQUEST['caption'] ?? null;
            $media_src = $_REQUEST['media'] ?? null;
            createPost($caption, $media_src);
            break;

        case "newUser":
            getSignUpForm();
            break;

        case "signup":
            $username = $_REQUEST['username'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $passwordConfirm = $_REQUEST['passwordConfirm'];

            $profileImg = $_REQUEST['profileImg'];
            $bio = $_REQUEST['bio'];

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

        case "explore":
            if (isset($_SESSION['id'])) {
                showExplorePage();
            } else {
                showSignInForm();
            }
            break;

        case "viewProfile":
            if (isset($_SESSION['id'])) {
                showProfile();
            } else {
                showSignInForm();
            }
            break;

        case "editProfileForm":
            editProfileForm();
            break;

        case "editProfile":
            $username = $_REQUEST['username'];
            $profileImg = $_REQUEST['profileImg'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $bio = $_REQUEST['bio'];
            editProfile($id, $username, $profileImg, $bio, $email, $password);
            break;

        default:
            showHomePage();
            break;
    }
} catch (Exception $e) {
    showErrorPage($e);
}
