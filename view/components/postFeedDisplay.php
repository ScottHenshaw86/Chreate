<div class="post id<?= $post->id ?>">

    <div class="postdetails">
        <div class="useronpost"><?= htmlspecialchars($post->username) ?></div>
        <div>challenge: <?= $post->tag ?></div>
        <div class="date">date: <?= htmlspecialchars($post->date_created) ?></div>
       

        <!-- // AJAX Request
        // STEP 1
        const xhr = new XMLHttpRequest();
        // STEP 2
        xhr.open("GET", "URL"); // TODO: add url
        // STEP 4
        xhr.addEventListener("readystatechange", () => {    serg
        if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.response);
        // TODO: do somthing with the response
        }
        })
        // STEP 3
        xhr.send(null); -->

    </div>

    <?php
    $path_parts = pathinfo($post->media_src);
    $extension = $path_parts['extension'];

    if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") { ?>
        <div><img onclick="showModalForPost(<?= $post->id ?>)" src="<?= htmlspecialchars($post->media_src) ?>" class="postcontent"></div>
    <?php
    } else { ?>
        <video loop autoplay muted onclick="showModalForPost(<?= $post->id ?>)">
            <source src="<?= ($post->media_src) ?>" type="video/<?= $extension ?>" class="postcontent">
        </video> <?php
                }
                    ?>
    <div class="caption"><?= htmlspecialchars($post->captions) ?></div>
    <i class='bx <?= $post->user_liked ? "bxs" : "bx" ?>-heart' onclick="likePost(this, <?= $_SESSION['id']; ?>, <?= $post->id; ?>)"></i>
        <br>
    <br>
    <br>
</div>