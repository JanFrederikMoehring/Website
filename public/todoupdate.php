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

<a href="/">
        ⌂
    </a>

<a href="/todo.php">
        ↺
    </a>
<br><br>

<?php

require_once __DIR__ . '/../database.php';

// ID-Value aus der URL ziehen
$number = $_GET['id'];

// Zur ID gehörende Tabellenspalte mit Prepared Statement auswählen
$stmt = $db->prepare('SELECT * FROM todos WHERE id = :Number');
$stmt->execute([$number]);

// Ausgewählte Spalte liefern
$todo = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<form class="grid" method="post">
    <label for="title">Title</label>
    <input class="input" type="text" id="title" name="title" value="<?= $todo['title'] ?>">

    <label for="description">Description</label>
    <input class="input" type="text" id="description" name="description" value="<?= $todo['description'] ?>">

    <label for="checkbox">Status</label>
    <input class="checkbox" type="checkbox" <?= $todo['status'] == 1 ? 'checked' : '' ?> id="checkbox" name="checkbox" style="justify-self: start;">

    <input class="button" type="submit" value="send" id="submit"
           style="background-color:#C99E10; font-family:Roboto; border:1px; grid-column:2">
</form>

<?php

// Code nur bei Drücken des Buttons ausführen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Variablen die in die Tabelle eingeschrieben werden definieren
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = isset($_POST['checkbox']) ? 1 : 0;

    // Prepared Statements
    $stmt = $db->prepare("UPDATE todos
        SET title = :title,
            description = :description,
            status = :status
        WHERE id = $number");

    // Daten in Tabelle schreiben
    $stmt->bindValue('title', $title);
    $stmt->bindValue('description', $description);
    $stmt->bindValue('status', $status);
    $stmt->execute();

    // Redirect beim Drücken des Buttons
    header('Location: /todo.php');
}

?>

</body>

</html>