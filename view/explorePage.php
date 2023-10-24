<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Page</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="./public/css/explore.css">
    <link rel="stylesheet" href="./public/css/searchbar.css">
    <link rel="stylesheet" href="./public/css/comments.css">

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

    <div class="searchButton">
        <!-- <form action="index.php?action=searchingChallenges" method="POST"> -->
        <input id="search" type="text" placeholder="Search Challenge" name="challenges">
        <div class="searchContainer"></div>
        <!-- <input id="submit" type="submit" value="Search"> -->
        <!-- </form> -->
    </div>

    <div class="feedContainer">
        <?php
        foreach ($posts as $post) {
            include "./view/components/postFeedDisplay.php";
        }
        ?>

    </div>

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
                        <div class="date pb"></div>
                        <br>
                    </div>
                    <div class="caption"></div>
                    <div>
                        <i class="bx bx-heart icons"></i>
                    </div>
                    <div class="comment">
                        <!-- loop and display comments here -->
                        <div class="wholeBox">

                        </div>
                        <div class="messagebox">
                            <form action="index.php?action=insertComment" method=POST>
                                <!-- <input class="userInput" type="text" id="user_id" name="user_id" placeholder="user_id"> -->
                                <input type="hidden" name="post_id" id="post_id">
                                <input class="msgInput" type="text" id="text_content" name="text_content" placeholder="message">
                                <button class="button">SEND</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const requestExplorePostData = () => {

            const postSelect = search.value;

            //AJAX 
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `http://<?= getenv("LOCALHOST"); ?>/sites/Chreate/index.php?action=searchingChallenges&challenges=${postSelect}`);
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                console.log(response);
                const challenges = response.split('||');

                const div = document.querySelector('.searchContainer')
                console.log(div);

                div.innerHTML = "";
                for (let i = 0; i < challenges.length; i++) {
                    const a = document.createElement('a');
                    a.href = `index.php?action=challengePostSelect&post=${challenges[i]}`;
                    div.appendChild(a);
                    a.textContent = challenges[i];
                }
            });

            xhr.send(null);
        }

        search.addEventListener('keyup', requestExplorePostData);



        function showModalForPost(id) {
            // Step 1
            const xhr = new XMLHttpRequest();
            // Step 2
            xhr.open("GET", `http://<?= getenv("LOCALHOST"); ?>/sites/Chreate/index.php?action=getAllPostDataById&id=${id}`);
            // Step 4
            xhr.addEventListener('load', function() {
                console.log("Response: ", xhr.response);
                const response = JSON.parse(xhr.response);
                // console.log("JSON RESPONSE:", response);

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

        function putDataIntoModal(response) {
            const {
                data,
                comments
            } = response; // protip: object destructuring
            // TODO: plug the data from the response into the modal HTML elements' textContent
            const modal = document.querySelector('.modal');

            console.log(data);

            document.getElementById("post_id").value = data.id;
            // console.log("THIS ONEE" + data.id);


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

            const commentsContainer = modal.querySelector('.wholeBox');
            commentsContainer.innerHTML = "";

            comments.forEach(comment => {
                console.log(comment);
                // Create HTML for a single comment
                const commentElement = document.createElement('div');
                commentElement.classList.add('comment');

                const commentInfo = document.createElement('div');
                commentInfo.classList.add('comment-info');

                //TODO make it put in img
                //pfp
                const commentPfp = document.createElement('img');
                commentPfp.classList.add('comment-profile_img');
                const rand = Math.ceil(Math.random() * 5);
                console.log("RAND:", rand);
                commentPfp.src = comment.profile_img ?? `./public/images/user/user${rand}.webp`;

                //username
                const commentUsername = document.createElement('p');
                commentUsername.classList.add('comment-username');
                commentUsername.textContent = comment.username;

                //userid
                // const commentAuthor = document.createElement('p');
                // commentAuthor.classList.add('comment-author');
                // commentAuthor.textContent = comment.author;
                
                // comment text
                const commentText = document.createElement('p');
                commentText.classList.add('comment-text');
                commentText.textContent = comment.text_content;
                
                //date created
                const commentDate = document.createElement('p');
                commentDate.classList.add('comment-date');
                commentDate.textContent = comment.date_created;

                commentInfo.appendChild(commentPfp);
                commentInfo.appendChild(commentUsername);
                commentInfo.appendChild(commentDate);

                commentElement.appendChild(commentInfo);
                commentElement.appendChild(commentText);

                // Append the comment to the container
                commentsContainer.appendChild(commentElement);
                console.log(commentsContainer);
                
            });
            // This should be last
            modal.style.display = 'flex';
        }
    </script>



    <!-- photo gallery -->
    <!-- <div class="container">
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

        </div> -->

    <!-- User Profile -->
    <div class="user-profile">
        <a href="./index.php?action=viewProfile">
            <img src="<?= $_SESSION['profilePic'] ?? './public/images/user/user1.webp' ?>" alt="">
            <h4><?= htmlspecialchars($_SESSION['username']) ?></h4>
        </a>
    </div>
    </div>
    <?php include "./public/js/likePost.php"; ?>
</body>

</html>