<?php

include'./../sharedtodo.php';

// Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS todos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titel TEXT,
    description TEXT,
    status VARCHAR,
)');

echo($_POST['Checkbox']);

header('Location: /todo.php');