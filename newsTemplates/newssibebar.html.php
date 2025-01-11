<nav>
    <?php foreach ($categories as $category) { ?>

        <p><a href="/news/selectcategory?id=<?= $category['id'] ?>"><?= $category['name'] ?></a></p>
    <?php } ?>
</nav>

<style>
    a {
        color: #333;
        text-decoration: none;
    }

    a:hover {
        color: #f00;
    }
</style>