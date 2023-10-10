<?php

require_once "./model/model.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


function showErrorPage($e)
{
    include "./view/errorPage.php";
}

//TODO: change this to feed
function showHomePage()
{
    include "./view/components/signinDisplay.php";
}

function showSignInForm()
{
    include "./view/components/signinDisplay.php";
}

function getSignIn($username, $password)
{
    $user = checkSignIn($username, $password); //TODO: if or throw exception if user doesnt exist
    $_SESSION['id'] = $user->id;
    $_SESSION['username'] = $user->username;


    // header("Location: index.php?action=feed&id=" . $user->id . '&username=' . $user->username);
    header("Location: index.php?action=feed");
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
// ================================ TODO: FEED CONTROLLER THINGS ======================//

function showFeed()
{
    $posts = getPosts();
    include "./view/components/feedDisplay.php";
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
