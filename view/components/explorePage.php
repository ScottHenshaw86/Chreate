<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Page</title>
</head>

<body>
    <div class="feedContainer">
        <?php
        foreach ($posts as $post) {
            include "./view/components/postFeedDisplay.php";
        }
        ?>

    </div>


</body>

</html>