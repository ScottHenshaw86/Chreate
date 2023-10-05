<div class="post">
    <div>challenge: <?= $post->tag ?></div>
    <div>media: <?= htmlspecialchars($post->media_src) ?></div>
    <div>caption: <?= htmlspecialchars($post->captions) ?></div>
    <div>date: <?= htmlspecialchars($post->date_created) ?></div>
    <div>user: <?= htmlspecialchars($post->username) ?></div>
    <br>
    <br>
</div>