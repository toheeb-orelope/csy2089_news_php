<div>
    <?php
    echo '<table>';
    foreach ($categories as $category) {
        echo '<tr>';
        echo '<td><a href="/article/list?id=' . $category['id'] . '">' . $category['name'] . '</a></td>';
        echo '<td><a href="/category/edit?id=' . $category['id'] . '">Edit</a></td>';
        echo '<td><a href="/category/delete?id=' . $category['id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td>';
        echo '</td>';
    }

    echo '</table>';
    ?>
</div>