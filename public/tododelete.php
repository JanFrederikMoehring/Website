<?php

require_once __DIR__ . '/../init.php';

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jan-frederik.com | To Do Delete</title>

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
$uuid = ($_GET['uuid']);

$confirmation = (isset($_POST['confirmation']));

if ($confirmation == true) {
    $db->deleteToDo($uuid);
// Redirect
header('Location: /todo.php');
}


$cancellation = (isset($_POST['cancellation']));

if ($cancellation == true) {
// Redirect
header('Location: /todo.php');
}

?>

<form method="post">
    <button class="button" type="submit" name="confirmation" value="false">
        <input type="hidden" name="delete" value="<?= $uuid ?>">
        Löschen
        </button>
    </form>


<form method="post">
    <button class="button" type="submit" name="cancellation" value="false">
        <input type="hidden" name="delete" value="<?= $uuid ?>">
        Abbrechen
        </button>
    </form>

</body>

</html>