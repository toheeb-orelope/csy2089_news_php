<?php if ($article): ?>
    <blockquote>
        <h2><?= htmlspecialchars($article['title']) ?></h2>
        <h3>Published By: <a href="/news/postby?username=<?= $article['username'] ?>"><?= $article['username'] ?></a></h3>
        <p><strong>Date Published:</strong> <?= htmlspecialchars($article['date']) ?></p>
        <p><?= nl2br(htmlspecialchars($article['description'])) ?></p>
        <div class="image-container">
            <?php echo '<img src="../images/' . htmlspecialchars($article['imgFile']) . '" alt="Image" />'; ?>
        </div>
    </blockquote>
<?php endif; ?>


<?php
if ($comments) {
    echo '<p>Comments</p>';
    echo '<table>';
    foreach ($comments as $comment) {
        echo '<tr>';
        echo '<td><strong>' . htmlspecialchars($comment['username']) . '</strong></td>';
        echo '<td>' . htmlspecialchars($comment['commenttext']) . '</td>';

        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No comments yet. Be the first to comment!</p>';
}
?>


<!-- Add Comment Form -->
<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>

    <form action="articledetail?id=<?= $article['id'] ?>" method="POST">

        <input type="hidden" name="comment[id]" value="<?= $comment['id'] ?? '' ?>">

        <label for="comment">Add Comment</label>
        <textarea name="comment[commenttext]" rows="5" cols="40" placeholder="Write your comment here..."
            required></textarea>

        <input type="submit" name="sendcomment" value="Comment">
    </form>
<?php else: ?>
    <p>
        <a href="/news/loginpage?redirect=articledetail?id=<?= $article['id'] ?>">Login</a> or
        <a href="/news/profile?redirect=articledetail?id=<?= $article['id'] ?>">Register</a> to comment.
    </p>

<?php endif; ?>


<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        align-items: left;
    }

    a {
        color: #333;
        text-decoration: none;
    }

    a:hover {
        color: #f00;
    }

    .image-container {
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>