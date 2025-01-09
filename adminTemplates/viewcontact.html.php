<?php if (!empty($contacts) && is_array($contacts)) { ?>
    <table>
        <?php foreach ($contacts as $contact) { ?>
            <tr>
                <td><a href="/contacts/edit?id=<?= $contact['id'] ?>"> <?= $contact['email'] ?></a></td>
                <td> <?= $contact['name'] ?></td>
                <td>
                    <select name="status[<?= $contact['id'] ?>]">
                        <?php foreach ($status as $statu) { ?>
                            <option value="<?= $statu ?>" <?= $contact['status'] === $statu ? 'selected' : '' ?>>
                                <?= ucfirst($statu) ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>No contacts found.</p>
<?php } ?>

<form action="/contacts/list" method="GET">
    <label for="">Response Status</label>
    <input type="text" name="keyword">
    <input type="submit" name="search" value="Search">
</form>