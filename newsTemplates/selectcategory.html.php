<?php foreach ($articles as $article) { ?>
        <blockquote>
                <div>
                        <?php
                        if (isset($image['id']) && $image['id'] == $article['imageId']) {
                                echo '<img src="../images/' . htmlspecialchars($image['imgfile'])
                                        . '" alt="Image" />';
                        } else {
                                echo '<img src="../images/noimage.png" alt="No Image" />';
                        }
                        ?>
                        <h2><a href="articledetail?id=<?= $article['id'] ?>">
                                        <?= htmlspecialchars($article['title']) ?></a></h2>
                </div>

                <h3>Published By: <a href="postby?username=<?= $article['username'] ?>">
                                <?= $article['username'] ?></a></h3>
                <p><strong>Date Published: </strong>
                        <?= htmlspecialchars($article['date']) ?></p>
        </blockquote>
<?php } ?>