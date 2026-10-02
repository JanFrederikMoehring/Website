<?php

require_once __DIR__ . '/../init.php';

if (array_key_exists('user_id', $_SESSION)) {
    header('Location: /index.php');
    exit;
}

if (isPost()) {
    $email = getPostParam('email');
    $password = getPostParam('password');

    if ($email === null || $password === null) {
        header('Location: register.php?error=empty');
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $userID = $db->createUser($email, $hashedPassword);

    if ($userID === false) {
        header('Location: register.php?error=user-already-exists');
        exit;
    }

    $_SESSION['user_id'] = $userID;

    header('Location: /index.php');
    exit;
}

require_once __DIR__ . '/../layouts/header.php';

?>
        <form class="grid" method="post" action="/register.php">
            <label for="email">E-Mail</label>
            <input class="input" type="email" id="email" name="email" placeholder="Your E-Mail">

            <label for="password">Password</label>
            <input class="input" type="password" id="password" name="password" placeholder="Password">

            <button type="submit" id="submit" class="button" style="grid-column: 2">Login</button>
        </form>

<?php

require_once __DIR__ . '/../layouts/footer.php';

?>