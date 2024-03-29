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
    // echo"<pr/e>";
    // print_r($posts);
    include "./view/indexView.php";
}

function showSignInForm()
{
    include "./view/signinDisplay.php";
}


function getSignIn($usernameOrEmail, $password)
{
    $user = checkSignIn($usernameOrEmail, $password);
    if ($user) {
        $_SESSION['id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['profilePic'] = $user->profile_img;

        print_r("$user->id");

        header("Location: index.php?action=feed");
    } else {
        throw new Exception("User not found.");
    }
}


function getSignUpForm()
{
    include "./view/signinDisplay.php";
}

function createNewUser($username, $email, $password)
{
    addNewUser($username, $email, $password);
    header("Location: index.php?action=signin");
}

// ==============================================================================//
// ================================ TODO: PROFILE AND EXPLORE CONTROLLER THINGS ======================//

function showExplorePage()
{
    $posts = getPosts();
    include "./view/explorePage.php";
}

function showChallengePage()
{
    $challenge = getChallenges();
    include  "./view/challengePageDisplay.php";
}
function showCurrentDays()
{
    $getCurrentDays = getCurrentDayData();
    include "./view/challengeAccepted.php";
}


function showProfile()
{
    $profile = getProfile();
    $following = getFollowing();
    // print_r($following);
    $followers = getFollowers();
    $posts = getProfilePosts($profile->id);


    include "./view/profilePage.php";
}

function editProfileForm()
{
    $user = getProfile();
    include "./view/components/editProfileForm.php";
}

function editProfile($id, $pfp, $username, $bio)
{
    $profileImg = uploadpfp($pfp);
    updateProfile($id, $username, $profileImg, $bio);
    
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
    include "./view/newPostForm.php";
}

function logOut()
{
    session_destroy();
    header("location: index.php?action=showSignUpPage");
}

function createPost($caption, $media_src)
{
    // VALIDATE AND UPLOAD THE FILE

    $target_dir = "./public/uploads/";
    $uploadOk = 1;
    // $upload = $target_dir($target_file + "." + $imageFileType);
    $imageFileType = strtolower(pathinfo($_FILES["media"]["name"], PATHINFO_EXTENSION));
    $hashedFile = hash_file('sha256', $_FILES["media"]["tmp_name"]);
    $target_file = $target_dir . $hashedFile . "." . $imageFileType;
    echo "TARGET FILE: $target_file<br>";

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["media"]["size"] > 100000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "mp4"
    ) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, MP4 files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["media"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    addNewPost($caption, $target_file);
    header("Location: index.php?action=feed");
}

function uploadpfp($pfp)
{
    // If no new file uploaded, use the original file path ($pfp)

    if (empty($_FILES["media"]["name"])) {
        return $pfp;
    }
     // VALIDATE AND UPLOAD THE FILE

     $target_dir = "./public/uploads/";
     $uploadOk = 1;
     // $upload = $target_dir($target_file + "." + $imageFileType);
     $imageFileType = strtolower(pathinfo($_FILES["media"]["name"], PATHINFO_EXTENSION));
     $hashedFile = hash_file('sha256', $_FILES["media"]["tmp_name"]);
     $target_file = $target_dir . $hashedFile . "." . $imageFileType;
     echo "TARGET FILE: $target_file<br>";
 
     // Check if file already exists
     if (file_exists($target_file)) {
         echo "Sorry, file already exists.";
         $uploadOk = 0;
     }
 
     // Check file size
     if ($_FILES["media"]["size"] > 10000000) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
     }
 
     // Allow certain file formats
     if (
         $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
     ) {
         echo "Sorry, only JPG, JPEG, a PNG files are allowed.";
         $uploadOk = 0;
     }
 
     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
         // if everything is ok, try to upload file

     } 


     
     else {
         if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
             echo "The file " . htmlspecialchars(basename($_FILES["media"]["name"])) . " has been uploaded.";
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
     }
        return $target_file;
    //  addNewPost($media_src, $target_file);
    //  header("Location: index.php?action=feed");
}

function searchUser($username)
{
    $users = getUser($username);
    // Loop through $users.
    $usernames = [];

    foreach($users as $user) {
        $usernames[] = $user->username;
    }

    // Put all the usernames into a new array
    // implode the array and echo the resulting string

    $matches = implode("||", $usernames);
    echo $matches;
}

function searchChallenge($challenge)
{
    $challenges = searchingChallenges($challenge);
    
    $challengeArr = [];

    foreach($challenges as $challengeData) {
        $challengeArr[] = $challengeData->tag;
    }

    $searchResult = implode("||", $challengeArr);
    echo $searchResult;

}

function selectPost($challengePost)
{
    // echo "CHALLENGEpoST - controller: $challengePost <br>";
    $posts = selectingPost($challengePost);
    // echo "<pre>";
    // print_r($post);
    include "./view/explorePage.php";
}


function aProfileDirect($profileDirect)
{
    // Call a model function and save the result in a $profile variable    
    // Include profilePage.php
    $profile = getUserByUsername($profileDirect);
    $posts = getProfilePosts($profile->id);
    include "./view/profilePage.php";
}

function likePost($get_user_id, $get_post_id)
{
    $response = likePosts($get_user_id, $get_post_id);
    echo $response;
    
}

function getAllPostData($id) {
    $postData = getPostDataById($id);
    $comments = getCommentsByPostId($id);

    $data = [
        "data" => $postData,
        "comments" => $comments
    ];

    echo json_encode($data);
}


function insertComment($username, $text_content, $post_id) {
    $response = inserttComment($username, $text_content, $post_id);
    echo $response;
    print_r("$response");
}

function challengeAccepted(){
     // 
    $time = getStopTime();
    include "./view/challengeAccepted.php";
}

function challengeDenied(){
    include "./view/challengeDenied.php";
}