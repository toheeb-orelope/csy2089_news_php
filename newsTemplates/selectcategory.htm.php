<?php foreach ($articles as $article) { ?>
    <blockquote>
        <h2><a href="articledetail.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h2>
        <h3>Published By: <a href="postby.php?username=<?= $article['username'] ?>"><?= $article['username'] ?></a></h3>
        <p><strong>Date Published: </strong> <?= htmlspecialchars($article['date']) ?></p>
    </blockquote>
<?php } ?>