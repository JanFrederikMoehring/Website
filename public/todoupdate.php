<?php
include './../sharedtodo.php';
include './../sharedhtml.php';
$Number = $_GET['ID'];
echo $Number;

$stmt = $db->query('SELECT * FROM todos WHERE ($Number)');

while ($todo = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $checked = $todo['Status'];
    $Number = $todo['id']

?>

        <tr>
            <td><?= $todo['id'] ?></td>

            <td contenteditable="true"><?= $todo['Title'] ?></td>

            <td contenteditable="true"><?= $todo['Description'] ?></td>

            <td><?= $todo['Date'] ?></td>

            <td>
                <input
                    type="checkbox" <?= $checked ?>
                    id="Checkbox"
                    name="Checkbox"
                    value="true"
                >
            </td>
            <td><a href="/todoupdate.php/?ID=<?= urlencode($Number)?>" style="text-decoration: none; color: #C99E10;">⌨</a></td>
        </tr>

<?php } ?>

</body>

</html>