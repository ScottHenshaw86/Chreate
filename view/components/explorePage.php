<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Page</title>
</head>

<body>
    <h1>EXPLORE PAGE</h1>

    <div class="searchButton">
        <form action="index.php?action=searchingChallenges" method="POST">
            <input id="search" type="text" placeholder="Search Challenge" name="challenges">
            <input id="submit" type="submit" value="Search">
        </form>
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