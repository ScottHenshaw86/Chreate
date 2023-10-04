<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\signinsignup.css">
    <script defer src="./public/js/signUpValidation.js"></script>
    <title>Sign Up Page</title>
</head>

<body>
    <div class="main">
        <h1>Sign up</h1>
        <div class="formContainer">
            <!-- CREATE ACCOUNT FORM -->
            <form action="index.php?action=signup" method="post">

                <input type="text" name="username" id="username" placeholder="username" title="Only letters, numbers, hyphens and underscores allowed">


                <input type="email" name="email" id="email" placeholder="email">
                <input type="text" name="password" id="password" placeholder="password" title="Only letters, numbers and the following characters: !@#$%^&* are allowed">

                <!-- TODO: Change input types to password  -->
                <input type="text" name="passwordConfirm" id="passwordConfirm" placeholder="Type password again">
                <input type="text" name="profileImg" id="profileImg" placeholder="profile image">
                <input type="text" name="bio" id="bio" placeholder="bio">
                <input type="checkbox" name="tandc" id="tandc" value="true"> <label for="tandc"> Check to agree to our terms and conditions?</label>
                <input type="checkbox" name="ageConfirm" id="ageConfirm" value="true"> <label for="ageConfirm"> Check that you are above 18 years old </label>
                <button type="submit">Sign Up</button>
            </form>
        </div>

    </div>
</body>

</html>