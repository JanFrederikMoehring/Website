<?php
function insertData() {
// Prepared Statements
$stmt = $db->prepare('INSERT INTO todos (
    Title,
    Description,
    Date,
    Status
) VALUES (
    :Title,
    :Description,
    :Date,
    :Status
)');

$stmt->bindValue('Title', $Title);
$stmt->bindValue('Description', $Description);
$stmt->bindValue('Date', $Date);
$stmt->bindValue('Status', $Checkbox);
$stmt->execute();}

function test() {
    echo 'Test';
}


function inputForm() { ?>
        <form
        action="/todocreate.php"
        method="post"
        style="color: #C99E10; font-family: Roboto;"
    >

    <style>.editable {
    background: transparent;
    border: none;
    color: white;
    font-family: Roboto;
} </style>

        <label for="Title">Title</label>

        <input
            type="text"
            id="Title"
            name="Title"
            placeholder="Title"
            class="editable"
        >

        <br>

        <label for="Description">Description</label>

        <input
            type="text"
            id="Description"
            name="Description"
            placeholder="Your Description"
        >

        <br>

        <label for="Checkbox">Status</label>

        <input
            type="checkbox"
            id="Checkbox"
            name="Checkbox"
        >

        <br>

        <input
            type="submit"
            value="Send"
            id="submit"
            style="background-color:#C99e10; font-family:Roboto; Border:1px"
        >

    </form>

    <table style="color: white;">

        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php
}
?>