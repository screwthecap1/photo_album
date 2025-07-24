<?php
require __DIR__ . '/auth.php';

$login = getUserLogin();

if ($login !== null && !empty($_FILES['base'])) {
    $file = $_FILES['base'];

    $srcFileName = $file['name'];
    $newFilePath = __DIR__ . '/uploads/' . $srcFileName;

    $allowedExt = ['jpg', 'png'];
    $extension = strtolower(pathinfo($srcFileName, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExt)) {
        $error = 'Download files with this extension is disable!';
    } elseif ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'Error while downloading file';
    } elseif ($file['size'] > 8 * 1024 * 1024) {
        $error = 'File is more than 8 MB';
    } else {
        $imageInfo = getimagesize($file['tmp_name']);
        if (!$imageInfo) {
            $error = 'There is no photo';
        } elseif ($imageInfo[0] > 1280 || $imageInfo[1] > 720) {
            $error = 'Wrong format of picture (more than 1280x720)';
        } elseif (file_exists($newFilePath)) {
            $error = 'File with this name is already exist';
        } elseif (!move_uploaded_file($file['tmp_name'], $newFilePath)) {
            $error = 'Error while downloading file';
        } else {
            $result = '/uploads/' . $srcFileName;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Downloading</title>
</head>
<body>
<?php if ($login === null): ?>
    <a href="login.php">Please, make auth!</a>
<?php else: ?>
    <h1>Welcome, <?= $login ?></h1>
    <a href="logout.php">Exit</a>
    <br>
    <?php if (!empty($error)): ?>
        <?= $error ?>
    <?php elseif (!empty($result)): ?>
        <?= $result ?>
    <?php endif; ?>
    <br>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="base">
        <input type="submit">
    </form>
<?php endif; ?>
</body>
</html>