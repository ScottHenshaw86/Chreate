<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <div class="main">
        <h1>Edit profile page</h1>
        <div class="formContainer">
            <form action="index.php?action=editProfile" method="post">
                <input type="hidden" name="id" id="id" value="<?= $user->id ?>">
                <input type="text" name="username" id="username" value="<?= $user->username ?>">
                <input type="text" name="bio" id="bio" value="<?= $user->bio ?>">
                <input type="text" name="profileImg" id="profileImg" value="<?= $user->profile_img ?>">
                <input type="text" name="email" id="email" value="<? $user->email ?>">
                <input type="text" name="password" id="password" value="">
                <button type="submit">Update</button>

            </form>
        </div>
    </div>

</body>

</html>