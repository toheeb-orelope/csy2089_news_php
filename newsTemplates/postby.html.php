<?php
echo '<table>';
foreach ($articles as $article) {
    echo '<div class="articleContainer">';
    echo '<tr>';
    echo '<td><img src="/images/' . $article['imgFile'] . '" alt="Image" /></td>';
    echo '<td><a href="/news/articledetail?id=' . $article['id'] . '">' . $article['title'] . '</a></td>';
    echo '</td>';
    echo '</div>';
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

    img {
        width: 100px;
        height: 100px;
        margin-right: 20px;
    }
</style>