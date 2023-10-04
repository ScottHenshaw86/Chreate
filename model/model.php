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

function checkSignin($username, $password)
{

    $db = dbConnect();
    $req = $db->prepare("SELECT id, username, password FROM users WHERE username = :username");
    $req->execute([
        'username' => $username
    ]);

    $user = $req->fetch(PDO::FETCH_OBJ);

    if ($user and password_verify($password, $user->password)) {
        return $user;
    }
}


function addNewUser($username, $email, $password, $profileImg, $bio)
{

    $password = password_hash($password, PASSWORD_DEFAULT);
    $db = dbConnect();
    $req = $db->prepare("INSERT INTO users (username, email, password, profile_img, bio, is_active) VALUES (:username, :email, :password, :profileImg, :bio, 1)");
    $req->execute([
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'profileImg' => $profileImg,
        'bio' => $bio
    ]);
}


function getPosts()
{
    $db = dbConnect();

    $response = $db->query("SELECT 
                                p.captions, p.media_src, p.date_created, c.tag, u.username
                            FROM posts p
                            INNER JOIN challenges c
                            ON p.challenge_id = c.id
                            INNER JOIN users u
                            ON p.user_id = u.id
                            ");

    $posts = $response->fetchAll(PDO::FETCH_OBJ);

    return $posts;
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
