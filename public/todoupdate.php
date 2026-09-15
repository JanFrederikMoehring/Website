<?php
include './../sharedtodo.php';
include './../sharedhtml.php';

$Number = $_GET['ID'];

$stmt = $db->prepare('SELECT * FROM todos WHERE id = ?');
$stmt->execute([$Number]);

$todo = $stmt->fetch(PDO::FETCH_ASSOC);

    $checked = $todo['Status'];
    // $Number = $todo['id'];

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
        <input type="text" id="Title" name="Title" value="<?= $todo['Title'] ?>">

        <label for="Description">Description</label>
        <input type="text" id="Description" name="Description" placeholder="<?= $todo['Description'] ?>">

        <label for="Checkbox">Status</label>
        <input type="checkbox" <?= $checked ?> id="Checkbox" name="Checkbox" style="justify-self: start;">

        <input type="submit" value="Send" id="submit"
               style="background-color:#C99E10; font-family:Roboto; border:1px; grid-column: 2">
    </form>
</body>

</html>