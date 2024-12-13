<?php
echo '<table>';
foreach ($categories as $category) {
    echo '<tr>';
    echo '<td>' . $category['name'] . '</td>';
    echo '<td><a href="editcategory.php?id=' . $category['id'] . '">Edit</a></td>';
    echo '<td><a href="deletecategory.php?id=' . $category['id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td>';
    echo '</td>';
}
echo '</table>';
