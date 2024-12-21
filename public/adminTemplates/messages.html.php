<div class="message-box <?= htmlspecialchars($messageType); ?>">
    <p><?= $message; ?></p>
    <?php if ($redirectUrl): ?>
        <p><a href="<?= htmlspecialchars($redirectUrl); ?>" class="redirect-link">Click here to continue</a></p>
    <?php endif; ?>
</div>
<script>
    <?php if ($redirectUrl): ?>
        setTimeout(() => {
            window.location.href = "<?= htmlspecialchars($redirectUrl); ?>";
        }, 2000);
    <?php endif; ?>
</script>

<style>
    .message-box.success {
        background-color: green;
    }

    .message-box.bad {
        background-color: red;
    }
</style>