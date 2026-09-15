<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>jan-frederik.com | To Do</title>

    <link
        rel="icon"
        type="image/vnd.microsoft.icon"
        href="favicon.ico"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Limelight&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
    >
</head>

<body style="background-color: #1E434C;">

<?php

include './../sharedtodo.php';

?>

    <form
        action="/todocreate.php"
        method="post"
        style="color: #C99E10; font-family: Roboto;"
    >

        <label for="Title">Title</label>

        <input
            type="text"
            id="Title"
            name="Title"
            placeholder="Title"
        >

        <br>

        <label for="Description">Description</label>

        <input
            type="text"
            id="Description"
            name="Description"
            placeholder="Your Description"
        >

        <br>

        <label for="Checkbox">Status</label>

        <input
            type="checkbox"
            id="Checkbox"
            name="Checkbox"
        >

        <br>

        <input
            type="submit"
            value="Send"
            id="submit"
            style="background-color:#C99e10; font-family:Roboto; Border:1px"
        >

    </form>

    <table style="color: white;">

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

?>

        <tr>
            <td><?= $todo['id'] ?></td>

            <td><?= $todo['Title'] ?></td>

            <td><?= $todo['Description'] ?></td>

            <td><?= $todo['Date'] ?></td>

            <td>
                <input
                    type="checkbox" <?= $checked ?>
                    id="Checkbox"
                    name="Checkbox"
                    value="true"
                >
            </td>
        </tr>

<?php

}

test();

?>

    </table>

</body>

</html>