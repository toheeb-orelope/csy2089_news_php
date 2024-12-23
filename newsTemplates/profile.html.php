<form action="profile" method="POST">

    <input type="hidden" name="profile[id]" value="<?= $profile['id'] ?? '' ?>">

    <label for="">username</label>
    <input type="text" name="profile[username]" value="<?= $profile['username'] ?? '' ?>" required>

    <label for="">password</label>
    <input type="password" name="profile[password]" value="">

    <label for="">name</label>
    <input type="text" name="profile[name]" value="<?= $profile['name'] ?? '' ?>" required>

    <input type="hidden" name="profile[date_created]"
        value="<?= $profile['date_created'] ?? (new DateTime())->format('Y-m-d H:i:s') ?>">


    <input type="submit" name="submit" value="<?= isset($profile['id']) ? 'Update' : 'Sign Up' ?>" class="add_btn">
</form>