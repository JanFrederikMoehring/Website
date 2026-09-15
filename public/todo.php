<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jan-frederik.com | To Do</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body style="background-color: #1E434C;">

<?php

include './../sharedtodo.php';
require_once './../functions.php';

inputForm();

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