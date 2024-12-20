<form action="viewusers.php" method="POST">
    <h3>Add Staff</h3>

    <input type="hidden" name="accounts[id]" value="<?= $account['id'] ?? '' ?>">

    <label for="">username</label>
    <input type="text" name="accounts[username]" value="<?= $account['username'] ?? '' ?>" required>

    <label for="">password</label>
    <input type="password" name="accounts[password]" value="">

    <label for="">name</label>
    <input type="text" name="accounts[name]" value="<?= $account['name'] ?? '' ?>" required>

    <label for="">Role:</label>
    <select name="accounts[status]">
        <?php foreach ($status as $statu): ?>
            <option value="<?= $statu ?>" <?= (!empty($accounts['status']) && $accounts['status']) === $statu ? 'selected' : '' ?>>
                <?= ucfirst($statu) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" name="submit" value="<?= isset($accounts['id']) ? 'Update' : 'Add' ?>" class="add_btn">
</form>

<style>
    .add_btn {
        margin-bottom: 5em;
    }

    table {
        margin-top: 2em;
    }
</style>

<?php
echo '<table>';
foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . $user['username'] . '</td>';
    echo '<td>' . $user['name'] . '</td>';
    echo '<td>' . $user['status'] . '</td>';
    echo '<td><a href="viewusers.php?action=edit&id=' . $user['id'] . '">Edit</a></td>';
    echo '<td><a href="viewusers.php?action=delete&id=' . $user['id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td>';
    echo '</td>';
}
echo '</table>';

