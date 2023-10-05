<?php
// if (session_status() !== PHP_SESSION_ACTIVE) {
//     session_start();
// }
require_once "./model/model.php";


function showErrorPage($e)
{
    include "./view/errorPage.php";
}


function showHomePage()
{
    $posts = getPosts();
    include "./view/indexView.php";
}


function showSignInForm()
{
    include "./view/components/signinDisplay.php";
}


function getSignIn($usernameOrEmail, $password)
{
    $user = checkSignIn($usernameOrEmail, $password);
    if ($user) {
        $_SESSION['id'] = $user->id;
        $_SESSION['username'] = $user->username;

        header("Location: index.php?action=feed");
    } else {
        throw new Exception("User not found.");
    }
}


function getSignUpForm()
{
    include "./view/components/signupDisplay.php";
}


function createNewUser($username, $email, $password, $profileImg, $bio)
{
    addNewUser($username, $email, $password, $profileImg, $bio);
    header("Location: index.php?action=signin");
}

// ==============================================================================//
// ================================ TODO: PROFILE AND EXPLORE CONTROLLER THINGS ======================//

function showExplorePage()
{
    $posts = getPosts();
    include "./view/components/explorePage.php";
}

function showChallengePage()
{
    $challenge = getChallenges();
    include  "./view/components/challengePageDisplay.php";
}

function showProfile()
{
    $profile = getProfile();
    $following = getFollowing();
    print_r($following);
    $followers = getFollowers();
    $user = $profile->id;
    $posts = getProfilePosts($user);


    include "./view/components/profile.php";
}

function editProfileForm()
{
    $user = getProfile();
    include "./view/components/editProfileForm.php";
}

function editProfile($id, $username, $profileImg, $bio, $email, $password)
{
    updateProfile($id, $username, $profileImg, $bio, $email, $password);
    header("Location: index.php?action=viewProfile");
}

// ==============================================================================//
// ================================ TODO: FEED CONTROLLER THINGS ======================//

function showFeed()
{
    $posts = getPosts();
    include "./view/indexView.php";
}

function newPostForm()
{
    include "./view/components/newPostForm.php";
}

function createPost($caption, $media_src)
{
    addNewPost($caption, $media_src);
    header("Location: index.php?action=feed");
}
