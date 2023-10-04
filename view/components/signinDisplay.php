<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\signinsignup.css">
    <script defer src="./public/js/signUpValidation.js"></script>
    <title>Sign In Page</title>
</head>

<body>
    <div class="main">
        <div class="formContainer">
            <form action="index.php?action=checkSignIn" method="post">
                <input type="text" name="username" id="username" placeholder="username">
                <!-- TODO: change input type to password -->
                <input type="text" name="password" id="password" placeholder="password">
                <button type="submit">Sign in</button>

            </form>
        </div>
    </div>

</body>

</html>