<?php

require_once __DIR__ . '/../init.php';

$todos = $db->getToDos();

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jan-frederik.com | To Do</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link href="/app.css" rel="stylesheet">
</head>

<body>

<a href="/">
        ⌂
    </a>
<br><br>

<style>
 
    </style>

    <form class="grid" action="/todocreate.php" method="post">
        <label for="title">Title</label>
        <input class="input" type="text" id="title" name="title" placeholder="Title">

        <label for="description">Description</label>
        <input class="input" type="text" id="description" name="description" placeholder="Your description">

        <label for="checkbox">Status</label>
        <input class="checkbox" type="checkbox" id="checkbox" name="checkbox" style="justify-self: start" value="true">

        <input type="submit" value="send" id="submit" class="button" style="grid-column: 2">
    </form>

    <br><br>

    <table class="grid">
        <tr>
            <th>ID</th>
            <th>UUID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
<?php foreach($db->getToDos() as $todo): ?>
    <tr>
        <td><?= $todo->id ?></td>
        <td><?= $todo->uuid ?></td>
        <td><?= $todo->title ?></td>
        <td><?= $todo->description ?? '-' ?></td>
        <td><?= $todo->date ?></td>

        <td>
            <input class="checkbox" type="checkbox" <?= $todo->status ? 'checked' : '' ?> disabled>
        </td>

        <td>
            <a href="/todoupdate.php?uuid=<?= $todo->uuid ?>">⌨</a>
        </td>

        <td>
            <a href="/tododelete.php?uuid=<?= $todo->uuid ?>">🗑</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
</body>
</html>