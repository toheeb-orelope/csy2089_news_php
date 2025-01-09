<nav>
    <?php foreach ($categories as $category) { ?>

        <p><a href="/news/selectcategory?id=<?= $category['id'] ?>"><?= $category['name'] ?></a></p>
    <?php } ?>
</nav>