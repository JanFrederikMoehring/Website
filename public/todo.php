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

        <label for="Title">Title</label>
        <input
            type='text'
            name='Title'
            value=''
            placeholder='Title'
        >

        <label for="Description">Description</label>
        <input
            type='text'
            id="Description"
            name='Description'
            value=''
            placeholder='Your Description'
        >

        <label for="Checkbox">Checkbox</label>
        <input
            type='checkbox'
            id='Checkbox'
            name='Checkbox'
            value=''
            placeholder=''
        >

        <label for="Date">Date</label>
        <input
            type='date'
            id="Date"
            value=''
            placeholder=""
        >

    </form>


</body>

</html>