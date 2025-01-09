<div>
    <?php
    echo '<table>';
    foreach ($articles as $article) {
        echo '<tr>';
        echo '<td><a href="/article/articledetail?id=' . $article['id'] . '">' . $article['title'] . '</a></td>';
        echo '<td><a href="/article/edit?id=' . $article['id'] . '">Edit</a></td>';
        echo '<td><a href="/article/delete?id=' . $article['id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td>';
        echo '</td>';
    }
    echo '</table>';
    ?>
</div>