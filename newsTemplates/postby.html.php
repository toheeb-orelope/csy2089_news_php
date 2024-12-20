<?php
echo '<table>';
foreach ($articles as $article) {
    echo '<tr>';
    echo '<td><a href="articledetail.php?id=' . $article['id'] . '">' . $article['title'] . '</a></td>';
    echo '</td>';
}
echo '</table>';
