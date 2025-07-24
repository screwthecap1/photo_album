<?php
require __DIR__ . '/auth.php';
$login = getUserLogin();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photo album</title>
</head>
<body>
<?php if ($login === null): ?>
    <a href="login.php">Please, register/auth your account</a>
<?php else: ?>
    <p>Welcome to our service, <?= $login ?></p>
    <?php
    $files = scandir(__DIR__ . '/uploads');
    $links = [];
    foreach ($files as $fileName) {
        if ($fileName === '.' || $fileName === '..') {
            continue;
        }
        $links[] = '/uploads/' . $fileName;
    }
    foreach ($links as $link):?>
        <a href="<?= $link ?>"><img src="<?= $link ?>" alt="pick_me" height="300px"></a>
    <?php endforeach; ?>
    <br><br>
    <a href="logout.php">exit</a>
<?php endif; ?>
</body>
</html>