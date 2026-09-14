<!DOCTYPE html>
<head>
</head>
<body style='background-color: #1E434C;'>
    
<?php

$Checkbox = [];
if(isset($_POST['Checkbox'])) {
    $Checkbox[] = 'offen';
} else {
    $Checkbox[] = 'erledigt';
}

include'./../sharedtodo.php';

// Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS todos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titel TEXT,
    description TEXT,
    date TEXT,
    status INTEGER
)');

// if(isset($_POST['Checkbox'])) {
//     echo 'Checkbox is checked';
// } else {
//     echo 'Checkbox isnt checked';
// };

var_dump($checkbox);

// header('Location: /todo.php');
?>

</body>
</html>