<?php foreach ($articles as $article) { ?>
        <blockquote>
                <div>
                        <?php

                        echo '<img src="../images/' . htmlspecialchars($article['imgFile'])
                                . '" alt="Image" />';

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