<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Page</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="./public/css/explore.css">
    <!-- boxICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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

    <div class="searchButton">
        <form action="index.php?action=searchingChallenges" method="POST">
            <input id="search" type="text" placeholder="Search Challenge" name="challenges">
            <input id="submit" type="submit" value="Search">
        </form>
    </div>

    <!-- <div class="feedContainer">
        <?php
        foreach ($posts as $post) {
            include "./view/components/postFeedDisplay.php";
        }
        ?>

    </div> -->

    <!-- photo gallery -->
    <div class="container">
        <div class="photo-gallery">
            <div class="column">
                <div class="photo">
                    <div class="box">
                        <img src="./public/images/g.jpg" alt="">
                    </div>
                    <div class="box">
                        <img src="./public/images/img_5950.jpg" alt="">
                    </div>
                    <div class="box">
                        <img src="./public/images/img_5951.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="photo">
                    <div class="box">
                        <img src="./public/images/picc.jpg" alt="">
                    </div>
                    <div class="box">
                        <img src="./public/images/xs.jpg" alt="">
                    </div>
                    <div class="box">
                        <img src="./public/images/x.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="photo">
                    <div class="box">
                        <img src="./public/images/pic.jpg" alt="">
                    </div>
                    <div class="box">
                        <img src="./public/images/temp_tide.jpg" alt="">
                    </div>
                    <div class="box">
                        <img src="./public/images/ramsssss.png" alt="">
                    </div>
                </div>
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