<nav>
    <?php foreach ($categories as $category) { ?>

        <p><a href="selectcategory.php?id=<?= $category['id'] ?>"><?= $category['name'] ?></a></p>
    <?php } ?>
</nav>