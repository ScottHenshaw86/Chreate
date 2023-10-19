<script>
    const userId = <?= $_SESSION['id'] ?>;
    const base_url = "<?= getenv("LOCALHOST"); ?>";
function likePost(element, user_id, post_id) {

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `http://${base_url}/sites/Chreate/index.php?action=likePost&user_id=${user_id}&post_id=${post_id}`);
    xhr.addEventListener("load", () => {
        const response = xhr.response;
        const feedPostHeart = document.querySelector(`.id${post_id} .bx`);
        if (response == "like") {
            element.classList.add("bxs-heart");
            element.classList.remove("bx-heart");
            feedPostHeart.classList.add("bxs-heart");
            feedPostHeart.classList.remove("bx-heart");
        } else {
            element.classList.remove("bxs-heart");
            element.classList.add("bx-heart");
            feedPostHeart.classList.remove("bxs-heart");
            feedPostHeart.classList.add("bx-heart");
        }
    })
    xhr.send(null);
}

</script>