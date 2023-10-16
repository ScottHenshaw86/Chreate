<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function dbConnect()
{

    $HOST = "localhost";
    $DB = "chreate";
    $USER = "root";
    $PWD = "root";

    return new PDO("mysql:host=$HOST;dbname=$DB;charsetutf8", $USER, $PWD);
}

function checkSignin($usernameOrEmail, $password)
{

    $db = dbConnect();
    $req = $db->prepare("SELECT id, username, email, password, profile_img FROM users WHERE username = :username OR email = :email");
    $req->execute([
        'username' => $usernameOrEmail,
        'email' => $usernameOrEmail
    ]);

    $user = $req->fetch(PDO::FETCH_OBJ);

    if ($user and password_verify($password, $user->password)) {
        return $user;
    } else {
        return null;
    }
}


function addNewUser($username, $email, $password)
{

    $password = password_hash($password, PASSWORD_DEFAULT);
    $db = dbConnect();
    $req = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $req->execute([
        'username' => $username,
        'email' => $email,
        'password' => $password,
    ]);
}


function getPosts()
{
    $db = dbConnect();

    $response = $db->query("SELECT 
                                p.id, p.captions, p.media_src, p.date_created, c.tag, u.username
                            FROM posts p
                            INNER JOIN challenges c
                            ON p.challenge_id = c.id
                            INNER JOIN users u
                            ON p.user_id = u.id
                            ");

    $posts = $response->fetchAll(PDO::FETCH_OBJ);

    return $posts;
}

function getChallenges()
{
    $db = dbConnect();

    $response = $db->query("SELECT id, title, description, tag, start_date, stop_date FROM challenges");

    $challenge = $response->fetch(PDO::FETCH_OBJ);

    return $challenge;
}

function addNewPost($caption, $media_src)
{
    $db = dbConnect();


    $req = $db->prepare("INSERT INTO posts (user_id, captions, media_src, challenge_id, is_video, is_active) VALUES ( :user_id, :caption, :media_src, 1, 1, 1)");
    $req->execute([
        'user_id' => $_SESSION['id'],
        'caption' => $caption,
        'media_src' => $media_src


    ]);
};

function getProfile()
{
    $id = $_SESSION["id"];
    $db = dbConnect();
    $req = $db->prepare("SELECT 
                            u.id, u.username, u.bio, u.password, u.profile_img, u.email  
                            FROM users u 
                            WHERE u.id = :id");

    $req->execute([
        'id' => $id
    ]);

    $profile = $req->fetch(PDO::FETCH_OBJ);

    return $profile;
};



function getFollowing()
{
    $id = 2;
    $db = dbConnect();

    $req = $db->prepare("SELECT 
                            u.id, COUNT(f.follower_id) AS following
                            FROM users u 
                            INNER JOIN follows f 
                            ON u.id = f.follower_id 
                            WHERE u.id = :id
                            GROUP BY u.id");

    $req->execute([
        'id' => $id
    ]);

    $following = $req->fetch(PDO::FETCH_OBJ);
    return $following;
}

function getFollowers()
{
    $id = 2;
    $db = dbConnect();

    $req = $db->prepare("SELECT 
                            u.id, COUNT(f.followee_id) AS followers
                            FROM users u 
                            INNER JOIN follows f 
                            ON u.id = f.followee_id 
                            WHERE u.id = :id
                            GROUP BY u.id");

    $req->execute([
        'id' => $id
    ]);

    $followers = $req->fetch(PDO::FETCH_OBJ);
    return $followers;
}

function getProfilePosts($user)
{
    $db = dbConnect();

    $response = $db->prepare("SELECT 
                                p.captions, p.media_src, p.date_created, c.tag, u.username
                                FROM posts p
                                INNER JOIN challenges c
                                ON p.challenge_id = c.id
                                INNER JOIN users u
                                ON p.user_id = u.id
                                where p.user_id = :id");
    $response->execute([
        'id' => $user
    ]);

    $posts = $response->fetchAll(PDO::FETCH_OBJ);
    // $posts = $response->fetch(PDO::FETCH_OBJ);

    return $posts;
}

function updateProfile($id, $username, $profileImg, $bio, $email, $password)
{

    $db = dbConnect();
    $req = $db->prepare("UPDATE users SET username = :username, profile_img = :profileImg, bio = :bio, email = :email, password = :password WHERE id = :id ");
    $req->execute([
        'id' => $id,
        'username' => $username,
        'profileImg' => $profileImg,
        'bio' => $bio,
        'email' => $email,
        'password' => $password
    ]);
}

function getUser($username) // first part for search up a user on homepage
{
    $db = dbConnect();

    $req = $db->prepare("SELECT username FROM users WHERE username LIKE ?");
    $req->execute(['%' . $username . '%']);

    $foundUsers = $req->fetchall(PDO::FETCH_OBJ);

    return $foundUsers;
}

function getUserByUsername($username)
{
    $db = dbconnect();

    $req = $db->prepare("SELECT * FROM users WHERE username = ?");
    $req->execute([$username]);

    $foundProfile = $req->fetch(PDO::FETCH_OBJ);
    return $foundProfile;
}

function searchingChallenges($challenge)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT tag FROM challenges WHERE tag LIKE ?");
    $req->execute(['%' . $challenge . '%']);

    $foundChallenge = $req->fetchAll(PDO::FETCH_OBJ);

    return $foundChallenge;
}

function selectingPost($post)
{
    $db = dbconnect();

    $req = $db->prepare("SELECT * FROM posts where challenge_id = ?");
    $req->execute([$post]);

    $selectedPost = $req->fetch(PDO::FETCH_OBJ);
    return $selectedPost;
}


// Create a new function here
// It should take in the username as a parameter
// It will connect to the db
// It will query the users table for a user with that username
// It will fetch the user's data and return it

function likePosts($get_user_id, $get_post_id)
{
    $db = dbconnect();

    $req = $db->prepare("SELECT * FROM post_likes WHERE user_id = ? AND post_id = ?");
    $req->execute([$get_user_id, $get_post_id]);

    $likesInfo = $req->fetch(PDO::FETCH_OBJ);

    if ($likesInfo) {
        // if true the user already liked to post so if they click again we gotta unlike it
        $req = $db->prepare("DELETE FROM post_likes WHERE user_id = ? AND post_id = ?");
        $req->execute([$get_user_id, $get_post_id]);
        return "unlike";
    } else {
        $req = $db->prepare("INSERT INTO post_likes (user_id, post_id) VALUES (:user_id, :post_id)");
        $req->execute([
            'user_id' => $get_user_id,
            'post_id' => $get_post_id
        ]);
        return "like";
    }
}