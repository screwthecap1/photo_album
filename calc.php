<?php
if (empty($_POST)) {
    return 'Nothing to work!';
}

if (empty($_POST['op'])) {
    return 'Operator is not passed';
}

if (!isset($_POST['x1']) || !isset($_POST['x2'])) {
    return 'Arguments are not passed';
}

$x1 = filter_input(INPUT_POST, 'x1', FILTER_VALIDATE_FLOAT);
$x2 = filter_input(INPUT_POST, 'x2', FILTER_VALIDATE_FLOAT);

if ($x1 === false || $x2 === false) {
    return 'Arguments must be valid numbers!';
}

if ($_POST['op'] === '/' && $x2 == 0) {
    return "Can't divide by 0";
}

$exp = $x1 . ' ' . $_POST['op'] . ' '. $x2 . ' = ';
switch ($_POST['op']) {
    case '+': $res = $x1 + $x2; break;
    case '-': $res = $x1 - $x2; break;
    case '*': $res = $x1 * $x2; break;
    case '/': $res = $x1 / $x2; break;
    default: return 'Operation is not supported';
}

return $exp . $res;