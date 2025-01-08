<?php if (!empty($contact) && is_array($contact)) { ?>
    <form action="fullmessage.php?id=<?= $contact['id'] ?>" method="POST">
        <blockquote>
            <p> <?= $contact['email'] ?></p>
            <p> <?= $contact['name'] ?></p>
            <p> <?= $contact['phone'] ?></p>
            <p> <?= $contact['comment'] ?></p>
            <p> <?= $contact['date_updated'] ?></p>
            <p>
                <select name="status[<?= $contact['id'] ?>]">
                    <?php foreach ($status as $statu) { ?>
                        <option value="<?= $statu ?>" <?= $contact['status'] === $statu ? 'selected' : '' ?>>
                            <?= ucfirst($statu) ?>
                        </option>
                    <?php } ?>
                </select>
            </p>
        </blockquote>
        <input type="submit" name="update_status" value="Update">
    </form>
<?php } ?>