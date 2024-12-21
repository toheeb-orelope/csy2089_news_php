<?php if ($article): ?>
    <blockquote>
        <h2><?= htmlspecialchars($article['title']) ?></h2>
        <h3>Published By: <a href="postby.php?username=<?= $article['username'] ?>"><?= $article['username'] ?></a></h3>
        <p><strong>Date Published:</strong> <?= htmlspecialchars($article['date']) ?></p>
        <p><?= nl2br(htmlspecialchars($article['description'])) ?></p>
    </blockquote>
<?php endif; ?>

<!-- Display Comments -->
<?php if (isset($comments) && $comments) { ?>
    <ul>
        <?php foreach ($comments as $comment) { ?>
            <li>
                <p><strong><?= $comment['username'] ?>:</strong> <?= nl2br(htmlspecialchars($comment['commenttext'])) ?></p>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>No comments yet. Be the first to comment!</p>
<?php } ?>

<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
</style>

<!-- Add Comment Form -->
<form action="articledetail.php?id=<?= $article['id'] ?>" method="POST">

    <input type="hidden" name="comment[id]" value="<?= $comment['id'] ?? '' ?>">


    <input type="hidden" name="comment[articleId]" value="<?= $article['id'] ?? '' ?>">

    <label for="username">Username</label>
    <input type="text" name="comment[username]" placeholder="Enter your username"
        value="<?= $comment['username'] ?? '' ?>" required>

    <label for="email">Email</label>
    <input type="email" name="comment[email]" placeholder="Enter your email" value="<?= $comment['email'] ?? '' ?>"
        required>

    <label for="comment">Add Comment</label>
    <textarea name="comment[commenttext]" rows="5" cols="40" placeholder="Write your comment here..."
        required><?= $comment['commenttext'] ?? '' ?></textarea>

    <input type="submit" name="sendcomment" value="Comment">
</form>


<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>