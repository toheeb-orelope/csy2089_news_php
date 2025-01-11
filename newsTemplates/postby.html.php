<?php
echo '<table>';
foreach ($articles as $article) {
    echo '<tr>';
    echo '<td><a href="/news/articledetail?id=' . $article['id'] . '">' . $article['title'] . '</a></td>';
    echo '</td>';
}
echo '</table>';
?>

<style>
    a {
        color: #333;
        text-decoration: none;
    }

    a:hover {
        color: #f00;
    }
</style>