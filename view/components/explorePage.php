<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Page</title>
</head>

<body>
    <h1>EXPLORE PAGE</h1>

    <div class="searchButton">
        <!-- <form action="index.php?action=searchingChallenges" method="POST"> -->
            <input id="search" type="text" placeholder="Search Challenge" name="challenges">
            <div class="searchContainer"></div>
            <!-- <input id="submit" type="submit" value="Search"> -->
        <!-- </form> -->
    </div>
<!-- POSTS -->
    <div class="feedContainer">
        <?php
        foreach ($posts as $post) {
            include "./view/components/postFeedDisplay.php";
        }
        ?>

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
    </script>


</body>

</html>