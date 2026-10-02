<?php

require_once __DIR__ . '/../init.php';

// ID-Value aus der URL ziehen
$uuid = $_GET['uuid'];

// Zur ID gehörende Tabellenspalte mit Prepared Statement auswählen
$todo = $db->getToDoByUuid($uuid);

// Code nur bei Drücken des Buttons ausführen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Variablen die in die Tabelle eingeschrieben werden definieren
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = isset($_POST['checkbox']) ? 1 : 0;

    // Leeren Title ausschließen
    if ($title === null || trim($title) === '') {
        header('Location: /todoupdate.php?uuid=' . $uuid . '&error=no-title');
        exit;

    }

    // Zu kurzen Title ausschließen
    if (strlen($title) < 3) {
        header('Location: /todoupdate.php?uuid=' . $uuid . '&error=short-title');
        exit;
    }

    $db->updateToDo($uuid, $title, $description, $status);

    // Redirect beim Drücken des Buttons
    header('Location: /todo.php');
}

require_once __DIR__ . '/../layouts/header.php';
?>

<a href="/">
        ⌂
    </a>

<a href="/todo.php">
        ↺
    </a>
<br><br>

<form class="grid" method="post">
    <label for="title">Title</label>
    <input class="input" type="text" id="title" name="title" value="<?= $todo['title'] ?>" minlength="3" required>

    <label for="description">Description</label>
    <input class="input" type="text" id="description" name="description" value="<?= $todo['description'] ?>">

    <label for="checkbox">Status</label>
    <input class="checkbox" type="checkbox" <?= $todo['status'] == 1 ? 'checked' : '' ?> id="checkbox" name="checkbox" style="justify-self: start;">

    <input class="button" type="submit" value="send" id="submit"
           style="background-color:#C99E10; font-family:Roboto; border:1px; grid-column:2">
</form>

<?php

require_once __DIR__ . '/../layouts/footer.php';

?>