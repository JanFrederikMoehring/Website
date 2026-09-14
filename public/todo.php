<!DOCTYPE html>
<html lang='de'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>jan-frederik.com | To Do</title>

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

<?php
include'./../sharedtodo.php';
?>

    <form action='/todocreate.php' method='post'>

        <input
            type='text'
            name='Title'
            value=''
            placeholder='Title'
        >

        <input
            type='text'
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


</body>

</html>