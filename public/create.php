<?php

header('Location: /index.php');

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

// Werte in Tabelle einfügen
// $db->exec("INSERT INTO users (
    // email,
    // pw
// ) VALUES (
    // '$email',
    // '$pw'
// )");