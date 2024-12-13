<form action="editarticle.php" method="POST">
    <input type="hidden" name="article[id]" value=" <?= $article['id'] ?? '' ?>">

    <label>Category</label>
    <select name="article[categoryId]">
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>" <?= isset($article['categoryId']) && $article['categoryId'] == $category['id'] ? 'selected' : '' ?>>
                <?= $category['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Article title:</label>
    <input type="text" name="article[title]" value="<?= $article['title'] ?? '' ?>" />


    <label>Article text:</label>
    <textarea name="article[description]"><?= $article['description'] ?? '' ?></textarea>

    <label>Date:</label>
    <input type="text" name="article[date]" value="<?= $article['date'] ?? (new DateTime())->format('Y-m-d H:i:s') ?>">

    <label>Arthor name:</label>
    <input type="text" name="article[authorname]" value="<?= $article['authorname'] ?? '' ?>" />

    <input type="submit" value="Submit" name="submit" />
</form>