<?php

require_once __DIR__ . '/../init.php';

$email = $_POST['email'];
$pw = password_hash(($_POST['password']), PASSWORD_DEFAULT);

// Email Validierung
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo('$email is a valid email adress');
} else {
    header('Location: /?email=error');
    exit;
};

// Prepared Statements
$db->createUser($email, $pw);

header('Location: /');