<!DOCTYPE html>
<head>
</head>
<body style='background-color: #1E434C;'>
    
<?php

include'./../sharedtodo.php';

// Variablen definieren
$Title = $_POST['Title'];

$Description = $_POST['Description'];

$Date = $_POST['Date'];

$Checkbox = '';
if(isset($_POST['Checkbox'])) {
    $Checkbox = 'erledigt';
} else {
    $Checkbox = 'offen';
};

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
$stmt->execute();

// $stmt = $db->query('SELECT * from todos');
// $emaillist = ($stmt->fetchAll());
// var_dump($emaillist);

header('Location: /todo.php');
?>

</body>
</html>