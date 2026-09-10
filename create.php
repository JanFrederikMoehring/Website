<?php

header('Location: /index.php');

$email = $_POST['email'];
$pw = password_hash(($_POST['password']), PASSWORD_DEFAULT);

// Datenbank erstellen
$db = new PDO('sqlite:/var/www/database/database.sqlite');

// Tabelle mit Spalten erstellen
$db->query('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email VARCHAR type UNIQUE,
    pw VARCHAR
)');

// Werte in Tabelle einfügen
$db->exec("INSERT INTO users (
    email,
    pw
) VALUES (
    '$email',
    '$pw'
)");