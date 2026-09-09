<!DOCTYPE html>
<html lang='de'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>jan-frederik.com</title>

    <link rel='icon' type='image/vnd.microsoft.icon' href='favicon.ico'>

    <link
        href='https://fonts.googleapis.com/css2?family=Limelight&display=swap'
        rel='stylesheet'
    >
    <link
        href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap'
        rel='stylesheet'
    >
</head>

<body style='background-color: #1E434C;'>

    <h1 style='color: #C99E10; font-family: Limelight;'>
        What's your favourite food?
    </h1>

    <form method='post'>

        <input
            type='text'
            name='Food'
            value=''
            placeholder='Pizza...'
        >

        <input
            type='submit'
            value='Send'
            id='idSubmit'
            style='background-color:#C99e10; font-family:Roboto; Border:1px'
        >

    </form>

    <h3 style='color: #C99E10; font-family: Roboto;'>

        <?php

        if (empty($_POST['Food'])) {
            echo 'Please fill in the gap now';
        } else {
            echo strrev($_POST['Food']) . ', really?';
        }

        ?>
    
        <br>
        <br>
        _________________________________________________

         </h3>
          <br>

        <form action='create.php' method='post'>

            <input
                type='text'
                name='email'
                value=''
                placeholder='E-Mail (only Example)'
            >

            <input
                type='password'
                id='pwd'
                name='password'
                value=''
                placeholder='Password'
            >

            <input
                type='submit'
                value='Send'
                id='idSubmit'
                style='background-color:#C99e10; font-family:Roboto; Border:1px'
            >
            </form>

            <?php

            // Datenbank erstellen
            $db = new PDO('sqlite:/var/www/database/database.sqlite');

            $stmt = $db->query('SELECT email from users');
            $emaillist = ($stmt->fetchAll(PDO::FETCH_COLUMN));

            ?>
            
        <h5>
        <details style='color: #C99E10; font-family: Roboto;'>
        <summary>Click here to see the other example e-mails</summary>
            <ul>
                <?php foreach($emaillist as $customers): ?>
                    <li><?php echo($customers) ?></li>
                <?php endforeach; ?>
            </ul>
        
        </details>
                </h5>

        <h3 style='color: #C99E10; font-family: Roboto;'>
        _________________________________________________

                </h3>
        <br>

    
            <progress
                value='75'
                max='100'
                style='accent-color: #C99E10;'
            ></progress>
            <h4 style='display: inline; color: #C99E10; font-family: Roboto;'>
            80% of my website completed. Now just do what is written below.
                </h4>

    <br>

    <style>
        a:visited, a:visited, a:hover, a:active, a:link {
            color: white;
            background-color: transparent;
            text-decoration: underline;
        }
    </style>

    <h4 style='color: white; font-family: Limelight;'>

        Visit my
        <a href='https://github.com/JanFrederikMoehring' target='_blank'>
            GitHub
        </a>
        and my
        <a href='https://www.linkedin.com/in/jan-frederik-möhring' target='_blank'>
            LinkedIn
        </a>

    </h4>

</body>

</html>