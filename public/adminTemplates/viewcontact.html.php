<?php if (!empty($contacts)) { ?>
    <form action="viewcontacts.php" method="POST">
        <?php foreach ($contacts as $contact) { ?>
            <table>
                <tr>
                    <td> <?= $contact['email'] ?></td>
                    <td> <?= $contact['name'] ?></td>
                    <td> <?= $contact['phone'] ?></td>
                    <td> <?= $contact['comment'] ?></td>
                    <td>
                        <select name="status[<?= $contact['id'] ?>]">
                            <option value="pending" <?= $contact['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="done" <?= $contact['status'] === 'done' ? 'selected' : '' ?>>Done</option>
                        </select>
                    </td>
                    <td> <?= $contact['date_updated'] ?></td>
                    <td> <?= $contact['update_by_user'] ?? '' ?></td>
            </table>
        <?php }
} else {
    echo "<p>No pending contacts found.</p>";
} ?>
    <input type="submit" name="update_status" value="Update">
</form>

<form action="viewcontacts.php" method="GET">
    <label for="">Response Status</label>
    <input type="text" name="keyword">


    <input type="submit" name="search" value="Search">
</form>