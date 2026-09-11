<?php

header('Location: /');

$email = $_POST['email'];
$pw = password_hash(($_POST['password']), PASSWORD_DEFAULT);

// Datenbank erstellen
$db = new PDO('sqlite:/var/www/database/database.sqlite');

// Tabelle mit Spalten erstellen
$db->query('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email VARCHAR UNIQUE,
    pw VARCHAR
)');

// Email Validation
$emailerror = '?email=error';
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo('$email is a valid email adress');
} else {
    throw new Exception('$email is not a vald email adress');
    http_build_query($emailerror);
    header('Location: /?email=error');
};

// Prepared Statements
$stmt = $db->prepare('INSERT INTO users (
    email,
    pw
) VALUES (
    :email,
    :pw
)');

$stmt->bindValue('email', $email);
$stmt->bindValue('pw', $pw);
$stmt->execute();