<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS links -->
    <link rel="stylesheet" href="./public/css/indexView.css">
    <link rel="stylesheet" href="./public/css/index_feed.css">
    <link rel="stylesheet" href="./public/css/searchBar.css">
    <title>INDEX / HOME Page</title>
   
</head>

<body>



    <?php
    if (session_status() === PHP_SESSION_ACTIVE and isset($_SESSION['id'])) {
    ?>
    <?php
    } else {
    ?>
        <a href="index.php?action=showSignUpPage">
            <h2> Sign up </h2>
        </a>
    <?php
    }
    ?>
    <!-- NAVBAR -->
    <a href="./index.php?action=challenge">
        <button class="btn challenge-btn">Challenge of the Day</button>
    </a>

    <div class="navbar">
        <div class="logo">
            <a href="./index.php?action=indexView.php"><img src="./public/images/logo2.png" alt="" /></a>
        </div>
        <!--         <a href="./index.php?action=search" class="icons searchButton tooltip">
            <i class="bx bx-search"></i>
            <span class="tooltiptext">Search</span>
        </a> -->
        <label for="userName">
            <h2>Search for user</h2>
        </label>
        <input type="text" id="userName">
        <div class="searchContainer"></div>
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

    <!-- POST -->
    <div class="posts">
        <div class="post">
            <div class="head">
                <div class="feedContainer">
                    <?php
                    foreach ($posts as $post) {

                        include "./view/components/postFeedDisplay.php";
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="modal">
            <span>&times;</span>
            <!-- <img src="/public/images/profilepage/greens.jpg" alt="" /> -->
            <div class="modal-inner">
                <div class="post-content"></div>
                <div class="right-side">
                    <div class="caption">Lorem Ipsum Mother Fucker</div>
                    <div class="icons">
                        <i class="bx bx-heart"></i>
                    </div>
                    <div class="comment">
                        <!-- loop and display comments here -->
                        <textarea name="comment" id="" cols="30" rows="10"placeholder="Add a comment..."></textarea>
                        <button class="post-btn" type="submit">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    ` <!-- User Profile -->`
    <div class="user-profile">
        <a href="./index.php?action=viewProfile">
            <img src="<?= $_SESSION['profilePic'] ?? './public/images/user/user1.webp' ?>" alt="">
            <h4><?= htmlspecialchars($_SESSION['username']) ?></h4>
        </a>
    </div>
    <script>
        const serg = () => {

            const userInput = userName.value;

            //AJAX 
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `http://<?= getenv("LOCALHOST"); ?>/sites/Chreate/index.php?action=searchUser&userName=${userInput}`);
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                const usernames = response.split('||');

                const div = document.querySelector('.searchContainer')
                div.innerHTML = "";

                for (let i = 0; i < usernames.length; i++) {
                    const a = document.createElement('a');
                    a.href = `index.php?action=userSelect&user=${usernames[i]}`;
                    div.appendChild(a);
                    a.textContent = usernames[i];
                }
            });

            xhr.send(null);
        }

        userName.addEventListener('keyup', serg);


        // modal

        document.querySelectorAll('.feedContainer .post').forEach(post => {
            post.addEventListener('click', (e) => {
                const postContent = post.innerHTML;
                const modal = document.querySelector('.modal');
                const postContentDiv = modal.querySelector('.post-content');
                postContentDiv.innerHTML = postContent;

                modal.style.display = 'block';
            });
        });

        // Close the modal when clicking on the close button
        document.querySelector('.modal span').onclick = () => {
            document.querySelector('.modal').style.display = 'none';
        };
    </script>
</body>

</html>