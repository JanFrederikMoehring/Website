<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jan-frederik.com</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body style="background-color: #1E434C;">

<h1 style="color: #C99E10; font-family: Limelight;">
    What's your favourite food?
</h1>

<form method="post">

    <input type="text" name="Food" value="" placeholder="Pizza...">

    <input type="submit" value="Send" id="idSubmit"
        style="background-color:#C99e10; font-family:Roboto; Border:1px">

</form>

<h3 style="color: #C99E10; font-family: Roboto;">

<?php

$time = time();

if (empty($_POST['Food'])) {
    echo "Please fill in the gap now";
} else {
    #file_put_contents(
    #$time . '.txt' ,
    #$_POST['Food'] ,
    #) ;
    echo strrev($_POST['Food']) . ', really?';
}

?>

<br>
<br>
_________________________________________________
<br>
<br>

</h3>

<details style="color: #C99E10; font-family: Roboto;">
    <summary>Click here after entering your favourite food</summary>

    <h5>
        <progress value="75" max="100"
            style="accent-color: #C99E10;"></progress>
        80% of my website completed. Now just do what is written below.
    </h5>
</details>

<br>

<style>
    a:visited, a:visited, a:hover, a:active, a:link {
        color: white;
        background-color: transparent;
        text-decoration: underline;
    }
</style>

<h4 style="color: white; font-family: Limelight;">

    Visit my
    <a href="https://github.com/JanFrederikMoehring" target="_blank">GitHub</a>
    and my
    <a href="https://www.linkedin.com/in/jan-frederikM%C3%B6hring/" target="_blank">LinkedIn</a>

</h4>

</body>
</html>