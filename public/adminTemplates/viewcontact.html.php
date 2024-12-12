<?php if (!empty($contacts)) { ?>
    <?php foreach ($contacts as $contact) { ?>
        <table>
            <tr>
                <td> <?= $contact['email'] ?></td>
                <td> <?= $contact['name'] ?></td>
                <td> <?= $contact['phone'] ?></td>
                <td> <?= $contact['comment'] ?></td>
                <td> <?= $contact['status'] ?></td>
                <td> <?= $contact['date_update'] ?? '' ?></td>
                <td> <?= $contact['updated_by_user'] ?? '' ?></td>

            </tr>
        </table>
    <?php }
} else {
    echo "<p>No pending contacts found.</p>";
} ?>