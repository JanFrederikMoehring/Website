
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

            $emaillist = $db->getEmails();
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