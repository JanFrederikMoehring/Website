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

<a href="/" style="text-decoration: none; color: #C99E10; font-size: 25px;">
        ⌂
    </a>

<a href="/todo.php" style="text-decoration: none; color: #C99E10; font-size: 25px;">
        ↺
    </a>
<br><br>


<?php
require_once __DIR__ . '/../database.php';

$number = ($_POST['delete']);

$confirmation = (isset($_POST['confirmation']));

if ($confirmation == true) {
$stmt = $db->prepare('DELETE FROM todos WHERE id = :number');
$stmt->execute([$number]);

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
    <button type="submit" name="confirmation" value="false">
        <input type="hidden" name="delete" value="<?= $number ?>">
        Löschen
        </button>
    </form>


<form method="post">
    <button type="submit" name="cancellation" value="false">
        <input type="hidden" name="delete" value="<?= $number ?>">
        Abbrechen
        </button>
    </form>

</body>

</html>