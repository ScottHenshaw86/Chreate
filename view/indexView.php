<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS links -->
    <link rel="stylesheet" href="./public/css/indexView.css">
    <link rel="stylesheet" href="./public/css/searchModal.css">
    <link rel="stylesheet" href="./public/css/index_feed.css">
    <link rel="stylesheet" href="./public/css/searchBar.css">

    <!-- JS links -->
    <!-- <script defer src="./public/js/searchbar.js"></script> -->
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

        <label for="userName">
        </label>

        <button class="icons searchButton tooltip">
            <i class="bx bx-search"></i>
            <span class="tooltiptext">Search</span>
        </button>
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

    ` <!-- User Profile -->`
    <div class="user-profile">
        <a href="./index.php?action=viewProfile">
            <img src="<?= $_SESSION['profilePic'] ?? './public/images/user/user1.webp' ?>" alt="">
            <h4><?= htmlspecialchars($_SESSION['username']) ?></h4>
        </a>
    </div>

    <!-- SEARCH MODAL -->
    <div class="searchModal">
        <div class="right-side">
            <!-- <span>&times;</span> -->
            <div class="caption">Lorem Ipsum Mother Fucker</div>
            <div id="searchInputAndResultsContainer">
                <input type="text" id="userName" autocomplete="off">
                <div class="searchContainer"></div>
            </div>
        </div>
    </div>
    <script>
        const searchButton = document.querySelector('.searchButton');
        const searchModal = document.querySelector('.searchModal');

        function openSearchModal() {
            searchModal.style.display = "flex";
        }

        function closeModal(e) {
            // console.log("TARGET: ",e.target); // the element that triggered the event
            // console.log("CURRENT TARGET: ",e.currentTarget); // the element that has the event listener attached
            if (e.target === e.currentTarget) {
                searchModal.style.display = "none";
            }
        }

        searchModal.addEventListener('click', closeModal);
        searchButton.addEventListener('click', openSearchModal);

        const serg = () => {
            console.log("SERG");
            const userInput = userName.value;

            //AJAX 
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `http://<?= getenv("LOCALHOST"); ?>/sites/Chreate/index.php?action=searchUser&userName=${userInput}`);
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                console.log("RESPONSE", response);
                const usernames = response.split('||');

                const div = document.querySelector('.searchContainer')
                div.innerHTML = "";

                for (let i = 0; i < usernames.length; i++) {
                    const a = document.createElement('a');
                    a.href = `index.php?action=userSelect&user=${usernames[i]}`;
                    div.appendChild(a);
                    a.textContent = usernames[i];
                }
                div.style.display = "block";
            });

            xhr.send(null);
        }

        userName.addEventListener('keyup', serg);
    </script>

    <!-- POST MODAL -->
    <div class="container">
        <div class="modal">
            <!-- <img src="/public/images/profilepage/greens.jpg" alt="" /> -->
            <div class="modal-inner">
                <span>&times;</span>
                <div class="post-content">
                    <!-- <img src="" alt=""> -->
                </div>
                <div class="right-side">
                    <div class="postdetails">
                        <div class="useronpost"></div>
                        <div class="challengeData"></div>
                        <div class="date"></div>
                        <br>
                    </div>
                    <div class="caption"></div>
                    <div>
                        <i  class="bx bx-heart icons"></i>
                    </div>
                    <div class="comment">
                        <!-- loop and display comments here -->
                        <input type="text" name="comment" placeholder="Add a comment...">
                        <button class="post-btn" type="submit">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showModalForPost(id) {
            // Step 1
            const xhr = new XMLHttpRequest();
            // Step 2
            xhr.open("GET", `http://<?= getenv("LOCALHOST"); ?>/sites/Chreate/index.php?action=getAllPostDataById&id=${id}`);
            // Step 4
            xhr.addEventListener('load', function() {
                const response = JSON.parse(xhr.response);
                console.log(response);
                // console.log("RESPONSE:", response);

                putDataIntoModal(response);
            });

            // Step 3
            xhr.send(null);
        }

        function closeModal() {
            const modal = document.querySelector('.modal');
                const videoElement = modal.querySelector('video');
                if (videoElement) {
                    videoElement.src = "";
                }
                modal.style.display = 'none';
        }
        // Close the modal when clicking on the close button
        document.querySelector('.modal span').onclick = closeModal;
        document.querySelector('.modal').addEventListener('click', (e) => {
            // console.log(e.target)
            if (e.currentTarget === e.target) {
                closeModal();
            }
        });

        

        function putDataIntoModal(data) {
            
            // TODO: plug the data from the response into the modal HTML elements' textContent
            const modal = document.querySelector('.modal');

            modal.querySelector('.date').textContent = data.date_created;
            modal.querySelector('.caption').textContent = data.captions;
            // modal.querySelector('.post-content img').src = data.media_src;
            modal.querySelector('.useronpost').textContent = data.username;
            modal.querySelector('.challengeData').textContent = data.tag;

            const fileExtension = data.media_src.split(".")[2];
            const imageTypes = ["jpg", "jpeg", "png"];

            let mediaDisplay;

            if (imageTypes.includes(fileExtension)) {
                mediaDisplay = document.createElement('img');
            } else {
                mediaDisplay = document.createElement("video");
                mediaDisplay.controls = true;
                mediaDisplay.autoplay = true;
                mediaDisplay.muted = true;
            }

            mediaDisplay.src = data.media_src;

            const postContent = modal.querySelector('.post-content');
            postContent.innerHTML = "";

            postContent.appendChild(mediaDisplay);

            const liked = modal.querySelector('.bx');
            if (data.user_liked) {
                liked.classList.remove('bx-heart');
                liked.classList.add('bxs-heart')
            } else {
                liked.classList.add('bx-heart');
                liked.classList.remove('bxs-heart')
            }
            liked.onclick = function() {
                likePost(this, userId, data.id);
            }


            // This should be last
            modal.style.display = 'flex';
        }
    </script>

<?php include "./public/js/likePost.php"; ?>
</body>

</html>