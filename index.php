<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>favourite.de</title>
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body style="background-color: #1E434C;">
<h1 style="color: #C99E10"> <p style="font-family: Limelight" p> What's your favourite food?
<body>
    
    <form method="post">
    
        <input type="text" name="Food" value="" placeholder="Pizza...">
        <input type="submit" value="Send" id="idSubmit"
        style="background-color:#C99e10; font-family:Roboto; Border:1px">
    </form>
    
<h3 style="color: #C99E10"> <p style="font-family: Roboto" p>

    <?php

    $time = time();

    if (empty($_POST['Food'])) {
        echo "Please fill in the gap";
    } else {
        file_put_contents(
        $time . '.txt' ,
        $_POST['Food'] ,
    ) ;
    }

    $dir = 'C:\Users\***\Desktop\phpFiles';
    $files = scandir($dir);
    foreach($files as $docs)
        echo $docs, "<br/>";
    ?>
    
</body>
</html>
