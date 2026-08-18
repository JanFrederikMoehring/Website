<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>
</head>
Formular Webseite
<body>
    
    <form action="#" method="get">
    
        <input type="text" name="Age" value="" placeholder="Alter">
        <input type="submit" value="An JF senden" id="idSubmit">
    </form>
    
    <?php

    if (empty($_GET['Age'])) {
        echo "Bitte schreib was";
    } else {
        file_put_contents(
        'Eingabe.txt' ,
        $_GET['Age'] ,
    ) ;
    }
    ?>
</body>
</html>
