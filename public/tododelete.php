<?php

require_once __DIR__ . '/../init.php';

$uuid = ($_GET['uuid']);

$confirmation = (isset($_POST['confirmation']));

if ($confirmation) {
    $db->deleteToDo($uuid);
// Redirect
    header('Location: /todo.php');
}


$cancellation = (isset($_POST['cancellation']));

if ($cancellation) {
// Redirect
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

<?php

require_once __DIR__ . '/../layouts/footer.php';

?>