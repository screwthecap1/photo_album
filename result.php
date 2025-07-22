<?php
$res = require __DIR__ . '/calc.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>
</head>
<body>
<b>Final Result: </b>
<br>
<?= htmlspecialchars($res, ENT_QUOTES, 'UTF-8')?>
<br><br>
<a href="index.php">Back</a>
</body>
</html>
