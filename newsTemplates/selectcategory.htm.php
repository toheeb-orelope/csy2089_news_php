<?php

// foreach ($articles as $article) {

//     echo '<table>';
//     echo '<tr>';
//     echo '<td>' . $article['title'] . '</td>';
//     echo '<td>' . $article['description'] . '</td>';
//     echo '<td>' . $article['date'] . '</td>';
//     echo '</tr>';
//     echo '</table>';

// }
?>

<?php foreach ($articles as $article) { ?>
    <blockquote>
        <h2><?= htmlspecialchars($article['title']) ?></h2>
        <h3>By <?= $article['authorname'] ?></h3>
        <p><strong>Date:</strong> <?= htmlspecialchars($article['date']) ?></p>
        <p><?= nl2br(htmlspecialchars($article['description'])) ?></p>
    </blockquote>
<?php } ?>