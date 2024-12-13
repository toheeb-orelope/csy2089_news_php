<?php if ($article): ?>
    <blockquote>
        <h2><?= htmlspecialchars($article['title']) ?></h2>
        <h3>By <?= $article['authorname'] ?></h3>
        <p><strong>Date:</strong> <?= htmlspecialchars($article['date']) ?></p>
        <p><?= nl2br(htmlspecialchars($article['description'])) ?></p>
    </blockquote>
<?php endif; ?>

<!-- Add Comment Form -->
<form action="comment.php?id=<?= htmlspecialchars($article['id']) ?>" method="POST">
    <label for="comment">Add Comment</label>
    <textarea name="comment" rows="5" cols="40" placeholder="Write your comment here..."></textarea>
    <input type="submit" name="sendcomment" value="Comment">
</form>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<!-- Display Comments -->
<h3>Comments</h3>
<?php if ($comments): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <p><strong><?= htmlspecialchars($comment['username']) ?>:</strong></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No comments yet. Be the first to comment!</p>
<?php endif; ?>