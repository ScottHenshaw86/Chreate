<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile_Page</title>
    <!-- boxICONS -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- CSS link -->
    <link rel="stylesheet" href="public/css/profilepage.css" />
    <!-- JS link -->
    <script defer src="public/js/profilePage.js"></script>
  </head>
  <body>
    <div class="header-wrapper">
      <header></header>
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
            <ul>
              <li><i class='bx bxl-instagram-alt'></i></li>
              <li><i class='bx bxl-twitter' ></i></li>
              <li><i class='bx bxl-tiktok'></i></li>
              <li><i class='bx bxl-facebook-circle' ></i></li>
            </ul>
          </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-col">
          <nav>
            <ul>
              <li><a href="#">Photos</a></li>
              <li><a href="#">Videos</a></li>
              <button>Follow</button>
            </ul>
          </nav>

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
  </body>
</html>
