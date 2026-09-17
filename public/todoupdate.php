<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jan-frederik.com | To Do</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link href="/app.css" rel="stylesheet">
</head>

<body>

<a href="/" style="text-decoration: none; color: #C99E10; font-size: 25px;">
        ⌂
    </a>

<a href="/todo.php" style="text-decoration: none; color: #C99E10; font-size: 25px;">
        ↺
    </a>
<br><br>

<?php

require_once __DIR__ . '/../database.php';

// ID-Value aus der URL ziehen
$Number = $_GET['ID'];

// Zur ID gehörende Tabellenspalte mit Prepared Statement auswählen
$stmt = $db->prepare('SELECT * FROM todos WHERE id = :Number');
$stmt->execute([$Number]);

// Ausgewählte Spalte liefern
$todo = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<form method="post" style="color:#C99E10; font-family:Roboto;">
    <label for="Title">Title</label>
    <input type="text" id="Title" name="Title" value="<?= $todo['Title'] ?>">

    <label for="Description">Description</label>
    <input type="text" id="Description" name="Description" value="<?= $todo['Description'] ?>">

    <label for="Checkbox">Status</label>
    <input type="checkbox" <?= $todo['Status'] == 1 ? 'checked' : '' ?> id="Checkbox" name="Checkbox" style="justify-self: start;">

    <input type="submit" value="Send" id="submit"
           style="background-color:#C99E10; font-family:Roboto; border:1px; grid-column:2">
</form>

<?php

// Code nur bei Drücken des Buttons ausführen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Variablen die in die Tabelle eingeschrieben werden definieren
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $Status = isset($_POST['Checkbox']) ? 1 : 0;

    // Prepared Statements
    $stmt = $db->prepare("UPDATE todos
        SET Title = :Title,
            Description = :Description,
            Status = :Status
        WHERE id = $Number");

    // Daten in Tabelle schreiben
    $stmt->bindValue('Title', $Title);
    $stmt->bindValue('Description', $Description);
    $stmt->bindValue('Status', $Status);
    $stmt->execute();

    // Redirect beim Drücken des Buttons
    header('Location: /todo.php');
}

?>

</body>

</html>