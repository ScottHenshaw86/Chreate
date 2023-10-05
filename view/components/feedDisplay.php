<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEED Page</title>
</head>

<body>

    <h1>
        This the feed page
    </h1>
    <h2>
        TESTING id: <?= htmlspecialchars($_SESSION['id']) ?>
    </h2>
    <h2>TESTING username: <?= htmlspecialchars($_SESSION['username']) ?></h2>
    <div class="addPostButton">
        <a href="./index.php?action=newPostForm"><button type="button">+ Add Post</button></a>
    </div>

    <div class="feedContainer">
        <?php
        foreach ($posts as $post) {
            include "./view/components/postFeedDisplay.php";
        }
        ?>

    </div>



</body>

</html>