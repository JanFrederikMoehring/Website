<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new PDO('/var/www/html/public/database/database.sqlite');

// $db = new PDO('sqlite:' . __DIR__ . '/public/database/database.sqlite');

// Users Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email VARCHAR UNIQUE,
        pw VARCHAR
)   ');

// To Dos Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS todos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    Title TEXT,
    Description TEXT,
    Date TEXT,
    Status TEXT
)');

function isPost(): bool 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return true;
    } else {
        return false;
    }
};

function getPostParam(string $key): null|string
{
    if (array_key_exists($key,$_POST) && $_POST[$key] !== '') {
        return $_POST[$key];
    } else {
        return null;
    }
}

function dd(mixed $value): never
{
    var_dump($value);
    exit;
}