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

        case "changePfp":
            $media_src = $_REQUEST['media'] ?? null;
            uploadpfp($media_src);
            break;

        case "showSignUpPage":
            getSignUpForm();
            break;

        case "signup":
            $username = $_REQUEST['username'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $passwordConfirm = $_REQUEST['passwordConfirm'];

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

            // $bioValid = false;
            // if (preg_match("/^[a-z0-9!@#$%\^&* ]{10,250}$/i", $bio)) {
            //     $bioValid = true;
            // } else {
            //     throw new Exception("Invalid bio.");
            // }

            // $profileImgValid = false;
            // if (preg_match("/^[a-z0-9!@#.$%\^&*]{10,250}$/i", $profileImg)) {
            //     $profileImgValid = true;
            // } else {
            //     throw new Exception("Invalid profile image.");
            // }
            if ($usernameValid and $emailValid and $passwordValid and $passwordConfirmValid  and $tandc and $ageConfirm) {
                createNewUser($username, $email, $password);
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

        case "challenge":
            showChallengePage();
            break;

        case "getCurrentDays":
            showCurrentDays();
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
            $id = $_POST['id'];
            $pfp = $_POST['pfp'];
            $username = $_POST['username'];
            $bio = $_POST['bio'];

            // echo "<pre>";
            // print_r($_POST);
            // print_r($_FILES);
            editProfile($id, $pfp, $username, $bio);

            break;    

        case "logOut":
            logOut();
            break;

        case "searchUser":
            $username = $_GET["userName"];
            searchUser($username);
            break;

        case "userSelect":
            $profileDirect = $_GET["user"];
            aProfileDirect($profileDirect);
            break;

        case "searchingChallenges":
            $challenge = $_GET["challenges"];
            searchChallenge($challenge);
            break;

        case "challengePostSelect":
            $challengePost = $_GET["post"];
            // echo "CHALLENGEpoST - router: $challengePost <br>";
            selectPost($challengePost);
            break;

        case "likePost":
            $get_user_id = $_GET["user_id"];
            $get_post_id = $_GET["post_id"];
            likePost($get_user_id, $get_post_id);
            break;

        case "getAllPostDataById":
            $id = $_GET['id'];
            getAllPostData($id);
            break;

        case "insertComment":
            $username = $_SESSION['id'];
            $text_content = $_POST['text_content'] ?? false;
            $post_id = $_POST['post_id'] ?? false;
            insertComment($username, $text_content, $post_id);

            // print_r("$username");
            // print_r("$text_content");
            // print_r("$post_id");
            break;

        case "challengeAccepted":
            challengeAccepted();
            break;
        case "challengeDenied":
            challengeDenied();
            break;

        default:
            showHomePage();
            break;
    }
} catch (Exception $e) {
    showErrorPage($e);
}

