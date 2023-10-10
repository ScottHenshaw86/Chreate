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
    // VALIDATE AND UPLOAD THE FILE

    $target_dir = "./public/uploads/";
    $uploadOk = 1;
    // $upload = $target_dir($target_file + "." + $imageFileType);
    $imageFileType = strtolower(pathinfo($_FILES["media"]["name"],PATHINFO_EXTENSION));
    $hashedFile = hash_file('sha256', $_FILES["media"]["tmp_name"]);
    $target_file = $target_dir . $hashedFile . "." . $imageFileType;
    echo "TARGET FILE: $target_file<br>";

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["media"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "mov") {
  echo "Sorry, only JPG, JPEG, PNG, GIF, MP4, & MOV files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["media"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

    addNewPost($caption, $target_file);
    header("Location: index.php?action=feed");
}

