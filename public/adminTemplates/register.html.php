<form action="register.php" method="POST">

    <input type="hidden" name="accounts[id]" value="<?= $account['id'] ?? '' ?>">

    <label for="">username</label>
    <input type="text" name="accounts[username]" value="<?= $account['username'] ?? '' ?>" required>

    <label for="">password</label>
    <input type="password" name="accounts[password]" value="">

    <label for="">name</label>
    <input type="text" name="accounts[name]" value="<?= $account['name'] ?? '' ?>" required>

    <select name="accounts[status]">
        <?php foreach ($status as $statu): ?>
            <option value="<?= $statu ?>" <?= (!empty($accounts['status']) && $accounts['status']) === $statu ? 'selected' : '' ?>>
                <?= ucfirst($statu) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" name="submit" value="<?= isset($accounts['id']) ? 'Update' : 'Sign Up' ?>">
</form>