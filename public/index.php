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

    <h1>What's your favourite food?</h1>

    <h4>
        <form class="grid" method="post">
            <input class="input" type="text" name="Food" value="" placeholder="Pizza...">
            <input class="button" type="submit" value="send" id="idSubmit">
        </form>

        <p>
            <?php
            if (empty($_POST['Food'])) {
                echo 'Please fill in the gap now';
            } else {
                echo strrev($_POST['Food']) . ', really?';
            }
            ?>
        </p>

        <br>
        <hr>
        <br>

        <p>
            <form class="grid" action="/create.php" method="post">
                <input class="input" type="email" name="email" value="" placeholder="E-Mail (only Example)">
                <input class="input" type="password" id="pwd" name="password" value="" placeholder="Password">
                <input class="button" type="submit" value="send" id="idSubmit">
            </form>

            <?php
            // Email Error angeben
            if ($_SERVER['REQUEST_URI'] != '/') {
                echo 'You have to enter a correct email';
            };

            require_once __DIR__ . '/../database.php';

            $stmt = $db->query('SELECT email from users');
            $emaillist = ($stmt->fetchAll(PDO::FETCH_COLUMN));
            ?>
        </p>

        <br>

        <details>
            <summary>Click here to see the other example e-mails</summary>
            <ul>
                <?php foreach ($emaillist as $customers): ?>
                    <li><?php echo($customers) ?></li>
                <?php endforeach; ?>
            </ul>
        </details>

        <br>
        <hr>
        <br>

        <progress value="75" max="100" style="accent-color: #9198E5;"></progress>

        80% of my website completed. Now just do what is written below.

        <br>
    </h4>

    <h4 style="font-family: Limelight;">
        Visit my
        <a href="https://github.com/JanFrederikMoehring" target="_blank">GitHub</a>
        and my
        <a href="https://www.linkedin.com/in/jan-frederik-möhring" target="_blank">LinkedIn</a>

        <br>
        <br>

        <a href="/todo.php">Todo</a>
    </h4>

</body>

</html>