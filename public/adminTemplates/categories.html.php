<?php
echo '<table>';
foreach ($categories as $category) {
    echo '<tr>';
    echo '<td>' . $category['name'] . '</td>';
    echo '<td><a href="editcategory.php?id=' . $category['id'] . '">Edit</a></td>';
    echo '<td><a href="deletecategory.php?id=' . $category['id'] . '">Delete</a></td>';
    echo '</td>';
}
echo '</table>';
