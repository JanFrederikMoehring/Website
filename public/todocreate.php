<?php

require_once __DIR__ . '/../database.php';

// Nur POST-Requests akzeptieren
if (isPost() === false) {
    header('Location: /todo.php?error=no-post');
    exit;
}

// Variablen definieren
$title = getPostParam('title');
$description = getPostParam('description');
$checked = getPostParam('checkbox') !== null;

// Leeren Title ausschließen
if ($title === null) {
    header('Location: /todo.php?error=no-title');
    exit;
}

// Zu kurzen Title ausschließen
if (strlen($title) < 3) {
    header('Location: /todo.php?error=short-title');
    exit;
}

// Eingabedatum definieren
$timestamp = time();
$date = date('d.m.Y.', $timestamp);

// Prepared Statements
$stmt = $db->prepare('INSERT INTO todos (
    title,
    description,
    date,
    status
) VALUES (
    :title,
    :description,
    :date,
    :status
)');

// Werte in die Tabelle schreiben
$stmt->bindValue('title', $title);
$stmt->bindValue('description', $description);
$stmt->bindValue('date', $date);
$stmt->bindValue('status', $checked);
$stmt->execute();

// Redirect
header('Location: /todo.php');

?>

</body>

</html>