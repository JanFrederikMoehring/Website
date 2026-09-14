<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new PDO('sqlite:/var/www/database/todo.sqlite');

// Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS todos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    Title TEXT,
    Description TEXT,
    Date TEXT,
    Status TEXT
)');

?>

    <a href="/" style="text-decoration: none; color: #C99E10; font-size: 25px;">
            ⌂
        </a>
<br><br>