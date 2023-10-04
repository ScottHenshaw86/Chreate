<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
</head>

<body>
    <div class="main">
        <div class="formContainer">
            <form action="./index.php?action=createPost" method="post">
                <label for="caption">Caption: </label>
                <input type="text" name="caption" id="caption">

                <label for="media">Media</label>
                <input type="file" name="media" id="media">

                <button type="submit">Add</button>
            </form>
        </div>
    </div>

</body>

</html>