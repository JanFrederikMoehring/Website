<?php

use Website\Database;

require_once __DIR__ . '/../init.php';

/** @var Database $db */

if (array_key_exists('user_id', $_SESSION)) {
    header('Location: /index.php');
    exit;
}

if (isPost() === true) {
    $email = getPostParam('email');
    $pw = getPostParam('password');

    if ($email === null || $pw === null) {
        header('Location: login.php?error=empty');
        exit;
    }

    $user = $db->getUser($email);

    if ($user === null) {
        header('Location: login.php?error=no-user');
        exit;
    }

    if (password_verify($pw, $user->password) === false) {
        header('Location: login.php?error=wrong-password');
        exit;
    }

    $_SESSION['user_id'] = $user->id;

    header('Location: /index.php');
    exit;
}

require_once __DIR__ . '/../layouts/header.php';

?>

<form class="grid" method="post" action="/login.php">
    <label for="email">E-Mail</label>
    <input class="input" type="email" id="email" name="email" placeholder="Your E-Mail">

    <label for="password">Password</label>
    <input class="input" type="password" id="password" name="password" placeholder="Password">

    <button type="submit" id="submit" class="button" style="grid-column: 2">Login</button>
</form>

<a href="register.php">Sign up</a>

<?php

require_once __DIR__ . '/../layouts/footer.php';

?>