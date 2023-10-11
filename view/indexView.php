<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/index_feed.css">
    <title>INDEX / HOME Page</title>
</head>

<body>

    <h1>
        This the index feed page
    </h1>

    <?php
    if (session_status() === PHP_SESSION_ACTIVE and isset($_SESSION['id'])) {
    ?>
        <h1>
            This the feed page
        </h1>
        <h2>
            TESTING id: <?= htmlspecialchars($_SESSION['id']) ?>
        </h2>
        <h2>TESTING username: <?= htmlspecialchars($_SESSION['username']) ?></h2>
    <?php
    } else {
    ?>
        <a href="index.php?action=showSignUpPage">
            <h2> Sign up</h2>
        </a>
    <?php
    }
    ?>
    <!-------------------------------------- HOME/LOGO BUTTON -------------------------------------------->
    <div class="buttons">
        <div class="logoButton">
            <a href="./index.php?action=search"><button> Logo/home </button> </a>
        </div>

        <!-------------------------------------- SEARCH SECTION -------------------------------------------->
        <div class="buttons">
            <div class="searchButton">
                <!-- <a href="./index.php?action=search"> -->
                    <form action="index.php?action=searchUser" method="POST">
                        <input id="search" type="text" placeholder="Search Username" name="userName">
                        <input id="submit" type="submit" value="Search">
                    </form>
                <!-- </a> -->
            </div>


            <!-------------------------------------- EXPLORE SECTION -------------------------------------------->
            <div class="buttons">
                <div class="exploreButton">
                    <a href="./index.php?action=explore"><button> Explore </button> </a>
                </div>


                <!-------------------------------------- PROFILE SECTION --------------------------------------------->

                <div class="profileButton">
                    <a href="./index.php?action=viewProfile"> <button>profile</button></a>
                </div>


                <!--------------------------------------- CHALLENGE OF THE DAY ---------------------------------------->

                <div class="challengeButton">
                    <a href="./index.php?action=challenge"><button>Challenge</button></a>
                </div>


                <!------------------------------------- ADD POST ------------------------------------------------->

                <div class="addPostButton">
                    <a href="./index.php?action=newPostForm"><button type="button">+ Add Post</button></a>
                </div>


                <!------------------------------------- LOGOUT ------------------------------------------------->

                <div class="logoutButton">
                    <a href="index.php?action=logOut"><button type="button">Logout</button></a>
                </div>
            </div>
            <!------------------------------------- FEED ------------------------------------------------->

            <div class="feedContainer">
                <?php
                foreach ($posts as $post) {

                    include "./view/components/postFeedDisplay.php";
                }
                ?>

            </div>



</body>

</html>