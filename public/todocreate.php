<?php

require_once __DIR__ . '/../database.php';

// Nur POST-Requests akzeptieren
if (isPost() === false) {
    header('Location: /todo.php?error=no-post');
    exit;
}

// Variablen definieren
$Title = getPostParam('Title');
$Description = getPostParam('Description');
$Checked = getPostParam('Checkbox') !== null;

// Leeren Title ausschließen
if ($Title === null) {
    header('Location: /todo.php?error=no-title');
    exit;
}

// Zu kurzen Title ausschließen
if (strlen($Title) < 3) {
    header('Location: /todo.php?error=short-title');
    exit;
}

// Eingabedatum definieren
$timestamp = time();
$Date = date('d.m.Y.', $timestamp);

// Prepared Statements
$stmt = $db->prepare('INSERT INTO todos (
    Title,
    Description,
    Date,
    Status
) VALUES (
    :Title,
    :Description,
    :Date,
    :Status
)');

// Werte in die Tabelle schreiben
$stmt->bindValue('Title', $Title);
$stmt->bindValue('Description', $Description);
$stmt->bindValue('Date', $Date);
$stmt->bindValue('Status', $Checked);
$stmt->execute();

// Redirect
header('Location: /todo.php');

?>

</body>

</html>