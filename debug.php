<?php

// ============================================================
// DEBUG TOOL
// ============================================================

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

echo '<!DOCTYPE html>';
echo '<html lang="de">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Website Debug</title>';

echo '<style>
    body {
        background: #1E434C;
        color: white;
        font-family: Arial, sans-serif;
        padding: 20px;
        line-height: 1.5;
    }

    h1, h2 {
        color: #C99E10;
    }

    .box {
        background: #16353c;
        border: 1px solid #42666e;
        padding: 15px;
        margin: 15px 0;
        border-radius: 8px;
    }

    .ok {
        color: #50fa7b;
        font-weight: bold;
    }

    .error {
        color: #ff5555;
        font-weight: bold;
    }

    .warning {
        color: #f1fa8c;
        font-weight: bold;
    }

    pre {
        background: #111;
        padding: 12px;
        overflow-x: auto;
        border-radius: 5px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #42666e;
        padding: 8px;
        text-align: left;
    }

    th {
        color: #C99E10;
    }
</style>';

echo '</head>';
echo '<body>';

echo '<h1>🔧 Website Debug</h1>';


// ============================================================
// HILFSFUNKTIONEN
// ============================================================

function ok($text)
{
    echo '<p class="ok">✅ ' . htmlspecialchars($text) . '</p>';
}

function errorMsg($text)
{
    echo '<p class="error">❌ ' . htmlspecialchars($text) . '</p>';
}

function warningMsg($text)
{
    echo '<p class="warning">⚠️ ' . htmlspecialchars($text) . '</p>';
}

function info($label, $value)
{
    echo '<p><strong>' . htmlspecialchars($label) . ':</strong> ' .
         htmlspecialchars((string)$value) .
         '</p>';
}


// ============================================================
// 1. PHP TEST
// ============================================================

echo '<div class="box">';
echo '<h2>1. PHP</h2>';

ok('PHP wird ausgeführt.');

info('PHP Version', PHP_VERSION);
info('Betriebssystem', PHP_OS);
info('SAPI', PHP_SAPI);

echo '</div>';


// ============================================================
// 2. SERVER / PFAD TEST
// ============================================================

echo '<div class="box">';
echo '<h2>2. Server & Pfade</h2>';

info('Document Root', $_SERVER['DOCUMENT_ROOT'] ?? 'nicht vorhanden');
info('Script-Datei', __FILE__);
info('Script-Verzeichnis', __DIR__);

info('Aktuelles Arbeitsverzeichnis', getcwd());

if (is_dir('/var/www')) {
    ok('/var/www existiert.');
} else {
    errorMsg('/var/www existiert NICHT.');
}

if (is_dir('/var/www/database')) {
    ok('/var/www/database existiert.');
} else {
    errorMsg('/var/www/database existiert NICHT.');
}

echo '</div>';


// ============================================================
// 3. SQLITE PHP EXTENSION
// ============================================================

echo '<div class="box">';
echo '<h2>3. SQLite-Unterstützung</h2>';

if (class_exists('PDO')) {
    ok('PDO ist installiert.');
} else {
    errorMsg('PDO ist NICHT installiert.');
}

if (class_exists('PDO') && in_array('sqlite', PDO::getAvailableDrivers())) {
    ok('PDO SQLite ist installiert.');
} else {
    errorMsg('PDO SQLite ist NICHT installiert.');
}

info(
    'Verfügbare PDO-Treiber',
    implode(', ', PDO::getAvailableDrivers())
);

echo '</div>';


// ============================================================
// 4. EXAKTE DATENBANKDATEI
// ============================================================

$dbPath = '/var/www/database/database.sqlite';

echo '<div class="box">';
echo '<h2>4. Exakte SQLite-Datei</h2>';

info('Gesuchter Pfad', $dbPath);

if (file_exists($dbPath)) {
    ok('Die Datenbankdatei EXISTIERT.');

    info('Real Path', realpath($dbPath));
    info('Dateigröße', filesize($dbPath) . ' Bytes');

    if (is_readable($dbPath)) {
        ok('Datei ist lesbar.');
    } else {
        errorMsg('Datei ist NICHT lesbar.');
    }

    if (is_writable($dbPath)) {
        ok('Datei ist beschreibbar.');
    } else {
        warningMsg('Datei ist NICHT beschreibbar.');
    }

    info('Änderungszeit', date('Y-m-d H:i:s', filemtime($dbPath)));

} else {
    errorMsg('Die Datenbankdatei EXISTIERT NICHT.');

    warningMsg(
        'Wenn du dachtest, die Datenbank sei gelöscht, stimmt das für diesen Pfad.'
    );
}

echo '</div>';


// ============================================================
// 5. DATENBANKVERZEICHNIS
// ============================================================

echo '<div class="box">';
echo '<h2>5. Inhalt von /var/www/database</h2>';

if (is_dir('/var/www/database')) {

    $files = scandir('/var/www/database');

    echo '<pre>';

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $fullPath = '/var/www/database/' . $file;

        echo $file;

        if (is_file($fullPath)) {
            echo ' | Datei | ' . filesize($fullPath) . ' Bytes';
        } elseif (is_dir($fullPath)) {
            echo ' | Verzeichnis';
        }

        echo "\n";
    }

    echo '</pre>';

} else {
    errorMsg('Das Verzeichnis existiert nicht.');
}

echo '</div>';


// ============================================================
// 6. ANDERE SQLITE-DATEIEN SUCHEN
// ============================================================

echo '<div class="box">';
echo '<h2>6. Andere SQLite-Dateien suchen</h2>';

$searchDirectories = [
    '/var/www',
    '/var/www/html',
    __DIR__,
    dirname(__DIR__)
];

$foundDatabases = [];

foreach ($searchDirectories as $directory) {

    if (!is_dir($directory)) {
        continue;
    }

    try {

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $directory,
                FilesystemIterator::SKIP_DOTS
            )
        );

        foreach ($iterator as $file) {

            if (!$file->isFile()) {
                continue;
            }

            $filename = strtolower($file->getFilename());

            if (
                str_ends_with($filename, '.sqlite') ||
                str_ends_with($filename, '.db')
            ) {
                $foundDatabases[] = $file->getPathname();
            }
        }

    } catch (Throwable $e) {
        warningMsg(
            'Konnte ' . $directory . ' nicht vollständig durchsuchen: ' .
            $e->getMessage()
        );
    }
}

$foundDatabases = array_unique($foundDatabases);

if (count($foundDatabases) === 0) {

    warningMsg('Keine .sqlite oder .db Dateien gefunden.');

} else {

    ok('Gefundene Datenbankdateien: ' . count($foundDatabases));

    echo '<pre>';

    foreach ($foundDatabases as $file) {

        echo htmlspecialchars($file);

        if (file_exists($file)) {
            echo ' | ' . filesize($file) . ' Bytes';
        }

        echo "\n";
    }

    echo '</pre>';
}

echo '</div>';


// ============================================================
// 7. SQLITE ÖFFNEN
// ============================================================

echo '<div class="box">';
echo '<h2>7. SQLite-Datenbank öffnen</h2>';

$db = null;

try {

    $db = new PDO('sqlite:' . $dbPath);

    $db->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    ok('SQLite-Datenbank konnte geöffnet werden.');

} catch (Throwable $e) {

    errorMsg('SQLite konnte NICHT geöffnet werden.');

    echo '<pre>';
    echo htmlspecialchars($e->getMessage());
    echo '</pre>';
}

echo '</div>';


// ============================================================
// 8. SQLITE DATENBANK-INFOS
// ============================================================

if ($db) {

    echo '<div class="box">';
    echo '<h2>8. SQLite-Datenbank Informationen</h2>';

    try {

        $version = $db->query('SELECT sqlite_version()')->fetchColumn();

        info('SQLite-Version', $version);

        $tables = $db->query(
            "SELECT name FROM sqlite_master
             WHERE type='table'
             ORDER BY name"
        )->fetchAll(PDO::FETCH_COLUMN);

        if (count($tables) > 0) {

            ok('Tabellen gefunden: ' . count($tables));

            echo '<pre>';
            print_r($tables);
            echo '</pre>';

        } else {

            warningMsg('Die Datenbank enthält KEINE Tabellen.');
        }

    } catch (Throwable $e) {

        errorMsg('Fehler beim Auslesen der Datenbank.');

        echo '<pre>';
        echo htmlspecialchars($e->getMessage());
        echo '</pre>';
    }

    echo '</div>';
}


// ============================================================
// 9. USERS-TABELLE
// ============================================================

if ($db) {

    echo '<div class="box">';
    echo '<h2>9. Tabelle "users"</h2>';

    try {

        $exists = $db->query(
            "SELECT name
             FROM sqlite_master
             WHERE type='table'
             AND name='users'"
        )->fetchColumn();

        if ($exists) {

            ok('Die Tabelle "users" EXISTIERT.');

            $columns = $db->query(
                "PRAGMA table_info(users)"
            )->fetchAll(PDO::FETCH_ASSOC);

            echo '<h3>Spalten:</h3>';

            echo '<table>';
            echo '<tr>';

            foreach (array_keys($columns[0] ?? []) as $key) {
                echo '<th>' . htmlspecialchars($key) . '</th>';
            }

            echo '</tr>';

            foreach ($columns as $column) {

                echo '<tr>';

                foreach ($column as $value) {
                    echo '<td>' . htmlspecialchars((string)$value) . '</td>';
                }

                echo '</tr>';
            }

            echo '</table>';

        } else {

            warningMsg('Die Tabelle "users" existiert NICHT.');
        }

    } catch (Throwable $e) {

        errorMsg('Fehler beim Prüfen der users-Tabelle.');

        echo '<pre>';
        echo htmlspecialchars($e->getMessage());
        echo '</pre>';
    }

    echo '</div>';
}


// ============================================================
// 10. USERS-DATEN
// ============================================================

if ($db) {

    echo '<div class="box">';
    echo '<h2>10. Inhalt der users-Tabelle</h2>';

    try {

        $stmt = $db->query(
            'SELECT id, email, pw FROM users ORDER BY id'
        );

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        info('Anzahl Benutzer', count($users));

        if (count($users) === 0) {

            ok('Die users-Tabelle ist LEER.');

        } else {

            warningMsg(
                'Die users-Tabelle enthält ' .
                count($users) .
                ' Einträge.'
            );

            echo '<table>';

            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>E-Mail</th>';
            echo '<th>Passwort-Hash</th>';
            echo '</tr>';

            foreach ($users as $user) {

                echo '<tr>';

                echo '<td>' .
                    htmlspecialchars($user['id']) .
                    '</td>';

                echo '<td>' .
                    htmlspecialchars($user['email']) .
                    '</td>';

                echo '<td>' .
                    htmlspecialchars($user['pw']) .
                    '</td>';

                echo '</tr>';
            }

            echo '</table>';
        }

    } catch (Throwable $e) {

        errorMsg('SELECT auf users fehlgeschlagen.');

        echo '<pre>';
        echo htmlspecialchars($e->getMessage());
        echo '</pre>';
    }

    echo '</div>';
}


// ============================================================
// 11. TEST: NEUEN DATENSATZ SCHREIBEN
// ============================================================

echo '<div class="box">';
echo '<h2>11. Schreibtest</h2>';

if ($db) {

    try {

        $testFile = '/var/www/database/debug_write_test.txt';

        $result = file_put_contents(
            $testFile,
            'Debug test: ' . date('Y-m-d H:i:s')
        );

        if ($result !== false) {

            ok('PHP kann in /var/www/database schreiben.');

            unlink($testFile);

            ok('Testdatei wurde anschließend wieder gelöscht.');

        } else {

            errorMsg(
                'PHP kann NICHT in /var/www/database schreiben.'
            );
        }

    } catch (Throwable $e) {

        errorMsg('Schreibtest fehlgeschlagen.');

        echo '<pre>';
        echo htmlspecialchars($e->getMessage());
        echo '</pre>';
    }

} else {

    warningMsg('Schreibtest übersprungen, da SQLite nicht geöffnet werden konnte.');
}

echo '</div>';


// ============================================================
// 12. POST TEST
// ============================================================

echo '<div class="box">';
echo '<h2>12. POST-Test</h2>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    ok('Diese Seite wurde per POST aufgerufen.');

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

} else {

    info('Request Method', $_SERVER['REQUEST_METHOD']);
    warningMsg('Diese Seite wurde nicht per POST aufgerufen.');

}

echo '</div>';


// ============================================================
// 13. TESTFORMULAR
// ============================================================

echo '<div class="box">';
echo '<h2>13. POST-Testformular</h2>';

echo '
<form method="post">

    <input
        type="text"
        name="debug_email"
        placeholder="test@example.com"
        style="padding:8px;"
    >

    <input
        type="text"
        name="debug_food"
        placeholder="Pizza"
        style="padding:8px;"
    >

    <button
        type="submit"
        style="padding:8px;"
    >
        POST testen
    </button>

</form>
';

echo '</div>';


// ============================================================
// 14. SERVER-INFORMATIONEN
// ============================================================

echo '<div class="box">';
echo '<h2>14. Server-Informationen</h2>';

$serverInfo = [
    'HTTP_HOST',
    'SERVER_NAME',
    'SERVER_SOFTWARE',
    'DOCUMENT_ROOT',
    'SCRIPT_FILENAME',
    'REQUEST_URI',
    'REQUEST_METHOD',
    'REMOTE_ADDR'
];

echo '<table>';

echo '<tr>';
echo '<th>Variable</th>';
echo '<th>Wert</th>';
echo '</tr>';

foreach ($serverInfo as $key) {

    echo '<tr>';

    echo '<td>' . htmlspecialchars($key) . '</td>';

    echo '<td>' .
        htmlspecialchars($_SERVER[$key] ?? 'nicht vorhanden') .
        '</td>';

    echo '</tr>';
}

echo '</table>';

echo '</div>';


// ============================================================
// 15. PHP KONFIGURATION
// ============================================================

echo '<div class="box">';
echo '<h2>15. PHP-Konfiguration</h2>';

info(
    'display_errors',
    ini_get('display_errors')
);

info(
    'error_reporting',
    error_reporting()
);

info(
    'upload_max_filesize',
    ini_get('upload_max_filesize')
);

info(
    'post_max_size',
    ini_get('post_max_size')
);

info(
    'memory_limit',
    ini_get('memory_limit')
);

echo '</div>';


// ============================================================
// ABSCHLUSS
// ============================================================

echo '<div class="box">';
echo '<h2>🏁 Debug abgeschlossen</h2>';

echo '<p>';
echo 'Wenn du mir den kompletten Inhalt dieser Debug-Seite bzw. ';
echo 'die roten ❌ und gelben ⚠️ Meldungen schickst, kann man ';
echo 'normalerweise ziemlich eindeutig feststellen, wo das Problem liegt.';
echo '</p>';

echo '</div>';

echo '</body>';
echo '</html>';
?>
