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

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jan-frederik.com</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link href="/app.css" rel="stylesheet">
</head>

<body>
        <form class="grid" method="post" action="/register.php">
            <label for="email">E-Mail</label>
            <input class="input" type="email" id="email" name="email" placeholder="Your E-Mail">

            <label for="password">Password</label>
            <input class="input" type="password" id="password" name="password" placeholder="Password">

            <button type="submit" id="submit" class="button" style="grid-column: 2">Login</button>
        </form>

</body>