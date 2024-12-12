<?php foreach ($articles as $article) { ?>
    <table>
        <tr>
            <td> <?= $article['title'] ?></td>
            <td> <?= $article['description'] ?></td>
            <td> <?= $article['date'] ?></td>
        </tr>
    </table>
<?php } ?>



<?php foreach ($categories as $category) { ?>

    <p> <a href="selectcategory.php?id=<?= $article['id'] ?>"><?= $category['name'] ?></a></p>
<?php } ?>