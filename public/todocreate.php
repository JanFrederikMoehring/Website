<?php

require_once __DIR__ . '/../database.php';

if (isPost() === false) {
    header('Location: /todo.php?error=no-post');
    exit;
}

// Variablen definieren
$Title = getPostParam('Title');
$Description = getPostParam('Description');
$Checked = getPostParam('Checkbox') !== null;

if ($Title === null) {
    header('Location: /todo.php?error=no-title');
    exit;
}

if (strlen($Title) < 3) {
    header('Location: /todo.php?error=short-title');
    exit;
}

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

$stmt->bindValue('Title', $Title);
$stmt->bindValue('Description', $Description);
$stmt->bindValue('Date', $Date);
$stmt->bindValue('Status', $Checked);
$stmt->execute();

header('Location: /todo.php');

?>

</body>

</html>