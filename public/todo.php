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

<?php

include './../sharedtodo.php';
require_once './../functions.php';
?>

<style>
    .form {
        display: grid;
        grid-template-columns: 100px 250px;
        gap: 10px;
        width: fit-content;
    }
    .form label {
        text-align: left;
    }
    </style>

    <form class="form" action="/todocreate.php" method="post" style="color:#C99E10; font-family:Roboto;">
        <label for="Title">Title</label>
        <input type="text" id="Title" name="Title" placeholder="Title" minlength="3" required>

        <label for="Description">Description</label>
        <input type="text" id="Description" name="Description" placeholder="Your Description">

        <label for="Checkbox">Status</label>
        <input type="checkbox" id="Checkbox" name="Checkbox" style="justify-self: start;">

        <input type="submit" value="Send" id="submit"
               style="background-color:#C99E10; font-family:Roboto; border:1px; grid-column: 2">
    </form>

    <table style="color:white;">
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
    $checked = $todo['Status'];
    $Number = $todo['id'];
?>

    <tr>
        <td><?= $todo['id'] ?></td>
        <td contenteditable="true"><?= $todo['Title'] ?></td>
        <td contenteditable="true"><?= $todo['Description'] ?></td>
        <td><?= $todo['Date'] ?></td>

        <td>
            <input type="checkbox" <?= $checked ?> id="Checkbox" name="Checkbox" value="true">
        </td>

        <td>
            <a href="/todoupdate.php/?ID=<?= urlencode($Number) ?>"
               style="text-decoration: none; color: #C99E10;">⌨</a>
        </td>
    </tr>

<?php
}
?>

</table>
</body>
</html>