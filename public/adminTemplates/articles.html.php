<?php
echo '<table>';
foreach ($articles as $article) {
    echo '<tr>';
    echo '<td>' . $article['title'] . '</td>';
    echo '<td><a href="editarticle.php?id=' . $article['id'] . '">Edit</a></td>';
    echo '<td><a href="deletearticle.php?id=' . $article['id'] . '">Delete</a></td>';
    echo '</td>';
}
echo '</table>';
