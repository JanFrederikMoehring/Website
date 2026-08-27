<?php

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>favourite.de</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="styl>
</head>
<body style="background-color: #1E434C;">
<h1 style="color: #C99E10"> <p style="font-family: Limelight" p> What's your favourite food?
<body>

    <form method="post">

        <input type="text" name='Food' value="" placeholder="Pizza...">
        <input type="submit" value="Send" id="idSubmit"
        style="background-color:#C99e10; font-family:Roboto; Border:1px">
    </form>

<h3 style="color: #C99E10"> <p style="font-family: Roboto" p>

    <?php

    $time = time();

    if (empty($_POST['Food'])) {
        echo "Please fill in the gap";
    } else {
        #file_put_contents(
        #$time . '.txt' ,
        #$_POST['Food'] ,
    #) ;
        echo strrev($_POST['Food']) . ', really?';
    } ;
    ?>
    <br>
    _________________________________________________
    <br>
    <style>
    a:visited, a:visited, a:hover, a:active, a:link {
  color: white;
  background-color: transparent;
  text-decoration: underline;
}
</style>
    <h4 style="color: white"> <p style="font-family: Limelight" p>
    Visit my
    <a href="https://github.com/JanFrederikMoehring" ­target="_blank"­>GitHub</a>
    and my
    <a href="https://www.linkedin.com/in/jan-frederik-m%C3%B6hring/" ­target="_blank"­>LinkedIn</a>
