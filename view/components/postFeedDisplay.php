<div class="post">

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
        xhr.addEventListener("readystatechange", () => {    
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
        <div><img src="<?= htmlspecialchars($post->media_src) ?>" class="postcontent"></div>
    <?php
    } else { ?>
        <video width="600" height="400" controls>
            <source src="<?= ($post->media_src) ?>" type="video/<?= $extension ?>" class="postcontent">
        </video> <?php
                }
                    ?>
    <div class="caption"><?= htmlspecialchars($post->captions) ?></div>
    <i class='bx bx-heart' onclick="likePost(this, <?= $_SESSION['id']; ?>, <?= $post->id; ?>)"></i>
        <br>

        <script>
            function likePost(element, user_id, post_id) {

                const xhr = new XMLHttpRequest();
                xhr.open('GET', `http://<?= getenv("LOCALHOST"); ?>/sites/Chreate/index.php?action=likePost&user_id=${user_id}&post_id=${post_id}`);
                xhr.addEventListener("load", () => {
                    const response = xhr.response;
                    if (response == "like") {
                        element.classList.add("bxs-heart");
                        element.classList.remove("bx-heart");          
                    } else {
                        element.classList.remove("bxs-heart");
                        element.classList.add("bx-heart");
                    }
                })
                xhr.send(null);

            }
            
        </script>
    <br>
    <br>
</div>