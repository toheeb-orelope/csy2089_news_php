<form action="editcategory.php" method="POST">

    <input type="hidden" name="category[id]" value="<?= $category['id'] ?? '' ?>">

    <label>Category name:</label>
    <input type="text" name="category[name]" value="<?= $category['name'] ?? '' ?>" />

    <input type="submit" value="Save" name="submit" />
</form>