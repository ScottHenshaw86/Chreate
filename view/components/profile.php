<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <h1>PROFILE</h1>

    <a href="index.php?action=editProfileForm"><button>Edit profile</button></a>


    <h2>bio: <?= $profile->bio ?></h2>
    <h2>profile img src: <?= $profile->profile_img ?></h2>
    <h2>username: <?= $profile->username ?></h2>
    <h2>follower count: <?= $profile->followers ?></h2>
    <h2>following count: <?= $profile->following ?></h2>
    <h2> feed: </h2>

    <?php
    foreach ($posts as $post) {
        include "./view/components/postFeedDisplay.php";
    };
    ?>


</body>

</html>