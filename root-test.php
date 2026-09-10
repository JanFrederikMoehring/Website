<?php

echo "<h1>Apache DocumentRoot Test</h1>";

echo "<h2>PHP</h2>";
echo "PHP-Version: " . PHP_VERSION . "<br>";
echo "PHP-Datei: " . __FILE__ . "<br>";
echo "Verzeichnis der PHP-Datei: " . __DIR__ . "<br>";

echo "<h2>Server</h2>";
echo "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'nicht gesetzt') . "<br>";
echo "SCRIPT_FILENAME: " . ($_SERVER['SCRIPT_FILENAME'] ?? 'nicht gesetzt') . "<br>";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'nicht gesetzt') . "<br>";
echo "SERVER_NAME: " . ($_SERVER['SERVER_NAME'] ?? 'nicht gesetzt') . "<br>";
echo "SERVER_PORT: " . ($_SERVER['SERVER_PORT'] ?? 'nicht gesetzt') . "<br>";

echo "<h2>Apache-Konfiguration</h2>";

echo "<pre>";
passthru("apache2ctl -S 2>&1");
echo "</pre>";
