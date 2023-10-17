<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS link -->
     <link rel="stylesheet" href="./public/css/addPostForm.css">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>New Post</title>
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
            <form action="./index.php?action=createPost" method="post" enctype="multipart/form-data">
                <input type="text" name="caption" id="caption" placeholder="Caption">

                <!-- <label for="media">Media</label> -->

                <input type="file" name="media" id="media" accept=".jpg,.jpeg,.png,.mp4,.mov " placeholder="Media">

                <button type="submit" value="Upload Image/Video" name="submit" class="add-btn">Add</button>
            </form>
        </div>
    </div>




    <!-- User Profile -->
    <div class="user-profile">
        <a href="./index.php?action=viewProfile">
        <img src="<?= $_SESSION['profilePic'] ?? './public/images/user/user1.webp' ?>" alt="">
        <h4><?= htmlspecialchars($_SESSION['username']) ?></h4>
        </a>
    </div>

</body>

</html>

 