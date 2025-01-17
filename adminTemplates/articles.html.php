<?php foreach ($articles as $article) { ?>
    <blockquote>
        <div class="articleContainer">
            <?php

            echo '<img src="../images/' . htmlspecialchars($article['imgFile'])
                . '" alt="Image" />';

            ?>
            <h2><a href="/news/articledetail?id=<?= $article['id'] ?>">
                    <?= htmlspecialchars($article['title']) ?></a></h2>
        </div>

        <h3>Published By: <a href="/news/postby?username=<?= $article['username'] ?>">
                <?= $article['username'] ?></a></h3>
        <p><strong>Date Published: </strong>
            <?= htmlspecialchars($article['date']) ?></p>
    </blockquote>
<?php } ?>

<style>
    img {
        width: 100px;
        height: 100px;
        margin-right: 20px;
    }

    .articleContainer {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    a {
        color: #333;
        text-decoration: none;
    }

    a:hover {
        color: #f00;
    }
</style>