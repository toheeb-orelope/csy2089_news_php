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
            <li><a href="">Home</a></li>
            <li><a href="latest.php">Latest Articles</a></li>
            <li><a href="#">Select Category</a>
                <ul>
                    <li><a href="news.php">Local News</a></li>
                    <li><a href="events.php">Local Events</a></li>
                    <li><a href="sport.php">Sport</a></li>

                    <?php foreach ($categories['categories'] as $category) { ?>

                        <li><a href="selectcategory.php?id=<?= $article['id'] ?>"><?= $category['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="contact.php">Contact us</a></li>
            <li><a href="advertise.php">Advertise with us</a></li>
        </ul>
    </nav>
    <img src="/images/banners/randombanner.php" />
    <main>
        <nav>
            <ul>
                <li><a href="news.php">Local News</a></li>
                <li><a href="events.php">Local Events</a></li>
                <li><a href="sport.php">Sport</a></li>
                <?php foreach ($categories['categories'] as $category) { ?>

                    <li><a href="selectcategory.php?id=<?= $article['id'] ?>"><?= $category['name'] ?></a></li>
                <?php } ?>
            </ul>
        </nav>
        <article>
            <?= $subTitlte ?? '' ?>
            <?= $display ?>
        </article>
    </main>

    <footer>
        &copy; Northampton News <?= date('Y'); ?>
    </footer>
</body>

</html>