<?php foreach ($articles as $article) { ?>
    <hr />
    <h3> <?= $article['title'] ?> </h3>
    <em> <?= $article['date'] ?> </h2>
        <p> <?= $article['description'] ?> </p>
    <?php } ?>
    <?php
    echo "<p>Found " . count($articles) . " articles.</p>";
    ?>