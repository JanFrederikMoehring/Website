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
<br><br>

<?php

require_once __DIR__ . '/../database.php';

?>

<style>
 
    </style>

    <form action="/todocreate.php" method="post" style="color:#C99E10; font-family:Roboto;">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title">

        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Your Description">

        <label for="checkbox">Status</label>
        <input type="checkbox" id="checkbox" name="checkbox" style="justify-self: start" value="true">

        <input type="submit" value="Send" id="submit"
               style="background-color:#C99E10; font-family:Roboto; border:1px; grid-column: 2">
    </form>

    <table style="color: #C99E10;">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
<?php

$stmt = $db->query('SELECT * FROM todos');



while ($todo = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Variable für Übergabeparameter definieren
    $number = $todo['id'];
?>

    <tr>
        <td><?= $todo['id'] ?></td>
        <td><?= $todo['title'] ?></td>
        <td><?= $todo['description'] ?></td>
        <td><?= $todo['date'] ?></td>

        <td>
            <input type="checkbox" <?= $todo['status'] == 1 ? 'checked' : '' ?> disabled>
        </td>

        <td>
            <a href="/todoupdate.php?id=<?=urlencode($number) ?>"
               style="text-decoration: none; color: #C99E10;">⌨</a>
        </td>

         <td>
            <a href="/tododelete.php?id=<?=urlencode($number) ?>"
               style="text-decoration: none; color: #C99E10;">🗑</a>
        </td>
    </tr>

<?php
}
?>
</table>
</body>
</html>
