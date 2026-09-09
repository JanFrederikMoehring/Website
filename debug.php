<?php
echo '<hr>';
echo '<h2>DEBUG TEST</h2>';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<h3>1. PHP</h3>';
echo 'PHP-Version: ' . PHP_VERSION . '<br>';
echo 'PDO vorhanden: ' . (class_exists('PDO') ? 'JA' : 'NEIN') . '<br>';
echo 'PDO SQLite vorhanden: ' . (extension_loaded('pdo_sqlite') ? 'JA' : 'NEIN') . '<br>';
echo 'SQLite vorhanden: ' . (extension_loaded('sqlite3') ? 'JA' : 'NEIN') . '<br>';

echo '<h3>2. Datenbankdatei</h3>';

$dbPath = '/var/www/database/database.sqlite';

echo 'Pfad: ' . $dbPath . '<br>';
echo 'Existiert: ' . (file_exists($dbPath) ? 'JA' : 'NEIN') . '<br>';
echo 'Lesbar: ' . (is_readable($dbPath) ? 'JA' : 'NEIN') . '<br>';
echo 'Schreibbar: ' . (is_writable($dbPath) ? 'JA' : 'NEIN') . '<br>';

echo '<h3>3. Datenbank öffnen</h3>';

try {

    $testDb = new PDO('sqlite:' . $dbPath);

    echo 'Datenbank öffnen: OK<br>';

    $testDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo 'PDO Fehler-Modus: OK<br>';

    echo '<h3>4. Tabelle</h3>';

    $testDb->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email TEXT NOT NULL,
            pw TEXT NOT NULL
        )
    ");

    echo 'Tabelle users: OK<br>';

    echo '<h3>5. SELECT-Test</h3>';

    $stmt = $testDb->query('SELECT COUNT(*) FROM users');
    $count = $stmt->fetchColumn();

    echo 'SELECT funktioniert: JA<br>';
    echo 'Anzahl Einträge: ' . $count . '<br>';

    echo '<h3>6. INSERT-Test</h3>';

    $testEmail = 'DEBUG_TEST_' . time() . '@example.com';

    $stmt = $testDb->prepare("
        INSERT INTO users (email, pw)
        VALUES (:email, :pw)
    ");

    $stmt->execute([
        ':email' => $testEmail,
        ':pw' => 'DEBUG_TEST'
    ]);

    echo 'INSERT funktioniert: JA<br>';
    echo 'Test-E-Mail: ' . htmlspecialchars($testEmail) . '<br>';

    echo '<h3>7. Kontrolle</h3>';

    $stmt = $testDb->query('SELECT email FROM users ORDER BY id DESC LIMIT 5');

    echo '<ul>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<li>' . htmlspecialchars($row['email']) . '</li>';
    }

    echo '</ul>';

    echo '<h2 style="color:green;">ALLE TESTS ERFOLGREICH</h2>';

} catch (Throwable $e) {

    echo '<h2 style="color:red;">FEHLER GEFUNDEN</h2>';

    echo '<pre style="background:#eee;color:red;padding:15px;">';
    echo htmlspecialchars($e->getMessage());
    echo "\n\n";
    echo htmlspecialchars($e->getFile());
    echo ':';
    echo $e->getLine();
    echo '</pre>';
}
