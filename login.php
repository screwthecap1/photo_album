<?php
require __DIR__ . '/auth.php';

if (getUserLogin() !== null) {
    header('Location: /index.php');
    exit;
}

if (!empty($_POST)) {

    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (checkAuth($login, $password)) {
        setcookie('login', $login, 0, '/');
        setcookie('password', $password, 0, '/');
        header('Location: /index.php');
    } else {
        $error = 'Auth error!';
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
    <title>Login Form</title>
</head>
<body>
<?php if (isset($error)): ?>
    <span style="color: red">
    <?= $error ?>
</span>
<?php endif; ?>
<form action="login.php" method="post">
    <label for="login">Username: </label><input type="text" name="login" id="login">
    <br>
    <label for="password">Password: </label><input type="text" name="password" id="password">
    <br>
    <input type="submit" value="Enter">
</form>
</body>
</html>
