<div class="post">
    <div>challenge: <?= $post->tag ?></div>

    <div class="postdetails">
        <div class="useronpost"><?= htmlspecialchars($post->username) ?></div>
        <br>
        <div class="caption"><?= htmlspecialchars($post->captions) ?></div>
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
                    <div class="date">date: <?= htmlspecialchars($post->date_created) ?></div>   
    <br>
    <br>
</div>