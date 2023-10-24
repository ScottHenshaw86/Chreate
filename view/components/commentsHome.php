<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/comments.css">
    <script defer src="./scrollBot.js"></script>
    <title>comments</title>
</head>

<body>
    <div class="wholeBox">
        <?php

        $db = new PDO("mysql:host=localhost;dbname=chreate;charset=utf8", 'root', 'root');

        $response = $db->query("SELECT id, user_id, post_id, text_content, date_created FROM comments");

        while ($text_content = $response->fetch(PDO::FETCH_OBJ)) {

        ?>
            <div class="displayMsgBox <?= $text_content->id % 2 == 0 ? 'right' : 'left' ?>">
                <h3 class="date"><?= $text_content->date_created ?></h3>
                <h3 class="user_id"><?= $msg->user_id ?></h3>
                <h3 class="text_content"><?= $text_content->text_content ?></h3>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="messagebox">
        <form action="insertext.php" method=POST>
            <input class="msgInput" type="text" id="text_content" name="text_content" placeholder="message">
            <input class="userInput" type="text" id="user_id" name="user_id" placeholder="user_id">
            <button class="button">SEND</button>
        </form>
    </div>

</body>

</html>