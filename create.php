<?php
// header('Location: /index.php');

$email = $_POST['email'];
$pw = password_hash(($_POST['password']), PASSWORD_DEFAULT);

// Datenbank erstellen
$db = new PDO('sqlite:database.sqlite');

// Tabelle mit Spalten erstellen
$db->query('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    email VARCHAR,
    pw VARCHAR)');

// Werte in Tabelle einfügen
$db->exec("INSERT INTO users ( 
    email, 
    pw) VALUES (
    '$email',
    '$pw')");

$stmt = $db->query('SELECT email from users');
$emaillist = ($stmt->fetchAll(PDO::FETCH_COLUMN));
?>

    <ul>
        <?php foreach($emaillist as $customers): ?>
            <li><?php echo($customers) ?></li>
        <?php endforeach; ?>
    </ul>