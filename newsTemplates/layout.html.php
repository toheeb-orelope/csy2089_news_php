<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/styles.css" />
    <link rel="shortcut icon" href="/images/banners/randombanner.php" type="image/x-icon">
    <meta name="summary" content="Assignment 2024" />
    <title>Northampton News - <?= $pageTitle ?></title>
</head>

<body>
    <header>
        <section>
            <h1>Northampton News</h1>
        </section>
    </header>
    <nav>
        <ul>
            <li><a href="/newshome">Home</a></li>
            <li><a href="/latest">Latest Articles</a></li>
            <li><a href="#">Select Category</a>
                <ul>
                    <?php foreach ($categories as $category) { ?>
                        <li><a href="selectcategory?id=<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
                    <?php } ?>

                </ul>
            </li>
            <li><a href="/contact">Contact us</a></li>
            <li><a href="/advertise">Advertise with us</a></li>
        </ul>
    </nav>
    <img src="/images/banners/randombanner.php" />
    <main>

        <?= $sidebar ?? '' ?>

        <article>
            <?= $subTitle ?>
            <?= $display ?>
        </article>
    </main>

    <footer>
        &copy; Northampton News <?= date('Y'); ?>
    </footer>
</body>

</html>