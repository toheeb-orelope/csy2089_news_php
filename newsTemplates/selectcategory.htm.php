<?php



foreach ($articles as $article) {

    echo '<table>';
    echo '<tr>';
    echo '<td>' . $article['title'] . '</td>';
    echo '<td>' . $article['description'] . '</td>';
    echo '<td>' . $article['date'] . '</td>';
    echo '</tr>';
    echo '</table>';

}
