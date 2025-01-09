<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/styles.css" />
    <title>Message</title>
</head>

<body>
    <div class="message-box <?= htmlspecialchars($messageType); ?>">
        <p><?= $message; ?></p>
        <?php if ($redirectUrl): ?>
            <p>Redirecting in 3 seconds...</p>
            <script>
                setTimeout(function () {
                    window.location.href = '<?= htmlspecialchars($redirectUrl); ?>';
                }, 3000);
            </script>
        <?php endif; ?>
    </div>

    <style>
        .message-box.success {
            background-color: green;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .message-box.bad {
            background-color: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</body>

</html>