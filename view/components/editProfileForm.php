<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="./public/css/editProfile.css">
    <!-- boxICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="./public/images/favicon.ico" type="image/x-icon">


</head>

<body>
     <!-- NAVBAR -->
     <a href="./index.php?action=challenge">
        <button class="btn challenge-btn">Challenge of the Day</button>
    </a>

    <div class="navbar">
        <div class="logo">
            <a href="./index.php?action=indexView.php"><img src="./public/images/logo2.png" alt="" /></a>
        </div>
        <a href="./index.php?action=search" class="icons searchButton tooltip">
            <i class="bx bx-search"></i>
            <span class="tooltiptext">Search</span>
        </a>
        <a href="./index.php?action=explore" class="icons tooltip">
            <i class="bx bx-compass"></i>
            <span class="tooltiptext">Explore</span>
        </a>
        <a href="./index.php?action=newPostForm" class="icons tooltip">
            <i class="bx bxs-camera-plus"></i>
            <span class="tooltiptext">Add Post</span>
        </a>
        <a href="./index.php?action=challenge" class="icons tooltip">
            <i class='bx bx-party'></i>
            <span class="tooltiptext">Challenge</span>
        </a>
        <a href="index.php?action=logOut" class="icons tooltip">
            <i class="bx bx-log-out-circle"></i>
            <span class="tooltiptext">Log Out</span>
        </a>
    </div>

    <div class="main">
        <div class="formContainer">
            <h1>Edit Profile</h1>
            <form action="index.php?action=editProfile" method="post" enctype="multipart/form-data">
                <input class="editInput" type="hidden" name="id" id="id" value="<?= $user->id ?>">

                <input type="hidden" name="pfp" id="pfp" value="<?= $user->profile_img ?>">

                <input class="editInput" type="text" name="username" id="username" placeholder="username" value="<?= $user->username ?>">

                <input class="editInput" type="text" name="bio" id="bio" placeholder="bio" value="<?= $user->bio ?>">

                <input class="editInput" type="file" name="media" id="media" accept=".jpg,.jpeg,.png," placeholder="profileImg">

                <!-- <button type="submit" value="Upload Image/Video" name="submit" class="add-btn">Add</button> -->

                <!-- <input type="text" name="password" id="password" placeholder="password" password value=""> -->

                <button class="update-btn" type="submit">Update</button>
            </form>
        </div>
    </div>

</body>

</html>

