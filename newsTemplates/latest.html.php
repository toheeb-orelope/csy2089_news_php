<?php foreach ($articles as $article) { ?>
    <div class="container">
        <hr />
        <h3> <?= htmlspecialchars($article['title']) ?> </h3>
        <h3>Published By: <a href="/news/postby?username=<?= $article['username'] ?>"><?= $article['username'] ?></a></h3>
        <em> <?= htmlspecialchars($article['date']) ?> </em>
        <?php echo '<img src="../images/' . htmlspecialchars($article['imgFile']) . '" alt="Image" />'; ?>
        <p><a href="/news/articledetail?id=<?= $article['id'] ?>">Read More</a></p>
    </div>
<?php } ?>
<?php
echo "<p>Found " . count($articles) . " articles.</p>";
?>

<style>
    a {
        color: #333;
        text-decoration: none;
    }

    a:hover {
        color: #f00;
    }

    img {
        width: 100px;
        height: 100px;
        margin-right: 20px;
    }

    .container {
        margin-top: 50px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
</style>