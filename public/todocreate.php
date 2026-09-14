<!DOCTYPE html>
<head>
</head>
<body style='background-color: #1E434C;'>
    
<?php

include'./../sharedtodo.php';

// Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS todos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titel TEXT,
    description TEXT,
    status VARCHAR,
)');

echo 'PHP funktioniert<br>';

if(isset($_POST['Checkbox'])) {
    echo 'Checkbox is checked';
} else {
    echo 'Checkbox isnt checked';
};

// echo($_POST['Checkbox']);

// header('Location: /todo.php');
?>

</body>
</html>