<h2>Please fill the form below to contact us</h2>
<form action="contact.php" method="POST">

    <input type="hidden" name="contact[id]" value="<?= $contact['id'] ?? '' ?>">

    <label for="name">Enter your name</label>
    <input type="text" name="contact[name]" value="<?= $contact['name'] ?? '' ?>" required>

    <label for="phon">Enter your phone</label>
    <input type="tel" name="contact[phone]" placeholder="07985845987" value="<?= $contact['phone'] ?? '' ?>" required>

    <label for="email"></label>
    <input type="email" name="contact[email]" value="<?= $contact['email'] ?? '' ?>" placeholder="example@mail.com">

    <label for="comment">Subject</label>
    <textarea name="contact[comment]" value="<?= $contact['comment'] ?? '' ?>" id="comment" rows="3"
        cols="40"></textarea>

    <input type="submit" name="submit" value="Send">
</form>
<!-- <p>Welcome to Northampton News. All the local news and events.</p>

<p>Email enquiries@northamptonnews.com</p>
<p>Telephone 01604 112 112</p> -->