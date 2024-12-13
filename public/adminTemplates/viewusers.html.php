<?php
echo '<table>';
foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . $user['username'] . '</td>';
    echo '<td>' . $user['name'] . '</td>';
    echo '<td>' . $user['status'] . '</td>';
    echo '<td><a href="register.php?id=' . $user['id'] . '">Edit</a></td>';
    echo '<td><a href="deleteuser.php?id=' . $user['id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td>';
    echo '</td>';
}
echo '</table>';

