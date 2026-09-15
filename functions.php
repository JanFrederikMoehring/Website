<?php

function inputForm() { ?>

<style>
    .form {
        display: grid;
        grid-template-columns: 100px 250px;
        gap: 10px;
        width: fit-content;
    }
    .form label {
        text-align: left;
    }
    </style>

    <form class="form" action="/todocreate.php" method="post" style="color:#C99E10; font-family:Roboto;">
        <label for="Title">Title</label>
        <input type="text" id="Title" name="Title" placeholder="Title">

        <label for="Description">Description</label>
        <input type="text" id="Description" name="Description" placeholder="Your Description">

        <label for="Checkbox">Status</label>
        <input type="checkbox" id="Checkbox" name="Checkbox">

        <input type="submit" value="Send" id="submit"
               style="background-color:#C99E10; font-family:Roboto; border:1px; grid-column: 2">
    </form>

    <table style="color:white;">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
<?php } ?>