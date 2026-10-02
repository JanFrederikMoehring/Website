<?php

require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../layouts/header.php';

?>

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

<?php

require_once __DIR__ . '/../layouts/footer.php';

?>