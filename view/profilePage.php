<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile_Page</title>
  <!-- boxICONS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <!-- CSS link -->
  <link rel="stylesheet" href="public/css/profilepage.css" />
  <!-- <link rel="stylesheet" href="./public/css/postFeedDisplay.css"> -->


  <link rel="icon" href="./public/images/favicon.ico" type="image/x-icon">

</head>

<body>

  <div class="header-wrapper">
    <header>
      <div class="logo">
        <a href="./index.php?action=indexView.php"><img src="./public/images/logo2.png" alt="" /></a>
      </div>
    </header>
    <div class="cols-container">
      <!-- LEFT COLUMN -->
      <div class="left-col">
        <div class="img-container">
          <img src="<?= $profile->profile_img ?? './public/images/user/user4.webp' ?>" alt="">
          <span></span>
        </div>
        <h2><?= $profile->username ?></h2>
        <a href="./index.php?action=editProfileForm"><button class="edit-btn">Edit Profile</button></a>

        <ul class="about">
          <li><span>8,473</span>Followers</li>
          <li><span>439</span>Following</li>
        </ul>

        <div class="content">
          <p><?= $profile->bio ?></p>

          <!-- SOCIAL MEDIA -->
          <!-- <ul>
              <li><i class='bx bxl-instagram-alt'></i></li>
              <li><i class='bx bxl-twitter' ></i></li>
              <li><i class='bx bxl-tiktok'></i></li>
              <li><i class='bx bxl-facebook-circle' ></i></li>
            </ul> -->
        </div>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="right-col">

        <!-- PHOTOS -->

        <div class="photos">
          <?php
          foreach ($posts as $post) {
            include "./view/components/postFeedDisplay.php";
          }
          ?>
        </div>


      </div>
    </div>
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
</body>

</html>